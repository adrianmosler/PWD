<?php
include_once 'libs/PDOConfig.php';

$baseDatos=new PDOConfig();
$sql='SELECT NroDni,Nombre,Apellido,Patente,Marca,Modelo FROM auto INNER JOIN persona ON persona.NroDni=auto.DniDuenio ORDER BY Apellido' ;

$resultado=$baseDatos->query($sql);

if(!$resultado){
	echo "Error en la consulta";
}
else{

		$datos = $resultado->fetchAll(PDO::FETCH_ASSOC);
		if (count($datos)==0) {
			echo "No hay autos asociados a las personas registradas en la base de datos";
		}
		else{
			
	foreach ($datos as $row) {
		echo("Numero DNI: ".$row['NroDni'].' - Apellido: '.$row['Apellido'].' - Nombre: '.$row['Nombre'].' - Modelo: '.$row['Patente']."-Marca: ".$row['Marca'].'-Modelo: '.$row['Modelo'].'<br>');
}
		}


}

?>