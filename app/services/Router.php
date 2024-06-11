<?php




/**
 * Role : route la page d'accueil en fonction du status
 */


 namespace App\Services;

use App\Modeles\Model;
use App\Services\ConnexionSes;
use App\Services\Form;
use App\Services\Button;
use App\Services\Link;


class Router extends Model {

/** role : afficher la page d'accueil en fonction du status
 * @param : id de l'utilisateur connecté
 * @return : nothing
 */
public function routerAcc ($status) {
    $form = new Form();
    $button = new Button();
    $link = new Link();

    // $utilisateur = new Utilisateur($id);
    // $status = $utilisateur->get("status"); // A MODIFIER SUR LA SESSION
    if ($status == "CLI") {
        include __DIR__ . "/../views/main/accueil_client_view.php";
        exit;
    } else if ($status == "VEN") {
            include __DIR__ . "/../views/main/accueil_vendeur_view.php";
            exit;
        } else if ($status == "TEC") {
            include __DIR__ . "/../views/main/accueil_technicien_view.php";
            exit;
        }
    }
}

