<?php

namespace App\Models\Operateurs;

use App\Models\Operateurs\TypesOperationModel;
use App\Models\Operateurs\OperateursModel;
use App\Models\Clients\ClientModel;

use CodeIgniter\Model;

class OperationsModel extends Model
{
    protected $table = "operations";
    protected $primaryKey = "id";

    protected $allowedFields = [
        "client_id",
        "type_operation_id",
        "client_destinataire",
        "montant",
        "date_operation",
        "operateur_id",
        "frais",
        "commission",
    ];

    public function getGainTotal($operateur_id = null)
    {
        $result = $this->select('SUM(frais) as total')
            ->where('operateur_id', $operateur_id)
            ->first();

        return $result['total'] ?? 0;
    }

    public function getGainAutreOperateur($operateur_id)
    {
        $listOperations  = $this->findAll();
        $operateursModel = new OperateursModel();
        $clientModel     = new ClientModel();

        $listGainAutreOperateur = [];

        foreach ($listOperations as $operation) {
            if (!empty($operation['client_destinataire'])) {
                $destinataire = $clientModel->find($operation['client_destinataire']);

                if ($destinataire && !empty($destinataire->telephone)) {
                    $operateur = $operateursModel->getOperateurByTelephone($destinataire->telephone);

                    if ($operateur) {
                        $operateurId  = is_array($operateur) ? $operateur['id'] : $operateur->id;
                        $operateurNom = is_array($operateur) ? $operateur['nom'] : $operateur->nom;

                        if ($operateurId != $operateur_id) {
                            if (!isset($listGainAutreOperateur[$operateurId])) {
                                $listGainAutreOperateur[$operateurId] = [
                                    'nom'     => $operateurNom,
                                    'montant' => 0
                                ];
                            }
                            $listGainAutreOperateur[$operateurId]['montant'] += ($operation['commission'] ?? 0);
                        }
                    }
                }
            }
        }

        return array_values($listGainAutreOperateur);
    }

    public function getMontantsAEnvoyerParOperateur($monOperateurId)
    {
        $listOperations  = $this->findAll();
        $operateursModel = new OperateursModel();
        $clientModel     = new ClientModel();

        $situation = [];

        foreach ($listOperations as $operation) {
            if (!empty($operation['client_destinataire'])) {
                $destinataire = $clientModel->find($operation['client_destinataire']);

                if ($destinataire && !empty($destinataire->telephone)) {
                    $operateur = $operateursModel->getOperateurByTelephone($destinataire->telephone);

                    if ($operateur) {
                        $operateurId = is_array($operateur) ? $operateur['id'] : $operateur->id;

                        if ($operateurId != $monOperateurId) {
                            $montantTransfert = $operation['montant'];
                            $commission = $operation['commission'] ?? 0;

                            if (!isset($situation[$operateurId])) {
                                $situation[$operateurId] = [
                                    'nom'               => is_array($operateur) ? $operateur['nom'] : $operateur->nom,
                                    'total_transferts'  => 0,
                                    'total_commissions' => 0,
                                    'total_a_envoyer'   => 0
                                ];
                            }

                            $situation[$operateurId]['total_transferts']  += $montantTransfert;
                            $situation[$operateurId]['total_commissions'] += $commission;
                            $situation[$operateurId]['total_a_envoyer']   += ($montantTransfert + $commission);
                        }
                    }
                }
            }
        }

        return $situation;
    }






    public function getSoldeClient($clientId)
    {
        // Argent reçu :
        // - dépôt
        // - transfert reçu
        $recu = $this->db
            ->table("operations")
            ->selectSum("montant", "total")
            ->groupStart()
            ->where("client_id", $clientId)
            ->where("type_operation_id", 1) // dépôt
            ->groupEnd()
            ->orGroupStart()
            ->where("client_destinataire", $clientId)
            ->where("type_operation_id", 3) // transfert reçu
            ->groupEnd()
            ->get()
            ->getRow();


        // Argent sorti :
        // - retrait
        // - transfert envoyé
        // + frais (frais du barème) + commission (frais inter-opérateur)
        $sortie = $this->db
            ->table("operations")
            ->select("SUM(montant + frais + commission) AS total")
            ->groupStart()
            ->where("client_id", $clientId)
            ->whereIn("type_operation_id", [2, 3])
            ->groupEnd()
            ->get()
            ->getRow();


        $totalRecu = $recu->total ?? 0;

        $totalSortie = $sortie->total ?? 0;


        return $totalRecu - $totalSortie;
    }


    public function getFrais($typeOperationId, $montant, $operateurId)
    {
        return $this->db
            ->table("baremes")
            ->where("type_operation_id", $typeOperationId)
            ->where("operateur_id", $operateurId)
            ->where("montant_min <=", $montant)
            ->where("montant_max >=", $montant)
            ->get()
            ->getRow();
    }


    public function getGainOperateur($operateurId)
    {
        $result = $this->db
            ->table("operations")
            ->selectSum("frais", "gain")
            ->where("operateur_id", $operateurId)
            ->get()
            ->getRow();


        return $result->gain ?? 0;
    }


    /**
     * Historique complet des opérations d'un client (envoyées et reçues),
     * avec les libellés (type d'opération, opérateur, destinataire) déjà résolus.
     */
    public function getHistoriqueClient($clientId): array
    {
        return $this->db
            ->table("operations")
            ->select(
                "operations.id, operations.montant, operations.frais, operations.commission, " .
                    "operations.date_operation, operations.client_id, operations.client_destinataire, " .
                    "types_operation.nom AS type_operation_nom, " .
                    "operateur.nom AS operateur_nom, " .
                    "dest.nom AS destinataire_nom, " .
                    "dest.telephone AS destinataire_telephone",
            )
            ->join("types_operation", "types_operation.id = operations.type_operation_id", "left")
            ->join("operateur", "operateur.id = operations.operateur_id", "left")
            ->join("clients AS dest", "dest.id = operations.client_destinataire", "left")
            ->groupStart()
            ->where("operations.client_id", $clientId)
            ->orWhere("operations.client_destinataire", $clientId)
            ->groupEnd()
            ->orderBy("operations.date_operation", "DESC")
            ->get()
            ->getResultArray();
    }

    public function getFraisTransfert($montant, $monOperateurId, $telephoneDestinataire)
    {
        $operateursModel = new \App\Models\Operateurs\OperateursModel();
        $operateurDest   = $operateursModel->getOperateurByTelephone($telephoneDestinataire);

        if ($operateurDest) {
            $destOperateurId = is_array($operateurDest) ? $operateurDest['id'] : $operateurDest->id;

            // Si transfert inter-opérateur -> 0 frais
            if ($destOperateurId != $monOperateurId) {
                return 0;
            }
        }

        // Sinon (même opérateur) -> Calcul selon le barème (type_operation_id = 3 pour transfert)
        $bareme = $this->getFrais(3, $montant, $monOperateurId);

        return $bareme ? $bareme->frais : 0;
    }

    
}
