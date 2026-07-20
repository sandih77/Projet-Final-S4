<?php

namespace App\Controllers\Transaction;

use App\Controllers\BaseController;
use App\Models\Clients\ClientModel;
use App\Models\Operateurs\TypesOperationModel;
use App\Models\Operateurs\OperationsModel;
use App\Models\Operateurs\OperateursModel;
use App\Models\Operateurs\BaremesModel;

class TransactionController extends BaseController
{
    private ClientModel $clientModel;
    private TypesOperationModel $typesOperationModel;
    private OperationsModel $operationModel;
    private OperateursModel $operateursModel;
    private BaremesModel $baremesModel;

    public function __construct()
    {
        $this->clientModel = new ClientModel();
        $this->typesOperationModel = new TypesOperationModel();
        $this->operationModel = new OperationsModel();
        $this->operateursModel = new OperateursModel();
        $this->baremesModel = new BaremesModel();
    }

    public function index()
    {
        $typesOperations = $this->typesOperationModel->findAll();

        return view("clients/transaction", [
            "typesOperations" => $typesOperations,
        ]);
    }

    public function store()
    {
        $montant = $this->request->getPost("montant");
        $code_secret = $this->request->getPost("code_secret");
        $operationId = $this->request->getPost("type_operation");

        $clientSession = session()->get("client");

        if (!$clientSession) {
            return redirect()->to("/clients");
        }

        $client = $this->clientModel->find($clientSession["id"]);

        if (!$client) {
            return redirect()->back()->with("error", "Client introuvable");
        }

        if ($code_secret != $client->code_secret) {
            return redirect()
                ->back()
                ->withInput()
                ->with("error", "Code secret incorrect");
        }

        $operation = $this->typesOperationModel->find($operationId);

        if (!$operation) {
            return redirect()
                ->back()
                ->with("error", "Type d'opération invalide");
        }

        $operateur = $this->operateursModel->getOperateurByTelephone(
            $client->telephone,
        );

        if (!$operateur) {
            return redirect()->back()->with("error", "Opérateur introuvable");
        }

        switch ($operation["nom"]) {
            case "depot":
                $this->faireDepot($client, $montant, $operation, $operateur);

                break;

            case "retrait":
                if (
                    !$this->faireRetrait(
                        $client,
                        $montant,
                        $operation,
                        $operateur,
                    )
                ) {
                    return redirect()
                        ->back()
                        ->with("error", "Solde insuffisant");
                }

                break;

            case "transfert":
                $destinataires = $this->request->getPost("destinataire");

                $inclureFraisRetrait = $this->request->getPost(
                    "inclure_transaction",
                );

                if (
                    !$this->faireTransfert(
                        $client,
                        $destinataires,
                        $montant,
                        $operation,
                        $operateur,
                        $inclureFraisRetrait,
                    )
                ) {
                    return redirect()
                        ->back()
                        ->with("error", session()->getFlashdata("error"));
                }

                break;

            default:
                return redirect()->back()->with("error", "Opération inconnue");
        }

        return redirect()->back()->with("success", "Transaction effectuée");
    }

    private function faireDepot($client, $montant, $operation, $operateur)
    {
        return $this->operationModel->insert([
            "client_id" => $client->id,

            "type_operation_id" => $operation["id"],

            "client_destinataire" => null,

            "montant" => $montant,

            "frais" => 0,

            "operateur_id" => $operateur["id"],
        ]);
    }

    private function faireRetrait($client, $montant, $operation, $operateur)
    {
        $solde = $this->operationModel->getSoldeClient($client->id);

        // Un retrait autonome facture toujours son frais de barème.
        $bareme = $this->baremesModel->getFrais(
            $operation["id"],
            $montant,
            $operateur["id"],
        );

        $frais = $bareme ? $bareme->frais : 0;

        $total = $montant + $frais;

        if ($solde < $total) {
            return false;
        }

        return $this->operationModel->insert([
            "client_id" => $client->id,

            "type_operation_id" => $operation["id"],

            "client_destinataire" => null,

            "montant" => $montant,

            "frais" => $frais,

            "operateur_id" => $operateur["id"],
        ]);
    }

