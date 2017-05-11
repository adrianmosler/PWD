<!DOCTYPE html>
<html>
<head>
	<title>Ejercicio transacciones</title>
	<meta charset="utf-8">
    <link rel='stylesheet' href='../bootstrap-3.3.7-dist/css/bootstrap.css' media='screen'>
    <style type="text/css">
    	
 			hr{border-style: dashed ;
 				border-color: #585858;
 			     }

    </style>
</head>
<body>


    <div class="container">
    <h2 >Formulario de registro de personas y automóviles <span class="glyphicon glyphicon-pencil"></span></h2>

      <form action="transaccion.php" method="post">
        <div class="row">
         <div class="col-lg-10"><h3>Ingrese los datos de la persona</h3></div>
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
          <div class="col-lg-8"><hr><h3>Ingrese los datos del auto</h3></div>
        </div>

        
       
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