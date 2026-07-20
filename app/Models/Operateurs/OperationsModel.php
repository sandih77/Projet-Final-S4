<?php

namespace App\Models\Operateurs;

use CodeIgniter\Model;

class OperationsModel extends Model
{
    protected $table = 'operations';
    protected $primaryKey = 'id';
    protected $allowed = [
        'client_id',
        'type_operation_id',
        'client_destinataire',
        'montant',
        'date_operation',
        'operateur_id',
        'frais'
    ];
}
