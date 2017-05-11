<?php
include_once'libs/PDOConfig.php';

print_r($_GET['idPedido']);
$baseDatos=new PDOConfig();
$sqlPedido="UPDATE pedido SET estado=1 WHERE idpedido=".$_GET['idPedido'].";";
$resultado=$baseDatos->query($sqlPedido);
if (!$resultado) {
  echo "error modificar el pedido de la base de datos";
}
else {
  //header('location:pedidosPendientes.php');
}



 ?>
