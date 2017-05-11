<?php
include 'libs/PDOConfig.php';
//genero el html con los datos recuperados de la base de datos mediante php(para que sea mas limpio el codigo html)
$comboProvincia = "";//generamos la lista de los option del select
$checkMembresia = "";//generamos los checkbox

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
    
    foreach($datosProvincias as $provincia){// aca generamos todos los options
        $comboProvincia .= "<option value='".$provincia["idProvincia"]."'>".$provincia["Nombre"]."</option>";
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
        $checkMembresia .= "<input type='checkbox' name='membresias[]' value='".$membresia["idMembresia"]."'>".$membresia["Descripcion"]."&nbsp;&nbsp;";// voy concatenando el string con las intrucciones para html
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
        $dmem = "";
        foreach($membresias as $m)
        {
            $dmem .= $m.",";
        }
        $dmem = $dmem.substr($dmem, 0, ($dmem.length - 1));//saca la coma sobrante
        
        
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
        
        $tabla = "<table>"
                . " <tr><th>DNI</th>"
                . "<th>Nombre</th>"
                . "<th>Provincia</th>"
                . "<th>Membresía</th>"
                . "<th>Acciones</th>"
                . "</tr>";
        
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
        $tabla .= "</table>";
    } 
    
    
    
}

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
            <input type="text" name="txDNI" id="txDNI" ><br>
            <label>Nombre:</label>
            <input type="text" name="txNombre" id="txNombre" ><br>
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
