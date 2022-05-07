function check_password($id_password,$id_valid){
	$($id_password+"OK").hide();

	$($id_password).change(function(){

		const campo = $($id_password); 
		const campo1 = $($id_valid);

		campo[0].setCustomValidity(""); 

		if(validPassword(campo.val())){
			campo1.text("\u2705");
			$($id_password+"OK").show();
			
		}else{			
			campo1.text("\u274C");
			$($id_password+"BAD").show();
			campo[0].setCustomValidity("La contraseña tiene que tener mas de 8 caracteres");
		}

	});

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
	
	$("#nombreUsuario").change(function(){
		var url = "comprobarUsuario.php?user=" + $("#nombreUsuario").val();
		$.get(url,usuarioExiste);
	 });

}

function usuarioExisteCorreo(data,status) {

	if(status=='success'){

		if (data =='existe'){
			$("#correoUsuario").text("\u274C");
			window.alert("Correo existente");
		}
		else{
			$("#validEmail").text("\u2705");
		}
	}
	
}	

function check_correo(){

	const campo = $("#correoUsuario"); 
	
	campo.change(function(){

		const campo_valid = $("#validEmail");

		campo[0].setCustomValidity(""); 

		campo_valid.hide();
		const esCorreoValido = $(campo)[0].checkValidity();

		if($("#correoUsuario").val().indexOf('@',0)==-1){
			campo.text("\u274C");
			campo[0].setCustomValidity("Correo incompleto no se ha encontrado el caracter @");
		}
		else if(!esCorreoValido){
			campo_valid.text("\u274C");
			campo[0].setCustomValidity("Correo no valido");

		}else{
			var url = "comprobarCorreo.php?correo=" + $("#correoUsuario").val();
		    $.get(url,usuarioExisteCorreo);
		}
		
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