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

include_once  __DIR__ . "/../utils/init.php";

print_r($_POST);
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
        include_once __DIR__ . "/afficher_form_new_utilisateur_ctl.php";
        exit;
    }

    // preparation des données