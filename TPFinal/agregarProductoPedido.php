<?php
include_once 'libs/PDOConfig.php';
include_once 'libs/Login.php';

//recupero los datos con la clave recibida del get para luego volver a la misma categoria


$baseDatos=new PDOConfig();
$sql="SELECT * FROM producto
INNER JOIN categoria ON categoria.idcategoria=producto.idcategoria_categoria WHERE idproducto=".$_GET['idProducto'];
$resultado=$baseDatos->query($sql);
if (!$resultado) {
 echo "error en la recuperacion del producto de la base de datos";
}
else {
  $datoProducto=$resultado->fetch(PDO::FETCH_ASSOC);//aca tengo todos los datos para poner dentro de los elementos
  //print_r($datoProducto);
}

$oLogin=new Login();

if ($oLogin->activa()) {
   if ($oLogin->getRol()!='cliente') {
     header('location:iniciarSesion.php');
     exit();
   }
   else {
     $arregloPedidos=array();
     if (isset($_SESSION['pedido'])) {
         $arregloPedidos=$_SESSION['pedido'];
     }
 if(!in_array($_GET['idProducto'],$arregloPedidos)){//si el producto ya se encuentra no lo vuelvo a agregar
   array_push($arregloPedidos,$_GET['idProducto']);
  $_SESSION['pedido']= $arregloPedidos;
 }




  header("location:compras.php?idCategoria=".$datoProducto['idcategoria_categoria']."&descripcion=".$datoProducto['descripcion']);//poner el id para que vaya al mismo lugar

   }
}
else {
  header('location:iniciarSesion.php');
  exit();
}


 ?>
