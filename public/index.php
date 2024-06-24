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

// use App\Modeles\Utilisateur;
use App\Services\ConnexionPwd;
use App\Services\Droits;
use App\Services\Form;
use App\Services\Router;

 include_once  __DIR__ . "/../App/Utils/init.php";

/*
 $utilisateur = new Utilisateur ();
 $droit = new Droits();
 $form=new Form();
 $button = new Form();

 // verifier si la session existe 
    // en fonction du status affiche la page d'accueil
    if  ($session->isConnected()) {
     
        // si l'utilisateur n'a pas les droit
        if (! $droit->verifierDroits($session->getStatusSession())) { 
            include __DIR__ . "/../App/views/main/form_connexion_view.php";
            exit;
        // sinon routage sur la page d'accueil en fonction du status
        } else {
            $router = new Router();
            $router->routerAcc($session->getStatusSession());
        }

    // sinon verifier la connexion paswword
    // renseigne la session avec l'id et le status
    // en fonction du status affiche la page d'accueil
    } else if ((isset($_POST["email"]) && isset($_POST["password"]))) {
    
        // recuperation et controle des données POST
        $log = $_POST["email"];
        $password = $_POST["password"];

        // CONNEXION
        // si les validation password et idt ne sont pas validé renvoyé sur page connexion
        $connexion = new ConnexionPwd($log, $password);
        if ($connexion->connexionValide() == null) {
            
            $session->deconnect();
            include __DIR__ . "/../App/views/main/form_connexion_view.php";
            exit;
        // sinon renseignier la session et instencier utilisateurconnecté
        } else {
            // verif password
            $session->connect($connexion->connexionValide());
            $session->statusSessionConnect($utilisateurConnecte->get("status"));
        }
        // DROIT
        // si l'utilisateur n'a pas les droit
        if (! $droit->verifierDroits($session->getStatusSession())) {
            $session->deconnect();
            include __DIR__ . "/../App/views/main/form_connexion_view.php";
            exit;
        // sinon routage sur la page d'accueil en fonction du status
        } else {
           
            $router = new Router();
            $router->routerAcc($session->getStatusSession());
           
        };

    // sinon afficher le formulaire de connexion
    } else {
        $form = $utilisateur->form();
        $button = $utilisateur->button();
        $session->deconnect();
        include __DIR__ . "/../App/views/main/form_connexion_view.php";
    }

*/


include __DIR__ . "/../App/views/main/accueil_mypizza_view.php";

