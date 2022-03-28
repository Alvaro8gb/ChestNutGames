<?php
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Tienda';

$contenidoPrincipal = 'Productos de la tienda';

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);