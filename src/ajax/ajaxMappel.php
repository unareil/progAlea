<?php
    require_once("../classes/individu.php");
    $maxnbpers = intval($_POST["maxnbpers"]);

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
            $monTab[] = $i;      
        }
    }
    
    // détermine un nombre aléatoire parmi les objets disponibles
    do
    {
        $numAlea = rand(0,intval($maxnbpers));
    } while(in_array($numAlea,$monTab) <> true);


    echo '<table cellpadding="7px">';

    for ($i = 0; $i < sizeof($monTab); $i++) 
    {
        if ($monTab[$i] == $numAlea)
        {
            echo '<script type="text/javascript" id="runscript">'.chr(13);
            $indiv[$i]->incrementeIteration();
            echo 'eval(personne'.$numAlea.'.setNbiteration('.$indiv[$i]->getIteration().'));'.chr(13);
            echo 'nbAleatoire='.$numAlea.';'.chr(13);
            echo '</script>'.chr(13);

            echo "<tr><td><div id='nom".$numAlea."' style='color:red'>".$indiv[$i]->infosCandidat()."</td><td id='count".$numAlea."' style='color:red'>".drawCounter($indiv[$i]->getIteration())."</td></tr></div>";
        }
        else
        {
            echo "<tr><td><div id='nom".$monTab[$i]."'>".$indiv[$i]->infosCandidat()."</td><td id='count".$monTab[$i]."'>".drawCounter($indiv[$i]->getIteration())."</td></tr></div>";
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