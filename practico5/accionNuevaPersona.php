<?php

//print_r($_POST);

include_once 'libs/PDOConfig.php';

if ($_POST) {
    $baseDatos = new PDOConfig();
    $sql = "INSERT INTO persona (NroDni,Nombre,Apellido,fechaNac,Telefono,Domicilio) VALUES ('".$_POST['dni'] ."','".$_POST['nombre']."','".$_POST['apellido']."','".$_POST['fechaNac']."','".$_POST['telefono']."','".$_POST['direccion']."')";
   
   // echo $sql;

    if (!($baseDatos->query($sql))) {
        echo "Error en la consulta";
    } else {
        echo "Datos ingresados correctamente";
    }
} else {
    echo "No se recibieron datos";
}

$baseDatos=null;


?>