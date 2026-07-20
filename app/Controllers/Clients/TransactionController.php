<?php

namespace App\Controllers\Clients;

use App\Controllers\BaseController;
use App\Models\Clients\ClientModel;

class TransactionController extends BaseController
{
    private ClientModel $clientModel;

    public function __construct()
    {
        $this->clientModel = new ClientModel();
    }

    public function index()
    {
        return view("clients/transaction");
    }

    public function store()
    {
        $montant = $this->request->getPost("montant");
        $code_secret = $this->request->getPost("code_secret");

        $client = session()->get("client");
        $clientId = $client['id'];
        $clientDepot = $this->clientModel->find($clientId);

        if (!$client) {
            return redirect()->to("/clients");
        }

        if ($code_secret != $clientDepot->code_secret) {
            return redirect()
                ->back()
                ->withInput()
                ->with("error", "Code secret incorrect");
        }

        return redirect()->back()->with("success", "Dépôt effectué");
    }
}
