<?php

namespace es\chestnut\usuarios;

use es\chestnut\Aplicacion;
use es\chestnut\Formulario;

class FormularioRegistro extends Formulario{

    public function __construct() {
        parent::__construct('formRegistro', ['urlRedireccion' => Aplicacion::getInstancia()->resuelve('/index.php')]);
    }
    
    protected function generaCamposFormulario(&$datos){
        $nombreUsuario = $datos['nombreUsuario'] ?? '';
        $nombre = $datos['nombre'] ?? '';
        $correoUsuario = $datos['correoUsuario'] ?? '';

        // Se generan los mensajes de error si existen.
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombreUsuario', 'nombre', 'password', 'password2', 'correo'], $this->errores, 'span', array('class' => 'error'));

        $html = <<<EOF
        <div class="login-page">
            <div class="form">
                <div class="log">Datos para el registro</div>{$htmlErroresGlobales}
                <div>
                    <label for="correoUsuario">Correo electrónico:</label>
                    <span id="validEmail"></span>
                    <input id="correoUsuario" type="email" minlength="5" name="correoUsuario" value="$correoUsuario" placeholder="Introduzca correo electrónico"/>
                    {$erroresCampos['correo']}
                </div>
                <div>
                    <label for="nombreUsuario">Nombre de usuario:</label>
                    <span id="validUser"></span>
                    <input id="nombreUsuario" type="text" minlength="5" name="nombreUsuario" value="$nombreUsuario" placeholder="Introduzca nombre de usuario"/>
                    {$erroresCampos['nombreUsuario']}
                </div>
                <div>
                    <label for="nombre">Nombre:</label>
                    <input id="nombre" type="text"  minlength="5" name="nombre" value="$nombre" placeholder="Introduzca nombre completo"/>
                    {$erroresCampos['nombre']}
                </div>
                <div>
                    <label for="password">Contraseña:</label>
                    <span id="valid_password1"></span>
                    <input id="password" type="password" name="password" placeholder="Introduzca contraseña"/>
                    {$erroresCampos['password']}
                </div>
                <div>
                    <label for="password2">Reintroduce la contraseña:</label>
                    <span id="valid_password2"></span>
                    <input id="password2" type="password" name="password2" placeholder="Vuelva a introducir la contraseña"/>
                    {$erroresCampos['password2']}
                </div>
                <div>
                    <button type="submit" name="registro">Registrar</button>
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
        if ( ! $nombreUsuario || mb_strlen($nombreUsuario) < 5) {
            $this->errores['nombreUsuario'] = 'El nombre de usuario tiene que tener una longitud de al menos 5 caracteres.';
        }

        $nombre = trim($datos['nombre'] ?? '');
        $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $nombre || mb_strlen($nombre) < 5) {
            $this->errores['nombre'] = 'El nombre tiene que tener una longitud de al menos 5 caracteres.';
        }

        $password = trim($datos['password'] ?? '');
        $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $password || mb_strlen($password) < 8 ) {
            $this->errores['password'] = 'La contraseña tiene que tener una longitud de al menos 8 caracteres.';
        }

        $password2 = trim($datos['password2'] ?? '');
        $password2 = filter_var($password2, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $password2 || $password != $password2 ) {
            $this->errores['password2'] = 'Las contraseñas deben coincidir';
        }

        $correoUsuario = trim($datos['correoUsuario'] ?? '');
        $correoUsuario = filter_var($correoUsuario, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (empty($correoUsuario)) {
            $this->errores['correo'] = 'Debe de haber un correo electrónico';
        }

        if (count($this->errores) === 0) {

            if ( Usuario::buscarUsuarioPorNombre($nombreUsuario)) {
                $this->errores[] = "El usuario ya existe";
                $this->errores['nombreUsuario'] = 'El nombre de usuario ya existe';

            }else if( Usuario::buscarUsuarioPorCorreo($correoUsuario)){
                $this->errores[] = "El usuario ya existe";
                $this->errores['correo'] = 'El correo ya existe';
            }
            else {
                $usuario = Usuario::crea($nombreUsuario, $nombre, $password, $correoUsuario, Usuario::USER_ROLE);
                $app = Aplicacion::getInstancia();
                $app->login($usuario);
            }
        }
    }
}