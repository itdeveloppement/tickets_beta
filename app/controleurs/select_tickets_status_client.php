<?php 
/**
 * role : slectionner la liste des tickets a repondre pour un client
 * @param : 
 */

use App\Modeles\Ticket;
use App\Services\Button;
use App\Services\Droits;
use App\Services\Form;

include_once  __DIR__ . "/../Utils/init.php";

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

// selectionner la liste des tickets pour le client courent
// header('Content-Type: application/json');
$tickets = new Ticket();
$data1 = $tickets->selectListTicketsClientRepondre($session->getIdConnected());

$json = json_encode($data1);
echo $json;
