<?php

require_once __DIR__.'/includes/config.php';

$form = new es\chestnut\usuarios\FormularioRegistro();
$htmlFormRegistro = 

$tituloPagina = 'Registro';
$contenidoPrincipal = $form->gestiona();

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);