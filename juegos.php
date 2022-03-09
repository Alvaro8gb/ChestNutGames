<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Juegos';

$contenidoPrincipal = <<<EOS
    <head>
        <link rel="stylesheet" type="text/css" href="css/estilo_juegos.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Juegos</title>
    </head>

    <img class="gif_centrado" src="img/juegos/play_now.gif" alt="Gif"> 
EOS;
    $conn = $app->conexionBd();
    $sql = "SELECT IdJuego, Imagen FROM juegos";
    $consulta = @mysqli_query($conn, $sql);
    while($fila = @mysqli_fetch_array($consulta)) {
        $contenidoPrincipal .= <<<EOS
        <div class="fila">
        EOS;
        for($i = 0; $i < 5; $i++){
            $contenidoPrincipal .= <<<EOS
            <div class="columna">
                <a href="informacion_juego.php?id=$fila[IdJuego]"><img src="data:image/png;base64,<?php echo base64_encode($fila[Imagen]); ?>"></a>
            </div>
            EOS;
        } 
    }

require __DIR__.'/includes/plantillas/plantilla.php';