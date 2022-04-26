<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$app->verificaLogado($app->buildUrl("noLogeado.php"));

$tituloPagina = 'Tienda';
$css = link_css($app->resuelve(RUTA_CSS.'tienda.css'));
      
try{
    $tienda = new \es\chestnut\tienda\Tienda();
    $contenidoPrincipal = $tienda->gestiona();      

}catch(\Exception $e){
    $app->paginaError(501,'Error',"Error en tienda: ".$e->getMessage(),$e->getTrace());
}

#CSS grid

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);

// Mostrar anuncio 
if($app->show_advert())
echo '<script type="text/javascript"> advert_show(); </script>';

?>
