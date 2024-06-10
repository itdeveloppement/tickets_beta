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

/**
 * role : récupérer tous les tickets ayant le meme status
 * @param : status
 * @return : tableu d'objet de la liste des tickets indexé par l'i des tickets
 */
public function selectListeStatusTickets($status) {

    // recuperation des ticket pour un status
    $result = $this->listAllCondition("status", $status);
  
    // construction du tableau de donnée
    $data = [];
    foreach($result as $key => $objet) {
        $tab = [];
        $tab ["titre"]= $objet->get("titre");
        $tab ["status"]= $objet->get("status");
        $tab ["created_date"]= $objet->get("created_date");
    
        // recuperation des nom et prenom des cient pour chaque ticket
        $nameClient = $this->clientTicket($key);
        $tab ["nom"]= $nameClient["nom"];
        $tab ["prenom"]= $nameClient["prenom"];

        $data [$key] = $tab;
   };
   return $data ;
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

}



