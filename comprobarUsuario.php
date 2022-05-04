<?php

use es\chestnut\usuarios\Usuario;

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

	$user = $_REQUEST["user"];

	$usuario = Usuario::buscarUsuarioPorNombre($user);

	if ($usuario) {
		echo "existe";
	} else {
		echo "disponible";
	}
?>