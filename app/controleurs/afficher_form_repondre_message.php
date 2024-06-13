<?php
/**
 * role : affficher la page d'affichage des message d'un ticket et y repondre
 */

use App\Services\Droits;

include_once  __DIR__ . "/../Utils/init.php";

// verification session connecté
if (! $session->isConnected()) {
include __DIR__ . "/../views/main/form_connexion_view.php";
exit;
}

// verification des droits
// si l'utilisateur n'a pas les droit
$droit = new Droits();
if (! $droit->verifierDroits($session->getStatusSession())) {
    include __DIR__ . "/../App/views/error/err403.tpl.php";
    // sinon routage sur la page d'accueil en fonction du status
}

// traitement des données GET
if (isset($_GET['id'])) {
    $id=$_GET['id'];
}

// affichage page messages
include __DIR__ . "/../views/main/form_repondre_message_view.php";
