<!DOCTYPE html>
<html>
  <head>
    <title>ejercicio 5
    </title>
    <meta charset="utf-8">
    <link rel='stylesheet' href='../bootstrap-3.3.7-dist/css/bootstrap.css' media='screen'>
  </head>
  <body>
    <div class="container">
    <h2 >Formulario de registro de automovil <span class="glyphicon glyphicon-pencil"></span></h2>
      <form action="accionNuevoAuto.php" method="post">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="patente">Patente
              </label>
              <input type="text" id="patente" name="patente" class="form-control">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="marca">Marca
              </label>
              <input type="text" id="marca" name="marca" class="form-control">
            </div>
          </div>
        </div>

      


        <div class="row">
          <div class="col-lg-4">
            <div class="form-group">
              <label for="modelo">Modelo
              </label>
              <input type="text" id="modelo" name="modelo" class="form-control">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label for="dniDuenio">Dni dueño
              </label>
              <br>
              <input type="text" id="dniDuenio" name="dniDuenio" class="btn btn-default">
            </div>
          </div>
        </div>
        
        <input type="submit" class="btn btn-default">
      </form>
    </div>
  </body>
</html>
