<?php

if($_POST){
	$nombre=$_POST["nombre"];
    $deportes=$_POST["deporte"];
    $cont=0;
    echo "A $nombre les gusta los deportes:";
    foreach ($deportes as $valor) {
    	echo ("<br>".$valor);

    }
    echo "<br>La cantidad de deportes es:".count($deportes);





}
else{
	echo "No se enviaron datos";
}