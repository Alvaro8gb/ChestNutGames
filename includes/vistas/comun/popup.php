<?php 


$contenido = '';
$advert = es\chestnut\publicidad\Anuncio::create_advert();

// HTML POPUP

    $contenido .= '<div class = "pop_up_window" id = "modal">
        <div class = "pop_up_container">             
            <div class = "pop_up_title">';

    
    // TITULO
    $contenido .= '<h1>'. $advert->nombreEmpresa .'</h1> </div>';
    $contenido .= '<div class = "pop_up_main"> <div class = "pop_up_image">';
    
    // IMAGEN
    $contenido .= '<a href="'. $advert->enlace. '">';
    $contenido .= '<img src= "'. $advert->imagen. '" alt= ""/></a></div>';

    // DESCRIPCION

    $contenido .= '<div class = "pop_up_desc>'; 
    $contenido .= '<p>'. $advert->desc .'</p></div></div>';

    // BOTON CERRAR
    $contenido .= <<<EOS
            <div class = "pop_up_closebutton">
                <div class = "popup_button">
                    <button type="button" class = "popup_button_link" onclick="advert_close()"> Cerrar </button>
                </div>
            </div>

        </div>
    </div>
    EOS;

    echo $contenido;
?>