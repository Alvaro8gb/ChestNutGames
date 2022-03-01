<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <link rel="icon" href="img/logo/Favicon.png" type="image/png">
        <link rel="stylesheet" href="css/estilos.css" type="text/css">
        <title>Log In</title>
    </head>


    <body>

        <header>  
                <?php 
                    require("menu.php");       
                ?>
        </header>
        <div class = "formulario">
            <form action="" method="post">
            <fieldset>
                <legend>Datos personales</legend>
                    Nombre:<br> <input type="text" name="nom" required><br>
                    Contraseña:<br> <input type="password" name="pas" required><br>		
            </fieldset>
            <input type="submit" name="aceptar">	
            </form>
            <h3>Sino tines cuenta te puedes <a href = "registro.php" >registrar</a></h3>
        </div>

        <?php

            if(isset($_POST['nom']) && isset($_POST['pas'])){
                $db = new mysqli('localhost', 'root', '', 'chesnutgames');

                if($db->connect_error){
                    echo '<h1>No se ha podido conectar a la base de datos</h1>';
                }
                else{
                    $usuario = $_POST['nom'];
                    $contrsenia = $_POST['pas'];

                    $sql = "SELECT * FROM usuarios WHERE nombre = '$usuario' AND contrasenia = '$contrsenia'";
                    $q = $db->query($sql);

                    if($q->num_rows > 0){
                        header("Location:index.php");
                    }
                    else{
                        echo '<h1>Usuario o contraseña no válido, sino te puedes <a href = "registro.php" >registrar</a></h1>';
                    }

                    $db->close();
                }
            }
        ?>

    </body>
</html>