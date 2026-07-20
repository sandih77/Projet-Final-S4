<?php

namespace App\Models\Operateurs;

use CodeIgniter\Model;
use App\Models\Operateurs\OperateursModel;

class PrefixesModel extends Model
{
    protected $table = 'prefixes';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'prefixe',
        'operateur_id'
    ];

    public function FindAllByOperateurId($operateur_id = null){
        $operateur = new OperateursModel();

        if($operateur_id == null){
            return $this->findAll();
        }

        $operateur = $operateur->find($operateur_id);

        if(!$operateur){
            $list = $this->findAll();
            $result = [];

            foreach($list as $item){
                if($item['operateur_id'] != null && $item['operateur_id'] == $operateur_id){
                    $result[] = $item;
                }
            }
            return $result;
        }
    }
}
