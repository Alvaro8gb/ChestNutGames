<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$ruta = RUTA_CSS.'eventos.css';
$rutaimg = RUTA_IMGS.'eventos/';

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
            <h3>Demuestra tu habilidad, gana dinero y muchos premios jugando los mejores torneos de la comunidad.</h3>
        </div>
        
        <div class = "img_buscar">
        <img id="ev" src="{$rutaimg}buscar.jpg" alt="buscar">
        </div>

        <div class = "text_buscar">
        <input class="evi" type ="text" name ="evento" value ="">
        </div>

        <div class = "button_buscar">
        <button type = "button" name = "buscar" id = "buscar" onclick = 'href="procesarBisqueda.php"'>Buscar</button>
        </div>
    EOS;

    

    $contenidoPrincipal .= '<div class="slider">';
        $ids = array();
        $imgs = array();
    
        $conn = $app->getConexionBd();
        $sql = "SELECT idEvento, imagen FROM eventos";
        $consulta = @mysqli_query($conn, $sql);
        while($fila = @mysqli_fetch_array($consulta)){
            $ids[] = $fila["idEvento"];
            $imgs[] = $fila["imagen"];
        }
    $max = count($ids);
    for($s=0;$s<$max;$s++){
        $contenidoPrincipal .= '<input type="radio" id="' . $ids[$s] . '" name="image-slide" hidden />';
    }
    $contenidoPrincipal .= 
        '<div class="slideshow">';
    for($s=0;$s<$max;$s++){ 
        $contenidoPrincipal .= 
            '<div class="item-slide">
            <a href="procesarEvento.php?id='.$ids[$s].'"><img src="data:image/png;base64,'.base64_encode($imgs[$s]).'"/>
            </div>'; 
    }
    $contenidoPrincipal .= 
        '</div>
        <div class="pagination">';
    for($s=0;$s<$max;$s++){ 
        $contenidoPrincipal .=
            '<label class="pag-item" for="' . $ids[$s] . '">
                <img src="data:image/png;base64,'.base64_encode($imgs[$s]).'"/>
            </label>';
    }
    $contenidoPrincipal .=
        '</div>
        </div>';

    $contenidoPrincipal .= <<< EOS
        <div class = "footer_zone">
        En ChestnutGames no se admiten trampas de ningún tipo y el respeto entre jugadores es esencial. Nuestra comunidad está formada únicamente 
        por jugadores que cumplen las Reglas y actúan de forma deportiva. Nuestra plataforma integra sistemas de detección de tramposos, 
        obtención de resultados de forma automática desde los videojuegos y un equipo de profesionales. Defendemos la integridad de las 
        competiciones. !Que gane el mejor! 
        </div>
    EOS;
}
else{
    $contenidoPrincipal = $log_info;
}
        
$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);