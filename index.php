<?php
require_once __DIR__.'/includes/config.php';
$tituloPagina = 'Home';
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href= <?php echo RUTA_CSS."index.css"; ?> />
		<link rel="stylesheet" type="text/css" href= <?php echo RUTA_CSS."header.css"; ?> />
		<link rel="icon" href= <?php echo RUTA_IMGS."logo/Favicon.png"; ?> type="image/png">
		<title><?= $tituloPagina ?></title>
	</head>
	<body>

			<div class = "wrapper">
				<div class = "parallax_section">
					<div class = "parallax_level1"></div>

						<header>
								<img id="logo" src= <?php echo RUTA_IMGS."logo/Chestnut_Logo.png"; ?> alt="logo" >
								<h1> ChestNut Games </h1>
									<?php
										$_GET['type']="home";
										$app->doInclude("/vistas/comun/header.php");
									?>

							<p id="inicio">
								Nuestra aplicación web trata de un portal web de minijuegos que puedes disfrutar en
								cualquier momento o lugar, enfocada a todos los públicos, nuestros minijuegos se centran
								en darte la mejor diversión con títulos que siempre has conocido como: Las damas, La oca,
								Conecta 4, Tres en raya, Parchís, 2048... y muchos más.
								Además, si se registra podrá disfrutar de todos los maravillosos juegos y competir con otros
								jugadores comparándose en nuestro ranking por juego.
								La aplicación tiene como base de financiación la publicidad y la suscripción de usuarios, los
								cuales disfrutarán de ventajas y mayores posibilidades en la web.
                    		</p> 		
						</header>
				</div>

				<div class = "parallax_section">
					<div class = "parallax_level2"></div>
						
						<main>
								<!-- Main Page -->
						</main>

						<footer>
								<!-- Aqui ira el pie de pagina -->
						</footer>

				</div>
			</div>

	</body>
</html>