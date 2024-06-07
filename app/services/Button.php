<?php
/**
 * role : creation bouton 
 * 
 * methode
 *  button ($libelle, $type, $class = null, $id= null) : return le bouton html
 * 
 * exemple utilisation :  <?= $button->button("Envoyer", "submit", "classe"); ?>
 */

class Button {
    // attributs
    protected $type; // submit, button ...
    protected $libelle; // texte afficher sur le bouton
    protected $class; 
    protected $id; // ex "classe1" ou "classe1 classe2"
   
    public function __construct()
    {
      // non utilisé
    }

    /** role : affiche le bouton
     * @param : 
     *     $libelle : texte affiher sur le bouton
     *     $type : le type de bouton : submit, button ...
     *     $class : classe(s) de bouton ex "classe1" ou "classe1 classe2"
     *     $id : id unique du bouton
     * 
     * @return : code html d'un label
     * 
     */
    public function button ($libelle, $type, $class = null, $id= null) {
        $html = "<button class='" . htmlentities($class) . "' type='" . htmlentities($type) . "' id='" . htmlentities($id) . "'>" . htmlentities($libelle). "</button>";
        return  $html;  
    }

}