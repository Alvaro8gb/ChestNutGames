<?php

namespace es\chestnut\juegos;
use es\chestnut\Aplicacion;
use Exception;

class Juegos{
    private static $list_juegos ;
    private static $ruta_imagenes;

    public function __construct(){
        self::$list_juegos = array();
        self::cargarJuegos();
        $app = Aplicacion::getInstancia();
        self::$ruta_imagenes = $app->resuelve(RUTA_IMGS.'juegos/');

    }

    private static function juegoEnviado($datos){
        return isset($datos['id']);
    }
    public static function gestiona(){

        $datos = &$_GET;
        
        if (!self::juegoEnviado($datos)) {
            return self::mostrarJuegos();
        }
        else{
            return self::mostrarJuego($datos);
        }

    }

    private static function comprobarInicializada(){
        if( count(self::$list_juegos)>0){
            exit();
        }
    }
    
    private static function cargarJuegos(){

        self::comprobarInicializada();
        $app = Aplicacion::getInstancia();
        $conn = $app->getConexionBd();
        $sql = "SELECT * FROM juegos";
        $conn = @mysqli_query($conn, $sql);
        $i = 0;
        while($fila = @mysqli_fetch_array($conn)){
            $juego = new Juego($fila["IdJuego"],$fila["Nombre"],$fila["Imagen"],$fila["Descripcion"],$fila["Categoria"],$fila["Enlace"]);
            self::$list_juegos = array_merge(self::$list_juegos, array( $i=> $juego));
            $i++;
        }
        $conn->free();
        
    }

    public static function getJuego($id){

        if ($id < 0 || $id > count(self::$list_juegos) ){
            throw new Exception("No ids for this game");
        }
        return self::$list_juegos[$id];

    }

    public static function mostrarJuegos(){
        $path = self::$ruta_imagenes;
        $html = "<img class='gif_centrado' src='{$path}play.gif' alt='Gif'>"; 
        $i = 0;
        
        foreach(self::$list_juegos as $id => $juego){

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

    public static function mostrarJuego($datos){

        $ruta_imagenes = self::$ruta_imagenes;
        $id_juego = filter_var(trim($datos["id"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);  
        $juego = self::getJuego($id_juego);

        $html = "";
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