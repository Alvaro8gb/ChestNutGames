<?php
require_once __DIR__.'/includes/config.php';
$tituloPagina = 'Página principal';
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/estilos.css" />
		<link rel="icon" href="img/logo/Favicon.png" type="image/png">
		<link rel="stylesheet" type="text/css" href="css/header.css" />
		<title><?= $tituloPagina ?></title>
	</head>
	<body>

		   <header>
                <img id="logo" src="img/logo/Chestnut_Logo.png" alt="logo" >
				<h1> ChestNut Games </h1>
				<?php
					$_GET['type']="home";
					require("includes/vistas/comun/header.php");
				 ?>
		   </header>

		   <main>
            <div id="text">
                    <p>
                        Nuestra aplicación web trata de un portal web de minijuegos que puedes disfrutar en
                        cualquier momento o lugar, enfocada a todos los públicos, nuestros minijuegos se centran
                        en darte la mejor diversión con títulos que siempre has conocido como: Las damas, La oca,
                        Conecta 4, Tres en raya, Parchís, 2048... y muchos más.
                        Además, si se registra podrá disfrutar de todos los maravillosos juegos y competir con otros
                        jugadores comparándose en nuestro ranking por juego.
                        La aplicación tiene como base de financiación la publicidad y la suscripción de usuarios, los
                        cuales disfrutarán de ventajas y mayores posibilidades en la web.
                    </p> 
                </div>
		    </main>

		    <footer>
		    		<!-- Aqui ira el pie de pagina -->
		    </footer>

	</body>
</html>