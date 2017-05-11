<?php
include_once 'libs/PDOConfig.php';

$baseDatos=new PDOConfig();
$patente=$_POST['patente'];
$sql='SELECT * FROM auto WHERE Patente="'.$patente.'"' ;//hay que encerrar las consultas where con comillas

$resultado=$baseDatos->query($sql);

if(!$resultado){
	echo "Error en la consulta";
}
else{

		$datos = $resultado->fetchAll(PDO::FETCH_ASSOC);
		if (count($datos)==0) {
			echo "No se ha encontrado la patente ingresada";
		}
		else{
			
	foreach ($datos as $row) {
		echo('Modelo: '.$row['Patente']."-Marca: ".$row['Marca'].'-Modelo: '.$row['Modelo'].'-DNI dueño: '.$row['DniDuenio'].'<br>');
}
		}


}

?>



