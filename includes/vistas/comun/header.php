
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
    if ($app->usuarioLogueado()) {
        $nombreUsuario = $app->nombreUsuario();
        $perfilUrl = $app->resuelve('/perfilUsuario.php');

        $formLogout = new FormularioLogout();
        $htmlLogout = $formLogout->gestiona();

        $html = <<<EOS
        Bienvenido, ${nombreUsuario}.<a href="{$perfilUrl}">Perfil</a>.$htmlLogout
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