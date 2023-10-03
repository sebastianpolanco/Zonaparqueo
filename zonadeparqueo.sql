-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-06-2022 a las 20:36:46
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `zonadeparqueo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `idEstado` int(20) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`idEstado`, `estado`) VALUES
(1, 'Libre'),
(2, 'Ocupado'),
(3, 'Reservado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestos`
--

CREATE TABLE `puestos` (
  `id` int(11) NOT NULL,
  `idZona` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `puesto` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `puestos`
--

INSERT INTO `puestos` (`id`, `idZona`, `idEstado`, `puesto`, `fecha`, `hora`) VALUES
(1, 1, 1, 1, '2022-05-22', '21:57:03'),
(2, 1, 1, 2, '2022-05-22', '21:29:34'),
(3, 2, 1, 1, '2022-05-22', '21:43:58'),
(4, 2, 1, 2, '2022-05-22', '21:28:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros`
--

CREATE TABLE `registros` (
  `idRegistro` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `zona` int(11) DEFAULT NULL,
  `puesto` int(11) DEFAULT NULL,
  `estado` int(20) DEFAULT NULL,
  `idTipoDeAccion` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `registros`
--

INSERT INTO `registros` (`idRegistro`, `idUsuario`, `zona`, `puesto`, `estado`, `idTipoDeAccion`, `fecha`, `hora`) VALUES
(47, 2, 1, 1, 3, 3, '2022-06-30', '12:52:00'),
(48, 2, 1, 1, 1, 4, '2022-06-30', '12:53:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registrostarifas`
--

CREATE TABLE `registrostarifas` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `tarifa` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(11) NOT NULL,
  `zona` int(11) NOT NULL,
  `puesto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposdeaccion`
--

CREATE TABLE `tiposdeaccion` (
  `idTipoDeAccion` int(11) NOT NULL,
  `accion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tiposdeaccion`
--

INSERT INTO `tiposdeaccion` (`idTipoDeAccion`, `accion`) VALUES
(1, 'TERMINACION'),
(2, 'OCUPACION'),
(3, 'RESERVACION'),
(4, 'CANCELACION'),
(5, 'LIBERACION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposusuario`
--

CREATE TABLE `tiposusuario` (
  `idTipoUsuario` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tiposusuario`
--

INSERT INTO `tiposusuario` (`idTipoUsuario`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Consultor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--

CREATE TABLE `ubicaciones` (
  `id` int(11) NOT NULL,
  `latitud` varchar(200) NOT NULL,
  `longitud` varchar(200) NOT NULL,
  `id_tarj` varchar(10) NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(12) NOT NULL,
  `altitud` float NOT NULL,
  `velocidad` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ubicaciones`
--

INSERT INTO `ubicaciones` (`id`, `latitud`, `longitud`, `id_tarj`, `fecha`, `hora`, `altitud`, `velocidad`) VALUES
(1, '2.44800', '-76.61000', '1', '2019-03-31', '12:54:05', 1862, 0.06),
(2, '2.4371272757792193', '-76.61914096832275', '1', '2019-03-31', '12:54:14', 1862.6, 0.06);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  `contrasenia` varchar(50) DEFAULT NULL,
  `nombres` varchar(40) DEFAULT NULL,
  `apellidos` varchar(40) DEFAULT NULL,
  `idTipoUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `usuario`, `contrasenia`, `nombres`, `apellidos`, `idTipoUsuario`) VALUES
(1, 'SantiagoV', '81dc9bdb52d04dc20036dbd8313ed055', 'SANTIAGO', 'VERGARA ROJAS', 1),
(2, 'PepitoP', '81dc9bdb52d04dc20036dbd8313ed055', 'PEPITO', 'PEREZ', 2),
(3, 'PetroPresidente', '81dc9bdb52d04dc20036dbd8313ed055', 'Gustavo', 'Petro', 2),
(6, 'q', '81dc9bdb52d04dc20036dbd8313ed055', 'q', 'q', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `validaciones`
--

CREATE TABLE `validaciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `validaciones`
--

INSERT INTO `validaciones` (`id`, `nombre`, `estado`) VALUES
(1, 'actualizacionEstadoP22', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

CREATE TABLE `zonas` (
  `idZona` int(11) NOT NULL,
  `direccion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `zonas`
--

INSERT INTO `zonas` (`idZona`, `direccion`) VALUES
(1, 'Calle 1'),
(2, 'Calle 2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`idEstado`);

--
-- Indices de la tabla `puestos`
--
ALTER TABLE `puestos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idZona` (`idZona`),
  ADD KEY `idEstado` (`idEstado`);

--
-- Indices de la tabla `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`idRegistro`),
  ADD KEY `FK_REFERENCE_3` (`idUsuario`),
  ADD KEY `idTipoDeAccion` (`idTipoDeAccion`);

--
-- Indices de la tabla `registrostarifas`
--
ALTER TABLE `registrostarifas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tiposdeaccion`
--
ALTER TABLE `tiposdeaccion`
  ADD PRIMARY KEY (`idTipoDeAccion`);

--
-- Indices de la tabla `tiposusuario`
--
ALTER TABLE `tiposusuario`
  ADD PRIMARY KEY (`idTipoUsuario`);

--
-- Indices de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idTipoUsuario` (`idTipoUsuario`);

--
-- Indices de la tabla `validaciones`
--
ALTER TABLE `validaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD PRIMARY KEY (`idZona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `idEstado` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `puestos`
--
ALTER TABLE `puestos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `registros`
--
ALTER TABLE `registros`
  MODIFY `idRegistro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `registrostarifas`
--
ALTER TABLE `registrostarifas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `tiposdeaccion`
--
ALTER TABLE `tiposdeaccion`
  MODIFY `idTipoDeAccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tiposusuario`
--
ALTER TABLE `tiposusuario`
  MODIFY `idTipoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `validaciones`
--
ALTER TABLE `validaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `zonas`
--
ALTER TABLE `zonas`
  MODIFY `idZona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `puestos`
--
ALTER TABLE `puestos`
  ADD CONSTRAINT `puestos_ibfk_1` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`idEstado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `puestos_ibfk_2` FOREIGN KEY (`idZona`) REFERENCES `zonas` (`idZona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `registros`
--
ALTER TABLE `registros`
  ADD CONSTRAINT `registros_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `registros_ibfk_2` FOREIGN KEY (`idTipoDeAccion`) REFERENCES `tiposdeaccion` (`idTipoDeAccion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idTipoUsuario`) REFERENCES `tiposusuario` (`idTipoUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
