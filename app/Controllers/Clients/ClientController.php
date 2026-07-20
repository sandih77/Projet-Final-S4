<?php

namespace App\Controllers\Clients;

use App\Models\Operateurs\OperationsModel;

use App\Controllers\BaseController;
use App\Models\Clients\ClientModel;

class ClientController extends BaseController
{
    private ClientModel $clientModel;
    private OperationsModel $operationModel;
    public function __construct()
    {
        $this->clientModel = new ClientModel();
        $this->operationModel = new OperationsModel();
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
        return redirect()->to("/clients");
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
}
?>
