<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$tituloPagina = 'Login';
$css = link_css($app->resuelve(RUTA_CSS.'formulario.css'));

try{
    $form = new \es\chestnut\usuarios\FormularioLogin();
    $htmlFormLogin = $form->gestiona();
    $contenidoPrincipal = $htmlFormLogin;      

}catch(\Exception $e){
    $app->paginaError(501,'Error',"Error en formulario login: ".$e->getMessage(),$e->getTrace());
}

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => $css];
$app->generaVista('/plantillas/plantilla.php', $params);