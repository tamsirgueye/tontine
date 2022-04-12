<?php

namespace App\Models;

use CodeIgniter\Model;

class TontineModel extends Model
{
    protected $table = "tontine";
    protected $allowedFields = ["libelle","periodicite","dateDeb","nbEcheance","idResponsable"];

    function listeTontineResp($idAdherent)
    {
        return $this
            ->where('idResponsable', $idAdherent)
            ->findAll();
    }

    function tontine($idTontine)
    {
        return $this
            ->where('id', $idTontine)
            ->first();
    }

    function listeTontines($idAdherent)
    {
        $listPart = $this
            ->builder('participe')
            ->distinct()
            ->select('idTontine')
            ->where('idAdherent', $idAdherent)
            ->get()->getResultArray();
        $idTon = [];
        foreach ($listPart as $tp)
            $idTon[] = $tp["idTontine"];
        if($idTon)
            $this->whereNotIn("id", $idTon);
        return $this->findAll();
    }

    function listeTontineAdherent($idAdherent)
    {
        return $this
            ->select('libelle, periodicite, dateDeb, nbEcheance')
            ->selectSum('p.montant', 'montant')
            ->join('participe p', 'p.idTontine=tontine.id')
            ->join('cotise c', 'c.idAdherent=p.idAdherent')
            ->join('echeance e', 'e.idTontine=tontine.id')
            ->groupBy("tontine.id")
            ->where('idResponsable', $idAdherent)
            ->where('c.idEcheance=e.id')
            ->get()->getResultArray();
    }

    function listeParticipantTontine()
    {
        return $this
            ->select('count(p.idTontine) nbp, libelle')
            ->join('participe p', 'p.idTontine=id')
            ->groupBy('p.idTontine')
            ->get()->getResultArray();
    }
}