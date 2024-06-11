<?php
/**
 * Role : vgestion des dientifiant et des mots de passe
 * 
 */

 namespace App\Services;
 
use App\Modeles\Utilisateur;
use App\Services\ConnexionSes;
use App\Modeles\Model;

 class ConnexionPwd extends Model{

//attributs
protected $log;
protected $pwd;

public function __construct($log, $pwd) {
    $this->log = $log;
    $this->pwd = $pwd;

}

// --------------------- PASSWORD LOGIN -------------------------------
/**
 * Rôle : verifie le login et le password de connexion d'un utilisateur
* @param {string} $log: la valeur de l'identifiant de connexion passé en POST
* @param {string} $password : la valeur du password passé en POST
* @return si connecté id de l'utilisateur sinon null
*/
public function connexionValide() {
    $listeUtilisateurs = new Utilisateur ();
    $utilisateurs = $listeUtilisateurs->listAll();

    foreach ($utilisateurs as $utilisateur => $values) {
        $logUtilisateur = $values->get("email");
        $passwordUtilisateur = $values->get("password");

        // vrification concordance
        if (($logUtilisateur==$this->log) && (password_verify($this->pwd, $passwordUtilisateur))) { 
            return $utilisateur;
        }   
    }
    return null;
    }
 }

