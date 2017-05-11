<?php

if ($_POST) {

    $datos = array("adrian" => 1234, "admin" => "admin", "invitado" => "");
    $nombre = $_POST["nombre"];
    $contrasena = $_POST["contrasena"];
    $encontrado = false;

    foreach ($datos as $nombreArreglo => $contrasenaArreglo) {
        if ($nombre == $nombreArreglo && $contrasena == $contrasenaArreglo) {
            $encontrado = true;
            echo("<!DOCTYPE html>
		<html>
		<head>
			<title>Ejercicio 9</title>
		<link rel='stylesheet' href='../bootstrap-3.3.7-dist/css/bootstrap.css' media='screen'>
	<meta charset='utf-8'>
		</head>
		<body>
		<h3>El usuario se encuentra en la base de datos</h3>
		
		</body>
		</html>");
        }
    }

    if (!$encontrado) {
        echo "<!DOCTYPE html>
	<html>
	<head>
		<title>Ejercicio 9</title>
		<link rel='stylesheet' href='../bootstrap-3.3.7-dist/css/bootstrap.css' media='screen'>
	<meta charset='utf-8'>
	</head>
	<body>
	<h3> No se encontro el usuario en la base de datos</h3>
	</body>
	</html>";
    }
} else {
    echo "<!DOCTYPE html>
	<html>
	<head>
		<title>Ejercicio 9</title>
		<link rel='stylesheet' href='../bootstrap-3.3.7-dist/css/bootstrap.css' media='screen'>
	<meta charset='utf-8'>
	</head>
	<body>
	<h3> No se han ingresado datos</h3>
	</body>
	</html>";
}