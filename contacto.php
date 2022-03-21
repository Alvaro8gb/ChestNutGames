<?php
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Contacta con nosotros';

ob_start();
require_once __DIR__.'/static/formContacto.html';
$contenidoPrincipal = ob_get_clean();

require __DIR__.'/includes/plantillas/plantilla.php';