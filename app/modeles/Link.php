<?php
/**
 * role : creation des lien de type <a>
 * 
 * methode
 *  link ($libelle, $type, $class = null, $id= null) : return le lien de type <a> html
 */
 
class Link {

    // attributs
    protected $href; // submit, button ...
    protected $libelle; // texte afficher sur le bouton
    protected $class; 
    protected $id; // ex "classe1" ou "classe1 classe2"

    protected $data; // les données (parametre) à indiquer dans l'url $data [ "id" = 1, "non"="Durant" ...]
   
    public function __construct($data = null)
    {
     $this->data = $data;
    }

    /** role : affiche le lien
     * @param : 
     *     $href : url vers le lien pointé
     *     $libelle : texte affiher sur le bouton
     *     $type : le type de bouton : submit, button ...
     *     $class : classe(s) de bouton ex "classe1" ou "classe1 classe2"
     *     $id : id unique du bouton
     * 
     * @return : code html de la balise <a>
     * 
     */
    public function link ($href, $libelle = null, $class = null, $id= null) {
        $html = "<a class='" . htmlentities($class) . "' href='" . htmlentities($href) . $this->parametresURL($this->data) . "' id='" . htmlentities($id) . "'>" . htmlentities($libelle). "</button>";
        return  $html;  
    }

    /** role : construire la partie parametre de l'URL href
     * @param : 
     *     $href : url vers le lien pointé
     *     $libelle : texte affiher sur le bouton
     *     $type : le type de bouton : submit, button ...
     *     $class : classe(s) de bouton ex "classe1" ou "classe1 classe2"
     *     $id : id unique du bouton
     * @return : code html de la balise <a>
     * 
     */
    private function parametresURL($data) {
        if (isset($data) ){ 
        $param = '?';
        foreach ($data as $key => $value) {
            $param .= $key . '='. $value .'&';
        }
        // supression & à la fin de la chaine
        $param = rtrim($param, '&');
        return $param;
        } else { 
            return '';
        }
    }

}