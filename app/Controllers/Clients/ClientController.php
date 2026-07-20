<?php
namespace App\Controllers\Clients;

use App\Controllers\BaseController;
use App\Models\Clients\ClientModel;

class ClientController extends BaseController
{
    private ClientModel $clientModel;
    public function __construct()
    {
        $this->clientModel = new ClientModel();
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
            return view("clients/dashboard", [
                "client" => $client,
            ]);
        } else {
            return view("clients/login", [
                "error" => "Vérifiez votre code secret et votre numéro de téléphone",
            ]);
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to("/clients");
    }
}
?>
