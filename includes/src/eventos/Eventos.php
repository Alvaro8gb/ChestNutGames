<?php

namespace es\chestnut\eventos;
use es\chestnut\Aplicacion;
use Exception;

class Eventos{
    private static $list_eventos ;


    public function __construct(){
        self::$list_eventos = array();
        self::cargarEventos();
    }

    private static function comprobarInicializada(){
        if( count(self::$list_eventos)>0){
            exit();
        }
    }
    
    private static function cargarEventos(){

        self::comprobarInicializada();
        $app = Aplicacion::getInstancia();
        $conn = $app->getConexionBd();
        $sql = "SELECT * FROM eventos";
        $conn = @mysqli_query($conn, $sql);
        $i = 0;
        while($fila = @mysqli_fetch_array($conn)){
            $juego = new Evento($fila["idEvento"],$fila["nombre"],$fila["imagen"],$fila["descripcion"],$fila["fechaInicio"],$fila["fechaFinal"],$fila["idJuego"]);
            self::$list_eventos = array_merge(self::$list_eventos, array( $i=> $juego));
            $i++;
        }
        $conn->free();
        
    }

    public static function getEvento($id){

        if ($id < 0 || $id > count(self::$list_eventos) ){
            throw new Exception("No ids for this event");
        }
        return self::$list_eventos[$id];

    }

    public static function mostrarEventos(){

        $html = '<div class="slider">';
    
        foreach(self::$list_eventos as $id => $evento ){
            $html .= '<input type="radio" id="' . $id . '" name="image-slide" hidden />';
        }
        $html .= '<div class="slideshow">';

        foreach(self::$list_eventos  as $id => $evento ){
            $html .= 
                '<div class="item-slide">
                <a href="procesarEvento.php?id='.$id.'"><img src="data:image/png;base64,'.base64_encode($evento->getImagen()).'"/>
                </div>'; 
        }
        $html .= 
            '</div>
            <div class="pagination">';
        foreach(self::$list_eventos  as $id => $evento ){ 
            $html .=
                '<label class="pag-item" for="' . $id . '">
                    <img src="data:image/png;base64,'.base64_encode($evento->getImagen()).'"/>
                </label>';
        }
        $html .='</div> </div>';

        return $html;
    }

}