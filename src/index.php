<?php
require_once("classes/individu.php");
require_once("pers/personnes.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Programme aleatoire</title>
        <style>
        #affiche {
            position:absolute;
            top:80px;
            left:600px;
        }
        #nbTourRestant {
            position:absolute;
            top:400px;
            right:500px;
            font-size:500%;
        }
        </style>
        <script language="JavaScript" type="text/JavaScript">
            // on supprime tous les objets xhr qui trainent...
            var xhr = null;
            var myVar;
            var nbTour = 0;
            var nbAleatoire = 0;
            var fin = false;
            /**
            * fonction qui permet de creer l'objet ajax (appela ici xhr)
            */

            function getXhr()
            {
                if(window.XMLHttpRequest) { // Firefox et autres
                    xhr = new XMLHttpRequest();
                }
                else if(window.ActiveXObject) { // Internet Explorer
                    try {
                        xhr = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e) {
                        xhr = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                }
                else { // XMLHttpRequest non supporte par le navigateur
                    alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
                    xhr = false;
                }
            }
            /* fin de la fonction qui permet de creer l'objet ajax (appele ici xhr) */

			/**
			* Methode qui sera appelee lorsque je veux que ma methode appelle l'ajax
			*/
			function sansEnvoi()
			{
				event.preventDefault();
				appelAjax;
				}
			function appelAjax()
			{
				document.getElementById("go").disabled = true;
				document.getElementById("reinit").disabled = true;
				getXhr();
				// On definit ce qu'on va faire quand on aura la reponse
				xhr.onreadystatechange = function()
				{
					// On ne fait quelque chose que si on a tout recupere et que le serveur est ok
					if(xhr.readyState == 4 && xhr.status == 200) {
						// recoit la reponse de ajax et stocke la valeur dans laReponse

						laReponse = xhr.responseText;
						/* On remplit l'element de la page en cours appellee (document) qui a un formulaire qui s'appelle monForm et             un element appele champsA */
						document.getElementById('affiche').innerHTML = laReponse;
						eval(document.getElementById("runscript").innerHTML);
						if (fin==true) {
							machaine="document.monForm.cle"+nbAleatoire+".checked=false;";
							eval(machaine);
							document.getElementById("go").disabled = false;
							document.getElementById("reinit").disabled = false;
						}
					}
				}
				// Ici on ouvre la page ajax ou l'on souhaite traiter l'information
				xhr.open("POST","ajax/ajaxMappel.php",true);
				// ne pas oublier pour l'entete
				xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
				// ne pas oublier de poster les arguments
				// ici, la valeur A qui correspond a champsA
				valA = document.monForm.champsA.value;
				nbReste=valA-nbTour;
				//xhr.send("valeurA="+valA); // on indique le nom du Post (valeurA) et sa valeur valA
				<?php
				echo 'machaine="";'.chr(13);
				echo 'envoi="valeurA="+nbReste;'.chr(13);
				foreach ($indiv as $key => $individu) {
					$val="document.monForm.cle".$key.".checked";
					echo "val".$key."=".$val.";".chr(13);
					echo 'envoi+="& cle'.$key.'=" + val'.$key.";".chr(13);
					$valb="document.monForm.nbFois".$key.".value";
					echo "nbFois".$key."=".$valb.";".chr(13);
					echo 'envoi+="& nbFois'.$key.'=" + nbFois'.$key.";".chr(13);
				}
				//echo "alert(envoi);";
				echo 'xhr.send(envoi);'.chr(13);
				?>
				if (nbTour <= valA) {
					myVar = setTimeout(function(){appelAjax()}, 500);
					document.getElementById('nbTourRestant').innerHTML=valA-nbTour;
					nbTour=nbTour+1;
					fin = false;
				}
				else {
					document.getElementById('nbTourRestant').style.fontSize="1.2em";
					document.getElementById('nbTourRestant').style.fontWeight="bold";
					document.getElementById('nbTourRestant').style.right="300px";
					document.getElementById('nbTourRestant').innerHTML="Le candidat &agrave; passer au tableau est en gras et en rouge";
					stopProg();
					nbTour = 0;
					fin = true;
				}
			}

            function appelProg()
            {
                myVar = setTimeout(function(){appelAjax()}, 500);
            }

            function stopProg() {
                clearTimeout(myVar);
            }

            function resetProg() {
				
				stopProg();
                nbTour = 0;
				fin = true;
				document.getElementById('affiche').innerHTML = "";
				document.getElementById('nbTourRestant').innerHTML = "";
            }

        </script>
    </head>
	<body>
		<?php
		echo "<DIV id=page>";
		echo '<form name="monForm" method="post" action="#" onsubmit="return false;">';
		foreach($indiv as $key => $individu) {
		echo '<input type="checkBox" name="cle'.$key.'" checked>'.$individu->infosIndividu().'<input type="hidden" name="nbFois'.$key.'" size=1><br/>';
		}
		?>
		<input type="text" name="champsA" value="3">
		<input type="submit"value="Go" onClick="appelAjax(); return false;" id="go">
		<input type="Button" value="Stop" onClick="stopProg();" id="pause">
		<input type="reset" value="Reset" onClick="stopProg();" id="reinit">
		</form>
		<div id="affiche">&nbsp;</div>
		<div id="nbTourRestant">&nbsp;</div>
		</div>
	</body>
</html>
