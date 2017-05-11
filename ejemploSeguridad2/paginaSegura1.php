<?php
/**
 * Pagina segura para todos los usuarios con sesión activa
 * verifica la sesión
 *   si está activa muestra la página
 *   si no muestra el error 
 */
include('libs/Login.php');
$oLogin=new Login();
if(!$oLogin->activa()){
	echo $oLogin->getError();
	exit("<a href='formularioLogin.php'>Login</a>");
}else{
	echo '<p align="right">usuario: '.$oLogin->getNombreUsuario().' / rol: '.$oLogin->getRol().'</p>';
	echo "Menu: <a href='paginaSegura2.php'>Pagina 2</a>
	      <a href='paginaSegura3.php'>Pagina 3</a>
              <a href='cerrarLogin.php'>Cerrar</a>";
        
        echo "<h1 >Contenido Seguro de paginaSegura 1</h1><br>";
}
?>