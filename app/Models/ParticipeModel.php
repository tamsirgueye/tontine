<?php

namespace App\Models;

use CodeIgniter\Model;

class ParticipeModel extends Model
{
    protected $table = "participe";
    protected $allowedFields = ["idTontine", "idAdherent", "montant"];
}