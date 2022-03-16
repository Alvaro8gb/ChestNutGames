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
                                <li>plantilla.php >> Define una estructura común para todas las páginas de la web </li>
                                <li>index.php >> Página principal de la aplicación </li>
                                <li>menu.php >> Menú para navegar por la web. Incluido en la cabecera </li> 
                                <li>juegos.php >> Página pricipal de los juegos. Muestra los juegos disponibles </li>
                                <li>ranking.php >> Página del ranking. Muestra las tablas de ranking de cada juego </li>
                                <li>registro.php >> Formulario de registro. Permite al usuario darse de alta en la página </li>
                                <li>contacto.php >> Formulario de contacto </li>
                                <li>login.php >> Formulario de login. Permite al usuario iniciar sesión en la página </li>
                                <li>logout.php >> Permite al usuario cerrar sesión en la página. Muestra un mensaje de despedida y redirige al home </li>
                                <li>footer.php >> Pie de página. Incluido en la plantilla </li>
                                <li>header.php >> Cabecera. Incluido en la plantilla </li>
                        </ul>

        <h3> >> Lista de scripts adicionales </h3>

                <p> Definimos como scripts adicionales aquellos destinados a la lógica, definición de clases y el manejo
                y funcionamiento de la base de datos, entre otras funciones, debemos listar a: </p>

                        <ul>
                                <li>Aplicacion.php >> Define una clase que se encarga de la conexión ÚNICA con la base de datos </li>
                                <li>config.php >> Define las propiedades generales de toda la página </li>
                                <li>procesarJuego.php >> Se encarga el procesamiento específico para cada juego solicitado y así mostrar su información </li>
                                <li>procesarLogin.php >> Se encarga de llevar a cabo las operaciones pertinentes en el inicio de sesión con la base de datos y la sesión del usuario </li>
                                <li>procesarRegistro.php >> Se encarga de las operaciones necesarias en el correcto registro del usuario. Conecta y registra al usuario en la base de datos </li>
                                <li>utils.php >> Auxiliar. Para los enlaces externos a la página </li>

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

                <p> En relación con la información y las tablas de la base de datos, debemos listar las siguientes: </p>
                
                <h4> Usuarios </h4>
                        <table> 
                                <tr> 
                                        <th> Id </th>
                                        <th> NombreUsuario </th>
                                        <th> Nombre </th>
                                        <th> Password </th>
                                        <th> Rol </th>
                                        <th> Correo</th>
                                </tr>
                                <tr>
                                        <td> int </td>
                                        <td> varchar </td>
                                        <td> varchar </td>
                                        <td> varchar </td>
                                        <td> varchar </td>
                                        <td> varchar </td>

                                </tr>
                        </table>

                        <p> Cada campo de la tabla tiene como objetivo: </p>
                                <ul>
                                        <li> Id: Identificar al usuario de forma única, actua de clave primaria en la base de datos </li>
                                                <ul><li> El campo 'id' tiene relación como clave foránea con 'idJugador' en la tabla de Ranking </li> </ul>
                                        <li> NombreUsuario: Nombre proporcionado por el usuario para su identificación </li>
                                        <li> Nombre: Nombre real del usuario </li>
                                        <li> Password: Contraseña del usuario para su identificación </li>
                                        <li> Rol: Tipo de usuario (usuario/administrador) </li>
                                        <li> Correo: Correo electrónico </li>
                                </ul>

                        <p> A esta tabla acceden y/o modifican sus datos los siguientes scripts: </p>
                                <ul>
                                        <li>  </li>
                                </ul>


                <h4> Ranking </h4>
                        <table> 
                                <tr> 
                                        <th> IdJuego </th>
                                        <th> IdJugador </th>
                                        <th> Puntuacion </th>
                                </tr>
                                <tr>
                                        <td> int </td>
                                        <td> int </td>
                                        <td> int </td>
                                </tr>
                        </table>

                        <p> Cada campo de la tabla tiene como objetivo: </p>
                                <ul>
                                        <li> IdJuego: Identificar el juego de forma única en la base de datos, necesario para identificar el juego en el ranking </li>
                                                <ul><li> Este campo viene proporcionado por 'idJuego' de la tabla Juegos </li> </ul>
                                        <li> IdJugador: Identifican al usuario de forma única en la base de datos, necesario para su identificación en el ranking </li>
                                        <li> Puntuacion: Número ttoal de puntos obtenidos por el usuario en dicho juego </li>
                                </ul>
                                
                        <p> A esta tabla acceden y/o modifican sus datos los siguientes scripts: </p>
                                <ul>
                                        <li>  </li>
                                </ul>

                <h4> Juegos </h4>
                        <table> 
                                <tr> 
                                        <th> IdJuego </th>
                                        <th> Nombre </th>
                                        <th> Imagen </th>
                                        <th> Descripcion </th>
                                        <th> Categoria </th>
                                        <th> Enlace </th>
                                </tr>
                                <tr>
                                        <td> int </td>
                                        <td> varchar </td>
                                        <td> longblob </td>
                                        <td> varchar </td>
                                        <td> varchar </td>
                                        <td> varchar </td>
                                </tr>
                        </table>

                        <p> Cada campo de la tabla tiene como objetivo: </p>
                                <ul>
                                        <li> IdJuego: Identifica de forma única al juego en la base de datos, actua de clave primaria </li>
                                        <li> Nombre: Nombre del juego </li>
                                        <li> Imagen: Imagen identificativa del juego en la página de juegos </li>
                                        <li> Descripcion: Breve descripción del juego mostrada en la página del mismo </li>
                                        <li> Categoría: Categoría a la que pertenece el juego, necesario para filtrar los juegos en base a ello </li>
                                        <li> Enlace: Link externo a la página del juego </li>
                                </ul>
                                
                        <p> A esta tabla acceden y/o modifican sus datos los siguientes scripts: </p>
                                <ul>
                                        <li>  </li>
                                </ul>



                <h4> Categorías </h4>
                        <table> 
                                <tr> 
                                        <th> Nombre </th>
                                </tr>
                                <tr>
                                        <td> varchar </td>
                                </tr>
                        </table>

                        <p> Podemos considerar esta tabla como 'auxiliar', puesto que su objetivo es soportar a la tabla juegos en su campo de 'categoría'
                        y así proporcionar consistencia en los datos al definir las categorías posibles: </p>
                                <ul>
                                        <li> Nombre: Nombre de la categoría, actua de clave primaria </li>
                                                <ul><li> Este campo se relaciona con la tabla Juegos, en categoría </li> </ul>

                                </ul>
                                
                        <p> A esta tabla acceden y/o modifican sus datos los siguientes scripts: </p>

                                <ul>
                                        <li>  </li>
                                </ul>                                

        <h3> >> Prototipo del proyecto </h3>

        <p> Para esta entrega hemos realizado 3 de las 6 funcionalidades que implementará nuestra aplicación. Hemos desarrollado 
        la gestión de usuarios, la gestión de ranking y la gestión de juegos. </p>

EOS;

require __DIR__.'/includes/plantillas/plantilla.php';