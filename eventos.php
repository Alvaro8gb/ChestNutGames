<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$rutaimg = RUTA_IMGS.'eventos/';

$tituloPagina = 'Eventos';
$css =  link_css($app,RUTA_CSS.'eventos.css');


$app->verificaLogado("noLogeado.php");

$eventos = array();

$conn = $app->getConexionBd();
$sql = "SELECT idEvento, imagen FROM eventos";
$consulta = @mysqli_query($conn, $sql);
while($fila = @mysqli_fetch_array($consulta)){
    $eventos[$fila["idEvento"]] = $fila["imagen"];
}

$consulta->free();

$contenidoPrincipal = <<<EOS
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
            <input class="search" type="submit" name="buscar" value="buscar">
        </div>
    </form>
EOS;

if(isset($_GET['buscar'])){
    // Recogemos el nombre del evento enviado a buscar
    $eventToSearch = filter_var(trim($_GET["evento"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    // Si está vacío, lo informamos, sino realizamos la búsqueda
    if(empty($eventToSearch)){
        $contenidoPrincipal .= '<br><p>No se ha ingresado un evento a buscar</p>';
    }
    else {
        // Conexión a la base de datos y seleccion de registros
        $conn = $app->getConexionBd();
        $prepared = $conn->prepare("SELECT nombre FROM eventos WHERE nombre LIKE ? ");
        $prepared->execute(array("%$eventToSearch%"));
        $consulta = $prepared->get_result();
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
    
foreach($eventos as $id => $img ){
    $contenidoPrincipal .= '<input type="radio" id="' . $id . '" name="image-slide" hidden />';
}
$contenidoPrincipal .= '<div class="slideshow">';

foreach($eventos as $id => $img ){
    $contenidoPrincipal .= 
        '<div class="item-slide">
        <a href="procesarEvento.php?id='.$id.'"><img src="data:image/png;base64,'.base64_encode($img).'"/>
        </div>'; 
}
$contenidoPrincipal .= 
    '</div>
    <div class="pagination">';
foreach($eventos as $id => $img ){ 
    $contenidoPrincipal .=
        '<label class="pag-item" for="' . $id . '">
            <img src="data:image/png;base64,'.base64_encode($img).'"/>
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