<?php 
/**
 * role : selectionner la liste de tous les tickets d’un meme status
 * @param : le status du ticket
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

 // traitement des données get
 if (isset($_GET['status'])) {
    $status = $_GET['status'];
 } else {
    include __DIR__ . "/../views/main/accueil_technicien_view.php";
    exit;
 }

// recuperation de la liste des tickets
$ticket = new Ticket();
$tickets = $ticket->selectListeStatusTickets($status);

$json = json_encode($tickets);
echo $json;

