<?php
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Memoria';

$contenidoPrincipal = <<<EOS
        <h1>Memoria</h1>

                <p> En la entrega anterior definimos la fase inicial del proyecto, en ella determinamos los objetivos a cumplir
                y orientamos el alcance de nuestro proyecto, con esto pudimos dividir la funcionalidad de la página en módulos
                independientes y administrar su desarrollo de forma más eficiente. La página comparte una estructura común
                a nivel visual, la totalidad de las páginas implementan una plantilla donde se define un menú, pie de pagina, estilo
                y estructuramiento a nivel de código, además de dar una imagen de unidad y profesionalidad </p>
                
                <p> A continuación describimos los puntos generales de esta entrega </p>

        <h3> >> Lista de scripts para vistas </h3>

                <p> Definimos como scripts para vistas a aquellos que su función es mostrar visualmente al usuario su interacción
                con la página, en este caso debemos listar: </p>

                        <ul>
                                <li>plantilla.php  -- (Indicar el objetivo de cada uno) </li>
                                <li>menu.php</li>
                                <li>home.php</li>
                                <li>juegos.php</li>
                                <li>ranking.php</li>
                                <li>registro.php </li>
                                <li>contacto.php</li>
                                <li>...</li>

                        </ul>

        <h3> >> Lista de scripts adicionales </h3>

                <p> Definimos como scripts adicionales aquellos destinados a la lógica, definición de clases y el manejo
                y funcionamiento de la base de datos, entre otras funciones, debemos listar a: </p>

                        <ul>
                                <li>login.php  -- (Indicar el objetivo de cada uno) </li>
                                <li>logout.php</li>
                                <li>procesarJuego.php</li>
                                <li>procesarLogin.php</li>
                                <li>procesarRegistro.php</li>
                                <li>**Deberiamos hacer un procesaRanking.php, e igual para los juegos,
                                dejar de forma independiente las funciones php, en otro archivo, despues hacer include**</li>
                                <li>...</li>
                                <li></li>

                        </ul>

        <h3> >> Estructura de la base de datos </h3>

                <p> La base de datos define una estructura con sus núcleos focalizados en una tabla principal para cada módulo,
                es decir, el módulo juegos tiene una tabla principal con el grueso de la información de la funcionalidad,
                aunque también produce tablas secundarias con información necesaria y referenciada para la correcta integridad de los datos
                como en el caso de la tabla categorías </p>

                <p> El acceso a la BD se realiza a través de un objeto Aplicación, que se encarga de conexión con la base de datos,
                esta conexión es única, es importante restringir y determinar una única conexión a nuestra base de datos para las consultas
                por seguridad, eficiencia y correcta aplicación de los métodos. Para ello el objeto Aplicación será de tipo estático,
                único para todo aquel que busque acceder a la base de datos, asegurando así que solo creamos una conexión con esta </p>

                <p> En referencia con la información y las tablas de la base de datos, debemos listar las siguientes: </p>
                
                <h4> Juegos </h4>
                        <p> ** INCLUIR CODIGO DE TABLA HTML AQUI ** </p>
                        <p> ** Indicar campos de la tabla ** </p>
                        <p> ** Indicar relaciones ** </p>
                        <p> ** Indicar scripts que acceden a esta ** </p>


                <h4> Categorias </h4>
                        <p> ** INCLUIR CODIGO DE TABLA HTML AQUI ** </p>
                        <p> ** Indicar campos de la tabla ** </p>
                        <p> ** Indicar relaciones ** </p>
                        <p> ** Indicar scripts que acceden a esta ** </p>

                        
                <h4> **LISTAR TODAS** </h4>

        <h3> >> Prototipo del proyecto </h3>
                <p> ** Describir que hemos implementado hasta el momento y detallar proximos objetivos </p>

EOS;

require __DIR__.'/includes/plantillas/plantilla.php';