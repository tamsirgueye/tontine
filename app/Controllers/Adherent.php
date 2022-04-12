<?php

namespace App\Controllers;
use App\Models\AdherentModel;
use App\Models\CotiseModel;
use App\Models\EcheanceModel;
use App\Models\ParticipeModel;
use App\Models\TontineModel;
use CodeIgniter\I18n\Time;

helper(['html', 'form']);
class Adherent extends BaseController
{
    public function index()
    {
        $data = [
            "titre" => "Sama Tontine::Accueil adherent",
            "menuActif" => "adherentAcc"
        ];
        $model = new TontineModel();
        $idAdherent = session()->get('id');
        $listeTontineResp = $model->listeTontineResp($idAdherent);
        $listeTontineAdh = $model->listeTontineAdherent($idAdherent);
        $data["listeTontineResp"] = $listeTontineResp;
        $data["listeTontineAdh"] = $listeTontineAdh;
        echo view("layout/entete", $data);
        echo view("adherent/index");
        echo view("layout/pied");
    }

    public function ajouterTontine()
    {
        $data = [
            "titre" => "Sama Tontine::Accueil adherent",
            "menuActif" => "adherentAcc"
        ];
        $data["periodicite"] = ["mensuelle" => "mensuelle", "hebdomadaire" => "hebdomadaire"];
        $data["nbEcheance"] = [1 => 1,2,3,4,5,6,7,8,9,10,11,12];
        if($this->request->getMethod()=="post")
        {
            $reglesValid = [
                "libelle" => [
                    "rules" => "required",
                    "errors" => ["required" => "Libelle de la tontine obligatoire"]
                ],
                "periodicite" => [
                    "rules" => "required",
                    "errors" => ["required" => "Périodicité obligatoire"]
                ],
                "dateDeb" => [
                    "rules" => "required|valid_date[d/m/Y]",
                    "errors" => [
                        "required" => "Date de débit obligatoire",
                        "valid_date" => "Date non valide"
                    ]
                ],
                "nbEcheance" => [
                    "rules" => "required",
                    "errors" => ["required" => "nbEcheance obligatoire"]
                ]
            ];
            if(!$this->validate($reglesValid))
            {
                $data["validation"] = $this->validator;
            }
            else
            {
                $dateDeb = Time::createFromFormat("d/m/Y", $this->request->getPost("dateDeb"));
                $tontineData = [
                    "libelle" => $this->request->getPost("libelle"),
                    "periodicite" => $this->request->getPost("periodicite"),
                    "dateDeb" => $dateDeb->format("Y/m/d"),
                    "nbEcheance" => $this->request->getPost("nbEcheance"),
                    "idResponsable" => session()->get("id")
                ];
                $tontine = new TontineModel();
                $tontine->insert($tontineData);
                $session = session();
                $session->setFlashdata('successAjTontine', 'Tontine ajoutée avec succès');
                return redirect()->to('adherent');
            }
        }
        echo view("layout/entete", $data);
        echo view("adherent/ajoutTontine");
        echo view("layout/pied");
    }

    public function modifierTontine($idTontine)
    {
        $data = [
            "titre" => "Sama Tontine::Accueil adherent",
            "menuActif" => "adherentAcc"
        ];
        $data["periodicite"] = ["mensuelle" => "mensuelle", "hebdomadaire" => "hebdomadaire"];
        $data["nbEcheance"] = [1 => 1,2,3,4,5,6,7,8,9,10,11,12];
        $tontine = new TontineModel();
        if($this->request->getMethod()=="post")
        {
            $reglesValid = [
                "libelle" => [
                    "rules" => "required",
                    "errors" => ["required" => "Libelle de la tontine obligatoire"]
                ],
                "periodicite" => [
                    "rules" => "required",
                    "errors" => ["required" => "Périodicité obligatoire"]
                ],
                "dateDeb" => [
                    "rules" => "required|valid_date[d/m/Y]",
                    "errors" => [
                        "required" => "Date de débit obligatoire",
                        "valid_date" => "Date non valide"
                    ]
                ],
                "nbEcheance" => [
                    "rules" => "required",
                    "errors" => ["required" => "nbEcheance obligatoire"]
                ]
            ];
            if(!$this->validate($reglesValid))
            {
                $data["validation"] = $this->validator;
            }
            else
            {
                $dateDeb = Time::createFromFormat("d/m/Y", $this->request->getPost("dateDeb"));
                $tontineData = [
                    "id" => $this->request->getPost("id"),
                    "libelle" => $this->request->getPost("libelle"),
                    "periodicite" => $this->request->getPost("periodicite"),
                    "dateDeb" => $dateDeb->format("Y/m/d"),
                    "nbEcheance" => $this->request->getPost("nbEcheance"),
                    "idResponsable" => session()->get("id")
                ];
                $tontine = new TontineModel();
                $tontine->save($tontineData);
                $session = session();
                $session->setFlashdata('successAjTontine', 'Tontine modifiée avec succès');
                return redirect()->to('adherent');
            }
        }
        else
        {
            $maTontine = $tontine->tontine($idTontine);
            $dateDeb = Time::createFromFormat("Y-m-d", $maTontine['dateDeb']);
            $maTontine["dateDeb"] = $dateDeb->format('d/m/Y');
            $data['tontine'] = $maTontine;
        }
        echo view("layout/entete", $data);
        echo view("adherent/modificationTontine");
        echo view("layout/pied");
    }

