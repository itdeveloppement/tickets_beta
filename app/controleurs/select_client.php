<?php 
/**
 * role : selectionner un client
 * @param : id du client
 */

use App\Modeles\Utilisateur;

include_once  __DIR__ . "/../Utils/init.php";
/*
 // verification si je suis connecté
 if (! $session->isConnected()) {
    include __DIR__ . "/../views/main/form_connexion_view.php";
    exit;
}
*/
 // traitement des données get
 if (isset($_GET['id'])) {
    $id = $_GET['id'];
 } else {
    include __DIR__ . "/../views/main/accueil_technicien_view.php";
    exit;
 }

 // recuperation donnée et encodage json
 $utilisateur = new Utilisateur(4);
 // preparation des données

 // print_r($utilisateur);
 $data = [ 
    'status' => $utilisateur->get('status'),
    'etat' => $utilisateur->get('etat'),
    'nom' => $utilisateur->get('nom'),
    'email' => $utilisateur->get('email'),
    'created_date' => $utilisateur->get('created_date')
];

 $json = json_encode($data);
 echo $json;

