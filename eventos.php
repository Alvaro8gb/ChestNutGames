<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$ruta = RUTA_CSS.'eventos.css';
$rutaimg = RUTA_IMGS.'torneosyeventos/';

$tituloPagina = 'Eventos';

$log_info = check_log_in();

if(empty($log_info)){

    $contenidoPrincipal = <<<EOS
    <head>
        <link rel="stylesheet" type="text/css" href={$ruta}>
    </head>
    EOS;

    $contenidoPrincipal .= <<< EOS
        <div class = "msg_centrado">
            <h4>Demuestra tu habilidad, gana dinero y muchos premios jugando los mejores torneos de la comunidad.</h4>
        </div>
        
        <div class = "img_buscar">
        <img src="{$rutaimg}buscar.jpg" alt="buscar">
        </div>

        <div class = "text_buscar">
        <input type ="text" name ="buscar" value ="">
        </div>

        <div class = "button_buscar">
        <button type = "button" onclick = 'href="mailto:sergilor@ucm.es"'>Buscar</button>
        </div>

        <div class = "footer_zone">
        En ChestnutGames no se admiten trampas de ningún tipo y el respeto entre jugadores es esencial. Nuestra comunidad está formada únicamente 
        por jugadores que cumplen las Reglas y actúan de forma deportiva. Nuestra plataforma integra sistemas de detección de tramposos, 
        obtención de resultados de forma automática desde los videojuegos y un equipo de profesionales. Defendemos la integridad de las 
        competiciones. !Que gane el mejor! 
        </div>
EOS;
}else{
    $contenidoPrincipal = $log_info;
}
        
$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);