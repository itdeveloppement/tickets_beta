<?php
/**
 * Role : classe generique pour le chargement, l'enregistremet, la mise à jour et la supression de données dans la base
 * 
 * Methodes :
 * load($id) : recupere pour un id son objet dans la base de données
 * insert() : insere un objet dans la base de données
 * update() : modifie un objet dans la base de données
 * delete () : suprimme un objet dans la base de données
 */

 namespace App\Modeles;

use App\Services\ConnexionBdd;
use PDO;

class Model {

    // Attributs
    protected $table; // la table de la bdd
    protected $fields = []; // liste des champs de la table ex : $fields = [ "nomChamp1", "nomChamp2", "nomChamp3" ... ]
    protected $values =[]; // valeur des champs ex : $value = [ "nomChamp1" => valeur1, ... ]
    protected $id = 0;

    protected $links = [];      
        // Liste des liens sortants : 
        //tableau qui pour cahque lien met en index le nom du champ qui est un lien, et en valeur le nom de l'objet
        //  (exemple : [ "fournisseur" => "fournisseur"])

    protected $targets = [];    // On stockera pour les liens [ "nomChamp" => objetLié, .. ]

// --------------------------------- CONSTRUCTEUR ------------------------

function __construct($id = null){
        //  Charger l'objet avec cet id
        if ( ! is_null($id)) {
            $this->load($id);
        }
}
    
// -------------------------------- GETTER ---------------------------------------------

/**
 * role : recuperer la valeur d'un attribut (champ de la base)
 * @param : le nom de l'attribut
 * @return : la valeur de l'attribut, ou chaine vide si l'attribut n'esxitse pas
 */

