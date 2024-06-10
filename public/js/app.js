/**
 * role : organise la partie JS Dde l'application
 * fonction :
 *  afficherListeTicketsStatus() : affiche le fragment de la liste des tickets selon un stus (ouvert / en cours / resolu)
 */

// ecouteur evenement sur btm 
const buttons = document.querySelectorAll('.btn_status_tkt');
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const status = button.getAttribute('data-id');
                selectListeTicketsStatus(status);
            });
        });

/**
 * role : recuperer la liste des tickets par status et l'afficher
 * @param : status du tickets
 * @retour :
 */
function selectListeTicketsStatus(status) {
    fetch(`select_status_tickets.php?status=${status}`)
    .then(response=>{
        return response.json();
    })  .then (response=>{
       // appeller la fonction pour afficher la liste des tickets selon un status
       afficherListeTicketStatus (response)
    })
    // recuperation des erreurs
    .catch(erreur=>{
        console.log(erreur);
    });
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
    response.foreach( ticket => {
        template += 
        `
         <tr >
            <td>${ticket["titre"]}</td>
            <td>${ticket["designation"]}</td>
            <td>${ticket["Status"]}</td>
            <td>${ticket["created_date"]}</td>
            <td>${ticket["nom"]}</td>
            <td>${ticket["prenom"]}</td>
        </tr>
        `;
    }); 
    zone.innerHTML = template;      
}