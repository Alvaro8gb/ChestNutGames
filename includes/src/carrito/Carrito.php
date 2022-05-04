<?php

namespace es\chestnut\carrito;

use es\chestnut\Aplicacion;

class Carrito {

    private $carrito;

    public function __construct($carrito) {
        $this->carrito = $carrito;
    }

    public function gestiona(){

        if(!isset($_POST["carrito_tramitado"])){
            return $this->beforeTramitarCarrito();

        }else{
            return $this->afterTramitarCarrito();
        }

    }
    
    private function beforeTramitarCarrito(){
        $html = <<<EOS
        <div class="titular">
            Artículos en la cesta
        </div>
        EOS;

        $columnas = array("PRODUCTO","CANTIDAD","PRECIO","ACCIÓN");

        $result = $this->mostrarCarrito($columnas,true);
        
        $html .= $result[0];
        $precio_acumulado = $result[1]; 

        if($precio_acumulado!=0){
            $html .= <<<EOS
                        <form action="carrito.php" method="POST">
                            <div class="car">
                                <input class="anyadir_carrito" name="carrito_tramitado" type="submit" value="Tramitar Pedido">
                            </div>
                        </form>
        EOS;
        }

        $html .= <<<EOS
            </div>
        EOS;
        
        return $html;
    }

    private function afterTramitarCarrito(){
        
        $html = <<<EOS
        <div class="titular">
            Artículos comprados
        </div>
        EOS;
        
        $columnas = array("PRODUCTO","CANTIDAD","PRECIO");

        $result = $this->mostrarCarrito($columnas,false);
        
        $html .= $result[0];

        $app = Aplicacion::getInstancia();
        $id_user = $app->idUsuario();

        foreach($this->carrito as $elemCarrito){

            $id = $elemCarrito->getIdProducto();
            $cantidad = $elemCarrito->getCantidad();

            $conn = $app->getConexionBd();
            $query = sprintf("SELECT * FROM tienda WHERE IdProducto ='$id'", mysqli_real_escape_string($conn,$id));
            $rs = $conn->query($query);
                   
            if ($rs) {
                if ( $rs->num_rows == 1) {
                    $fila = $rs->fetch_assoc();
                    $cantidad_bd = $fila['cantidad'];
                    $total = $cantidad_bd - $cantidad;

                    $query1=sprintf("UPDATE tienda SET cantidad='$total' WHERE IdProducto ='$id'",mysqli_real_escape_string($conn,$id), mysqli_real_escape_string($conn,$total));
                    if ( !$conn->query($query1) ) {
                        throw new \Exception("Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error));
                    }
                }
                $rs->free();
            }

            $query2 = sprintf("SELECT * FROM compras WHERE IdProducto ='$id' AND IdUsuario='$id_user'", mysqli_real_escape_string($conn,$id),mysqli_real_escape_string($conn,$id_user));
            $rs1 = $conn->query($query2);
            if ($rs1) {
                if ( $rs1->num_rows == 1) {
                    $fila = $rs1->fetch_assoc();
                    $can = $fila['cantidad'];
                    $total = $can + $cantidad;
    
                    $query2=sprintf("UPDATE compras SET cantidad='$total' WHERE IdUsuario = '$id_user' AND IdProducto ='$id'",mysqli_real_escape_string($conn,$id),mysqli_real_escape_string($conn,$id_user), mysqli_real_escape_string($conn,$total));
                    if ( !$conn->query($query2) ) {
                        throw new \Exception("Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error));
                    }
                }
                else{
                    $query3=sprintf("INSERT INTO compras(IdUsuario,IdProducto,cantidad) VALUES('$id_user','$id','$cantidad')", mysqli_real_escape_string($conn,$id_user), mysqli_real_escape_string($conn,$id) , mysqli_real_escape_string($conn,$cantidad));
                    if ( !$conn->query($query3) ) {
                        throw new \Exception("Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error));
                    }
                }
                
                $rs1->free();
            }
            else {
                throw new \Exception("Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error));
            }
        }

        $app->borrarCarrito();
        
        return $html;
    }

    private function mostrarCarrito($columnas,$eliminar){
        $html = <<<EOS
        <div class="grid">
            <table>
                <thead>
                    <tr>
        EOS;

        foreach($columnas as $col){
            $html.= "<th class='tamanyo'>$col</th>";
        }
        $html .="</thead>";
                     
        $precio_acumulado=0;

        foreach($this->carrito as $idElemCarrito => $elemCarrito){
            
                $nombre = $elemCarrito->getNombre();
                $cantidad = $elemCarrito->getCantidad();
                $precio = $elemCarrito->getPrecio();
                $id = $elemCarrito->getIdEnTienda();
                $alt = "imagen_".$nombre;
                $imagen = $elemCarrito->getImagen();

                $htmlImagen = '<a href="tienda.php?id='.$id.'"><img class="cesta_img" src="data:image/png;base64,'.$imagen.'" alt ="'.$alt.'"></a>'; 
                $precio_total = $precio * $cantidad;
                $precio_acumulado += $precio_total;

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
                EOS;

                if($eliminar){
                    $formElimnarItem = new FormularioRemove2Carrito($idElemCarrito,$cantidad);
                    $htmlFormRemoveItem = $formElimnarItem->gestiona();
                    $html .= "<td> $htmlFormRemoveItem </td>";
                }

                $html .= <<<EOS
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

        return array($html,$precio_acumulado);
    }
}