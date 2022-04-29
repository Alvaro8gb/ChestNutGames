<?php

namespace es\chestnut\usuarios;

use es\chestnut\Aplicacion;
use es\chestnut\MagicProperties;


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
    private $eventos_inscritos;
    private $puntuacion_juegos;
    private $juegos_jugados;

    private function __construct($nombreUsuario, $nombre, $password,$correo, $id = null, $rol){
        $this->id = $id;
        $this->nombreUsuario= $nombreUsuario;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->rol = $rol;
        $this->correo = $correo;
        $this->cargarInscripciones();
        $this->cargarPuntuaciones();
    }

    private function cargarPuntuaciones(){
        $id_juegos_jugados= array();
        $juegos_jugados = array();
        $puntuacion_juegos = array();

        $app = Aplicacion::getInstancia();
        $conn = $app->getConexionBd();
        $sql = sprintf("SELECT distinct IdJuego FROM ranking WHERE IdJugador = $this->id");
        $res = @mysqli_query($conn, $sql);

        while($fila = @mysqli_fetch_array($res)){
            array_push($id_juegos_jugados, $fila["IdJuego"]);
        }
        foreach( $id_juegos_jugados as $id_juego){
            $sql = sprintf("SELECT Nombre FROM juegos WHERE IdJuego = $id_juego");
            $res = @mysqli_query($conn, $sql);
            $fila = @mysqli_fetch_array($res);
            array_push($juegos_jugados, $fila["Nombre"]);
        }
        foreach($id_juegos_jugados as $id_juego){
            $sql = sprintf("SELECT MAX(Puntuacion) FROM ranking WHERE IdJuego = $id_juego AND IdJugador = $this->id GROUP BY IdJugador");
            $res = @mysqli_query($conn, $sql);
            $fila = @mysqli_fetch_array($res);
            array_push($puntuacion_juegos, $fila["MAX(Puntuacion)"]);
        }

        $this->puntuacion_juegos = $puntuacion_juegos;
        $this->juegos_jugados = $juegos_jugados;
    
    }
    private function cargarInscripciones(){
            $idsEventos_inscritos = array();
            $eventos_inscritos = array();

            $app = Aplicacion::getInstancia();
            $conn = $app->getConexionBd();
            $sql = sprintf("SELECT distinct IdEvento FROM inscripcioneseventos WHERE IdUsuario = $this->id");
            $res = @mysqli_query($conn, $sql);

            while($fila = @mysqli_fetch_array($res)){
                array_push($idsEventos_inscritos, $fila["IdEvento"]);
            }

            foreach($idsEventos_inscritos as $id_evento){
                $sql = sprintf("SELECT IdEvento, nombre FROM eventos WHERE IdEvento = $id_evento");
                $res = @mysqli_query($conn, $sql);
                $fila = @mysqli_fetch_array($res);
                $eventos_inscritos[$fila["IdEvento"] ] = $fila["nombre"];
            }

            $this->eventos_inscritos = $eventos_inscritos;
        
    }
    public static function login($nombreUsuario, $correo, $password){
        if ($nombreUsuario != null){
            $usuario = self::buscarUsuarioPorNombre($nombreUsuario);
        }
        else{
            $usuario = self::buscarUsuarioPorCorreo($correo);
        }

        if ($usuario && $usuario->compruebaPassword($password)) {
            return $usuario;
        }
        return false;
    }

    private static function createUser($fila){
        return  new Usuario($fila['nombreUsuario'], $fila['nombre'], $fila['password'], $fila['correo'], $fila['IdUsuario'], $fila['rol']);
    }

    public static function buscarUsuarioPorNombre($nombre){
        return self::buscaUsuario($nombre,"nombreUsuario");

    }
    public static function buscarUsuarioPorId($id){
        return self::buscaUsuario($id,"IdUsuario");

    }

    public static function buscarUsuarioPorCorreo($nombre){
        return self::buscaUsuario($nombre,"correo");

    }

    private static function buscaUsuario($val, $campo){

        $conn = Aplicacion::getInstancia()->getConexionBd();
        $user = false;

        $query = sprintf("SELECT * FROM usuarios U WHERE U.%s = '%s'",$campo, $conn->real_escape_string($val));
        $rs = $conn->query($query);

        if ($rs && $rs->num_rows == 1) {
         
            $fila = $rs->fetch_assoc();
            $user = self::createUser($fila);
            
        }else{
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }

        return $user;

    }

    private static function hashPassword($password){
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
        $query=sprintf("UPDATE usuarios U SET nombreUsuario = '%s', nombre='%s', password='%s', correo='%s' WHERE U.IdUsuario=%i"
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
        $query = sprintf("DELETE FROM usuarios U WHERE U.IdUsuario = %d", $idUsuario);
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

    public function getInscripciones(){
        return $this->eventos_inscritos;
    }

    public function getJuegosJugados(){
        return $this->juegos_jugados;
    }
    public function getPuntuacionJuegos(){
        return $this->puntuacion_juegos;
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