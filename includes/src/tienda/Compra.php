<?php

namespace es\chestnut\tienda;

class Compra{
    private $id_user;
    private $id_product;
    private $cantidad;
   

    public function __construct($id_user, $id_product, $cantidad){
        $this->id_user = $id_user;
        $this->id_product = $id_product;
        $this->cantidad=$cantidad;
       
    }

    public function getIdUser(){
        return $this->id_user;
    }

    public function getIdProduct(){
        return $this->id_product;
    }

    public function getCantidad(){
        return $this->cantidad;
    }

    
}

