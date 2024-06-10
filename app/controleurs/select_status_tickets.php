<?php 
/**
 * role : selectionner la liste de tous les tickets d’un meme status
 * @param : le status du ticket
 */

use App\Services\ConnexionSes;

 // verification si je suis connecté
 if ( ! ConnexionSes::isConnected()) {
    include __DIR__ . "../views/main/form_connexion_view.php";
    exit;
}
 // traitement des données get
 if (isset($_GET['status'])) {
    $status = $_POST['status'];
 } else {
    include __DIR__ . "../views/main/accueil_technicien_view.php";
    exit;
 }

// recuperation de la liste des tickets
$tickets = $ticket->selectListeStatusTickets($status);
$json = json_encode($tickets);
echo $json;
