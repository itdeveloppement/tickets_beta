/**
 * role : organise la partie JS de l'application
 */
// code executé apres le chargement du DOM
document.addEventListener("DOMContentLoaded", function(){

    let idClient;
    let idProduit;


// --------------------- ECOUTEUR EVENEMENT ----------------------
// ecouteur sur btm rechercher un ticket par status
const buttons = document.querySelectorAll('.btn_status_tkt');
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const status = button.getAttribute('data-id');
                selectListeTicketsStatus(status);
            });
        });

// ecouteur sur btm cloturer un ticket
const btmCloturer = document.querySelectorAll('.btn_cloturer_tkt');
    btmCloturer.forEach(button => {
            button.addEventListener('click', function() {
                selectTicket(recupereValuerDsUrl());
            });
    });

// -------------------------- PAGE MESSAGE --------------------------------

if (window.location.href.includes("http://mcastellano.mywebecom.ovh/back/tickets/tickets_beta/App/Controleurs/afficher_form_repondre_message.php")) {
    // recuperation id ticket
    var contentElement = document.getElementById('content');
    var id = contentElement.getAttribute('data-id');

    selectTicket(id);
    selectListeMessageTicket(id);

    // ecouteur evenement formulaire
    const formulaire = document.getElementById('formMessage');
    formulaire.addEventListener('submit', soumettreFormulaireMessage);

    /**
     * role : enregistre et affiche un message
     * @param : event evenement courant
     * @return: nothing
     */
    function soumettreFormulaireMessage (event){ 
    // Empêche le comportement par défaut de soumission du formulaire
    event.preventDefault(); 
    insertMessage(id, formulaire)
}
}

// -------------------------- PAGE VENTE --------------------------------

if ((window.location.href.includes("http://mcastellano.mywebecom.ovh/back/tickets/tickets_beta/App/Controleurs/afficher_form_insert_vente.php"))){

    // ---------------- RECHERCHE CLIENT ---------------------------
const rechercherClient = document.getElementById('rechercherClient');
rechercherClient.addEventListener("input", function (event){ 
    let currentValue = event.target.value;
    // Vérifier si le contenu a au moins 3 lettres
    if (currentValue.length >= 3) {
        // Affiche liste deroulante
        selectClient();
        if (selectOptionClient(currentValue) != 0) {
        // Affiche les informations du client
        selectUtilisateur(selectOptionClient(currentValue));
        idClient = selectOptionClient(currentValue);
        };
    }
});

    // ---------------- RECHERCHE PRODUIT ---------------------------
const rechercherProduit = document.getElementById('rechercherProduit');
rechercherProduit.addEventListener("input", function (event){ 
    
    let currentValue = event.target.value;
    // Vérifie si le contenu a au moins 3 lettres
    if (currentValue.length >= 3) {
         // Affiche liste deroulane
        selectProduits();
        if (selectOptionProduit(currentValue) != 0) {
        // Affiche les informations du produit
        selectProduit(selectOptionProduit(currentValue));
        idProduit = selectOptionProduit(currentValue);
        };
    
    }
});

// --------- SOUMISSION FORMULAIRE VENTE -------------------
let formVente = document.getElementById('formVente');
formVente.addEventListener('submit', function(event) {
// Empêcher l'envoi par défaut du formulaire
event.preventDefault();
console.log("test");
// updateAction();
insertVente(idClient, idProduit);
});
    
}
// ------------------- FETCH POST ----------------------------

/**
 * role : inserer une vente en bdd
 * @param : nothing
 * @return: nothing
 */
function insertVente(idClient, idProduit) {
    console.log(idClient);
    console.log(idProduit);
    // Récupération des données du formulaire
    const formData = new FormData(formVente);
    // ajout au formulaure
    formData.append('client', idClient);
    formData.append('produit', idProduit);

     // Affichage des valeurs envoyées
     for (let [key, value] of formData.entries()) {
        console.log(`${key}: ${value}`);
    }

  fetch(`http://mcastellano.mywebecom.ovh/back/tickets/tickets_beta/App/Controleurs/insert_vente.php`, {
      method: 'POST',
      body: formData
  })
  .then(response => {
    // Réinitialisation du formulaire
    formVente.reset();
    // Vidange des champs de recherche
    document.getElementById('rechercherClient').value = '';
    document.getElementById('rechercherProduit').value = '';
})
  // recuperation des erreurs
  .catch(erreur=>{
      console.log(erreur);
  }); 
}

