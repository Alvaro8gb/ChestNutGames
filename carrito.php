<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$app->verificaLogado($app->buildUrl("noLogeado.php"));

$tituloPagina = 'Cesta de la compra';
$css = link_css($app->resuelve(RUTA_CSS.'carrito.css'));
$css.=link_js($app->resuelve(RUTA_JS.'jquery-3.6.0.min.js'));
$css.=link_js($app->resuelve(RUTA_JS.'cantidad_cesta.js'));
      
try{
    $carrito = new \es\chestnut\carrito\Carrito($app->getCarrito());
    $contenidoPrincipal = $carrito->mostrarCarrito();      

}catch(\Exception $e){
    $app->paginaError(501,'Error',"Error en carrito: ".$e->getMessage(),$e->getTrace());
}

#CSS grid

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css'=>$css];
$app->generaVista('/plantillas/plantilla.php', $params);

// Mostrar anuncio 
if($app->show_advert())
echo '<script type="text/javascript"> advert_show(); </script>';


