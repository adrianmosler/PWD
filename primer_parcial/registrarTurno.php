<?php
include_once 'libs/PDOConfig.php';




if($_POST){
	$baseDatos=new PDOConfig();
	$documento=$_POST["dni"];

    $arregloTramite= array();
    if(isset($_POST["tramite"]))
    {
        $arregloTramite=$_POST["tramite"];     
    }
    else{
        echo "Ninguna opcion de tramite seleccionada,la operacion se cancelara";
        exit();
    }

    

  
    foreach ($arregloTramite as $idTramite) {
    	$sql="INSERT INTO turno(nrodoc,idtramite,atendido) VALUES ('".$documento."',".$idTramite.",0);";
    	$resultado=$baseDatos->query($sql);
    	if (!$resultado) {
    		echo "Error en la insercion de turnos";
    	}
    	else{
    		echo "Turnos reservados correctamente: volver a reservar hacer link";
    	}

    }
   
}
else{
	echo "No se enviaron datos";
}