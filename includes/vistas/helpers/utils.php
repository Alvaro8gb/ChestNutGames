<?php

function enlace($elc, $name){
    return '<li><a href='.'"'.$elc.'">'.$name.'</a></li>';
}

function check_log_in(){
    
    if (!isset($_SESSION["login"])) {
        $contenidoPrincipal = <<<EOF
        <h1>¡Usuario no registrado!</h1>
        <p id="cl">Debes iniciar sesión para ver el contenido.</p>  
        EOF;
    return $contenidoPrincipal;
    }
    
    return "";
}

function link_css($app,$path){
    return "<link rel='stylesheet' type='text/css' href={$app->resuelve($path)}>". "\n\t\t";
}

function img($path, $alt){

}