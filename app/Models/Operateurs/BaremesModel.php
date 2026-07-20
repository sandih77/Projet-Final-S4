<?php

namespace App\Models\Operateurs;

use CodeIgniter\Model;

class BaremesModel extends Model
{
    protected $table = "baremes";
    protected $primaryKey = "id";
    protected $allowedFields = [
        "types_operation_id",
        "montant_min",
        "montant_max",
        "frais",
        "operateur_id",
    ];

    public function getTypeOperationByOperateurId($operateur_id = null)
    {
        if ($operateur_id == null) {
            return $this->findAll();
        }

        return $this->where("operateur_id", $operateur_id)->findAll();
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
}
