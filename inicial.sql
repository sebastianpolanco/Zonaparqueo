-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-02-2018 a las 21:18:04
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `labiii`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_medidos`
--

CREATE TABLE IF NOT EXISTS `datos_medidos` (
  `id` int(11) NOT NULL,
  `ID_TARJ` int(11) NOT NULL,
  `temperatura` float NOT NULL,
  `humedad` float NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datos_medidos`
--

INSERT INTO `datos_medidos` (`id`, `ID_TARJ`, `temperatura`, `humedad`, `fecha`, `hora`) VALUES
(1, 1, 28.8, 51.6, '2018-02-15', '15:17:15'),
(2, 1, 28.8, 51.8, '2018-02-15', '15:17:25'),
(3, 1, 28.7, 52, '2018-02-15', '15:17:35'),
(4, 1, 28.6, 52.2, '2018-02-15', '15:17:44'),
(5, 1, 28.5, 52.4, '2018-02-15', '15:17:53'),
(6, 1, 28.4, 52.6, '2018-02-15', '15:18:03');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos_medidos`
--
ALTER TABLE `datos_medidos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datos_medidos`
--
ALTER TABLE `datos_medidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
