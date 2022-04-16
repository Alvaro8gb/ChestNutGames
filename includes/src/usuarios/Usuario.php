<?php

namespace es\chestnut\usuarios;

use es\chestnut\Aplicacion;
use es\chestnut\MagicProperties;
use Exception;

class Usuario{

    use MagicProperties;

    public const ADMIN_ROLE = 'admin';
    public const USER_ROLE = 'user';

    private $id;
    private $nombreUsuario;
    private $password;
    private $nombre;
    private $rol;
    private $correo;

    private function __construct($nombreUsuario, $nombre, $password,$correo, $id = null, $rol){
        $this->id = $id;
        $this->nombreUsuario= $nombreUsuario;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->rol = $rol;
        $this->correo = $correo;
    }

    public static function login($nombreUsuario, $correo, $password){
        $usuario = self::buscaUsuario($nombreUsuario, $correo);
        if ($usuario && $usuario->compruebaPassword($password)) {
            return $usuario;
        }
        return false;
    }

    private static function createUser($fila){
        return  new Usuario($fila['nombreUsuario'], $fila['nombre'], $fila['password'], $fila['correo'], $fila['IdUsuario'], $fila['rol']);

    }

    public static function buscaUsuario($nombreUsuario, $correo){
        $conn = Aplicacion::getInstancia()->getConexionBd();
        $user = null;

        if ($nombreUsuario != null){

            $query = sprintf("SELECT * FROM Usuarios U WHERE U.nombreUsuario = '%s'", $conn->real_escape_string($nombreUsuario));
            $rs = $conn->query($query);

            if ($rs &&  $rs->num_rows == 1) {
        
                $fila = $rs->fetch_assoc();
                $user = self::createUser($fila);
                
            }else{
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }

        }
        else if($correo != null){

            $query = sprintf("SELECT * FROM Usuarios U WHERE U.correo = '%s'", $conn->real_escape_string($correo));
            $rs = $conn->query($query);

            if ($rs &&  $rs->num_rows == 1) {
        
                $fila = $rs->fetch_assoc();
                $user = self::createUser($fila);
                
            }else{
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
        }else{
            throw new Exception("The user or mail cant not be null ");
        }
        
        return $user;
    }

    public static function buscaPorId($idUsuario)
    {
        $conn = Aplicacion::getInstancia()->getConexionBd();
        $query = sprintf("SELECT * FROM Usuarios WHERE id=%d", $idUsuario);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if($fila){
                $result = new Usuario($fila['nombreUsuario'], $fila['nombre'], $fila['password'], $fila['correo'], $fila['id'], $fila['rol']);
            }   
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }


    private static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function crea($nombreUsuario, $nombre, $password, $correo, $rol){

        $user = new Usuario($nombreUsuario, $nombre, self::hashPassword($password), $correo, null, $rol);
        return $user->guarda();
    }
    

    private static function inserta($usuario){
        $result = false;
        $conn = Aplicacion::getInstancia()->getConexionBd();
        $query=sprintf("INSERT INTO usuarios(nombreUsuario, nombre, password, correo, rol) VALUES('%s', '%s', '%s', '%s', '%s')"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->password)
            ,$conn->real_escape_string($usuario->correo)
            ,$conn->real_escape_string($usuario->rol));
        if ( $conn->query($query) ) {
            $usuario->id = $conn->insert_id;
            
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $usuario;
    }
    
    private static function actualiza($usuario){
        $result = false;
        $conn = Aplicacion::getInstancia()->getConexionBd();
        $query=sprintf("UPDATE Usuarios U SET nombreUsuario = '%s', nombre='%s', password='%s', correo='%s' WHERE U.id=%i"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->password)
            , $conn->real_escape_string($usuario->correo)
            , $usuario->id);
            if ( $conn->query($query) ) {
                $result = true;
            } else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
        
        return $usuario;
    }
   
    private static function borra($usuario){
        return self::borraPorId($usuario->id);
    }
    
    private static function borraPorId($idUsuario){
        if (!$idUsuario) {
            return false;
        } 

        $conn = Aplicacion::getInstancia()->getConexionBd();
        $query = sprintf("DELETE FROM Usuarios U WHERE U.id = %d", $idUsuario);
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    public function getId(){
        return $this->id;
    }

    public function getNombreUsuario(){
        return $this->nombreUsuario;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getRol(){
        return $this->rol;
    }

    public function getCorreo(){
        return $this->correo;
    }

    public function compruebaPassword($password)
    {
        return password_verify($password, $this->password);
    }

    public function cambiaPassword($nuevoPassword)
    {
        $this->password = self::hashPassword($nuevoPassword);
    }

    public function guarda()
    {
        if ($this->id !== null) {
            return self::actualiza($this);
        }
        return self::inserta($this);
    }
    
    public function borrate(){
        if ($this->id !== null) {
            return self::borra($this);
        }
        return false;
    }
}