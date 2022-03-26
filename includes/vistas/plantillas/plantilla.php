<?php
$params['app']->doInclude('/vistas/helpers/plantilla.php');
$mensajes = mensajesPeticionAnterior();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title><?= $params['tituloPagina'] ?></title>
	<link rel="stylesheet" type="text/css" href="<?= $params['app']->resuelve('css/estilos.css') ?>" />
	<link rel="stylesheet" type="text/css" href="<?= $params['app']->resuelve('css/header.css') ?>" />
	<link rel="icon" type="image/png" href="<?= $params['app']->resuelve('/img/logo/Favicon.png') ?>" />
</head>
<body>
<?= $mensajes ?>
<?php
$params['app']->doInclude('/vistas/comun/header.php');
?>
	<main>
		<article>
			<?= $params['contenidoPrincipal'] ?>
		</article>
	</main>
<?php
$params['app']->doInclude('/vistas/comun/footer.php');
?>
</body>
</html>
