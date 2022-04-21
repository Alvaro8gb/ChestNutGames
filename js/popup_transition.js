// Ocultar anuncio
function advert_close() {

    document.getElementById("pop_up").style.opacity = 1;
    document.getElementById("modal").style.opacity = 0;
    document.getElementById("modal").style.visibility = "hidden";
}

// Mostrar anuncio
function advert_show() {
    document.getElementById("pop_up").style.opacity = 0.2;
    document.getElementById("modal").style.opacity = 1;
    document.getElementById("modal").style.visibility = "visible";      
}

   