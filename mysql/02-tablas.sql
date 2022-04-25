SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `categoriasjuegos` (
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `categoriastienda` (
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tienda` (
  `IdProducto` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `descripcion` varchar(254) NOT NULL,
  `precio` int(11) NOT NULL,
  `imagen` longblob NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `compras` (
  `IdUsuario` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `eventos` (
  `IdEvento` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(254) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFinal` date NOT NULL,
  `imagen` mediumblob NOT NULL,
  `premio` int(11) NOT NULL,
  `IdJuego` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `inscripcioneseventos` (
  `IdUsuario` int(11) NOT NULL,
  `IdEvento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `juegos` (
  `IdJuego` int(11) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `Imagen` longblob DEFAULT NULL,
  `Descripcion` varchar(255) DEFAULT NULL,
  `Categoria` varchar(255) DEFAULT NULL,
  `Enlace` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `publicidad` (
  `IdPublicidad` int(11) NOT NULL,
  `nombreEmpresa` varchar(255) NOT NULL,
  `enlace` varchar(254) NOT NULL,
  `descripcion` varchar(254) NOT NULL,
  `imagen` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `ranking` (
  `IdJuego` int(11) DEFAULT NULL,
  `IdJugador` int(11) DEFAULT NULL,
  `Puntuacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `usuarios` (
  `IdUsuario` int(11) NOT NULL,
  `nombreUsuario` varchar(15) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `categoriasjuegos`
  ADD PRIMARY KEY (`nombre`);

ALTER TABLE `categoriastienda`
  ADD PRIMARY KEY (`nombre`);

ALTER TABLE `tienda`
  ADD PRIMARY KEY (`IdProducto`),
  ADD KEY `categoria` (`categoria`);

ALTER TABLE `compras`
  ADD KEY `IdUsuario` (`IdUsuario`),
  ADD KEY `IdProducto` (`IdProducto`);

ALTER TABLE `eventos`
  ADD PRIMARY KEY (`IdEvento`),
  ADD KEY `IdJuego` (`IdJuego`);

ALTER TABLE `inscripcioneseventos`
  ADD KEY `IdUsuario` (`IdUsuario`),
  ADD KEY `IdEvento` (`IdEvento`);

ALTER TABLE `juegos`
  ADD PRIMARY KEY (`IdJuego`),
  ADD KEY `Categoria` (`Categoria`);

ALTER TABLE `publicidad`
  ADD PRIMARY KEY (`IdPublicidad`);

ALTER TABLE `ranking`
  ADD KEY `IdJuego` (`IdJuego`),
  ADD KEY `IdJugador` (`IdJugador`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IdUsuario`);

ALTER TABLE `eventos`
  MODIFY `IdEvento` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `juegos`
  MODIFY `IdJuego` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `publicidad`
  MODIFY `IdPublicidad` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `usuarios`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tienda`
  MODIFY `IdProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;



ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`IdProducto`) REFERENCES `tienda` (`IdProducto`),
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`IdUsuario`) REFERENCES `usuarios` (`IdUsuario`);

ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`IdJuego`) REFERENCES `juegos` (`IdJuego`);

ALTER TABLE `inscripcioneseventos`
  ADD CONSTRAINT `inscripcioneseventos_ibfk_1` FOREIGN KEY (`IdUsuario`) REFERENCES `usuarios` (`IdUsuario`),
  ADD CONSTRAINT `inscripcioneseventos_ibfk_2` FOREIGN KEY (`IdEvento`) REFERENCES `eventos` (`IdEvento`);

ALTER TABLE `juegos`
  ADD CONSTRAINT `juegos_ibfk_1` FOREIGN KEY (`Categoria`) REFERENCES `categoriasjuegos` (`nombre`);

ALTER TABLE `ranking`
  ADD CONSTRAINT `ranking_ibfk_1` FOREIGN KEY (`IdJuego`) REFERENCES `juegos` (`IdJuego`),
  ADD CONSTRAINT `ranking_ibfk_2` FOREIGN KEY (`IdJugador`) REFERENCES `usuarios` (`IdUsuario`);

ALTER TABLE `tienda`
  ADD CONSTRAINT `tienda_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categoriastienda` (`nombre`);
COMMIT;
