<?php
/**
 * Role : vgestion des dientifiant et des mots de passe
 * 
 */

 class ConnexionPwd extends _model {

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
public function connexionValide($log, $pwd) {
    $listePersonnages = $this->listAll();
    foreach ($listePersonnages as $personnage => $values) {
        $logPersonnage = $values->get("pseudo");
        $passwordPersonnage = $values->get("password");
        // vrification concordance
        if (($logPersonnage==$log) && (password_verify($pwd, $passwordPersonnage))) {
            $session = new ConnexionSes(); 
            $session->connect($personnage);
            return true;
        }   
    }
    return false;
    }
 }

