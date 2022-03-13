<?php

    function mostrar_saludo(){
        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
            echo '<div class="saludo">Bienvenido '.$_SESSION['nombre'].'(<a href="logout.php">salir</a>)</div>';
        }
        else{
            echo '<div class="saludo">Usuario desconocido. <a href="login.php">Login</a></div>';
        }
        
    }

?>

<header id="derecha">
    <?php
    mostrar_saludo();  
    ?>
</header>