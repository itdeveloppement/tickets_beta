<?php
/**
 * Role : vgestion des dientifiant et des mots de passe
 * 
 */

 class ConnexionPwd extends _model{

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
* @return true si connecté , sinon return false 
*/
public function connexionValide() {
    $listeUtilisateurs = new utilisateur ();
    $utilisateurs = $listeUtilisateurs->listAll();

    foreach ($utilisateurs as $utilisateur => $values) {
        $logUtilisateur = $values->get("email");
        $passwordUtilisateur = $values->get("password");
        $statusUtilisateur = $values->get("status");

        // vrification concordance
        if (($logUtilisateur==$this->log) && (password_verify($this->pwd, $passwordUtilisateur))) { 
            ConnexionSes::connect($utilisateur, );
            ConnexionSes::statusSessionConnect($statusUtilisateur);
            
            return true;
        }   
    }
    return false;
   
    }
 }

