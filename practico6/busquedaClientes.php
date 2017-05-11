<?php
include_once 'libs/PDOConfig.php';


$comboProvincias="";// en estas variables generamos el html basado en lo que recuperamos mediante php y sql
$checkMembresias="";

$baseDatos=new PDOConfig();
$sqlProvincias='SELECT Nombre,idProvincia FROM provincias';
$sqlMembresia='SELECT idMembresia,Descripcion FROM membresia';

$resultadoP=$baseDatos->query($sqlProvincias);
$resultadoM=$baseDatos->query($sqlMembresia);

if(!$resultadoP || !$resultadoM){
	echo "error en la consulta";
}
else{
	$datosP=$resultadoP->fetchAll(PDO::FETCH_ASSOC);
	$datosM=$resultadoM->fetchAll(PDO::FETCH_ASSOC);
//	print_r($datos);
//---------------------------------------------genero html select
 $comboProvincias.="<select name='cbProvincias' class='btn btn-default'> <option value='-1'>Seleccionar opcion</option>";

 foreach ($datosP as $provincias) {
    $comboProvincias.="<option value='".$provincias['idProvincia']."'>".$provincias['Nombre']."</option>";
 }

 $comboProvincias.="</select>";
//--------------------------------------------fin select

}

//--------------------------------------------genero html checkbox

foreach ($datosM as  $membresia) {
   $checkMembresias.="<input type='checkbox' name='membresia[]' value='".$membresia['idMembresia']."'> ".$membresia['Descripcion']." </input> ";
}

//-------------------------------------------fin html checkbox




if($_POST){//entra cuando se seleccionen todos los campos para la busqueda
	$filtro="";
	//recupero todos los datos a comparar
	$documento=$_POST['dni'];
	$nombre=$_POST['nombre'];
  $idProvincia=$_POST['cbProvincias'];
	$clienteDesde=$_POST['clienteDesde'];
  $arregloMembresias= array();

  //agregar las fechas y esas cosas que faltan en el filtro

  if (isset($_POST['membresia'])) {
    $arregloMembresias=$_POST['membresia'];
  }

  if ($documento!="") {
    $filtro.="AND  C.";
  }



/*
+
+
+
+
RESTO DE LOS FILTROS
+
+
+
+*/

//Este es un sql reducido
$sqlClientes = "SELECT C.NroDNI,C.Nombre,P.Nombre AS nomProvincia, M.Descripcion AS nomMembresia FROM clientes C "
            . "     INNER JOIN provincias P ON C.idProvincia = P.idProvincia "
            . "     INNER JOIN membresia M ON C.idMembresia = M.idMembresia WHERE 1=1 $filtro "
            . " ORDER BY C.Nombre ";




}else{
	echo 'hola no hice nada todavia';
}


?>




<!DOCTYPE html>
<html>
  <head>
    <title>Busqueda Clientes practico 6
    </title>
    <meta charset="utf-8">
    <link rel='stylesheet' href='../bootstrap-3.3.7-dist/css/bootstrap.css' media='screen'>
    <script type="text/javascript"> Poner codigo javascript </script>
  </head>



  <body>
    <div class="container">
      <h2>Busqueda de clientes
      </h2>
      <div class="row"><div class="col-lg-8"><hr></div></div>
      <form action="busquedaClientes.php" method="post">
        <div class="row">
          <div class="col-lg-4">
            <div class="form-group">
              <label for="dni" class="control-label col-sm-6">Nro. documento:
              </label>
              <input type="text" id="dni" name="dni" class="btn btn-default" size="20" placeholder="Ingrese documento">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label for="nombre" class="control-label col-sm-6">Nombre:
              </label>
              <input type="text" class="btn btn-default" size="20" placeholder="Ingrese nombre">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="form-group">
              <label for="clienteDesde" class="control-label col-sm-6">Cliente desde:
              </label>
              <input type="date" id="clienteDesde" name="clienteDesde" class="btn btn-default">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label for="clienteHasta" class="control-label col-sm-6">Cliente hasta:
              </label>
              <input type="date" id="clienteHasta" name="clienteHasta" class="btn btn-default">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="form-group">
              <label for="compraDesde" class="control-label col-sm-6">Ultima compra desde:
              </label>
              <input type="date" id="compraDesde" name="compraDesde" class="btn btn-default">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label for="compraHasta" class="control-label col-sm-6">Ultima compra hasta:
              </label>
              <input type="date" id="compraHasta" name="compraHasta" class="btn btn-default">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="form-group">
              <label for="provincia" class="control-label col-sm-6">Provincia:
              </label>

              <?php  echo $comboProvincias;  ?>

            </div>
          </div>
          <div class="col-lg-4">
          	<label for="deuda" class="control-label col-sm-6">Deuda hasta:</label>
          	<input type="text" id="deuda" name="deuda" class="btn btn-default">
          </div>
        </div>
        <div class="row">
         	<div class="col-lg-4">
         		<div class="form-group">
         			<label for="membresia" class="control-label col-sm-6">Membresía:</label>
         			<?php

              echo $checkMembresias;

         			?>
         		</div>

         	</div>
        </div>
        <div class="row">
        	<div class="col-lg-6">
        		<div class="form-group">
        			<label for="orden" class="control-label col-sm-4">Ordenar por:</label>

        			<input type="radio" name="orden" value="idCliente">Nro. cliente </input>
        			<input type="radio" name="orden" value="NroDNI">Nro. DNI </input>
        			<input type="radio" name="orden" > Deuda</input>
        			<input type="radio" name="orden" > Fecha ultima compra </input>
        			<input type="radio" name="orden" > Orden ascendente</input>
        			<input type="radio" name="orden" > Orden descendente </input>
        		</div>
        	</div>
        </div>
        <div class="row">
        </div>
        <input type="submit" value="Buscar" class="btn btn-default">
      </form>
    </div>



  </body>
</html>
