<?php
/**
 * Role : classe pour la gestion des messages des tickets
 * 
 * Methodes :
 *
 */

namespace App\Modeles;

use App\Modeles\Model;
use App\Services\ConnexionBdd;
use App\Utils\Date;
use PDO;

class Message extends Model{

    // attributs
    protected $table = "message";
    protected $fields = [
        "ticket",
        "message",
        "redacteur",
        "created_date"
    ];

    // ------ METHODES DE SELECTION DANS LA BDD ----------------

    /**
     * role : selectionne dans la BDD les message d'un tickets
     * @param : id du ticket
     * @return : tableau de la liste des messages
     */
    function selectListeMessages($id) {
        // selectionner tous les messages d'un ticket et stockedans un tableau
        $listeMessages = $this->listAllCondition("ticket", $id);

        // selectionne pour chaque message le nom du redacteur et remplace l'id par le nom du redacteur
        // construction du tableau de données
    $data = [];
    foreach($listeMessages as $key => $objet) {
       
        $tab = [];
        $date = new Date ();
        $tab ["created_date"]= $date->dateShort($objet->get("created_date")) ;
        $tab ["message"]= $objet->get("message");
    
        // recuperation le nom du redacteur
        $nameClient = $this->redacteurMessage($key);
        $tab ["nom"]= $nameClient["nom"];
        $tab ["prenom"]= $nameClient["prenom"];

        $data [$key] = $tab;
   };
   return $data ;

    }

/**
 * Role : selectionner dans la base de donnée le nom et le prenom du redacteur d'un message
 * @param : nothing
 * @return : l'objet à l'id passé en argument
 */
public function redacteurMessage($id) {
    // construction de la requette sql avec jointure
    $sql = "SELECT utilisateur.nom, utilisateur.prenom FROM message JOIN utilisateur ON message.redacteur = utilisateur.id WHERE message.id = :id";

    /// tableau des parametres
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