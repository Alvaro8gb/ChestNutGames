<?php

require_once __DIR__.'/includes/config.php';


if(isset($_GET['buscar'])){
    // Recogemos el nombre del evento enviado a buscar
    $eventToSearch = $_GET["evento"];

    // Si está vacío, lo informamos, sino realizamos la búsqueda
    if(empty($eventToSearch)){
        $contenidoPrincipal .= '<br><p>No se ha ingresado un evento a buscar</p>';
    }
    else {
        // Conexión a la base de datos y seleccion de registros
        $conn = $app->getConexionBd();
        $sql = "SELECT nombre FROM eventos WHERE (nombre LIKE '%" . $eventToSearch . "%')";
        $consulta = @mysqli_query($conn, $sql);
        $count_results = mysqli_num_rows($consulta);

        // Si hay resultados
        if($count_results > 0){
            $contenidoPrincipal .= 
            '<br><p>El evento buscado, '.$eventToSearch.', se encuentra en nuestra página web. Deslícese sobre el siguiente
            slide colocado a continuación hasta encontrarlo.<p>';
        }
        else{
            // Si no hay resultados
            $contenidoPrincipal .= 
            '<br><p>No se encuentran resultados con los criterios de búsqueda.</p>';
        }
    }
}