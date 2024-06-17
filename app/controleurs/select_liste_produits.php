<?php 
/**
 * role : selectionne une liste de produits
 * @param : 
 */

use App\Modeles\Produit;
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

// traitement des données
if (! isset($_POST['string'])) {
    $_POST['string'] = '';
} 
if ($string = $_POST['string']);

$produits = new Produit();
$result = $produits->selectListeProduits($string);

$json = json_encode($result);
echo $json;

