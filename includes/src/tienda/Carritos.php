<?php

namespace es\chestnut\tienda;
use es\chestnut\Lista;
use es\chestnut\Aplicacion;

class Carritos extends Lista{
    private const TABLE ="cesta";
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
                                <input class="evil" required type ="number" name ="cantidad_prod" id="campoCantidad"><span id="validCantidad"></span>
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
                </div>
                <div class="total">
                    <p class="text">Precio total: {$precio_acumulado}€
        EOS;

        if($precio_acumulado!=0){
            $html .= <<<EOS
                        <form action="Compras.php" method="POST">
                            <div class="car">
                                <input class="anyadir_carrito" type="submit" name="carrito" value="Tramitar Pedido">
                            </div>
                        </form>
        EOS;
        }
        $html .= <<<EOS
                    </p>
                </div>
            </div>
        EOS;
        
        return $html;
    }

}