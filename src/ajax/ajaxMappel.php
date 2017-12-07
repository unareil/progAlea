<?php
    require_once("../classes/individu.php");
    require_once("../pers/personnes.php");
    $monTab[] = -1;
    //var_dump($_POST);

    foreach ($indiv as $key => $individu)
    {
        $valeur = "cle".$key;
        if($_POST[$valeur] == "true")
        {
            $monTab[] = $key;
        }
        $valeur = "nbFois".$key;
        $indiv[$key]->setIteration($_POST[$valeur]);
    }
    //var_dump($monTab[]);
    //echo "toto";

    do
    {
        $numAlea=rand(0,count($indiv));
    } while(in_array($numAlea,$monTab)<>true);

    // code de triche
    /*
    if ($_POST["valeurA"]==-1)
    {
        $numAlea=9;
    }
    */
    echo '<div id="divisionReponse">'.chr(13);

    foreach($indiv as $key => $individu)
    {
        if ($key == $numAlea) {
            echo '<script type="text/javascript" id="runscript">'.chr(13);
            echo 'document.monForm.nbFois'.$key.'.value=Number(document.monForm.nbFois'.$key.'.value)+1'.chr(13);
            echo 'nbAleatoire='.$numAlea.';';
            echo 'personne'.$numAlea.'.augmenteNbiteration();';
            echo '</script>'.chr(13);
            echo "<p id='selection' style='color:red;'>".$key." ".$individu->infosCandidat()."</p>";
        }
        else
        {
            echo "<p id='nom".$key."'>".$key." ".$individu->infosCandidat().""."</p>";
        }
    }
    echo '</div>'.chr(13);
?>