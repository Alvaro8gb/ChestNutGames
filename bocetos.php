<?php
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Bocetos';

$contenidoPrincipal = <<<EOS
<div class="bocetosipv">

    <img src="img/bocetos/Premium+.jpg" alt="Premium"  />
    <br>
    <img src="img/bocetos/Ranking.jpg" alt="Ranking " />
    <br>
    <img src="img/bocetos/MainPage.jpg" alt="Main Page" />
    <br>
    <img src="img/bocetos/Tienda.jpg" alt="Tienda " /> 
    <br>
    <img src="img/bocetos/Torneos-Eventos.jpg" alt="Torneos" />
    <br>
    <img src="img/bocetos/publicidad.jpg" alt="publicidad" />

</div>  
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';