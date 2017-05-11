<?php

include_once 'libs/PDOConfig.php';

$comboPuesto="";

$baseDatos=new PDOConfig();
$sqlPuesto='SELECT idpuesto,descripcion FROM puesto';

$resultadoP=$baseDatos->query($sqlPuesto);

if(!$resultadoP){
	echo "error en la consulta";
}
else{
	$datosP=$resultadoP->fetchAll(PDO::FETCH_ASSOC);

 $comboPuesto.="<select name='cbPuesto' id='cbPuesto'class='btn btn-default'> <option value=0 selected>Seleccionar opcion</option>";

 foreach ($datosP as $puesto) {
    $comboPuesto.="<option value='".$puesto['idpuesto']."'>".$puesto['descripcion']."</option>";
 }

 $comboPuesto.="</select>";

}






?>








<!DOCTYPE html>
<html>
<head>
	<title>Siguiente turno</title>
	<meta charset="utf-8">
    <link rel='stylesheet' href='bootstrap-3.3.7-dist/css/bootstrap.css' media='screen'>
    <script type="text/javascript">

    function validar(){
         var resultado=true;
    	 indice = document.getElementById("cbPuesto").selectedIndex;

	if( indice == null || indice == 0 ) {

		  document.getElementById("cbPuesto").style.borderColor="red";
		  resultado=false;
		}

      return resultado;
	}

    </script>
</head>
<body>
<div class="container">
<h1>Turnero</h1>

	<form action="atenderCiudadano.php" method="post" onsubmit="return validar();">

		<div class="form-group">
			<label for="puesto">Puesto de trabajo: </label><br>
			<?php echo $comboPuesto; ?>
		</div>

     <input type="submit" class="btn btn-default" value="Solicitar turno">
	</form>

</div>

</body>
</html>
