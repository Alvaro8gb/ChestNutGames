<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$app->verificaLogado($app->buildUrl("noLogeado.php"));

$tituloPagina = 'Cesta de la compra';
$css = link_css($app->resuelve(RUTA_CSS.'carrito.css'));

$jss_pages = array("jquery-3.6.0.min.js","cantidad_cesta.js");	
$js ='';

foreach($jss_pages as $elem){
	$js .= link_js($app->resuelve(RUTA_JS.$elem));
}

try{
    $carrito = new \es\chestnut\carrito\Carrito($app->getCarrito());
    $contenidoPrincipal = $carrito->gestiona();      
}catch(Exception $e){
    $app->paginaError(501,'Error',"Error en carrito: ".$e->getMessage(),$e->getTrace());
}

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css'=>$css, 'js' =>$js];
$app->generaVista('/plantillas/plantilla.php', $params);



