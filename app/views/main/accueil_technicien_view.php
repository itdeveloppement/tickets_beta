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
            <li> <button  data-id="OUV" id="btn_status_tkt">Afficher les tickets ouverts</button></li>
            <li> <button  data-id="ENC" id="btn_status_tkt">Afficher les tickets en cours</button></li>
            <li> <button  data-id="RES" id="btn_status_tkt">Afficher les tickets resolus</button></li>
        </ul>
        <h3>Liste des tickets</h3>
    </main>
</body>

<?php
 // Template de page : footer
 include __DIR__ . "/../layout/footer.tpl.php";
 ?>