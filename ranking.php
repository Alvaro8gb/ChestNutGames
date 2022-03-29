<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Ranking';

$juegos = array();

$conn = $app->getConexionBd();
$sql = "SELECT IdJuego, nombre FROM juegos";
$consulta = @mysqli_query($conn, $sql);

while($fila = @mysqli_fetch_array($consulta)){
  $juegos[$fila["IdJuego"]] = $fila["nombre"];
}

$ruta = RUTA_CSS.'ranking.css';

$contenidoPrincipal = <<<EOS
<head>
        <link rel="stylesheet" type="text/css" href={$ruta}>
</head>
<body>
<div>
   <h1 class = "move"> 
   <span>RANKING GLOBAL</span>
   <div class="liquid"></div>
   </h1>
    <table>
      <tr>
      <th>JUGADOR</th>
      <th>PUNTUACION</th>
      </tr>
EOS;
$sql = sprintf("SELECT IdJugador, sum(Puntuacion) as SumaPuntos FROM ranking GROUP BY IdJugador ORDER BY SumaPuntos desc");
  $consulta = @mysqli_query($conn, $sql);
  $i = 1;
  while($i <= 5){
    if($fila = @mysqli_fetch_array($consulta)){
      $sql2 = sprintf("SELECT  nombreUsuario FROM usuarios WHERE id = '%s'", $conn->real_escape_string($fila["IdJugador"]));
      $consulta2 = @mysqli_query($conn, $sql2);
      $fila2 = @mysqli_fetch_array($consulta2);
      $contenidoPrincipal .= <<<EOS
        <tr>
        <td>{$fila2["nombreUsuario"]}</td>
        <td>{$fila["SumaPuntos"]}</td>
        </tr>
      EOS;
    }
    $i++;
  }
  $consulta->free();
$contenidoPrincipal .= <<<EOS
</table>
</div>
<h1 class = "move"> 
   <span>RANKING POR JUEGO</span>
   <div class="liquid"></div>
   </h1>  
<div class="container">
  <ul class="slider">
EOS;

    foreach($juegos as $id_juego => $nombre){

      $sql = sprintf("SELECT IdJugador, Puntuacion FROM ranking WHERE IdJuego = '%s' ORDER BY Puntuacion desc", $conn->real_escape_string($id_juego));
      $consulta = @mysqli_query($conn, $sql);

      $contenidoPrincipal .= <<<EOS
      <li id= {$id_juego}>
        <table>
        <tr>
          <th id ="nombreJuegoRanking" colspan = "2">{$nombre}</th>
        <tr>
          <th>JUGADOR</th>
          <th>PUNTUACION</th>
          </tr>
      EOS;
      $j = 1;
      while($j <= 5){
        if($fila = @mysqli_fetch_array($consulta)){
          $sql2 = sprintf("SELECT  nombreUsuario FROM usuarios WHERE id = '%s'", $conn->real_escape_string($fila["IdJugador"]));
          $consulta2 = @mysqli_query($conn, $sql2);
          $fila2 = @mysqli_fetch_array($consulta2);
          $contenidoPrincipal .= <<<EOS
              <tr>
              <td>{$fila2["nombreUsuario"]}</td>
              <td>{$fila["Puntuacion"]}</td>
              </tr>
          EOS;
        }
      $j++;
      }
      $consulta2->free();
      $contenidoPrincipal .= <<<EOS
        </table>
      </li>
      EOS;
      $contenidoPrincipal .= <<<EOS
      </li>
      EOS;

    }

$contenidoPrincipal .= <<<EOS
   </ul>
   <ul class="menu">
EOS;

  foreach($juegos as $id_juego => $nombre){
      $concat = "#";
      $concat.= $id_juego;

      $contenidoPrincipal .= <<<EOS
          <li>
          <a href= {$concat} onclick= "tabla({$id_juego})"> $nombre</a>
          </li>
        EOS;
    }
  
$contenidoPrincipal .= <<<EOS
   </ul>
   </div>
   </body>
EOS;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);