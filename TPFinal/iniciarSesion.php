<?php
include_once('libs/Login.php');
//veo si hay una sesion activa
$oLogin=new Login();
if ($oLogin->activa()){
  if($oLogin->getRol()=='administrador'){
    header('location:administracion.php');//si hay una sesion de root lo envio a administracion
    exit();
  }
  else {
    header('location:compras.php');//si hay una sesion de cliente lo mando a compras
    exit();
  }


}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <link rel="shorcut icon" href="img/logo.png">
  </head>
  <body>
<div class="container">

  <div class="col-lg-12">
    <img src="img/header.jpg" height="190" width="1110" class="img img-rounded" />
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Iniciar sesión</h3>
      </div>
      <div class="panel-body">
        <form  action="validarLogin.php" method="post" >
          <div class="form-group">
            <label for="nombreUsuario" name="lnombreUsuario" class="col-lg-2">Usuario:</label>
            <div class="col-lg-10">
              <input type="text" name="nombreUsuario" id="nombreUsuario" class="btn btn-default	" placeholder="Ingresar usuario">
            </div>
          </div>
          <div class="form-group">
            <label for="contrasenia" name="lcontrasenia" class="col-lg-2">Contraseña:</label>
            <div class="col-lg-10">
              <input type="password" id="contrasenia" name="contrasenia" class="btn btn-default"  placeholder="Ingresar contraseña">
            </div>
          </div>
          <input type="submit" value="Loguearse" class="btn btn-default" ><br><br>
            <strong><a href="formularioRegistro.php">Registrarse</a></strong><br>
            <strong><a href="compras.php">Volver a Home</a></strong>
        </form>
      </div>

    </div>
  </div>





</div>

  </body>
</html>
