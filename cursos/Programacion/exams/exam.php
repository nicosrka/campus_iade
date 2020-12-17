<?php
error_reporting(0);
$title = "Programacion";
$address = "index.php";
$randomizequestions = "yes";

$a = array(
        1 => array(
                0 => "Que es un objeto?",
                1 => "Instancia de una clase",
                2 => "Coleccion de datos",
                3 => "Un dato que contiene multiples variables",
                4 => "Ninguna de las anteriores",
                6 => 1
        ),
        2 => array(
                0 => "Que es una clase abstracta?",
                1 => "Permite ser instanciada unicamente 1 vez",
                2 => "No permite herencia",
                3 => "Se usa con el fin de heredar sin instanciar",
                4 => "Ninguna de las anteriores",
                6 => 3
        ),
        3 => array(
                0 => "Que es un memory leak?",
                1 => "El no controlar la memoria solicitada",
                2 => "Un error de hardware",
                3 => "Problema en el condensador de flujo",
                4 => "Ninguna de las anteriores",
                6 => 1
        ),
);
$max = 3;
$question = $_POST["question"];

if ($_POST["Randon"] == 0) {
        if ($randomizequestions == "yes") {
                $randval = mt_rand(1, $max);
        } else {
                $randval = 1;
        }
        $randval2 = $randval;
} else {
        $randval = $_POST["Randon"];
        $randval2 = $_POST["Randon"] + $question;
        if ($randval2 > $max) {
                $randval2 = $randval2 - $max;
        }
}

$ok = $_POST["ok"];

if ($question == 0) {
        $question = 0;
        $ok = 0;
        $percentaje = 0;
} else {
        $percentaje = Round(100 * $ok / $question);
}
?>

<HTML>

<HEAD>
        <SCRIPT LANGUAGE='JavaScript'>
                function Goahead(number) {
                        if (document.percentaje.response.value == 0) {
                                if (number == <?php print $a[$randval2][6]; ?>) {
                                        document.percentaje.response.value = 1
                                        document.percentaje.question.value++
                                        document.percentaje.ok.value++
                                } else {
                                        document.percentaje.response.value = 1
                                        document.percentaje.question.value++
                                }
                        }
                }
        </SCRIPT>

</HEAD>

<BODY BGCOLOR=FFFFFF>

        <CENTER>
                <H1><?php print "$title"; ?></H1>
                <TABLE BORDER=0 CELLSPACING=5 WIDTH=500>
                        <?php if ($question < $max) { ?>
                                <TR>
                                        <TD ALIGN=RIGHT>
                                                <FORM METHOD=POST NAME="percentaje" ACTION="<?php print $URL; ?>">
                                                        <input type=submit value="Siguiente >>">
                                                        <input type=hidden name=response value=0>
                                                        <input type=hidden name=question value=<?php print $question; ?>>
                                                        <input type=hidden name=ok value=<?php print $ok; ?>>
                                                        <input type=hidden name=Randon value=<?php print $randval; ?>>
                                                        <br><?php print $question + 1; ?> / <?php print $max; ?>
                                                </FORM>
                                                <HR>
                                        </TD>
                                </TR>

                                <TR>
                                        <TD>
                                                <FORM METHOD=POST NAME="question" ACTION="">
                                                        <?php print "<b>" . $a[$randval2][0] . "</b>"; ?>

                                                        <BR>     <INPUT TYPE=radio NAME="option" VALUE="1" onClick=" Goahead (1);"><?php print $a[$randval2][1]; ?>
                                                        <BR>     <INPUT TYPE=radio NAME="option" VALUE="2" onClick=" Goahead (2);"><?php print $a[$randval2][2]; ?>
                                                        <?php if ($a[$randval2][3] != "") { ?>
                                                                <BR>     <INPUT TYPE=radio NAME="option" VALUE="3" onClick=" Goahead (3);"><?php print $a[$randval2][3];
                                                                                                                                        } ?>
                                                        <?php if ($a[$randval2][4] != "") { ?>
                                                                <BR>     <INPUT TYPE=radio NAME="option" VALUE="4" onClick=" Goahead (4);"><?php print $a[$randval2][4];
                                                                                                                                        } ?>
                                                        <?php if ($a[$randval2][5] != "") { ?>
                                                                <BR>     <INPUT TYPE=radio NAME="option" VALUE="5" onClick=" Goahead (5);"><?php print $a[$randval2][5];
                                                                                                                                        } ?>
                                                </FORM>

                                        <?php
                                } else {
                                        ?>
                                <TR>
                                        <TD ALIGN=Center>
                                                El examen ha finalizado
                                                <BR>Porcentaje de respuestas correctas: <?php print $percentaje; ?> %
                                                <?php
                                                if ($percentaje >= 60) {
                                                        $nota = ($percentaje / 10);
                                                        $db->query("UPDATE `curso_p` SET `nota`= '$nota' WHERE id_curso = '$courseId' AND id_persona = '$userId'");
                                                ?>
                                                        <h2>Felicitaciones! has aprobado el examen.</h2><br>
                                                        <h3>Puede descargar el certificado del curso dentro de Mis Cursos<h3>
                                                                <?php } 
                                                                else { 
                                                                        echo  "<h2>No ha alcanzado la nota minima.</h2><br>";
                                                                } ?>
                                                                <p><A HREF="<?php print $address; ?>">Volver</a>

                                                                <?php } ?>

                                        </TD>
                                </TR>
                </TABLE>
        </CENTER>
</BODY>
</HTML>