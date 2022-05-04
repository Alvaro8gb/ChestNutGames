<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST') {
    $app->redirige('/index.php');
}

$tituloPagina='Logout';
$form = new \es\chestnut\usuarios\FormularioLogout();

$htmlFormLogin = $form->gestiona();
$contenidoPrincipal = $htmlFormLogin;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);
