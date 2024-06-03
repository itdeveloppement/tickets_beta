<?php


/* NOTION "auto chargement des classes" ----------------------------------
Objectif : charger les classes sans avoir à les inclure une apres l'autre manuellement
Methode : si une classe PHP rencontre une classe non denfnini il appel une fonction de chargement de la classe
- spl_autoload_register(autoloadClasses()) : enrgiste et appel la fonction autoloadClasses() pour le chargement automatique de la classe. Dans le script quand une classe est appelé cela appel automatiquement spl_autoload_register(autoloadClasses()) qui recherche la classe appellée (ex $objet = new MyClass(), MyClass sera recherhé et chargé par spt_auto ...) 
- autoloadClasses() : 
    - charge la classe modele , sinon la classe nomée si elle existe.
    - si la classe existe on peut effectuier d'autre traitement (vérifications supplémentaires ou des initialisations spécifiques à la classe. A preciser)
*/

/**
 * Role : charger automatiquement les classes
 */
class Autoload { 

/**
 * role : initialise autoloadClass pour initialiser le chargement automatique de la classe
 * @param : neant
 * @return : neant
 */
public static function register (){
    // self (un peu comme le this mais pour classe static / pour la classe courante appel la fonction ...)
    spl_autoload_register([self::class, 'autoloadClasses']);
}

/**
 * Role : trouver la classe et la charger
 * @param {objet} $class : nom de la classe
 * @return : neant
 */
public static function autoloadClasses ($class) {
    if ($class == "_model") {
        include_once "../utils/Model.php" ;
     }
     // si le fichier existe (ou le repertoire)
     else if (file_exists("../modeles/$class.php")) {
         include_once "../modeles/$class.php";
     }
     // si la classe n'existe pas 
     if (! class_exists($class)) {
        // capter l'exception 
        // throw new ClassNotExist();
        // echo "la classe n'exitse pas";
    }
}
}