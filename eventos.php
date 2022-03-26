<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Eventos';


if (!isset($_SESSION["login"])) {
	$contenidoPrincipal = <<<EOF
	<h1>¡Usuario no registrado!</h1>
	<p>Debes iniciar sesión para ver el contenido.</p>
EOF;
} else {

    $contenidoPrincipal = <<<EOS
        <head>
            <link rel="stylesheet" type="text/css" href="css/eventos.css"/>
        </head>
    EOS;

    $contenidoPrincipal .= <<< EOS
        <div class = "msg_centrado">
            <h4>Demuestra tu habilidad, gana dinero y muchos premios jugando los mejores torneos de la comunidad.</h4>
        </div>
        
        <div class = "img_buscar">
        <img src="img/torneosyeventos/buscar.jpg" alt="buscar">
        </div>

        <div class = "text_buscar">
        <input type ="text" name ="buscar" value ="">
        </div>

        <div class = "button_buscar">
        <button type = "button" onclick = 'href="mailto:sergilor@ucm.es"'>Buscar</button>
        </div>

        <div class = "footer_zone">
        En ChestnutGames no se admiten trampas de ningún tipo y el respeto entre jugadores es esencial. Nuestra comunidad está formada únicamente 
        por jugadores que cumplen las Reglas y actúan de forma deportiva. Nuestra plataforma integra sistemas de detección de tramposos, 
        obtención de resultados de forma automática desde los videojuegos y un equipo de profesionales. Defendemos la integridad de las 
        competiciones. Que gane el mejor! 
        </div>
    EOS;
        
}
$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);