<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

use \es\chestnut\usuarios\Usuario;

$app->verificaLogado($app->buildUrl("noLogeado.php"));

$tituloPagina = 'perfilUsuario';
$css = link_css($app->resuelve(RUTA_CSS.'perfil.css'));

$user = Usuario::buscarUsuarioPorId($app->idUsuario());
$eventos_inscritos = $user->getInscripciones();
$nombreUsuario = $user->getNombreUsuario();
$correo = $user->getCorreo();
$historial = '<a class="pedidos" href="pedidos.php">Historial de pedidos</a>';
$juegos_jugados= $user->getJuegosJugados();
$puntuacion_juegos = $user->getPuntuacionJuegos();

$contenidoPrincipal = <<<EOS
<div>
    <div class = "titular"> 
        PERFIL USUARIO
    </div>
    <table class ="out">
      <tr>
          <th>NOMBRE DE USUARIO </th>
          <td>$nombreUsuario</td>
      </tr>
      <tr>
          <th>CORREO DE USUARIO </th>
          <td>$correo</td>
      </tr>
      <tr>
          <th>EVENTOS SUSCRITOS </th>
          <td>
      
EOS;
foreach( $eventos_inscritos as $id => $nombre){
    $contenidoPrincipal .=<<<EOS
     $nombre /
EOS;
}
$contenidoPrincipal .=<<<EOS
</td>
</tr>
<tr> 
<th> JUEGO </th>

EOS;
foreach( $juegos_jugados as $nombre){
$contenidoPrincipal .=<<<EOS
<th> $nombre </th>
EOS;
}
$contenidoPrincipal .=<<<EOS
</tr>
<tr>
<th> PUNTUACION </th>
EOS;
foreach( $puntuacion_juegos as $puntuacion){
$contenidoPrincipal .=<<<EOS
<th> $puntuacion </th>
EOS;
}
$contenidoPrincipal .=<<<EOS
</tr>
    </table>
    <div class ="padre">
        <div class= "hijo">
        $historial
        </div>
    </div>
</div>
EOS;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal,'css'=> $css];
$app->generaVista('/plantillas/plantilla.php', $params);


