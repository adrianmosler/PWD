<?php

$dir='Descargas/';//tiene que existir el directorio

if($_FILES['archivo']['error'] <= 0){

    echo "Nombre: " . $_FILES['archivo']['name'] . "<br />";
    echo "Tipo: " . $_FILES['archivo']['type'] . "<br />";
    echo "Tamaño: " . ($_FILES['archivo']["size"] / 1024) . " kB<br />";
    echo "Carpeta temporal: " . $_FILES['archivo']['tmp_name'] . " <br />";

//proceso de copiado

    if($_FILES['archivo']['type']=='text/plain'){
    	if( copy($_FILES['archivo']['tmp_name'], $dir . $_FILES['archivo']['name'] )){
    		
    		$imprimir=file_get_contents($dir.$_FILES['archivo']['name']);
    		echo "Archivo copiado correctamente <br/> <textarea rows=5 cols=50>$imprimir</textarea> ";

    	}
    	else{
    		echo "El archivo no se ha podido copiar ";
    	}

    }
    else{
    	echo "El archivo seleccionado no es de tipo .txt";
    }




}else{
	echo "Error general";
}