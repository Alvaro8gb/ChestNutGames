$().ready(function() {

	$("#campoCantidad").change(function(){
		const campo = $("#campoCantidad"); 
		const campo1 = $("#validCantidad");
		const campo2 = $("#valida");

		const Ca = parseInt(campo.val());
		const Ca1 = parseInt(campo2.val());
		campo[0].setCustomValidity(""); // limpia validaciones previas
		
		const esCantidadValido = campo[0].checkValidity();
		console.log("hola");
		if (cantidadValida(Ca,Ca1)){

			campo1.text("\u2705");
			campo[0].setCustomValidity("");
		} else {			


			campo1.text("\u274C");
			campo[0].setCustomValidity("No se puede sobrepasar la cantidad disponible o tiene que ser mayor que 0");
		}
	});


	function cantidadValida(cantidad,cantidadValida) {
		// tu codigo aqui (devuelve true ó false)
		if(cantidad <= cantidadValida && cantidad > 0){
			return true;
		}
		return false;
	}
})