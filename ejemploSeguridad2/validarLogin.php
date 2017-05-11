<?php
/**
 * recibe el nombre de usuario y clave desde el formulario de  login
 * inicia el objeto Login y lo intenta validar
 *   si valida redirige a paginaSegura1.php
 *   si no muestra el error
 */
include('libs/Login.php');
$oLogin=new Login();
$oLogin->iniciar($_POST['nombreUsuario'],$_POST['psw']);
if ($oLogin->validar()){
	header('location:paginaSegura1.php');
	exit();
}else{
	echo $oLogin->getError();
	exit("<a href='formularioLogin.php'>Login</a>");
}
?>