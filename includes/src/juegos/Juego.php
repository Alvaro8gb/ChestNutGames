<?php

namespace es\chestnut\juegos;

class Juego{
    private $id;
    private $nombre;
    private $imagen;
    private $desc;
    private $categoria;
    private $enlace;

    public function __construct($id, $nombre, $imagen, $desc, $categoria, $enlace ){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->imagen = $imagen;
        $this->desc = $desc;
        $this->categoria=$categoria;
        $this->enlace=$enlace;
    }

    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getImagen(){
        return $this->imagen;
    }
    public function getDesc(){
        return $this->desc;
    }

    public function getCategoria(){
        return $this->categoria;
    }

    public function getEnlace(){
        return $this->enlace;
    }
}

