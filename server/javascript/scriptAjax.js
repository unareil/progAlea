// on supprime tous les objets xhr qui trainent...
var xhr = null;
/**
* fonction qui permet de créer l'objet ajax (appelé ici xhr)
*/

function getXhr(){
if(window.XMLHttpRequest) // Firefox et autres
{
xhr = new XMLHttpRequest();
}
else if(window.ActiveXObject)
{ // Internet Explorer
 try {
        xhr = new ActiveXObject("Msxml2.XMLHTTP");
      } catch (e) {
             xhr = new ActiveXObject("Microsoft.XMLHTTP");
	           }
}
else
{ // XMLHttpRequest non supporté par le navigateur
	alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
	xhr = false;
}
}
/* fin de la fonction qui permet de créer l'objet ajax (appelé ici xhr) */

/**
* Méthode qui sera appelée lorsque je veux que ma méthode appelle l'ajax
*/
function appelAjax()
{
getXhr();
// On définit ce qu'on va faire quand on aura la réponse
xhr.onreadystatechange = function()
{
	// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
	if(xhr.readyState == 4 && xhr.status == 200)
	{
		// reçoit la reponse de ajax et stocke la valeur dans laReponse
		laReponse = xhr.responseText;
		/* On remplit l'élément de la page en cours appellée (document) qui a un formulaire qui s'appelle monForm et 			un élément appelé champsA */
		document.monForm.champsB.value = laReponse;
		//element également renvoyé dans une autre div appellé titi
		document.getElementById("toto").innerHTML= laReponse;
	}
}
// Ici on ouvre la page ajax ou l'on souhaite traiter l'information
xhr.open("POST","genereFichier.php",true);
// ne pas oublier ça pour l'entete
xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
// ne pas oublier de poster les arguments
// ici, la valeur A qui correspond à champsA
valA = document.monForm.champsA.value;
xhr.send("personne="+document.getElementById("contenu").innerHTML); // on indique le nom du Post (valeurA) et sa valeur valA
}
