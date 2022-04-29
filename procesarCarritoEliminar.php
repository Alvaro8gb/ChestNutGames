<?php

    require_once __DIR__.'/includes/config.php';
    $id = $_POST['id_producto'];
    $id_user = $_SESSION['idUsuario'];
    if (isset($_POST['cantidad_prod'])) {
        $app = \es\chestnut\Aplicacion::getInstancia();
        $conn = $app->getConexionBd();
        $query = sprintf("SELECT * FROM cesta WHERE IdUsuario = '$id_user' AND IdProducto ='$id'", $id_user,$id);
        $rs = $conn->query($query);
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $cantidad_bd = $fila['cantidad'];
                $cantidad = $_POST['cantidad_prod'];
                $cantidad_final = $cantidad_bd - $cantidad;

                if($cantidad_final == 0){
                    $query1=sprintf("DELETE FROM cesta WHERE IdUsuario = '$id_user' AND IdProducto ='$id'", $id_user,$id);
                    if ( $conn->query($query1)) {
                    }
                }
                else{
                    $query2=sprintf("UPDATE cesta SET cantidad='$cantidad_final' WHERE IdUsuario = '$id_user' AND IdProducto ='$id'", $cantidad_final);
                    if ( $conn->query($query2)) {
                    }
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
