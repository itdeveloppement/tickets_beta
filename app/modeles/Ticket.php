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

    protected $links = ['client' => 'Ticket'];  

// ------ METHODES DE SELECTION DANS LA BDD ----------------

/**
 * role : récupérer tous les tickets ayant le meme status
 * @param : status
 * @return : tableu d'objet de la liste des tickets indexé par l'i des tickets
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
    
        // recuperation des nom et prenom des cient pour chaque ticket
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
        $tab ["status"]= $this->get("status");
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
public function clientTicket ($id) {
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
