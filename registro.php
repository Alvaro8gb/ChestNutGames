<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$form = new es\chestnut\usuarios\FormularioRegistro();

$tituloPagina = 'Registro';
$contenidoPrincipal = $form->gestiona();

$css = link_css($app->resuelve(RUTA_CSS.'formulario.css'));

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => $css];

$app->generaVista('/plantillas/plantilla.php', $params);