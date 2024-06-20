<?php

/**
 * role : deconnecter la session
 *
 */

use App\Services\Button;
use App\Services\Droits;
use App\Services\Form;

require_once  __DIR__ . "/../Utils/init.php";

$form=new Form();
$button = new Button();

// verification session connecté
if (! $session->isConnected()) {
    include __DIR__ . "/../views/main/form_connexion_view.php";
    exit;
}

// verification des droits
$droit = new Droits();
if (! $droit->verifierDroits($session->getStatusSession())) {
    $session->deconnect();
    include __DIR__ . "/../views/error/err403.tpl.php";
    exit;
}

 $session->deconnect();
 require_once  __DIR__ . "/../views/main/form_connexion_view.php";
