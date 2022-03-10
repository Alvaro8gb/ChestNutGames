<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'ProcesarJuego';

$contenidoPrincipal = <<<EOS
    <head>
        <link rel="stylesheet" type="text/css" href="css/estilo_juegos.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>ProcesarJuego</title>
    </head>
EOS;
    $conn = $app->conexionBd();
    $sql = "SELECT * FROM juegos";
    $consulta = @mysqli_query($conn, $sql);

    while($fila = @mysqli_fetch_array($consulta)){
        if($fila["IdJuego"] == $_GET["id"]){
            $contenidoPrincipal .= '<div class = "img_juego">
            <img src="data:image/png;base64,'.base64_encode($fila["Imagen"]).'"/>
            </div>';
        }
    }
    
    $contenidoPrincipal .= <<<EOS 
        <div class = "boton_exit">
            <a href="juegos.php"><img src="img/juegos/exit.png" alt="Exit"></a>
        </div>
    EOS;
    /*
        <div class = "boton_play_now">
            <a href="https://www.google.com/logos/2010/pacman10-i.html"><img src="img/juegos/play.png" alt="Play Now"></a>
        </div>
        <div class = "boton_ranking">
            <a href=""><img src="img/juegos/ranking.jpg" alt="Ranking"></a>
        </div>
        <div class = "informacion">
            <p><b>Título:</b> Pac Man.</p>
            <p><b>Categoría:</b>Acción</p>
            <p><b>Descripción:</b> Pac-Man es un videojuego de acción de persecución en laberintos; el jugador controla 
            al personaje del mismo nombre a través de un 
            laberinto cerrado. El objetivo del juego es comerse todos los puntos colocados en el laberinto mientras evita cuatro fantasmas de 
            colores: Blinky (rojo), Pinky (rosa), Inky (cian) y Clyde (naranja) que lo persiguen. Cuando Pac-Man se come todos los puntos, el 
            jugador avanza al siguiente nivel. Si Pac-Man hace contacto con un fantasma, perderá una vida; 
            el juego termina cuando se pierden todas las vidas. Cada uno de los cuatro fantasmas tiene su propia inteligencia artificial única 
            y distinta.(AI), o "personalidades"; Blinky persigue directamente a Pac-Man, Pinky e Inky intentan posicionarse frente a Pac-Man, 
            generalmente arrinconándolo, y Clyde alternará entre perseguir a Pac-Man y huir de él.</p>
            <p>Colocados en las cuatro esquinas del 
            laberinto hay grandes "energizadores" parpadeantes o "bolas de energía". Comer estos hará que los fantasmas se vuelvan azules con 
            una expresión de vértigo y en dirección contraria. Pac-Man puede comer fantasmas azules para obtener puntos de bonificación; 
            cuando se comen, sus ojos regresan a la caja central del laberinto, donde los fantasmas se "regeneran" y reanudan su actividad 
            normal. Comer varios fantasmas azules en sucesión aumenta su valor en puntos. Después de una cierta cantidad de tiempo, los 
            fantasmas de color azul parpadearán en blanco antes de volver a su forma letal normal. Comer una cierta cantidad de puntos en 
            un nivel hará que aparezca un elemento de bonificación, generalmente en forma de fruta, debajo del cuadro central, que se puede 
            comer para obtener puntos de bonificación.</p>
            <p>El juego aumenta en dificultad a medida que avanza el jugador; los fantasmas se vuelven 
            más rápidos y el efecto de los energizantes disminuye en duración hasta el punto en que los fantasmas ya no se vuelven azules ni 
            comestibles. A los lados del laberinto hay dos "túneles warp", que permiten a Pac-Man y los fantasmas viajar al lado opuesto 
            de la pantalla. Los fantasmas se vuelven más lentos al entrar y salir de estos túneles. Los niveles se indican con el icono de 
            la fruta en la parte inferior de la pantalla. Los niveles intermedios son escenas cortas que presentan a Pac-Man y Blinky 
            en situaciones divertidas y cómicas. El juego se vuelve injugable en el nivel 256 debido a un desbordamiento de enteros que 
            afecta la memoria del juego.</p>
            <p><b>Edad recomendada:</b> Para todos los publicos.</p>
        </div>
    EOS;*/

require __DIR__.'/includes/plantillas/plantilla.php';