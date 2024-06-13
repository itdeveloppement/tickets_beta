<?php
/**
 * role : affficher la page pour renseignier une vente
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
    include __DIR__ . "/../views/error/err403.tpl.php";
    exit;
    // sinon routage sur la page d'accueil en fonction du status
}



// affichage page enregistrer une vente
include __DIR__ . "/../views/main/form_insert_vente_view.php";