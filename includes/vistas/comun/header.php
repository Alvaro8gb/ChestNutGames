
<?php
require_once __DIR__.'/../helpers/utils.php';

use es\chestnut\Aplicacion;
use es\chestnut\usuarios\FormularioLogout;

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

    if ($app->usuarioLogueado()) {
        $html .= <<<EOS
            <a href='{$perfilUrl}'><img class='img_cesta' src='{$ruta_imagenes1}perfil.png' alt='perfil' ></a>
            <a href='{$carritoUrl}'><img class='img_cesta' src='{$ruta_imagenes}cart.png' alt='carrito' ></a>    
        EOS;
        
        $nombreUsuario = $app->nombreUsuario();

        try{
            $formLogout = new FormularioLogout();
            $htmlLogout = $formLogout->gestiona();      
        
        }catch(Exception $e){
            $app->paginaError(501,'Error',"Error en formulario logout: ".$e->getMessage(),$e->getTrace());
        }

        $html .= <<<EOS
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