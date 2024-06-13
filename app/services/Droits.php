<?php
/**
 * role : gestion des droits d'acces aux pages
 * 
 * methode
 *  verifierDroits($id) : verifier les droits d'acces à la page pour un utilisateur connecté
 *  statusUtilisateur ($id) : retourne le status de l'utilisateur connecté
 */

 namespace App\Services;

class Droits {

    protected $url; // url current
    const DROITS = [
        'index.php' => ['CLI', 'VEN', 'TEC'],
        'afficher_form_repondre_message.php' => ['CLI', 'VEN', 'TEC'],
      
       
    ];

/** role : recuperation l'URL de la page courent et verifie les droits
 *  @param : neant
 *  @return : l'url courente
 */
private function urlCurrent () {
    // recuperation de l'url current dans la globale SERVEUR
    $url = basename($_SERVER['SCRIPT_FILENAME']);
        return $url;
    }

/** rôle : verifier les droits d'acces à la page
 * @param : status de la session de l'utilisateur connecté
 * @return : true si autorisation, false sinon
 */
public function verifierDroits($status) {

    $url = $this->urlCurrent();
    if (! isset(self::DROITS[$url])) {
            return false;
    } else {
        $tab = self::DROITS[$url];
        
        foreach ($tab as $value){
            // status : client / vendeur / technicien et AC : compte actif
            if ($value == $status) { // il faut ajouter ICI && SI ETAT == AC
                // echo "Message debug dans class Droits : acces autorisé";
                return true;
                exit;
            }
        }
        // echo "Message debug dans class Droits : acces refusé";
        // include __DIR__ . "/../controleurs/index.php";
        return false;
    }
}

}