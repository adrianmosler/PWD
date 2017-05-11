<?php
if ($_POST){
$nombre = $_POST['nombre'] ;
$apellido = $_POST['apellido'] ;
$edad = $_POST['edad'];
$direccion=$_POST['direccion'];
echo "<!DOCTYPE html>
<html>
<head>
<title>Formulario</title>
<meta charset='UTF-8'>
<link rel='stylesheet' href='//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css'>
</head>
<body>
<h3>Hola!,yo soy $nombre $apellido,tengo $edad años y vivo en $direccion</h3>
</body>
</htm>
";
}else{
echo "No se recibieron datos<br />";
}
?>