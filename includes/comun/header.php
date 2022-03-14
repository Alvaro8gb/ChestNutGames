
<?php

function enlace($elc, $name){
    echo '<li><a href='.'"'.$elc.'">'.$name.'</a></li>';
}


if (isset( $_GET['type']) && $_GET['type'] = "home" ){
    $paginas = array('Juegos'=>'juegos.php', 'Ranking'=>'ranking.php', 'Contacto' => 'contacto.php' , 'Más' => "prevEntrega.php");

}else{
    $paginas = array('Home' => 'index.php','Juegos'=>'juegos.php', 'Ranking'=>'ranking.php', 'Contacto' => 'contacto.php' , 'Más' => "prevEntrega.php");

}

echo '<div class="saludo">';
    
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    echo '<div class="saludo">'.$_SESSION['nombre'].'(<a href="logout.php">salir</a>)';
}
else{
    echo 'Usuario desconocido. <a href="login.php">Login</a>.<a href="registro.php">Registro</a>';
}

echo '</div>';
    
?>

<nav id = "menu">

    <?php
        echo '<ul>';
        foreach($paginas as $name=>$enl){
            enlace($enl, $name);
        }
        echo '</ul>';    
    ?>
                    
</nav>


