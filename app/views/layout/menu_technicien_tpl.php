<?php
/**
 * fragment de page : menu technicien
 * param : nothing
 */
?>
 <div>
   <?= $link->link("../controleurs/bascule.php", "Basculler vers l'espace vendeur", "classe", "null", "id"); ?>
   <?= $link->link("../controleurs/afficher_form_update_param_connexion.php", "Modifier votre password", "classe", "null", "id"); ?>
   <?= $link->link("../controleurs/deconnexion_session.php", "Deconnexion", "classe", "null", "id"); ?>
</div>