/**
 * role : selectionne une liste de produit en fonction de caracteres
 * @param : nothing
 * @return: nothing
 */
function selectProduits() {
    // Récupération des données du formulaire
    const formData = new FormData();
  fetch(`http://mcastellano.mywebecom.ovh/back/tickets/tickets_beta/App/Controleurs/select_liste_produits.php`, {
      method: 'POST',
      body: formData
  })
  .then(response=>{
      return response.json();
  })  .then (response=>{
     // appeller la fonction pour afficher la liste des tickets selon un status
     afficherListeResultatProduit(response);
  })
  // recuperation des erreurs
  .catch(erreur=>{
      console.log(erreur);
  }); 
}


/**
 * role : selectionne une liste de client en fonction de : nom, son prénom ou son adresse mail
 * @param : nothing
 * @return: nothing
 */
function selectClient() {
      // Récupération des données du formulaire
      
      const formData = new FormData();
    fetch(`http://mcastellano.mywebecom.ovh/back/tickets/tickets_beta/App/Controleurs/select_liste_clients.php`, {
        method: 'POST',
        body: formData
    })
    .then(response=>{
        return response.json();
    })  .then (response=>{
       // appeller la fonction pour afficher la liste des tickets selon un status
       afficherListeResultatClient(response);
    })
    // recuperation des erreurs
    .catch(erreur=>{
        console.log(erreur);
    });
}

/**
 * role : insert en bdd un message
 * @param : id du ticket concerné par les messages, le formulzire de collecte de donnée
 * @return: nothing
 */
function insertMessage(id, formulaire) {
      
    // Récupération des données du formulaire
    const formData = new FormData(formulaire);
    fetch(`http://mcastellano.mywebecom.ovh/back/tickets/tickets_beta/App/Controleurs/insert_message_ticket.php?id=${id}`, {
        method: 'POST',
        body: formData
    })
    .then(response => {
        return response.json();
    })
    .then(response => {
        console.log(response);
        afficherListeMessagesTicket(response);
        formulaire.querySelector('textarea').value = "";

    })
    .catch(error => {
        console.log(error);
    });
    }

// ------------------- FETCH ----------------------------
/**
 * role : selectionne un produit
 * @param : id du produit
 * @return: nothing
 */
function selectProduit(id){
    fetch(`http://mcastellano.mywebecom.ovh/back/tickets/tickets_beta/App/Controleurs/select_produit.php?id=${id}`)
        .then(response=>{
            return response.json();
        })  .then (response=>{
           // appeller la fonction pour afficher la liste des tickets selon un status
           afficherProduit(response);
        })
        // recuperation des erreurs
        .catch(erreur=>{
            console.log(erreur);
        });  
    }

/**
 * role : selectionne un utilisateur
 * @param : id de l'utilisateur
 * @return: nothing
 */
function selectUtilisateur(id){
fetch(`http://mcastellano.mywebecom.ovh/back/tickets/tickets_beta/App/Controleurs/select_client.php?id=${id}`)
    .then(response=>{
        return response.json();
    })  .then (response=>{
    // appeller la fonction pour afficher la liste des tickets selon un status
       afficherUtilisateur(response);
    })
    // recuperation des erreurs
    .catch(erreur=>{
        console.log(erreur);
    });  
}

/**
 * role : afficher la liste des tickets par status et l'afficher
 * @param : status du tickets
 * @retour :
 */
function selectListeTicketsStatus(status) {
    fetch(`http://mcastellano.mywebecom.ovh/back/tickets/tickets_beta/App/Controleurs/select_status_tickets.php?status=${status}`)
    .then(response=>{
        return response.json();
    })  .then (response=>{
       // appeller la fonction pour afficher la liste des tickets selon un status
       afficherListeTicketStatus(response);
    })
    // recuperation des erreurs
    .catch(erreur=>{
        console.log(erreur);
    });
}

