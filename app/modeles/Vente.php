<?php
/**
 * Role : classe pour la gestion des ventes
 * 
 * Methodes :
 *
 */

namespace App\Modeles;

use App\Modeles\Model;
use App\Services\ConnexionBdd;
use App\Utils\Date;
use PDO;

class Vente extends Model{

    // attributs
    protected $table = "vente";
    protected $fields = [
        "client",
        "num_serie",
        "date_vente",
        "produit",
        "created_date"
    ];

    protected $links = [ "client" => "utilisateur"];
}