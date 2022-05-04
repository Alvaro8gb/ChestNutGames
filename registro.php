<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';


$tituloPagina = 'Registro';
$css = link_css($app->resuelve(RUTA_CSS.'formulario.css'));
$css.= link_js($app->resuelve(RUTA_JS.'jquery-3.6.0.min.js'));
$css.= link_js($app->resuelve(RUTA_JS.'comprobar_registro.js'));

try{
    $form = new es\chestnut\usuarios\FormularioRegistro();
    $contenidoPrincipal = $form->gestiona();

}catch(\Exception $e){
    $app->paginaError(501,'Error',"Error en registro: ".$e->getMessage(),$e->getTrace());
}


$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => $css];

$app->generaVista('/plantillas/plantilla.php', $params);