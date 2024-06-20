<?php

/**
 * role : afiche la page accueil tech ou la page accueil vendeur
 * condition : 
 *      si status = vendeur afficher page accueil tech
 *      si status = technicien afficher page accueil vendeur
 */

use App\Services\Button;
use App\Services\Droits;
use App\Services\Form;

 include_once  __DIR__ . "/../Utils/init.php";

 /*
 si session = status TECH
 modifier status dans session à VEND
 afficher page accueil vendeur
 
 si session = statys VEND
 modifier status dans session à TECH
 afficher page accueil technicien
 */
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

//bascule vers vendeur
if ($session->getStatusSession()== "TEC") {
    $session->setStatusSession("VEN");
    include __DIR__ . "/../views/main/accueil_vendeur_view.php";
    //bascule vers technicien
} else if ($session->getStatusSession()== "VEN") {
    $session->setStatusSession("TEC");
    include __DIR__ . "/../views/main/accueil_technicien_view.php";
}