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
        'afficher_form_update_param_connexion.php' => ['CLI', 'VEN', 'TEC'],
        'deconnexion_session.php' => ['CLI', 'VEN', 'TEC'],
        'insert_message_ticket.php' => ['CLI', 'VEN', 'TEC'],
        'select_status_tickets.php' => ['CLI', 'VEN', 'TEC'],
        'select_ticket.php' => ['CLI', 'VEN', 'TEC'],
        'update_status_ticket.php' => ['CLI', 'VEN', 'TEC'],
    
        'insert_vente.php' => ['VEN', 'TEC'],
        'select_client.php' => ['VEN', 'TEC'],
        'select_liste_clients.php' => ['VEN', 'TEC'],
        'select_liste_messages_ticket.php' => ['VEN', 'TEC'],
        'afficher_form_insert_vente.php' => ['VEN', 'TEC'],
        'bascule.php' => ['VEN', 'TEC'],
        'select_liste_produits.php' => ['VEN', 'TEC'],
        'select_produit.php' => ['VEN', 'TEC'],
       
        'insert_new_utilisateur_ctl.php' => ['VEN'],
        'afficher_form_new_utilisateur_ctl.php' => ['VEN'],

        'select_tickets_client.php' => ['CLI'],
        'select_tickets_status_client.php' => ['CLI'],
        
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
public function verifierDroits($status){
    $url = $this->urlCurrent();
    if (! isset(self::DROITS[$url])) {
            return false;
            exit;
    } else {
        $tab = self::DROITS[$url];
        foreach ($tab as $value){
            // status : client / vendeur / technicien et AC : compte actif
            if ($value === $status) { // il faut ajouter ICI && SI ETAT == AC
                // echo "Message debug dans class Droits : acces autorisé";
                return true;
                exit;
        }
    }
        return false;
    }
}

}