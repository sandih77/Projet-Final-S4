<?php

namespace App\Models\Operateurs;

use App\Models\Operateurs\TypesOperationModel;
use App\Models\Operateurs\OperateursModel;

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

    public function getGainTotal()
    {
        $result = $this->select('SUM(frais) as total_gains')
            ->first();
        return $result['total_gains'] ?? 0;
    }

    public function getGainParTypeOperation($operateur_id = null)
    {
        $builder = $this->select('types_operation.nom as type_nom, 
                                  SUM(operations.frais) as total_gains, 
                                  COUNT(operations.id) as nombre_operations')
            ->join('types_operation', 'types_operation.id = operations.type_operation_id')
            ->groupBy('operations.type_operation_id');

        if ($operateur_id !== null) {
            $builder->where('operations.operateur_id', $operateur_id);
        }

        return $builder->findAll();
    }

    public function getGainParOperateur($type_operation_id = null)
    {
        $builder = $this->select('operateur.nom as operateur_nom, 
                                  SUM(operations.frais) as total_gains, 
                                  COUNT(operations.id) as nombre_operations')
            ->join('operateur', 'operateur.id = operations.operateur_id')
            ->groupBy('operations.operateur_id');

        if ($type_operation_id !== null) {
            $builder->where('operations.type_operation_id', $type_operation_id);
        }

        return $builder->findAll();
    }

    
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
