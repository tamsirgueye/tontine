<?php

namespace App\Controllers;
helper('html');
class Home extends BaseController
{
    public function index()
    {
        $data = [
            "titre" => "Sama tontine::Faciliter la gestion des tontines",
            "menuActif" => "accueil",
        ];
        echo view('layout/entete', $data);
        echo view('welcome_message');
        echo view('layout/pied');
    }

    public function presentation()
    {
        $data = [
            "titre" => "Sama tontine::Qui sommes-nous ?",
            "menuActif" => "quisommesnous",
        ];
        echo view('layout/entete', $data);
        echo view('presentation');
        echo view('layout/pied');
    }

    public function contact()
    {
        $data = [
            "titre" => "Sama tontine::Contactez nous!",
            "menuActif" => "quisommesnous",
        ];
        echo view('layout/entete', $data);
        echo view('contact');
        echo view('layout/pied');
    }
}
