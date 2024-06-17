<?php 
/**
 * role : selectionner un ticket
 * @param : id du ticket
 */

use App\Modeles\Ticket;
use App\Services\Button;
use App\Services\Form;

include_once  __DIR__ . "/../Utils/init.php";

 // verification si je suis connecté
 if (! $session->isConnected()) {
   $form=new Form();
   $button = new Button();
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

 // recuperation donnée et encodage json
 $ticket = new Ticket();
 $ticket->detailTicket($id);

 $json = json_encode($ticket->detailTicket($id));
 echo $json;
