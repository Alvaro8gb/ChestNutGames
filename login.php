<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$form = new \es\chestnut\usuarios\FormularioLogin();

$tituloPagina = 'Login';

$htmlFormLogin = $form->gestiona();
$contenidoPrincipal = $htmlFormLogin;

$css = link_css($app,RUTA_CSS.'formulario.css');

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => $css];
$app->generaVista('/plantillas/plantilla.php', $params);