<?php

function main(){
    $nombre="Adrian";
    $apellido="Mosler";
    $edad="26";
    $direccion="Teniente Ibañez 521";
    
    $nombre2=  strtoupper($nombre);
    $apellido2= strtoupper($apellido);
    $direccion2=  strtoupper($direccion);
    
    echo("<br/>Nombre: ".$nombre2."<br/>Apellido: ".$apellido2."<br/>Edad:".$edad."<br/>Direccion: ".$direccion2 );//echo genera codigo html
}
main();
?>