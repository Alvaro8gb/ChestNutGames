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
        <img class="gif_centrado" src="img/play-now-games.gif" alt="Gif">

        <div class="fila">
            <div class="columna">
                <a href="informacion.html"><img src="img/pac-man.jpg" alt="Pac Man"></a>
            </div>
            <div class="columna">
                <a href="hola.php?a=hola"><img src="img/buscaminas.png" alt="Buscaminas"></a>
            </div>
            <div class="columna">
                <a href="informacion.html"><img src="img/parchis.png" alt="Parchís"></a>
            </div>
            <div class="columna">
                <a href="informacion.html"><img src="img/solitario.jpg" alt="Solitario"></a>
            </div>
            <div class="columna">
                <a href="informacion.html"><img src="img/plants-zombies.jpg" alt="Pac Man"></a>
            </div>
        </div>
        <div class="fila">
            <div class="columna">
                <a href="informacion.html"><img src="img/mario-bros.jpg" alt="Pac Man"></a>
            </div>
            <div class="columna">
                <a href="informacion.html"><img src="img/Survival_Race.png" alt="Pac Man"></a>
            </div>
            <div class="columna">
                <a href="informacion.html"><img src="img/Tres-en-linea.png" alt="Pac Man"></a>
            </div>
            <div class="columna">
                <a href="informacion.html"><img src="img/wood-blocks.jpg" alt="Pac Man"></a>
            </div>
            <div class="columna">
                <a href="informacion.html"><img src="img/world-cup-penalty.jpg" alt="Pac Man"></a>
            </div>
        </div>
    </body>
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';