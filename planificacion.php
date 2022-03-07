<?php
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Planificación';

$contenidoPrincipal = <<<EOS
        <h2>Proceso</h2>
                <p>
                    A lo largo del proyecto con intención de regular el uso de buenas prácticas y controlar el avance del mismo, 
                    el equipo usará Scrum permitiendo así trabajar de forma colaborativa y organizada.
                </p>
                <br>
                El Scrum Master será Petar Konstantinov Ivanov quien tendrá una reunión semanal con el resto del grupo (preferiblemente al comienzo o final de la semana con la intención de fijar objetivos para la misma), 
                Buscamos repartir el trabajo de forma equitativa y eficiente, para ello y por el momento dividiremos el grupo en un total de 3 subgrupos donde los miembros se dedicaran a tareas del mismo ámbito, la 
                determinación de grupos será la siguiente:

                <h3>>> Subgrupos </h3>
                <ol>
                    <li>Sergio Lorente Bausela y Víctor Moreno Pérez</li>
                    <li>Pablo Sanchéz-Rodilla Serrano y Petar Konstantinov Ivanov</li>
                    <li>Álvaro García Barragán y David Candil Villacastín</li>
                </ol>
                

            <h3> >> Herramientas de ayuda al control</h3>
                <p>
                    Para mantener un control sobre en que estado se encuentra cada tarea hemos decidido el empleo GitHub con su herramienta para ello,donde dividiremos en cuatro columnas según su estado: 
                </p>
                <ul>
                    <li>Investigación</li>
                    <li>Desarrollo</li>
                    <li>Revisión</li>
                    <li>Finalizada</li>
                </ul>
                

            <h3> >> Objetivos y fechas clave </h3>
                <p>
                    Hemos decidido de forma orientativa las fechas y objetivos de nuestro proyecto basándonos en una aproximación según las fechas de entrega para distintas versiones y el alcance que pretendemos conseguir:
                </p>
                <table>
                    <tr>
                        <th colspan = 3>Resumen de hitos</th>
                    </tr>
                    <tr>
                        <th>Fecha</th>
                        <th>Objetivo</th>
                        <th>Descripción</th> 
                    </tr> 
                    <tr>
                        <td>  </td>
                        <td> Designar tareas/funcionalidades </td>
                        <td>  </td>
                    </tr>
                    <tr>
                        <td>  </td>
                        <td> Estructurar la página </td>
                        <td>  </td>
                    </tr>
                    <tr>
                        <td>  </td>
                        <td> Hoja de ruta </td>
                        <td>  </td>
                    </tr>
                    <tr>
                        <td>  </td>
                        <td> Descripción de negocio </td>
                        <td>  </td>
                    </tr>
                    <tr>
                        <td> 25-2-2022 </td>
                        <td> ENTREGA PR1 </td>
                        <td>  </td>
                    </tr>
                    <tr>
                        <td>  </td>
                        <td> Creación prototipos de páginas </td>
                        <td> Creación de archivos html-php, determinación de minijuegos y estructuramiento de sus bases </td>
                    </tr>
                    <tr>
                        <td>  </td>
                        <td> Determinar elementos de gestión </td>
                        <td> En relación con la gestión o bases de datos, por ejemplo: Usuarios, Puntos, Publicidad... </td>
                    </tr>
                    <tr>
                        <td> 18-3-2022 </td>
                        <td> ENTREGA PR2 </td>
                        <td>  </td>
                    </tr>
                    <tr>
                        <td>  </td>
                        <td> Diseño del estilo de la aplicación </td>
                        <td> Uso de CSS y e imagen comercial de la página (colores, fuente...) </td>
                    </tr>
                    <tr>
                        <td>  </td>
                        <td> Finalización de la funcionalidad básica establecida en la etapa previa </td>
                        <td> Entorno a un 50% de la página debería estar ya realizada </td>
                    </tr>
                    <tr>
                        <td> 8-4-2022 </td>
                        <td> ENTREGA PR3 </td>
                        <td>  </td>
                    </tr>
                    <tr>
                        <td>  </td>
                        <td> HITOS POR DEFINIR </td>
                        <td>  </td>
                    </tr>
                    <tr>
                        <td> 6-5-2022 </td>
                        <td> ENTREGA PR4 </td>
                        <td>  </td>
                    </tr>
                </table>
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';