<?php
include_once 'libs/PDOConfig.php';

if($_GET){
 
 $id=$_GET['id'];
 $baseDatos=new PDOConfig();
 $sql="UPDATE turno SET atendido=1 WHERE idturno=".$id.";";
 $resultado=$baseDatos->query($sql);

   if(!$resultado){        
        echo "Error en la consulta de clientes <br> <a href='atenderCiudadano.php?dni=".$infoTurno["nrodoc"]."'>Volver a la pagina anterior</a>";
    }else{
    	echo"Turno atendido <br><a href='siguienteTurno.php'>Volver a la pagina anterior</a>";
    }




}