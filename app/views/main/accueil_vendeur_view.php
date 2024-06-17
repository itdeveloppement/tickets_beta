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
        <div class="card">
            <h2>Page accueil vendeur</h2>
            <ul class="flex">
                <li><a href="http://mcastellano.mywebecom.ovh/back/tickets/tickets_beta/App/Controleurs/afficher_form_insert_vente.php">Enregistrer une vente</a></li>
                <li><a href="http://mcastellano.mywebecom.ovh/back/tickets/tickets_beta/App/Controleurs/insert_new_utilisateur_ctl.php">Creer un compte client</a></li>
            </ul>
        </div>
    </main>
</body>
<?php
 // Template de page : footer
 include __DIR__ . "/../layout/footer.tpl.php";
?>