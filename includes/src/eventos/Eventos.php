<?php

namespace es\chestnut\eventos;
use es\chestnut\eventos\BuscadorEventos;
use es\chestnut\Aplicacion;
use es\chestnut\eventos\Temporizador;

use es\chestnut\Lista;

class Eventos extends Lista {

    private const TABLE= "eventos";

    public function __construct(){
        parent::__construct(self::TABLE);
    }

    protected function crearElem($fila){
        return new Evento($fila["IdEvento"],$fila["nombre"],$fila["imagen"],$fila["descripcion"],$fila["fechaInicio"],$fila["fechaFinal"],$fila["IdJuego"],$fila["premio"]);
    }

    protected function mostrarElem($datos){

        $html="";
        $id = filter_var(trim($datos["id"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);  
        $evento = $this->getElement($id);
        
        $temporizadorInicio = new Temporizador($evento->getFechaInicio());
        $temporizadorFin = new Temporizador($evento->getFechaFin());
        
        if($temporizadorInicio->isAlive()) {
       
            $html .= 
                '<div class = "nombreEvento">
                    <p>'.$evento->getNombre().'</p>
                 </div>';

            $html .= $temporizadorInicio->mostrarContador();

            $html .= <<< EOS
                <div class = "descripcion">
                    <p>{$evento->getDesc()}</p>
                </div>

                <div class = "premio">
                    <p>Premio: {$evento->getPremio()} $</p>
                </div>
            EOS;

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
                    $query = $conn->prepare("INSERT INTO inscripcioneseventos (IdUsuario, IdEvento) VALUES('$idUsuario', '$idEvento')");
                    $query->execute();
                    $html .= '<p>La insripción a este evento se ha realizado con éxito. Muchas gracias.</p>';
                }
                else {
                    $html .= '<p>Usted ya está inscrito a este evento.</p>';
                }
            }
        }
        else if ($temporizadorFin->isAlive()) {

            $html .= 
                '<div class = "nombreEvento">
                    <p>'.$evento->getNombre().'</p>
                </div>';

            $html .= $temporizadorFin->mostrarContador();

            $html .=' <p>El evento ya ha comenzado!</p>';
        }
        else{

            $html .= '<div class = "nombreEvento">
                <p>'.$evento->getNombre().'</p>
            </div>

            <p>Has llegado tarde! El evento ya ha terminado!</p>';
        } 
        
        return $html;
    }

    public function mostrarElems(){

        $html = <<<EOS
        <div class = "msg_centrado">
            <h3>Demuestra tu habilidad, gana dinero y muchos premios jugando los mejores torneos de la comunidad.</h3>
        </div>
        EOS;

        $buscador = new BuscadorEventos();

        $html .= $buscador->gestiona();

        $html.= '<div class="slider">';
    
            foreach($this->lista as $id => $evento ){
                $html .= '<input type="radio" id="' . $id . '" name="image-slide" hidden />';
            }

            $html .= '<div class="slideshow">';
            foreach($this->lista as $id => $evento ){
                $html .= '<div class="item-slide">
                    <a href="eventos.php?id='.$id.'"><img alt ="'.$evento->getNombre().'" src="data:image/png;base64,'.base64_encode($evento->getImagen()).'"></a>
                </div>'; 
            }
            $html .= '</div> 

            <div class="pagination">';          
            foreach($this->lista as $id => $evento ){ 
                $html .= '<label class="pag-item" for="' . $id . '">
                        <img alt ="'.$evento->getNombre().'" src="data:image/png;base64,'.base64_encode($evento->getImagen()).'"/>
                </label>';
            }
            $html .='</div>';

        $html .= '</div>';

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
}