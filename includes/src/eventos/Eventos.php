<?php

namespace es\chestnut\eventos;
use es\chestnut\Aplicacion;
use es\chestnut\eventos\BuscadorEventos;
use es\chestnut\Lista;

class Eventos extends Lista{

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
            $buscador = new BuscadorEventos();
            $html = $buscador->gestiona();
            $html .= $this->mostrarEventos();
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
        return new Evento($fila["idEvento"],$fila["nombre"],$fila["imagen"],$fila["descripcion"],$fila["fechaInicio"],$fila["fechaFinal"],$fila["idJuego"]);
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
        
        $fechaFin = strtotime($evento->getFechaFin());
        $remainingTime = $fechaFin - time();
        
        if($remainingTime > 0) {
       
            $contador = self::contador($remainingTime);

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

            /*Comprobar si el jugador ya está inscrito. Si está inscrito el boton para inscribirse no se puede pinchar, es una mera imagen, y se muestra un mensaje que diga
            Usted ya está insrito en este evento.
            Si no está insrito y pulsa el boton, inscribirle.*/ 
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
                    <p>Premio: {$evento->getPremio()}</p>
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

            $html .= <<< EOS
                    <form action="" method="post">
                        <div class = "inscripcion">
                            <input class="inscripcion_button" type="submit" name="inscribir" value="h">
                        </div>
                    </form>
                    EOS;

            if(isset($_POST['inscribir'])){
                    $html .= '<p>Hola</p>';
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
            $html .= '<h1> El evento ya ha comenzado! </h1>';
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
                    <a href="eventos.php?id='.$id.'"><img src="data:image/png;base64,'.base64_encode($evento->getImagen()).'"/>
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

        $html .='</div>';

        return $html;
    }
}