<?php
include_once 'libs/PDOConfig.php';
include_once 'libs/Login.php';

// hay que hacer una sesion para saber si es administrador que es usuario o si es cliente que es otra tabla
$baseDatos=new PDOConfig();
$oLogin=new Login();
$sqlDatos="";

if ($oLogin->activa()){
  if($oLogin->getRol()=='cliente'){
    if (!isset($_SESSION['pedido'])) {//lo hago para que no tire error al usar este dato sin pedidos(sin pedidos es null)
      $_SESSION['pedido']=array();//inicializo en array vacio porque es null

    }

    $esCliente=true;
    $botonCompra="<a href='agregarProductoPedido.php?idProducto' class='btn btn-default' name='botonCompra'>Comprar</a>";
    $botonSesion="<a href='cerrarSesion.php'><span class='glyphicon glyphicon-log-in'></span> Cerrar Sesión</a>";
    $botonNombreUsuario="<a href='informacionUsuario.php'><span class='glyphicon glyphicon-user'></span>".$oLogin->getNombreUsuario()."</a>";
    $botonCarrito="<a href='carritoCompras.php'><span class='glyphicon glyphicon-shopping-cart'></span> ".count($_SESSION['pedido'])." Pedido</a>";
  }
  else {
  //  header('location:administracion.php');// por cuestion de seguridad en todas las paginas pregunto por las sesiones
  }
}











if ($oLogin->activa()) {//separar la consulta del cliente con sus pedidos
   if ($oLogin->getRol()=="cliente") {// si es cliente tengo que enlazar dos tablas distintas
     $sqlDatos="SELECT * FROM usuario
     INNER JOIN cliente ON usuario.idusuario=cliente.idusuario_usuario
     LEFT JOIN pedido ON pedido.idcliente_cliente=cliente.idcliente
     WHERE usuario.nombreusuario='".$oLogin->getNombreUsuario()."';";
     $esCliente=true;
   }
   else {
     if ($oLogin->getRol()=="administrador") {
       header('location:informacionAdmin.php');
     }
   }
$resultadoConsulta=$baseDatos->query($sqlDatos);
if (!$resultadoConsulta) {
  echo "Error al consultar en la base de datos por el usuario";
}
else{
  //tener en cuenta que el cliente tiene datos demas
  $datosConsulta=$resultadoConsulta->fetchAll(PDO::FETCH_ASSOC);
  $datosMostrar="<h3>Datos personales</h3><table class='table table-striped'>
  <tr><td><strong>Nombre:</strong>".$datosConsulta[0]['nombre']."</td></tr>
  <tr><td><strong>Apellido:</strong>".$datosConsulta[0]['apellido']."</td></tr>
  <tr><td><strong>Nombre de usuario:</strong>".$datosConsulta[0]['nombreusuario']."</td></tr>
  <tr><td><strong>Fecha de nacimiento:</strong>".$datosConsulta[0]['fechanacimiento']."</td></tr>
  <tr><td><strong>DNI:</strong>".$datosConsulta[0]['dni']."</td></tr>
  <tr><td><a href='cambiarContrasenia.php' class='btn btn-default'>Cambiar contraseña</a></td></tr>
  </table><h3>Pedidos anteriores:</h3><table class='table table-striped'>";
  foreach ($datosConsulta as $dato) {

// sacar cada id del pedido,y por cada id del pedido recuperar la lista de productos correspondientes
     $sqlPedido="SELECT producto.nombre,producto.descripcion,producto.precio FROM incluye
     INNER JOIN producto ON producto.idproducto=incluye.idproducto_producto
     INNER JOIN pedido ON pedido.idpedido=incluye.idpedido_pedido WHERE pedido.idpedido=".$dato['idpedido'];// consulta correcta(ver el dato externo)
    /*
    "SELECT * FROM pedido
    INNER JOIN incluye ON incluye.idpedido_pedido=pedido.idpedido
    INNER JOIN  producto ON producto.idproducto=incluye.idproducto_producto
    WHERE pedido.idpedido= "
    */

    $resultadoPedido=$baseDatos->query($sqlPedido);
    if (!$resultadoPedido) {
      echo "error al querer recuperar la lista de pedidos con sus respectivos productos";
    }
    else {
      $datosPedido=$resultadoPedido->fetchAll(PDO::FETCH_ASSOC);
    //  print_r($datosPedido);
    $datosMostrar.="<tr><td><b>Fecha: </b>".$dato['fecha']." <b> &nbsp &nbsp &nbspEstado: </b>".$dato['estado'];
      foreach ($datosPedido as $prod) {
      $datosMostrar.="<br><strong>Nombre:</strong> ".$prod['nombre']." <strong>Precio:</strong> ".$prod['precio'];
      }
      $datosMostrar.="</td></tr>";
    }


  }
  $datosMostrar.="</td></tr></table>";




}



}
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Informacion Usuario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="css/menu.css" media="screen">
    <link rel="stylesheet" href="css/swipebox.css" media="screen" title="no title">
    <script  type="text/javascript" src="js/jquery-3.1.1.js"></script>
    <script  type="text/javascript" src="js/jquery.swipebox.js"></script>
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
            <li><a href="compras.php">Home</a></li>
            <li><a href="productos.php">Todos los productos</a></li>
            <li><a href="#">Quienes somos</a></li>
            <li><a href="#">Contacto</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><?php echo $botonCarrito ?></li>
          <li class="active"><?php echo $botonNombreUsuario; ?></li>
          <li><?php echo $botonSesion; ?></li>
        </ul>

        </div>
      </nav>
      </div>
      <?php echo $datosMostrar ?>
    </div>






  </body>
</html>
