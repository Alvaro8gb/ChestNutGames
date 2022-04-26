<?php

namespace es\chestnut\tienda;
use es\chestnut\Lista;
use es\chestnut\Aplicacion;

class Tienda extends Lista{
    private const TABLE ="tienda";
    private static $ruta_imagenes;

    public function __construct(){
        parent::__construct(self::TABLE);
        $app = Aplicacion::getInstancia();
        self::$ruta_imagenes = $app->resuelve(RUTA_IMGS.'tienda/');
    }

    protected function crearElem($fila){
        return new Producto($fila["IdProducto"],$fila["nombre"],$fila["descripcion"],$fila["categoria"],$fila["precio"],$fila["imagen"],$fila["cantidad"]);
    }

    protected function mostrarElems(){
        $html = <<<EOS
        <div class="titular">
            Disfruta de los mejores productos que ofrece esta maravillosa tienda
        </div>
        EOS;


        $html .= <<<EOS
        <div class="grid">
        EOS;
        
        foreach($this->lista as $id => $producto){

            $imagen = $producto->getImagen();
            $alt = "imagen_".$producto->getNombre();
            $nombre = $producto->getNombre();
            $precio = $producto->getPrecio();
            $htmlImagen = '<a href="tienda.php?id='.$id.'"><img class="gr" src="data:image/png;base64,'.base64_encode($imagen).'" alt ="'.$alt.'"></a>';

            $html .= <<<EOS
            <div class="borde">
                <div class="img">
                    $htmlImagen
                </div>
                <p class="text"><b></b>{$nombre}</p>
                <p class="text"><b>Precio:  </b>{$precio}€</p>
            EOS;
            
            if($producto->getCantidad() <= 10 && $producto->getCantidad() > 0){
                $html .= <<<EOS
                
                    <p class="ultimas"><b>Últimas unidades: </b>{$producto->getCantidad()}</p>

                EOS;
            }

            if($producto->getCantidad() == 0){
                $html .= <<<EOS
                
                    <p class="ninguna"><b>Producto agotado</b></p>

                EOS;
            }


            $html .= <<<EOS
            </div>
            EOS;

        }

        $html .= <<<EOS
        </div>
        EOS;
        
        return $html;
    }

    protected function mostrarElem($datos){

        $path = self::$ruta_imagenes;
        $htmlimagen = "<img class='carrito_centrado' src='{$path}carrito.png' alt='Gif'>"; 
        $id_tienda = filter_var(trim($datos["id"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);  
        $tienda = parent::getElement($id_tienda);
       
        $html = '<div class="prod">
        <div class = "img_tienda">
        <img class="producto" src="data:image/png;base64,'.base64_encode($tienda->getImagen()).'"/>
        </div>';

        $html .= <<< EOS
        <div class = "informacion">
            <p class="txtpr"><b>Título: </b>{$tienda->getNombre()}</p>
            <p class="txtpr"><b>Descripción: </b>{$tienda->getDesc()}</p>
            <p class="txtpr"><b>Categoría: </b>{$tienda->getCategoria()}</p>
        </div>
        
        <form action="" method="post">
            <div class = "carrito">
                <p class="txtpr1"><b>Precio: </b>{$tienda->getPrecio()}€</p>
                <p class="txtpr1"><b>Unidades: </b>{$tienda->getCantidad()}</p>
                <p class="txtpr1"><b>Cantidad a comprar:</b></p>
                <input class="evi" type ="text" maxlength="15" name ="evento" value ="">
                <div class="car">
                <button class="anyadir_carrito" type="submit" name="carrito">Añadir al carrito {$htmlimagen}</button>
                </div>
            </div>
        </form>
       </div> 
    EOS;

    return $html;

    }
}