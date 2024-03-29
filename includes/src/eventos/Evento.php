<?php

namespace es\chestnut\eventos;

class Evento{
    
    private $idEvento;
    private $nombre;
    private $imagen;
    private $desc;
    private $fechaInicio;
    private $fechaFin;
    private $premio;
    private $idJuego;

    public function __construct($idEvento, $nombre, $imagen, $desc, $fechaInicio, $fechaFin, $idJuego, $premio ){
        $this->id = $idEvento;
        $this->nombre = $nombre;
        $this->imagen = $imagen;
        $this->desc = $desc;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->idJuego = $idJuego;
        $this->premio = $premio;
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

    public function getFechaInicio(){
        return $this->fechaInicio;
    }

    public function getFechaFin(){
        return $this->fechaFin;
    }

    public function getIdJuego(){
        return $this->idJuego;
    }

    public function getPremio(){
        return $this->premio;
    }
}

