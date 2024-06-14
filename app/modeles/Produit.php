<?php
/**
 * Role : classe pour la gestion des produits
 * 
 * Methodes :
 *
 */

namespace App\Modeles;

use App\Modeles\Model;
use App\Services\ConnexionBdd;
use App\Utils\Date;
use PDO;

class Produit extends Model{

    // attributs
    protected $table = "produit";
    protected $fields = [
        "status",
        "ref",
        "designation",
        "created_date"
    ];


// -------------- recherche client et produit ------------

/**
 * role : selectionner une liste de produit selon une chaine de caractere recherchée
 *  @param : chaine de minimum 3 caracteres
 * @return : tableau des resultats limité à 5 selections 
 */
public function selectListeProduits($string) {
    $sql = "SELECT * FROM produit WHERE `status` LIKE '%$string%' OR ref LIKE '%$string%' OR designation LIKE '%$string%' LIMIT 5";
  

    // Préparer / exécuter
    $bdd = ConnexionBdd::connexion();
     
    $req = $bdd->prepare($sql);
    if ( ! $req->execute()) {
        // On a une erreur de requête (on peut afficher des messages en phase de debug)
        echo "erreur de requette";
        return false;
    }
    // On s'assure que l'on a trouvé une ligne
    $listeExtraite = $req->fetchAll(PDO::FETCH_ASSOC);
  
    return $listeExtraite;
   }

}