<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Información ';

$contenidoPrincipal = <<<EOS

<h1 class = "h1_title"> · Contenido de entregas anteriores </h1>

<nav >
    
    <ul>
        <li> <a class="nav_home" href="index.php">Home</a> </li>
        <li> <a href="detalles.php">Detalles</a> </li>
        <li> <a href="planificacion.php">Planificación</a> </li>
        <li> <a href="bocetos.php">Bocetos</a> </li>
        <li> <a href="miembros.php">Miembros</a> </li>   
    </ul>
                    
</nav>
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';