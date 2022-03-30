<?php
$params['app']->doInclude('/vistas/helpers/plantilla.php');
$mensajes = mensajesPeticionAnterior();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
    <title><?= $params['tituloPagina'] ?></title>
	<link rel="stylesheet" type="text/css" href="<?= $params['app']->resuelve( RUTA_CSS.'general.css') ?>" />
	<link rel="stylesheet" type="text/css" href="<?= $params['app']->resuelve(RUTA_CSS.'header.css') ?>" />
	<link rel="icon" type="image/png" href="/img/logo/favicon.ico" />
</head>

<body>
	<?= $mensajes ?>
	
	<header>
		<?php
			$params['app']->doInclude('/vistas/comun/header.php');
		?>
	</header>

	<main>
		<article>
			<?= $params['contenidoPrincipal'] ?>
		</article>
	</main>

	<footer>
		<?php
			$params['app']->doInclude('/vistas/comun/footer.php');
		?>
	</footer>

</body>
</html>
