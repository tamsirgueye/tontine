<?php
namespace App\Validation;
use App\Models\AdherentModel;

class UtilisateurRules
{
    public function utilisateurValide(string $str, string $fields, array $data): bool
    {
        $model = new AdherentModel();
        $user = $model
            ->where('login', $data['login'])
            ->where('motPasse', $data['motPasse'])
            ->first();
        return (bool)$user;
    }
}