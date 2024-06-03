<?php

// NOTION : affichage des erreur  ----------------------------------------
    // parametre l'affichage des erreurs
    // connexion à la base de donnée via PDO
    // charge le modele (classe) générique
    // charge les modeles (classes) specifiques
// ---------------------------------------------

// affichage des erreurs
ini_set("display_errors", 1);       // Aficher les erreurs
error_reporting(E_ALL);             // Toutes les erreurs

/* NOTION : exception --------------------------
Exception (condition exceptionnelle) : une exception est utilisée pour signaler une anomalie ou une erreur qui se produit pendant l'exécution d'un script.
Lever une exception : sigaler une anomalie, créer un objet exception et le transmettre au bloc catch. D'une magniere générale en appliquant la classe throw dans le try l'exception est lever et transmise au bloc catch.
Avec PDO la lever et la transmission de l'exception se fait sans appeller manuellmeent throw si le mode de gestion des erreurs approprié à l'aide de setAttribute()avec PDO::ATTR_ERRMODE est definie.
Le code dans le catch est executé ce qui permet de traiter l'exeption (affichage d'un message, enregistement des information de debugage, ou d'aures actions pour traiter les exceptions)
Si aucun catch n'est trouvé il se produit une erreur fatale

$exception->getMessage() : retourne le messssage associé
$exception-getCode() : retourne le code du message d'erreur
(voir sur mdn les autres retours possibles)
*/

// autochargement des classes (voir class autoload pour detail)
include __DIR__ . "/../modeles/autoload.php"; 
include __DIR__ . "/../modeles/classNotExist.php";

autoload::register();

/* connexion à la BDD (avec l'objet)
    ouvrir la base de donnée avec PDO dans la variable globale
    lever les exeptions avce PDO 
    Entrée dans le catch executer avec Throwable et executer un code si une exception est detecté
*/
// parametres de connexion :
$dsn = 'mysql:host=localhost;dbname=projets_tickets_mcastellano;charset=UTF8';
$userName = 'mcastellano';
$password = 'c8?kpn?s2q+Z';
$options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING];

global $bdd;
$bdd = connexion::connexionBdd($dsn, $userName, $password, $options);


// insertion des librairie diverse
include_once __DIR__ . "/../modeles/session.php";
// Activer le mécanisme de session
session::activation();

