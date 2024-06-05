<?php
/**
 * role test controleur
 */
// echo"entrée dans le test OK";
include "../app/utils/init.php";


// test class Droits
$utilisateur = new Utilisateur();
$utilisateur->load(1);

ConnexionSes::connect(1);
// print_r($_SESSION);

$droits = new Droits();
$droits->verifierDroits(ConnexionSes::getIdConnected());
