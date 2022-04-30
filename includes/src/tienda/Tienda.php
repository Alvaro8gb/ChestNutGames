<?php

namespace es\chestnut\tienda;
use es\chestnut\Lista;
use es\chestnut\carrito\FormularioAdd2Carrito;

class Tienda extends Lista{
    private const TABLE ="tienda";

    public function __construct(){
        parent::__construct(self::TABLE);
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
            $descripcion = $producto->getDesc();
            $htmlImagen = '<a href="tienda.php?id='.$id.'"><img class="gr" src="data:image/png;base64,'.base64_encode($imagen).'" alt ="'.$alt.'"></a>';

            $html .= <<<EOS
            <div class="borde">
                <div class="img">
                    $htmlImagen
                    <p class="oculto"><b>{$descripcion}</b></p>
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

        $id_en_tienda = filter_var(trim($datos["id"]), FILTER_SANITIZE_FULL_SPECIAL_CHARS);  
        $producto = parent::getElement($id_en_tienda);

        $imagen = $producto->getImagen();
        $bs = base64_encode($imagen);
        $nombre = $producto->getNombre();
        $precio = $producto->getPrecio();
        $cantidad = $producto->getCantidad();
        $id_producto = $producto->getId();
       
        $html = '<div class="prod">
        <div class = "img_tienda">
        <img class="producto" src="data:image/png;base64,'.base64_encode($imagen). '" alt="num_imagen"/>
        </div>';

        $html .= <<< EOS
        <div class = "informacion">
            <p class="txtpr"><b>Nombre producto: </b>$nombre</p>
            <p class="txtpr"><b>Descripción: </b>{$producto->getDesc()}</p>
            <p class="txtpr"><b>Categoría: </b>{$producto->getCategoria()}</p>
        </div>
         <div class = "carrito">
                <p class="txtpr1"><b>Precio: </b> $precio €</p>
                <p class="txtpr1"><b>Unidades: </b> $cantidad </p>
        EOS;

        if($producto->getCantidad() != 0){

            $form = new FormularioAdd2Carrito($id_producto,$id_en_tienda,$cantidad,$nombre,$precio,$bs);
            $html .= $form->gestiona();

        }

        $html .=<<< EOS
            </div>
       </div> 
    EOS;

    return $html;

    }
}