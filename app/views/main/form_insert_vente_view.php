<?php
/**
 * role : met en forme la page pour enregistrer une vente
 */
// Template de page : header
  include __DIR__ . "/../layout/header.tpl.php";
?>
<body>
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
        <h2>Enregister une vente</h2>
    </header>
    <!-- page accueil technicien -->
    <main>
        <h3>Selectionner un client</h3>
        <input type="text" id="rechercherClient" name="rechercheClient" list="clientOption" placeholder="Rechercher un client ...">
        <datalist id="clientOption"></datalist>

        <h3>Selectionner un produit</h3>
        <input type="text" id="rechercherProduit" name="rechercheProduit" list="produitOption" placeholder="Rechercher un produit" ...>
         <datalist id="produitOption"></datalist>
        
    
        <!-- formulaire pour repondre enregistrer une vente -->
        <h3>Enregistrer la vente</h3>
        <div id="selecClient"></div>
        <div id="selecProduit"></div>
        <div>
            <form id="formVente">
                <div>
                    <label for="num_serie">Indiquer le numero de serie du produit :</label>
                    <input type="text" id="num_serie" name="num_serie">
                    <label for="date_vente">Indiquer la date de la vente :</label>
                    <input type="date" id="date_vente" name="date_vente" value="<?=date('Y-m-d')?>">
                </div>
                <input type="submit" value="Envoyer">
            </form>
        </div>
    </main>
    <script src="http://mcastellano.mywebecom.ovh/back/tickets/tickets_beta/public/js/app.js" defer></script>
<?php

 // Template de page : footer
 include __DIR__ . "/../layout/footer.tpl.php";
 ?>