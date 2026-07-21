<?php

namespace App\Controllers\Clients;

use App\Models\Epargne\EpargneModel;
use App\Models\Operateurs\OperationsModel;

use App\Controllers\BaseController;
use App\Models\Clients\ClientModel;
use App\Models\Operateurs\OperateursModel;

class ClientController extends BaseController
{
    private ClientModel $clientModel;
    private OperateursModel $operateursModel;
    private OperationsModel $operationModel;
    private EpargneModel $epargneModel;

    public function __construct()
    {
        $this->clientModel = new ClientModel();
        $this->operationModel = new OperationsModel();
        $this->operateursModel = new OperateursModel();
        $this->epargneModel = new EpargneModel();
    }

    public function index()
    {
        return view("clients/login");
    }

    public function login()
    {
        $data = $this->request->getPost();

        if (!$this->clientModel->validate($data)) {
            return view("clients/login", [
                "errors" => $this->clientModel->errors(),
            ]);
        }

        $operateur = $this->operateursModel->getOperateurByTelephone(
            $data["telephone"],
        );

        if ($operateur["id"] != 1) {
            return view("clients/login", [
                "error" => "Opérateur non autorisé",
            ]);
        }

        $client = $this->clientModel->findByCodeSecretAndTelephone(
            $data["code_secret"],
            $data["telephone"],
        );

        if ($client) {
            session()->set([
                "client" => [
                    "id" => $client->id,
                    "nom" => $client->nom,
                    "telephone" => $client->telephone,
                ],
                "logged_in" => true,
            ]);

            return redirect()->to("/clients/dashboard");
        }

        return view("clients/login", [
            "error" =>
                "Vérifiez votre code secret et votre numéro de téléphone",
        ]);
    }

    public function dashboard()
    {
        if (!session()->get("logged_in")) {
            return redirect()->to("/clients");
        }

        $client = session()->get("client");

        return view("clients/dashboard", [
            "client" => $client,
            "solde" => $this->operationModel->getSoldeClient($client["id"]),
        ]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to("/");
    }

    public function solde($id)
    {
        $client = $this->clientModel->find($id);

        if (!$client) {
            return redirect()->back()->with("error", "Client introuvable");
        }

        $solde = $this->operationModel->getSoldeClient($id);

        return view("clients/solde", [
            "client" => $client,
            "solde" => $solde,
        ]);
    }

    public function historique()
    {
        $clientSession = session()->get("client");

        if (!$clientSession) {
            return redirect()->to("/clients");
        }

        $historique = $this->operationModel->getHistoriqueClient(
            $clientSession["id"],
        );

        return view("clients/historique", [
            "client" => $clientSession,
            "historique" => $historique,
        ]);
    }

    public function epargne()
    {
        $clientSession = session()->get("client");
        $valeurEpargne = $this->epargneModel->getEpargneClient(
            $clientSession["id"],
        );
        return view("clients/epargne", [
            "client" => $clientSession,
            "valeurEpargne" => $valeurEpargne,
        ]);
    }

    public function validerEpargne()
    {
        $clientSession = session()->get("client");
        $epargneValue = $this->request->getPost("epargne");
        $data = [
            "telephone" => $clientSession["telephone"],
            "nom" => $clientSession["nom"],
            "epargne" => $epargneValue,
        ];
        $this->clientModel->update($clientSession["id"], $data);
        return redirect()->to("/clients/epargne");
    }
}
?>
