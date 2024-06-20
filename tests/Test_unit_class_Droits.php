<?php
/**
 * role tester fonction php class droits
 */
// echo"entrée dans le test OK";

use App\Services\Droits;

include_once  __DIR__ . "/../App/Utils/init.php";

// classe ticket
$droit = new Droits();
// variables
$status = "CLI";

print_r($droit->verifierDroits($status));