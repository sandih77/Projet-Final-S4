<?php

namespace App\Controllers\Operateurs;

use App\Models\Operateurs\OperateursModel;
use App\Models\Operateurs\OperationsModel;
use CodeIgniter\Controller;
use App\Controllers\BaseController;

class GainController extends BaseController
{

    public function getGain($operateur_id = null){
        return [
            'total_gains'         => $this->getGainTotal($operateur_id),
            'gains_autre_operateur' => $this->getGainAutreOperateur($operateur_id),
        ];
    }

    public function getGainTotal($operateur_id = null)
    {
        $operationsModel = new OperationsModel();
        $gainTotal = $operationsModel->getGainTotal($operateur_id);

        return $gainTotal;
    }

    // public function getGainParTypeOperation($operateur_id = null)
    // {
    //     $operationsModel = new OperationsModel();
    //     $gainParTypeOperation = $operationsModel->getGainParTypeOperation($operateur_id);

    //     return $gainParTypeOperation;
    // }

    // public function getGainParOperateur($type_operation_id = null)
    // {
    //     $operationsModel = new OperationsModel();
    //     $gainParOperateur = $operationsModel->getGainParOperateur($type_operation_id);

    //     return $gainParOperateur;
    // }

    public function getGainAutreOperateur($operateur_id)
    {
        $operationsModel = new OperationsModel();
        $gainAutreOperateur = $operationsModel->getGainAutreOperateur($operateur_id);

        return $gainAutreOperateur;
    }
}