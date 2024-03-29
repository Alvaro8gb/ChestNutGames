<?php

namespace es\chestnut\usuarios;

use es\chestnut\Aplicacion;
use es\chestnut\Formulario;

class FormularioLogout extends Formulario
{
    public function __construct() {
        parent::__construct('formLogout', [
            'action' =>  Aplicacion::getInstancia()->resuelve('/logout.php'),
            'urlRedireccion' => Aplicacion::getInstancia()->resuelve('/index.php')]);
    }

    protected function generaCamposFormulario(&$datos){

        $camposFormulario = <<<EOS
                <div class="logout">
                <button name="enviado" class="liquid" type="submit">
                    <span>Salir</span>
                </button>
                </div>
        EOS;
        return $camposFormulario;
    }

    /**
     * Procesa los datos del formulario.
     */
    protected function procesaFormulario(&$datos){
        $app = Aplicacion::getInstancia();

        $app->logout();
        $mensajes = ['Hasta pronto !'];
        $app->putAtributoPeticion('mensajes', $mensajes);
        $result = $app->resuelve('/index.php');

        return $result;
        
        
    }
}