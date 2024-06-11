/**
 * role : organise la partie JS Dde l'application
 * fonction :
 *  afficherListeTicketsStatus() : affiche le fragment de la liste des tickets selon un stus (ouvert / en cours / resolu)
 */

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
                console.log ("test btm cloturer ticket");
                // recuperation id
                selectTicket(recupereValuerDsUrl());
            });
        });

// ------------------- FETCH ----------------------------
/**
 * role : afficher la liste des tickets par status et l'afficher
 * @param : status du tickets
 * @retour :
 */
function selectListeTicketsStatus(status) {
    fetch(`../App/Controleurs/select_status_tickets.php?status=${status}`)
    .then(response=>{
        return response.json();
    })  .then (response=>{
        console.log(response);
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
console.log(id)
    
    fetch(`../Controleurs/select_ticket.php?status=${id}`)
    .then(response=>{
        return response.json();
    })  .then (response=>{
        console.log(response);
       // appeller la fonction pour afficher la liste des tickets selon un status
       afficherTicket(response);
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
    console.log(Object.values(response));
    // recupere l'id dans response
    Object.entries(response).forEach(([id, ticket]) => {
        console.log(id);
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



// ------- FONCTION DE TRAITEMENT --------

/**
 * role : recupere la valeur de l'id du ticket dans l'url de la page
 * @param : noting
 * @return : id recupéré dans l'url
 */
function recupereValuerDsUrl () { 
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    const contentElement = document.getElementById('content');
    contentElement.setAttribute('data-id', id);
    
    return id;
  
};

// au chargement affiche le detail d'un tickets
document.addEventListener("DOMContentLoaded", function(){
    console.log("load");
    const id = recupereValuerDsUrl();
    // console.log("test id" + id);
    selectTicket(id)
    });

