<?php
/**
 * role : creation le champ d'un formulaire (et son label)
 * 
 * methode
 *  getValue($name) : retourne la valeur associée à un indexte de tableau
 *  input ($name, $libelle, $classe = null): affiche un input et sa valeur (si il y en a)
 *  textarea ($name, $libelle, $classe = null) : affiche un message (textarea) et sa valeur si il y en a
 *  submit($libelle, $classe = null): affiche un bouton submit et son libelle
 */

class form {
    // attributs
    protected $data; // ex : $data [ "nom"=>"Durand", "prenom"=>"Teo", "email" => "email@email" ]
   
    public function __construct($data)
    {
        // remplir l'objet avec les valeurs des champs
        $this->data = $data;
    }

    /** role : retourne la valeur associée à un indexte de tableau
     *  @param : $name : index du tableau
     *  @return : la valeur à l'index asscoié, sion false
     */
    private function getValue($name) {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        } else {
            return false;
        }
    }

    /** role : affiche un input et sa valeur (si il y en a)
     * @param : 
     *     $name : le nom du champ
     *     $libelle : le libelle du champ
     *     $classe : classe(s) de la balise ex "classe1" ou "classe1 classe2"
     * @return : code html d'un label
     * 
     */
    public function input ($name, $libelle, $classe = null) {
        $value = $this->getValue($name);
        $html = 
        "
        <label class=<?= htmlentities($classe); ?>for=$name><?= htmlentities($libelle); ?></label><br>
        <input class=<?= htmlentities($classe); ?> type=<?= htmlentities($name); ?> id=<?= htmlentities($name); ?> name=<?= htmlentities($name); ?> value=<?= htmlentities($value); ?>><br>
        ";
        return  $html;  
    }

    /** role : affiche un message (textarea) et sa valeur si il y en a
     * @param : 
     *      $name : le nom du champ
     *      $libelle : le libelle du champ
     *      $classe : classe(s) de la balise ex "classe1" ou "classe1 classe2"
     * @return : code html d'un label
     * 
     */
    public function textarea ($name, $libelle, $classe = null) {
        $value = $this->getValue($name);
        $html = "
        <label class=<?= htmlentities($classe); ?> for=<?= htmlentities($name); ?>><?= htmlentities($libelle); ?></label><br>
        <textarea class=<?= htmlentities($classe); ?> id=<?= htmlentities($name); ?> name=<?= htmlentities($name); ?>>$value</textarea><br>
        ";
        return $html;
    }

    /** role : affiche un bouton submit et son libelle
     * @param : 
     *      $libelle : libelle du bouton, 
     *      $classe : classe(s) de la balise ex "classe1" ou "classe1 classe2"
     * @return : code html d'un label
     * 
     */
    public function submit($libelle, $classe = null) {
        return "<button class=<?= htmlentities($classe); ?> type='submit'><?= htmlentities($libelle); ?></button>";
    }
}