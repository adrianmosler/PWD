<?php


if($_POST){

	$nombre=$_POST["nombre"];
	$apellido=$_POST["apellido"];
	$estudios=$_POST["estudios"];

	echo "$nombre $apellido $estudios";


}
else{
	echo "No se recibieron datos";
}





?>