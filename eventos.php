<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$tituloPagina = 'Eventos';
$css =  link_css($app->resuelve(RUTA_CSS.'eventos.css'));

$app->verificaLogado($app->buildUrl("noLogeado.php"));

$contenidoPrincipal = <<<EOS
    <div class = "msg_centrado">
    <h3>Demuestra tu habilidad, gana dinero y muchos premios jugando los mejores torneos de la comunidad.</h3>
    </div>
EOS;

try{
    $eventos = new \es\chestnut\eventos\Eventos();
    $contenidoPrincipal .= $eventos->gestiona();      

}catch(\Exception $e){
    $app->paginaError(501,'Error',"Error en eventos: ".$e->getMessage(),$e->getTrace());
}

$contenidoPrincipal .= '<div class="slider">';
    
foreach($eventos as $id => $img ){
    $contenidoPrincipal .= '<input type="radio" id="' . $id . '" name="image-slide" hidden />';
}
$contenidoPrincipal .= '<div class="slideshow">';

foreach($eventos as $id => $img ){
    $contenidoPrincipal .= 
        '<div class="item-slide">
        <a href="procesarEvento.php?id='.$id.'"><img src="data:image/png;base64,'.base64_encode($img).'"></a>
        </div>'; 
}
$contenidoPrincipal .= 
    '</div>
    <div class="pagination">';
foreach($eventos as $id => $img ){ 
    $contenidoPrincipal .=
        '<label class="pag-item" for="' . $id . '">
            <img src="data:image/png;base64,'.base64_encode($img).'">
        </label>';
}
$contenidoPrincipal .='</div> </div>';

$contenidoPrincipal .= <<< EOS
    <div class = "footer_zone">
    En ChestnutGames no se admiten trampas de ningún tipo y el respeto entre jugadores es esencial. Nuestra comunidad está formada únicamente 
    por jugadores que cumplen las Reglas y actúan de forma deportiva. Nuestra plataforma integra sistemas de detección de tramposos, 
    obtención de resultados de forma automática desde los videojuegos y un equipo de profesionales. Defendemos la integridad de las 
    competiciones. !Que gane el mejor! 
    </div>
EOS;
     
$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal,'css'=> $css];
$app->generaVista('/plantillas/plantilla.php', $params);