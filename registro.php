<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$tituloPagina = 'Registro';
$css = link_css($app->resuelve(RUTA_CSS.'formulario.css'));

$jss_pages = array("jquery-3.6.0.min.js","comprobar_registro.js");	

foreach($jss_pages as $elem){
	$js .= link_js($app->resuelve(RUTA_JS.$elem));
}

try{
    $form = new es\chestnut\usuarios\FormularioRegistro();
    $contenidoPrincipal = $form->gestiona();

}catch(\Exception $e){
    $app->paginaError(501,'Error',"Error en registro: ".$e->getMessage(),$e->getTrace());
}

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => $css,'js' => $js];
$app->generaVista('/plantillas/plantilla.php', $params);