 /*
function get($fieldName) {
    if (isset($this->values[$fieldName])) {
        return $this->values[$fieldName];
    } else {
        return "";
    }
}
*/
function get($fieldName) {
    // Rôle : récupérer la valeur d'un attribut
    // Paramètres :
    //      $fieldName : nom de l'attribut
    // Retour : la valeur de l'attribut (chaine vide si l'attribut n'existe)

    // on va regarder si on a une méthode spécifique pour $fieldName
    if (method_exists($this, "get_$fieldName")) {
        $method = "get_$fieldName";
        return $this->$method();
    }

    // On a la valeur dans l'attribut values, à l'index qui a le même nom que l'attribut cherché
    // l'attribut values est accessible $this->values
    // l'index qui nous intéresse est dans $fieldName

    //  cad $this->values[$fieldName];

    // On contrôle que la valeur existe, sinon, on retourne ""
    if (isset($this->values[$fieldName])) {
        return $this->values[$fieldName];
    } else {
        return "";
    }

}

/**
 * role : recuperer l'id de l'objet courrent
 * @param : neant
 * @return : l'id de l'objet courent
 */
    function getId() {
        return $this->id;
    }


// -------------------- SETTERS ----------------------------------------------

/**
* role : changer ou initialiser la valeur de l'attribut
* @param : le nom de l'attribut ($fieldName) et sa valeur ($value)
* @return : true si ok, sinon false
*/
function set($fieldName, $value) {
    $this->values[$fieldName] = $value;
    return true;
}

/**
 * changer ou initialiser la valeurs des caracteristiques d'un objet à partir d'un tableau de données
 * @param : tableau d'objet de donnée valorisant les champs de la table
 * @return : true si ok, sinon false
 */
function loadFromTab($tab) {
    if (isset($tab["id"])) {
        $this->id = $tab["id"];
    }
    foreach($this->fields as $nomChamp) {
        if (!isset($this->values)) {
            $this->values = array();
        }
        $this->values[$nomChamp] = $tab[$nomChamp];    
    }
    return true;
}



// -------- VERFIER SI L OBJET EST CHARGE --------------------------------------------
 
/**
 * role vérifier si l'objet est deja chargé
 * @param : nothing
 * @return : true si l'objet est chargé sionon false
 */
function is() {
    return ! empty($this->id);      
}

// ----------------- SELECTIONNER UNE LISTE D OBJETS DANS LA BASE -----------------------

/**
 * role : selectionner une liste d'objet dans la base de données
 * @param : nothing
 * @return : liste d'objet (voir si c'est vraiment un tableau d'objet)
 */
function listAll() {
    $sql = "SELECT "; 
    // Construire la liste des champs encadrés par ` 
    // On met d'abord l'id
    $tableau = [ "`id`" ];
    foreach($this->fields as $type) {
        $tableau[] = "`$type`";
    }
    $sql .= implode(", ", $tableau);
    $sql .= " FROM `$this->table` ";
  
    // préparer / exécuter
    $bdd = ConnexionBdd::connexion();
    $req = $bdd->prepare($sql);
    if ( ! $req->execute()) {
        // Echec de la requête
        return [];
    }

    // Construire le tableau résultat ( à reprendre)
    $result = [];
    // tant que j'ai une ligne de résultat de la requête à lire
    while ($tabObject = $req->fetch(PDO::FETCH_ASSOC)) {
        // "transférer" $tabObject en objet de la classe courante
        // Récupération du nom de la classe de l'objet courant
        $classe = get_class($this);
        $obj = new $classe();
        // Charger l'objet
        $obj->loadFromtab($tabObject);
        // ON ajoute cela dans $result
        $result[$obj->getId()] = $obj;
    }
    return $result;
}


/**
 * role : selectionner une liste d'objet dans la base de données selon un champs et une valeur de champs
 * @param : champs et la valeur du champs
 * @return : liste d'objet (voir si c'est vraiment un tableau d'objet)
 */
function listAllCondition($field, $fieldValue) {
    $sql = "SELECT "; 
    // Construire la liste des champs encadrés par ` 
    // On met d'abord l'id
    $tableau = [ "`id`" ];
    foreach($this->fields as $type) {
        $tableau[] = "`$type`";
    }
    $sql .= implode(", ", $tableau);
    $sql .= " FROM `$this->table` ";
    $sql .= " WHERE `$field` = :$field"; 
  
     // tableau des parametres
     $param = [":$field" => $fieldValue];

    // préparer / exécuter
    $bdd = ConnexionBdd::connexion();
    $req = $bdd->prepare($sql);
    if ( ! $req->execute($param)) {
        // Echec de la requête
        return [];
    }

    // Construire le tableau résultat ( à reprendre)
    $result = [];
    // tant que j'ai une ligne de résultat de la requête à lire
    while ($tabObject = $req->fetch(PDO::FETCH_ASSOC)) {
        // "transférer" $tabObject en objet de la classe courante
        // Récupération du nom de la classe de l'objet courant

        // Récupère le nom complet de la classe avec le namespace
        $fullClassName = get_class($this); 

        $obj = new $fullClassName();
        // Charger l'objet
        $obj->loadFromtab($tabObject);
        // ON ajoute cela dans $result
        $result[$obj->getId()] = $obj;
    }
    
    return $result;
}

// ---- SELECTIONNER - SUPPRIMER - INSERER - MODFIER UN OBJET DANS LA BASE -------------
/**
 * Role : recuperer pour un id, l'objet dans la base de données
 * @param : id de l'objet
 * @return : l'objet à l'id passé en argument
 */
public function load($id) {
    // concstruction de la requette sql
    $sql = "SELECT " ;
        $tableau = [];
        foreach($this->fields as $nomChamp) {
            $tableau[] = "`$nomChamp`";
        }
        $sql .= implode(", ", $tableau);
        $sql .= " FROM `$this->table` ";
        $sql .= " WHERE `id` = :id"; 

        // tableau des parametres
        $param = [ ":id" => $id];

        // Préparer / exécuter
        $bdd = ConnexionBdd::connexion();
        $req = $bdd->prepare($sql);
        if ( ! $req->execute($param)) {
            // On a une erreur de requête (on peut afficher des messages en phase de debug)
            return false;
        }

    // On s'assure que l'on a trouvé une ligne
    $listeExtraite = $req->fetchAll(PDO::FETCH_ASSOC);
    // Si le tableau $liste est vide (0 elt), c'est qu'on a pas l'id cherché
    if (empty($listeExtraite)) {
        return false;
    }

    // chargement de l'objet courent
    // On récupère le premier (et seul) élément
    $tab = $listeExtraite[0];

    // Pour chaque champ de l'objet, on valorise $this->values[champ];
    foreach($this->fields as $nomChamp) {
        $this->values[$nomChamp] = $tab[$nomChamp];
    }

    // On renseigne l'id :
    $this->id = $id;

    return true;
}


/**
 * role : inserer un objet dans la base de données
 * @param : nothing
 * @return : true si réussi, false si échoué
 * exemple tableau param  : $param = [ ":nomChamp1" => valeurChamp1, ":nomChamp1" => valeurChamp2, ...]
 * exemple requette sql : INSERT INTO `nomDeLaTable` SET `nomChamp1` = :nomChamp1, `nomChamp2` = :nomChamp2, ...
 * ]
 */
function insert() {
    // creation du tableaude parametre ( a transformer ulterieurement en methode)
    $param = [];
        foreach($this->fields as $nomChamp) {
            // ajout de l'index
            $index = ":$nomChamp";          
            // ajout de la valeur si elle existe
            if (isset($this->values[$nomChamp])) {
                $param[$index] = $this->values[$nomChamp];
            } else {
                $param[$index] = null;
            }
        }
    // construction des champs de la requette : `nomChamp` = :nomChamp
    $champsRequette = [];
    foreach($this->fields as $nomChamp) {
        $champsRequette[] = "`$nomChamp` = :$nomChamp";
    }
    // construction de la requette
    $sql = "INSERT INTO `$this->table` SET " . implode(", ", $champsRequette);
    // On prépare la requête
    $bdd = ConnexionBdd::connexion();
 
    $req = $bdd->prepare($sql);
    if ( ! $req->execute($param)) {
        // Erreur sur la requête
        return false;
    }
    // enregistreùent de l'id généré avec la methode native lastInsertId
    $this->id = $bdd->lastInsertId();
    return true;
}


/**
 * role : modifier les caracteristiques d'un objet dans la base de données
 * @param : nothing
 * @return : true si la modification est réalisée, sinon false
 */
function update() {

    // creation du tableaude parametre ( a transformer ulterieurement en methode)
    $param = [];
        foreach($this->fields as $nomChamp) {
            // ajout de l'index
            $index = ":$nomChamp";          
            // ajout de la valeur si elle existe
            if (isset($this->values[$nomChamp])) {
                $param[$index] = $this->values[$nomChamp];
            } else {
                $param[$index] = null;
            }
    }
    // construction des champs de la requette : `nomChamp` = :nomChamp
    $champsRequette = [];
    foreach($this->fields as $nomChamp) {
        $champsRequette[] = "`$nomChamp` = :$nomChamp";
    }

    // construction de la requette
    $sql = "UPDATE  `$this->table` SET " . implode(", ", $champsRequette) . " WHERE `id` = :id ";
    // ajout de l'id dans le tableau param
    $param[":id"] = $this->id;
      
    // preparation etexecution requette
    $bdd = ConnexionBdd::connexion();
    $req = $bdd->prepare($sql);
    if ( ! $req->execute($param)) {
        // Erreur sur la requête
        return false;
    }
    return true;

}
/**
 * role : suprimer un objet dans laa base à l'id courrent
 * @param : nothing
 * @return : true si la supression est réalisée, sinon false
 */
function delete() {
    $sql = "DELETE FROM `$this->table` WHERE `id` = :id";
    $param = [":id" => $this->id];

    // preparation et execution requette
    $bdd = ConnexionBdd::connexion();
    $req = $bdd->prepare($sql);
    if ( ! $req->execute($param)) {
        // Erreur sur la requête
        return false;
    }
    // valoriser à 0 l'id dans l'objet courant pour indiquer la supression
    $this->id = 0;
    return true;
}

}
