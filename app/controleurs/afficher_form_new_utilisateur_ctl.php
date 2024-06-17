<?php
/**
 * role : affficher la page de creation d'un nouveau utilisateur
 */

use App\Services\Form;
use App\Services\Button;
use App\Services\Droits;

 include_once  __DIR__ . "/../Utils/init.php";

// verification session connecté
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
$form=new Form();
$button = new Button();
include __DIR__ . "/../views/main/form_insert_new_utilisateur.view.php";

