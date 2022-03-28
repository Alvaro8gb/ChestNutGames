-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-03-2022 a las 14:04:11
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `categorias` (
  `Nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `RolesUsuario` (
  `usuario` int(11) NOT NULL,
  `rol` int(11) NOT NULL,
  PRIMARY KEY (`usuario`,`rol`),
  KEY `rol` (`rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `Roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(15)  NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `juegos` (
  `IdJuego` int(11) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `Imagen` longblob DEFAULT NULL,
  `Descripcion` varchar(255) DEFAULT NULL,
  `Categoria` varchar(255) DEFAULT NULL,
  `Enlace` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `eventos` (
  `idEvento` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(254) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFinal` date NOT NULL,
  `imagen` mediumblob NOT NULL,
  `premio` int(11) NOT NULL,
  `IdJuego` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `ranking` (
  `IdJuego` int(11) DEFAULT NULL,
  `IdJugador` int(11) DEFAULT NULL,
  `Puntuacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombreUsuario` varchar(15) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `correo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `inscripcioneseventos` (
  `idUsuario` int(11) NOT NULL,
  `idEvento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `categorias`
  ADD PRIMARY KEY (`Nombre`) USING BTREE;

ALTER TABLE `juegos`
  ADD PRIMARY KEY (`IdJuego`),
  ADD UNIQUE KEY `Nombre` (`Nombre`),
  ADD KEY `Categoria` (`Categoria`);

ALTER TABLE `ranking`
  ADD KEY `IdJuego` (`IdJuego`),
  ADD KEY `IdJugador` (`IdJugador`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `eventos`
  ADD PRIMARY KEY (`idEvento`);

ALTER TABLE `eventos`
  MODIFY `idEvento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `juegos`
  MODIFY `IdJuego` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `juegos`
  ADD CONSTRAINT `juegos_ibfk_1` FOREIGN KEY (`Categoria`) REFERENCES `categorias` (`Nombre`);

ALTER TABLE `ranking`
  ADD CONSTRAINT `ranking_ibfk_1` FOREIGN KEY (`IdJuego`) REFERENCES `juegos` (`IdJuego`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ranking_ibfk_2` FOREIGN KEY (`IdJugador`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

ALTER TABLE `inscripcioneseventos`
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idEvento` (`idEvento`);

ALTER TABLE `inscripcioneseventos`
  ADD CONSTRAINT `inscripcioneseventos_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `inscripcioneseventos_ibfk_2` FOREIGN KEY (`idEvento`) REFERENCES `eventos` (`idEvento`);
COMMIT;