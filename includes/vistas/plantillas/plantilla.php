<?php

$params['app']->doInclude('/vistas/helpers/plantilla.php');
$mensajes = mensajesPeticionAnterior();

?>

<!DOCTYPE html>
<html lang='es'>

	<head>
		<title><?= $params['tituloPagina'] ?></title>
		<link rel="icon" type="image/png" href="<?= $params['app']->resuelve(RUTA_IMGS.'logo/Favicon.png') ?>" />

		<link rel="stylesheet" type="text/css" href="<?= $params['app']->resuelve(RUTA_CSS.'general.css') ?>" />
		<link rel="stylesheet" type="text/css" href="<?= $params['app']->resuelve(RUTA_CSS.'header.css') ?>" />
		<link rel="stylesheet" type="text/css" href="<?= $params['app']->resuelve(RUTA_CSS.'button.css')?>" />
		<link rel="stylesheet" type="text/css" href="<?= $params['app']->resuelve(RUTA_CSS.'popup.css')?>" />
		<?php if(isset($params["css"])) echo "\n\t\t".$params["css"]."\n"; ?>

		<?php if(isset($params["js"])) echo "\n\t\t".$params["js"]."\n"; ?>
		<script src="<?= $params['app']->resuelve(RUTA_JS.'popup_transition.js')?>"></script> 
		<script src="<?= $params['app']->resuelve(RUTA_JS.'general.js')?>?v=<?php echo(rand()); ?>"></script> 
	
	</head>

	<body>

		<!-- POP UP  -->
		<?php		// La aparicion del pop up depende de cada pagina individualmente
			$params['app']->doInclude('/vistas/comun/popup.php');			
		?> 	
			
		<div class = "pop_up" id = "pop_up">

			<header>
				<?php
					$params['app']->doInclude('/vistas/comun/header.php');
				?>
			</header>

			<main>
					<?= $mensajes ?>
					<?= $params['contenidoPrincipal'] ?>
			</main>

			<footer>
				<?php
					$params['app']->doInclude('/vistas/comun/footer.php');
				?>
			</footer>

		</div>
	</body>
</html>

