<?php

namespace es\chestnut\src\usuarios;

use es\chestnut\Aplicacion;
use es\chestnut\src\Formulario;

class FormularioLogout extends Formulario
{
    public function __construct() {
        parent::__construct('formLogout', ['urlRedireccion' => Aplicacion::getInstancia()->resuelve('/index.php')]);
    }

    protected function generaCamposFormulario(&$datos)
    {
        $camposFormulario = <<<EOS
            <button class="enlace" type="submit">(salir)</button>
        EOS;
        return $camposFormulario;
    }

    /**
     * Procesa los datos del formulario.
     */
    protected function procesaFormulario(&$datos)
    {
        $app = Aplicacion::getInstancia();

        $app->logout();
        $mensajes = ['Hasta pronto !'];
        $app->putAtributoPeticion('mensajes', $mensajes);
        $result = $app->resuelve('/index.php');

        return $result;
    }
}