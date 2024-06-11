<?php
/**
 * role : affficher la page d'affichage des message d'un ticket et y repondre
 */

include_once  __DIR__ . "/../Utils/init.php";

if (! $session->isConnected()) {
include __DIR__ . "/../views/main/form_connexion_view.php";
exit;
}
// affichage page messages
include __DIR__ . "/../views/main/form_repondre_message_view.php";
