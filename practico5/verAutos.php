<?php
include_once 'libs/PDOConfig.php';


$baseDatos=new PDOConfig();
$consulta1='SELECT * FROM auto';// en vez de poner * poner todos los campos,por una cuestion de que hay mas detaller de que quiero recuperar
$consulta2='SELECT NroDni,Nombre,Apellido FROM persona';

$resultado1=$baseDatos->query($consulta1);
$resultado2=$baseDatos->query($consulta2);


if(!$resultado1){
	echo "Error en la consulta";
}
else{
	$datos = $resultado1->fetchAll(PDO::FETCH_ASSOC);// PDO::fech_assoc es la forma que quiero que me devuelva

   if(count($datos)==0){
   	echo "No hay autos cargados en la base de datos";
   }
   else{
   	//print_r($datos);
   	foreach ($datos as $row) {
   		
		echo('Modelo: '.$row['Patente']."-Marca: ".$row['Marca'].'-Modelo: '.$row['Modelo'].'-DNI dueño: '.$row['DniDuenio'].'<br>');
	}
   }

	
}

echo "<br>----------------------------------------------------------- <br><br>";

if(!$resultado2){
	echo "Error en la consulta";
}
else{
	$datos= $resultado2->fetchAll(PDO::FETCH_ASSOC);
	//print_r($datos);
	if(count($datos)==0){
		echo "No hay personas cargadas en la base de datos";
	}
	else{
		foreach ($datos as $row) {

		echo "Numero DNI: ".$row['NroDni'].' - Apellido: '.$row['Apellido'].' - Nombre: '.$row['Nombre'].'<br>';
	}
	}
	
}


$baseDatos=null;// cerramos la conexion por las dudas


?>
