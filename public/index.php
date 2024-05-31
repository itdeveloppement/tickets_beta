<?php

include '../app/utils/init.php';
// include '../app/views/main/page_accueil_client_view.php';

try {
$test = new TestClasse();
}
// exception car la classe n'est pas trouvé
catch (classNotExist $exception) {   
    // message utilisateur
    include '../app/views/error/errTechnique.php';
    exit;
}
// ne capture pas les fatal error
catch (Exception $exception) {
    // message utilisateur
   include '../app/views/error/errTechnique.php';
   exit;
}

 $test->affichageTest();