<?php
/**
 * Role : affiche le formulaire de connexion idt et password
 * param : neant
 */

 // Template de page : header
 include __DIR__ . "/../layout/header.tpl.php";
 ?>
<h2>Connexion</h2>
<form method="post" action="index.php">
    <?= $form->input("email", "Email", "classe"); ?>
    <?= $form->input("password", "Mot de passe", "classe"); ?>
    <?= $button->button("Envoyer", "submit", "classe"); ?>
</form>

<?php
 // Template de page : footer
 include __DIR__ . "/../layout/footer.tpl.php";