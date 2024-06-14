<?php
/**
 * role tester fonction php
 */
// echo"entrée dans le test OK";

use App\Modeles\Vente;

include_once  __DIR__ . "/../App/Utils/init.php";

// classe ticket
$vente = new Vente ();
    
// variable
$_POST = [];
$_POST["client"] = "2";
$_POST["produit"] = "1";
$_POST["num_serie"]= "ffff";
$_POST["date_vente"] = "2024-06-05";
$_POST["created_date"] = date("Y-m-d H:i:s");

if ($vente->loadFromTab($_POST)){
    $vente->insert();
    include __DIR__ . "/../views/main/accueil_vendeur_view.php";
}

