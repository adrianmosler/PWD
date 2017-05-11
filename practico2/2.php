<?php

if($_GET){
   $horas=0;
   $arregloHoras=array('lunes' => $_GET['lunes'],'martes'=>$_GET['martes'],'miercoles'=>$_GET['miercoles'],'jueves'=>$_GET['jueves'],'viernes'=> $_GET ['viernes'] );

   foreach ($arregloHoras as $dia => $cantidadHoras) {
   	$horas+=$cantidadHoras;
   }
   echo "<!DOCTYPE html>
<html>
<head>
<title>Ejercicio 2</title>
<meta charset='UTF-8'>
<link rel='stylesheet' href='//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css'>
</head>
<body>
<h3>La cantidad de horas de Programacion Web Dinamica en la semana es de $horas horas</h3>
</body>
</html>";

}
else{
	echo "No se encontraron datos";
}




?>