<?php

namespace App\Controllers\Operateurs;

use App\Controllers\BaseController;

use App\Models\Operateurs\OperateursModel;

class OperateursController extends BaseController
{
    public function dashboard()
    {
        return view('operateurs/dashboard');
    }

    public function index()
    {
        $operateurModel = new OperateursModel();
        $operateurs = $operateurModel->findAll();

        $data = [
            'operateurs' => $operateurs
        ];

        return view('operateurs/operateurs/list', $data);
    }

    public function create()
    {
        return view('operateurs/operateurs/form');
    }

    public function insert()
    {
        $operateurModel = new OperateursModel();

        $data = [
            'nom' => $this->request->getPost('nom')
        ];

        $operateurModel->insert($data);

        return redirect()->to('/operateurs/operateurs');
    }
}
