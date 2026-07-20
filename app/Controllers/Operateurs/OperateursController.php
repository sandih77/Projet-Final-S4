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
        $operateur_id = 1;

        $operateursModel = new OperateursModel();
        $prefixesModel   = new PrefixesModel();
        $typesModel      = new TypesOperationModel();
        $baremesModel    = new BaremesModel();

        $gainController = new GainController();

        $stats = [
            "operateurs"      => $operateursModel->countAllResults(),
            "prefixes"        => $prefixesModel->countAllResults(),
            "types_operation" => $typesModel->countAllResults(),
            "baremes"         => $baremesModel->countAllResults(),
        ];

        $situationClients     = $this->getSituationComptesClients();
        $gains                = $gainController->getGain($operateur_id);
        $montantsParOperateur = $this->getMontantsAEnvoyerParOperateur($operateur_id);

        return view('operateurs/dashboard', array_merge(
            ['stats' => $stats],
            $situationClients,
            $gains,
            ['montants_a_envoyer' => $montantsParOperateur]
        ));
    }

    public function index()
    {
        $operateurModel = new OperateursModel();
        $operateurs = $operateurModel->findAll();

        $data = [
            "operateurs" => $operateurs,
        ];

        return view("operateurs/operateurs/list", $data);
    }

    public function create()
    {
        return view("operateurs/operateurs/form");
    }

    public function insert()
    {
        $operateurModel = new OperateursModel();

        $data = [
            "nom" => $this->request->getPost("nom"),
        ];

        $operateurModel->insert($data);

        return redirect()->to("/operateurs/operateurs");
    }


    private function getSituationComptesClients(): array
    {
        $monOperateurId = 1;

        $clientModel     = new ClientModel();
        $operationsModel = new OperationsModel();
        $operateursModel = new OperateursModel();

        $allClients       = $clientModel->findAll();
        $nosClients       = [];
        $totalSoldeGlobal = 0;

        foreach ($allClients as $client) {
            
            $operateur = $operateursModel->getOperateurByTelephone($client->telephone);
            $operateurId = is_array($operateur) ? ($operateur['id'] ?? null) : ($operateur->id ?? null);

            if ($operateurId == $monOperateurId) {
                $solde         = $operationsModel->getSoldeClient($client->id);
                $client->solde = $solde;

                $nosClients[]      = $client;
                $totalSoldeGlobal += $solde;
            }
        }

        return [
            "clients"             => $nosClients,
            "total_solde_clients" => $totalSoldeGlobal,
        ];
    }

    public function getMontantsAEnvoyerParOperateur($monOperateurId)
    {
        $operationsModel = new OperationsModel();
        $montantsParOperateur = $operationsModel->getMontantsAEnvoyerParOperateur($monOperateurId);

        return $montantsParOperateur;
    }
}