    public function supprimerTontine($idTontine)
    {
        $tontine = new TontineModel();
        $tontine->delete($idTontine);
        $session = session();
        $session->setFlashdata('successAjTontine', 'Suppression effectuée');
        return redirect()->to('adherent');
    }

    public function tontine($idTontine)
    {
        $data = [
            "titre" => "Sama Tontine::Accueil adherent",
            "menuActif" => "adherentAcc"
        ];
        $model = new TontineModel();
        $maTontine = $model->tontine($idTontine);
        $modelAd = new AdherentModel();
        $participants = $modelAd->participer($idTontine);
        $cotisations = $modelAd->cotiser($idTontine);
        $data["maTontine"] = $maTontine;
        $data["participants"] = $participants;
        $data["cotisations"] = $cotisations;
        $modelEcheance = new EcheanceModel();
        $echeances = $modelEcheance->echeancesTontine($idTontine);
        $data["echeances"] = $echeances;
        echo view("layout/entete", $data);
        echo view("adherent/tontine");
        echo view("layout/pied");
    }

    public function adhesion()
    {
        $data = [
            "titre" => "Sama Tontine::Accueil adherent",
            "menuActif" => "adhesion"
        ];
        $idAdherent = session()->get('id');
        $model = new TontineModel();
        $listeTontines = $model->listeTontines($idAdherent);
        $data["listeTontines"] = $listeTontines;
        echo view("layout/entete", $data);
        echo view("adherent/adhesion");
        echo view("layout/pied");
    }

    public function adhererTontine($idTontine)
    {
        $data = [
            "titre" => "Sama Tontine::Accueil adherent",
            "menuActif" => "adherentAcc"
        ];
        if($this->request->getMethod()=="post")
        {
            $reglesValid = [
                "montant" => [
                    "rules" => "required|integer",
                    "errors" => [
                        "required" => "Le montant est obligatoire",
                        "integer" => "Le montant doit être un nombre"
                    ]
                ]
            ];
            if(!$this->validate($reglesValid))
            {
                $data["validation"] = $this->validator;
            }
            else
            {
                $participeData = [
                    "idTontine" => $this->request->getPost('idTontine'),
                    "montant" => $this->request->getPost('montant'),
                    "idAdherent" => session()->get('id')
                ];
                $participe = new ParticipeModel;
                $participe->insert($participeData);
                $session = session();
                $session->setFlashdata('successAjAdhesion', 'Adhesion effectuée');
                return redirect()->to('adherent/adhesion');
            }
        }
        else
        {
            $data["idTontine"] = $idTontine;
        }
        echo view("layout/entete", $data);
        echo view("adherent/ajoutAdhesion");
        echo view("layout/pied");
    }

    public function genererEcheance($idTontine)
    {
        $model = new TontineModel();
        $maTontine = $model->tontine($idTontine);
        $tabEcheance = [];
        $dateDeb = Time::createFromFormat('Y-m-d', $maTontine["dateDeb"]);
        for ($i=1; $i<=$maTontine["nbEcheance"]; $i++) {
            $tabEcheance[] = ['date' => $dateDeb->toDateString(), 'numero' => $i, 'idTontine' => $idTontine];
            if ($maTontine["periodicite"] == "mensuelle")
                $dateDeb = $dateDeb->addMonths(1);
            else
                $dateDeb = $dateDeb->addDays(7);
        }
        $modelEcheance = new EcheanceModel();
        $nbInserer = $modelEcheance->generer($tabEcheance);
        $session = session();
        $session->setFlashdata('successAjEcheance', $nbInserer . ' échéances ajoutées');
        return redirect()->to("adherent/tontine/$idTontine");
    }

    public function payerEcheance($idAdherent, $idTontine, $idEcheance)
    {
        $modelCotise = new CotiseModel();
        $modelCotise->insert(["idAdherent" => $idAdherent, "idEcheance" => $idEcheance]);
        $session = session();
        $session->setFlashdata('successAjCotise', 'Cotisation enregistrée');
        return redirect()->to("adherent/tontine/$idTontine");
    }
}