<?php

/**
 * role : deconnecter la session
 *
 */

use App\Services\Button;
use App\Services\Droits;
use App\Services\Form;

require_once  __DIR__ . "/../Utils/init.php";
 
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

 $session->deconnect();
 $form=new Form();
 $button = new Button();
 require_once  __DIR__ . "/../views/main/form_connexion_view.php";
