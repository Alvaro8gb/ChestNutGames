<?php

namespace es\chestnut\tienda;

class Producto{
    private $id;
    private $nombre;
    private $imagen;
    private $desc;
    private $categoria;
    private $precio;
    private $cantidad;

    public function __construct($id, $nombre, $desc, $categoria, $precio, $imagen,$cantidad ){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->imagen = $imagen;
        $this->desc = $desc;
        $this->categoria = $categoria;
        $this->precio = $precio;
        $this->cantidad=$cantidad;
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

    public function getPrecio(){
        return $this->precio;
    }

    public function getCantidad(){
        return $this->cantidad;
    }
}

