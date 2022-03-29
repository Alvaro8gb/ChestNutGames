<?php
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Contacta con nosotros';

$ruta1 = RUTA_CSS.'formulario.css';
$ruta2 = RUTA_CSS.'button.css';

ob_start();
require __DIR__.'/static/formContacto.html';
$contenidoPrincipal = <<<EOS
<head>
    <link rel="stylesheet" type="text/css" href={$ruta1}>
    <link rel="stylesheet" type="text/css" href={$ruta2}>
</head>
EOS;
$contenidoPrincipal .= ob_get_clean();

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);