-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 18-11-2022 a las 12:55:26
-- Versión del servidor: 5.7.33
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lab4`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_medidos`
--

CREATE TABLE `datos_medidos` (
  `id` int(11) NOT NULL,
  `Id_Tarjeta` int(11) NOT NULL,
  `nivel_CL` float NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(20) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispositivos`
--

CREATE TABLE `dispositivos` (
  `id` int(11) NOT NULL,
  `id_Tarjeta` int(11) NOT NULL,
  `serial` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id` int(11) NOT NULL,
  `descripcion_tipo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `descripcion_tipo`) VALUES
(1, 'Administrador'),
(2, 'Operario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(60) NOT NULL,
  `identificacion` varchar(15) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `login` varchar(20) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `tipo_usuario` int(11) NOT NULL,
  `id_tarjeta` int(11) NOT NULL,
  `activo` int(11) NOT NULL,
  `edad` int(11) NOT NULL,
  `telefono` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_completo`, `identificacion`, `direccion`, `login`, `passwd`, `tipo_usuario`, `id_tarjeta`, `activo`, `edad`, `telefono`) VALUES
(1, 'Jaime Villamizar', '65656565', 'Cll 1 Cr 5', 'Jevillamizar', '827ccb0eea8a706c4c34a16891f84e7b', 1, 0, 1, 28, '328987671'),
(2, 'Pedro Perez', '43434343', 'Cll 5 Cr 7', 'pperez', 'adcaec3805aa912c0d0b14a81bedb6ff', 2, 0, 0, 0, '0'),
(5, 'Juan Gomez', '32323232', 'Cr 5 ', 'jgomez', 'adcaec3805aa912c0d0b14a81bedb6ff', 2, 1, 1, 22, '3034086733'),
(6, 'Usuario Prueba', '72637263', 'CR CLL', 'prueba', 'adcaec3805aa912c0d0b14a81bedb6ff', 2, 1, 1, 0, '0'),
(7, 'Daniel A', '123445', 'Cr 25', 'dear', 'adcaec3805aa912c0d0b14a81bedb6ff', 2, 1, 1, 34, '3174096735'),
(8, 'Sebas', '12354566', 'Cr 567', 'sebas', 'adcaec3805aa912c0d0b14a81bedb6ff', 2, 1, 1, 28, '3146009475');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos_medidos`
--
ALTER TABLE `datos_medidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datos_medidos`
--
ALTER TABLE `datos_medidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
