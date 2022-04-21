<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$tituloPagina = 'Bocetos';

$path = $app->resuelve(RUTA_IMGS.'bocetos/');
$imagenes = array("Premium","Ranking","MainPage","Tienda","Eventos","Publicidad");

$contenidoPrincipal = '<div class="bocetosipv">';

foreach($imagenes as $img){
    $contenidoPrincipal.= link_img($path.$img.".jpg",$img);
}

$contenidoPrincipal .= "</div>";  

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);