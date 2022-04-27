<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

use \es\chestnut\usuarios\Usuario;

$app->verificaLogado($app->buildUrl("noLogeado.php"));

$tituloPagina = 'perfilUsuario';
$css = link_css($app->resuelve(RUTA_CSS.'ranking.css'));

$user = Usuario::buscarUsuarioPorId($app->idUsuario());
$eventos_inscritos = $user->getInscripciones();
$nombreUsuario = $user->getNombreUsuario();
$correo = $user->getCorreo();

$contenidoPrincipal = <<<EOS
<div>
    <div class = "move"> 
        <span>PERFIL USUARIO</span>
        <div class="liquid"></div>
    </div>
    <table class ="out">
      <tr>
          <th>NOMBRE DE USUARIO </th>
          <th>$nombreUsuario</th>
      </tr>
      <tr>
          <th>CORREO DE USUARIO </th>
          <th>$correo</th>
      </tr>
      <tr>
          <th>EVENTOS SUSCRITOS </th>
          <th>
      
EOS;
foreach( $eventos_inscritos as $id => $nombre){
    $contenidoPrincipal .=<<<EOS
     $nombre /
EOS;
}
$contenidoPrincipal .=<<<EOS
        </th>
        </tr>
    </table>
</div>
EOS;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal,'css'=> $css];
$app->generaVista('/plantillas/plantilla.php', $params);


