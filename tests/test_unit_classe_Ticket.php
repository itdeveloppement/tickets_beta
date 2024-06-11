<?php
/**
 * role tester fonction php
 */
// echo"entrée dans le test OK";

use App\Modeles\Ticket;

include_once  __DIR__ . "/../App/Utils/init.php";

// classe ticket
$ticket = new Ticket ();
    
// variable
$status = "OUV";
$id = 1;

    // liste des tickets selon un status
    print_r($ticket->selectListeStatusTickets($status));

    // select en bdd designation d'un produit
    print_r($ticket->produitTicket($id));