/**
 * role : afficher le detail d'un ticket 
 * @param : id du ticket
 * @retour :
 */
function selectTicket(id) {
    fetch(`http://mcastellano.mywebecom.ovh/back/tickets/tickets_beta/App/Controleurs/select_ticket.php?id=${id}`)
    .then(response=>{
        return response.json();
    })  .then (response=>{
       // appeller la fonction pour afficher un ticket
       afficherTicket(response);
    })
    // recuperation des erreurs
    .catch(erreur=>{
        console.log(erreur);
    });
}

/**
 * role : selectionner la liste des messages d'un ticket
 * @param : id du ticket
 */
function selectListeMessageTicket(id) {
    
    fetch(`http://mcastellano.mywebecom.ovh/back/tickets/tickets_beta/App/Controleurs/select_liste_messages_ticket.php?id=${id}`)
    .then(response=>{
        return response.json();
    })  .then (response=>{
       // appeller la fonction pour afficher la liste de message d'un ticket
       afficherListeMessagesTicket(response);
    })
    // recuperation des erreurs
    .catch(erreur=>{
        console.log(erreur);
    });
}

// ------------------   AFFICHAGE ------------------------------------
/**
 * role : affiche un utilisateur
 * @param : objet : les caracteristiques de l'utilisateur 
 * @retour :
 *
*/
function afficherUtilisateur(response) {
    zone = document.getElementById ("selecClient");
        template = 
        `
        <p>Client</p>
        <p><?php htmlentities(?>${response.prenom}<?php )></p>
        <p><?php htmlentities(?>${response.nom}<?php )></p>
        <p><?php htmlentities(?>${response.email}<?php )></p>
        `;
    zone.innerHTML = template;  
}

/**
 * role : affiche un produit
 * @param : objet : les caracteristiques de l'utilisateur 
 * @retour :
 *
*/
function afficherProduit(response) {
    zone = document.getElementById ("selecProduit");
        template = 
        `
        <p>Produit</p>
        <p><?php htmlentities(?>${response.ref}<?php )></p>
        <p><?php htmlentities(?>${response.designation}<?php )></p>
        `;
    zone.innerHTML = template;  
}

/**
 * role : affiche la liste des resultat de recherche pour trouver un produit
 * @param : string : les elemet fourni dans l'input
 * @retour : tableau de resultat
 *
*/
function afficherListeResultatProduit(response) {
    let zone = document.getElementById ("produitOption");
        template = '';
        // recupere l'id dans response
        Object.entries(response).forEach(([id, result]) => {
            template += 
            `
            <option data-id=<?php htmlentities(?>${result["id"]}<?php )><?php htmlentities(?>${result["ref"]}<?php ),<?php htmlentities(?>(${result["designation"]}<?php )</option>
            `;
        }); 
        zone.innerHTML = template;      
}


/**
 * role : affiche la liste des resultat de recherche pour trouver un client
 * @param : string : les elemet fourni dans l'input
 * @retour : tableau de resultat
 *
*/
function afficherListeResultatClient(response) {
    let zone = document.getElementById ("clientOption");
        template = '';
        // recupere l'id dans response
        response.forEach(result=> {
            template += 
            `
            <option data-id=<?php htmlentities(?>${result["id"]}<?php )><?php htmlentities(?>${result["prenom"]}<?php ), <?php htmlentities(?>${result["nom"]}<?php ), <?php htmlentities(?>${result["email"]}<?php )</option>
            `;
        }); 
        zone.innerHTML = template;      
}

