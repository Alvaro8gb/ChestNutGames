<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$form = new es\chestnut\usuarios\FormularioRegistro();

$tituloPagina = 'Registro';
$contenidoPrincipal = $form->gestiona();

$css = link_css($app->resuelve(RUTA_CSS.'formulario.css'));
$css.=link_js($app->resuelve(RUTA_JS.'jquery-3.6.0.min.js'));
$css.=link_js($app->resuelve(RUTA_JS.'comprobar_registro.js'));

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => $css];

$app->generaVista('/plantillas/plantilla.php', $params);