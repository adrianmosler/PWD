<?php
include_once 'libs/Login.php';

$oLogin=new Login();
$_SESSION['pedido']=NULL;
header('location:compras.php');
 ?>
