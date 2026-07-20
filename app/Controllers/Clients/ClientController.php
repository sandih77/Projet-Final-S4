<?php
namespace App\Controllers\Clients;

use App\Controllers\BaseController;

class ClientController extends BaseController
{
    public function index()
    {
        return view('clients/index');
    }
}
?>
