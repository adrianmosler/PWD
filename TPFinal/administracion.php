<?php
include_once('libs/PDOConfig.php');
include_once('libs/Login.php');
header('Content-Type: text/html; charset=utf-8');
//cuando modifico una cabecera no puede haber ninguna salida antes de esa header

$botonNombreUsuario="";
$oLogin=new Login();
if ($oLogin->activa()) {
   if ($oLogin->getRol()=='cliente') {
     header('location:compras.php');
     exit();
   }
   else {
     $botonNombreUsuario="<a href='informacionUsuario.php'><span class='glyphicon glyphicon-user'></span>".$oLogin->getNombreUsuario()."</a>";
   }
}
else {
  header('location:compras.php');
  exit();
}

//$botonNombreUsuario="<a href='#'><span class='glyphicon glyphicon-user'></span>".$oLogin->getNombreUsuario()."</a>";

$tablaProductos="<h1 align='center'>Panel de administracion de productos</h1>
<p>Para dar de alta,baja,modificar o crear un nuevo producto para la venta,ingresar en la categoria
correspondiente para acceder a las opciones</p>
<div align='center'><img src='img/llave.jpg' height='350' class='img img-rounded' /></div>";
$usuario="";
$comboCategorias="";
$baseDatos=new PDOConfig();

$sqlCategorias="SELECT descripcion,idcategoria FROM categoria";
$resultadoC=$baseDatos->query($sqlCategorias);
if (!$resultadoC) {
  echo "Error al recuperar categorias de la base de datos";
}
else {
  $datosMenu=$resultadoC->fetchAll(PDO::FETCH_ASSOC);
  foreach ($datosMenu as $categoria) {
     $comboCategorias.= "<li><a href='administracion.php?idCategoria=".$categoria['idcategoria']."'>".$categoria['descripcion']."</a></li>" ;
  }

 }

 if ($_GET) {
   $sqlProductos="SELECT * FROM producto WHERE idcategoria_categoria=".$_GET['idCategoria'];
   $resultadoP=$baseDatos->query($sqlProductos);
   if (!$resultadoP) {
      echo "Error al recuperar los productos";
   }
   else{
     $datosProducto=$resultadoP->fetchAll(PDO::FETCH_ASSOC);

     $tablaProductos="<table border='0' class='table table-striped'><tr><td><a href='nuevoProducto.php?idCategoria=".$_GET['idCategoria']."' class='btn btn-default'>Nuevo Producto</a></td></tr>";
     foreach ($datosProducto as $producto) {
        //busco imagen por cada producto
        $stringRutas="";
       $sqlImagen="SELECT nombre,idproducto_producto FROM imagen WHERE idproducto_producto=".$producto['idproducto'];
       $resultadoI=$baseDatos->query($sqlImagen);
       if (!$resultadoI) {
          echo "Error al recuperar las imagenes";
       }
       else{
         $datosImagen=$resultadoI->fetchAll(PDO::FETCH_ASSOC);
         foreach ($datosImagen as $imagen) {
           $stringRutas.=$imagen['nombre'].",";//genero string con las rutas separadas con coma
         }
       }
       //fin busqueda imagenes



       $tablaProductos.="<tr><td><b>Nombre:</b> ". $producto['nombre']."<br><b>Descripcion:</b> ".$producto['descripcion']."<br><b>Precio:  </b>"
       .$producto['precio']."<br><a href='#' onclick=\"galeria('".$stringRutas."')\">Imágenes del producto</a><br><hr>
       <b>Esta actualmente activo: </b>".$producto['activo']."<br><a href='bajaProducto.php?id=".$producto['idproducto']."' class='btn btn-default'>Baja</a>
       <a href='altaProducto.php?id=".$producto['idproducto']."' class='btn btn-default'>Alta</a>
       <a href='modificacionProducto.php?id=".$producto['idproducto']."' class='btn btn-default'>Modificar</a></tr></td>";


     }
     $tablaProductos.="</table>";
   }
 }
 else{
}
//ir a la misma pagina






 ?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset='utf-8'>
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Administracion</title>
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
        <li class="active"><a href="compras.php">Home</a></li>
        <li><a href="formularioRegistro.php">Añadir administrador</a></li>
        <li><a href="pedidosPendientes.php">Pedidos pendientes</a></li>
        <li><a href="pedidosTotal.php">Todos los pedidos</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
      <li><?php echo $botonNombreUsuario ?></li>
      <li><a href="cerrarSesion.php"><span class="glyphicon glyphicon-log-in"></span> Cerrar sesión</a></li>
    </ul>

    </div>
  </nav>
  </div>


  <div class="col-lg-3">
    <nav class="navbar navbar-default sidebar" role="navigation">
        <div class="container-fluid">
        <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <?php echo $comboCategorias; ?>
          </ul>
        </div>
      </div>
    </nav>
  </div>

  <div class="col-lg-9">
    <?php echo $tablaProductos; ?>

  </div>





</div>

<script type="text/javascript">

function galeria( stringRutas ) {
  var arregloRutas=stringRutas.split(",");
  var cantidadImagenes=arregloRutas.length-1;

  var arreglo=[];

  for(var i=0;i<cantidadImagenes;i++){
    arreglo.push({ href:'img/productos/'+arregloRutas[i], title:'Imagen '+(i+1) });
  }


  $.swipebox( arreglo,{hideBarsDelay:0,useSVG:false}  );

 }
    </script>

</body>
</html>
