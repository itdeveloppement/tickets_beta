<?php
/**
 * role tester fonction php
 */
// echo"entrée dans le test OK";

use App\Modeles\Utilisateur;

include_once  __DIR__ . "/../App/Utils/init.php";

$utilisateur = new Utilisateur(4);
$string = "la";

// fonction recherche un client
// print_r($utilisateur->selectListeClient($string));

// test load
// $result = $utilisateur->load(4);
print_r($utilisateur);