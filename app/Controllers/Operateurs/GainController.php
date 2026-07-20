<?php

namespace App\Controllers\Operateurs;

use App\Models\Operateurs\OperateursModel;
use App\Models\Operateurs\OperationsModel;
use CodeIgniter\Controller;
use App\Controllers\BaseController;

class GainController extends BaseController
{

    public function getGain(){
        return [
            'total_gains'         => $this->getGainTotal(),
            'gains_par_type'      => $this->getGainParTypeOperation(),
            'gains_par_operateur' => $this->getGainParOperateur()
        ];
    }

    public function getGainTotal()
    {
        $operationsModel = new OperationsModel();
        $gainTotal = $operationsModel->getGainTotal();

        return $gainTotal;
    }

    public function getGainParTypeOperation($operateur_id = null)
    {
        $operationsModel = new OperationsModel();
        $gainParTypeOperation = $operationsModel->getGainParTypeOperation($operateur_id);

        return $gainParTypeOperation;
    }

    public function getGainParOperateur($type_operation_id = null)
    {
        $operationsModel = new OperationsModel();
        $gainParOperateur = $operationsModel->getGainParOperateur($type_operation_id);

        return $gainParOperateur;
    }
}