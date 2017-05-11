<?php
include('libs/Login.php');
if($_POST){


  $oLogin=new Login();
  $oLogin->iniciar($_POST['nombreUsuario'],$_POST['contrasenia']);
  if ($oLogin->validar()){
    if($oLogin->getRol()=='administrador'){
      header('location:administracion.php');//mandarlo a sesion de usuario??
      exit();
    }
    else {
      header('location:compras.php');//mandarlo a sesion de usuario??
      exit();
    }
  }else{
  	echo $oLogin->getError();
  	exit("<a href='iniciarSesion.php'>Login</a>");
  }




}




 ?>
