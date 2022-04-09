<?php
$params['app']->doInclude('/vistas/helpers/plantilla.php');
$mensajes = mensajesPeticionAnterior();
 
?>
<!DOCTYPE html>
<html lang='es'>

	<head>
		<meta charset="UTF-8">
		<title><?= $params['tituloPagina'] ?></title>
		<link rel="stylesheet" type="text/css" href="<?= $params['app']->resuelve(RUTA_CSS.'general.css') ?>" />
		<link rel="stylesheet" type="text/css" href="<?= $params['app']->resuelve(RUTA_CSS.'header.css') ?>" />
		<link rel="stylesheet" type="text/css" href="<?= $params['app']->resuelve(RUTA_CSS.'button.css')?>" />
		<?php if(isset($params["css"])) echo "\n\t\t".$params["css"]."\n"; ?>
		<link rel="icon" type="image/png" href="<?= $params['app']->resuelve(RUTA_IMGS.'logo/Favicon.png') ?>" />
	</head>

	<body>

		<!-- <div class = "pop_up"> -->

			<header>
				<?php
					$params['app']->doInclude('/vistas/comun/header.php');
				?>
			</header>

			<main>
				<article>
					<?= $mensajes ?>
					<?= $params['contenidoPrincipal'] ?>

				</article>

					<!-- INCLUDE POP UP
					<?php
						// $params['app']->doInclude('/vistas/comun/popup_plantilla.php');
					?> -->
			</main>

			<footer>
				<?php
					$params['app']->doInclude('/vistas/comun/footer.php');
				?>
			</footer>

		<!-- </div> -->
	</body>
</html>

