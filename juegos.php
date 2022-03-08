<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Juegos';

$contenidoPrincipal = <<<EOS
    <head>
        <link rel="stylesheet" type="text/css" href="css/estilo_juegos.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Juegos</title>
    </head>
    <body>
        <img class="gif_centrado" src="img/juegos/play_now.gif" alt="Gif">

        
    </body>
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';