<?php
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Contacta con nosotros';

ob_start();
require __DIR__.'/static/formContacto.html';
$contenidoPrincipal = ob_get_clean();

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);