<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

use \es\chestnut\usuarios\Usuario;

$tituloPagina = 'Ranking';
$css = link_css($app->resuelve(RUTA_CSS.'ranking.css'));

$maxNumJugadores = 5;

$juegos = new \es\chestnut\juegos\Juegos();
$nombre_juegos = array();

for($i = 0; $i<$juegos->getNumElements();$i++){
  $juego = $juegos->getElement($i);
  $nombre_juegos[$juego->getId()] = $juego->getNombre();
}
 
////Ranking por jugadores

$contenidoPrincipal = <<<EOS
<div>
   <div class = "move"> 
      <span>RANKING GLOBAL</span>
      <div class="liquid"></div>
   </div>
    <table class ="out">
      <tr>
          <th>JUGADOR</th>
          <th>PUNTUACION</th>
      </tr>
EOS;
$conn = $app->getConexionBd();
$sql = sprintf("SELECT IdJugador, sum(Puntuacion) as SumaPuntos FROM ranking GROUP BY IdJugador ORDER BY SumaPuntos desc LIMIT $maxNumJugadores ");
$consulta = @mysqli_query($conn, $sql);
while($fila = @mysqli_fetch_array($consulta)){
    $sql2 = sprintf("SELECT  nombreUsuario FROM usuarios WHERE IdUsuario = '%s'", $conn->real_escape_string($fila["IdJugador"]));
    $consulta2 = @mysqli_query($conn, $sql2);
    $fila2 = @mysqli_fetch_array($consulta2);
    $contenidoPrincipal .= <<<EOS
      <tr>
      <td>{$fila2["nombreUsuario"]}</td>
      <td>{$fila["SumaPuntos"]}</td>
      </tr>
    EOS;
}

$consulta->free();

//Ranking por juegos

$contenidoPrincipal .= <<<EOS
  </table>
  </div>
  <div class = "move"> 
    <span>RANKING POR JUEGO</span>
    <div class="liquid"></div>
  </div>  
  <div class="container">
    <ul class="slider">
EOS;

foreach($nombre_juegos as $id_juego => $nombre){

      $contenidoPrincipal .= <<<EOS
      <li id= {$id_juego}>
        <table class="has">
        <tr>     
          <th colspan = "2">{$nombre}</th>
        <tr>
          <th>JUGADOR</th>
          <th>PUNTUACION</th>
        </tr>
      EOS;

      $consulta = null;

      $sql = sprintf("SELECT IdJugador, Puntuacion FROM ranking WHERE IdJuego = '%s' ORDER BY Puntuacion desc LIMIT 10", $conn->real_escape_string($id_juego));
      $consulta = @mysqli_query($conn, $sql);
      $fila = "";
      
      while($fila = @mysqli_fetch_array($consulta)){
          $user = Usuario::buscarUsuarioPorId($fila["IdJugador"]);
          
          $contenidoPrincipal .= <<<EOS
              <tr>
              <td>{$user->getNombre()}</td>
              <td>{$fila["Puntuacion"]}</td>
              </tr>
          EOS;
      }

      $consulta->free();

      $contenidoPrincipal .= <<<EOS
        </table>
      </li>
      EOS;

    }

$contenidoPrincipal .= <<<EOS
   </ul>
   <ul class="menu">
EOS;

foreach($nombre_juegos as $id_juego => $nombre){
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
EOS;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal,'css'=> $css];
$app->generaVista('/plantillas/plantilla.php', $params);


