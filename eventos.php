<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$tituloPagina = 'Eventos';
$css =  link_css($app->resuelve(RUTA_CSS.'eventos.css'));

$app->verificaLogado($app->buildUrl("noLogeado.php"));

try{
    $eventos = new \es\chestnut\eventos\Eventos();
    $contenidoPrincipal .= $eventos->gestiona();      

}catch(\Exception $e){
    $app->paginaError(501,'Error',"Error en eventos: ".$e->getMessage(),$e->getTrace());
}
     
$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal,'css'=> $css];
$app->generaVista('/plantillas/plantilla.php', $params);