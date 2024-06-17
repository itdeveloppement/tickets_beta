<?php
/**
 * Template : page accueil technicien
 * Parmetres : neant
 */

  // Template de page : header
  include __DIR__ . "/../layout/header.tpl.php";
?>
<body>
    <!-- menu generale -->
    <header>
        <?php include __DIR__ . "/../layout/menu_technicien_tpl.php"; ?>
    </header>
    <!-- page accueil technicien -->
    <main class="technicien card">
        <h2>Page accueil technicien</h2>
        <!-- rechercher un ticket -->
        <h3>Rechercher un tickets par son status</h3>
        <ul class="flex">
            <li><button  data-id="OUV" class="btn_status_tkt">Afficher les tickets ouverts</button></li>
            <li><button  data-id="ENC" class="btn_status_tkt">Afficher les tickets en cours</button></li>
            <li><button  data-id="RES" class="btn_status_tkt">Afficher les tickets resolus</button></li>
        </ul>
         <!-- lister les ticket-->
        <h3>Liste des tickets par status</h3>
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Status</th>
                    <th>Création</th>
                    <th>Client</th>
                    <th>Client</th>
                    <th>Messages</th>
                </tr>
            </thead>
            <tbody id="listeTicketsStatus">
                <!-- // construit avec la foncttion js selectListeTicketsStatus()
                <tr >
                    <td>${ticket["titre"]}</td>
                    <td>${ticket["Designation"]}</td>
                    <td>${ticket["Status"]}</td>
                    <td>${ticket["created_date"]}</td>
                    <td>${ticket["nom"]}</td>
                    <td>${ticket["prenom"]}</td>
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