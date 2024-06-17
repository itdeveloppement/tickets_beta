<?php
/**
 * role : caracteristique d'un personnage (client / vendeur / technicien)
 */

namespace App\Modeles;

use App\Modeles\Model;
use App\Services\Button;
use App\Services\ConnexionBdd;
use App\Services\Droits;
use App\Services\Form;
use App\Services\Router;
use PDO;

 class Utilisateur extends Model {

    // attributs
 protected $table = "utilisateur";
 protected $fields = [
    "status",
    "nom",
    "prenom",
    "email",
    "password",
    "created_date"
 ];

 protected $links = ['id' => 'Utilisateur'];  

 // -------------- recherche client et produit ------------

/**
 * role : selectionner une liste de client selon une chaine de caractere
 * @param : chaine de minimum 3 caracteres
 * @return : tableau des resultats limité à 5 selections
 */
 public function selectListeClient($string) {

  $sql = "SELECT * FROM utilisateur WHERE nom LIKE '%$string%' OR prenom LIKE '%$string%' OR email LIKE '%$string%' LIMIT 5";

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
  
  // chargement de l'objet courent
  // On récupère le premier (et seul) élément
 
  return $listeExtraite;
 }

 // -------- INSTANCIATION DES CLASSES ---------------

/** role : instentie la classe RouterAccueil
 * @param : nothing
 * @return : une instance vide
 */
 public function routerAccueil () {
   $routerAccueil = new Router();
   return $routerAccueil;
 }

/** role : instentie la classe Droits
 * @param : nothing
 * @return : une instance vide
 */
 public function droits () {
   $droits = new Droits();
   return $droits;
 }

/** role : instentie la classe Form
 * @param : nothing
 * @return : une instance vide
 */
 public function form () {
   $form = new Form();
   return $form;
 }

/** role : instentie la classe Button
 * @param : nothing
 * @return : une instance vide
 */
 public function button () {
   $button = new Button();
   return $button;
 }
 
}