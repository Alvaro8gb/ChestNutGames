<?php

use es\chestnut\usuarios\Usuario;

require_once __DIR__.'/includes/config.php';

	$user = $_REQUEST["user"];

	$usuario = Usuario::buscarUsuarioPorNombre($user);

	if ($usuario) {
		echo "existe";
	} else {
		echo "disponible";
	}
?>