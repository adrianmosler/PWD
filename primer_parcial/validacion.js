function validar(){

var resultado=true;
var resultado_ch=false;
valor = document.getElementById("dni");
//alert('Hola'+valor.value);
if( valor.value === null || valor.value.length === 0 || /^\s+$/.test(valor.value) ) {

	valor.style.borderColor="red";
  	resultado=false;
    valor.placeholder="Documento no ingresado";
}
else{
	//alert('uuuu');
	if( isNaN(valor.value) ) {
		valor.style.borderColor="red";
  		resultado=false;
  	   valor.placeholder="Formato no valido";
  }

}

if(resultado){

var formulario=document.getElementById("formulario");
     i=0;
	while(i<formulario.elements.length && !resultado_ch){
		var elemento=formulario.elements[i];
		if (elemento.type == "checkbox") {
			if(elemento.checked){
				resultado_ch=true;
			}
		}
	i++;

  }
}
resultado=resultado && resultado_ch;
if(!resultado ) {
	alert("hay campos requeridos que no han sido ingresados");
}

return resultado;
}
