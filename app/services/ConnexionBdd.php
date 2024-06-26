<?php
/**
 * role : se connecter à la base de données
 * 
 * attributs
 *  $userName : nom d'utilisateur
 *  $password : password de connexion à la base
 *  $dns : chaine de connexion selon le type de base de données
 *  $option : tableau associatif pour gerer notamant les erreurs et exception
 *  $bdd : stock l'objet PDO
 * 
 * methode
 *  connexion() : connexion à la bdd
 *  deconnexion() : deconnexion à la bdd
 */


namespace App\Services;

use PDO;
use PDOException;

class ConnexionBdd {

// attributs
protected static $dsn = 'mysql:host=localhost;dbname=projets_tickets_mcastellano;charset=UTF8';
protected static $userName = 'mcastellano';
protected static $password  = 'c8?kpn?s2q+Z';
protected static $options = [PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING];
protected static $bdd = null;

/** Role : connecter la base de donnée
 * @param : 
 *  $userName : nom d'utilisateur
 *  $password : password de connexion à la base
 *  $dns : chaine e connexion selon le type de base de données
 *  $option : tableau associatif pour gerer notamant les erreurs et exception
 * @return : l'objet de connexion ou l'erreur d'exception 
 */
public static function connexion() {
    try 
    { 
    self::$bdd = new PDO (self::$dsn, self::$userName, self::$password, self::$options); 
    self::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return  self::$bdd;
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
public static function deconnexion() {
    self::$bdd = null;
}
}
