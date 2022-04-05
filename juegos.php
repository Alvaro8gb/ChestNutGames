<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$tituloPagina = 'Juegos';
$css = link_css($app,RUTA_CSS.'juegos.css');

$app->verificaLogado("noLogeado.php");

$contenidoPrincipal = '<img class="gif_centrado" src="{$ruta_imgs}play.gif" alt="Gif">'; 
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
            $contenidoPrincipal .= '<a href="procesarJuego.php?id='.$fila["IdJuego"].'"><img class="juego" src="data:image/png;base64,'.base64_encode($fila["Imagen"]).'"/>';
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


$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal, 'css' => $css];
$app->generaVista('/plantillas/plantilla.php', $params);