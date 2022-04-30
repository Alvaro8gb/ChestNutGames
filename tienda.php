<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$app->verificaLogado($app->buildUrl("noLogeado.php"));

$tituloPagina = 'Tienda';
$css = link_css($app->resuelve(RUTA_CSS.'tienda.css'));
$css.=link_js($app->resuelve(RUTA_JS.'jquery-3.6.0.min.js'));
$css.=link_js($app->resuelve(RUTA_JS.'cantidad.js'));
      
try{
    $tienda = new \es\chestnut\tienda\Tienda();
    $contenidoPrincipal = $tienda->gestiona();      

}catch(\Exception $e){
    $app->paginaError(501,'Error',"Error en tienda: ".$e->getMessage(),$e->getTrace());
}

// Mostrar anuncio 

if($app->show_advert()){
    $contenidoPrincipal .=  '<script> advert_show(); </script>';
}

#CSS grid

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css'=>$css];
$app->generaVista('/plantillas/plantilla.php', $params);




