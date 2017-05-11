<?php
include_once 'libs/PDOConfig.php';


//recibir el dato mandado por get
$idproducto=$_GET['id'];
//modificar el atributo activo a 0 en el producto correspondiente
$baseDatos=new PDOConfig();
$sql="UPDATE producto SET activo=0 WHERE idproducto=".$idproducto;
$sqlVuelta="SELECT idcategoria_categoria FROM producto WHERE idproducto=".$idproducto;
$resultado=$baseDatos->query($sql);
$resultadoVuelta=$baseDatos->query($sqlVuelta);//lo uso para retornar a la misma categoria
if (!$resultado & !$resultadoVuelta) {
  echo "Error al dar de baja el producto en la base de datos";//poner link para volver
}
else {
  $datoVuelta=$resultadoVuelta->fetch(PDO::FETCH_ASSOC);
  header("location:administracion.php?idCategoria=".$datoVuelta['idcategoria_categoria']);// voy a tener que mandar el id de la categoria para mandarlo donde corresponde
  //sin que el usuario se de cuenta.
}











 ?>
