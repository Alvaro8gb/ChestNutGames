
<?php

use es\chestnut\Aplicacion;
use es\chestnut\usuarios\FormularioLogout;
require_once __DIR__.'/../helpers/utils.php';


$app = Aplicacion::getInstancia();
$paginas = array('Juegos'=>'juegos.php','Tienda' => 'tienda.php', 'Ranking'=>'ranking.php', 'Eventos'=>'eventos.php', 'Contacto' => 'contacto.php' , 'Más' => "prevEntrega.php");

if (!( isset( $_GET['type']) && $_GET['type'] = "home" )){
    $paginas = array('Home' => 'index.php') + $paginas;
}

function mostrarSaludo(){
    $html = '';
    $app = Aplicacion::getInstancia();

    $ruta_imagenes = $app->resuelve(RUTA_IMGS.'tienda/');
    $ruta_imagenes1 = $app->resuelve(RUTA_IMGS.'usuario/');
    $perfilUrl = $app->resuelve('/perfilUsuario.php');
    $carritoUrl = $app->resuelve('/carrito.php');
    $alt ="cart";
    $alt1="perfil";

    if ($app->usuarioLogueado()) {
        $icono = <<<EOS
        <a href='{$perfilUrl}'><img class='img_cesta' src='{$ruta_imagenes1}perfil.png' alt='{$alt1}' ></a>
        <a href='{$carritoUrl}'><img class='img_cesta' src='{$ruta_imagenes}cart.png' alt='{$alt}' ></a>    
        EOS;
        echo $icono;
        
        $nombreUsuario = $app->nombreUsuario();

        $formLogout = new FormularioLogout();
        $htmlLogout = $formLogout->gestiona();
        $html = <<<EOS
        Bienvenido, ${nombreUsuario}.$htmlLogout
      EOS;
    } else {
        $loginUrl = $app->resuelve('/login.php');
        $registroUrl = $app->resuelve('/registro.php');
        $html = <<<EOS
        Usuario desconocido. <a href="{$loginUrl}">Login</a> | <a href="{$registroUrl}">Registro</a>
      EOS;
    }

    return $html;
}

?>

<!-- HTML HEADER -->
    <div class="saludo">
            <?= mostrarSaludo(); ?>
    </div>

    <nav id = "menu">
        <?php
            echo '<ul>';
            foreach($paginas as $name=>$enl){
                echo link_lista($enl, $name);
            }
            echo '</ul>';
        ?>                       
    </nav>