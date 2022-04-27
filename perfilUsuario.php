<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

use \es\chestnut\usuarios\Usuario;

$app->verificaLogado($app->buildUrl("noLogeado.php"));

$tituloPagina = 'perfilUsuario';
$css = link_css($app->resuelve(RUTA_CSS.'ranking.css'));

$user = Usuario::buscarUsuarioPorId($app->idUsuario());
$eventos_inscritos = $user->getInscripciones();


$contenidoPrincipal = <<<EOS
<div>

Victor la chupa
EOS;
foreach( $eventos_inscritos as $id => $nombre){
    $contenidoPrincipal .=<<<EOS
    <p> $id  $nombre</p>
EOS;
}
$contenidoPrincipal .=<<<EOS
</div>
EOS;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal,'css'=> $css];
$app->generaVista('/plantillas/plantilla.php', $params);


