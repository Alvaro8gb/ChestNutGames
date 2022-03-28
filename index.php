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