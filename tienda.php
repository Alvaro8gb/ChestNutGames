<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$app->verificaLogado($app->buildUrl("noLogeado.php"));

$tituloPagina = 'Tienda';

$css = link_css($app->resuelve(RUTA_CSS.'tienda.css'));
$jss_pages = array("jquery-3.6.0.min.js","cantidad.js");	
$js ='';

foreach($jss_pages as $elem){
	$js .= link_js($app->resuelve(RUTA_JS.$elem));
}
      
try{
    $tienda = new \es\chestnut\tienda\Tienda();
    $contenidoPrincipal = $tienda->gestiona();      
}catch(\Exception $e){
    $app->paginaError(501,'Error',"Error en tienda: ".$e->getMessage(),$e->getTrace());
}

if($app->show_advert()){
    $contenidoPrincipal .=  '<script> advert_show(); </script>';
}

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css'=>$css,'js' =>$js];
$app->generaVista('/plantillas/plantilla.php', $params);



