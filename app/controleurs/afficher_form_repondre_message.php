<?php
/**
 * role : affficher la page d'affichage des message d'un ticket et y repondre
 */

include_once  __DIR__ . "/../Utils/init.php";

if (! $session->isConnected()) {
include __DIR__ . "/../views/main/form_connexion_view.php";
exit;
}

// traitement des données GET
if (isset($_GET['id'])) {
    $id=$_GET['id'];
}
print_r($id);

// recupere id du tickets
// construire le detail d'un ticket
// construire la liste des meaasge
// construire la reponse à un message

// affichage page messages
include __DIR__ . "/../views/main/form_repondre_message_view.php";
