<?php

namespace es\chestnut\carrito;

class Carrito {

    private $carrito;

    public function __construct($carrito) {
        $this->carrito = $carrito;
    }
    public function mostrarCarrito(){
        $html = <<<EOS
        <div class="titular">
            Artículos en la cesta
        </div>
        EOS;


        $html .= <<<EOS
        <div class="grid">
            <table>
                <thead>
                    <tr>
                        <th class="tamanyo">PRODUCTO</th>
                        <th class="tamanyo">CANTIDAD</th>
                        <th class="tamanyo">PRECIO</th>
                        <th class="tamanyo">ACCIÓN</th>
                    </tr>
                </thead>
        EOS;

        $precio_acumulado=0;
        $precio_acumulado = 0;

        foreach($this->carrito as $idElemCarrito => $elemCarrito){
            
                $nombre = $elemCarrito->getNombre();
                $cantidad = $elemCarrito->getCantidad();
                $precio = $elemCarrito->getPrecio();
                $id = $elemCarrito->getId();
                $precio_acumulado+= $precio;
                $alt = "imagen_".$nombre;
                $imagen = $elemCarrito->getImagen();

                $htmlImagen = '<a href="tienda.php?id='.$id.'"><img class="cesta_img" src="data:image/png;base64,'.$imagen.'" alt ="'.$alt.'"></a>'; 
                $formElimnarItem = new FormularioRemove2Carrito($idElemCarrito,$cantidad);
                $htmlFormRemoveItem = $formElimnarItem->gestiona();

                $html .= <<<EOS
                
                <div class="cesta">
                    <tr>
                        <td>
                            <div class=producto>
                                $htmlImagen
                            </div>
                            <p class="text">$nombre</p>
                        </td>
                        <td class="tamanyo">$cantidad</td>
                        <td class="tamanyo"> $precio €</td>
                        <td>
                            $htmlFormRemoveItem
                        </td>
                    </tr>
                </div>
                EOS;
        }

        $html .= <<<EOS
                
        
        </table>
                </div>
                <div class="total">
                    <p class="text">Precio total: {$precio_acumulado} </p>
        EOS;

        if($precio_acumulado!=0){
            $html .= <<<EOS
                        <form action="Compras.php" method="POST">
                            <div class="car">
                                <input class="anyadir_carrito" type="submit" value="Tramitar Pedido">
                            </div>
                        </form>
        EOS;
        }

        $html .= <<<EOS
            </div>
        EOS;
        
        return $html;
    }

}