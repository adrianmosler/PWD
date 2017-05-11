<?php

	if($_POST){
		$usuario=$_POST["usuario"];
        echo "<!DOCTYPE html>
        <html>
        <head>
        	<title>Ejercicio 3</title>
        	<link rel='stylesheet' href='//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css'>
        </head>
        <body>

        <h2>Bienvenida/o $usuario a nuestra plataforma de trabajo</h2>
        
        </body>
        </html>";




	}
	else{
		echo "<!DOCTYPE html>
		<html>
		<head>
			<title>Ejercicio 3</title>
			<link rel='stylesheet' href='//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css'>
		</head>
		<body>
		   No se recibieron datos
		</body>
		</html>";
	}




?>