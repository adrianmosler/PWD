
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Presentacion BarcodeBakery</title>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.css" media="screen">

  </head>
  <body>
    <div class="container">
      <h1>Consulta de clientes <span class="glyphicon glyphicon-search"></span></h1>
      <form  action="index.php" method="post">
         <div class="form-group">
           <label for="codigo">Ingrese su codigo: </label>
           <input type="text" name="codigo" id="codigo" placeholder="Ingrese codigo" class="btn btn-default"><br>
           <input type="submit" name="name" value="Enviar" class="btn btn-default">
         </div>

      </form>
      <hr class="col-lg-3">

    </div>

  </body>
</html>

<?php
include_once('libs/PDOConfig.php');
$codigo=-1;

if($_POST){
$codigo=$_POST["codigo"];

$baseDatos=new PDOConfig();
$sql="SELECT NroDNI,Nombre,Localidad FROM clientes WHERE idCliente=".$codigo;//agregar mas informacion para mostrar
//echo "$sql";
$resultado=$baseDatos->query($sql);

if (!$resultado) {
  echo "<!DOCTYPE html>
  <html>
    <head>
    <link rel='stylesheet' href='bootstrap-3.3.7-dist/css/bootstrap.css' media='screen'>
    </head>
    <body>
    <div class='container'>
      <h4>Error en la base de datos,ingrese un valor numerico.</h4>
    </div>

    </body>
  </html>";
}
else {
  $dniPersona = $resultado->fetchAll(PDO::FETCH_ASSOC);// PDO::fech_assoc es la forma que quiero que me devuelva

   if(count($dniPersona)==0){
     echo "<!DOCTYPE html>
     <html>
       <head>
       <link rel='stylesheet' href='bootstrap-3.3.7-dist/css/bootstrap.css' media='screen'>
       </head>
       <body>
       <div class='container'>
         <h4>No hay personas cargadas con ese codigo.</h4>
       </div>

       </body>
     </html>";
   }
   else{
//print_r($dniPersona);
//poner mas informacion para que se imprima,probar asignandoselo a un string
      echo "<!DOCTYPE html>
      <html>
        <head>
        <link rel='stylesheet' href='bootstrap-3.3.7-dist/css/bootstrap.css' media='screen'>
        </head>
        <body>
        <div class='container'>
           <b>Nombre:</b> ".$dniPersona[0]['Nombre']."<br>
           <b>Localidad:</b> ".$dniPersona[0]['Localidad']."<br>
           <b>DNI:<b><br>
          <img src='crearBarra.php?dni=".$dniPersona[0]['NroDNI']."'/>
        </div>

        </body>
      </html>";

  }
 }
}




 ?>
