<?php

namespace es\chestnut\tienda;
use es\chestnut\Lista;

class Tienda extends Lista{
    private const TABLE ="Tienda";

    public function __construct(){
        parent::__construct(self::TABLE);
    }

    protected function crearElem($fila){
        return new Producto($fila["IdProducto"],null,null,null,null,null);
    }
}