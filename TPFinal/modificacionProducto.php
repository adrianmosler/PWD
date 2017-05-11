
<?php
include_once 'libs/PDOConfig.php';
include_once 'libs/Login.php';

//recupero los datos con la clave recibida del get
$oLogin=new Login();
$botonNombreUsuario="<a href='informacionUsuario.php'><span class='glyphicon glyphicon-user'></span>".$oLogin->getNombreUsuario()."</a>";


$baseDatos=new PDOConfig();
if ($_GET) {
  $sql="SELECT nombre,descripcion,precio,idcategoria_categoria FROM producto WHERE idproducto=".$_GET['id'];
  $resultado=$baseDatos->query($sql);
  if (!$resultado) {
   echo "error en la recuperacion del producto de la base de datos";
  }
  else {
    $datoProducto=$resultado->fetchAll(PDO::FETCH_ASSOC);//aca tengo todos los datos para poner dentro de los elementos
    $categoria=$datoProducto[0]['idcategoria_categoria'];
  }
}

//-----------------------------
if ($_POST) {

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

print_r($_POST);
               $sqlProducto="UPDATE producto SET nombre='".$_POST['nombre']."',descripcion='".$_POST['descripcion']."'
               ,precio=".$_POST['precio'].",idcategoria_categoria=".$_POST['idCategoria']." WHERE idproducto=".$_POST['id'].";";
               $resultadoProducto=$baseDatos->query($sqlProducto);


                if (!$resultadoProducto) {
                  echo "Error al guardar el producto en tabla";
                }
                else {

                  $sqlImagen="INSERT INTO imagen(nombre,idproducto_producto) VALUES
                  ('".$_FILES['miArchivo']['name']."',".$_POST['id'].")";//sacar el id del producto
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
  <div class="col-lg-4"><h3>Modificar Producto <span class="glyphicon glyphicon-pencil"></span></h3></div>
 </div>

 <form action="modificacionProducto.php" method="post" enctype="multipart/form-data">

  <div class="row">
    <div class="col-lg-5"><label for="nombre">Nombre producto: </label>
         <input type="text" id="nombre" name="nombre" value='<?php echo $datoProducto[0]['nombre']; ?>' class="form-control">
    </div>
  </div>

    <div class="row">


    <div class="col-lg-2">
      <label for="precio">Precio $ARS:</label>
      <input type="text" id="precio" name="precio" value='<?php echo $datoProducto[0]['precio']; ?>' class="form-control">
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4">
        <label for="descripcion">Descripcion</label>
      <textarea name="descripcion" id="descripcion" cols="80" rows="15"><?php echo $datoProducto[0]['descripcion']; ?></textarea>
    </div>

  </div>


  <div class="row">
    <div class="col-lg-4">
      <label for="subir" name="lsubir">Fotos del producto:</label>
      <input name="miArchivo" type="file" />
    </div>

  </div>
 <br>

<input type="hidden" name="id" value="<?php echo $_GET['id'];?>" >
<input type="hidden" name="idCategoria" value="<?php echo $categoria;?>" >
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
