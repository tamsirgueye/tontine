<?php
namespace App\Models;
use CodeIgniter\Model;

class AdherentModel extends Model
{
    protected $table="adherent";
    protected $allowedFields=["nom","prenom","login","motPasse","profil"];

    function participer($idTontine)
    {
        return $this
            ->join("participe as p", "p.idAdherent=adherent.id")
            ->join("tontine as t", "t.id=p.idTontine")
            ->where("t.id", $idTontine)
            ->findAll();
    }

    function cotiser($idTontine)
    {
        $cotis = $this
            ->selectCount('adherent.id', 'nbCotis')
            ->select('adherent.id')
            ->join('cotise c', 'c.idAdherent=adherent.id')
            ->join('echeance e', 'e.id=c.idEcheance')
            ->where('e.idTontine', $idTontine)
            ->get()->getResultArray();
        $cotisations = [];
        foreach ($cotis as $coti)
            $cotisations[$coti["id"]] = $coti["nbCotis"];
        return $cotisations;
    }
}