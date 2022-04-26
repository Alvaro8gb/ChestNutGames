<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

use \es\chestnut\usuarios\Usuario;

$tituloPagina = 'perfilUsuario';
$css = link_css($app->resuelve(RUTA_CSS.'ranking.css'));

////Ranking por jugadores

$contenidoPrincipal = <<<EOS
<div>
   <div class = "move"> 
      <span>RANKING GLOBAL</span>
      <div class="liquid"></div>
   </div>
    <table class ="out">
      <tr>
          <th>JUGADOR</th>
          <th>PUNTUACION</th>
      </tr>
EOS;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal,'css'=> $css];
$app->generaVista('/plantillas/plantilla.php', $params);


