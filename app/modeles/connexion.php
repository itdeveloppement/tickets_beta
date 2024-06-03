<?php
/**
 * role : se connecter à la base de données
 * attributs
 *  $userName : nom d'utilisateur
 *  $password : password de connexion à la base
 *  $dns : chaine e connexion selon le type de base de données
 *  $option : tableau associatif pour gerer notamant les erreurs et exception
 *  $bdd : stock l'objet PDO
 * methode
 */

class connexion {

// attributs
protected static $dsn;
protected static $userName;
protected static $password;
protected static $options;
protected static $bdd;

// à l'instenticiation de la classe
/*
public function __construct($dsn, $userName, $password, $options = []) {
    self::$dsn = $dsn;
    self::$userName = $userName;
    self::$password = $password;
    self::$options = $options;
}
*/
public static function connexionBdd($dsn, $userName, $password, $options = []) {
   
    print_r($dsn);
    print_r($userName);
    try 
    { 
    self::$bdd = new PDO ($dsn, $userName, $password, $options); 
    self::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    print_r(self::$bdd);
    return self::$bdd;
    }
    catch (PDOException $exception ) {
    // include "app/controleurs/index.php"
    echo "Erreur de connexion à la BDD : " . $exception->getMessage() . "Code message : " . $exception->getCode();;

}
}

public static function deconnexion() {
    self::$bdd = null;
}

public static function test() {
    print_r(self::$dsn);
}
}