<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Juegos';

$contenidoPrincipal = <<<EOS
    <head>
        <link rel="stylesheet" type="text/css" href="css/juegos.css" />
    </head>

    <img class="gif_centrado" src="img/juegos/play_now.gif" alt="Gif"> 
EOS;
    $conn = $app->conexionBd();
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

require __DIR__.'/includes/plantillas/plantilla.php';