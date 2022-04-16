<?php

namespace es\chestnut\eventos;

class Temporizador {

    private $remainingTime;

    public function __construct($fecha){
        $this->remainingTime = strtotime($fecha) - time();
        
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
        EOS;

        return $html;
    }
}