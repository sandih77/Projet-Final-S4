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
}
