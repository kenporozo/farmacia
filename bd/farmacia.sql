-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-12-2021 a las 19:31:03
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `farmacia`
--
CREATE DATABASE IF NOT EXISTS `farmacia` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `farmacia`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `farmaco`
--

DROP TABLE IF EXISTS `farmaco`;
CREATE TABLE `farmaco` (
  `id_farmaco` int(11) NOT NULL,
  `nombre_far` varchar(30) NOT NULL,
  `stock` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `detalle` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `farmaco`:
--

--
-- Volcado de datos para la tabla `farmaco`
--

INSERT INTO `farmaco` (`id_farmaco`, `nombre_far`, `stock`, `precio`, `detalle`) VALUES
(1, 'Aspirina', 118, 535, 'Observacion 1'),
(2, 'Tapsin', 48, 1290, 'Observacion 2'),
(23, 'Jarabe', 99, 4000, 'Jarabe para la tos'),
(24, 'Viagra', 1, 9990, 'Viagra'),
(25, 'Tachipirin', 23, 5000, 'Remedio'),
(26, 'Antibioticos', 84, 3000, 'Obs 12'),
(27, 'g', 90, 5000, 'test');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `farmaco_lab`
--

DROP TABLE IF EXISTS `farmaco_lab`;
CREATE TABLE `farmaco_lab` (
  `id_farmaco` int(11) NOT NULL,
  `id_lab` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `farmaco_lab`:
--   `id_farmaco`
--       `farmaco` -> `id_farmaco`
--   `id_lab`
--       `laboratorio` -> `id_lab`
--

--
-- Volcado de datos para la tabla `farmaco_lab`
--

INSERT INTO `farmaco_lab` (`id_farmaco`, `id_lab`) VALUES
(1, 1),
(2, 2),
(23, 4),
(24, 3),
(25, 2),
(26, 3),
(27, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorio`
--

DROP TABLE IF EXISTS `laboratorio`;
CREATE TABLE `laboratorio` (
  `id_lab` int(11) NOT NULL,
  `nombre_lab` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `laboratorio`:
--

--
-- Volcado de datos para la tabla `laboratorio`
--

INSERT INTO `laboratorio` (`id_lab`, `nombre_lab`) VALUES
(1, 'Bayer'),
(2, 'Chile'),
(3, 'Ferre'),
(4, 'Pharma');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `farmaco`
--
ALTER TABLE `farmaco`
  ADD PRIMARY KEY (`id_farmaco`);

--
-- Indices de la tabla `farmaco_lab`
--
ALTER TABLE `farmaco_lab`
  ADD PRIMARY KEY (`id_farmaco`,`id_lab`),
  ADD KEY `FK_farmaco_lab_lab_idx` (`id_lab`);

--
-- Indices de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`id_lab`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `farmaco`
--
ALTER TABLE `farmaco`
  MODIFY `id_farmaco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  MODIFY `id_lab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `farmaco_lab`
--
ALTER TABLE `farmaco_lab`
  ADD CONSTRAINT `FK_famaco_lab_farmaco` FOREIGN KEY (`id_farmaco`) REFERENCES `farmaco` (`id_farmaco`),
  ADD CONSTRAINT `FK_farmaco_lab_lab` FOREIGN KEY (`id_lab`) REFERENCES `laboratorio` (`id_lab`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
