<?php

namespace es\chestnut;

//Inicio del procesamiento
require_once __DIR__.'/includes/config.php';

$form = new FormularioRegistro();
$htmlFormRegistro = $form->gestiona();

$tituloPagina = 'Registro';
$contenidoPrincipal = <<<EOF
		$htmlFormRegistro
EOF;

include __DIR__.'/includes/plantillas/plantilla.php';