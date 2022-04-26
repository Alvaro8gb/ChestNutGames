<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

use \es\chestnut\usuarios\Usuario;

$tituloPagina = 'perfilUsuario';
$css = link_css($app->resuelve(RUTA_CSS.'ranking.css'));
$inscripciones = null;
////Ranking por jugadores
if($_SESSION["login"]){
    $user = Usuario::buscarUsuarioPorId($_SESSION["idUsuario"]);
    $inscripciones = $user->getInscripciones();
}
$contenidoPrincipal = <<<EOS
<div>
EOS;
foreach( $incripciones as $inscripcion){
    $x = $inscripcion["IdEvento"];
    $contenidoPrincipal .=<<<EOS
    <p> 1 </p>
EOS;
}
$contenidoPrincipal .=<<<EOS
</div>
EOS;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal,'css'=> $css];
$app->generaVista('/plantillas/plantilla.php', $params);


