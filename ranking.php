<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Ranking';

$juegos = array();

$conn = $app->conexionBd();
$sql = "SELECT IdJuego, nombre FROM juegos";
$consulta = @mysqli_query($conn, $sql);


while($fila = @mysqli_fetch_array($consulta)){
  $juegos[$fila["IdJuego"]] = $fila["nombre"];
}

$contenidoPrincipal = <<<EOS
<head>
        <link rel="stylesheet" type="text/css" href="css/ranking.css" />
</head>
<body>
<div>
   <h1> RANKING GLOBAL </h1>
    <table>
      <tr>
      <th>JUGADOR</th>
      <th>PUNTUACION</th>
      </tr>
EOS;
$sql = sprintf("SELECT IdJugador, Puntuacion FROM ranking GROUP BY IdJugador");
  $consulta = @mysqli_query($conn, $sql);

  while($fila = @mysqli_fetch_array($consulta)){
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
$contenidoPrincipal .= <<<EOS
</table>
</div>
<h1> Ranking por Juego </h1>   
<div class="container">
  <ul class="slider">
EOS;



    foreach($juegos as $id_juego => $nombre){

      $sql = sprintf("SELECT IdJugador, Puntuacion FROM ranking WHERE IdJuego = '%s'", $conn->real_escape_string($id_juego));
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
      
       while($fila = @mysqli_fetch_array($consulta)){
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


require __DIR__.'/includes/plantillas/plantilla.php';