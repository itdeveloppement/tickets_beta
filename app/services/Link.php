<?php
/**
 * role : creation des lien de type <a>
 * 
 * methode
 *  link ($libelle, $type, $class = null, $id= null) : return le lien de type <a> html
 * 
 * exemple utilisation
 *   <?= $link->link("url", "libelle", "classe", "id"); ?>
 */
 
 namespace App\Services;

class Link {

    // attributs
    protected $href; // url vers le lien pointé
    protected $libelle; // texte à afficher
    protected $class; // ex "classe1" ou "classe1 classe2"
    protected $id; // id du lien

    protected $data; // les données (parametre) à indiquer dans l'url $data [ "id" = 1, "non"="Durant" ...]
   
    public function __construct()
    {
     // non utilisé
    }

    /** role : affiche le lien
     * @param : 
     *     $href : url vers le lien pointé
     *     $libelle : texte affiher sur le bouton
     *     $class : classe(s) de bouton ex "classe1" ou "classe1 classe2"
     *     $params : parametre de l'url sous la forme : indiquer dans l'url $data [ "id" = 1, "non"="Durant" ...]
     *     $id : id unique du bouton
     * 
     * @return : code html de la balise <a>
     * 
     */
    public function link ($class = null, $href,   $params=null, $id= null, $libelle = null) {
        $html = "<a class='" . htmlentities($class) . "' href='" . htmlentities($href) . htmlentities($this->parametresURL($params)) ."' id='" . htmlentities($id) ."'>" . htmlentities($libelle). "</a>";
        return  $html;  
    }

    /** role : construire la partie parametre de l'URL href
     * @param : 
     *     $data : le ou les parametres à ajouter. Format : $data [ "id" = 1, "non"="Durant" ...]
     * @return : code html de la balise <a>
     * 
     */
    private function parametresURL($params) {
        if ($params=="null"){ 
            return '';
        } else { 
            $param = '?';
            foreach ($params as $key => $value) {
                $param .= $key . '='. $value .'&';
            }
            // supression & à la fin de la chaine
            $param = rtrim($param, '&');
            return $param;  
        }
    }
    

}