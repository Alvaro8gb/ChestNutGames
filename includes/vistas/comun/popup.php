<?php 

require_once __DIR__.'/../../config.php';
require_once __DIR__.'/../../src/publicidad/Anuncios.php';


$contenido = '';
$advert = es\chestnut\publicidad\Anuncio::create_advert();

// HTML POPUP

    $contenido .= '<div class = "pop_up_window" id = "modal">
        <div class = "pop_up_container"> ';

    
    // TITULO
    $contenido .= '<div class = "pop_up_title"><h1>'. $advert->getNombre() .'</h1> </div>';
    $contenido .= '<div class = "pop_up_main"> <div class = "pop_up_image">';
    
    // IMAGEN
    $contenido .= '<a href="'. $advert->getEnlace(). '">';
    $contenido .= '<img class = "popup_image" src="data:image/png;base64,'.base64_encode($advert->getImagen()).'"/></a></div>';

    // DESCRIPCION

    $contenido .= '<div class = "pop_up_desc">'; 
    $contenido .= '<p>'. $advert->getDesc() .'</p></div></div>';

    // BOTON CERRAR
    $contenido .= <<<EOS
                <div class = "pop_up_closebutton">
                    <div class = "popup_button">
                        <button type="button" class = "popup_button_link" onclick="advert_close()"> Cerrar </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    EOS;

    echo $contenido;
?>