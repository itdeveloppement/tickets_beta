<?php
/**
 * role : affficher le formulaire des parametres de modification des paramtres de connection
 */

use App\Services\Button;
use App\Services\Droits;
use App\Services\Form;

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

 echo "en cour de dev : controleur afficher formulaire de modification des info de connexion";