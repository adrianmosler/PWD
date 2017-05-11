<?php

function main(){
    $arreglo=array("nombre"=>"Adrian",
                    "apellido"=>"Mosler",
                    "documento"=>34666105,
                     "direccion"=>"Teniente Ibañez 521");
    
    echo("<br/>Nombre: ".$arreglo["nombre"]."<br/>Apellido: ".$arreglo["apellido"]."<br/>Documento: ".$arreglo["documento"]."<br/>Direccion: ".$arreglo["direccion"]);
}
main();