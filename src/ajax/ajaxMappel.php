<?php
    require_once("../classes/individu.php");
    $monTab[] =-1;

    $maxnbpers = $_POST["maxnbpers"];


    // Recopie les objets du javascript
    for ($i = 0; $i <= $maxnbpers; $i++) 
    {
        $objet="personne".$i;
        $nom=$objet."nom";
        $prenom=$objet."prenom";
        $nbiteration=$objet."nbiteration";
        $nombreSelection=$objet."nombreSelection";
        $cocheTF=$objet."cocheTF";
        if(isset($_POST[$nom]))
        {
            $indiv[] = new Individu($_POST[$nom],$_POST[$prenom],$_POST[$nbiteration],$_POST[$nombreSelection],$_POST[$cocheTF]);
            $monTab[]=$i;
        }
    }

    // détermine un nombre aléatoire parmi les objets disponibles
    do
    {
        $numAlea = rand(0,count($indiv));
    } while(in_array($numAlea,$monTab) <> true);


    foreach($indiv as $key => $individu)
    {
        if ($key == $numAlea) 
        {
            echo '<script type="text/javascript" id="runscript">'.chr(13);
            $indiv[$numAlea]->incrementeIteration();
            echo 'eval(personne'.$numAlea.'.setNbiteration('.$indiv[$numAlea]->getIteration().'));'.chr(13);
            echo 'nbAleatoire='.$numAlea.';'.chr(13);
            echo '</script>'.chr(13);
            echo "<p id='selection' style='color:red;'>".$key." ".$individu->infosCandidat()."</p>";
        }
        else
        {
            echo "<p id='nom".$key."'>".$key." ".$individu->infosCandidat().""."</p>";
        }
    }
?>