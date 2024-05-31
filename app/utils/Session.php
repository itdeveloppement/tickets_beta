<?php

/*
RAISONNEMENT -----------------------------
si la connexion d'un utilisateur (password et log ok) est validé, l'id de l'utilisateur est renseigner dans la super globale $_SESSION (dans la methode personnage)

a chaque debut de script on appel activation() (ds l'init)
- via session_start() il est initialisé une session (ou une reprise de session) avec une vérification de l'identifiant de session.
- si un utilisateur est connecté il est crée un objet utilisateur connecté à l'id transmis dans la session (un personnage)

*/

/**
 * calsse : personnage
 * role : gere  la session
 */
class session {

protected $utilisateurConnecte;

/**
 * Role : active le mecanisme de session, en activant la fonction native session_start()
 * @param : neant
 * @return : true si on est connecté, sinon false
 * note : si un utilisateur est connecté, il existe un id, isConnected return true, un objet "perssonageConnecté" à l'id trouvé est instancier, on retourn true, sinon on n'est pas connecté et on retourne false
 */
public function activation () {
    session_start();

    // si l'utilisateur est conecté
    if ($this->isConnected()){
        global $utilisateurConnecte;
        $utilisateurConnecte = new Utilisateur ($this->getIdConnected());
        // si l'utilsateur n'esxiste plus, on force la deconnexion
        if (!$utilisateurConnecte->is()) {
            $this->deconnect();
        }
    }
    // retour si on est connecté ou pas
    return $this->isConnected();
}

/**
 * Role : verifi si la session est connectée
 * @param : neant
 * @return : si la session est connectée return true, sion false 
 */
public function isConnected () {
    return !empty($_SESSION["id"]) ? true : false;
}

/**
 * role : retourne l'id de la session connecté
 * @param : neant
 * @return : si session connecté retourne l'id de la session sion retour 0
 */
public function getIdConnected () {
return $this->isConnected() ? $_SESSION["id"] : 0;
}

/**
 * role : deconnecté la session
 * @param : neant
 * @return : true
 */
public function deconnect() {
    $_SESSION["id"] = 0;
}

function getUserConnected() {
    // Rôle : donné l'objet correspondant à l'utilisateur connecté
    // Paramètres : néant
    // Retour : un objet de la calsse qui gère les utilisateurs de l'appli

    if ($this->isConnected()) {
        global $utilisateurConnecte;
        return $utilisateurConnecte;
    } else {
        return new Utilisateur();
    }


 }


/** JE NE COMPREND PAS POURQUOI ON DEFINIT CETTE METHODE
 * role : retourne l'objet de l'utilisateur connecté
 * @param : neant
 * @return : si session connecté retourne l'id de la session sion retour 0
 */
/*
public function getUserConnected() {
    if ($this->isConnected()) {
        return $this->utilisateurConnecte;
    } else {
        return new personnage();
    }
}
*/
}

