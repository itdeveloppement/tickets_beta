<?php
/**
 * role : affficher la page de creation d'un nouveau utilisateur
 */

use App\Services\Form;
use App\Services\Button;

 include_once  __DIR__ . "/../Utils/init.php";

$form = new Form();
$button = new Button();

include __DIR__ . "/../views/main/form_insert_new_utilisateur.view.php";

