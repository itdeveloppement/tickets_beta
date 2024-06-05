<?php
/**
 * role test class
 */
echo"test";
 include "../app/utils/init.php";

// session::connect(2);

// test creation de formulaire
$form = new Form($dataForm);
$button = new Button();

// champ deformulaire
$dataForm = [ 
    "email" => "email@email",
    "nom" => "Durand",
    "prenom" => "Téo",
    "password" => "pass",
    "message" => "Téo,  un gourmand invétéré,  croqua un bonbon magique.  Un dragon affamé jaillit, réclamant des tonnes de gâteaux. Teo, paniqué, lui offrit un gâteau géant... en chewing-gum ! Le dragon, mâchant sans fin, s'enlisa et Teo s'enfuit, riant.",
];

?>
<form action="traitement.php" method="post">
    <?= $form->input("nom", "Nom"); ?>
    <?= $form->input("prenom", "Prénom"); ?>
    <?= $form->input("email", "Email"); ?>
    <?= $form->input("password", "Mot de passe"); ?>
    <?= $form->textarea("message", "Message"); ?>
    <?= $button->button("Envoyer", "submit"); ?>
</form>

<?php
// test creation balise <a>
$link = new Link($dataLink);
// tableau des données des liens 
$dataLink = [ 
    "id" => "1",
    "nom" => "Durand",
    "prenom" => "Téo"
];
echo $link->link("https://www.example.com", "suivre le lien"); 



