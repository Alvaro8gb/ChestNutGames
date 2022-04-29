<?php

namespace es\chestnut\carrito;

class ElemCarrito{
    private $nombre;
    private $precio;
    private $cantidad;
    private $imagen;

    public function __construct($id, $nombre,  $cantidad, $precio, $imagen ){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
        $this->imagen = $imagen;
    }

    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getCantidad(){
        return $this->cantidad;
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function getImagen(){
        return $this->imagen;
    }

    public function setCantidad($cantidad){
       $this->cantidad = $cantidad;
    }

}

