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
        <link rel="stylesheet" type="text/css" href="css/slider.css" />
<body>
<h2> Juegos </h2>
<div class="container">
  <ul class="slider">
EOS;



    foreach($juegos as $id_juego => $nombre){

      $sql = sprintf("SELECT Imagen FROM juegos WHERE IdJuego = '%s'", $conn->real_escape_string($id_juego));
      $consulta = @mysqli_query($conn, $sql);
      $fila = @mysqli_fetch_array($consulta);

      if ( $consulta->num_rows == 0 ) {
        exit("tabla juegos sin imagenes");
      }

      $contenidoPrincipal .= <<<EOS
      <li id= {$id_juego}>
      EOS;
      $contenidoPrincipal .= '<a href="procesarJuego.php?id='.$id_juego.'"><img src="data:image/png;base64,'.base64_encode($fila["Imagen"]).'"/>';
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
   <h2> Jugadores</h2>
EOS;

/*
$sql = sprintf("SELECT IdJugador, Puntuacion FROM ranking WHERE IdJuego = '%s'", $conn->real_escape_string($jueg));
$consulta = @mysqli_query($conn, $sql);

$contenidoPrincipal .= <<<EOS
        <table id= {$jueg}> 
    EOS;
    while($fila = @mysqli_fetch_array($consulta)){
            $contenidoPrincipal .= <<<EOS
                <tr>
                <td>{$fila["IdJugador"]}</td>
                <td>{$fila["Puntuacion"]}</td>
                </tr>
            EOS;
            
    }
    
    $contenidoPrincipal .= <<<EOS
    </table>
  EOS;

$contenidoPrincipal .= <<<EOS
      </body>
  EOS;

  */

require __DIR__.'/includes/plantillas/plantilla.php';