<?php 
/**
 * role : selectionner la liste de tous les tickets d’un meme status
 * @param : le status du ticket
 */

use App\Modeles\Message;

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
    include __DIR__ . "/../views/main/accueil_technicien_view.php";
    exit;
 }

 // recuperation donnée et encodage json
 $liste = new Message();
 $listeMessages = $liste->selectListeMessages($id);

 $json = json_encode($listeMessages);
 echo $json;

