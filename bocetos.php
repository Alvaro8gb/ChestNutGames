<?php
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Bocetos';

$rutaimg = RUTA_IMGS.'bocetos/';

$contenidoPrincipal = <<<EOS
<div class="bocetosipv">

    <img src="{$rutaimg}Premium+.jpg" alt="Premium"  />
    <br>
    <img src="{$rutaimg}Ranking.jpg" alt="Ranking " />
    <br>
    <img src="{$rutaimg}MainPage.jpg" alt="Main Page" />
    <br>
    <img src="{$rutaimg}Tienda.jpg" alt="Tienda " /> 
    <br>
    <img src="{$rutaimg}Torneos-Eventos.jpg" alt="Torneos" />
    <br>
    <img src="{$rutaimg}publicidad.jpg" alt="Publicidad" />

</div>  
EOS;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);