<?php

if($_POST){
  $nombre=$_POST['nombre'];
  $apellido=$_POST['apellido'];
  $edad=$_POST['edad'];

  if($edad>=18){
  	echo "<!DOCTYPE html>
	<html>
	<head>
		<title>Ejercicio 4</title>
		<link rel='stylesheet' href='../bootstrap-3.3.7-dist/css/bootstrap.css' media='screen'>
	</head>
	<body>
	<h3>La persona $nombre $apellido es mayor de edad</h3>
	</body>
	</html>";
  }
  else{
  	echo "<!DOCTYPE html>
	<html>
	<head>
		<title>Ejercicio 4</title>
		<link rel='stylesheet' href='../bootstrap-3.3.7-dist/css/bootstrap.css' media='screen'>
	</head>
	<body>

	<h3>La persona $nombre $apellido es menor de edad</h3>
	</body>
	</html>";
  }


}
else{
	echo "<!DOCTYPE html>
	<html>
	<head>
		<title>Ejercicio 4</title>
		<link rel='stylesheet' href='../bootstrap-3.3.7-dist/css/bootstrap.css' media='screen'>
	</head>
	<body>
	<h3>No se mandaron datos</h3>
	</body>
	</html>";
}

?>