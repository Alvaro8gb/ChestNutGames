<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Ranking';

$contenidoPrincipal = <<<EOS
<head>
		<link rel="stylesheet" type="text/css" href="css/estilos.css" />
        <link rel="stylesheet" type="text/css" href="css/slider.css" />
		<link rel="icon" href="img/logo/Favicon.png" type="image/png">
	</head>
<body>
<h2> Juegos </h2>
<div class="container">
  
  <ul class="slider">
    <li id="slide1">
      <img src="img/members/sergi.png"/>
    </li>
    <li id="slide2">
      <img src="img/members/sergi.png"/>
    </li>
    <li id="slide3">
      <h1>Ejemplo con otros elementos</h1>
      <p>Esto es un párrafo de ejemplo para comprobar que podemos meter cualquier tipo de elementos en el slider</p>
      <a href="https://kikopalomares.com/">¡Corre a mi web para más contenido!</a>
    </li>
  </ul>
  
  <ul class="menu">
    <li>
      <a href="#slide1">1</a>
    </li>
    <li>
      <a href="#slide2">2</a>
    </li>
     <li>
      <a href="#slide3">3</a>
    </li>
  </ul>
  
</div>
<h2> Jugadores</h2>
    <table>
    </table>
</body>



EOS;

require __DIR__.'/includes/plantillas/plantilla.php';