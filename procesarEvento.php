<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$ruta = RUTA_CSS.'procesarEvento.css';
$rutaimg = RUTA_IMGS.'eventos/';

$tituloPagina = 'Procesar Evento';

$app->verificaLogado($app->buildUrl("noLogeado.php"));

$contenidoPrincipal = <<<EOS
<head>
    <link rel="stylesheet" type="text/css" href={$ruta}>
</head>
EOS;

$conn = $app->getConexionBd();
$prepared = $conn->prepare("SELECT * FROM eventos WHERE idEvento = ?");
$idEvento = filter_var(trim($_GET["id"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$prepared->bind_param('i',$idEvento);

$prepared->execute();
$consulta = $prepared->get_result();

$fila = @mysqli_fetch_array($consulta);

$consulta->free();

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
    EOS;

    /*$idUsuario = $app->idUsuario();

    $prepared = $conn->prepare("SELECT * FROM inscripcioneseventos WHERE (idEvento = $idEvento AND idUsuario = $idUsuario)");
    $prepared->execute();
    $consulta = $prepared->get_result();
    $count_results = mysqli_num_rows($consulta);
    $consulta->free();

    if($count_results < 0){
        $contenidoPrincipal .= <<< EOS
            <div class = "inscripcion">
                <img id="ev" src= "{$rutaimg}inscripcion.png">
            </div>
        EOS;
    }
    else {

        $contenidoPrincipal .= <<< EOS
            <form action="" method="get">
                <div class = "inscripcion">
                    <input class="inscripcion_button" type="submit" name="inscribir" value="Inscríbete aquí">
                </div>
            </form>
            EOS;

        if(isset($_GET['buscar'])){
            $contenidoPrincipal .= '<p>Hola</p>';
        }

        // Insertar en la base de datos
        //$query=sprintf("INSERT INTO inscripcioneseventos(idUsuario, idEvento) VALUES($idUsuario, $idEvento)");
    }*/ 

    $contenidoPrincipal .= <<< EOS
            <form action="" method="post">
                <div class = "inscripcion">
                    <input class="inscripcion_button" type="submit" name="inscribir" value="h">
                </div>
            </form>
            EOS;

    if(isset($_POST['inscribir'])){

            $contenidoPrincipal .= '<p>Hola</p>';
        }

    /*$contenidoPrincipal .= <<<EOS
        <div class = "inscripcion">
            <img id="ev" src= "{$rutaimg}inscripcion.png">
        </div>
    EOS;*/

    /*$contenidoPrincipal .= 
        '<div class = "fondoTransparente">
            <img src="data:image/png;base64,'.base64_encode($fila["imagen"]).'"/>
        </div>';*/
}
else{
    $contenidoPrincipal .= '<h1>El evento ya ha comenzado!</h1>';
}    

        
$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);