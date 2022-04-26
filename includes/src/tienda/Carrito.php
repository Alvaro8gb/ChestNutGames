<?php
    $id = $_POST['id_producto'];
    $id_user = $_SESSION['idUsuario'];
    if (isset($_POST['cantidad_prod'])) {
        $app = Aplicacion::getInstancia();
        $conn = $app->conexionBd();
        $query = sprintf("SELECT * FROM compras WHERE IdUsuario = '$id_user' AND IdProducto ='$id'", $conn->real_escape_string($id_user),$conn->real_escape_string($id));
        $rs = $conn->query($query);
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $cantidad = $_POST['cantidad_prod'];
                $can = $fila['cantidad'];
                $total = $can + $cantidad;

                $query1=sprintf("UPDATE compras SET cantidad='$total' WHERE IdUsuario = '$id_user' AND IdProducto ='$id'", $total);
            }
            else{
                $cantidad = $_POST['cantidad_prod'];
                $query2=sprintf("INSERT INTO compras(IdUsuario,IdProducto,cantidad) VALUES('%i','%i','%i')"
            , $id_user
            , $id
            , $cantidad);
            }
            
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
    }else{
        echo 'No se ha introducido cantidad';
    }
