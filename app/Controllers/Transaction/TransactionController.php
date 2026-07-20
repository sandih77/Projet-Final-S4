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

        // Ici $operation est un tableau
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
                $telephoneDestinataire = $this->request->getPost(
                    "destinataire",
                );

                $clientDestinataire = $this->clientModel->getClientByTelephone(
                    $telephoneDestinataire,
                );

                if (!$clientDestinataire) {
                    return redirect()
                        ->back()
                        ->with("error", "Destinataire introuvable");
                }

                $operateurDestinataire = $this->operateursModel->getOperateurByTelephone(
                    $clientDestinataire->telephone,
                );

                if (!$operateurDestinataire) {
                    return redirect()
                        ->back()
                        ->with("error", "Opérateur destinataire inconnu");
                }

                if ($operateur["id"] != $operateurDestinataire["id"]) {
                    return redirect()
                        ->back()
                        ->with(
                            "error",
                            "Transfert impossible : les deux clients doivent avoir le même opérateur",
                        );
                }

                if (
                    !$this->faireTransfert(
                        $client,
                        $montant,
                        $operation,
                        $operateur,
                        $clientDestinataire,
                    )
                ) {
                    return redirect()
                        ->back()
                        ->with("error", "Solde insuffisant");
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

            // Correction ici
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
        $montant,
        $operation,
        $operateur,
        $clientDestinataire,
    ) {
        $solde = $this->operationModel->getSoldeClient($client->id);

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

            "client_destinataire" => $clientDestinataire->id,

            "montant" => $montant,

            "frais" => $frais,

            "operateur_id" => $operateur["id"],
        ]);
    }
}
