<?php
/**
 * Template : page accueil vendeur
 * Parmetres : neant
 */
// Template de page : header
include __DIR__ . "/../layout/header.tpl.php";
?>
<body>
    <!-- menu generale -->
    <header>
        <?php include __DIR__ . "/../layout/menu_vendeur_tpl.php"; ?>
    </header>
    <!-- page accueil vendeur -->
    <main>
        <h2>Page accueil vendeur</h2>
        <a href="http://mcastellano.mywebecom.ovh/back/tickets/tickets_beta/App/Controleurs/afficher_form_insert_vente.php">Enregistrer une vente</a>
        <a href="http://mcastellano.mywebecom.ovh/back/tickets/tickets_beta/App/Controleurs/???????? ">Creer un compte client</a>
    </main>
</body>
<?php
 // Template de page : footer
 include __DIR__ . "/../layout/footer.tpl.php";
?>