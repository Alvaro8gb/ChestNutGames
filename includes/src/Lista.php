<?php

namespace es\chestnut;

abstract class Lista{

    protected $lista;

    public function __construct($table){
        $this->lista = array();
        $this->cargarLista($table);
    }
    public function getNumElements(){
        return count($this->lista);
    }
    public function getElement($id){
        if ($id < 0 || $id >= count($this->lista) ){
            throw new \Exception("Error accediendo a lista ");
        }
        return $this->lista[$id];
    }

    public function gestiona(){
        return '<html> </html>';
    }
    protected function crearElem($fila){
        return null;

    }
    protected function cargarLista($table){

        $app = Aplicacion::getInstancia();
        $conn = $app->getConexionBd();
        $sql = "SELECT * FROM $table";
        $conn = @mysqli_query($conn, $sql);
        $i = 0;
        while($fila = @mysqli_fetch_array($conn)){
            $elem = $this->crearElem($fila);
            $this->lista[$i] = $elem;
            $i++;
        }
        $conn->free();
    }
}