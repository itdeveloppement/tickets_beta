<?php
/**
 * role tester fonction php
 */
// echo"entrée dans le test OK";

use App\Utils\Date;

include_once  __DIR__ . "/../App/Utils/init.php";

// classe ticket
$date = new Date ();
$dateOrigine = "2024 06 11 14 30 00";

// short date
print_r($date->dateShort($dateOrigine));