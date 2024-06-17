<?php
/**
 * role : inserer les donner d'une vente en bdd
 * param : POST
 *  date de vente
 *  numero de serie du produit
 */

use App\Modeles\Vente;
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

/*
// traitement des données get
if (isset($_GET['idClient'])) {
    $_POST["idClient"] = $_GET['idClient'];
    $_POST["idProduit"] = $_GET['idProduit'];

 } else {
    include __DIR__ . "/../views/main/accueil_technicien_view.php";
    exit;
 }
*/
// verification des données POST
if ( 
    ! empty($_POST["client"]) && 
    ! empty($_POST["produit"]) && 
    ! empty($_POST["num_serie"]) && 
    ! empty($_POST["date_vente"])
   
    ){
    $_POST["created_date"] = date("Y-m-d H:i:s");
  
    } else {
        include __DIR__ . "/afficher_form_insert_vente.php";
        exit;
    }

    // insertion des données
    $vente = new Vente();
    if ($vente->loadFromTab($_POST)){
        $vente->insert();
        include __DIR__ . "/../views/main/accueil_vendeur_view.php";
    } else {
        include __DIR__ . "/afficher_form_insert_vente.php";
        exit;
    }