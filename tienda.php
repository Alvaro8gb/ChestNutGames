<?php
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Tienda';

$contenidoPrincipal = '<div class = "productos"> <h1 id="cl"> Productos de la tienda. No disponible todavía </h1></div>';

#CSS grid

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);

// Mostrar anuncio 
if($app->show_advert())
echo '<script type="text/javascript"> advert_show(); </script>';

?>