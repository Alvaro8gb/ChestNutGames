<?php
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Detalles de la pagina';

ob_start();
require __DIR__.'/static/detalles.html';
$contenidoPrincipal = ob_get_clean();

require_once __DIR__.'/includes/vistas/plantillas/plantilla.php';