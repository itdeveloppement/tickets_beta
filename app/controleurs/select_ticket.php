<?php 
/**
 * role : selectionner un ticket
 * @param : id du ticket
 */

use App\Modeles\Ticket;

include_once  __DIR__ . "/../Utils/init.php";
$_GET['id'] = 1;
 // verification si je suis connecté
 if ( ! $session->isConnected()) {
    include __DIR__ . "/../views/main/form_connexion_view.php";
    exit;
}

 // traitement des données get
 if (isset($_GET['id'])) {
    $id = $_GET['id'];
 } else {
    include __DIR__ . "/../views/main/accueil_technicien_view.php";
    exit;
 }
 // echo "test";
 // recuperation donnée et encodage json
 
 $ticket = new Ticket();
 $ticket->detailTicket($id);

 $json = json_encode($ticket->detailTicket($id));
 echo $json;
