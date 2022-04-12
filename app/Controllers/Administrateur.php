<?php

namespace App\Controllers;
use App\Models\ParticipeModel;
use App\Models\TontineModel;

helper("html");
class Administrateur extends BaseController
{
    public function index()
    {
        $data = [
            "titre" => "Sama tontine::Espace d'administration",
            "menuActif" => "adminAcc",
        ];
        $model = new TontineModel();
        $participeModel = new ParticipeModel();
        $nbTontine = $model->countAll();
        $nbParticipe = $participeModel->countAll();
        $listeParticipant = $model->listeParticipantTontine();
        $data["nbTontine"] = $nbTontine;
        $data["nbParticipe"] = $nbParticipe;
        $data["listeParticipant"] = $listeParticipant;
        echo view("layout/entete", $data);
        echo view("administrateur/index");
        echo view("layout/pied");
    }
}