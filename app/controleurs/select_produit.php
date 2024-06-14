<?php 
/**
 * role : selectionner un produit
 * @param : id du client
 */

use App\Modeles\Produit;

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
 $utilisateur = new Produit($id);
 // preparation des données

 // print_r($utilisateur);
 $data = [ 
    'ref' => $utilisateur->get('ref'),
    'designation' => $utilisateur->get('designation'),
];

 $json = json_encode($data);
 echo $json;
