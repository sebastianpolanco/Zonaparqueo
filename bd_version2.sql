-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-02-2018 a las 23:30:39
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
-- Estructura de tabla para la tabla `datos_maximos`
--

CREATE TABLE IF NOT EXISTS `datos_maximos` (
  `id` int(11) NOT NULL,
  `nombre_dato` varchar(40) NOT NULL,
  `minimo` int(11) NOT NULL,
  `maximo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datos_maximos`
--

INSERT INTO `datos_maximos` (`id`, `nombre_dato`, `minimo`, `maximo`) VALUES
(1, 'temperatura', 10, 32),
(2, 'humedad', 40, 85);

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
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datos_medidos`
--

INSERT INTO `datos_medidos` (`id`, `ID_TARJ`, `temperatura`, `humedad`, `fecha`, `hora`) VALUES
(1, 1, 28.8, 51.6, '2018-02-15', '15:17:15'),
(2, 1, 28.8, 51.8, '2018-02-15', '15:17:25'),
(3, 1, 28.7, 52, '2018-02-15', '15:17:35'),
(4, 1, 28.6, 52.2, '2018-02-15', '15:17:44'),
(5, 1, 28.5, 52.4, '2018-02-15', '15:17:53'),
(6, 1, 28.4, 52.6, '2018-02-15', '15:18:03'),
(7, 1, 28.3, 52.8, '2018-02-15', '15:18:12'),
(8, 1, 28.2, 53, '2018-02-15', '15:18:24'),
(9, 1, 28.1, 53.5, '2018-02-15', '15:18:34'),
(10, 1, 28, 53.6, '2018-02-15', '15:18:44'),
(11, 1, 27.9, 53.7, '2018-02-15', '15:18:53'),
(12, 1, 27.9, 53.8, '2018-02-15', '15:19:03'),
(13, 1, 27.9, 54, '2018-02-15', '15:19:12'),
(14, 1, 27.8, 54.2, '2018-02-15', '15:19:22'),
(15, 1, 27.8, 54.2, '2018-02-15', '15:19:31'),
(16, 1, 27.7, 54.3, '2018-02-15', '15:19:41'),
(17, 1, 27.7, 54.4, '2018-02-15', '15:19:50'),
(18, 1, 27.6, 54.5, '2018-02-15', '15:19:59'),
(19, 1, 27.6, 54.5, '2018-02-15', '15:20:09'),
(20, 1, 27.6, 54.7, '2018-02-15', '15:20:19'),
(21, 1, 27.5, 54.7, '2018-02-15', '15:20:28'),
(22, 1, 27.5, 54.7, '2018-02-15', '15:20:38'),
(23, 1, 27.4, 54.9, '2018-02-15', '15:20:47'),
(24, 1, 27.4, 55, '2018-02-15', '15:20:57'),
(25, 1, 27.3, 55, '2018-02-15', '15:21:06'),
(26, 1, 27.3, 55.3, '2018-02-15', '15:21:16'),
(27, 1, 27.2, 55.4, '2018-02-15', '15:21:25'),
(28, 1, 27.2, 55.5, '2018-02-15', '15:21:35'),
(29, 1, 27.1, 55.7, '2018-02-15', '15:21:44'),
(30, 1, 27.1, 55.8, '2018-02-15', '15:21:54'),
(31, 1, 27.1, 55.7, '2018-02-15', '15:22:03'),
(32, 1, 27.1, 55.8, '2018-02-15', '15:22:12'),
(33, 1, 27, 55.8, '2018-02-15', '15:22:22'),
(34, 1, 27, 55.8, '2018-02-15', '15:22:31'),
(35, 1, 27, 55.9, '2018-02-15', '15:22:41'),
(36, 1, 27, 56, '2018-02-15', '15:22:50'),
(37, 1, 26.9, 56.1, '2018-02-15', '15:23:00'),
(38, 1, 26.9, 56.6, '2018-02-15', '15:23:09'),
(39, 1, 26.9, 56.4, '2018-02-15', '15:23:19'),
(40, 1, 26.8, 56.5, '2018-02-15', '15:23:28'),
(41, 1, 26.8, 57.5, '2018-02-15', '15:23:38'),
(42, 1, 26.8, 56.6, '2018-02-15', '15:23:47'),
(43, 1, 26.8, 57, '2018-02-15', '15:23:57'),
(44, 1, 26.8, 56.7, '2018-02-15', '15:24:06'),
(45, 1, 26.8, 56.5, '2018-02-15', '15:24:16'),
(46, 1, 26.8, 56.4, '2018-02-15', '15:24:25'),
(47, 1, 26.8, 57, '2018-02-15', '15:24:35'),
(48, 1, 26.7, 56.7, '2018-02-15', '15:24:44'),
(49, 1, 26.7, 56.7, '2018-02-15', '15:24:53'),
(50, 1, 26.7, 56.5, '2018-02-15', '15:25:03'),
(51, 1, 26.7, 56.6, '2018-02-15', '15:25:12'),
(52, 1, 26.7, 56.6, '2018-02-15', '15:25:22'),
(53, 1, 26.7, 56.5, '2018-02-15', '15:25:31'),
(54, 1, 26.7, 56.6, '2018-02-15', '15:25:41'),
(55, 1, 26.7, 60.5, '2018-02-15', '15:25:50'),
(56, 1, 26.7, 58, '2018-02-14', '15:26:00'),
(57, 1, 26.7, 57.2, '2018-02-14', '15:26:09'),
(58, 1, 26.7, 56.9, '2018-02-14', '15:26:19'),
(59, 1, 26.7, 56.8, '2018-02-14', '15:26:28'),
(60, 1, 26.7, 56.8, '2018-02-14', '15:26:38');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos_maximos`
--
ALTER TABLE `datos_maximos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos_medidos`
--
ALTER TABLE `datos_medidos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datos_maximos`
--
ALTER TABLE `datos_maximos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `datos_medidos`
--
ALTER TABLE `datos_medidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
