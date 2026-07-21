<?php

namespace App\Models\Operateurs;

use App\Models\Operateurs\TypesOperationModel;
use App\Models\Operateurs\OperateursModel;

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

    /**
     * Gain total de MON opérateur : uniquement les frais de base perçus sur
     * mes propres opérations (dépôt, retrait, transfert). La commission
     * inter-opérateur est stockée à part et ne m'appartient jamais : elle est
     * due à l'opérateur du destinataire (voir getGainAutreOperateur()).
     */
    public function getGainTotal($operateur_id = null)
    {
        $result = $this->select('SUM(frais) as total')
            ->where('operateur_id', $operateur_id)
            ->first();

        return $result['total'] ?? 0;
    }

    /**
     * Commissions dues par MON opérateur aux AUTRES opérateurs, groupées par
     * opérateur destinataire. Ces commissions sont désormais lues directement
     * depuis la colonne "commission" de chaque opération (plus de recalcul).
     */
    public function getGainAutreOperateur($operateur_id)
    {
        $listOperations = $this->where('operateur_id', $operateur_id)
            ->where('commission >', 0)
            ->findAll();

        $operateursModel = new \App\Models\Operateurs\OperateursModel();
        $clientModel     = new \App\Models\Clients\ClientModel();

        $listGainAutreOperateur = [];

        foreach ($listOperations as $operation) {
            if (empty($operation['client_destinataire'])) {
                continue;
            }

            $destinataire = $clientModel->find($operation['client_destinataire']);

            if (!$destinataire || empty($destinataire->telephone)) {
                continue;
            }

            $operateurDest = $operateursModel->getOperateurByTelephone($destinataire->telephone);

            if (!$operateurDest) {
                continue;
            }

            $operateurDestId = is_array($operateurDest) ? $operateurDest['id'] : $operateurDest->id;

            if (!isset($listGainAutreOperateur[$operateurDestId])) {
                $listGainAutreOperateur[$operateurDestId] = 0;
            }

            $listGainAutreOperateur[$operateurDestId] += $operation['commission'];
        }

        return $listGainAutreOperateur;
    }

    /**
     * Récapitulatif, par opérateur partenaire, des montants transférés et
     * des commissions à leur reverser (lues directement depuis la colonne
     * "commission").
     */
    public function getMontantsAEnvoyerParOperateur($monOperateurId)
    {
        $listOperations = $this->where('operateur_id', $monOperateurId)
            ->where('commission >', 0)
            ->findAll();

        $operateursModel = new \App\Models\Operateurs\OperateursModel();
        $clientModel     = new \App\Models\Clients\ClientModel();

        $situation = [];

        foreach ($listOperations as $operation) {
            if (empty($operation['client_destinataire'])) {
                continue;
            }

            $destinataire = $clientModel->find($operation['client_destinataire']);

            if (!$destinataire || empty($destinataire->telephone)) {
                continue;
            }

            $operateurDest = $operateursModel->getOperateurByTelephone($destinataire->telephone);

            if (!$operateurDest) {
                continue;
            }

            $operateurDestId = is_array($operateurDest) ? $operateurDest['id'] : $operateurDest->id;
            $nomDest = is_array($operateurDest) ? $operateurDest['nom'] : $operateurDest->nom;

            if (!isset($situation[$operateurDestId])) {
                $situation[$operateurDestId] = [
                    'nom'               => $nomDest,
                    'total_transferts'  => 0,
                    'total_commissions' => 0,
                    'total_a_envoyer'   => 0,
                ];
            }

            $situation[$operateurDestId]['total_transferts']  += $operation['montant'];
            $situation[$operateurDestId]['total_commissions'] += $operation['commission'];
            $situation[$operateurDestId]['total_a_envoyer']   += $operation['montant'] + $operation['commission'];
        }

        return $situation;
    }



    // public function getGainParOperateur($operateur_id = null)
    // {
    //     $builder = $this->select('types_operation.nom as type_nom, 
    //                               SUM(operations.frais) as total_gains, 
    //                               COUNT(operations.id) as nombre_operations')
    //         ->join('types_operation', 'types_operation.id = operations.type_operation_id')
    //         ->groupBy('operations.type_operation_id');

    //     if ($operateur_id !== null) {
    //         $builder->where('operations.operateur_id', $operateur_id);
    //     }

    //     return $builder->findAll();
    // }

    // public function getGainParTypeOperation($type_operation_id = null)
    // {
    //     $builder = $this->select('operateur.nom as operateur_nom, 
    //                               SUM(operations.frais) as total_gains, 
    //                               COUNT(operations.id) as nombre_operations')
    //         ->join('operateur', 'operateur.id = operations.operateur_id')
    //         ->groupBy('operations.operateur_id');

    //     if ($type_operation_id !== null) {
    //         $builder->where('operations.type_operation_id', $type_operation_id);
    //     }

    //     return $builder->findAll();
    // }








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

    public function getSoldeClientSansFrais($clientId)
    {
        
        $recu = $this->db
            ->table("operations")
            ->selectSum("montant", "total")
            ->groupStart()
                ->where("client_id", $clientId)
                ->where("type_operation_id", 1)
            ->groupEnd()
            ->orGroupStart()
                ->where("client_destinataire", $clientId)
                ->where("type_operation_id", 3)
            ->groupEnd()
            ->get()
            ->getRow();

            
        $sortie = $this->db
            ->table("operations")
            ->selectSum("montant", "total")
            ->where("client_id", $clientId)
            ->whereIn("type_operation_id", [2, 3])
            ->get()
            ->getRow();

        $totalRecu   = $recu->total ?? 0;
        $totalSortie = $sortie->total ?? 0;

        return $totalRecu - $totalSortie;
    }

    
}
