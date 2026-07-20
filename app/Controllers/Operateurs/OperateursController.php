<?php

namespace App\Controllers\Operateurs;

use App\Controllers\BaseController;

use App\Models\Operateurs\OperateursModel;
use App\Controllers\Operateurs\GainController;
use App\Models\Clients\ClientModel;
use App\Models\Operateurs\OperationsModel;
use App\Models\Operateurs\PrefixesModel;
use App\Models\Operateurs\TypesOperationModel;
use App\Models\Operateurs\BaremesModel;

class OperateursController extends BaseController
{
    public function dashboard()
    {
        $stats = [
            'operateurs' => (new OperateursModel())->countAllResults(),
            'prefixes' => (new PrefixesModel())->countAllResults(),
            'types_operation' => (new TypesOperationModel())->countAllResults(),
            'baremes' => (new BaremesModel())->countAllResults(),
        ];

        $situationClients = $this->getSituationComptesClients();

        return view('operateurs/dashboard', array_merge(['stats' => $stats], $situationClients));
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

    public function getSituationClient(){

    }

    private function getSituationComptesClients(): array
    {
        $clientModel     = new ClientModel();
        $operationsModel = new OperationsModel();

        $clients = $clientModel->findAll();
        $totalSoldeGlobal = 0;

        foreach ($clients as $client) {
            $solde = $operationsModel->getSoldeClient($client->id);
            $client->solde = $solde;
            $totalSoldeGlobal += $solde;
        }

        return [
            'clients'             => $clients,
            'total_solde_clients' => $totalSoldeGlobal
        ];
    }


}
