<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <link rel="icon" href="img/logo/Favicon.png" type="image/png">
    <link rel="stylesheet" href="css/estilos.css" type="text/css">
	<title>Registro</title>
</head>
<body>
    <div class = "formulario">
        <form action="" method="post">
        <fieldset>
            <legend>Datos personales</legend>
                <label for="email">Correo electrónico:</label>
                <br><input type="email" id="email" name="mail"><br>
                Nombre:<br> <input type="text" name="nom" required><br>
                Contraseña:<br> <input type="password" name="pas" required><br>
                Repetir contraseña:<br> <input type="password" name="pas1" required><br>		
        </fieldset>
        <input type="submit" name="aceptar">	
        </form>
    </div>

    <?php
        if(isset($_POST['nom']) && isset($_POST['pas']) && isset($_POST['pas1']) && isset($_POST['mail'])){
            $db = new mysqli('localhost', 'root', '', 'chesnutgames');

            if($db->connect_error){
                echo '<h1>No se ha podido conectar a la base de datos</h1>';
            }
            else{
                $usuario = $_POST['nom'];
                $contrsenia = $_POST['pas'];
                $contrsenia1 = $_POST['pas1'];
                $correo = $_POST['mail'];

                if($contrsenia == $contrsenia1){
                    $sql = "INSERT INTO usuarios VALUES('$usuario','$contrsenia','$correo')";
                    $sql1 = "SELECT correo FROM usuarios WHERE correo = '$correo'";
                    $q1 = $db->query($sql1);

                    if($q1->num_rows > 0){
                        echo '<h1>Usuario existente, <a href = "login.php" >inicie sesión</a></h1>';
                    }
                    else{
                        $q = $db->query($sql);
                        if($q){
                            echo '<h1>Usuario creado, inicie sesión</h1>';
                            header("refresh:1;url=login.php");
                        }
                        else{
                            echo '<h1>Error, no se ha pudido crear el usuario</h1>';
                        }
                    }

                    $db->close();
                }
                else{
                    echo '<h1>Las contrseñas no coinciden</h1>';
                }
            }
        }
    ?>

</body>
</html>