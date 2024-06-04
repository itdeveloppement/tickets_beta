<?php
/**
 * role : caracteristique d'un personnage (client / vendeur / technicien)
 */

 class Utilisateur extends _model {

    // attributs
 protected $table = "utilisateur";
 protected $fields = [
    "status",
    "etat",
    "nom",
    "prenom",
    "email",
    "password",
    "created_date",
 ];
    public function afficher() {
        echo "test class utilisateur";
    }
 }
