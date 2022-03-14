<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/estilos.css" />
		<link rel="stylesheet" type="text/css" href="css/header.css" />
		<link rel="icon" href="img/logo/Favicon.png" type="image/png">
		<title><?= $tituloPagina ?></title>
	</head>
	<body>
			<header>
				<?php require("includes/comun/header.php"); ?>
			</header>

		   
		   <main>
				<?= $contenidoPrincipal ?>
		   </main>

		   <?php require("includes/comun/footer.php"); ?>

	</body>
</html>