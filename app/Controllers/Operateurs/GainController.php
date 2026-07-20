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
            'gains_autres_operateurs_detail' => $this->getGainAutreOperateur($operateur_id),
        ];
    }

    public function getGainTotal($operateur_id = null)
    {
        $operationsModel = new OperationsModel();
        $gainTotal = $operationsModel->getGainTotal($operateur_id);

        return $gainTotal;
    }

    public function getGainAutreOperateur($operateur_id)
    {
        $operationsModel = new OperationsModel();
        $gainAutreOperateur = $operationsModel->getGainAutreOperateur($operateur_id);

        return $gainAutreOperateur;
    }
}