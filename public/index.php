<?php
/**
 * role : organise l'affichage de la page d'accueil en fonction :
 *      du status de l'utilisateur et du droit d'acces aux pages
 *      de la connexion de la session ou pas
 *
 * param : POST
 *      identifiant
 *      password
 */

use App\Modeles\Utilisateur;
use App\Services\ConnexionSes;

 include_once  __DIR__ . "/../App/Utils/init.php";

 $utilisateur = new Utilisateur ();

 // verifier si la session existe 
    // en fonction du status affiche la page d'accueil
    if  (ConnexionSes::isConnected()) {
        $status = $utilisateur->droits();
        if($status->verifierDroits($_SESSION["status"])) {
            $page = $utilisateur->routerAccueil();
            $page->routerAcc (ConnexionSes::getIdConnected());
        } else {
            include __DIR__ . "/../App/views/error/err404.tpl.php";
        }

    // sinon verifier la connexion paswword
    // renseigne la session avec l'id et le status
    // en fonction du status affiche la page d'accueil
    } else if ((isset($_POST["email"]) && isset($_POST["password"]))) {
    
        // recuperation et controle des données POST
        $log = $_POST["email"];
        $password = $_POST["password"];

        // validation password et idt
        $test = $utilisateur->connexionValideUtilisateur($log, $password);

        // connexion et rensegnement session id et du status
        $utilisateur = new Utilisateur(ConnexionSes::getIdConnected());
        
        // routage pour ouverture page en fonction du status
        $status = $utilisateur->droits();

    if($status->verifierDroits(ConnexionSes::getStatusSession())) {
        $page = $utilisateur->routerAccueil();
        $page->routerAcc (ConnexionSes::getIdConnected());
    } else {
        include __DIR__ . "/../App/views/error/err404.tpl.php";
    }
    
    // sinon affiche le formulaire de connexion
    } else {
        $form = $utilisateur->form();
        $button = $utilisateur->button();
        include __DIR__ . "/../App/views/main/form_connexion_view.php";
    }




