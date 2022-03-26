<?php
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Detalles de la pagina';

ob_start();
require __DIR__.'/static/detalles.html';
$contenidoPrincipal = ob_get_clean();

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);