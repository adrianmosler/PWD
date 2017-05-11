function validar3(){

	var valor=document.getElementById("contrasena");
	
	var resultado=contrasenaSegura(valor.value);
	if(!resultado){
		alert("La contraseña ingresada no es segura");
		valor.style.borderColor="red";
	}

  
    return resultado;
}



function validar9(){

   var valor=document.getElementById("contrasena");
   
   var resultado=contrasenaSegura(valor.value);
   if(!resultado){
      alert("La contraseña ingresada no es segura");
      valor.style.borderColor="red";
   }

  
    return resultado;
}





function contrasenaSegura(unaConstrasena){
 	var resultado=false;
	if(tiene_letras(unaConstrasena) && tiene_numeros(unaConstrasena)){
		resultado=true;

	}
	return resultado;

}


function tiene_letras(texto){
	var letras="abcdefghyjklmnñopqrstuvwxyz";
   texto = texto.toLowerCase();
   for(i=0; i<texto.length; i++){
      if (letras.indexOf(texto.charAt(i),0)!=-1){
         return 1;
      }
   }
   return 0;
}




function tiene_numeros(texto){
	var numeros="0123456789";
   for(i=0; i<texto.length; i++){
      if (numeros.indexOf(texto.charAt(i),0)!=-1){
         return 1;
      }
   }
   return 0;
}