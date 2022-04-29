<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$app->verificaLogado($app->buildUrl("noLogeado.php"));

$tituloPagina = 'Compra realizada';
$css = link_css($app->resuelve(RUTA_CSS.'carrito.css'));
      
try{
    $compras = new \es\chestnut\tienda\realizarPedido();
    $contenidoPrincipal = $compras->gestiona();      

}catch(\Exception $e){
    $app->paginaError(501,'Error',"Error en tienda: ".$e->getMessage(),$e->getTrace());
}

#CSS grid

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css'=>$css];
$app->generaVista('/plantillas/plantilla.php', $params);

// Mostrar anuncio 
if($app->show_advert())
echo '<script type="text/javascript"> advert_show(); </script>';


