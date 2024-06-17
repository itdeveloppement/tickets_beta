<?php
/**
 * role : inserer un nouveau message d'un ticket en bdd
 * param : POST
 *  message
 * param GET :
 *  id du ticket
 */

use App\Modeles\Message;
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

// traitement des données get
 if (isset($_GET['id'])) {
    $id = $_GET['id'];
 } else {
    include __DIR__ . "/../views/main/accueil_technicien_view.php";
    exit;
 }

 // traitement des données
if (isset($_POST['message'])) {
   $texte = $_POST['message'];
 } else {
    include __DIR__ . "/../views/main/accueil_technicien_view.php";
    exit;
 }

$message = new Message();
// preparation des données
$message->set("ticket", $id);
$message->set("message", $texte);
$message->set("redacteur", $session->getIdConnected());
$message->set("created_date", date('Y-m-d H:i:s'));

// insertion en bdd
if(! $message->insert()) {
    include __DIR__ . "/../views/error/err403.tpl.php";
};

// retourne la liste des messages
$listeMessages = $message->selectListeMessages($id);

 $json = json_encode($listeMessages);
 echo $json;
