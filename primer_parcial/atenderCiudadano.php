<?php

include_once 'libs/PDOConfig.php';

if($_POST){
	$baseDatos=new PDOConfig();
	
	$puesto=$_POST["cbPuesto"];

	$sql = "SELECT turno.idturno,turno.nrodoc,tramite.descripcion,turno.atendido FROM puesto "
            . "     INNER JOIN tramite ON tramite.idpuesto = puesto.idpuesto "
            . "     INNER JOIN turno ON turno.idtramite= tramite.idtramite WHERE puesto.idpuesto=".$puesto." AND turno.atendido=0 "
            . " ORDER BY turno.idturno ";
  

     $resultado=$baseDatos->query($sql);
     if(!$resultado){
     	echo "error en la consulta";
     }
     else{

     	$datos=$resultado->fetchAll(PDO::FETCH_ASSOC);
     	

        
        $tabla = "<table>"
                . " <tr><th>Numero documento</th>"
                . "<th>Descripcion tramite</th>"
                . "<th>Actualizar turno</th>"
               . "</tr>";
        
        foreach ($datos as $infoTurno)
        {
            $tabla .= "<tr>"
                    . "<td>".$infoTurno["nrodoc"]."</td>"
                    . "<td>".$infoTurno["descripcion"]."</td>"
                    . "<td><a href='finalizarAtencion.php?id=".$infoTurno["idturno"]."'>Finalizar atencion</a></td>"
                    . "</tr>";
        }
        $tabla .= "</table>";

        echo $tabla;


     }

   
}
else{
	echo "No se enviaron datos";
}