<?php

namespace es\chestnut\tienda;
use es\chestnut\Lista;
use es\chestnut\Aplicacion;

class Compras extends Lista{
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
            Gracias por su compra
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

            $query1 = sprintf("SELECT * FROM compras WHERE IdProducto ='$id_product' AND IdUsuario='$id_user'", $id_product,$id_user);
                $rs1 = $conn->query($query1);
                if ($rs1) {
                    if ( $rs1->num_rows == 1) {
                        $fila = $rs1->fetch_assoc();
                        $can = $fila['cantidad'];
                        $total = $can + $cantidad;
        
                        $query2=sprintf("UPDATE compras SET cantidad='$total' WHERE IdUsuario = '$id_user' AND IdProducto ='$id_product'", $total);
                        if ( $conn->query($query2) ) {
                        }
                    }
                    else{
                        $query3=sprintf("INSERT INTO compras(IdUsuario,IdProducto,cantidad) VALUES('$id_user','$id_product','$cantidad')", $id_user, $id_product , $cantidad);
                        if ( $conn->query($query3) ) {
                        }
                    }
                    
                    $rs1->free();
                }
                else {
                    echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
                    exit();
                }
        }

        $html .= <<<EOS
                </table>
                <div class="total">
                    <p class="text">Precio total pagado: {$precio_acumulado}€</p>
                </div>
            </div>
        EOS;

        foreach($this->lista as $id => $producto){

            $id_user = $producto->getIdUser();
            $id_product = $producto->getIdProduct();
            $cantidad = $producto->getCantidad();
            $id_usuario = $_SESSION['idUsuario'];

            if($id_user == $id_usuario){
                $app = Aplicacion::getInstancia();
                $conn = $app->getConexionBd();

                $query6 = sprintf("SELECT * FROM tienda WHERE IdProducto ='$id_product'", $id_product);
                $rs4 = $conn->query($query6);
                if ($rs4) {
                    if ( $rs4->num_rows == 1) {
                        $fila = $rs4->fetch_assoc();
                        $cantidad_bd = $fila['cantidad'];
                        $total = $cantidad_bd - $cantidad;

                        $query7=sprintf("UPDATE tienda SET cantidad='$total' WHERE IdProducto ='$id_product'", $total);
                        if ( $conn->query($query7) ) {
                        }
                    }
                    $rs4->free();
                }


                $query5=sprintf("DELETE FROM cesta WHERE IdUsuario = '$id_user' AND IdProducto ='$id_product'", $id_user,$id_product);
                if ( $conn->query($query5)) {
                }
            }
        }
        
        return $html;
    }

}