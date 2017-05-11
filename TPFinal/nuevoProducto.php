<?php
include_once('libs/PDOConfig.php');
include_once('libs/Login.php');

/*Cosas que voy a necesitar: el id del producto ponerlo en AUTO_INCREMENT para despreocuparme,
ademas el usuario no tiene porque saber de los id,formulario con nombre,descripcion,precio,cantidad?
y la categoria que la voy a mandar por GET...por otro lado voy a necesitar las imagenes
por lo que voy a tener que utilizar la funcion para subir archivos,copiarlos en mi carpeta de imagenes
y guardar en la base de datos el nombre con el que se guarda la imagen*/
$oLogin=new Login();
 $botonNombreUsuario="<a href='informacionUsuario.php'><span class='glyphicon glyphicon-user'></span>".$oLogin->getNombreUsuario()."</a>";




if ($_POST) {
$baseDatos=new PDOConfig();


  $dir = 'img/productos/'; // Definimos Directorio donde se guarda el archivo,si no le pongo nada se copia en el directorio actual
  if ($_FILES['miArchivo']["error"] <= 0) { // Comprobamos que no se hayan producido errores
      // Intentamos copiar el archivo al servidor verificando que se una imagen
      if (($_FILES["miArchivo"]["type"] == "image/gif")
      || ($_FILES["miArchivo"]["type"] == "image/jpeg")
      || ($_FILES["miArchivo"]["type"] == "image/jpg")
      || ($_FILES["miArchivo"]["type"] == "image/pjpeg")
      || ($_FILES["miArchivo"]["type"] == "image/x-png")
      || ($_FILES["miArchivo"]["type"] == "image/png")) {

          if ($_FILES['miArchivo']['size'] <= 2092152) {//2 MB en bytes
              if (!copy($_FILES['miArchivo']['tmp_name'], $dir . $_FILES['miArchivo']['name'])) {
                  echo "ERROR: no se pudo cargar el archivo ";
              } else {
                  echo "El archivo " . $_FILES["miArchivo"]["name"] . " se ha copiado con Éxito <br /> ";


               $sqlProducto="INSERT INTO producto(nombre,descripcion,precio,idcategoria_categoria) VALUES
               ('".$_POST['nombre']."','".$_POST['descripcion']."',".$_POST['precio'].",".$_POST['idCategoria'].")";
               $resultadoProducto=$baseDatos->query($sqlProducto);
               $ultimoIdProducto=$baseDatos->lastInsertId();
                if (!$resultadoProducto) {
                  echo "Error al guardar el producto en tabla";
                }
                else {
                  //la unica manera que se para sacar el idproducto es recuperar todos los productos y usar el ultimo
                  $sqlImagen="INSERT INTO imagen(nombre,idproducto_producto) VALUES
                  ('".$_FILES['miArchivo']['name']."',".$ultimoIdProducto.")";//sacar el id del producto
                  $resultadoImagen=$baseDatos->query($sqlImagen);
                  if (!$resultadoImagen) {
                    echo "error al vincular imagen con producto";
                  }
                  else {
                   echo "archivo subido correctamente";
                  }

                }

              }
          } else {
              echo "El archivo es mayor a 2 MB";
          }
      } else {
          echo "El archivo seleccionado no es de tipo gif/jpg/png";
      }
  } else {
      echo("Se ha producido un error");
  }



}


 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<title>Nuevo producto</title>
 	<meta charset="utf-8">
     <link rel='stylesheet' href='css/bootstrap.css' media='screen'>
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

 <div class="row">
 	<div class="col-lg-4"><h3>Nuevo Producto <span class="glyphicon glyphicon-pencil"></span></h3></div>
 </div>

 <form action="nuevoProducto.php" method="post" enctype="multipart/form-data">

 	<div class="row">
 		<div class="col-lg-5"><label for="nombre">Nombre producto: </label>
         <input type="text" id="nombre" name="nombre" class="form-control">
 		</div>

        <input type="hidden" name="idCategoria" value="<?php echo $_GET['idCategoria'];?>" >

  </div>

    <div class="row">


 		<div class="col-lg-2">
 			<label for="precio">Precio $ARS:</label>
 			<input type="text" id="precio" name="precio" class="form-control">
 		</div>
 	</div>
  <div class="row">
    <div class="col-lg-4">
        <label for="sinopsis">Descripcion</label>
      <textarea name="descripcion" id="descripcion" cols="80" rows="15"></textarea>
    </div>

  </div>


 	<div class="row">
 		<div class="col-lg-4">
      <label for="subir" name="lsubir">Fotos del producto:</label>
  		<input name="miArchivo" type="file" />
 		</div>

 	</div>
<br>


 	<div class="row">
 		<div class="col-lg-4"><input type="submit" value="Enviar" class="btn btn-default"></div>
 		<div class="col-lg-5"><input type="reset" value="Borrar datos" class="btn btn-default"></div>
 	</div>







 </form>

<br>
<a href="administracion.php"><strong>Volver</strong></a>
<br><br><br>
 </div>

 </body>
 </html>
