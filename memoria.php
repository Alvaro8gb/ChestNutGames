<?php
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Memoria';

ob_start();
require_once __DIR__.'/static/memoria.html';
$contenidoPrincipal = ob_get_clean();



require __DIR__.'/includes/vistas/plantillas/plantilla.php';