<?php

namespace es\chestnut\carrito;

class ElemCarrito{
    
    private $idProducto;
    private $idEnTienda;
    private $nombre;
    private $precio;
    private $cantidad;
    private $imagen;

    public function __construct($idProducto,$idEnTienda, $nombre,  $cantidad, $precio, $imagen ){
        $this->idProducto = $idProducto;
        $this->idEnTienda = $idEnTienda;
        $this->nombre = $nombre;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
        $this->imagen = $imagen;
    }

    public function getIdProducto(){
        return $this->idProducto;
    }

    public function getIdEnTienda(){
        return $this->idEnTienda;
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

