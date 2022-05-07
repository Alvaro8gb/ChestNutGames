<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST') {
    $app->redirige('/index.php');
}

$tituloPagina='Logout';

try{
    $form = new \es\chestnut\usuarios\FormularioLogout();
    $htmlForm = $form->gestiona();
    $contenidoPrincipal = $htmlForm;      
}catch(\Exception $e){
    $app->paginaError(501,'Error',"Error en formulario logout: ".$e->getMessage(),$e->getTrace());
}

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);
