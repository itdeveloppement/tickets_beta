<?php 
/**
 * role : selectionner un produit
 * @param : id du client
 */

use App\Modeles\Produit;
use App\Services\Button;
use App\Services\Droits;
use App\Services\Form;

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
