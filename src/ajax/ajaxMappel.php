<?php
require_once("../classes/individu.php");
require_once("../pers/personnes.php");
$monTab[]=-1;
//var_dump($_POST);

foreach ($indiv as $key => $individu) {
    $valeur="cle".$key;
    if($_POST[$valeur]=="true") {
        $monTab[]=$key;
    }
}
//var_dump($monTab[]);
//echo "toto";

do {
    $numAlea=rand(0,count($indiv));
} while(in_array($numAlea,$monTab)<>true);



// code de triche
/*
if ($_POST["valeurA"]==-1)
{
$numAlea=9;
}
*/

foreach($indiv as $key => $individu) {
    if ($key == $numAlea) {
        echo '<script type="text/javascript" id="runscript">'.chr(13);
        echo 'document.monForm.nbFois'.$key.'.value=Number(document.monForm.nbFois'.$key.'.value)+1'.chr(13);
        echo 'nbAleatoire='.$numAlea.';';
        echo '</script>'.chr(13);
        echo "<b style='color:red;'>".$key." ".$individu->infosIndividu()."</b>"."<br/>";
    }
    else {
        echo "".$key." ".$individu->infosIndividu().""."<br/>";
    }
}
?>
