<?php
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Planificación';

ob_start();
require_once __DIR__.'/static/planificacion.html';
$contenidoPrincipal = ob_get_clean();


require __DIR__.'/includes/plantillas/plantilla.php';