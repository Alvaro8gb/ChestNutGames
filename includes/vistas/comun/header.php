
<?php

require_once __DIR__.'\..\helpers\utils.php';

$paginas = array('Juegos'=>'juegos.php', 'Ranking'=>'ranking.php', 'Eventos'=>'eventos.php', 'Contacto' => 'contacto.php' , 'Más' => "prevEntrega.php");

if (!( isset( $_GET['type']) && $_GET['type'] = "home" )){
    $paginas = array('Home' => 'index.php') + $paginas;
}

echo '<div class="saludo">';
    
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    echo $_SESSION['nombre'].'(<a href="logout.php">Salir</a>)';
}
else{
    echo 'Usuario desconocido. <a href="login.php"> Login </a> | <a href="registro.php"> Registro </a>';
}

echo '</div>';
    
?>

<nav id = "menu">

    <?php
        echo '<ul>';
        foreach($paginas as $name=>$enl){
            echo enlace($enl, $name);
        }
        echo '</ul>';    
    ?>
                    
</nav>


