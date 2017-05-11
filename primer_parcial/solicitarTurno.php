	<?php
//aca recupero toda la informacion para mostrar en el html
include_once 'libs/PDOConfig.php';


$checkTramite="";
try {
	$baseDatos=new PDOConfig();
} catch (Exception $e) {
	echo "Tratando error";
	
}


$sqlTramite='SELECT idtramite,descripcion FROM tramite';
$resultadoT=$baseDatos->query($sqlTramite);
if(!$resultadoT){
	echo "error en la consulta";
}
else{
	$datosT=$resultadoT->fetchAll(PDO::FETCH_ASSOC);
//----------------------genero checkbox a partir de la base de datos------------------------------------
foreach ($datosT as  $tramite) {
   $checkTramite.="<input type='checkbox' name='tramite[]' value='".$tramite['idtramite']."'> ".$tramite['descripcion']." </input><br> ";
}
//$checkTramite listo



}






?>





<!DOCTYPE html>
<html>
<head>
	<title>Solicitar turno</title>
	<meta charset="utf-8">
    <link rel='stylesheet' href='bootstrap-3.3.7-dist/css/bootstrap.css' media='screen'>
    <script type="text/javascript" src='validacion.js'></script>
</head>
<body>
<div class="container">
<h1>Turnero</h1>

	<form action="registrarTurno.php" method="post" onsubmit="return validar()" id="formulario">

		<div class="form-group">
			<label for="dni">Numero de documento: </label><br>
			<input type="text" name="dni" id="dni" class="btn btn-default" placeholder="Ingrese documento" size="30"><em> Ingrese el documento sin puntos</em>
		</div>
		<div class="form-group">
			<label for="tramite">Tramites:</label><br>
			<?php echo $checkTramite; ?>
		</div>
     <input type="submit" class="btn btn-default" value="Solicitar turno">
	</form>







</div>



</body>
</html>
