<?php

namespace App\Controllers;
use App\Models\AdherentModel;

helper(['html', 'form']);
class Utilisateur extends BaseController
{
    public function index()
    {
        $data = [
            "titre" => "Sama tontine::Connexion",
            "menuActif" => "connexion",
        ];
        if($this->request->getMethod()=="post")
        {
            $reglesValid=[
                "login" => [
                    "rules" => "required|min_length[3]|max_length[50]|valid_email",
                    "errors" => [
                        "required" => "Email obligatoire",
                        "valid_email" => "Email non valide"
                    ]
                ],
                "motPasse" => [
                    "rules" => "required|min_length[3]|max_length[50]|utilisateurValide[login,motPasse]",
                    "errors" => [
                        "required" => "Mot de passe obligatoire",
                        "utilisateurValide" => "Email et/ou mot de passe incorrect(s)"
                    ]
                ],
            ];
            if(!$this->validate($reglesValid))
            {
                $data['validation']=$this->validator;
            }
            else
            {
                $model = new AdherentModel();
                $user = $model
                    ->where('login', $this->request->getPost('login'))
                    ->where('motPasse', $this->request->getPost('motPasse'))
                    ->first();
                $data = [
                    "id" => $user["id"],
                    "nom" => $user["nom"],
                    "prenom" => $user["prenom"],
                    "login" => $user["login"],
                    "profil" => $user["profil"]
                ];
                session()->set($data);
                return redirect()->to(base_url($user["profil"]));
            }
        }
        echo view('layout/entete', $data);
        echo view('utilisateur/index');
        echo view('layout/pied');
    }

    public function inscription()
    {
        $data = [
            "titre" => "Sama tontine::S'inscrire sur la plateforme",
            "menuActif" => "inscription",
        ];
        if($this->request->getMethod()=="post")
        {
            $reglesValid=[
                "nom" => [
                    "rules" => "required",
                    "errors" => [
                        "required" => "Le nom est obligatoire"
                    ]
                ],
                "prenom" => [
                    "rules" => "required",
                    "errors" => [
                        "required" => "Le Prénom est obligatoire"
                    ]
                ],
                "login" => [
                    "rules" => "required|min_length[6]",
                    "errors" => [
                        "required" => "Le login est obligatoire",
                        "min_length" => "Le login doit comporter au moins 6 caractères"
                    ]
                ],
                "motPasse" => [
                    "rules" => "required|min_length[6]",
                    "errors" => [
                        "required" => "Le mot de passe est obligatoire",
                        "min_length" => "Le mot de passe doit comporter au moins 6 caractères"
                    ]
                ],
                "motPasseConf" => [
                    "rules" => "required|matches[motPasse]",
                    "errors" => [
                        "required" => "Le confirmation est obligatoire",
                        "matches" => "La confirmation doit être identique au mot de passe"
                    ]
                ]
            ];
            if(!$this->validate($reglesValid))
            {
                $data["validation"]=$this->validator;
            }
            else {
                $adherentData = [
                    "nom" => $this->request->getPost('nom'),
                    "prenom" => $this->request->getPost('prenom'),
                    "login" => $this->request->getPost('login'),
                    "motPasse" => $this->request->getPost('motPasse'),
                    "profil" => "adherent"
                ];
                $adherent = new AdherentModel();
                $adherent->insert($adherentData);
                $session = session();
                $session->setFlashdata('success', 'Inscription réussie. Connectez-vous');
                return redirect()->to('utilisateur');
            }
        }
        echo view('layout/entete', $data);
        echo view('utilisateur/inscription', $data);
        echo view('layout/pied');
    }

    public function deconnexion()
    {
        session()->destroy();
        return redirect()->to('utilisateur/deconnexionMessage');
    }

    public function deconnexionMessage()
    {
        $session = session();
        $session->setFlashdata('success', 'Déconnexion réussie');
        return redirect()->to('utilisateur');
    }

    public function gestion()
    {
        $data = [
            "titre" => "Sama tontine::Gestion utilisateur",
            "menuActif" => "adminGestion",
        ];
        $modelAd = new AdherentModel();
        $listeUtilisateur = $modelAd->findAll();
        $data["listeUtilisateur"] = $listeUtilisateur;
        echo view("layout/entete", $data);
        echo view("utilisateur/gestion");
        echo view("layout/pied");
    }

    public function modifierPasse()
    {
        $data = [
            "titre" => "Sama tontine::Réinitialiser son mot de passe",
            "menuActif" => "adherentAcc",
        ];
        $modelAd = new AdherentModel();
        $utilisateur = $modelAd->find(session()->get("id"));
        if($this->request->getMethod()=="post")
        {
            $reglesValid = [
                "ancienMotPasse" => [
                    "rules" => "required|regex_match[/^" . $utilisateur["motPasse"] . "$/]",
                    "errors" => [
                        "required" => "L'ancien mot de passe est obligatoire",
                        "regex_match" => "Ce n'est pas le bon mot de passe"
                    ]
                ],
                "motPasse" => [
                    "rules" => "required|min_length[6]",
                    "errors" => [
                        "required" => "Le mot de passe est obligatoire",
                        "min_length" => "Le mot de passe doit comporter au moins 6 caractères"
                    ]
                ],
                "motPasseConf" => [
                    "rules" => "required|matches[motPasse]",
                    "errors" => [
                        "required" => "Le confirmation est obligatoire",
                        "matches" => "La confirmation doit être identique au mot de passe"
                    ]
                ]
            ];
            if(!$this->validate($reglesValid))
            {
                $data["validation"] = $this->validator;
            }
            else
            {
                $modelAd->update($utilisateur["id"], ["motPasse" => $this->request->getPost("motPasse")]);
                $session = session();
                $session->setFlashdata("successAjModifPasse", "Mot de passe modifié avec succès");
                return redirect()->to('utilisateur/profil');
            }
        }
        echo view("layout/entete", $data);
        echo view("utilisateur/modifierPasse");
        echo view("layout/pied");
    }

    public function profil()
    {
        $data = [
            "titre" => "Sama tontine::Profile: " . session()->get("prenom") . " " . session()->get("nom"),
            "menuActif" => "profil",
        ];
        $modelAd = new AdherentModel();
        $utilisateur = $modelAd->find(session()->get("id"));
        $data["utilisateur"] = $utilisateur;
        echo view("layout/entete", $data);
        echo view("utilisateur/profil");
        echo view("layout/pied");
    }
}
