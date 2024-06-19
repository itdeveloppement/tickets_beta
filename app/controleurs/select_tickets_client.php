<?php 
/**
 * role : slectionner la liste des tickets du client en cours
 * @param : 
 */

use App\Modeles\Ticket;
use App\Services\Button;
use App\Services\Droits;
use App\Services\Form;

include_once  __DIR__ . "/../Utils/init.php";

// verification si je suis connecté
if (! $session->isConnected()) {
    $form=new Form();
    $button = new Button();
    include __DIR__ . "/../views/main/form_connexion_view.php";
    exit;
}

// verification des droits
// si l'utilisateur n'a pas les droit
$droit = new Droits();
if (! $droit->verifierDroits($session->getStatusSession())) {
    include __DIR__ . "/../views/error/err403.tpl.php";
}

// selectionner la liste des tickets d'un client ouvert et dont le dernier message n'est pas celui du client

$tickets = new Ticket();
$data = $tickets->selectListTickets($session->getIdConnected());

$json = json_encode($data);
echo $json;
