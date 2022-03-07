<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/estilos.css" />
		<link rel="icon" href="img/logo/Favicon.png" type="image/png">
		<title><?= $tituloPagina ?></title>
	</head>
	<body>

		   <header>
				<?php require("menu.php"); ?>
		   </header>

		   <main>
				<?= $contenidoPrincipal ?>
		   </main>

		   <footer>
		   		<!-- Aqui ira el pie de pagina -->
		   </footer>

	</body>
</html>