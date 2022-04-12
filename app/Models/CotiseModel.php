<?php

namespace App\Models;

use CodeIgniter\Model;

class CotiseModel extends Model
{
    protected $table = "cotise";
    protected $allowedFields = ["idAdherent", "idEcheance"];
}