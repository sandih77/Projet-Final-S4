<?php

namespace App\Models\Operateurs;

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
    ];


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
        // + frais
        $sortie = $this->db
            ->table("operations")
            ->select("SUM(montant + frais) AS total")
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
}
