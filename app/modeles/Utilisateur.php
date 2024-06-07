<?php
/**
 * role : caracteristique d'un personnage (client / vendeur / technicien)
 */

 class Utilisateur extends Model {

    // attributs
 protected $table = "utilisateur";
 protected $fields = [
    "status",
    "etat",
    "nom",
    "prenom",
    "email",
    "password",
    "created_date"
 ];
    

 // -------- INSTANCIATION DES CLASSES ---------------

/** role : instentie la classe ConnexionPwd
 * @param : 
 *    le log (identifiant) de connexion
 *    le password
 * @return : nothing
 */
public function connexionValideUtilisateur ($log, $password) {
   $connexion = new ConnexionPwd($log, $password);
   $connexion->connexionValide();
 }

/** role : instentie la classe RouterAccueil
 * @param : nothing
 * @return : une instance vide
 */
 public function routerAccueil () {
   $routerAccueil = new RouterAccueil();
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