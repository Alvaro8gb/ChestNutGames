<?php

use es\chestnut\Aplicacion;

function mensajesPeticionAnterior(){
    $app = Aplicacion::getInstancia();
    $mensajes = $app->getAtributoPeticion('mensajes');
    $html = '';
    if ($mensajes) {
        $html = '<div class="mensajes">';
        $contador = 0;
        foreach($mensajes as $mensaje) {
            $contador++;
            $idMensaje = "mensaje{$contador}"; 
            $html .= <<<EOS
            <input id="$idMensaje" type="hidden">
            <div class="mensaje">
            <div class="contenido">$mensaje</div>
            </div>
            EOS;
        }
        $html .= '</div>';
    }

    return $html;
}


