<?php

namespace App\Controllers\Operateurs;

use App\Controllers\BaseController;
use App\Models\Operateurs\PrefixesModel;
use App\Models\Operateurs\OperateursModel;

class PrefixesController extends BaseController
{
    public function index()
    {
        $prefixesModel = new PrefixesModel();
        $prefixes = $prefixesModel->findAll();

        $data = [
            'prefixes' => $prefixes
        ];

        $operateurModel = new OperateursModel();
        $operateurs = $operateurModel->findAll();

        foreach($prefixes as &$prefix) {
            foreach($operateurs as $operateur) {
                if($prefix['operateur_id'] == $operateur['id']) {
                    $prefix['operateur_id'] = $operateur['nom'];
                }
            }
        }
        $data['prefixes'] = $prefixes;

        return view('operateurs/prefixes/list', $data);
    }

    public function create()
    {
        $operateurModel = new OperateursModel();
        $operateurs = $operateurModel->findAll();

        $data = [
            'operateurs' => $operateurs
        ];

        return view('operateurs/prefixes/form', $data);
    }

    public function insert()
    {
        $prefixesModel = new PrefixesModel();

        $data = [
            'prefixe' => $this->request->getPost('prefixe'),
            'operateur_id' => $this->request->getPost('operateur_id')
        ];

        $prefixesModel->insert($data);

        return redirect()->to('/operateurs/prefixes');
    }

    public function edit($id)
    {
        $prefixesModel = new PrefixesModel();
        $prefix = $prefixesModel->find($id);

        $operateurModel = new OperateursModel();
        $operateurs = $operateurModel->findAll();

        $data = [
            'prefix' => $prefix,
            'operateurs' => $operateurs
        ];

        return view('operateurs/prefixes/form', $data);
    }

    public function update($id)
    {
        $prefixesModel = new PrefixesModel();

        $data = [
            'prefixe' => $this->request->getPost('prefixe'),
            'operateur_id' => $this->request->getPost('operateur_id')
        ];

        $prefixesModel->update($id, $data);

        return redirect()->to('/operateurs/prefixes');
    }

    public function delete($id)
    {
        $prefixesModel = new PrefixesModel();
        $prefixesModel->delete($id);

        return redirect()->to('/operateurs/prefixes');
    }
}