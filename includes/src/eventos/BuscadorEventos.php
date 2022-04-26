<?php 

namespace es\chestnut\eventos;
use es\chestnut\Aplicacion;

class BuscadorEventos{

    private $eventos;

    public function __construct($eventos){
        $this->eventos = $eventos;
    }

    private function eventoBuscado($datos){
        return isset($_GET['buscar']);
    }

    public function gestiona(){

        $datos = &$_GET;
        
        $html = self::mostrarBuscador(); 

        if (self::eventoBuscado($datos)) {
            $html.= self::procesarBusqueda($datos);
        }

        return $html;
    }

    private function mostrarBuscador(){

        $app = Aplicacion::getInstancia();

        $rutaimg = $app->resuelve(RUTA_IMGS.'eventos/');

        $html = <<<EOS
            <div class = "img_buscar">
                <img id="ev" src="{$rutaimg}buscar.jpg" alt="buscar">
            </div>

            <form method="get">
                <div class = "text_buscar">
                    <input class="evi" type ="text" maxlength="30" name ="evento" value ="">
                </div>
                <div class = "button_buscar">
                    <input class="search" type="submit" name="buscar" value="buscar">
                </div>
            </form>
        EOS;

        return $html;
    }

    private function procesarBusqueda(){

        $app = Aplicacion::getInstancia();

        $html = "";

        $eventToSearch = filter_var(trim($_GET["evento"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            // Si está vacío, lo informamos, sino realizamos la búsqueda
            if(empty($eventToSearch)){
                $html .= '<br><p>No se ha ingresado ningún evento a buscar</p>';
            }
            else {
                
                $encontrado = false;
                $i = 0;
                while(!$encontrado && $i < $this->eventos->getNumElements() ){
                    $evento  = $this->eventos->getElement($i);
                    $nombreEvento = $evento->getNombre();

                    if(preg_match("/$nombreEvento/i",$eventToSearch)){
                        $encontrado = true;
                    }else{
                        $i++;
                    }
                }
        
                if($encontrado){
                    $id = $i;
                    $app->redirige("eventos.php?id=$id");
                }
                else{
                    $html .= '<br><p>No se encuentran resultados con los criterios de búsqueda.</p>';
                }
            }

        return $html;  
    }   
}
