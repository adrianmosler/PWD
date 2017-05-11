<?php

/*aca va a ir todos los pedido que recupere de la base de datosMenu
tengo que poner los datos del producto,la cantidad,el usuario que los compre
y un boton que me permita activar el pedido
*/

include_once'libs/PDOConfig.php';
include_once'libs/Login.php';
$oLogin=new Login();
$botonNombreUsuario=$botonNombreUsuario="<a href='informacionUsuario.php'><span class='glyphicon glyphicon-user'></span>".$oLogin->getNombreUsuario()."</a>";;
$baseDatos=new PDOConfig();
$sqlPedidos="SELECT * FROM pedido";// tengo que recuperar todos los pedidos que no esten activados

$resultadoPedidos=$baseDatos->query($sqlPedidos);
if (!$resultadoPedidos) {
  echo "error al recuperar la tabla pedido e incluye";
}
else {

  $datosPedidos=$resultadoPedidos->fetchAll(PDO::FETCH_ASSOC);
  //print_r($datosPedidos);

  $tablaPedidos="<h1 align='center'>Historial de pedidos</h1><table border='0' class='table table-striped'>";

  foreach ($datosPedidos as $pedido) {
    $tablaPedidos.="<tr><td><h3>Datos pedido</h3><b>Pedido numero:</b> ". $pedido['idpedido']."<br><b>Fecha:</b> ".$pedido['fecha'].
    "<br><b>Estado de aceptacion:".$pedido['estado']."  </b><br><h3>Productos del pedido</h3>";

     $sqlProdPedido="SELECT producto.nombre,producto.descripcion,producto.precio FROM incluye
     INNER JOIN producto ON producto.idproducto=incluye.idproducto_producto
     INNER JOIN pedido ON pedido.idpedido=incluye.idpedido_pedido WHERE pedido.idpedido=".$pedido['idpedido'];

     $resultadoProductos=$baseDatos->query($sqlProdPedido);
     if (!$resultadoProductos) {
       echo "error al recuperar los productos del pedido";
     }
     else{
       $datosProductos=$resultadoProductos->fetchAll(PDO::FETCH_ASSOC);
       foreach ($datosProductos as $prod) {
         $tablaPedidos.="<strong>Nombre:</strong> ".$prod['nombre']." <strong>Precio:</strong> ".$prod['precio']."<br>";
       }

     }









  }
  $tablaPedidos.="</table>";




}


 ?>


 <!DOCTYPE html>
 <html lang="es">
 <head>
     <meta charset='utf-8'>
     <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
     <title>Todos los pedidos</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="css/bootstrap.css" media="screen">
     <link rel="stylesheet" href="css/menu.css" media="screen">
     <link rel="shorcut icon" href="img/logo.png">


 </head>
 <body>

 <div class="container">

   <div class="col-lg-12">
     <img src="img/header.jpg" height="190" width="1110" class="img img-rounded" />
     <nav class="navbar navbar-inverse">
     <div class="container-fluid">
       <div class="navbar-header">
         <a class="navbar-brand" href="#">CompuTech</a>
       </div>
       <ul class="nav navbar-nav">
         <li ><a href="compras.php">Home</a></li>
         <li><a href="formularioRegistro.php">Añadir administrador</a></li>
         <li><a href="pedidosPendientes.php">Pedidos pendientes</a></li>
         <li class="active"><a href="pedidosTotal.php">Todos los pedidos</a></li>
       </ul>

       <ul class="nav navbar-nav navbar-right">
       <li><?php echo $botonNombreUsuario ?></li>
       <li><a href="cerrarSesion.php"><span class="glyphicon glyphicon-log-in"></span> Cerrar sesión</a></li>
     </ul>

     </div>
   </nav>
   </div>



   <div class="col-lg-9">
     <?php echo $tablaPedidos; ?>

   </div>





 </div>



 </body>
 </html>
