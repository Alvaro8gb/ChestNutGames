<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$app->verificaLogado($app->buildUrl("noLogeado.php"));

$tituloPagina = 'Juegos';
$css = link_css($app->resuelve(RUTA_CSS.'juegos.css'));
      
try{
    $juegos = new \es\chestnut\juegos\Juegos();
    $contenidoPrincipal = $juegos->gestiona();      

}catch(\Exception $e){
    $app->paginaError(501,'Error',"Error en juegos: ".$e->getMessage(),$e->getTrace());
}

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => $css];
$app->generaVista('/plantillas/plantilla.php', $params);
	
?>