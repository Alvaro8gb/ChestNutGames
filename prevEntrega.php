<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$paginas_anteriores = array('Detalles'=>'detalles.php', 'Planificacion'=>'planificacion.php', 'Bocetos' => 'bocetos.php' , 'Miembros' => "miembros.php");

$tituloPagina = 'Información';

$contenidoPrincipal = '';
$contenidoPrincipal .=<<<EOS
<h1 class = "h1_title"> Contenido de entregas anteriores </h1>  
<nav id="anterior">
    <ul id="entregas">
EOS;

foreach($paginas_anteriores as $name=>$enl){
    $contenidoPrincipal .= link_lista($enl, $name);
}

$contenidoPrincipal.= <<<EOS
    </ul>               
</nav>
EOS;

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);