<?php

/**
 * role : deconnecter la session
 *
 */

use App\Services\Button;
use App\Services\Form;

require_once  __DIR__ . "/../Utils/init.php";
 
 
 $session->deconnect();
 $form=new Form();
 $button = new Button();
 require_once  __DIR__ . "/../views/main/form_connexion_view.php";
