<?php
/**
 * role : affficher la page pour renseignier une vente
 */

use App\Services\Droits;
use App\Services\Form;

include_once  __DIR__ . "/../Utils/init.php";

$form=new Form();
$button = new Form();
// verification session connecté
if (! $session->isConnected()) {
include __DIR__ . "/../views/main/form_connexion_view.php";
exit;
}

// verification des droits
// si l'utilisateur n'a pas les droit
$droit = new Droits();
if (! $droit->verifierDroits($session->getStatusSession())){
    $session->deconnect();
    include __DIR__ . "/../views/error/err403.tpl.php";
    exit;
}



// affichage page enregistrer une vente
include __DIR__ . "/../views/main/form_insert_vente_view.php";