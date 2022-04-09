<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$tituloPagina = 'Contacta con nosotros';
$css = link_css($app->resuelve(RUTA_CSS.'formulario.css'));

ob_start();
require __DIR__.'/static/formContacto.html';
$contenidoPrincipal = ob_get_clean();

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => $css];
$app->generaVista('/plantillas/plantilla.php', $params);