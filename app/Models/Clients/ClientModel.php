<?php

namespace App\Models\Clients;

use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table = "clients";
    protected $primaryKey = "id";
    protected $allowedFields = ["nom", "telephone", "code_secret", "epargne"];
    protected $returnType = "object";

    protected $validationRules = [
        "telephone" =>
            'required|regex_match[/^(032|033|034|037|038)[0-9]{7}$/]',
        "code_secret" => 'required|regex_match[/^[0-9]{4}$/]',
    ];

    protected $validationMessages = [
        "telephone" => [
            "required" => "Le numéro de téléphone est requis",
            "regex_match" =>
                "Le numéro de téléphone doit commencer par 032, 033, 034, 037 ou 038",
        ],
        "code_secret" => [
            "required" => "Le code secret est requis",
            "regex_match" => "Le code secret doit contenir 4 chiffres",
        ],
    ];

    public function findByCodeSecretAndTelephone($code_secret, $telephone)
    {
        return $this->where("code_secret", $code_secret)
            ->where("telephone", $telephone)
            ->first();
    }

    public function getClientByTelephone($telephone)
    {
        return $this->where("telephone", $telephone)->first();
    }
}
