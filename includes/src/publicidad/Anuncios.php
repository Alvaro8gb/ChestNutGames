<?php

namespace es\chestnut\publicidad;
use es\chestnut\Aplicacion;

class Anuncio {
    private $id;
    private $nombreEmpresa;
    private $imagen;
    private $desc;
    private $enlace;
    // private const TABLE ="publicidad";

    public function __construct($id, $nombreEmpresa, $imagen, $desc, $enlace ){
        $this->id = $id;
        $this->nombreEmpresa = $nombreEmpresa;
        $this->imagen = $imagen;
        $this->desc = $desc;
        $this->enlace = $enlace;
    }

    // Consultar/Crear anuncio aleatorio y mandarlo para mostrar
    //  Return object Anuncio
    
    public static function create_advert(){

        $app = Aplicacion::getInstancia();
        $conn = $app->getConexionBd();
        $sql = "SELECT * FROM publicidad";
        $result = @mysqli_query($conn, $sql);
        
        $nAnuncios = $result->num_rows;
        $advert_index = rand(1,$nAnuncios);
        $cont = 0;
        $fila = 0;
        // Avanzamos hasta llegar al anuncio que queremos mostrar
        while($cont <= $advert_index-1){
            $fila = @mysqli_fetch_array($result);
            $cont++;
        }

        // Creamos el anuncio
        $advert = new Anuncio($fila["IdPublicidad"],$fila["nombreEmpresa"],$fila["imagen"],$fila["descripcion"],$fila["enlace"]);
        $result->free();

        // Devolvemos el objeto anuncio
        return $advert;
    }

    // Crea elemento anuncio
    private function crearElem($fila){
        return new Anuncio($fila["IdPublicidad"],$fila["nombreEmpresa"],$fila["imagen"],$fila["descripcion"],$fila["enlace"]);
    }

    // Sets | Gets

    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombreEmpresa;
    }

    public function getImagen(){
        return $this->imagen;
    }
    public function getDesc(){
        return $this->desc;
    }

    public function getEnlace(){
        return $this->enlace;
    }
}

