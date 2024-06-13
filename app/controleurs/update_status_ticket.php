<?php 
/**
 * role : modifier le status d'un ticket
 * @param : id du ticket
 */

use App\Modeles\Ticket;

include_once  __DIR__ . "/../Utils/init.php";

// verification si je suis connecté
if (! $session->isConnected()) {
    include __DIR__ . "/../views/main/form_connexion_view.php";
    exit;
}

// traitement des données get
if (isset($_GET['id'])) {
    $id = $_GET['id'];
 } else {
    // include __DIR__ . "/../views/main/accueil_technicien_view.php";
    exit;
 }

$ticket = new Ticket($id);
$ticket->set("status", "RES");
$ticket->update();
include __DIR__ . "/../views/main/accueil_technicien_view.php";
