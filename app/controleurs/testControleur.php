<?php
/**
 * role test controleur
 */
echo"test";
 include "../utils/init.php";


// session::connect(2);

$data = [ 
    "email" => "email@emailhhhhh",
    "nom" => "Durantr",
    "prenom" => "Téoo",
    "message" => "Téo,  un gourmand invétéré,  croqua un bonbon magique.  Un dragon affamé jaillit, réclamant des tonnes de gâteaux. Teo, paniqué, lui offrit un gâteau géant... en chewing-gum ! Le dragon, mâchant sans fin, s'enlisa et Teo s'enfuit, riant.",
];

$form = new form($data);

?>
<form action="traitement.php" method="post">
    <?= $form->input("nom", "Nom"); ?>
    <?= $form->input("prenom", "Prénom"); ?>
    <?= $form->input("email", "Email"); ?>
    <?= $form->textarea("message", "Message"); ?>
    <?= $form->submit("Envoyer"); ?>
</form>
