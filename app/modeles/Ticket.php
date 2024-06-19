<?php
/**
 * Role : classe pour la gestion des tickets
 * 
 * Methodes :
 *
 */

namespace App\Modeles;

use App\Modeles\Model;
use App\Services\ConnexionBdd;
use App\Utils\Date;
use PDO;

class Ticket extends Model{

    // attributs
    protected $table = "ticket";
    protected $fields = [
        "titre",
        "status",
        "client",
        "produit",
        "created_date"
    ];

    protected $links = [
        'client' => 'App\Modeles\Utilisateur',
        'produit' => 'App\Modeles\Produit'
    ];  

// ------ METHODES DE SELECTION DANS LA BDD ----------------

/**
 * role : récupérer tous les tickets ayant le meme status
 * @param : status
 * @return : tableu d'objet de la liste des tickets indexé par l'id des tickets
 */
public function selectListeStatusTickets($status) {

    // recuperation des tickets pour un status
    $result = $this->listAllCondition("status", $status);
  
    // construction du tableau de données
    $data = [];
    foreach($result as $key => $objet) {
        $tab = [];
        $tab ["titre"]= $objet->get("titre");
        $tab ["status"]= $this->status ($objet->get("status"));
        $date = new Date ();
        $tab ["created_date"]= $date->dateShort($objet->get("created_date")) ;
    
        // recuperation des nom et prenom des cLient pour chaque ticket
        $nameClient = $this->clientTicket($key);
        $tab ["nom"]= $nameClient["nom"];
        $tab ["prenom"]= $nameClient["prenom"];

        // recuperation de la desigantion du produit
        $designationProduit = $this->produitTicket($key);
        $tab ["designation"]= $designationProduit["designation"];
        $data [$key] = $tab;
   };
   return $data ;
}

/**
 * role : récupérer les caracteristique d'un ticket
 * @param : id du ticket
 * @return : tableu des caracteristique du ticket
 */
public function detailTicket($id) {
    // recuperation des tickets pour un status
    $this->load($id);
  
    // construction du tableau de données
        $tab = [];
        $tab["id"] = $id;
        $tab ["titre"]= $this->get("titre");
        $tab ["status"]= $this->status($this->get("status"));
        $date = new Date ();
        $tab ["created_date"]= $date->dateShort($this->get("created_date")) ;
    
        // recuperation des nom et prenom du cient pour le ticket
        $nameClient = $this->clientTicket($id);
        $tab ["nom"]= $nameClient["nom"];
        $tab ["prenom"]= $nameClient["prenom"];

        // recuperation de la desigantion du produit
        $designationProduit = $this->produitTicket($id);
        $tab ["designation"]= $designationProduit["designation"];
   return $tab ;
}

/**
 * Role : selectionner dans la base de donnée le nom et le prenom d'un client d'un ticket
 * @param : $id du ticket
 * @return : l'objet à l'id passé en argument
 */
public function clientTicket($id) {
    // concstruction de la requette sql avec jointure
    $sql = "SELECT utilisateur.nom, utilisateur.prenom FROM ticket JOIN utilisateur ON ticket.client = utilisateur.id WHERE ticket.id = :id";

    // tableau des parametres
    $param = [ ":id" => $id];

    // Préparer / exécuter
    $bdd = ConnexionBdd::connexion();
   
    $req = $bdd->prepare($sql);
    if ( ! $req->execute($param)) {
        // On a une erreur de requête (on peut afficher des messages en phase de debug)
        echo "erreur de requette";
        return false;
    }
    // On s'assure que l'on a trouvé une ligne
    $listeExtraite = $req->fetch(PDO::FETCH_ASSOC);
    
    // chargement de l'objet courent
    // On récupère le premier (et seul) élément
   
    return $listeExtraite;
}

/**
 * Role : selectionner dans la base de donnée le nom du produit pour un ticket
 * @param : $id du ticket
 * @return : l'objet à l'id passé en argument
 */
public function produitTicket ($id) {
    // concstruction de la requette sql avec jointure
    $sql = "SELECT produit.designation FROM ticket JOIN produit ON ticket.produit = produit.id WHERE ticket.id = :id";

    // tableau des parametres
    $param = [ ":id" => $id];

    // Préparer / exécuter
    $bdd = ConnexionBdd::connexion();
   
    $req = $bdd->prepare($sql);
    if ( ! $req->execute($param)) {
        // On a une erreur de requête (on peut afficher des messages en phase de debug)
        echo "erreur de requette";
        return false;
    }
    // On s'assure que l'on a trouvé une ligne
    $listeExtraite = $req->fetch(PDO::FETCH_ASSOC);
    
    // chargement de l'objet courent
    // On récupère le premier (et seul) élément
   
    return $listeExtraite;
}
/**
 * role : selectionne la liste des tickets d'un client
 * @param : id du client
 * @return : un tableau des tickets
 */
function selectListTickets($id) {
    // recuperer les donnée
    $tickets = $this->listAllCondition("client", $id);
     // construction du tableau de données
    $data = [];
    foreach($tickets as     $key => $ticket) {
        $tab ["titre"]= $ticket->get("titre");
        $tab ["status"]= $this->status ($ticket->get("status"));
        $date = new Date ();
        $tab ["created_date"]= $date->dateShort($ticket->get("created_date")) ;
        
        // recuperation de la desigantion du produit
        $designationProduit = $this->produitTicket($key);
        $tab ["designation"]= $designationProduit["designation"];
        $data [$key] = $tab;
    }
    return $data;
}
/**
 * role : selectionne la liste des tickets ouvert d'un client dont le dernier message n'est pas celui du client
 * @param : id du client
 * @return : tableau des id des tickets
 */
function selectListTicketsClient($id) {

    $sql = "SELECT ticket FROM `message` JOIN ticket ON message.ticket = ticket.id
            WHERE ticket.client = :id 
                AND message.redacteur <> :id 
                AND message.created_date = (SELECT MAX(m2.created_date)FROM `message` AS m2 WHERE m2.ticket = message.ticket)
            ";

    $param = [":id"=>$id];

    // Préparer / exécuter
    $bdd = ConnexionBdd::connexion();
    $req = $bdd->prepare($sql);
    if ( ! $req->execute($param)) {
        // On a une erreur de requête (on peut afficher des messages en phase de debug)
        echo "erreur de requette";
        return false;
    }
  
    $listeExtraite = $req->fetchAll(PDO::FETCH_ASSOC);
    // construire le tableau des resutat
    $tabTicketsClient = [];
    foreach($listeExtraite as $value) {
        $tabTicketsClient[] = $value["ticket"];
    }
   return $tabTicketsClient;      
}

/**
 * role : retourner la liste des tickets d'un client seon un tableau d'id de ticket
 * @param : l'id du client
 * @return : tableau des caracteristiques des tickets indexé par l'id des tickets
 */
function selectListTicketsClientRepondre($id) {
    $tab=$this->selectListTicketsClient($id);
    $result = [];
    foreach($tab as $value) {
        $ticket = $this->detailTicket($value);
        if($ticket["status"] == "Ouvert") { 
        $result[$ticket["id"]] = $ticket;
    }
    }
    return $result;
}
// ----------- METHODE DE TRAITEMENT DES DONNEES

/**
 * role : afficher le status sans abreviation
 * ex : OUV devient Ouvert
 * @param : status sous vorme de chaine de caractere
 * @return : status sous forme de chaine de cracatere
 */
public function status ($status) {
    if ($status=="OUV") {
        return "Ouvert";
    } else if ($status=="ENC") {
        return "En cours";
    } else if ($status=="RES") {
        return "resolut";
    }
}

}
