<?php
include_once 'libs/Login.php';
include_once 'libs/PDOConfig.php';

$oLogin=new Login();
$baseDatos=new PDOConfig();
$esAdmin=false;
$usuario="cliente";
$datosExtras="	<div class='row'>
		<div class='col-lg-4'><label for='nombre'>Tarjeta:</label>
				<input type='text' id='nombreTarjeta' name='nombreTarjeta' class='form-control'>
		</div>
		<div class='col-lg-4'>
			<label for='apellido'>Numero de tarjeta</label>
			<input type='text' id='numeroTarjeta' name='numeroTarjeta' class='form-control'>
		</div>
	</div>

  <div class='col-lg-9'><hr></div>";
	$menu="";


//print_r($oLogin->activa());

 $botonNombreUsuario="<a href='informacionUsuario.php'><span class='glyphicon glyphicon-user'></span>".$oLogin->getNombreUsuario()."</a>";
//echo "$botonNombreUsuario";
	if ($oLogin->activa()) {
		if($oLogin->getRol()=='administrador'){
			$esAdmin=true;
			$usuario="administrador";
				$datosExtras="";// si estoy como administrador saco esos campos
				$menu="
				  <div class='col-lg-12'>
				    <img src='img/header.jpg' height='190' width='1110' class='img img-rounded' />
				    <nav class='navbar navbar-inverse'>
				    <div class='container-fluid'>
				      <div class='navbar-header'>
				        <a class='navbar-brand' href='#'>CompuTech</a>
				      </div>
				      <ul class='nav navbar-nav'>
				        <li><a href='compras.php'>Home</a></li>
				        <li class='active'><a href='formularioRegistro.php'>Añadir administrador</a></li>
				        <li><a href='pedidosPendientes.php'>Pedidos pendientes</a></li>
								<li><a href='pedidosPendientes.php'>Todos los pedidos</a></li>
				      </ul>

				      <ul class='nav navbar-nav navbar-right'>
				      <li>". $botonNombreUsuario."</li>
				      <li><a href='cerrarSesion.php'><span class='glyphicon glyphicon-log-in'></span> Cerrar sesión</a></li>
				    </ul>

				    </div>
				  </nav>
				</div>";
		}

	}
if (!$esAdmin) {
	$menu="<div class='col-lg-12'>
		<img src='img/header.jpg' height='190' width='1110' class='img img-rounded' />
		<nav class='navbar navbar-inverse'>
		<div class='container-fluid'>
			<div class='navbar-header'>
				<a class='navbar-brand' href='#'>CompuTech</a>
			</div>
			<ul class='nav navbar-nav'>
				<li><a href='compras.php'>Home</a></li>
				<li><a href='productos.php'>Todos los productos</a></li>
				<li><a href='#'>Quienes somos</a></li>
				<li><a href='#'>Contacto</a></li>
			</ul>

			<ul class='nav navbar-nav navbar-right'>
			<li class='active'><a href='formularioRegistro.php'><span class='glyphicon glyphicon-user'></span> Registrarse</a></li>
			<li><a href='iniciarSesion.php'><span class='glyphicon glyphicon-log-in'></span> Iniciar sesión</a></li>
		</ul>

		</div>
	</nav>
</div>";
}



if ($_POST) {


	$sqlRegistro="INSERT INTO usuario(rol,nombre,apellido,dni,nombreusuario,contrasenia,fechanacimiento) VALUES
	('".$usuario."','".$_POST['nombre']."','".$_POST['apellido']."',".$_POST['documento'].",
	'".$_POST['nombreUsuario']."','".md5($_POST['contrasenia'])."','".$_POST['anioNac']."');";
   $resultadoInsercion=$baseDatos->query($sqlRegistro);
		$ultimoId=$baseDatos->lastInsertId();


if (!$resultadoInsercion) {
	echo "Error en la insercion del usuario o del cliente";
}else {
	if (!$oLogin->activa()) {// si no hay una sesion activa significa que se registra un nuevo cliente
		$sqlRegistro="INSERT INTO cliente(idusuario_usuario,tarjeta,numerotarjeta) VALUES
		(".$ultimoId.",'".$_POST['nombreTarjeta']."',".$_POST['numeroTarjeta'].");";
		$resultadoCliente=$baseDatos->query($sqlRegistro);
		if (!$resultadoCliente) {
			echo "error al registrar el cliente";
		}
		else {
			echo "
			<!DOCTYPE html>
			<html>
				<head>
					<meta charset='utf-8'>
					<script type='text/javascript'>alert('Perfil creado exitosamente')</script>
				</head>
				<body>

				</body>
			</html>";
		}
	}
}

}






 ?>



<!DOCTYPE html>
<html>
<head>
	<title>Registro de <?php echo $usuario ?></title>
	<meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
		<link rel="shorcut icon" href="img/logo.png">

</head>
<body>

<div class="container">
<?php echo $menu; ?>
<div class="row">
	<div class="col-lg-12">

		<h3>Registro de <?php echo $usuario ?><span class="glyphicon glyphicon-pencil"></span></h3>

	</div>
</div>

<form  autocomplete="off" action="formularioRegistro.php" method="post">

	<div class="row">
		<div class="col-lg-4"><label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" class="form-control">
		</div>
		<div class="col-lg-4">
			<label for="apellido">Apellido</label>
			<input type="text" id="apellido" name="apellido" class="form-control">
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4">
			<label for="nombreUsuario">Nombre de usuario</label>
			<input type="text" value="" id="nombreUsuario" name="nombreUsuario" class="form-control">
		</div>
		<div class="col-lg-4">
		<label for="contrasenia">Contraseña</label>
			<input type="password" id="contrasenia" name="contrasenia" class="form-control">
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4">
			<label for="produccion">Documento</label>
			<input type="text" id="documento" name="documento" class="form-control">
		</div>
		<div class="col-lg-2">
		<label for="anioNac">Fecha de nacimiento</label>
			<input type="date" id="anioNac" name="anioNac" class="form-control">
		</div>
	</div>

<?php echo $datosExtras ?>

	<div class="row">
		<div class="col-lg-5"><input type="submit" value="Enviar" class="btn btn-default"></div>
		<div class="col-lg-5"><input type="reset" value="Borrar datos" class="btn btn-default"></div>
	</div>

</form>
<br>
<strong><a href="iniciarSesion.php">Volver a inicio de sesión</a></strong><br>
<strong><a href="compras.php">Home</a></strong>


</div>

</body>
</html>
