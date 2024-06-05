<?php
/**
 * role : affficher la page de creation d'un nouveau utilisateur
 */

include_once "../utils/init.php";

$form = new Form();
$button = new Button();

include __DIR__ . "/../views/main/insert_new_utilisateur.view.php";

