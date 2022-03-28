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
            <head>
                <link rel="stylesheet" type="text/css" href="css/button.css" />
            </head>
            <button class="logout" type="submit">
                <span>Salir</span>
                <div class="liquid"></div>
            </button>
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
        $mensajes = ['Hasta pronto!'];
        $app->putAtributoPeticion('mensajes', $mensajes);
        $result = $app->resuelve('/index.php');

        return $result;
    }
}