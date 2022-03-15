<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/comun/utils.php';

$tituloPagina = 'Miembros';

$miembros = array('Petar Konstantinov Ivanov'=>'#Petar', 'Sergio Lorente Bausela'=>'#Sergio', 'Álvaro García Barragán'  => '#Alvaro'  ,
 'David Candil Villacastín' => '#David', 'Víctor Moreno Pérez' => '#Victor' , 'Pablo Sánchez-Rodilla Serrano' => '#Pablo');

$contenidoPrincipal = <<<EOS
    <div class= "memberlinks">
    <h2>Lista de Miembros</h2>
    <ol>
EOS;
    foreach($miembros as $name=>$enl){
        $contenidoPrincipal .= enlace($enl, $name);
    }

$contenidoPrincipal .= <<<EOS
    </ol>
    </div>
    <div class = member>
        <!--Apartado Petar-->
        <div class = "memberdiv">
            <a id="Petar"><h3>Petar Konstantinov Ivanov</h3></a>
            <div class = "imgdiv">
                <img src="img/members/Petar.png" alt="Petar Konstantinov Ivanov">
            </div>
            <div>
                <address>Correo electrónico: peivanov@ucm.es</address>
                <p>
                    DESCRIPCIÓN: Programador profesional de videojuegos con experiencia en EA Sports. Me encanta el fútbol
                    y soy fanático del FC Barcelona, y mi juego favorito es el FIFA. A parte soy un aficionado de la música sobre todo
                    del pop búlgaro y el rock.
                </p>
            </div>        
        </div>

        <!--Apartado Sergio-->
        <div class = "memberdiv">
            <a id="Sergio"><h3>Sergio Lorente Bausela</h3></a>
            <div class = "imgdiv">
                <img src="img/members/sergi.png" alt="Sergio Lorente Bausela">
            </div>
            <div>
                <address>Correo electrónico: sergilor@ucm.es</address>
                <p>
                    DESCRIPCIÓN: Programador experto en algoritmia, con experiencia en empresas como Microsoft, Google y Cortinas Manue.
                    Inventor y fundador de la exitosa pagina web Club Penguin que buscando un reto mayor decidio fundar junto al resto de 
                    integrantes de esta pagina.
                </p>
            </div>
        </div>
        
        <!--Apartado Alvaro-->
        <div class = "memberdiv">
            <a id="Alvaro"><h3>Álvaro García Barragán</h3></a>
            <div class = "imgdiv">
                <img src="img/members/alvaro.png" alt="Alvaro Garcia Barragan">
            </div>
            <div>
                <address>Correo electrónico: alvaga28@ucm.es</address>
                <p>
                    DESCRIPCIÓN: Estudiante de Ingeniería Informática en la FDI de la UCM 
                    En sus tiempos libres disfruta de su afición por la música, escuchandola y saliendo de pingo. 
                    El genero musical mas escuchado es el Hardstyle , en general le gusta todo tipo de música electrónica. 
                    Finalmente, es buen programador, entre los lenguajes en los que programa se encuentra Python y Java. </p>
            </div>
        </div>

        <!--Apartado David-->
        <div class = "memberdiv">
            <a id="David"><h3>David Candil Villacastín</h3></a>
            <div class = "imgdiv">
                <img src="img/members/david.png" alt="David Candil Villacastín">
            </div>
            <div>
                <address>Correo electrónico: davcan01@ucm.es</address>
                <p>
                    DESCRIPCIÓN: Estudiante de Ingeniería Informática en la Facultad de Informática de la Universidad Complutense de Madrid. 
                    En sus tiempos libres disfruta de su afición por el cine, el deporte o la mera intención de perder el tiempo.
                    Su tarea es la correcta administración del proyecto y la atención a los plazos establecidos para el desarrollo del proyecto.
                    En sus ratos libres también duerme.
                </p>
            </div>   
        </div>
        
        <!--Apartado Viti-->
        <div class = "memberdiv">
            <a id="Victor"><h3>Víctor Moreno Pérez</h3></a>
            <div class = "imgdiv">
                <img src="img/members/viti.png" alt="Victor Moreno Perez">
            </div>
            <div>
                <address>Correo electrónico: vmoren04@ucm.es</address>
                <p>
                    DESCRIPCIÓN: Soy un estudiante de Ingenieria Informática en la Universidad Complutense de Madrid. Experto en Seguridad Informática y
                    un hacha en proteger nuestra página web a toda costa, cueste lo que cueste y haya que hacer lo que se tenga que hacer.
                    Gran deportista y jugador de FIFA profesional, simplemente increíble.                       
                </p>
            </div>
        </div>
        
        <!--Apartado Pablete-->
        <div class = "memberdiv">
            <a id="Pablo"><h3>Pablo Sánchez-Rodilla Serrano</h3></a>
            <div class = "imgdiv"> 
                <img src="img/members/pablete.png" alt="Pablo Sanchez Rodilla">
            </div>
            <div>
                <address> Correo electrónico: pablsa11@ucm.es</address>
                <p>
                    DESCRIPCIÓN: Estudiante de Ingeniería Informática en la Facultad de Informática de la Universidad Complutense de Madrid. Es una persona respetuosa, 
                    amable, feliz, y gran luchador. Su afición es disfrutar de la vida misma, siempre acompañado de su familia y/o amigos.Hoy en día se ha convertido en un hombre hecho y derecho con un gran corazón y una alta capacidad
                    de desarrollo en los principales lenguajes de programación y matemáticas.
                </p>
            </div>
        </div>
    </div>

    EOS;

require __DIR__.'/includes/plantillas/plantilla.php';
  