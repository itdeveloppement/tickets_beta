<?php
/**
 * role : met en forme la page d'affichage et de reponse au messages
 */
// Template de page : header
  include __DIR__ . "/../layout/header.tpl.php";
?>
<body>
        <div id="content" data-id></div>
    <!-- menu generale -->
    <header>
        <?php 
        if ($session->getStatusSession() == "TEC") {
        include __DIR__ . "/../layout/menu_technicien_tpl.php";
        } else if ($session->getStatusSession() == "VEN")  {
            include __DIR__ . "/../layout/menu_vendeur_tpl.php";
        } else if ($session->getStatusSession() == "CLI")  {
            include __DIR__ . "/../layout/menu_client_tpl.php";
        }
        ?>
        <h2>Messages espace technicien</h2>
    </header>
    <!-- page accueil technicien -->
    <main>
        <h3>Detail d'un arcticle</h3>
        <table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Produit</th>
            <th>Status du ticket</th>
            <th>Date de cration du ticket</th>
            <th>Nom du client</th>
            <th>Prenom du client</th>
            <th>Cloturer</th>
        </tr>
    </thead>
    <tbody id="détailTicket">
        <!-- include avec js fonction afficherTicket() dans app.js -->
        
    </tbody>
</table>
        <h3>Liste des messages</h3>
        <h3>Répondre</h3>
    </main>

    <script src="../../../tickets_beta/public/js/app.js" defer></script>
<?php

 // Template de page : footer
 include __DIR__ . "/../layout/footer.tpl.php";
 ?>