<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Ranking';

$jueg = 1;

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
EOS;
    $conn = $app->conexionBd();
    $sql = "SELECT IdJuego, Imagen FROM juegos";
    $consulta = @mysqli_query($conn, $sql);
    $parar = 0;
while($parar != 1){
  if($fila = @mysqli_fetch_array($consulta)){
      $contenidoPrincipal .= <<<EOS
          <li id= {$fila["IdJuego"]}>
      EOS;
      $contenidoPrincipal .= '<img src="data:image/png;base64,'.base64_encode($fila["Imagen"]).'"/>';
      $contenidoPrincipal .= <<<EOS
          </li>
      EOS;
  }
  else{
      
      $parar = 1;
  }
} 
$parar = 0;

$contenidoPrincipal .= <<<EOS
   </ul>
   <ul class="menu">
EOS;
  $sql = "SELECT IdJuego,Nombre FROM juegos";
  $consulta = @mysqli_query($conn, $sql);
  $concat;
while($parar != 1){
  if($fila = @mysqli_fetch_array($consulta)){
    $concat = "#";
    $concat.= $fila["IdJuego"];
      $contenidoPrincipal .= <<<EOS
        <li>
        <a href= {$concat} onclick= "tabla({$fila["IdJuego"]})"> {$fila["Nombre"]}</a>
        </li>
      EOS;
  }
  else{
      
      $parar = 1;
  }
} 
$contenidoPrincipal .= <<<EOS
   </ul>
   </div>
   <h2> Jugadores</h2>
EOS;
$sql = "SELECT IdJugador, Puntuacion FROM ranking WHERE IdJuego = $jueg";
$consulta = @mysqli_query($conn, $sql);
while($consulta){
  $parar = 0;

  $contenidoPrincipal .= <<<EOS
      <table id= {$jueg}>
  EOS;
  while($parar != 1){
        if($fila = @mysqli_fetch_array($consulta)){
          $contenidoPrincipal .= <<<EOS
              <tr>
              <td>{$fila["IdJugador"]}</td>
              <td>{$fila["Puntuacion"]}</td>
              </tr>
          EOS;
          
        }
        else{
          
          $parar = 1;
        }
  }
  $contenidoPrincipal .= <<<EOS
  </table>
EOS;
  $sql = "SELECT IdJugador, Puntuacion FROM ranking WHERE IdJuego = $jueg";
  $consulta = @mysqli_query($conn, $sql);
  $jueg++;
}
$contenidoPrincipal .= <<<EOS
      </body>
  EOS;
require __DIR__.'/includes/plantillas/plantilla.php';