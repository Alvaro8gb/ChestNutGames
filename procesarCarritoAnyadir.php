<?php

    require_once __DIR__.'/includes/config.php';
    $id = $_POST['id_producto'];
    $id_user = $_SESSION['idUsuario'];
    if (isset($_POST['cantidad_prod'])) {
        $app = \es\chestnut\Aplicacion::getInstancia();
        $conn = $app->getConexionBd();
        $query = sprintf("SELECT * FROM compras WHERE IdUsuario = '$id_user' AND IdProducto ='$id'", $id_user,$id);
        $rs = $conn->query($query);
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $cantidad = $_POST['cantidad_prod'];
                $can = $fila['cantidad'];
                $total = $can + $cantidad;

                $query1=sprintf("UPDATE compras SET cantidad='$total' WHERE IdUsuario = '$id_user' AND IdProducto ='$id'", $total);
                if ( $conn->query($query1) ) {
                }
            }
            else{
                $cantidad = $_POST['cantidad_prod'];
                $query2=sprintf("INSERT INTO compras(IdUsuario,IdProducto,cantidad) VALUES('$id_user','$id','$cantidad')", $id_user, $id , $cantidad);
                if ( $conn->query($query2) ) {
                }
            }
            
            $rs->free();
            header("Location: carrito.php");
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
    }else{
        echo 'No se ha introducido cantidad';
    }