/**
 * role : affiche la liste des tickets par status
 * @param : reponse / les données (liste des tickets selon un status ) 
 * @retour :
 *
*/
function afficherListeTicketStatus (response) {
    zone = document.getElementById ("listeTicketsStatus");
    template = '';
    // recupere l'id dans response
    Object.entries(response).forEach(([id, ticket]) => {
        template += 
        `
        <tr>
            <th colspan="5"><?php htmlentities(?>${ticket["titre"]}<?php )?></th>
        </tr>
         <tr >
            <td><?php htmlentities(?>${ticket["designation"]}<?php )?></td>
            <td><?php htmlentities(?>${ticket["status"]}<?php )?></td>
            <td><?php htmlentities(?>${ticket["created_date"]}<?php )?></td>
            <td><?php htmlentities(?>${ticket["nom"]}<?php )?></td>
            <td><?php htmlentities(?>${ticket["prenom"]}<?php )?></td>
            <td><a href="http://mcastellano.mywebecom.ovh/back/tickets/tickets_beta/App/Controleurs/afficher_form_repondre_message.php?id=${id}">Messages</a></td>
        </tr>
        `;
    }); 
    zone.innerHTML = template;      
}
/**
 * role : affiche la liste des tickets par status
 * @param : reponse / les données (liste des tickets selon un status ) 
 * @retour :
 *
*/
function afficherTicket(response) {
    zone = document.getElementById ("détailTicket");
        template = 
        `
        <tr>
            <th colspan="5">${response.titre}</th>
        </tr>
         <tr >
            <td><?php htmlentities(?>${response.designation}<?php )?></td>
            <td><?php htmlentities(?>${response.status}<?php )?></td>
            <td><?php htmlentities(?>${response.created_date}<?php )?></td>
            <td><?php htmlentities(?>${response.nom}<?php )?></td>
            <td><?php htmlentities(?>${response.prenom}<?php )?></td>
            <td><a href="http://mcastellano.mywebecom.ovh/back/tickets/tickets_beta/App/Controleurs/update_status_ticket.php?id=${response.id}">Cloturer</a></td>
        </tr>
        `;
     
    zone.innerHTML = template;      
}

/**
 * role : affiche la liste des message d'un ticket
 * @param : reponse / les données (liste des tickets selon un status ) 
 * @retour :
 *
*/
function afficherListeMessagesTicket(response) {
    zone = document.getElementById ("listeMessages");
    template = '';
    // recupere l'id dans response
    Object.entries(response).forEach(([id, message]) => {
        template += 
        `
        <p><?php htmlentities(?>${message["prenom"]}<?php )?></p>
        <p><?php htmlentities(?>${message["nom"]}<?php )?></p>
        <p><?php htmlentities(?>${message["message"]}<?php )?></p>
        `;
    }); 
    zone.innerHTML = template;      
}


// -------------- TRAITEMENT DES DONNEES -----------------------------
/**
 * role : Recherche de l'option de datalist cient sélectionnée par sa valeur
 * @pâram : currentValue : la valeur de l'input
 * @return : l'id de l'option selectionné, sinon false
 */
function selectOptionClient (currentValue){
    let dataList = document.getElementById("clientOption");
    // Recherche de l'option sélectionnée par sa valeur // transforme en tableau et recherche la valeur de l'input
    let selectedOption = Array.from(dataList.options).find(option => option.value === currentValue);
    if (selectedOption) {
        let selectedId = selectedOption.getAttribute('data-id');
        return selectedId;
    } else { 
        return false;
    }
}
/**
 * role : Recherche de l'option de datalist produit sélectionnée par sa valeur
 * @pâram : currentValue : la valeur de l'input
 * @return : l'id de l'option selectionné, sinon false
 */
function selectOptionProduit (currentValue){
    let dataList = document.getElementById("produitOption");
    // Recherche de l'option sélectionnée par sa valeur // transforme en tableau et recherche la valeur de l'input
    let selectedOption = Array.from(dataList.options).find(option => option.value === currentValue);
    if (selectedOption) {
        let selectedId = selectedOption.getAttribute('data-id');
        return selectedId;
    } else { 
        return false;
    }
}
/**
 * role : recupere la valeur de l'id client et id vente dans les liste d'options et renseinhe champ input formulaire
 * @param : neant
 * @return : neant
 */
function updateAction() {
    // Récupérer l'ID du client sélectionné
    let clientId = document.getElementById('rechercherClient').value;
    document.getElementById('clientForm').value = clientId;

    // Récupérer l'ID du produit sélectionné
    let produitId = document.getElementById('rechercherProduit').value;
    document.getElementById('produitForm').value = produitId;

}

});
