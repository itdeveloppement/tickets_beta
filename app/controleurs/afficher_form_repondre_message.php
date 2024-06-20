<?php
/**
 * role : affficher la page d'affichage des message d'un ticket et y repondre
 */

use App\Services\Button;
use App\Services\Droits;
use App\Services\Form;

include_once  __DIR__ . "/../Utils/init.php";

$form=new Form();
$button = new Button();

// verification session connecté
if (! $session->isConnected()) {
    include __DIR__ . "/../views/main/form_connexion_view.php";
    exit;
}

// verification des droits
// si l'utilisateur n'a pas les droit
$droit = new Droits();
if (! $droit->verifierDroits($session->getStatusSession())) {
    $session->deconnect();
    include __DIR__ . "/../views/error/err403.tpl.php";
}

// traitement des données GET
if (isset($_GET['id'])) {
    $id=$_GET['id'];
}

// affichage page messages
include __DIR__ . "/../views/main/form_repondre_message_view.php";
