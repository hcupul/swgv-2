-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-09-2019 a las 20:10:33
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sgv`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE PROCEDURE `SPD_SET_InsertUbicacion` (IN `sIdVehiculo` INT, IN `sLatitud` TEXT, IN `sLongitud` TEXT)  BEGIN

INSERT INTO ubicacion 
(Latitud, Longitud, Fecha)
VALUES 
(sLatitud, sLongitud, NOW());

INSERT INTO ubicacionvehiculo
(IdVehiculo, IdUbicacion)
VALUES 
(sIdVehiculo, LAST_INSERT_ID());

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `celular`
--

CREATE TABLE `celular` (
  `IdCelular` int(11) NOT NULL,
  `Marca` varchar(50) NOT NULL,
  `Modelo` varchar(50) NOT NULL,
  `Numero` varchar(50) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `celular`
--

INSERT INTO `celular` (`IdCelular`, `Marca`, `Modelo`, `Numero`, `Estado`) VALUES
(1, 'Moto', 'G5', '9981263390', 1),
(2, 'Desconocido', 'Desconocido', '9988946426', 1),
(3, 'Desconocido', 'Desconocido', '9991904736', 1),
(4, 'Desconocido', 'Desconocido', '9982643875', 1),
(5, 'Desconocido', 'Desconocido', '9982643874', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE `reporte` (
  `IdReporte` int(11) NOT NULL,
  `Descripcion` text NOT NULL,
  `IdUbicacionOrigen` int(11) DEFAULT NULL,
  `IdUbicacionDestino` int(11) DEFAULT NULL,
  `Fecha` datetime NOT NULL,
  `IdVehiculo` int(11) DEFAULT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE `tipousuario` (
  `IdTipoUsuario` int(11) NOT NULL,
  `Descripcion` varchar(50) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`IdTipoUsuario`, `Descripcion`, `Estado`) VALUES
(1, 'Administrador', 1),
(2, 'Chofer', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `IdUbicacion` int(11) NOT NULL,
  `Latitud` text NOT NULL,
  `Longitud` text NOT NULL,
  `Fecha` datetime NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`IdUbicacion`, `Latitud`, `Longitud`, `Fecha`, `Estado`) VALUES
(1, '21.1456647', '-86.8849286', '2019-09-08 21:31:02', 1),
(3, '21.1456647', '-86.8849286', '2019-09-08 21:34:29', 1),
(4, '21.1456647', '-86.8849286', '2019-09-08 21:35:08', 1),
(5, '21.1456647', '-86.8849286', '2019-09-08 21:35:23', 1),
(6, '21.1456647', '-86.8849286', '2019-09-08 21:36:34', 1),
(7, '21.3456647', '-86.9849286', '2019-09-08 21:37:24', 1),
(8, '21.3456647', '-86.9849286', '2019-09-08 21:38:25', 1),
(9, '21.0495167', '-86.8469238', '2019-09-15 12:30:16', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacionvehiculo`
--

