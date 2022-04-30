<?php

namespace es\chestnut\carrito;

use es\chestnut\Aplicacion;
use es\chestnut\Formulario;

class FormularioAdd2Carrito extends Formulario{

    private $idProducto;
    private $idEnTienda;
    private $cantidad ;
    private $nombre;
    private $precio;
    private $imagen;

    public function __construct($idProducto,$idEnTienda, $cantidad, $nombre, $precio, $imagen) {
        parent::__construct('formAddCarrito', ['urlRedireccion' => Aplicacion::getInstancia()->resuelve('/carrito.php')]);
        $this->idProducto = $idProducto;
        $this->idEnTienda = $idEnTienda;
        $this->cantidad = $cantidad;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->imagen = $imagen;
    }
    
    protected function generaCamposFormulario(&$datos){

        $cantidad_seleccionada = $datos["cantidad_prod"] ?? 0;

        $html = <<<EOS
            <p class="txtpr1"><b>Cantidad a comprar:</b></p>
                <input class="cantidad_prod" required type ="number" name ="cantidad_prod"  id="campoCantidad" value="$cantidad_seleccionada"><span id="validCantidad"></span>
                <input class="id_oculto" type ="number" name ="cantidad" id="valida" value="{$this->cantidad}">
                <input class="id_oculto" type ="number" name ="id_producto" value ="{$this->idProducto}">
                <input class="id_oculto" type ="number" name ="id_en_tienda" value ="{$this->idEnTienda}">
                <input class="id_oculto" name ="nombre_producto" value ="{$this->nombre}">
                <input class="id_oculto" type="hidden" name ="imagen_producto" value ="{$this->imagen}">
                <input class="id_oculto" type ="number" name ="precio_producto" value ="{$this->precio}">

                <div class="car">
                    <input class="anyadir_carrito" type="submit" value="Añadir al carrito">
                </div>
        
            EOS;

        return $html;
    }
    

    protected function procesaFormulario(&$datos){

        $this->errores = [];
        $cantidadProd = trim($datos['cantidad_prod'] ?? '');
        $cantidadProd = filter_var($cantidadProd, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ( ! $cantidadProd || empty($cantidadProd) ) {
            $this->errores['cantidadProd'] = 'No se ha introducido la cantidad';
        }
    
        if (count($this->errores) === 0) {
            
            $app = Aplicacion::getInstancia();
            $carrito = $app->getCarrito();
    
            $id_carrito = count($carrito);
            $idProducto = $datos["id_producto"] ;
            $idEnTienda = $datos["id_en_tienda"] ;
            $nombre = $datos["nombre_producto"] ;
            $imagen = $datos["imagen_producto"] ;
            $precio = $datos["precio_producto"] ;
    
            $carrito[$id_carrito] = new ElemCarrito($idProducto,$idEnTienda,$nombre,$cantidadProd,$precio,$imagen);

            $app->updateCarrito($carrito);
        }
        
    }
}