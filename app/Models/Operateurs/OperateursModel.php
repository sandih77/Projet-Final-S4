<?php

namespace App\Models\Operateurs;

use CodeIgniter\Model;

class OperateursModel extends Model
{
    protected $table = 'operateur';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nom'
    ];

    public function getOperateurByTelephone($telephone)
    {
        $prefixe = substr($telephone, 0, 3);

        return $this->select("operateur.*")
            ->join("prefixes", "prefixes.operateur_id = operateur.id")
            ->where("prefixes.prefixe", $prefixe)
            ->first();
    }
}
