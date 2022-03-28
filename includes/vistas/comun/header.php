
<?php

use es\chestnut\Aplicacion;
use es\chestnut\usuarios\FormularioLogout;
require_once __DIR__.'\..\helpers\utils.php';

$paginas = array('Juegos'=>'juegos.php', 'Ranking'=>'ranking.php', 'Eventos'=>'eventos.php', 'Contacto' => 'contacto.php' , 'Más' => "prevEntrega.php");

if (!( isset( $_GET['type']) && $_GET['type'] = "home" )){
    $paginas = array('Home' => 'index.php') + $paginas;
}

function mostrarSaludo(){
    $html = '';
    $app = Aplicacion::getInstancia();
    if ($app->usuarioLogueado()) {
        $nombreUsuario = $app->nombreUsuario();

        $formLogout = new FormularioLogout();
        $htmlLogout = $formLogout->gestiona();
        $html = "Bienvenido, ${nombreUsuario}. $htmlLogout";
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

<div class="saludo">
        <?= mostrarSaludo(); ?>
</div>

<nav id = "menu">

    <?php
        echo '<ul>';
        foreach($paginas as $name=>$enl){
            echo enlace($enl, $name);
        }
        echo '</ul>';    
    ?>
                    
</nav>


