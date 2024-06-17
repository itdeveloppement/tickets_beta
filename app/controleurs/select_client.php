<?php 
/**
 * role : selectionner un client
 * @param : id du client
 */

use App\Modeles\Utilisateur;
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
 $utilisateur = new Utilisateur($id);
 // preparation des données

 // print_r($utilisateur);
 $data = [ 
    'status' => $utilisateur->get('status'),
    'etat' => $utilisateur->get('etat'),
    'nom' => $utilisateur->get('nom'),
    'prenom' => $utilisateur->get('prenom'),
    'email' => $utilisateur->get('email'),
    'created_date' => $utilisateur->get('created_date')
];

 $json = json_encode($data);
 echo $json;

