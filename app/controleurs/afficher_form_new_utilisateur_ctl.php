<?php
/**
 * role : affficher la page de creation d'un nouveau utilisateur
 */

 include_once  __DIR__ . "/../utils/init.php";

$form = new Form();
$button = new Button();

include __DIR__ . "/../views/main/form_insert_new_utilisateur.view.php";

