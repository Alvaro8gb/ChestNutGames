$(function() {

	$("#campoCantidad").change(function(){
		const campo = $("#campoCantidad"); // referencia jquery al campo
		const campo1 = $("#validCantidad");
		const campo2 = $("#valida");

		const Ca = parseInt(campo.val());
		const Ca1 = parseInt(campo2.val());
		campo[0].setCustomValidity(""); // limpia validaciones previas
		// validación html5, porque el campo es <input type="email" ...>
		const esCantidadValido = campo[0].checkValidity();
		console.log("hola");
		if (cantidadValidoComplu(Ca,Ca1)){
			// el correo es válido y acaba por @ucm.es: marcamos y limpiamos quejas
			// tu código aquí: coloca la marca correcta

			campo1.text("\u2705");
			campo[0].setCustomValidity("");
		} else {			
			// correo invalido: ponemos una marca y nos quejamos
			// tu código aquí: coloca la marca correcta

			campo1.text("\u274C");
			campo[0].setCustomValidity("No se puede sobrepasar la cantidad disponible o tiene que ser mayor que 0");
		}
	});


	function cantidadValidoComplu(cantidad,cantidadValida) {
		// tu codigo aqui (devuelve true ó false)
		if(cantidad <= cantidadValida && cantidad > 0){
			return true;
		}
		return false;
	}
})