<?php

include '../app/utils/init.php';
// include '../app/views/main/page_accueil_client_view.php';

try {
$test = new TestClasse();
}
// exception car la classe n'est pas trouvé
catch (ClassNotExist $exception) {   
    // message utilisateur
    echo "La classe n'existe pas";
    include '../app/views/error/errTechnique.php';
    exit;
}
// ne capture pas les fatal error
catch (Exception $exception) {
    // message utilisateur
    echo "Erreur :" . $exception->getMessage();
   include '../app/views/error/errTechnique.php';
   exit;
}

 $test->affichageTest();