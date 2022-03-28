<?php

function enlace($elc, $name){
    return '<li><a href='.'"'.$elc.'">'.$name.'</a></li>';
}

function log_in($session){
    
    if (!isset($session)) {
        $contenidoPrincipal = <<<EOF
        <h1>¡Usuario no registrado!</h1>
        <p>Debes iniciar sesión para ver el contenido.</p>)  
        EOF;
    return $contenidoPrincipal;
    }
    
    return "";
}