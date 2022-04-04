<?php
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Tienda';

$contenidoPrincipal = '<h1 id="cl"> Productos de la tienda. No disponible todavia </h1>';

#CSS grid

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);