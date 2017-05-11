<?php
include_once('libs/PDOConfig.php');
include_once('libs/Login.php');
header('Content-Type: text/html; charset=utf-8');
//cuando modifico una cabecera no puede haber ninguna salida antes de esa header

$botonNombreUsuario="<a href='formularioRegistro.php'><span class='glyphicon glyphicon-user'> </span>Registrarse </a>";//opciones si es visitante,se sobreescribe si hay una sesion activa
$botonSesion="<a href='iniciarSesion.php'><span class='glyphicon glyphicon-log-in'></span> Iniciar Sesión</a>";
$esCliente=false;
$comboCategorias="";
$tablaProductos="<table border='0' class='table table-striped'>";
$botonCarrito="";
$baseDatos=new PDOConfig();
$oLogin=new Login();
//Si es un cliente muestro el boton de compra,si es un visitante o un administrador solamente listo los productos

if ($oLogin->activa()){
  $botonSesion="<a href='cerrarSesion.php'><span class='glyphicon glyphicon-log-in'></span> Cerrar Sesión</a>";
  $botonNombreUsuario="<a href='informacionUsuario.php'><span class='glyphicon glyphicon-user'></span>".$oLogin->getNombreUsuario()."</a>";
  if($oLogin->getRol()=='cliente'){
    $esCliente=true;
        $botonCarrito="<a href='carritoCompras.php'><span class='glyphicon glyphicon-shopping-cart'></span> ".count($_SESSION['pedido'])." Pedido</a>";
  }

}




$sqlCategorias="SELECT descripcion,idcategoria FROM categoria";
$resultadoC=$baseDatos->query($sqlCategorias);
if (!$resultadoC) {
  echo "Error al recuperar categorias de la base de datos";
}
else {
  $datosMenu=$resultadoC->fetchAll(PDO::FETCH_ASSOC);
  foreach ($datosMenu as $categoria) {
     $comboCategorias.= "<li><a href='compras.php?idCategoria=".$categoria['idcategoria']."'>".$categoria['descripcion']."</a></li>" ;
  }

 }







   $sqlProductos="SELECT * FROM producto";
   $resultadoP=$baseDatos->query($sqlProductos);
   if (!$resultadoP) {
      echo "Error al recuperar los productos";
   }
   else{



     $datosProducto=$resultadoP->fetchAll(PDO::FETCH_ASSOC);





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
       .$producto['precio']."<br><a href='#' onclick=\"galeria('".$stringRutas."')\">Imágenes del producto</a><br>";

        if ($esCliente) {
              $tablaProductos.="<a href='agregarProductoPedido.php?idProducto=".$producto['idproducto']."' class='btn btn-default' name='botonCompra'>Comprar</a>";
        }
         $tablaProductos.="</td></tr>";

     }
     $tablaProductos.="</table>";
   }


//ir a la misma pagina






 ?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset='utf-8'>
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Compras</title>
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
        <li ><a href="compras.php">Home</a></li>
        <li class="active"><a href="productos.php">Todos los productos</a></li>
        <li><a href="#">Quienes somos</a></li>
        <li><a href="#">Contacto</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><?php echo $botonCarrito ?></li>
      <li><?php echo $botonNombreUsuario ?></li>
      <li><?php echo $botonSesion ?></li>
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

       /*$.swipebox([
         for(int i=0;i<=arregloRutas.length;i++){
           { href:'img/productos/'+arregloRutas[i], title:'Rocas' },
         }
       ]

     );

}*/

       $.swipebox( [
       { href:'img/productos/'+arregloRutas[0], title:'Imagen 1' },
       { href:'img/productos/'+arregloRutas[1], title:'Imagen 2' }/*,
       {  href:'images/image3.jpg', title:'Otoño' },
       { href:'images/image4.jpg',title:'Playa'},
       { href:'images/image5.jpg',title:'Lago'},
       { href:'images/image6.jpg',title:'Césped'}*/
     ], {   hideBarsDelay : 0 , useSVG : false } );
     }
    </script>

</body>
</html>
