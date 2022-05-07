$(function() {

	$("#campoCantidad").change(function(){
		const campo = $("#campoCantidad"); 
		const campo1 = $("#valida");

		const Ca = parseInt(campo.val());
		const Ca1 = parseInt(campo1.val());
		campo[0].setCustomValidity(""); 

		const esCantidadValido = campo[0].checkValidity();

		if (esCantidadValido && cantidadValidoComplu(Ca,Ca1)){
			campo[0].setCustomValidity("");
		} else {			
			campo[0].setCustomValidity("No se puede sobrepasar la cantidad disponible o tiene que ser mayor que 0");
		}
	});


	function cantidadValidoComplu(cantidad,cantidadValida) {
		if(cantidad <= cantidadValida && cantidad > 0){
			return true;
		}
		return false;
	}
})