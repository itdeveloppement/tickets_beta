<?php
/**
 * role tester fonction php
 */
// echo"entrée dans le test OK";

use App\Modeles\Ticket;

include_once  __DIR__ . "/../App/Utils/init.php";

$ticket = new Ticket ();

$status = "OUV";
$tickets = $ticket->selectListeStatusTickets($status);

print_r($tickets);

// print_r($ticket->get("client"));
