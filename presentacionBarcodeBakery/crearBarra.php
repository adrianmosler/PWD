<?php
// CLASES REQUERIDAS
require_once('class/BCGFontFile.php');//clase para crear el tipo de tipografia
require_once('class/BCGColor.php');//clase para crear el color
require_once('class/BCGDrawing.php');//clase para dibujar el codigo de barra

// ELIGO EL TIPO DE BARRA
require_once('class/BCGcode39.barcode.php');

// ELIJO LA TIPOGRAFIA
$tipografia = new BCGFontFile('./font/Arial.ttf', 18);

//RECIBO TEXTO A GENERAR
$texto = isset($_GET['dni']) ? $_GET['dni'] : 'No se ingreso nada';// si no se ingresa nada devuelve un codigo de barra con el texto no se ingreso nada

// CREANDO COLORES
$color_negro = new BCGColor(0, 0, 0);
$color_blanco = new BCGColor(255, 255, 255);


//CREANDO EL CODIGO DE BARRA
$drawException = null;
try {$codigo = new BCGcode39();// puede generar excepcion por eso el bloque try catch
    $codigo->setScale(2); // Resolucion
    $codigo->setThickness(30); // Espesor
    $codigo->setForegroundColor($color_negro); // Color de las barras
    $codigo->setBackgroundColor($color_blanco); // Color del espacio
    $codigo->setFont($tipografia); // si no quiero que aparezca pongo 0
    $codigo->parse($texto); // Texto
} catch(Exception $exception) {
    $drawException = $exception;
}

//DIBUJO EN PANTALLA EL CODIGO DE BARRA
$dibujar = new BCGDrawing('', $color_blanco);//para ver el codigo en pantala poner el primer argumento vacio
if($drawException) {
    $dibujar->drawException($drawException);
} else {
    $dibujar->setBarcode($codigo);
    $dibujar->draw();//guarda en una variable $im

}

// LE INDICO AL HEADER EL TIPO DE DATO QUE ES
//header('Content-Type: image/png');
//header('Content-Disposition: inline; filename="barcode.png"'); esto se usa si se quiere guardar

// Draw (or save) the image into PNG format.
$dibujar->finish(BCGDrawing::IMG_FORMAT_PNG);//IMPORTANTE PONERLO saca el contenido de $im y lo guarda en el archivo
?>
