<?php
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Concepto del proyecto';

$contenidoPrincipal = <<<EOS

<h1> ChestNutGames </h1>

<img id="logo" src="img/logo/Chestnut_Logo.png" alt="logo" >
            
<div id="text">
    <p >
        Nuestra aplicación web trata de un portal web de minijuegos que puedes disfrutar en
        cualquier momento o lugar, enfocada a todos los públicos, nuestros minijuegos se centran
        en darte la mejor diversión con títulos que siempre has conocido como: Las damas, La oca,
        Conecta 4, Tres en raya, Parchís, 2048... y muchos más.
        Además, si se registra podrá disfrutar de todos los maravillosos juegos y competir con otros
        jugadores comparándose en nuestro ranking por juego.
        La aplicación tiene como base de financiación la publicidad y la suscripción de usuarios, los
        cuales disfrutarán de ventajas y mayores posibilidades en la web.
    </p> 
</div>
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';