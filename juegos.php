<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Juegos';

$contenidoPrincipal = <<<EOS
    <head>
        <link rel="stylesheet" type="text/css" href="css/estilo_juegos.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Juegos</title>;
    </head>
EOS;

    //<body>
    echo '<img class="gif_centrado" src="img/juegos/play_now.gif" alt="Gif">';

    $this->conn = new \mysqli('host', 'user', 'pass', 'bd');
        
    //$sql = "SELECT IdJuego, Imagen FROM juegos";
    //$consula = $conn->query($ql);

    /*$encontrado = 0;
    while($fila = @mysqli_fetch_array($consulta)) {
        if($fila['Usuario'] == $username && $fila['Contrasenia'] == $password){
                    $encontrado = 1;
                }
            }

        
    </body>*/

require __DIR__.'/includes/plantillas/plantilla.php';