<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8"/>
        <link rel="icon" href="img/logo/Favicon.png" type="image/png">
        <link rel="stylesheet" href="css/estilos.css" type="text/css">
        <title>Contacta con nosotros</title>
    </head>
    <body>
        <header>
            <?php 
                require("menu.php");       
            ?> 
        </header>

        <!-- Formulario a rellenar -->
        <div class = "formulario">
            <form>      
                <fieldset>
                    <legend>Formulario de consulta</legend>
                    <!--nombre-->
                    <label>NOMBRE : </label>
                    <input type ="text" name ="nombre" value ="">
                    <br /><br />

                    <!--email-->
                    <label>EMAIL DE CONTACTO : </label>
                    <input type ="text" name ="mail" value ="">
                    <br /><br />

                    <!--motivo consulta -->
                    <label>MOTIVO DE CONSULTA : </label>
                    <br />
                    <input type="radio" name="motivo" value="evaluacion" checked/> EVALUACIÓN
                    <input type="radio" name="motivo" value="sugerencias" /> SUGERENCIAS
                    <input type="radio" name="motivo" value="criticas" /> CRÍTICAS
                    <br /><br />

                    <!--consulta-->
                    <label>CONSULTA : </label>
                    <br />
                    <textarea name="consulta" rows="10" cols="100"></textarea>
                    <!--envio de email con lo rellenado-->
                    <br /><br />

                    <!--politicas leidas-->
                    <input name="leido" type="checkbox" value="marked" /> He leido y acepto los términos y condiciones del servicio
                    <br /><br />

                    <button type = "button" onclick = 'href="mailto:sergilor@ucm.es"'>Enviar consulta</button>
                </fieldset>
            </form>
        </div>

    </body>

</html>