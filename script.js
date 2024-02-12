// Confirmation du mot de passe
// Vérifions si le mot de passe et la confirmation sont conformes
var mdp1 = document.querySelector('.mdp1');
var mdp2 = document.querySelector('.mdp2');
mdp2.onkeyup = function(){
    // Événement lorsqu'on écrit dans le champ : confirmation du mot de passe
    var message_error = document.querySelector('.message_error');
    if(mdp1.value !== mdp2.value){ // S'ils ne sont pas égaux
       // On affiche un message d'erreur
       message_error.innerText = "Les mots de passe ne sont pas conformes";
    } else { // Sinon
       // On écrit rien dans message_error
       message_error.innerText = "";
    }
}