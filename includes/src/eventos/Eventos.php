<?php

namespace es\chestnut\eventos;
use es\chestnut\Aplicacion;
use es\chestnut\eventos\BuscadorEventos;
use es\chestnut\Lista;

class Eventos extends Lista {

    private static $ruta_imagenes;
    private const TABLE= "eventos";

    public function __construct(){
        parent::__construct(self::TABLE);
        $app = Aplicacion::getInstancia();
        self::$ruta_imagenes = $app->resuelve(RUTA_IMGS.'eventos/');
    }

    public function gestiona(){
       
        $datos = &$_GET;

        if (!$this->eventoEnviado($datos)) {

            $html = <<<EOS
                <div class = "msg_centrado">
                    <h3>Demuestra tu habilidad, gana dinero y muchos premios jugando los mejores torneos de la comunidad.</h3>
                </div>
            EOS;

            $buscador = new BuscadorEventos();

            $html .= $buscador->gestiona();

            $html .= $this->mostrarEventos();

            $html .= <<< EOS
                <div class = "footer_zone">
                En ChestnutGames no se admiten trampas de ningún tipo y el respeto entre jugadores es esencial. Nuestra comunidad está formada únicamente 
                por jugadores que cumplen las Reglas y actúan de forma deportiva. Nuestra plataforma integra sistemas de detección de tramposos, 
                obtención de resultados de forma automática desde los videojuegos y un equipo de profesionales. Defendemos la integridad de las 
                competiciones. !Que gane el mejor! 
                </div>
            EOS;

            return $html;
        }
        else{

            return $this->mostrarEvento($datos);
        }
    }

    private function eventoEnviado($datos){
        return isset($datos["id"]);
    }

    protected function crearElem($fila){
        return new Evento($fila["IdEvento"],$fila["nombre"],$fila["imagen"],$fila["descripcion"],$fila["fechaInicio"],$fila["fechaFinal"],$fila["idJuego"],$fila["premio"]);
    }

    private static function contador($remainingTime){

        $remainingDays = floor($remainingTime / (3600 * 24));
        $remainingTime %= (3600 * 24);

        $remainingHours = floor($remainingTime / (60 * 60));
        $remainingTime %= (60 * 60);

        $remainingMinutes = floor($remainingTime / 60);
        $remainingTime %= 60;

        $remainingSeconds = substr('0' . $remainingTime, -2);

        return array("days"=>$remainingDays,"hours" => $remainingHours , "mins"=>$remainingMinutes, "segs"=>$remainingSeconds);

    }

