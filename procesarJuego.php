<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'ProcesarJuego';

$ruta = RUTA_CSS.'juegos.css';

$contenidoPrincipal = <<<EOS
    <head>
        <link rel="stylesheet" type="text/css" href={$ruta}>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>ProcesarJuego</title>
    </head>
EOS;
    $conn = $app->getConexionBd();
    $sql = "SELECT * FROM juegos WHERE IdJuego = $_GET[id]";
    $consulta = @mysqli_query($conn, $sql);
    $fila = @mysqli_fetch_array($consulta);

    $contenidoPrincipal .= '<div class = "img_juego">
        <img src="data:image/png;base64,'.base64_encode($fila["Imagen"]).'"/>
        </div>';
    
    $rutaimg = RUTA_IMGS.'juegos/';
    
    $contenidoPrincipal .= <<< EOS
        <div class = "boton_exit">
            <a href="juegos.php"><img src="{$rutaimg}exit.png" alt="Exit"></a>
        </div>
        <div class = "boton_play_now">
            <a href="$fila[Enlace]"><img src="{$rutaimg}play.png" alt="Play Now"></a>
        </div>
        <div class = "boton_ranking">
            <a href="ranking.php#$fila[IdJuego]"><img src="{$rutaimg}ranking.png" alt="Ranking"></a>
        </div>
        <div class = "informacion">
            <p><b>Título: </b>$fila[Nombre].</p>
            <p><b>Categoría: </b>$fila[Categoria]</p>
            <p><b>Descripción: </b>$fila[Descripcion]</p>
        </div>
    EOS;

    $params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
    $app->generaVista('/plantillas/plantilla.php', $params);