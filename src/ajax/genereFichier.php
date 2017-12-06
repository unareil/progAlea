<?php
if (isset($_POST["personne"])) {
    $texteAecrire=$_POST["personne"];
    $texteAecrire=str_replace("<br>",chr(13),$texteAecrire);
    $tampon = fopen("../pers/personnes.php", "w");
    fwrite($tampon,'<?php'.chr(13));
    fwrite($tampon,$texteAecrire);
    fwrite($tampon,'?>'.chr(13));
    fclose($tampon);
    echo "Fichier g&eacute;n&eacute;r&eacute;...";
}
?>

