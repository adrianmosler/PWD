<?php

/*en este script voy a recuperar de la sesion los ids guardados en agregarProductoPedido
y voy a tener un boton submit para cargarlos a la base de datos con activo en 0*/
include_once'libs/PDOConfig.php';
include_once 'libs/Login.php';
$tablaProductos="";
$oLogin=new Login();//sin crear un objeto Login no puedo acceder a la sesion
$botonCompra="<a href='agregarProductoPedido.php?idProducto' class='btn btn-default' name='botonCompra'>Comprar</a>";
$botonSesion="<a href='cerrarSesion.php'><span class='glyphicon glyphicon-log-in'></span> Cerrar Sesión</a>";
$botonNombreUsuario="<a href='informacionUsuario.php'><span class='glyphicon glyphicon-user'></span>".$oLogin->getNombreUsuario()."</a>";
$botonCarrito="<a href='carritoCompras.php'><span class='glyphicon glyphicon-shopping-cart'></span> ".count($_SESSION['pedido'])." Pedido</a>";
$arregloPedidos=$_SESSION['pedido'] ;//en este arreglo tengo los id de los productos
$baseDatos=new PDOConfig();
$botonSubmit="<input type='submit' name='envioPedido' value='Enviar pedido' class='btn btn-default'>
<a href='descartarPedido.php' class='btn btn-default'>Descartar pedido</a>";

if (count($arregloPedidos)==0) {
  $tablaProductos="<h2>¡Todavia no tienes ningun pedido!</h2><h3>Recorre nuestras galerias para encontrar las mejores ofertas
  en productos tecnológicos</h3>";
  $botonSubmit="";
}
$tablaProductos.="<table border='0' class='table table-striped'>";
foreach ($arregloPedidos as $var) {//recupero los productos dentro del pedido de la sesion actual para mostrarlos
  $sqlProductos="SELECT * FROM producto WHERE idproducto=".$var;
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
      .$producto['precio']."<br><a href='#' onclick=\"galeria('".$stringRutas."')\">Imágenes del producto</a><br></td></tr>";
    }
  }
}
  $tablaProductos.="</table>";
  if ($_POST) {//ver que para registrar pedido tengo varias tablas para tener en cuenta
    $sqlCliente="SELECT * FROM usuario
    INNER JOIN cliente ON cliente.idusuario_usuario=usuario.idusuario
    WHERE usuario.nombreusuario='".$oLogin->getNombreUsuario()."'";//tengo que recuperar el id del cliente
    $resultadoC=$baseDatos->query($sqlCliente);
    if (!$resultadoC) {
      echo "Error al recuperar el cliente de la base de datos";
    }
    else {
      $datosC=$resultadoC->fetch(PDO::FETCH_ASSOC);
      $fecha=getdate();
      //print_r($fecha);
      //print_r($fecha['year']);
      $stringFecha="'".$fecha['year']."-".$fecha['mon']."-".$fecha['mday']."'";

      $sqlSubirPedido="INSERT INTO pedido(idcliente_cliente,fecha) VALUES
      (".$datosC['idcliente'].",".$stringFecha.");";


      $resultadoPedido=$baseDatos->query($sqlSubirPedido);
      $idUltimoInsertado=$baseDatos->lastInsertId();
      //echo "ultimo id".$idUltimoInsertado;


      if (!$resultadoPedido) {
        echo "Error al subir  pedido a la base de datos";
      }
      else{//una vez subido el pedido,ahora tengo que registrar los datos en la tabla incluye
           //tener en cuenta que voy a insertar tantas veces como productos hayan


           foreach ($arregloPedidos as $varIdProd) {//enlaza todos los productos a un pedido
             $sqlProductos="SELECT * FROM producto WHERE idproducto=".$varIdProd;//vuelvo a recuperar productos
             $resultadoP=$baseDatos->query($sqlProductos);
               if (!$resultadoP) {
                echo "Error al recuperar los productos";
                }
             else{
               $datosProducto=$resultadoP->fetch(PDO::FETCH_ASSOC);
               print_r($datosProducto);

                 $sqlIncluye="INSERT INTO incluye(idproducto_producto,idpedido_pedido,precio) VALUES
                 (".$varIdProd.",".$idUltimoInsertado.",".$datosProducto['precio'].");";//el precio tiene que corresponder con el producto
                 $resultadoIncluye=$baseDatos->query($sqlIncluye);
                 if (!$resultadoIncluye) {
                   echo "Error en la tabla incluye";
                 }
                 else {
                   echo "todo los datos subidos correctamente";
                 }
               }
            }
          }

            $_SESSION['pedido']=NULL;//si es exitoso


            header('location:compraExitosa.php');
    }




  }




 ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Carro Compras</title>
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
            <li class="active"><?php echo $botonCarrito ?></li>
          <li><?php echo $botonNombreUsuario; ?></li>
          <li><?php echo $botonSesion; ?></li>
        </ul>

        </div>
      </nav>
      </div>

  <h1 align='center'>Pedido actual de productos</h1>

      <form action="carritoCompras.php" method="post">
        <?php echo $tablaProductos;
              echo $botonSubmit;
         ?>
    <!--    <input type="submit" name="envioPedido" value="Enviar pedido" class="btn btn-default">
        <a href="descartarPedido.php" class="btn btn-default">Descartar pedido</a> !-->
      </form>
<br><br>
<a href="compras.php"><strong>¡Seguir comprando!</strong></a>

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
