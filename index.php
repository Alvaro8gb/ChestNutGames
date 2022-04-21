<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/vistas/helpers/utils.php';

$css_pages = array("index.css","header.css","button.css");
$css = "";	

foreach($css_pages as $elem){
	$css .= link_css($app->resuelve(RUTA_CSS.$elem));
}

?>

<!DOCTYPE html>
<html lang='es'>
	<head>
		<title> Home </title>
		<link rel="icon" href= "<?= RUTA_IMGS."logo/Favicon.png" ?>" type="image/png">
		<?= $css."\n" ?>
	</head>
	<body>

			<div class = "wrapper">
				<div class = "parallax_section">
					<div class = "parallax_level1"></div>

						<header>
								<img id="logo" src= "<?=$app->resuelve(RUTA_IMGS."logo/Chestnut_Logo.png")?>" alt="logo" >
								<h1> ChestNut Games </h1>
									<?php
										$_GET['type']="home";
										$app->doInclude("/vistas/comun/header.php");
									?>		
						</header>
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