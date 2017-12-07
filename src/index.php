<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Programme aleatoire</title>
        <style>
        #p {line-height: 0.5;}
        #affiche {
            position:absolute;
            top:80px;
            left:600px;
            line-height: 0.3;
        }
        #nbTourRestant {
            position:absolute;
            top:400px;
            right:500px;
            font-size:500%;
        }
        </style>
        <script language="JavaScript" type="text/JavaScript">
            <?php
                require_once("classes/individu.php");
                require_once("pers/personnes.php");

                $indiv[0]->genererClassJavascript();

                $num = 0;
                foreach ($indiv as $key => $individu) 
                {
                    $individu->genererObjetJavascript($num);
                    $num++;
                }
                echo 'var maxnbpers = '.($num-1).';';
            ?>
            // on supprime tous les objets xhr qui trainent...
            var xhr = null;
            var myVar;
            var nbTour = 1;
            var nbAleatoire = 0;
            var fin = false;
            var val = 0;
            var valMax = 0;
            var persmax = 0;
            var i = 0;
            var machaine = "";
            var envoi = "";
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
            
            function premierAppelAjax()
            {
                // reinitialiser les compteurs
                for (i = 0; i <= maxnbpers; i++) 
                {
                    eval("personne"+i+".setNbiteration(0);");
                }
                appelAjax();
            }

            function appelAjax()
            {
                document.getElementById("go").disabled = true;
                document.getElementById("pause").disabled = false;
                document.getElementById("reinit").disabled = true;
                
                // reinitialisation des tailles de résultats
                document.getElementById('nbTourRestant').style.fontWeight="normal";
                document.getElementById('nbTourRestant').style.right="500px";
                document.getElementById('nbTourRestant').style.fontSize="500%";

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
                        //alert(laReponse);

                        eval(document.getElementById("runscript").innerHTML);
                        if (fin == true) 
                        {
                            document.getElementById("go").disabled = false;
                            document.getElementById("reinit").disabled = false;

                            valmax = personne0.nbiteration;
                            persmax = 0;
                            for (i = 0; i <= maxnbpers; i++) 
                            {
                                eval("val = personne"+i+".nbiteration;");
                                if (val > valmax)
                                {
                                    valmax = val;
                                    persmax = i;
                                }
                            }
                            if (persmax != nbAleatoire)
                            {
                                document.getElementById("selection").style.color = "black";
                                eval('document.getElementById("nom'+persmax+'").style.color="red";');
                                eval('document.getElementById("nom'+persmax+'").style.fontWeight="bold";');
                            } 
                            eval("document.monForm.cle"+persmax+".checked=false;");
                            // si toutes les cases sont décochées, on recoche.  TODO

                            machaine="Le candidat est "+eval("personne"+persmax+".nom")+" "+eval("personne"+persmax+".prenom")+" <small>(sélectionné "+valmax+" fois)</small>.";
                            eval('document.getElementById("nbTourRestant").innerHTML = machaine;');
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
                nbReste = valA - nbTour;
                //xhr.send("valeurA="+valA); // on indique le nom du Post (valeurA) et sa valeur valA

                // Transcription de l'objet en texte
                envoi = "valeurA="+nbReste;
                for (i = 0; i <= maxnbpers; i++) 
                {
                    if (eval("personne"+i+".cocheTF") == 1)
                    {
                        //alert("nom = "+eval("personne"+i+".nom")+" nb = "+eval("personne"+i+".nbiteration"));
                        envoi = envoi+" & personne"+i+"nom="+eval("personne"+i+".nom");
                        envoi = envoi+" & personne"+i+"prenom="+eval("personne"+i+".prenom");
                        envoi = envoi+" & personne"+i+"nbiteration="+eval("personne"+i+".nbiteration");
                        envoi = envoi+" & personne"+i+"nombreSelection="+eval("personne"+i+".nombreSelection");
                        envoi = envoi+" & personne"+i+"cocheTF=true";
                    }
                }
                envoi = envoi+" & maxnbpers="+maxnbpers;
                xhr.send(envoi);

                if (nbTour < valA) 
                {
                    myVar = setTimeout(function(){appelAjax()}, 300);
                    document.getElementById('nbTourRestant').innerHTML = valA - nbTour;
                    nbTour = nbTour + 1;
                    fin = false;
                }
                else 
                {
                    document.getElementById('nbTourRestant').style.fontSize   = "1.2em";
                    document.getElementById('nbTourRestant').style.fontWeight = "bold";
                    document.getElementById('nbTourRestant').style.right      = "300px";
                    stopProg();
                    nbTour = 1;
                    fin = true;
                }
            }

            function appelProg()
            {
                myVar = setTimeout(function(){appelAjax()}, 300);
            }

            function stopProg() {
                clearTimeout(myVar);
                document.getElementById("go").disabled = false;
                document.getElementById("pause").disabled = true;
            }

            function resetProg() {
                document.getElementById('affiche').innerHTML = "";
                document.getElementById('nbTourRestant').innerHTML = "";
            }

        </script>
    </head>
    <body>
        <?php
            echo "<div id=page>";
            echo '<form name="monForm" method="post" action="#" onsubmit="return false;">';
            foreach ($indiv as $key => $individu) 
            {
                echo '<input type="checkBox" name="cle'.$key.'" checked>'.$individu->infosIndividu().'<br/>';
            }
        ?>
        <input type="text"   value="1" name="champsA">
        <input type="submit" value="Go"    onClick="premierAppelAjax(); return false;" id="go">
        <input type="Button" value="Stop"  onClick="stopProg();" id="pause">
        <input type="reset"  value="Reset" onClick="resetProg();" id="reinit">
        </form>
        <div id="affiche">&nbsp;</div>
        <div id="nbTourRestant">&nbsp;</div>
        </div>
    </body>
</html>