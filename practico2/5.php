<?php

if($_POST){

   $numero=$_POST["numero"];
   if($numero<=0){
     if($numero==0){
     	echo "El numero es 0  u otra cosa que no es un numero :P";
     }
     else{
     	echo "El numero es negativo";
     }
   }
   else{
   	echo "El numero ingresado es positivo";
   }


}
else{
	echo"No se recibieron datos";
}

?>