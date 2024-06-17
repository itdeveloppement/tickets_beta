<?php
/**
 * role : inserer les donner d'un nouveau utilisateur en bdd
 * param : POST
 *  nom
 *  prenom
 *  status
 *  etat
 *  email
 *  password
 */

use App\Modeles\Utilisateur;
use App\Services\Button;
use App\Services\Droits;
use App\Services\Form;

include_once  __DIR__ . "/../Utils/init.php";

// verification si je suis connecté
if (! $session->isConnected()) {
    $form=new Form();
    $button = new Button();
     include __DIR__ . "/../views/main/form_connexion_view.php";
     exit;
 }
 
 // verification des droits
 // si l'utilisateur n'a pas les droit
 $droit = new Droits();
 if (! $droit->verifierDroits($session->getStatusSession())) {
     include __DIR__ . "/../views/error/err403.tpl.php";
 }

// verification des données POST

if (
    ! empty($_POST["nom"]) && 
    ! empty($_POST["prenom"]) && 
    ! empty ($_POST["status"]) &&
    ! empty ($_POST["etat"]) &&
    ! empty ($_POST["email"]) &&
    ! empty ($_POST["password"])
    ){

    } else {
        include __DIR__ . "/afficher_form_new_utilisateur_ctl.php";
        exit;
    }

    // preparation des données
    $_POST["created_date"] =  date("Y-m-d H:i:s");
    $_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // insertion des données
    $personnage = new Utilisateur();
    if ($personnage->loadFromTab($_POST)){
        $personnage->insert();
        $form=new Form();
        $button = new Button();
        include __DIR__ . "/../views/main/form_connexion_view.php";
    } else {
        include __DIR__ . "/afficher_form_insert_utilisateur_ctl.php";
        exit;
    }