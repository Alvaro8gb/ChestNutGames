function check_password($id_password,$id_valid){
	$($id_password+"OK").hide();

	$($id_password).change(function(){

		const campo = $($id_password); 
		const campo1 = $($id_valid);

		campo[0].setCustomValidity(""); // limpia validaciones previas

		if(validPassword(campo.val())){
			campo1.text("\u2705");
			$($id_password+"OK").show();
			campo[0].setCustomValidity("");
		}else{			
			campo1.text("\u274C");
			$($id_password+"BAD").show();
			campo[0].setCustomValidity("La contraseña tiene que tener mas de 8 caracteres");
		}

	});

}

function check_correo(){

	$("#correoOK").hide();

	$("#correoUsuario").change(function(){
		const campo = $("#correoUsuario"); // referencia jquery al campo
		const campo1 = $("#validEmail");
		campo[0].setCustomValidity(""); // limpia validaciones previas
		// validación html5, porque el campo es <input type="email" ...>
		const esCorreoValido = campo[0].checkValidity();
		if (esCorreoValido && correoValidoComplu(campo.val())) {
			// el correo es válido y acaba por @ucm.es: marcamos y limpiamos quejas
			// tu código aquí: coloca la marca correcta

			campo1.text("\u2705");
			$("#correoOK").show();
			campo[0].setCustomValidity("");
		} else {			
			// correo invalido: ponemos una marca y nos quejamos
			// tu código aquí: coloca la marca correcta

			campo1.text("\u274C");
			$("#correoMal").show();
			campo[0].setCustomValidity("El correo debe ser válido y acabar por @ucm.es");
		}

	});

}

function correoValidoComplu(correo) {
	// tu codigo aqui (devuelve true ó false)
	if(correo.indexOf('@ucm.es',0)==-1){
		return false;
	}
	return true;
}

function validPassword(password){
	if(password.length < 8){
		return false;
	}
	return true;

}
function usuarioExiste(data,status) {

	if(status=='success'){

		if (data =='existe'){
			$("#validUser").text("\u274C");
			window.alert("Nombre de usuario reservado");
		}
		else{
			$("#validUser").text("\u2705");
		}
	}
	
}	
function check_user(){

	$("#correoOK").hide();
	
	$("#nombreUsuario").change(function(){
		var url = "comprobarUsuario.php?user=" + $("#nombreUsuario").val();
		$.get(url,usuarioExiste);
	 });

}

function validaForm(){
    
	check_correo();
	check_user();
	check_password("#password","#valid_password1");
	check_password("#password2","#valid_password2");

}


$(document).ready(function() {	
	validaForm();

})