function validar(){


var resultado=true;
	//validar el ingreso del campo nombre

	valor = document.getElementById("legajo");
if( valor.value == null || valor.value.length == 0 || /^\s+$/.test(valor.value) ) {
	valor.style.borderColor="red";
  
  resultado=false;
}




	valor = document.getElementById("materia");
if( valor.value == null || valor.value.length == 0 || /^\s+$/.test(valor.value) ) {
	valor.style.borderColor="red";
  
  resultado=false;
}


return resultado;


}