    private function mostrarEvento($datos){

        $id = filter_var(trim($datos["id"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);  
        $evento = $this->getElement($id);

        $html = "";

        // Epoch timestamp
        /*
        $remainingTimeToStart = $evento->getFechaInicio() - time();
        $remainingTimeToFinish = $evento->getFechaFin() - time();
        */
        
        $remainingTimeToFinish = 2;
        $remainingTimeToStart = 1;

        if($remainingTimeToStart > 0) {
       
            $contador = self::contador($remainingTimeToStart);

            $html .= 
                '<div class = "nombreEvento">
                    <p>'.$evento->getNombre().'</p>
                </div>
                
                <div class = "temporizador">
            
                    <div class = "bloque">
                        <div class = "dias">'. $contador["days"] .'</div>
                        <p>DÍAS</p>
                    </div>
                    <div class = "bloque">
                        <div class = "horas">'. $contador["hours"] .'</div>
                        <p>HORAS</p>
                    </div>
                    <div class = "bloque">
                        <div class = "minutos">'. $contador["mins"] .'</div>
                        <p>MINUTOS</p>
                    </div>
                    <div class = "bloque">
                        <div class = "segundos">'. $contador["segs"] .'</div>
                        <p>SEGUNDOS</p>
                    </div>
                </div>';

            $path = self::$ruta_imagenes;

            $html .= <<< EOS
                <div class = "informacion">
                    <img id="ev" src="{$path}info.png">
                    <p>Para actualizar el temporizador es necesario refrescar la página.</p>
                </div>

                <div class = "descripcion">
                    <p>{$evento->getDesc()}</p>
                </div>

                <div class = "premio">
                    <p>Premio: {$evento->getPremio()}$</p>
                </div>
            EOS;

            // No se está cogiendo el id del Usuario
            $app = Aplicacion::getInstancia();
            $idUsuario = $app->idUsuario();

            $idEvento = $evento->getId();

            $conn = $app->getConexionBd();
            $prepared = $conn->prepare("SELECT * FROM inscripcioneseventos WHERE IdEvento = '$idEvento' AND IdUsuario = '$idUsuario'");
            $prepared->execute();
            $consulta = $prepared->get_result();
            $count_results = mysqli_num_rows($consulta);
            $consulta->free();

            $html .= <<< EOS
                    <form action="" method="post">
                        <div class = "inscripcion">
                            <input class="inscripcion_button" type="submit" name="inscribir" value="Inscríbete aquí">
                        </div>
                    </form>
            EOS;

            if(isset($_POST['inscribir'])){
                if($count_results <= 0){
                    // Insertar en la base de datos
                    $query=sprintf("INSERT INTO inscripcioneseventos(IdUsuario, IdEvento) VALUES($idUsuario, $idEvento)");
                    $html .= '<p>La insripción a este evento se ha realizado con éxito. Muchas gracias.</p>';
                }
                else {
                    $html .= '<p>Usted ya está inscrito a este evento.</p>';
                }
            }
        }
        else if ($remainingTimeToFinish > 0) {

            $contador = self::contador($remainingTimeToFinish);

            $html .= 
                '<div class = "nombreEvento">
                    <p>'.$evento->getNombre().'</p>
                </div>
                
                <div class = "temporizador">
            
                    <div class = "bloque">
                        <div class = "dias">'. $contador["days"] .'</div>
                        <p>DÍAS</p>
                    </div>
                    <div class = "bloque">
                        <div class = "horas">'. $contador["hours"] .'</div>
                        <p>HORAS</p>
                    </div>
                    <div class = "bloque">
                        <div class = "minutos">'. $contador["mins"] .'</div>
                        <p>MINUTOS</p>
                    </div>
                    <div class = "bloque">
                        <div class = "segundos">'. $contador["segs"] .'</div>
                        <p>SEGUNDOS</p>
                    </div>
                </div>';

            $path = self::$ruta_imagenes;
            $html .= <<< EOS
                <div class = "informacion">
                    <img id="ev" src="{$path}info.png">
                    <p>Para actualizar el temporizador es necesario refrescar la página.</p>
                </div>

                <p>El evento ya ha comenzado!</p>
            EOS;
        }
        else{

            $html .= '<div class = "nombreEvento">
                <p>'.$evento->getNombre().'</p>
            </div>

            <p>Has llegado tarde! El evento ya ha terminado!</p>';
        } 
        
        return $html;
    }

    public function mostrarEventos(){

        $html = '<div class="slider">';
    
            foreach($this->lista as $id => $evento ){
                $html .= '<input type="radio" id="' . $id . '" name="image-slide" hidden />';
            }

            $html .= '<div class="slideshow">';
            foreach($this->lista as $id => $evento ){
                $html .= '<div class="item-slide">
                    <a href="eventos.php?id='.$id.'"><img src="data:image/png;base64,'.base64_encode($evento->getImagen()).'"></a>
                </div>'; 
            }
            $html .= '</div> 

            <div class="pagination">';          
            foreach($this->lista as $id => $evento ){ 
                $html .= '<label class="pag-item" for="' . $id . '">
                        <img src="data:image/png;base64,'.base64_encode($evento->getImagen()).'"/>
                </label>';
            }
            $html .='</div>';

        $html .= '</div>';

        return $html;
    }
}