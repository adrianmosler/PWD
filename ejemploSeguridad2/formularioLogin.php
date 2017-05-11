<?php
/**
 * formulario de login
 * si hay una sesión activa redirige a paginaSegura1.php
 */
include('libs/Login.php');
$oLogin=new Login();
if ($oLogin->activa()){
	header('location:paginaSegura1.php');
	exit();
}
?>
<html>
<body>
<form action="validarLogin.php" method="post">
Usuario:<input type="text" name="nombreUsuario"><br>
Clave: <input type="password" name="psw"><br>
<input type="submit">
</form>
</body>
</html>