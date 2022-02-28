<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8"/>
        <link rel="icon" href="img/logo/Favicon.png" type="image/png">
        <link rel="stylesheet" href="css/estilos.css" type="text/css">

        <title>Detalles de la pagina</title>
    </head>
    <body>

        <header>
        <?php 
            require("menu.php");       
        ?>
         </header>

        <main>
            <h2>Introducción</h2>
            <h4>¿Qué hace la aplicación? ¿Cuáles son sus funcionalidades?</h4>

            <p> ChestNutGames es una aplicación web que ofrece diversos minijuegos a los usuarios para enfrentar los ratos
                de aburrimiento con mucha diversión. Esta aplicación contiene una variedad de juegos de distintos temas para 
                que el usuario disfrute en cualquier momento y de cualquier forma. Ofrecemos diversión a nuestros jugadores casuales
                con juegos que podrán jugar sin necesidad de disponer de tiempo allá donde quieran, así como a nuestros jugadores más dedicados
                con juegos con la competitividad de más alto nivel 
                <br><br>
                Buscamos llegar al mayor número de personas. Se trata de una propuesta compatible con diferentes sistemas y dispositivos que ofrece un sin fin de opciones 
                para pasar un rato agradable. El rango de edades compatible con la aplicación se extiende a todas las edades. 
                <br><br>
                La aplicación por el momento no ofrece la posibilidad de jugar con/contra otros jugadores (amigos,
                familiares, ...). El único modo de competición es contra el propio juego, una máquina virtual que actúa según
                la inteligencia artificial implementada.
            </p>

            <h4>¿Cual es su funcionamiento?</h4>

                <p> La aplicación se presenta totalmente gratuita para todos los usuarios sin necesidad de registro o subscripción.
                    No obstante. Tras un tiempo limitado (límite de juego) que la aplicación ofrece a los usuarios para probar cada uno de los minijuegos,
                    será necesario el registro en la aplicación para seguir disfrutando de las funcionalidades de la aplicación. Además, 
                    aquel usuario que lo desee, podrá suscribirse con el pago una razonable cuota mensual que le permitirá gozar de diferentes ventajas
                    como son la posibilidad del juego anticipado a nuevos juegos previamente a su estreno, la identificación y representación en el ranking de la web,
                    además de la posibilidad de obtener una infinidad de premios y objetos especiales.
                </p>

            <h2>Tipos de usuarios</h2>

            <p> Como hemos descrito antes, los usuarios podrán ser de 3 tipos: usuarios sin registrar, usuarios registrados y usuarios +premium. Todos ellos tienen unas capacidades y limitaciones diferentes,
                además de ventajas y prioridades. </p>

                <table>
                    <tr>
                        <th colspan = 5> TIPOS DE USUARIOS </th>
                    </tr>
                    <tr>
                        <th> Usuario </th>
                        <th> Publicidad </th>
                        <th> Ranking </th>
                        <th> Juegos </th> 
                        <th> Subscripción</th>  
                    </tr> 
                    <tr>
                        <td> Usuario sin registrar </td>
                        <td> SI </td>
                        <td> NO </td>
                        <td> Acceso restringido </td>
                        <td> X </td>
                    </tr>
                    <tr>
                        <td> Usuario registrado </td>
                        <td> SI </td>
                        <td> SI</td>
                        <td> Acceso total </td>
                        <td> X </td>
                        
                    </tr>
                    <tr>
                        <td> +Premium </td>
                        <td> NO </td>
                        <td> SI </td>
                        <td> Acceso total y anticipado </td>
                        <td> Por definir </td>
                        
                    </tr>
                </table>

                <h2>Funcionalidades </h2>

                <p> Nuestra aplicación se va a dividir estructuralmente en 6 funcionalidades (por definir el reparto exacto del peso entre los miembros) diferentes, estas son:</p>
                <ul>
                    <li>Gestión de Minijuegos</li>
                    <li>Gestión de Ranking</li>
                    <li>Gestión de Publicidad</li>
                    <li>Gestión de Usuarios</li>
                    <li>Gestión de Eventos</li>
                    <li>Gestión de Puntos y Tienda</li>
                </ul>
                
        </main>
    </body>
</html>