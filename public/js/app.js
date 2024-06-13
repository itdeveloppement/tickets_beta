/**
 * role : organise la partie JS de l'application
 */




// code executé apres le chargement du DOM
document.addEventListener("DOMContentLoaded", function(){

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

    if (window.location.href.includes("http://mcastellano.mywebecom.ovh/back/tickets/tickets_beta/App/Controleurs/afficher_form_repondre_message.php")) {
    }

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

// ------------------- FETCH ----------------------------


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

// en cours
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
            <th colspan="5">${ticket["titre"]}</th>
        </tr>
         <tr >
            <td>${ticket["designation"]}</td>
            <td>${ticket["status"]}</td>
            <td>${ticket["created_date"]}</td>
            <td>${ticket["nom"]}</td>
            <td>${ticket["prenom"]}</td>
            <td><a href="http://mcastellano.mywebecom.ovh/back/tickets/tickets_beta/App/Controleurs/afficher_form_repondre_message.php?id=${id}">Voir les messages</a></td>
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
            <td>${response.designation}</td>
            <td>${response.status}</td>
            <td>${response.created_date}</td>
            <td>${response.nom}</td>
            <td>${response.prenom}</td>
            <td><a href="http://mcastellano.mywebecom.ovh/back/tickets/tickets_beta/App/Controleurs/update_status_ticket.php?id=${response.id}">Cloturer</a></td>
        </tr>
        `;
     
    zone.innerHTML = template;      
}

/**
 * role : affiche la liste des tickets par status
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
        <p>${message["prenom"]}</p>
        <p>${message["nom"]}</p>
        <p>${message["message"]}</p>
        `;
    }); 
    zone.innerHTML = template;      
}
});
