/**
 * role : organise la partie JS Dde l'application
 * fonction :
 *  afficherListeTicketsStatus() : affiche le fragment de la liste des tickets selon un stus (ouvert / en cours / resolu)
 */


// ------- FONCTION DE TRAITEMENT --------

/**
 * role : recupere la valeur de l'id du ticket dans l'url de la page
 * @param : noting
 * @return : id recupéré dans l'url
 */
function recupereValuerDsUrl() { 

    var contentElement = document.getElementById('content');
    var id = contentElement.getAttribute('data-id');
    console.log (id);

    /*
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    const contentElement = document.getElementById('content');
    contentElement.setAttribute('data-id', id);
    */
    return id;
  
};


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
                // recuperation id
                selectTicket(recupereValuerDsUrl());
            });
        });

// ----------- AU CHARGEMENT DE LA PAGE ---------------------

// afficher le detail d'un tickets
document.addEventListener("DOMContentLoaded", function(){
   

    // au chargement de la page message (verifier si opn est sur la deuxieme page) href url absolut
    if (window.location.href.includes("http://mcastellano.mywebecom.ovh/back/tickets/tickets_beta/App/Controleurs/afficher_form_repondre_message.php")) {
         // recuperation id ticket
        var contentElement = document.getElementById('content');
        var id = contentElement.getAttribute('data-id');
    
        selectTicket(id);
        selectListeMessageTicket(id);
    }
});

// ------------------- FETCH ----------------------------
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
        console.log(response);
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
            <td><a href="../App/Controleurs/afficher_form_repondre_message.php?id=${id}">Voir les messages</a></td>
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
            <td><a href="../App/Controleurs/afficher_form_repondre_message.php?id=${response.id}">Cloturer</a></td>
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



