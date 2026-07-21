<?php

namespace App\Models\Operateurs;


use CodeIgniter\Model;

class PromotionsModel extends Model
{
    protected $table = "promotions";
    protected $primaryKey = "id";
    protected $allowedFields = [
        "pourcentage",
        "operateur_id",
    ];

    public function getPromotionByOperateurId($operateur_id = null)
    {
        return $this->where("operateur_id", $operateur_id)->first();
    }

}
