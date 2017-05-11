<?php

$dir = ''; // Definimos Directorio donde se guarda el archivo,si no le pongo nada se copia en el directorio actual
if ($_FILES['miArchivo']["error"] <= 0) { // Comprobamos que no se hayan producido errores
    echo "Nombre: " . $_FILES['miArchivo']['name'] . "<br />";
    echo "Tipo: " . $_FILES['miArchivo']['type'] . "<br />";
    echo "Tamaño: " . ($_FILES['miArchivo']["size"] / 1024) . " kB<br />";
    echo "Carpeta temporal: " . $_FILES['miArchivo']['tmp_name'] . " <br />";
    // Intentamos copiar el archivo al servidor.
    if ($_FILES['miArchivo']['type'] == 'application/pdf' || $_FILES['miArchivo']['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {

        if ($_FILES['miArchivo']['size'] <= 2092152) {//2 MB en bytes
            if (!copy($_FILES['miArchivo']['tmp_name'], $dir . $_FILES['miArchivo']['name'])) {
                echo "ERROR: no se pudo cargar el archivo ";
            } else {
                echo "El archivo " . $_FILES["miArchivo"]["name"] . " se ha copiado con Éxito <br /> ";
            }
        } else {
            echo "El archivo es mayor a 2 MB";
        }
    } else {
        echo "El archivo seleccionado no es de tipo PDF o DOC/DOCX";
    }
} else {
    echo("Se ha producido un error");
}
	
		
		


