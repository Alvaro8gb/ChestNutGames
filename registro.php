<?php

require_once __DIR__.'/includes/config.php';

$form = new es\chestnut\FormularioRegistro();
$htmlFormRegistro = 

$tituloPagina = 'Registro';
$contenidoPrincipal = $form->gestiona();

include __DIR__.'/includes/vistas/plantillas/plantilla.php';