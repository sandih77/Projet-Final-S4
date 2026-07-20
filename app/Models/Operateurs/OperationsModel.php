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
        $recu = $this->db
            ->table("operations")
            ->selectSum("montant")
            ->groupStart()
            ->where("client_id", $clientId)
            ->whereIn("type_operation_id", [1])
            ->groupEnd()
            ->orGroupStart()
            ->where("client_destinataire", $clientId)
            ->where("type_operation_id", 3)
            ->groupEnd()
            ->get()
            ->getRow();

        $sortie = $this->db
            ->table("operations")
            ->selectSum("montant")
            ->groupStart()
            ->where("client_id", $clientId)
            ->whereIn("type_operation_id", [2, 3])
            ->groupEnd()
            ->get()
            ->getRow();

        $totalRecu = $recu->montant ?? 0;
        $totalSortie = $sortie->montant ?? 0;

        return $totalRecu - $totalSortie;
    }
}
