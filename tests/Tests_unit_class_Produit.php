<?php
/**
 * role tester fonction php
 */
// echo"entrée dans le test OK";

use App\Modeles\Produit;

include_once  __DIR__ . "/../App/Utils/init.php";

// classe ticket
$produit = new Produit ();
    
// variable
$status = "OUV";
$string = "ecr";

print_r($produit->selectListeProduits($string));

