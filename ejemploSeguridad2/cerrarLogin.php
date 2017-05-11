<?php
/**
 * Cierra la sesión
 */
include('libs/Login.php');
$oLogin=new Login();
if($oLogin->cerrar()){
	echo 'Sesion cerrada';
        echo "<a href='formularioLogin.php'>Login</a>";
}else{
	echo $oLogin->getError();
}
?>