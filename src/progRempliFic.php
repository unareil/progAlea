<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Programme aleatoire</title>
		<script language="javascript">
		function verifTouche(e)
		{
			alert("t");
			if (e.keyCode == 13) {
				alert('entrer');
			}
		}

		function ajoute()
		{
			document.getElementById("contenu").innerHTML= document.getElementById("contenu").innerHTML + '$indiv[] = new Individu("'+monForm.nom.value+'","'+monForm.prenom.value+'");'+'<br/>';
			monForm.nom.value="";
			monForm.prenom.value="";
			return false;
		}

		function genere()
		{
		}
		</script>
		<script type="text/javascript" src="javascript/scriptAjaxGenereFichier.js"></script>
	</head>
	<body>
		<form name="monForm" method="POST" action="" onsubmit="return ajoute();">
			<label>Pr&eacute;nom:</label><input type="text" name="prenom"/>
			<label>Nom:</label><input type="text" name="nom"/>
			<input type="submit" value="ajouter" />
			<input type="button" value="g&eacute;n&eacute;rer fichier" onclick="appelAjaxGenereFic();"/>
		</form>
		<div id="contenu"></div>
	</body>

</html>
