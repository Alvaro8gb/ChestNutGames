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

        <form action="" method="get">
            <div class = "text_buscar">
                <input class="evi" type ="text" name ="evento" value ="">
            </div>
            <div class = "button_buscar">
                <input type="submit" name="buscar" value="buscar">
            </div>
        </form>
    EOS;

    if(isset($_GET['buscar'])){
        // Recogemos el nombre del evento enviado a buscar
        $eventToSearch = $_GET["evento"];

        // Si está vacío, lo informamos, sino realizamos la búsqueda
        if(empty($eventToSearch)){
            $contenidoPrincipal .= '<br><p>No se ha ingresado un evento a buscar</p>';
        }
        else {
            // Conexión a la base de datos y seleccion de registros
            $conn = $app->getConexionBd();
            $sql = "SELECT nombre FROM eventos WHERE (nombre LIKE '%" . $eventToSearch . "%')";
            $consulta = @mysqli_query($conn, $sql);
            $count_results = mysqli_num_rows($consulta);

            // Si hay resultados
            if($count_results > 0){
                $contenidoPrincipal .= 
                '<br><p>El evento buscado, '.$eventToSearch.', se encuentra en nuestra página web. Deslícese sobre el siguiente
                slide colocado a continuación hasta encontrarlo.<p>';
            }
            else{
                // Si no hay resultados
                $contenidoPrincipal .= 
                '<br><p>No se encuentran resultados con los criterios de búsqueda.</p>';
            }
        }
    }

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