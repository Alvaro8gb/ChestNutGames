<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$tituloPagina = 'Miembros';

$miembros = array('Petar Konstantinov Ivanov'=>'#Petar', 'Sergio Lorente Bausela'=>'#Sergio', 'Álvaro García Barragán'  => '#Alvaro'  ,
 'David Candil Villacastín' => '#David', 'Víctor Moreno Pérez' => '#Victor' , 'Pablo Sánchez-Rodilla Serrano' => '#Pablo');

$contenidoPrincipal = <<<EOS
    <div class= "memberlinks">
    <h2>Lista de Miembros</h2>
    <ol>
EOS;
    foreach($miembros as $name=>$enl){
        $contenidoPrincipal .= enlace($enl, $name);
    }

$contenidoPrincipal .= <<<EOS
    </ol>
    </div>
EOS;

ob_start();
require __DIR__.'/static/miembros.html';
$contenidoPrincipal .= ob_get_clean();

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];
$app->generaVista('/plantillas/plantilla.php', $params);