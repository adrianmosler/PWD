<?php


if($_POST){
$numeroA=$_POST["numeroA"];
$numeroB=$_POST["numeroB"];
$operacion=$_POST["operacion"];

echo "El resultado es:";

switch ($operacion) {
	case 0:
		echo ("<!DOCTYPE html>
		<html>
		<head>
			<title>Ejercicio 8</title>
		</head>
		<link rel='stylesheet' href='../bootstrap-3.3.7-dist/css/bootstrap.css' media='screen'>
	    <meta charset='utf-8'>
		<body>

		 <h4> ($numeroA + $numeroB) </h4>//PREGUNTAR
		
		</body>
		</html>");
		break;
	case 1:
	     echo $numeroA-$numeroB;
	     break;
    case 2:
          echo $numeroA*$numeroB;
          break;
    case 3:
          echo $numeroA/$numeroB;
          
          	# code...
          	break;      

	default:
		# code...
		break;
}



}