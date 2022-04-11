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
		<link rel="stylesheet" type="text/css" href="<?= $params['app']->resuelve(RUTA_CSS.'popup.css')?>" />
		<?php if(isset($params["css"])) echo "\n\t\t".$params["css"]."\n"; ?>
		<link rel="icon" type="image/png" href="<?= $params['app']->resuelve(RUTA_IMGS.'logo/Favicon.png') ?>" />
	
		<!-- Link to js transition -->
		<script type="text/javascript" src=<?= $params['app']->resuelve(RUTA_JS.'popup_transition.js')?>></script> 
	
	</head>

	<body>

		<!-- POP UP  -->
		<?php		
			$params['app']->doInclude('/vistas/comun/popup.php');			
		?> 	
	
		<div class = "pop_up" id = "pop_up">

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
			</main>

			<footer>
				<?php
					$params['app']->doInclude('/vistas/comun/footer.php');
				?>
			</footer>

		</div>

		<!-- Mostrar anuncio -->
		<?php 
			if($params['app']->show_advert())
				echo '<script type="text/javascript"> advert_show(); </script>';	
		?>
	</body>
</html>

