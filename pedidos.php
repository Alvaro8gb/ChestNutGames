<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$app->verificaLogado($app->buildUrl("noLogeado.php"));

$tituloPagina = 'Pedidos';
$css = link_css($app->resuelve(RUTA_CSS.'carrito.css'));
      
try{
    $pedidos = new \es\chestnut\tienda\Pedidos();
    $contenidoPrincipal = $pedidos->gestiona();      

}catch(\Exception $e){
    $app->paginaError(501,'Error',"Error en pedidos: ".$e->getMessage(),$e->getTrace());
}

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css'=>$css];
$app->generaVista('/plantillas/plantilla.php', $params);




