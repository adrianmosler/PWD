<?php
include_once 'libs/PDOConfig.php';


$baseDatos=new PDOConfig();
$consulta='SELECT NroDni,Nombre,Apellido FROM persona';

$resultado=$baseDatos->query($consulta);


if(!$resultado){
	echo "Error en la consulta";
}
else{
	$datosPersona = $resultado->fetchAll(PDO::FETCH_ASSOC);// PDO::fech_assoc es la forma que quiero que me devuelva

   if(count($datosPersona)==0){
   	echo "No hay personas cargadas en la base de datos";
   }
   else{
   	//print_r($datos);
   	foreach ($datosPersona as $row) {
   		
		echo "Numero DNI: ".$row['NroDni'].' - Apellido: '.$row['Apellido'].' - Nombre: '.$row['Nombre'].'<br>';
	}
   }

	
}



$baseDatos=null;// cerramos la conexion por las dudas




?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<br>
<a href="autosPersona.php"> Mostrar autos asociados a las personas listadas </a>

</body>
</html>