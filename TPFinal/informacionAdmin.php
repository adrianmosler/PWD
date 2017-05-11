<?php
include_once 'libs/PDOConfig.php';
include_once 'libs/Login.php';

// hay que hacer una sesion para saber si es administrador que es usuario o si es cliente que es otra tabla
$baseDatos=new PDOConfig();
$oLogin=new Login();
$sqlDatos="";



    $esCliente=true;
    $botonCompra="<a href='agregarProductoPedido.php?idProducto' class='btn btn-default' name='botonCompra'>Comprar</a>";
    $botonSesion="<a href='cerrarSesion.php'><span class='glyphicon glyphicon-log-in'></span> Cerrar Sesión</a>";
    $botonNombreUsuario="<a href='informacionUsuario.php'><span class='glyphicon glyphicon-user'></span>".$oLogin->getNombreUsuario()."</a>";





if ($oLogin->activa()) {
   if ($oLogin->getRol()=="administrador") {
     $sqlDatos="SELECT * FROM usuario  WHERE nombreusuario='".$oLogin->getNombreUsuario()."';";

   }
   else {
     //salir
     }
   }
$resultadoConsulta=$baseDatos->query($sqlDatos);
if (!$resultadoConsulta) {
  echo "Error al consultar en la base de datos por el usuario";
}
else{
  //tener en cuenta que el cliente tiene datos demas
  $datosConsulta=$resultadoConsulta->fetchAll(PDO::FETCH_ASSOC);
  $datosMostrar="<h3>Datos personales</h3><table class='table table-striped'>
  <tr><td><strong>Nombre:</strong>".$datosConsulta[0]['nombre']."</td></tr>
  <tr><td><strong>Apellido:</strong>".$datosConsulta[0]['apellido']."</td></tr>
  <tr><td><strong>Nombre de usuario:</strong>".$datosConsulta[0]['nombreusuario']."</td></tr>
  <tr><td><strong>Fecha de nacimiento:</strong>".$datosConsulta[0]['fechanacimiento']."</td></tr>
  <tr><td><strong>DNI:</strong>".$datosConsulta[0]['dni']."</td></tr>
  <tr><td><a href='cambiarContrasenia.php' class='btn btn-default'>Cambiar contraseña</a></td></tr>
  </table>";




}




 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Informacion Usuario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="css/menu.css" media="screen">
    <link rel="stylesheet" href="css/swipebox.css" media="screen" title="no title">
    <script  type="text/javascript" src="js/jquery-3.1.1.js"></script>
    <script  type="text/javascript" src="js/jquery.swipebox.js"></script>
    <link rel="shorcut icon" href="img/logo.png">
  </head>
  <body>
    <div class="container">
      <div class="col-lg-12">
        <img src="img/header.jpg" height="190" width="1110" class="img img-rounded" />
        <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="#">CompuTech</a>
          </div>
          <ul class="nav navbar-nav">
            <li class="active"><a href="compras.php">Home</a></li>
            <li><a href="formularioRegistro.php">Añadir administrador</a></li>
            <li><a href="pedidosPendientes.php">Pedidos pendientes</a></li>
            <li><a href="pedidosTotal.php">Todos los pedidos</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">

          <li class="active"><?php echo $botonNombreUsuario; ?></li>
          <li><?php echo $botonSesion; ?></li>
        </ul>

        </div>
      </nav>
      </div>
      <?php echo $datosMostrar ?>
    </div>






  </body>
</html>
