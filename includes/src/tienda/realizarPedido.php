<?php

namespace es\chestnut\tienda;
use es\chestnut\Aplicacion;
use es\chestnut\Lista;

class realizarPedido extends Lista {

    private const TABLE ="compras";
    public function __construct() {
        parent::__construct(self::TABLE);
        $app = Aplicacion::getInstancia();
    }
    public function mostrarElems(){
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
                    </tr>
                </thead>
        EOS;

        $precio_acumulado=0;
        $carrito = $_SESSION["carrito"];
        $id_user = $_SESSION["idUsuario"];

        foreach($carrito as $idElemCarrito => $elemCarrito){
            
                $nombre = $elemCarrito->getNombre();
                $cantidad = $elemCarrito->getCantidad();
                $precio = $elemCarrito->getPrecio();
                $id = $elemCarrito->getId();
                $precio_acumulado+= $precio;
                $alt = "imagen_".$nombre;
                $imagen = $elemCarrito->getImagen();

                $htmlImagen = '<a href="tienda.php?id='.$id.'"><img class="cesta_img" src="data:image/png;base64,'.$imagen.'" alt ="'.$alt.'"></a>'; 
                $precio_total = $precio * $cantidad;

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
                        <td class="tamanyo"> $precio_total €</td>
                    </tr>
                </div>
                EOS;
        }

        $html .= <<<EOS
        </table>
                </div>
                <div class="total">
                    <p class="text">Precio total: {$precio_acumulado} €</p>
                </div>
        EOS;

        foreach($carrito as $idElemCarrito => $elemCarrito){

            $id = $elemCarrito->getId();
            $id = $id+1;
            $cantidad =$elemCarrito->getCantidad();

            $app = Aplicacion::getInstancia();
            $conn = $app->getConexionBd();
            $query = sprintf("SELECT * FROM tienda WHERE IdProducto ='$id'", $id);
            $rs = $conn->query($query);
            if ($rs) {
                if ( $rs->num_rows == 1) {
                    $fila = $rs->fetch_assoc();
                    $cantidad_bd = $fila['cantidad'];
                    $total = $cantidad_bd - $cantidad;

                    $query1=sprintf("UPDATE tienda SET cantidad='$total' WHERE IdProducto ='$id'",$id, $total);
                    if ( $conn->query($query1) ) {
                    }
                }
                $rs->free();
            }



                $query2 = sprintf("SELECT * FROM compras WHERE IdProducto ='$id' AND IdUsuario='$id_user'", $id,$id_user);
                $rs1 = $conn->query($query2);
                if ($rs1) {
                    if ( $rs1->num_rows == 1) {
                        $fila = $rs1->fetch_assoc();
                        $can = $fila['cantidad'];
                        $total = $can + $cantidad;
        
                        $query2=sprintf("UPDATE compras SET cantidad='$total' WHERE IdUsuario = '$id_user' AND IdProducto ='$id'",$id,$id_user, $total);
                        if ( $conn->query($query2) ) {
                        }
                    }
                    else{
                        $query3=sprintf("INSERT INTO compras(IdUsuario,IdProducto,cantidad) VALUES('$id_user','$id','$cantidad')", $id_user, $id , $cantidad);
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

        unset($_SESSION["carrito"]);
        
        return $html;
    }

}