<?php

use es\chestnut\usuarios\Usuario;

require_once __DIR__.'/includes/config.php';

	$user = $_REQUEST["correo"];

	$usuario = Usuario::buscarUsuarioPorCorreo($user);

	if ($usuario) {
		echo "existe";
	} else {
		echo "disponible";
	}
?>