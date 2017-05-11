<!DOCTYPE html>
<html>
  <head>
    <title>ejercicio 4
    </title>
    <meta charset="utf-8">
    <link rel='stylesheet' href='../bootstrap-3.3.7-dist/css/bootstrap.css' media='screen'>
  </head>
  <body>
    <div class="container">
    <h2 >Formulario de registro de personas <span class="glyphicon glyphicon-pencil"></span></h2>
      <form action="accionNuevaPersona.php" method="post">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="nombre">Nombre
              </label>
              <input type="text" id="nombre" name="nombre" class="form-control">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="apellido">Apellido
              </label>
              <input type="text" id="apellido" name="apellido" class="form-control">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="form-group">
              <label for="dni">Numero de DNI
              </label>
              <input type="text" id="dni" name="dni" class="form-control">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label for="fechaNac">Fecha de nacimiento
              </label>
              <br>
              <input type="date" id="fechaNac" name="fechaNac" class="btn btn-default">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="form-group">
              <label for="telefono">Teléfono
              </label>
              <input type="text" id="telefono" name="telefono" class="form-control">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label for="direccion">Direccion
              </label>
              <input type="text" id="direccion" name="direccion" class="form-control">
            </div>
          </div>
        </div>
        <input type="submit" class="btn btn-default">
      </form>
    </div>
  </body>
</html>
