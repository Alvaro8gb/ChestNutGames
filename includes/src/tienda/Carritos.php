<?php

namespace es\chestnut\tienda;
use es\chestnut\Lista;
use es\chestnut\Aplicacion;

class Carritos extends Lista{
    private const TABLE ="compras";
    private static $ruta_imagenes;

    public function __construct(){
        parent::__construct(self::TABLE);
        $app = Aplicacion::getInstancia();
        self::$ruta_imagenes = $app->resuelve(RUTA_IMGS.'tienda/');
    }

    protected function crearElem($fila){
        return new Carrito($fila["IdUsuario"],$fila["IdProducto"],$fila["cantidad"]);
    }

    protected function mostrarElems(){
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
        
        foreach($this->lista as $id => $producto){

            $id_user = $producto->getIdUser();
            $id_product = $producto->getIdProduct();
            $cantidad = $producto->getCantidad();
            $id_usuario = $_SESSION['idUsuario'];



            if($id_user == $id_usuario){
                $app = Aplicacion::getInstancia();
                $conn = $app->getConexionBd();
                $query = sprintf("SELECT * FROM tienda WHERE IdProducto ='$id_product'", $id_product);
                $rs = $conn->query($query);
                if ($rs) {
                    if ( $rs->num_rows == 1) {
                        $fila = $rs->fetch_assoc();
                        $nombre = $fila['nombre'];
                        $precio = $fila['precio'];
                        $imagen = $fila['imagen'];
                    }
                    $rs->free();
                }

                $precio_total = $precio * $cantidad;
                $precio_acumulado +=$precio_total;
                $alt = "imagen_".$nombre;
                $htmlImagen = '<a href="tienda.php?id='.$id.'"><img class="cesta_img" src="data:image/png;base64,'.base64_encode($imagen).'" alt ="'.$alt.'"></a>'; 
            
                $html .= <<<EOS
                <div class="cesta">
                    <tr>
                        <td>
                            <div class=producto>
                                $htmlImagen
                            </div>
                            <p class="text">{$nombre}</p>
                        </td>
                        <td class="tamanyo">{$cantidad}</td>
                        <td class="tamanyo">{$precio_total}€</td>
                        <td>
                            <form action="procesarCarritoEliminar.php" method="POST">
                                <input class="evil" required type ="number" name ="cantidad_prod"  id="campoCantidad"><span id="validCantidad"></span>
                                <input class="id_oculto" type ="number" name ="id_cantidad" id="valida" value="{$cantidad}">
                                <input class="id_oculto" type ="number" name ="id_producto" id="idprod" value ="{$id_product}">
                                <input class="id_oculto" type ="text" name ="id_usuario" id="iduser" value ="{$id_user}">
                                <div class="car">
                                    <input class="anyadir_carrito" type="submit" name="carrito" value="Eliminar unidades">
                                </div>
                            </form>
                        </td>
                    </tr>
                </div>
                EOS;
            }
        }

        $html .= <<<EOS
                </table>
                <div class="total">
                    <p class="text">Precio total: {$precio_acumulado}€</p>
                </div>
            </div>
        EOS;
        
        return $html;
    }

    protected function mostrarElem($datos){

        $path = self::$ruta_imagenes;
        //$htmlimagen = "<img class='carrito_centrado' src='{$path}carrito.png' alt='Gif'>"; 
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
         <div class = "carrito">
                <p class="txtpr1"><b>Precio: </b>{$tienda->getPrecio()}€</p>
                <p class="txtpr1"><b>Unidades: </b>{$tienda->getCantidad()}</p>
        EOS;

        if($tienda->getCantidad() != 0){
            $html .=<<< EOS
            <p class="txtpr1"><b>Cantidad a comprar:</b></p>
            <form action="procesarCarrito.php" method="POST">
                <input class="evil" required type ="number" name ="cantidad_prod"  id="campoCantidad"><span id="validCantidad"></span>
                <input class="id_oculto" type ="number" name ="id_cantidad" id="valida" value="{$tienda->getCantidad()}">
                <input class="id_oculto" type ="number" name ="id_producto" id="idprod" value ="{$tienda->getId()}">
                <div class="car">
                    <input class="anyadir_carrito" type="submit" name="carrito" value="Añadir al carrito">
                </div>
            </form>
            EOS;
        }

        $html .=<<< EOS
            </div>
       </div> 
    EOS;

    return $html;

    }
}