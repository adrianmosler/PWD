<?php
/**
 * Cierra la sesión
 */
include_once('libs/Login.php');
$oLogin=new Login();
if($oLogin->cerrar()){
	header('location:compras.php');//si hay una sesion de root lo envio a administracion
	exit();
}else{
	echo $oLogin->getError();
}
?>
