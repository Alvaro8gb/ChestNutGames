<?php

namespace es\chestnut\juegos;
use es\chestnut\Aplicacion;
use es\chestnut\Lista;

class Juegos extends Lista{
    private static $ruta_imagenes;
    private const TABLE ="Juegos";

    public function __construct(){
        parent::__construct(self::TABLE);
        $app = Aplicacion::getInstancia();
        self::$ruta_imagenes = $app->resuelve(RUTA_IMGS.'juegos/');
    }

    protected function crearElem($fila){
        return new Juego($fila["IdJuego"],$fila["Nombre"],$fila["Imagen"],$fila["Descripcion"],$fila["Categoria"],$fila["Enlace"]);
    }
    public function gestiona(){

        $datos = &$_GET;
        
        if (!$this->juegoEnviado($datos)) {
            return $this->mostrarJuegos();
        }
        else{
            return $this->mostrarJuego($datos);
        }

    }

    private function juegoEnviado($datos){
        return isset($datos['id']);
    }

    private function mostrarJuegos(){
        $path = self::$ruta_imagenes;
        $html = "<img class='gif_centrado' src='{$path}play.gif' alt='Gif'>"; 
        $i = 0;
        
        foreach($this->lista as $id => $juego){

            $imagen = $juego->getImagen();
            $alt = "imagen_".$juego->getNombre();
            $htmlImagen = '<a href="juegos.php?id='.$id.'"><img class="juego" src="data:image/png;base64,'.base64_encode($imagen).'" alt ="'.$alt.'"></a>';

            if ($i % 5 == 0){
                $html.= <<<EOS
                    <div class="fila">
                EOS;
            }

            $html .= <<<EOS
                <div class="columna">
                    $htmlImagen
                </div>
            EOS;

            if($i%5 == 4){
                $html .= <<<EOS
                    </div>
                EOS;
            }
            
            $i++;    

        }

        if ($i%5 != 4){
            $html .= <<<EOS
            </div>
            EOS;
        }


        return $html;
    }

    private function mostrarJuego($datos){

        $ruta_imagenes = self::$ruta_imagenes;
        $id_juego = filter_var(trim($datos["id"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);  
        $juego = parent::getElement($id_juego);
       
        $html = '<div class = "img_juego">
        <img class="juego" src="data:image/png;base64,'.base64_encode($juego->getImagen()).'"/>
        </div>';

        $html .= <<< EOS
        <div class = "boton_exit">
            <a href="juegos.php"><img src="{$ruta_imagenes}exit.png" alt="Exit"></a>
        </div>
        <div class = "boton_play_now">
            <a href="{$juego->getEnlace()}"><img src="{$ruta_imagenes}play.png" alt="Play Now"></a>
        </div>
        <div class = "boton_ranking">
            <a href="ranking.php#{$juego->getId()}"><img src="{$ruta_imagenes}ranking.png" alt="Ranking"></a>
        </div>
        <div class = "informacion">
            <p><b>Título: </b>{$juego->getNombre()}</p>
            <p><b>Categoría: </b>{$juego->getCategoria()}</p>
            <p><b>Descripción: </b>{$juego->getDesc()}</p>
        </div>
    EOS;

    return $html;

    }

}