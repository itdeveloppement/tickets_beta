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
    <main>
        <h2>Page accueil technicien</h2>
        <h3>Rechercher un tickets par son status</h3>
        <ul>
            <li> <button  data-id="OUV" class="btn_status_tkt">Afficher les tickets ouverts</button></li>
            <li> <button  data-id="ENC" class="btn_status_tkt">Afficher les tickets en cours</button></li>
            <li> <button  data-id="RES" class="btn_status_tkt">Afficher les tickets resolus</button></li>
        </ul>
        <h3>Liste des tickets par status</h3>
    </main>
</body>

<table>
    <thead>
        <tr>
            <th>Produit</th>
            <th>Status du ticket</th>
            <th>Date de cration du ticket</th>
            <th>Nom du client</th>
            <th>Prenom du client</th>
            <th>Voir les messages</th>
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
<?php

 // Template de page : footer
 include __DIR__ . "/../layout/footer.tpl.php";
 ?>