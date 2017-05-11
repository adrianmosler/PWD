<?php

include_once 'libs/PDOConfig.php';

if ($_POST) {
    $baseDatos = new PDOConfig();
    $sqlDni = "SELECT NroDni FROM persona WHERE NroDni='" . $_POST['dniDuenio'] . "';";
    $resultado = $baseDatos->query($sqlDni);

    if (!$resultado) {
        echo "Error en la consulta";
    } else {
        $arregloDni = $resultado->fetchAll(PDO::FETCH_ASSOC);

        if (count($arregloDni) == 0) {
            echo "<!DOCTYPE html>
    		<html>
    		<head>
    			<title>Ejercicio 5</title>
    			<meta charset='utf-8'>
                <link rel='stylesheet' href='../bootstrap-3.3.7-dist/css/bootstrap.css' media='screen'>
    		</head>
    		<body>
    		<div class='container'>
    		<h3>El DNI ingresado no corresponde a una persona guardada en nuestra base de datos,para registrar una persona haga click <a href='nuevaPersona.php'>AQUI</a></h3>
    		</div>
    		</body>
    		</html>";
        } else {
            $sqlPatente = "SELECT Patente FROM auto WHERE Patente='" . $_POST['patente'] . "';";
            $resultadoPatente = $baseDatos->query($sqlPatente);

            if (!$resultadoPatente) {
                echo "Error en consulta patente repetida";
            } else {
                if (count($resultadoPatente->fetchAll(PDO::FETCH_ASSOC)) == 0) {



                    $sqlAuto = "INSERT INTO auto (Patente,Marca,Modelo,DniDuenio) VALUES ('" . $_POST['patente'] . "','" . $_POST['marca'] . "'," . $_POST['modelo'] . ",'" . $_POST['dniDuenio'] . "');";






                    if (!($baseDatos->query($sqlAuto))) {
                        echo "Error en la consulta al ingresar el auto";
                    } else {
                        echo "<!DOCTYPE html>
                    <html>
                       	<head>
                		<title>Ejercicio 5</title>
                        	<meta charset='utf-8'>
                                <link rel='stylesheet' href='../bootstrap-3.3.7-dist/css/bootstrap.css' media='screen'>
                        </head>
                        <body>
                            <div class='container'>
                            <h2>El auto se ha registrado correctamente</h2>
                            </div>
                        </body>
                   </html>";
                    }
                } else {
                    echo "<!DOCTYPE html>
                  	<html>
                  	<head>
                  		<title>Ejercicio 5</title>
                  		<meta charset='utf-8'>
    					<link rel='stylesheet' href='../bootstrap-3.3.7-dist/css/bootstrap.css' media='screen'>
                  	</head>
                  	<body>
                            <div class='container'>
                            <h3>La patente ya se encuentra registrada,click <a href='nuevoAuto.php'>AQUI</a> para volver al formulario de registro del automovil</h3>

                  	    </div>
                  	
                  	</body>
                  	</html>";
                }
            }
        }
    }
} else {
    echo "No se encontraron datos";
}
