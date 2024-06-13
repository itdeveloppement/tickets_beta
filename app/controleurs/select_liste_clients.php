<?php 
/**
 * role : selectionne une liste de client
 * @param : 
 */

use App\Modeles\Utilisateur;

include_once  __DIR__ . "/../Utils/init.php";

// verification si je suis connecté
if (! $session->isConnected()) {
    include __DIR__ . "/../views/main/form_connexion_view.php";
    exit;
}

// traitement des données
if (! isset($_POST['string'])) {
    $_POST['string'] = '';
} 
if ($string = $_POST['string']);

$utilisateur = new Utilisateur();
$result = $utilisateur->selectListeClient($string);

$json = json_encode($result);
echo $json;

