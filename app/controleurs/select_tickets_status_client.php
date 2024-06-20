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

// selectionner la liste des tickets pour le client courent
// header('Content-Type: application/json');
$tickets = new Ticket();

$data = $tickets->selectListTicketsClientRepondre($session->getIdConnected());

    $json = json_encode($data);


echo $json;
