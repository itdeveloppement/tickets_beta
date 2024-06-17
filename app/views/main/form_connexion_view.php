<?php
/**
 * Role : affiche le formulaire de connexion idt et password
 * param : neant
 */

 // Template de page : header
 include __DIR__ . "/../layout/header.tpl.php";
 ?>
 <body>
    <header>
    <?php include __DIR__ . "/../layout/menu_hors_connexion_tpl.php"; ?>
    </header>
    <main class="formConnexion">
        <div class="card">
            <h2>Connexion</h2>
            <form class="flex section" method="post" action="../../public/index.php">
                <?= $form->input("email", "Email", "classe"); ?>
                <?= $form->input("password", "Mot de passe", "classe"); ?>
                <?= $button->button("Envoyer", "submit", "classe"); ?>
            </form>
        </div>
    </main>
</body>
<?php
 // Template de page : footer
 include __DIR__ . "/../layout/footer.tpl.php";