<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';


$tituloPagina = 'Juegos';

$log_info = check_log_in($_SESSION["login"]);

if(empty($log_info)){

    $contenidoPrincipal = <<<EOS
        <head>
            <link rel="stylesheet" type="text/css" href="css/juegos.css"/>
        </head>

        <img class="gif_centrado" src="img/juegos/play_now.gif" alt="Gif"> 
    EOS;
    $conn = $app->getConexionBd();
    $sql = "SELECT IdJuego, Imagen FROM juegos";
    $consulta = @mysqli_query($conn, $sql);
    $parar = 0;
    while($parar != 1) {
        $contenidoPrincipal .= <<<EOS
            <div class="fila">
        EOS;
        $i = 1;
        while($parar != 1 && $i <= 5){
            if($fila = @mysqli_fetch_array($consulta)){
                $contenidoPrincipal .= <<<EOS
                    <div class="columna">
                EOS;
                $contenidoPrincipal .= '<a href="procesarJuego.php?id='.$fila["IdJuego"].'"><img src="data:image/png;base64,'.base64_encode($fila["Imagen"]).'"/>';
                $contenidoPrincipal .= <<<EOS
                    </div>
                EOS;
                $i++;
            }
            else{
                $parar = 1;
            }
        } 
        $contenidoPrincipal .= <<<EOS
            </div>
        EOS;
    }
    $consulta->free();

}else{
    $contenidoPrincipal = $log_info;
}

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);