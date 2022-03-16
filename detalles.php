<?php
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Detalles de la pagina';

ob_start();
require_once __DIR__.'/static/detalles.html';
$contenidoPrincipal = ob_get_clean();


require __DIR__.'/includes/plantillas/plantilla.php';