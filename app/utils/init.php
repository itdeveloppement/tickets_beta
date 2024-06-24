<?php

use App\Services\ConnexionSes;
use App\Services\Autoload;

// echo"test entrée fichier utils";

// NOTION : affichage des erreur  ----------------------------------------
    // parametre l'affichage des erreurs
    // connexion à la base de donnée via PDO
    // charge le modele (classe) générique
    // charge les modeles (classes) specifiques
// ---------------------------------------------

// affichage des erreurs
ini_set("display_errors", 1);       // Aficher les erreurs
error_reporting(E_ALL);             // Toutes les erreurs

// autochargement des classes (voir class autoload pour detail)
include __DIR__ . "/../Services/Autoload.php"; 
include __DIR__ . "/../Utils/ClassNotExist.php";
Autoload::register();

// insertion des librairie diverse
include_once __DIR__ . "/../Services/ConnexionSes.php";

// Activer le mécanisme de session
$session = new ConnexionSes();
$session->activation();

// generer l'URL dynmiquement

// Définition si protocole http ou https
    // verifier si un protocole est plein et affcter http ou https
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

// Construction de l'URL avec le protocole
    // stockage dans BASE_URL
define('BASE_URL', $protocol . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . '/');


