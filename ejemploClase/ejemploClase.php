<?php

function main() {

    $encontrado = false;
    if ($_POST) {
        $legajo = $_POST["legajo"]; //hay que poner el nombre del atributo name
        $materia = $_POST["materia"];

        $datosMaterias = array("78028" => array("matematica", "programacion", "idiomas"), "32144" => array("matematica", "programacion"), "fai123" => array("programacion", "idiomas"), "fai454" => array("programacion"), "32422" => array("matematica", "programacion", "idiomas"));



        foreach ($datosMaterias as $valor => $arregloMaterias) {//busca el legajo que entra y lo compara con los que ya estan en la base
            if ($valor == $legajo) {



                foreach ($arregloMaterias as $indice) {

                    if ($materia == $indice) {
                        $encontrado = true;
                    }
                }
            }
        }

        if ($encontrado) {
            echo "<h3>El alumno con legajo $legajo curso la materia $materia<br />";
        } else {
            echo "El legajo no ha sido encontrado o la materia no esta asociada al legajo<br />";
        }
    } else {
        echo "No se recibieron datos<br />";
    }
}

main();
?>

