<?php

namespace es\chestnut\tienda;
use es\chestnut\Lista;
use es\chestnut\Aplicacion;

class Pedidos extends Lista{
    private const TABLE ="compras";

    public function __construct(){
        parent::__construct(self::TABLE);
    }

    protected function crearElem($fila){
        return new Pedido($fila["IdUsuario"],$fila["IdProducto"],$fila["cantidad"]);
    }

    protected function mostrarElems(){
        $html = <<<EOS
        <div class="titular">
            Historial de pedidos
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
                $htmlImagen = '<img class="cesta_img" src="data:image/png;base64,'.base64_encode($imagen).'" alt ="'.$alt.'">'; 
            
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
                    </tr>
                </div>
                EOS;
            }
        }

        $html .= <<<EOS
                </table>
                <div class="total">
                    <p class="text">Precio total pagado: {$precio_acumulado}€</p>
                </div>
            </div>
        EOS;
        
        return $html;
    }

}