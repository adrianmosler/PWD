<?php
/**
 * Página segura solo para usuarios con el rol de Administrador
 
 * verifica la sesión
 *   si está activa verifica que el rol sea administrador y muestra la página
 *   si no muestra el error 
 */
include('libs/Login.php');
$oLogin=new Login();
if(!$oLogin->activa()){
	echo $oLogin->getError();
	exit("<a href='formularioLogin.php'>Login</a>");
}else{
    if($oLogin->getRol()!='Administrador'){
        exit('No tiene permisos para ejecutar esta acción');
    }else{
        echo '<p align="right">usuario: '.$oLogin->getNombreUsuario().' / rol: '.$oLogin->getRol().'</p>';
	echo "Menu: <a href='paginaSegura1.php'>Pagina 1</a>
	      <a href='paginaSegura2.php'>Pagina 2</a>
              <a href='cerrarLogin.php'>Cerrar</a>";
        echo "<h1 >Contenido Seguro de paginaSegura 3</h1><br>";
    }
}
?>