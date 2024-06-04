<?php
/**
 * role : gestion des droits d'acces aux pages
 * 
 * methode
 *  verifierDroits($id) : verifier les droits d'acces à la page pour un utilisateur connecté
 *  
 */

class Droits {

    protected $url; // url current
    const DROITS = [
        'page_accueil_technicien_view.php' => ['CLI', 'VEND'],
        'test_unitaire _ctl.php' => ['CLI', 'VEND'],
    ];

/** role : recuperation l'URL de la page courent et verifie les droits
 *  @param : neant
 *  @return : true si autorisé, sion false
 */
private function urlCurrent () {
    $url = basename($_SERVER['SCRIPT_FILENAME']);
        return $url;
    }

/** rôle : verifier les droits d'acces à la page
 * @param : id de l'utilisateur connecté
 * @return : true si autorisation, false sinon
 */
public function verifierDroits($id) {
    $url = $this->urlCurrent();
    if (! isset(self::DROITS[$url])) {
            return false;
    } else {
        $tab = self::DROITS[$url];
        $utilisateur = new Utilisateur($id);
        foreach ($tab as $value){
            print_r($value);
            // status : client / vendeur / technicien et AC : compte actif
            if ($value == $utilisateur->get("status") && $utilisateur->get("etat") == "AC") {
                echo "acces autorisé";
                return true;
            }
        }
    }
}

}