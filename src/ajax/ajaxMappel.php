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
        $indiv[$key] -> setIteration($_POST[$valeur]);
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

    echo '<table cellpadding="7px">';
    foreach($indiv as $key => $individu)
    {
        if ($key == $numAlea) 
        {
            echo '<script type="text/javascript" id="runscript">'.chr(13);
            $indiv[$numAlea]->incrementeIteration();
            echo 'personne'.$numAlea.'.augmenteNbiteration();';
            echo 'document.monForm.nbFois'.$numAlea.'.value='.$indiv[$numAlea]->getIteration().chr(13);
            echo 'nbAleatoire='.$numAlea.';';
            echo '</script>'.chr(13);
            echo "<tr><td><div id='selection' style='color:red'>".$key." ".$individu->infosCandidat()."</td><td style='color:red'>".drawCounter($individu->getIteration())."</td></tr></div>";
        }
        else
        {
            echo "<tr><td><div id='nom".$key."'>".$key." ".$individu->infosCandidat()."</td><td>".drawCounter($individu->getIteration())."</td></tr></div>";
        }
    }
    echo '</table>';
    echo '</div>'.chr(13);

    function drawCounter($n) {
        // $result = '('.$n.')';
        $elem = '<strong>';

        for ($i = 1; $i <= $n; $i++) {

            if ($i % 5 != 0) {
                // vertical line

                if ($i % 5 == 1 && $n - $i >= 4) {
                    // we add <del> tag
                $elem = $elem.'<del>';
                }

                $j = $i % 5;
                if ($j % 4 != 0) {
                    // we draw a vertical line and a space
                    $elem = $elem.'&#124;&nbsp;';
                } else {
                    // we draw a verical line
                    $elem = $elem.'&#124';
                }
            } else {
                // we draw an horizontal line using <del></del>
                
                $elem = $elem.'</del>';
                $elem = $elem.'&nbsp;&nbsp;';
            }
            if ($i == $n) {
                // this is the last one so we close tags

            }
        
        }

        $elem = $elem.'</strong>';
        return $elem;
    }


?>