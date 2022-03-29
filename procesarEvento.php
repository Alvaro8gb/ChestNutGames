<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$ruta = RUTA_CSS.'procesarEvento.css';
$rutaimg = RUTA_IMGS.'eventos/';

$tituloPagina = 'Procesar Evento';

$log_info = check_log_in();

if(empty($log_info)){

    $contenidoPrincipal = <<<EOS
    <head>
        <link rel="stylesheet" type="text/css" href={$ruta}>
    </head>
    EOS;

    $conn = $app->getConexionBd();
    $sql = "SELECT * FROM eventos WHERE idEvento = $_GET[id]";
    $consulta = @mysqli_query($conn, $sql);
    $fila = @mysqli_fetch_array($consulta);

    // Epoch timestamp
    $waiting_day = 1649120580;

    $remainingTime = $waiting_day - time();

    $remainingDays = floor($remainingTime / (3600 * 24));
    $remainingTime %= (3600 * 24);

    $remainingHours = floor($remainingTime / (60 * 60));
    $remainingTime %= (60 * 60);

    $remainingMinutes = floor($remainingTime / 60);
    $remainingTime %= 60;

    $remainingSeconds = substr('0' . $remainingTime, -2);

    if($remainingTime > 0) {

        $contenidoPrincipal .= 
            '<div class = "nombreEvento">
                <p>'.$fila["nombre"].'</p>
            </div>
            
            <div class = "temporizador">
        
                <div class = "bloque">
                    <div class = "dias">'. $remainingDays .'</div>
                    <p>DÍAS</p>
                </div>
                <div class = "bloque">
                    <div class = "horas">'. $remainingHours .'</div>
                    <p>HORAS</p>
                </div>
                <div class = "bloque">
                    <div class = "minutos">'. $remainingMinutes .'</div>
                    <p>MINUTOS</p>
                </div>
                <div class = "bloque">
                    <div class = "segundos">'. $remainingSeconds .'</div>
                    <p>SEGUNDOS</p>
                </div>
            </div>';

        /*Comprobar si el jugador ya está inscrito. Si está inscrito el boton para inscribirse no se puede pinchar, es una mera imagen, y se muestra un mensaje que diga
        Usted ya está insrito en este evento.
        Si no está insrito y pulsa el boton, inscribirle.*/ 

        $contenidoPrincipal .= <<< EOS
            <div class = "informacion">
                <img id="ev" src="{$rutaimg}info.png">
                <p>Para actualizar el temporizador es necesario refrescar la página.</p>
            </div>

            <div class = "descripcion">
                <p>$fila[descripcion]</p>
            </div>

            <div class = "premio">
                <p>Premio: $fila[premio]$</p>
            </div>

            <div class = "inscripcion">
                <img id="ev" src= "{$rutaimg}inscripcion.png">
            </div>
        EOS;

         $contenidoPrincipal .= 
            '<div class = "fondoTransparente">
                <img src="data:image/png;base64,'.base64_encode($fila["imagen"]).'"/>
            </div>';

    }
    else{
        $contenidoPrincipal .= '<h1>El evento ya ha comenzado!</h1>';
    }    
}
else{
    $contenidoPrincipal = $log_info;
}
        
$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);