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
        <?php include __DIR__ . "/../layout/menu_client_tpl.php"; ?>
    </header>
    <!-- page accueil technicien -->
    <main class="technicien card">
        <h2>Page accueil vendeur</h2>
        <!-- liste des demande d'assistance en cours -->
        <h3>Liste de vos tickets</h3>
   
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Status</th>
                    <th>Création</th>
                    <th>Messages</th>
                </tr>
            </thead>
            <tbody id="listeTicketsClientStatus">
                <!-- // construit avec la foncttion js selectListeTicketsStatus()
                <tr >
                    <td>${ticket["titre"]}</td>
                    <td>${ticket["Designation"]}</td>
                    <td>${ticket["Status"]}</td>
                    <td>${ticket["created_date"]}</td>

                </tr> -->
                
            </tbody>
        </table>
         <!-- lister les ticket-->
        <h3>Liste des tickets en attente d'une reponse</h3>
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Status</th>
                    <th>Création</th>
                    <th>Messages</th>
                    <th>Cloturer</th>

                </tr>
            </thead>
            <tbody id="listeTicketsClientOuvert">
                <!-- // construit avec la foncttion js selectListeTicketsStatus()
                <tr >
                    <td>${ticket["titre"]}</td>
                    <td>${ticket["Designation"]}</td>
                    <td>${ticket["Status"]}</td>
                    <td>${ticket["created_date"]}</td>
                </tr> -->
                
            </tbody>
        </table>
        <script src="http://mcastellano.mywebecom.ovh/back/tickets/tickets_beta/public/js/app.js" defer></script>
</main>
</body>
<?php

 // Template de page : footer
 include __DIR__ . "/../layout/footer.tpl.php";
 ?>