<?php

function main(){
    $j=0;
    $k=0;
    echo("Tabla del 2 con for:");
    for($i=0;$i<=10;$i++){
        echo("<br/>2 X ".$i." = ".(2*$i));
    }
    echo("<html><head><title>Tabla del 2</title></head><body bgcolor='blue'></body></html><br/>Tabla del 2 con while");
    while($j<=10){
        echo("<br/>2 X ".$j." = ".(2*$j));
        $j++;
    }
    echo("<br/>Tabla del 2 con do while:");
    
    do{
        echo("<br/>2 X ".$k." = ".(2*$k));
        $k++;
        
    }
    while($k<=10);
}
main();
