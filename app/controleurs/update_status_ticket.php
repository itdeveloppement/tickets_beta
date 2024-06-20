<?php 
/**
 * role : modifier le status d'un ticket
 * @param : id du ticket
 */

use App\Modeles\Ticket;
use App\Services\Button;
use App\Services\Droits;
use App\Services\Form;
use App\Services\Router;

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
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
include __DIR__ . "/../views/main/accueil_technicien_view.php";
exit;
}

$ticket = new Ticket($id);
$ticket->set("status", "RES");
$ticket->update();

$router = new Router ();
$router->routerAcc($session->getStatusSession());
// include __DIR__ . "/../views/main/accueil_technicien_view.php";
