<?php


require_once __DIR__.'/includes/config.php';

$form = new \es\chestnut\usuarios\FormularioLogin();

$tituloPagina = 'Login';

$htmlFormLogin = $form->gestiona();
$contenidoPrincipal = $htmlFormLogin;


$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);