<?php

namespace es\chestnut\carrito;

use es\chestnut\Aplicacion;
use es\chestnut\Formulario;

class FormularioRemove2Carrito extends Formulario{

    private $idElemCarrito;
    private $cantidad;

    public function __construct($idElemCarrito, $cantidad) {
        parent::__construct('formAddCarrito', ['urlRedireccion' => Aplicacion::getInstancia()->resuelve('/carrito.php')]);
        $this->idElemCarrito = $idElemCarrito;
        $this->cantidad = $cantidad;
    }
    
    protected function generaCamposFormulario(&$datos){

        $cantidad_seleccionada = $datos["cantidad_select"] ?? 0;

        $html = <<<EOS
            <input class="evil" required type ="number" name ="cantidad_select" id="campoCantidad" value ="$cantidad_seleccionada><span id="validCantidad"></span>
            <input class="id_oculto" type ="number" name ="id_cantidad" id="valida" value="{$this->cantidad}">
            <input class="id_oculto" type ="number" name ="idElemCarrito" value ="{$this->idElemCarrito}">            
            <div class="car">
                <input class="anyadir_carrito" type="submit" name="carrito" value="Eliminar unidades">
            </div>
        
            EOS;

        return $html;
    }
    

    protected function procesaFormulario(&$datos){

        $this->errores = [];
        $cantidadSelect = trim($datos['cantidad_select'] ?? '');
        $cantidadSelect = filter_var($cantidadSelect, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ( ! $cantidadSelect || empty($cantidadSelect) ) {
            $this->errores['cantidad_select'] = 'No se ha introducido la cantidad';
        }
    
        if (count($this->errores) === 0) {
            
            $app = Aplicacion::getInstancia();
            $carrito = $app->getCarrito();
            $id_carrito = $datos['idElemCarrito'];

            $elemCarrito = $carrito[$id_carrito];
            $cantidad = $elemCarrito->getCantidad();

            $nuevaCantidad = $cantidad - $cantidadSelect;

            if ($nuevaCantidad <= 0){
                unset($carrito[$id_carrito]);
                $app->updateCarrito($carrito);

            }else{
              $elemCarrito->setCantidad( $nuevaCantidad);
            }

        }
        
    }
}