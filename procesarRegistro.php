<?php
require_once __DIR__.'/includes/config.php';

if (! isset($_POST['registro']) ) {
	header('Location: registro.php');
	exit();
}


$tituloPagina = 'Registro de usuario';

$contenidoPrincipal = '';

$erroresFormulario = array();

$nombreUsuario = isset($_POST['nombreUsuario']) ? $_POST['nombreUsuario'] : null;

if ( empty($nombreUsuario) || mb_strlen($nombreUsuario) < 5 ) {
	$erroresFormulario['nombreUsuario'] = "El nombre de usuario tiene que tener una longitud de al menos 5 caracteres.";
}

$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
if ( empty($nombre) || mb_strlen($nombre) < 5 ) {
	$erroresFormulario['nombre'] = "El nombre tiene que tener una longitud de al menos 5 caracteres.";
}

$password = isset($_POST['password']) ? $_POST['password'] : null;
if ( empty($password) || mb_strlen($password) < 8 ) {
	$erroresFormulario['password'] = "La contraseña tiene que tener una longitud de al menos 8 caracteres.";
}
$password2 = isset($_POST['password2']) ? $_POST['password2'] : null;
if ( empty($password2) || strcmp($password, $password2) !== 0 ) {
	$erroresFormulario['password2'] = "Las contraseñas deben coincidir";
}

$correo = isset($_POST['correoUsuario']) ? $_POST['correoUsuario'] : null;
if ( empty($password2) || strcmp($password, $password2) !== 0 ) {
	$erroresFormulario['password2'] = "No se ha introducido correo electrónico";
}



if (count($erroresFormulario) === 0) {
	$conn = $app->conexionBd();
	
	$query=sprintf("SELECT * FROM Usuarios U WHERE U.nombreUsuario = '%s'", $conn->real_escape_string($nombreUsuario));
	$rs = $conn->query($query);
	if ($rs) {
		if ( $rs->num_rows > 0 ) {
			$erroresFormulario[] = "El usuario ya existe";
			$rs->free();
			$contenidoPrincipal .= <<<EOS
			<h2>Inicie <a href="login.php">sesión</a></h2>
			EOS;
		} else {
			$query=sprintf("INSERT INTO Usuarios(nombreUsuario, nombre, password, rol, correo) VALUES('%s', '%s', '%s', '%s','%s')"
					, $conn->real_escape_string($nombreUsuario)
					, $conn->real_escape_string($nombre)
					, password_hash($password, PASSWORD_DEFAULT)
					, 'user'
					,$conn->real_escape_string($correo));
			if ( $conn->query($query) ) {
				$_SESSION['login'] = true;
				$_SESSION['nombre'] = $nombre;
				$rs->free();
				echo "<h1>Bienvenido {$_SESSION['nombre']} usted se ha registrado de forma correcta, ahora inicie sesión</h1>";
				header('Location : login.php');
				exit();
			} else {
				echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
				exit();
			}
		}		
	} else {
		echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
		exit();
	}
}


if (isset($_SESSION["login"])) {
	$contenidoPrincipal .= <<<EOS
	<h1>Bienvenido {$_SESSION['nombre']}</h1>
	EOS;
	header("Location : index.php");
} else {
	$contenidoPrincipal .= <<<EOS
	<form action="procesarRegistro.php" method="POST">
	<h1>ERROR</h1>
	EOS;
	if (count($erroresFormulario) > 0) {
		$contenidoPrincipal .= '<ul class="errores">';
	}
	foreach($erroresFormulario as $clave => $error) {
		if (is_numeric($clave)) {
			$contenidoPrincipal .= "<li>$error</li>";
		}
	}
	if (count($erroresFormulario) > 0) {
		$contenidoPrincipal .= '</ul>';
	}

	$errorNombreUsuario = '';
	if (isset($erroresFormulario['nombreUsuario'])) {
		$errorNombreUsuario = " <span class=\"error\">{$erroresFormulario['nombreUsuario']}</span>";
	}

	$errorNombre = '';
	if (isset($erroresFormulario['nombre'])) {
		$errorNombre = " <span class=\"error\">{$erroresFormulario['nombre']}</span>";
	}

	$errorPassword = '';
	if (isset($erroresFormulario['password'])) {
		$errorPassword = " <span class=\"error\">{$erroresFormulario['password']}</span>";
	}
	$errorPassword2 = '';
	if (isset($erroresFormulario['password2'])) {
		$errorPassword2 = " <span class=\"error\">{$erroresFormulario['password2']}</span>";
	}
	$contenidoPrincipal .= <<<EOS
	<fieldset>
		<legend>Usuario y contraseña</legend>
		<div class="grupo-control">
			<label>Nombre de usuario:</label> <input type="text" name="nombreUsuario" value="$nombreUsuario" />$errorNombreUsuario
		</div>
		<div class="grupo-control">
			<label>Nombre completo:</label> <input class="control" type="text" name="nombre" value="$nombre" />$errorNombre
		</div>
		<div class="grupo-control">
			<label>Password:</label> <input type="password" name="password" value="$password" />$errorPassword
		</div>
		<div class="grupo-control">
			<label>Vuelve a introducir el Password:</label> <input class="control" type="password" name="password2" />$errorPassword2
		</div>
		<div class="grupo-control"><button type="submit" name="registro">Registrar</button></div>
	</fieldset>
	</form>
	EOS;
}


require __DIR__.'/includes/plantillas/plantilla.php';