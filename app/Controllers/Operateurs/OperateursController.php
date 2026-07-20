<?php

namespace App\Controllers\Operateurs;

use App\Controllers\BaseController;

use App\Models\Operateurs\OperateursModel;
use App\Controllers\Operateurs\GainController;
use App\Models\Clients\ClientModel;
use App\Models\Operateurs\OperationsModel;

class OperateursController extends BaseController
{
    public function dashboard()
    {
        $gainController = new GainController();
        $data = $gainController->getGain();

        $situationClients = $this->getSituationComptesClients();
        $data = array_merge($data, $situationClients);
        
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