    private function faireTransfert(
        $client,
        $destinataires,
        $montant,
        $operation,
        $operateur,
        $inclureFraisRetrait = false,
    ) {
        if (!is_array($destinataires) || count($destinataires) == 0) {
            session()->setFlashdata("error", "Aucun destinataire");
            return false;
        }

        $nombreDestinataires = count($destinataires);

        $clientsDestinataires = [];
        $operateurDestinataire = null;

        foreach ($destinataires as $telephone) {
            $clientDestinataire = $this->clientModel->getClientByTelephone(
                $telephone,
            );

            if (!$clientDestinataire) {
                session()->setFlashdata(
                    "error",
                    "Destinataire $telephone introuvable",
                );
                return false;
            }

            $operateurDest = $this->operateursModel->getOperateurByTelephone(
                $clientDestinataire->telephone,
            );

            if (!$operateurDest) {
                session()->setFlashdata(
                    "error",
                    "Opérateur du destinataire inconnu",
                );
                return false;
            }

            if (
                $nombreDestinataires > 1 &&
                $operateurDest["id"] != $operateur["id"]
            ) {
                session()->setFlashdata(
                    "error",
                    "Avec plusieurs destinataires, ils doivent avoir le même opérateur que vous",
                );
                return false;
            }

            if ($operateurDestinataire == null) {
                $operateurDestinataire = $operateurDest;
            }

            if ($operateurDestinataire["id"] != $operateurDest["id"]) {
                session()->setFlashdata(
                    "error",
                    "Les destinataires doivent avoir le même opérateur",
                );
                return false;
            }

            $clientsDestinataires[] = $clientDestinataire;
        }

        $montantParDestinataire = floor($montant / $nombreDestinataires);

        $memeOperateur = $operateur["id"] == $operateurDestinataire["id"];

        // Frais de transfert : TOUJOURS obligatoire, calculé via le barème
        // "transfert" de MON opérateur. C'est ce montant qui constitue le
        // gain de mon opérateur.
        $baremeTransfert = $this->baremesModel->getFrais(
            $operation["id"],
            $montantParDestinataire,
            $operateur["id"],
        );

        $fraisTransfert = $baremeTransfert ? (float) $baremeTransfert->frais : 0;

        // Frais de retrait : OPTIONNEL, mais UNIQUEMENT pour un transfert
        // vers le MÊME opérateur. Vers un autre opérateur, seul le frais de
        // transfert (+ la commission) s'applique, il n'y a pas de frais de
        // retrait à ajouter.
        $fraisRetrait = 0;

        if ($memeOperateur && $inclureFraisRetrait) {
            $baremeRetrait = $this->baremesModel->getFrais(
                2, // type d'opération "retrait"
                $montantParDestinataire,
                $operateur["id"],
            );

            $fraisRetrait = $baremeRetrait ? (float) $baremeRetrait->frais : 0;
        }

        $fraisParDestinataire = $fraisTransfert + $fraisRetrait;

        // Commission inter-opérateurs : également obligatoire dès que le
        // destinataire est chez un AUTRE opérateur. Ce montant constitue le
        // gain de l'autre opérateur (et non le mien).
        $commissionParDestinataire = 0;

        if (!$memeOperateur) {
            $commissionParDestinataire =
                ($montantParDestinataire *
                    $operateurDestinataire["commission"]) /
                100;
        }

        $fraisTotal =
            ($fraisParDestinataire + $commissionParDestinataire) *
            $nombreDestinataires;

        $total = $montant + $fraisTotal;

        $solde = $this->operationModel->getSoldeClient($client->id);

        if ($solde < $total) {
            session()->setFlashdata("error", "Solde insuffisant");

            return false;
        }

        foreach ($clientsDestinataires as $clientDestinataire) {
            // Une seule ligne par transfert : le destinataire reçoit le
            // montant, le frais de base revient à mon opérateur, et la
            // commission (le cas échéant) est due à l'opérateur du
            // destinataire. Les deux sont stockés séparément sur la même
            // opération pour garder un historique clair.
            $this->operationModel->insert([
                "client_id" => $client->id,

                "type_operation_id" => $operation["id"],

                "client_destinataire" => $clientDestinataire->id,

                "montant" => $montantParDestinataire,

                "frais" => $fraisParDestinataire,

                "commission" => $commissionParDestinataire,

                "operateur_id" => $operateur["id"],
            ]);
        }

        return true;
    }

    public function verifierOperateur()
    {
        $telephone = $this->request->getPost("telephone");

        $clientSession = session()->get("client");
        $client = $this->clientModel->find($clientSession["id"]);

        $operateurSource = $this->operateursModel->getOperateurByTelephone(
            $client->telephone,
        );

        $clientDest = $this->clientModel->getClientByTelephone($telephone);

        if (!$clientDest) {
            return $this->response->setJSON([
                "different" => false,
                "error" => "Destinataire introuvable",
            ]);
        }

        $operateurDest = $this->operateursModel->getOperateurByTelephone(
            $clientDest->telephone,
        );

        return $this->response->setJSON([
            "different" => $operateurSource["id"] != $operateurDest["id"],
        ]);
    }
}
