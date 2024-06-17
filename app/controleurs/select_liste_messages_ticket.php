<?php 
/**
 * role : selectionner la liste de tous les tickets d’un meme status
 * @param : le status du ticket
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

 // recuperation donnée et encodage json
 $liste = new Message();
 $listeMessages = $liste->selectListeMessages($id);

 $json = json_encode($listeMessages);
 echo $json;

