<?php
/**
 * role tester fonction php class message
 */
// echo"entrée dans le test OK";

use App\Modeles\Message;

include_once  __DIR__ . "/../App/Utils/init.php";

// classe ticket
$message = new Message();
// variables
$id = 1;
// test fonction selectListeMessages($id)
print_r($message->selectListeMessages($id));

// test redacteur message
print_r($message->redacteurMessage($id));