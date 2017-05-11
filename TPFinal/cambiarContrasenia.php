<?php
include_once('libs/PDOConfig.php');
include_once('libs/Login.php');
header('Content-Type: text/html; charset=utf-8');
//cuando modifico una cabecera no puede haber ninguna salida antes de esa header
$esCliente=false;
$botonCarrito="";
$esCliente=false;
$oLogin=new Login();
$botonSesion="<a href='cerrarSesion.php'><span class='glyphicon glyphicon-log-in'></span> Cerrar Sesión</a>";
$botonNombreUsuario="<a href='informacionUsuario.php'><span class='glyphicon glyphicon-user'></span>".$oLogin->getNombreUsuario()."</a>";
if ($oLogin->activa()){
  if($oLogin->getRol()=='cliente'){
    if (!isset($_SESSION['pedido'])) {//lo hago para que no tire error al usar este dato sin pedidos(sin pedidos es null)
      $_SESSION['pedido']=array();//inicializo en array vacio porque es null
    }
    $esCliente=true;
    $botonCarrito="<a href='carritoCompras.php'><span class='glyphicon glyphicon-shopping-cart'></span> ".count($_SESSION['pedido'])." Pedido</a>";
  }
  else {
    //poner el menu para el admin
  }
}
  else {// que hacer si es visitante o no tiene sesion iniciada

 header('location:iniciarSesion.php');
  }


if ($_POST) {
  $baseDatos=new PDOConfig();
  $sql="UPDATE usuario SET contrasenia='".md5($_POST['psw'])."' WHERE nombreusuario='".$oLogin->getNombreUsuario()."'";
  $resultado=$baseDatos->query($sql);
  if (!$resultado) {
    echo "error al querer modificar la contraseña";
  }
  else {
    echo "<!DOCTYPE html>
    <html>
      <head>
        <meta charset='utf-8'>
        <script type=text/javascript>alert('Contraseña cambiada con exito')</script>
      </head>
      <body>

      </body>
    </html>";
  }
}


 ?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset='utf-8'/>

    <title>Compras</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="css/menu.css" media="screen">

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
        <?php
          if ($esCliente) {
           echo "  <li><a href='compras.php'>Home</a></li>
             <li><a href='productos.php'>Todos los productos</a></li>
             <li><a href='#'>Quienes somos</a></li>
             <li><a href='#'>Contacto</a></li>";
          }else {
            echo "  <li><a href='compras.php'>Home</a></li>
            <li><a href='formularioRegistro.php'>Añadir administrador</a></li>
            <li><a href='pedidosPendientes.php'>Pedidos pendientes</a></li>
            <li><a href='pedidosTotal.php'>Todos los pedidos</a></li>";
          }

         ?>

      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><?php echo $botonCarrito ?></li>
      <li><?php echo $botonNombreUsuario; ?></li>
      <li><?php echo $botonSesion; ?></li>
    </ul>

    </div>
  </nav>
  </div>


<h2>Cambio de contraseña</h2>
<br>
<form  action="cambiarContrasenia.php" method="post">
  <div class="col-lg-2">
    <label for="psw">Contraseña nueva: </label>
  </div>
<div class="col-lg-4">
 <input type="password" name="psw" class="btn btn-default">
</div>
<div class="col-lg-12">
  <br>
  <input type="submit" name="" value="Modificar" class="btn btn-default">
</div>


</form>

</div>



</body>
</html>
