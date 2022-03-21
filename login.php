<?php

namespace es\chestnut;

require_once __DIR__.'/includes/config.php';

$form = new FormularioLogin();

$tituloPagina = 'Login';

$htmlFormLogin = $form->gestiona();

$contenidoPrincipal = <<<EOF
    $htmlFormLogin
EOF;


require __DIR__.'/includes/vistas/plantillas/plantilla.php';