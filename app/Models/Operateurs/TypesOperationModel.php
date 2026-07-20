<?php

namespace App\Models\Operateurs;

use CodeIgniter\Model;

class TypesOperationModel extends Model
{
    protected $table = 'types_operation';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nom'
    ];
}