<?php
/**
 * role : se connecter à la base de données
 * 
 * attributs
 *  $userName : nom d'utilisateur
 *  $password : password de connexion à la base
 *  $dns : chaine e connexion selon le type de base de données
 *  $option : tableau associatif pour gerer notamant les erreurs et exception
 *  $bdd : stock l'objet PDO
 * 
 * methode
 *  connexionBdd() : connexion à la bdd
 *  deconnexionBdd() : deconnexion à la bdd
 */

class connexion {

// attributs
protected static $dsn;
protected static $userName;
protected static $password;
protected static $options;
protected static $bdd;

/** Role : connecter la base de donnée
 * @param : 
 *  $userName : nom d'utilisateur
 *  $password : password de connexion à la base
 *  $dns : chaine e connexion selon le type de base de données
 *  $option : tableau associatif pour gerer notamant les erreurs et exception
 * @return : l'objet de connexion ou l'erreur d'exception 
 */
public static function connexionBdd($dsn, $userName, $password, $options = []) {
    try 
    { 
    self::$bdd = new PDO ($dsn, $userName, $password, $options); 
    self::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return self::$bdd;
    }
    catch (PDOException $exception ) {
    // include "app/controleurs/index.php"
    echo "Erreur de connexion à la BDD : " . $exception->getMessage() . "Code message : " . $exception->getCode();;
}
}

/** role : deconnecte la connexion a la base de donnees
 * @param : neant
 * @return : nothing
 */
public static function deconnexionBDD() {
    self::$bdd = null;
}


}