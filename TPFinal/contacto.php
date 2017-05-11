<?php
include_once('libs/Login.php');
include_once('libs/PDOConfig.php');
include_once('libs/class.phpmailer.php');

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
$baseDatos=new PDOConfig();

if ($_POST) { // programo el envio del mail
  $mail=new phpmailer();
  $mail->IsSMTP(); // telling the class to use SMTP

  $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                             // 1 = errors and messages
                                             // 2 = messages only
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
  $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
  $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
  $mail->Username   = "amsolucionespc@gmail.com";  // GMAIL username
  $mail->Password   = "34666105m0sl3r.m0nch0.";            // GMAIL password


  $mail->SetFrom('amsolucionespc@gmail.com','compuTech');
  $mail->AddAddress('adrianmosler@gmail.com','Adrian Mosler');
  $mail->Subject="Mensaje de pagina compuTech";
  $mail->MsgHTML($_POST['mensaje']);
  if(!$mail->Send()) {
      echo "Error al enviar el mensaje: " . $mail->ErrorInfo;
  } else {
    echo "Mensaje enviado!!";
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
        <li><a href="compras.php">Home</a></li>
        <li><a href="productos.php">Todos los productos</a></li>
        <li><a href="#">Quienes somos</a></li>
        <li class="active"><a href="#">Contacto</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><?php echo $botonCarrito ?></li>
      <li><?php echo $botonNombreUsuario; ?></li>
      <li><?php echo $botonSesion; ?></li>
    </ul>

    </div>
  </nav>
  </div>

<h1>Formulario de contacto</h1>
<br>
<form  action="contacto.php" method="post">
  <div class="row">

      <label for="nombre" class="col-lg-2">Ingrese su nombre:</label>
    <div class="col-lg-4">
      <input type="text" name="nombre" placeholder="Ingrese su nombre" class="form-control">
    </div>
  </div>

  <br>

  <div class="row">
      <label for="correo" class="col-lg-2">Su correo:</label>
      <div class="col-lg-4">
        <input type="text" name="correo" class="form-control" placeholder="Ingrese correo">
      </div>
 </div>

 <br>

 <div class="row">
   <label for="mensaje" class="col-lg-2">Mensaje:</label>
   <div class="col-lg-4">
     <textarea name="mensaje" rows="8" cols="80" class="btn btn-default"></textarea>
   </div>

 </div>

 <br>
 <div class="row">
   <input type="submit" name="enviar" value="Enviar mensaje" class="btn btn-default">
   </div>




</div>


</form>






</div>



</body>
</html>




 ?>
