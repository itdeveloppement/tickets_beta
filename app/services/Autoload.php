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
 * 
 * Methodes :
 *  register () : initialiser le chargement automatique de la classe
 *  autoloadClasses ($class) : trouve la classe et la charge
 * 
 */

namespace App\Services;

class Autoload {

    /** role : initialise autoloadClass pour initialiser le chargement automatique de la classe
     * @param : neant
     * @return : neant
     */
    // public static function register (){
    // self (un peu comme le this mais pour classe static / pour la classe courante appel la fonction ...)
    // pour appller la fonction autoloadClasses on passe un tableau avec la classe et la fonction
    // on ourrait aussi ecrire ['Autoload', 'autoloadClasses']
    public static function register() {
        spl_autoload_register([self::class, 'autoloadClasses']);
    }

    /** Role : trouver la classe et la charger
     * @param {objet} $class : nom du namespace
     * @return : neant
     */
    public static function autoloadClasses($class) {
        $prefix = 'App\\'; // namesspace App
        $base_dir = __DIR__ . '/../';

        // compare le prefixe 'App\\' avec le debut de la classe. 
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            // Si cela ne correspond il n'y a pas de namespace donc soit un autre autoloader prend le relais soit une erreur apparait
            return;
        }

        // obtenir le nom de laclasse (relative)
        $relative_class = substr($class, $len);

        // construire le chemin. Il faut remplacer les \ du chemin namespace par des / pour le chemin à inclure
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

        // si le fichier existe on l'incus
        if (file_exists($file)) {
            include $file;
        } else {
            echo "La classe n'existe pas: $class";
        }
    }
}


// ARCHIVE : autoload sans utilisation des names space
// class Autoload { 

/** role : initialise autoloadClass pour initialiser le chargement automatique de la classe
 * @param : neant
 * @return : neant
 */
// public static function register (){
    // self (un peu comme le this mais pour classe static / pour la classe courante appel la fonction ...)
    // pour appller la fonction autoloadClasses on passe un tableau avec la classe et la fonction
    // on ourrait aussi ecrire ['Autoload', 'autoloadClasses']
/*
    spl_autoload_register([self::class, 'autoloadClasses']); // "Autoload"
}
*/
/** Role : trouver la classe et la charger
 * @param {objet} $class : nom de la classe
 * @return : neant
 */
/*
public static function autoloadClasses ($class) {
    if ($class == "_model") {
        include_once __DIR__ . "/../Modeles/Model.php";
     }
     // si le fichier existe (ou le repertoire)
     else if (file_exists(__DIR__ . "/../Modeles/$class.php")) {
         include_once __DIR__ . "/../Modeles/$class.php";
     } else if (file_exists(__DIR__ . "/../Services/$class.php")) {
        include_once __DIR__ . "/../Services/$class.php";
    } else if (file_exists(__DIR__ . "/../Utils/$class.php")) {
        include_once __DIR__ . "/../Utils/$class.php";
    } 
    
     // si la classe n'existe pas 
     if (! class_exists($class)) {
        // capter l'exception 
        // throw new ClassNotExist();
        echo "la classe n'exitse pas";
    }
}
*/