CREATE TABLE `ubicacionvehiculo` (
  `IdUbicacionVehiculo` int(11) NOT NULL,
  `IdVehiculo` int(11) NOT NULL,
  `IdUbicacion` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ubicacionvehiculo`
--

INSERT INTO `ubicacionvehiculo` (`IdUbicacionVehiculo`, `IdVehiculo`, `IdUbicacion`, `estado`) VALUES
(1, 1, 1, 1),
(2, 1, 6, 1),
(4, 1, 8, 1),
(5, 2, 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IdUsuario` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `ApellidoPat` varchar(50) NOT NULL,
  `ApellidoMat` varchar(50) NOT NULL,
  `Correo` varchar(100) NOT NULL,
  `NoEmpleado` int(11) NOT NULL,
  `Puesto` varchar(50) NOT NULL,
  `Usuario` varchar(50) NOT NULL,
  `Password` text NOT NULL,
  `IdTipoUsuario` int(11) NOT NULL,
  `Numero` varchar(50) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IdUsuario`, `Nombre`, `ApellidoPat`, `ApellidoMat`, `Correo`, `NoEmpleado`, `Puesto`, `Usuario`, `Password`, `IdTipoUsuario`, `Numero`, `Estado`) VALUES
(1, 'Humberto', 'Cupul', 'Kuyoc', 'hcupul@mexicodestinos.com', 0, 'Administrador', 'humberto', '202cb962ac59075b964b07152d234b70', 1, '9981263390', 1),
(2, 'Jesus', 'Albino', 'Vicaria', 'jesus@jesus.com', 0, 'Administrador', 'jesus', '202cb962ac59075b964b07152d234b70', 1, '9988946426', 1),
(3, 'Joshua', 'Valdez', 'Sosa', 'joshua@joshua.com', 0, 'Programador', 'joshua', '202cb962ac59075b964b07152d234b70', 1, '9991904736', 1),
(4, 'Vladimir', 'Pool', 'Estrella', 'vladi@utcancun.com', 0, 'Empleado', 'vladimir', '202cb962ac59075b964b07152d234b70', 1, '9982643875', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `IdVehiculo` int(11) NOT NULL,
  `Marca` varchar(50) NOT NULL,
  `Modelo` varchar(100) NOT NULL,
  `NumUnidad` varchar(50) NOT NULL,
  `NumPlaca` varchar(50) NOT NULL,
  `NumSerie` varchar(50) NOT NULL,
  `IdConductor` int(11) DEFAULT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`IdVehiculo`, `Marca`, `Modelo`, `NumUnidad`, `NumPlaca`, `NumSerie`, `IdConductor`, `Estado`) VALUES
(1, 'Toyota', '2017', '11509', 'H223HW', '678902112', 4, 1),
(2, 'Chevrolet', '2018', '391', 'HE232H', '83288942', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `celular`
--
ALTER TABLE `celular`
  ADD PRIMARY KEY (`IdCelular`);

--
-- Indices de la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD PRIMARY KEY (`IdReporte`),
  ADD KEY `fk_reporte_ubicacion1_idx` (`IdUbicacionOrigen`),
  ADD KEY `fk_reporte_ubicacion2_idx` (`IdUbicacionDestino`),
  ADD KEY `fk_reporte_Vehiculo1_idx` (`IdVehiculo`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`IdTipoUsuario`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`IdUbicacion`);

--
-- Indices de la tabla `ubicacionvehiculo`
--
ALTER TABLE `ubicacionvehiculo`
  ADD PRIMARY KEY (`IdUbicacionVehiculo`,`IdVehiculo`,`IdUbicacion`),
  ADD KEY `fk_vehiculo_has_ubicacion_ubicacion1_idx` (`IdUbicacion`),
  ADD KEY `fk_vehiculo_has_ubicacion_vehiculo1_idx` (`IdVehiculo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD KEY `fk_Usuario_TipoUsuario1_idx` (`IdTipoUsuario`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`IdVehiculo`),
  ADD UNIQUE KEY `NumUnidad_UNIQUE` (`NumUnidad`),
  ADD KEY `fk_vehiculo_usuario1_idx` (`IdConductor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `celular`
--
ALTER TABLE `celular`
  MODIFY `IdCelular` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `reporte`
--
ALTER TABLE `reporte`
  MODIFY `IdReporte` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `IdTipoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `IdUbicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `ubicacionvehiculo`
--
ALTER TABLE `ubicacionvehiculo`
  MODIFY `IdUbicacionVehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `IdVehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD CONSTRAINT `fk_reporte_Vehiculo1` FOREIGN KEY (`IdVehiculo`) REFERENCES `vehiculo` (`IdVehiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reporte_ubicacion1` FOREIGN KEY (`IdUbicacionOrigen`) REFERENCES `ubicacion` (`IdUbicacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reporte_ubicacion2` FOREIGN KEY (`IdUbicacionDestino`) REFERENCES `ubicacion` (`IdUbicacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ubicacionvehiculo`
--
ALTER TABLE `ubicacionvehiculo`
  ADD CONSTRAINT `fk_vehiculo_has_ubicacion_ubicacion1` FOREIGN KEY (`IdUbicacion`) REFERENCES `ubicacion` (`IdUbicacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_vehiculo_has_ubicacion_vehiculo1` FOREIGN KEY (`IdVehiculo`) REFERENCES `vehiculo` (`IdVehiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Usuario_TipoUsuario1` FOREIGN KEY (`IdTipoUsuario`) REFERENCES `tipousuario` (`IdTipoUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `fk_vehiculo_usuario1` FOREIGN KEY (`IdConductor`) REFERENCES `usuario` (`IdUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
