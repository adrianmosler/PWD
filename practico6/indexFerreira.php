<?php
include 'libs/PDOConfig.php';

$comboProvincia = "";
$checkMembresia = "";
$dmem = "";
//movi la definicion de la tabla para que no tire erro y para que se vea la tabla vacia inicialmente.
$tabla = "<table>"
                . " <tr><th>DNI</th>"
                . "<th>Nombre</th>"
                . "<th>Provincia</th>"
                . "<th>Membresía</th>"
                . "<th>Acciones</th>"
                . "</tr>";

$base = new PDOConfig();

// ARMAMOS COMBO PROVINCIA
$sqlProv = "SELECT idProvincia,Nombre FROM provincias";
$resultadoProvincia = $base->query($sqlProv);

if(!$resultadoProvincia)
{
    echo "Error al consultar las provincias";
    
}else{
    $datosProvincias = $resultadoProvincia->fetchAll(PDO::FETCH_ASSOC);
    $comboProvincia = "<select name='cbProvincia' id='cbProvincia'>"
            . " <option value='-1'>Selecionar...</option>";
    
    foreach($datosProvincias as $provincia){

        $sel = "";
        //valido el elemento seleccionado y le agrego el selected a la opcion 
        if($_POST['cbProvincia'] == $provincia['idProvincia'])
        {
            $sel = "selected";
        }

        $comboProvincia .= "<option value='".$provincia["idProvincia"]."' {$sel}>".$provincia["Nombre"]."</option>";
    }    
    $comboProvincia .= "</select>";
}

// ARMAMOS CHECKBOXs Menbresía

$sqlMen = "SELECT idMembresia, Descripcion FROM membresia";
$resultadoMembresia = $base->query($sqlMen);

if(!$resultadoMembresia)
{
    echo "Error al consultar las membresias";
    
}else{
    $datosMembresia = $resultadoMembresia->fetchAll(PDO::FETCH_ASSOC);
       
    foreach($datosMembresia as $membresia){
        $checkMembresia .= "<input type='checkbox' name='membresias[]' value='".$membresia["idMembresia"]."'>".$membresia["Descripcion"]."&nbsp;&nbsp;";
    }  
}


if($_POST){
    
    $dni = $_POST["txDNI"];
    $nombre = $_POST["txNombre"];
    $idProvincia = $_POST["cbProvincia"];
    
    $membresias = array();
    if(isset($_POST["membresias"]))
    {
        $membresias = $_POST["membresias"];        
    }
    
    $filtro = "";
    
    if($dni != "")
    {
        $filtro .= " AND C.NroDNI = $dni";
    }
    
    if($nombre != "")
    {
        $filtro .= " AND C.Nombre LIKE '%$nombre%'";
    }
    
    if($idProvincia != "-1")
    {
        $filtro .= " AND C.idProvincia = $idProvincia";
    }
    
    if(count($membresias) > 0)
    {    
        //inicializo para que no tire error
        
        foreach($membresias as $m)
        {
            $dmem .= $m.",";
        }
        
        //No me responde .length (no conosco este atributo en php)
        //No entiendo por que concatenan dmen con el resultado del substr ?? 
        //$dmem = $dmem.substr($dmem, 0, ($dmem.length - 1));

        //agrego funcion para calcular longitud y saco dmem para evitar duplicidad de datos
        $dmem = substr($dmem, 0, (strlen($dmem) - 1));
        
        $filtro .= " AND C.idMembresia IN ($dmem)";
    }
    
    
    $sqlClientes = "SELECT C.NroDNI,C.Nombre,P.Nombre AS nomProvincia, M.Descripcion AS nomMembresia FROM clientes C "
            . "     INNER JOIN provincias P ON C.idProvincia = P.idProvincia "
            . "     INNER JOIN membresia M ON C.idMembresia = M.idMembresia WHERE 1=1 $filtro "
            . " ORDER BY C.Nombre ";
    
    
    $resultadoCliente = $base->query($sqlClientes);
    
    if(!$resultadoCliente){        
        echo "Error en la consulta de clientes";
    }else{
        
        $datosClientes = $resultadoCliente->fetchAll(PDO::FETCH_ASSOC);
        
        
        foreach ($datosClientes as $unCliente)
        {
            $tabla .= "<tr>"
                    . "<td>".$unCliente["NroDNI"]."</td>"
                    . "<td>".$unCliente["Nombre"]."</td>"
                    . "<td>".$unCliente["nomProvincia"]."</td>"
                    . "<td>".$unCliente["nomMembresia"]."</td>"
                    . "<td><a href='verDatosCliente.php?dni=".$unCliente["NroDNI"]."'>Ver Datos</a></td>"
                    . "</tr>";
        }
        
    } 
    
    
    
}

$tabla .= "</table>";
//Agregue a cada elemento (intput, select, chebox) los valores seleccionados por el usuario para que sepa lo que filtro.
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 3</title>
    </head>
    <body>
        <form name="busqueda" id="busqueda" method="post" action="index.php">
            <label>DNI:</label>
            <input type="text" name="txDNI" id="txDNI" value="<?= isset($_POST['txDNI']) ? $_POST['txDNI'] : ''?>" ><br>
            <label>Nombre:</label>
            <input type="text" name="txNombre" id="txNombre" value="<?= isset($_POST['txNombre']) ? $_POST['txNombre'] : ''?>" ><br>
            <label>Provincia:</label>
            <?php echo $comboProvincia; ?>
            <br>
            <label>Membresía:</label>
            <?php echo $checkMembresia; ?>            
            <br>
            <input type="submit" value="Buscar">
        </form>
        <br>
        <br>
        
        <?php echo $tabla; ?>
        
        
    </body>
</html>
<script type="text/javascript">
    
    //agrego esta funcion para setear los checkbox que seleccion el usuario
    window.onload = function() {
        //verifico si la variable dmem esta vacia (si esta vacia no fue el valor membresia por post)
        <?php if($dmem != "") : ?>
            //seteo la variable dmem en una variable de javasscript, esto va a contener. valor,valor
            var checks = '<?= $dmem; ?>';
            //con la funcion split indico el separador y armo un array con cada elemento para recorrerr con el for
            var checkArray = checks.split(",");

            //recorro mi array 
            for(var i=0;i<checkArray.length; i++)
            {
                //recorro las membresias
                for(var j=0; j<document.getElementsByName('membresias[]').length;j++)
                {   
                    //verifico si mi array (valor checkeado) es igual al valor de la membresia que estoy recorriendo
                    if(document.getElementsByName('membresias[]')[j].value == checkArray[i])
                    {   
                        //seteo el checked si coinciden
                        document.getElementsByName('membresias[]')[j].checked = true;
                        //corto el foreach para evitar que continue el bucle
                        break;   
                    }
                }
            }

        <?php endif;?>
    };
    

</script>
