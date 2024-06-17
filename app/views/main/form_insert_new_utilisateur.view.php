<?php
/**
 * Role : met en forme le mormulaire de creation d'un utilisateur
 * param : neant
 */

 // Template de page : header
 include __DIR__ . "/../layout/header.tpl.php";
 ?>

<body>
    <!-- menu generale -->
    <header>
        <?php include __DIR__ . "/../layout/menu_vendeur_tpl.php"; ?>
    </header>
    <main class="card">
        <h2>Creation d'un nouveau utilisateur</h2>
        <form method="post" action="insert_new_utilisateur_ctl.php">
            <?= $form->input("nom", "Nom", "classe"); ?>
            <?= $form->input("prenom", "Prenom", "classe"); ?>
            <?= $form->input("email", "Email", "classe"); ?>
            <?= $form->input("password", "Mot de passe", "classe"); ?>
            <?= $button->button("Envoyer", "submit", "classe"); ?>
        </form>
    </main>
</body>
<?php
 // Template de page : footer
 include __DIR__ . "/../layout/footer.tpl.php";