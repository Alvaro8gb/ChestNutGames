<?php 

namespace es\chestnut\eventos;
use es\chestnut\Aplicacion;

class BuscadorEventos{

    private static function eventoBuscado($datos){
        return isset($_GET['buscar']);
    }

    public static function gestiona(){

        $datos = &$_GET;
        
        $html = self::mostrarBuscador(); 

        if (self::eventoBuscado($datos)) {
            $html.= self::procesarBusqueda($datos);
        }

        return $html;
    }

    private static function mostrarBuscador(){

        $app = Aplicacion::getInstancia();

        $rutaimg = $app->resuelve(RUTA_IMGS.'eventos/');

        $html = <<<EOS
            <div class = "img_buscar">
                <img id="ev" src="{$rutaimg}buscar.jpg" alt="buscar">
            </div>

            <form action="null" method="get">
                <div class = "text_buscar">
                    <input class="evi" type ="text" name ="evento" value ="">
                </div>
                <div class = "button_buscar">
                    <input class="search" type="submit" name="buscar" value="buscar">
                </div>
            </form>
        EOS;

        return $html;
    }

    private static function procesarBusqueda(){

        $app = Aplicacion::getInstancia();

        $html = "";

        $eventToSearch = filter_var(trim($_GET["evento"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            // Si está vacío, lo informamos, sino realizamos la búsqueda
            if(empty($eventToSearch)){
                $html .= '<br><p>No se ha ingresado ningún evento a buscar</p>';
            }
            else {
                // Conexión a la base de datos y seleccion de registros
                $conn = $app->getConexionBd();
                $prepared = $conn->prepare("SELECT nombre FROM eventos WHERE nombre LIKE ? ");
                $prepared->execute(array("$eventToSearch"));
                $consulta = $prepared->get_result();
                $count_results = mysqli_num_rows($consulta);
        
                // Si hay resultados
                if($count_results > 0){
                    $html .= 
                    '<br><p>El evento buscado, '.$eventToSearch.', se encuentra en nuestra página web. Deslícese sobre el siguiente
                    slide colocado a continuación hasta encontrarlo.<p>';
                }
                else{
                    // Si no hay resultados
                    $html .= '<br><p>No se encuentran resultados con los criterios de búsqueda.</p>';
                }
            }

        return $html;  
    }   
}
