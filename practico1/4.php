<?php

function main(){
    $a=15;
    $b=94;
    $c=73;
    $valorMayor=0;
    
    if($a>$b){
        if($a>$c){
            $valorMayor=$a;
        }
        else{
            $valorMayor=$c;
        }
    }
    else{
        if($b>$c){
            $valorMayor=$b;
        }
        else{
            $valorMayor=$c;
        }
    }
    
    echo("El valor mayor es: ".$valorMayor);
}
main();