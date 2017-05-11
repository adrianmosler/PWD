<?php

include_once 'libs/PDOConfig.php';
print_r($_POST);

if ($_POST) {
    $baseDatos = new PDOConfig();
    $baseDatos->beginTransaction();
    $sql = "INSERT INTO persona (NroDni,Nombre,Apellido,fechaNac,Telefono,Domicilio) VALUES ('".$_POST['dni'] ."','".$_POST['nombre']."','".$_POST['apellido']."','".$_POST['fechaNac']."','".$_POST['telefono']."','".$_POST['direccion']."')";
   
   // echo $sql;

    if (!($baseDatos->query($sql))) {
        echo "Error en la consulta";
        $baseDatos->rollBack();
        exit();//o sino una bandera para controlar la ejecucion del codigo posterior
    } else {
        
            //una vez insertada la persona con exito sigo con el auto
    		$sqlPatente = "SELECT Patente FROM auto WHERE Patente='" . $_POST['patente'] . "';";
            $resultadoPatente = $baseDatos->query($sqlPatente);

            if (!$resultadoPatente) {
                echo "Error en consulta patente <br><a href='index.php'>Volver a cargar datos<a>";
                $baseDatos->rollBack();
                exit();
            } else {
                if (count($resultadoPatente->fetchAll(PDO::FETCH_ASSOC)) == 0) {//entra si la patente no esta registrada
                    $sqlAuto = "INSERT INTO auto (Patente,Marca,Modelo,DniDuenio) VALUES ('" . $_POST['patente'] . "','" . $_POST['marca'] . "'," . $_POST['modelo'] . ",'" . $_POST['dniDuenio'] . "');";

                    if (!($baseDatos->query($sqlAuto))) {
                        echo "Error en la consulta al ingresar el auto";
                        $baseDatos->rollBack();
                        exit();
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
                            <a href='index.php'>Volver a cargar datos<a>
                            </div>
                        </body>
                   </html>";
                   $baseDatos->commit();
                    }
                } else {//entra por aca si la patente ya se encuentra registrada
                    echo "<!DOCTYPE html>
                  	<html>
                  	<head>
                  		<title>Ejercicio 5</title>
                  		<meta charset='utf-8'>
    					<link rel='stylesheet' href='../bootstrap-3.3.7-dist/css/bootstrap.css' media='screen'>
                  	</head>
                  	<body>
                            <div class='container'>
                            <h3>La patente ya se encuentra registrada</h3>
                            <a href='index.php'>Volver a cargar datos<a>

                  	    </div>
                  	
                  	</body>
                  	</html>";
                  	//poner un link que devuelva al formulario
                  	$baseDatos->rollBack();
                  	exit();
                }
            }






    }

   
              
  }
    else{
    	echo "no se recibieron datos";
    }
    $baseDatos=null;

?>




