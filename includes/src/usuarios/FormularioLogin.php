<?php

namespace es\chestnut\usuarios;

use es\chestnut\Aplicacion;
use es\chestnut\Formulario;

class FormularioLogin extends Formulario{
    public function __construct() {
        parent::__construct('formLogin', ['urlRedireccion' => Aplicacion::getInstancia()->resuelve('/index.php')]);
    }
    
    protected function generaCamposFormulario(&$datos){
        // Se reutiliza el nombre de usuario introducido previamente o se deja en blanco
        $nombreUsuario = $datos['nombreUsuario'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombreUsuario', 'password'], $this->errores, 'span', array('class' => 'error'));

        // Se genera el HTML asociado a los campos del formulario y los mensajes de error.
        $html = <<<EOF
        
        <div class="login-page"> 
            <div class="form">
                <div class="log">Usuario y contraseña</div>

                $htmlErroresGlobales
                <div class="form-group">
                    <label for="nombreUsuario">Nombre de usuario:</label>
                    <input id="nombreUsuario" type="text" minlength="4" name="nombreUsuario" value="$nombreUsuario" placeholder="Introduzca nombre de usuario"/>
                    {$erroresCampos['nombreUsuario']}
                </div>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input id="password" type="password" name="password" placeholder="Introduzca contraseña"/>
                    {$erroresCampos['password']}
                </div>
                <div>
                    <button type="submit" name="login">Entrar</button>
                </div>        
            </div>
        </div>
        EOF;
        return $html;
    }
    

    protected function procesaFormulario(&$datos){
        $this->errores = [];
        $nombreUsuario = trim($datos['nombreUsuario'] ?? '');
        $nombreUsuario = filter_var($nombreUsuario, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $nombreUsuario || empty($nombreUsuario) ) {
            $this->errores['nombreUsuario'] = 'El nombre de usuario no puede estar vacío';
        }
        
        $password = trim($datos['password'] ?? '');
        $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $password || empty($password) ) {
            $this->errores['password'] = 'La contraseña no puede estar vacía.';
        }
    
        
        if (count($this->errores) === 0) {
            
            $usuario = Usuario::login($nombreUsuario,null, $password);
        
            if (!$usuario) {
                $this->errores[] = "El usuario o la contraseña no coinciden";
            } else {
                $app = Aplicacion::getInstancia();
                $app->login($usuario);
            }
        }
    }
}