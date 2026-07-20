<?php

namespace App\Controllers\Operateurs;

use App\Controllers\BaseController;

use App\Models\Operateurs\OperateursModel;
use App\Controllers\Operateurs\GainController;

class OperateursController extends BaseController
{
    public function dashboard()
    {
        $gainController = new GainController();
        $data = $gainController->getGain();
        
        return view('operateurs/dashboard', $data);
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
