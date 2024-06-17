<?php 
/**
 * role : selectionner la liste de tous les tickets d’un meme status
 * @param : le status du ticket
 */

use App\Modeles\Ticket;
use App\Services\Droits;

include_once  __DIR__ . "/../Utils/init.php";
/*
 // verification si je suis connecté
 if ( ! ConnexionSes::isConnected()) {
    include __DIR__ . "/../views/main/form_connexion_view.php";
    exit;
}
*/

 // traitement des données get
 if (isset($_GET['status'])) {
    $status = $_GET['status'];
 } else {
    include __DIR__ . "/../views/main/accueil_technicien_view.php";
    exit;
 }


// verification des droits
// si l'utilisateur n'a pas les droit
$droit = new Droits();
if (! $droit->verifierDroits($session->getStatusSession())) {
   include __DIR__ . "/../views/error/err403.tpl.php";
}

// recuperation de la liste des tickets
$ticket = new Ticket();
$tickets = $ticket->selectListeStatusTickets($status);

$json = json_encode($tickets);
echo $json;

