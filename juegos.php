<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Juegos';

$contenidoPrincipal = "";

    <<<EOS
    <head>
        <link rel="stylesheet" type="text/css" href="css/estilo_juegos.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Juegos</title>;
    </head>
    EOS;

    //<body>
    echo '<img class="gif_centrado" src="img/juegos/play_now.gif" alt="Gif">';

   /* $conn = $app->conexionBd();
        
    $sql = "SELECT IdJuego, Imagen FROM juegos";
    $consulta = @mysqli_query($conn, $sql);

    $encontrado = 0;
    while($fila = @mysqli_fetch_array($consulta)) {
        if($fila['Usuario'] == $username && $fila['Contrasenia'] == $password){
                    $encontrado = 1;
                }
            }

        
    </body>*/
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';