<?php

namespace App\Models\Epargne;

use CodeIgniter\Model;

class EpargneModel extends Model
{
    protected $table = "epargne";
    protected $primaryKey = "id";
    protected $allowedFields = ["client_id", "montant"];

    public function getEpargneClient($client_id)
    {
        return $this->db
            ->table("epargne")
            ->selectSum("montant")
            ->where("client_id", $client_id)
            ->get()
            ->getRow();
    }
}
