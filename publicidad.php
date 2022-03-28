<?php
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Publicidad';

$contenidoPrincipal = 'Aquí ira la publicidad';

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);