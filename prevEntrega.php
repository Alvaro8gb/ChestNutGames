<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/comun/utils.php';

$tituloPagina = 'Información ';

$paginas_documentacion = array('Memoria'=>'memoria.php');

$paginas_anteriores = array('Detalles'=>'detalles.php', 'Planificacion'=>'planificacion.php', 'Bocetos' => 'bocetos.php' , 'Miembros' => "miembros.php");

$contenidoPrincipal = <<<EOS

<h1 class = "h1_title">  Documentación </h1>

<nav >
    <ul>
EOS;

foreach($paginas_documentacion as $name=>$enl){
    $contenidoPrincipal .= enlace($enl, $name);
}

$contenidoPrincipal .=<<<EOS
    </ul>      
</nav>
<h1 class = "h1_title"> Contenido de entregas anteriores </h1>  
<nav>
    <ul>
EOS;

foreach($paginas_anteriores as $name=>$enl){
    $contenidoPrincipal .= enlace($enl, $name);
}

$contenidoPrincipal.= <<<EOS
    </ul>               
</nav>
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';