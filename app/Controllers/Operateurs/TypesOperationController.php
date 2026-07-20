<?php

namespace App\Controllers\Operateurs;

use App\Models\Operateurs\TypesOperationModel;
use App\Controllers\BaseController;

class TypesOperationController extends BaseController
{
    public function index()
    {
        $model = new TypesOperationModel();
        $data['types_operation'] = $model->findAll();
        return view('operateurs/types_operation/list', $data);
    }

    public function create()
    {
        return view('operateurs/types_operation/form');
    }

    public function insert()
    {
        $model = new TypesOperationModel();
        $data = [
            'nom' => $this->request->getPost('nom')
        ];
        $model->insert($data);
        return redirect()->to('/operateurs/types-operation');
    }

    public function edit($id)
    {
        $model = new TypesOperationModel();
        $data['type_operation'] = $model->find($id);
        return view('operateurs/types_operation/form', $data);
    }

    public function update($id)
    {
        $model = new TypesOperationModel();
        $data = [
            'nom' => $this->request->getPost('nom')
        ];
        $model->update($id, $data);
        return redirect()->to('/operateurs/types-operation');
    }

    public function delete($id)
    {
        $model = new TypesOperationModel();
        $model->delete($id);
        return redirect()->to('/operateurs/types-operation');
    }
}