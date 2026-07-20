<?php

namespace App\Controllers\Operateurs;

use App\Controllers\BaseController;
use App\Models\Operateurs\TypesOperationModel;
use App\Models\Operateurs\BaremesModel;
use App\Models\Operateurs\OperateursModel;

class BaremesController extends BaseController
{
    public function index()
    {
        $model = new BaremesModel();
        $data['baremes'] = $model->findAll();
        return view('operateurs/baremes/list', $data);
    }

    public function create()
    {
        $typeOperationModel = new TypesOperationModel();
        $operateurModel = new OperateursModel();
        
        $data['types_operation'] = $typeOperationModel->findAll();
        $data['operateurs'] = $operateurModel->findAll();

        return view('operateurs/baremes/form', $data);
    }

    public function insert()
    {
        $model = new BaremesModel();
        $data = [
            'type_operation_id' => $this->request->getPost('type_operation_id'),
            'montant_min' => $this->request->getPost('montant_min'),
            'montant_max' => $this->request->getPost('montant_max'),
            'frais' => $this->request->getPost('frais'),
            'operateur_id' => $this->request->getPost('operateur_id')
        ];
        $model->insert($data);
        return redirect()->to('/operateurs/baremes');
    }

    public function edit($id)
    {
        $model = new BaremesModel();
        $data['bareme'] = $model->find($id);

        $typeOperationModel = new TypesOperationModel();
        $data['types_operation'] = $typeOperationModel->findAll();

        $operateurModel = new OperateursModel();
        $data['operateurs'] = $operateurModel->findAll();

        return view('operateurs/baremes/form', $data);
    }

    public function update($id)
    {
        $model = new BaremesModel();
        $data = [
            'type_operation_id' => $this->request->getPost('type_operation_id'),
            'montant_min' => $this->request->getPost('montant_min'),
            'montant_max' => $this->request->getPost('montant_max'),
            'frais' => $this->request->getPost('frais'),
            'operateur_id' => $this->request->getPost('operateur_id')
        ];
        $model->update($id, $data);
        return redirect()->to('/operateurs/baremes');
    }

    public function delete($id)
    {
        $model = new BaremesModel();
        $model->delete($id);
        return redirect()->to('/operateurs/baremes');
    }
}