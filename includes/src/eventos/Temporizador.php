<?php

namespace es\chestnut\eventos;

use es\chestnut\Aplicacion;


class Temporizador {

    private $remainingTime;
    private static $ruta_imagenes;

    public function __construct($fecha){
        $this->remainingTime = strtotime($fecha) - time();
        $app = Aplicacion::getInstancia();
        self::$ruta_imagenes = $app->resuelve(RUTA_IMGS.'eventos/');
    }

    public function isAlive(){
        return $this->remainingTime > 0;
    }

    private function generate(){

        $remainingTime = $this->remainingTime;
        
        $remainingDays = floor( $remainingTime / (3600 * 24));
        $remainingTime %= (3600 * 24);

        $remainingHours = floor($remainingTime / (60 * 60));
        $remainingTime %= (60 * 60);

        $remainingMinutes = floor($remainingTime / 60);
        $remainingTime %= 60;

        $remainingSeconds = substr('0' . $remainingTime, -2);

        return array("days"=>$remainingDays,"hours" => $remainingHours , "mins"=>$remainingMinutes, "segs"=>$remainingSeconds);

    }
    public function mostrarContador(){

        $path = self::$ruta_imagenes;

        $time = $this->generate();
        $html = <<<EOS
            <div class = "temporizador">
                <div class = "bloque">
                    <div class = "dias"> {$time["days"]}</div>
                    <p>DÍAS</p>
                </div>
                <div class = "bloque">
                    <div class = "horas">{$time["hours"]} </div>
                    <p>HORAS</p>
                </div>
                <div class = "bloque">
                    <div class = "minutos"> {$time["mins"]} </div>
                    <p>MINUTOS</p>
                </div>
                <div class = "bloque">
                    <div class = "segundos"> {$time["segs"]} </div>
                    <p>SEGUNDOS</p>
                </div>
            </div>

            <div class = "informacion">
                    <img id="ev" src="{$path}info.png">
                    <p>Para actualizar el temporizador es necesario refrescar la página.</p>
            </div>
        EOS;

        return $html;
    }
}