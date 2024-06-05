<?php
/**
 * Role : met en forme le mormulaire de creation d'un utilisateur
 * param : neant
 */

 // Template de page : header
 include __DIR__ . "/../layout/header.tpl.php";
 ?>
<h2>Creation d'un nouveau utilisateur</h2>
<form method="post" action="insert_new_utilisateur_ctl.php">
    <?= $form->input("nom", "Nom", "classe"); ?>
    <?= $form->input("prenom", "Prenom", "classe"); ?>
    <?= $form->input("status", "Status (CLI : client - VEND : vente - TEC : technicien)", "classe"); ?>
    <?= $form->input("etat", "Etat (AC : actif - NAC : non actif)", "classe"); ?>
    <?= $form->input("email", "Email", "classe"); ?>
    <?= $form->input("password", "Mot de passe", "classe"); ?>
    <?= $button->button("Envoyer", "submit", "classe"); ?>
</form>

<?php
 // Template de page : footer
 include __DIR__ . "/../layout/footer.tpl.php";