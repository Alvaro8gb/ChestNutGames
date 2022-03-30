<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$form = new es\chestnut\usuarios\FormularioRegistro();

$tituloPagina = 'Registro';
$contenidoPrincipal = $form->gestiona();

$css = link_css(RUTA_CSS."form.css");
$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => $css];

$app->generaVista('/plantillas/plantilla.php', $params);