<?php
include_once('libs/PDOConfig.php');
include_once('libs/Login.php');
header('Content-Type: text/html; charset=utf-8');
//cuando modifico una cabecera no puede haber ninguna salida antes de esa header
$botonNombreUsuario="";
//$botonCompra="";
$botonSesion="";
$botonCarrito="";
$esCliente=false;
$oLogin=new Login();// modificar la clase Login para que incluya los datos que necesito para usar,ej el nombre del usuario

if ($oLogin->activa()){
  if($oLogin->getRol()=='cliente'){
    if (!isset($_SESSION['pedido'])) {//lo hago para que no tire error al usar este dato sin pedidos(sin pedidos es null)
      $_SESSION['pedido']=array();//inicializo en array vacio porque es null
    }

    $esCliente=true;
    //$botonCompra="<a href='agregarProductoPedido.php?idProducto' class='btn btn-default' name='botonCompra'>Comprar</a>";
    $botonSesion="<a href='cerrarSesion.php'><span class='glyphicon glyphicon-log-in'></span> Cerrar Sesión</a>";
    $botonNombreUsuario="<a href='informacionUsuario.php'><span class='glyphicon glyphicon-user'></span>".$oLogin->getNombreUsuario()."</a>";
    $botonCarrito="<a href='carritoCompras.php'><span class='glyphicon glyphicon-shopping-cart'></span> ".count($_SESSION['pedido'])." Pedido</a>";
  }
  else {
    header('location:administracion.php');// por cuestion de seguridad en todas las paginas pregunto por las sesiones
  }
}
  else {// que hacer si es visitante o no tiene sesion iniciada

$botonSesion="<li><a href='iniciarSesion.php'><span class='glyphicon glyphicon-log-in'></span> Iniciar Sesión</a>";
$botonNombreUsuario="<a href='formularioRegistro.php'><span class='glyphicon glyphicon-user'></span> Registrarse </a>";
  }

$usuario="";
$comboCategorias="";
$tablaProductos="<h1 align='center'>¡Felicitaciones!</h1>
<div align='center'>
<img src='img/felicitaciones.jpg' height=300 class='img img-rounded' />
<p><h3>Tu compra ha sido completada exitosamente,en breve confirmaremos tu pedido</h4></p>


</div>";



 ?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset='utf-8'/>

    <title>Compras</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="css/menu.css" media="screen">
    <link rel="stylesheet" href="css/swipebox.css" media="screen" title="no title">
    <script  type="text/javascript" src="js/jquery-3.1.1.js"></script>
    <script  type="text/javascript" src="js/jquery.swipebox.js"></script>
    <link rel="shorcut icon" href="img/logo.png">

    <!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>!-->
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
        <li><a href="productos.php">Todos los productos</a></li>
        <li><a href="#">Quienes somos</a></li>
        <li><a href="#">Contacto</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><?php echo $botonCarrito ?></li>
      <li><?php echo $botonNombreUsuario; ?></li>
      <li><?php echo $botonSesion; ?></li>
    </ul>

    </div>
  </nav>
  </div>


  <div class="col-lg-3">
    <nav class="navbar navbar-default sidebar" role="navigation">
        <div class="container-fluid">
        <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <?php echo $comboCategorias; ?>
          </ul>
        </div>
      </div>
    </nav>
  </div>

  <div class="col-lg-9">
    <?php echo $tablaProductos; ?>
  </div>





</div>



</body>
</html>
