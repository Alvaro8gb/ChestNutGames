<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Login';

ob_start();
require_once __DIR__.'/static/formLogin.html';
$contenidoPrincipal = ob_get_clean();


require __DIR__.'/includes/vistas/plantillas/plantilla.php';