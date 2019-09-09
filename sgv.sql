-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-09-2019 a las 02:15:47
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
CREATE DATABASE IF NOT EXISTS `sgv` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sgv`;

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SPD_SET_InsertUbicacion` (`sIdCelular` INT, `sLatitud` TEXT, `sLongitud` TEXT)  BEGIN

INSERT INTO ubicacion 
(Latitud, Longitud, Fecha)
VALUES 
(sLatitud, sLongitud, NOW());

INSERT INTO ubicacioncelular 
(IdCelular, IdUbicacion)
VALUES 
(sIdCelular, LAST_INSERT_ID());

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
(1, 'Motorola', 'G5', '9981263390', 1),
(2, 'Motorola', 'G6', '9988111112', 1),
(3, 'Nokia', '1998', '8888', 0),
(4, 'fsfdsf', 'dsfdsfsdf', '35467688', 0);

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
(1, '21.0495167', '-86.849008', '2019-03-24 13:19:14', 1),
(2, '21.0495167', '-86.849008', '2019-03-24 13:25:46', 1),
(3, '21.0495167', '-86.849008', '2019-03-24 13:25:59', 1),
(4, '21.0495167', '-86.849008', '2019-03-24 13:26:21', 1),
(5, '21.0495167', '-86.849008', '2019-03-24 13:28:27', 1),
(6, '21.0595167', '-86.859008', '2019-03-31 22:10:56', 1),
(7, '21.0595167', '-86.859008', '2019-09-08 16:43:58', 1),
(8, '21.0595167', '-86.859008', '2019-09-08 16:44:25', 1),
(9, '21.1456647', '-86.859008', '2019-09-08 16:47:51', 1),
(10, '21.1456647', '-86.859008', '2019-09-08 16:48:05', 1),
(11, '21.1456647', '-86.8849286', '2019-09-08 16:48:26', 1),
(12, '22.1456647', '-87.8849286', '2019-09-08 16:52:15', 1),
(13, '21.1456647', '-86.8849286', '2019-09-08 17:03:25', 1),
(14, '21.1707251', '-86.8491041', '2019-09-08 17:07:31', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacioncelular`
--

CREATE TABLE `ubicacioncelular` (
  `IdUbicacionCelular` int(11) NOT NULL,
  `IdCelular` int(11) NOT NULL,
  `IdUbicacion` int(11) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ubicacioncelular`
--

INSERT INTO `ubicacioncelular` (`IdUbicacionCelular`, `IdCelular`, `IdUbicacion`, `Estado`) VALUES
(1, 1, 1, 1),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 1, 5, 1),
(6, 2, 6, 1),
(8, 1, 8, 1),
(9, 1, 9, 1),
(10, 1, 10, 1),
(11, 1, 11, 1),
(12, 1, 12, 1),
(13, 1, 13, 1),
(14, 2, 14, 1);

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
  `IdCelular` int(11) DEFAULT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IdUsuario`, `Nombre`, `ApellidoPat`, `ApellidoMat`, `Correo`, `NoEmpleado`, `Puesto`, `Usuario`, `Password`, `IdTipoUsuario`, `IdCelular`, `Estado`) VALUES
(1, 'Humberto', 'Cupul', 'Kuyoc', 'hcupul@mexicodestinos.com', 0, 'Admin', 'hcupul', '202cb962ac59075b964b07152d234b70', 1, 1, 1),
(2, 'Jesus', 'Albino', 'Vicaria', 'albino@vicaria.com', 0, 'Admin', 'jesus', '202cb962ac59075b964b07152d234b70', 1, NULL, 1),
(3, 'Aber', 'Aber', 'ereer', 'hjhjhj', 0, 'jhjhj', 'hjhjhj', '0808610cb0643f72f3918410d4d84d0a', 2, 2, 0);

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
(1, 'Toyota', '2016', '1', 'JDKSK2', '1359', 2, 1),
(2, 'Chevrolet', '2', '121342', 'ADSAASF', '1', 1, 1),
(3, '1121212', 'dggf', 'fdgfg', 'fdgfgf', 'dfggf', NULL, 0),
(4, 'Prueba', 'sfdfdsfds', 'dsffdfds', 'sdffsdfds', 'fdsf', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_ultimasubicaciones`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_ultimasubicaciones` (
`IdUbicacion` int(11)
,`Latitud` text
,`Longitud` text
,`Numero` varchar(50)
,`IdCelular` int(11)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `v_ultimasubicaciones`
--
DROP TABLE IF EXISTS `v_ultimasubicaciones`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_ultimasubicaciones`  AS  select `u`.`IdUbicacion` AS `IdUbicacion`,`u`.`Latitud` AS `Latitud`,`u`.`Longitud` AS `Longitud`,`cel`.`Numero` AS `Numero`,`cel`.`IdCelular` AS `IdCelular` from ((`ubicacioncelular` `ub` left join `ubicacion` `u` on((`ub`.`IdUbicacion` = `u`.`IdUbicacion`))) left join `celular` `cel` on((`ub`.`IdCelular` = `cel`.`IdCelular`))) where ((`ub`.`Estado` = 1) and (`ub`.`IdCelular` = 1)) order by `u`.`IdUbicacion` desc ;

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
-- Indices de la tabla `ubicacioncelular`
--
ALTER TABLE `ubicacioncelular`
  ADD PRIMARY KEY (`IdUbicacionCelular`,`IdCelular`,`IdUbicacion`),
  ADD KEY `fk_Celular_has_ubicacion_ubicacion1_idx` (`IdUbicacion`),
  ADD KEY `fk_Celular_has_ubicacion_Celular1_idx` (`IdCelular`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD KEY `fk_Usuario_TipoUsuario1_idx` (`IdTipoUsuario`),
  ADD KEY `fk_usuario_celular1_idx` (`IdCelular`);

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
  MODIFY `IdCelular` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
  MODIFY `IdUbicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `ubicacioncelular`
--
ALTER TABLE `ubicacioncelular`
  MODIFY `IdUbicacionCelular` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `IdVehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
-- Filtros para la tabla `ubicacioncelular`
--
ALTER TABLE `ubicacioncelular`
  ADD CONSTRAINT `fk_Celular_has_ubicacion_Celular1` FOREIGN KEY (`IdCelular`) REFERENCES `celular` (`IdCelular`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Celular_has_ubicacion_ubicacion1` FOREIGN KEY (`IdUbicacion`) REFERENCES `ubicacion` (`IdUbicacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Usuario_TipoUsuario1` FOREIGN KEY (`IdTipoUsuario`) REFERENCES `tipousuario` (`IdTipoUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_celular1` FOREIGN KEY (`IdCelular`) REFERENCES `celular` (`IdCelular`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `fk_vehiculo_usuario1` FOREIGN KEY (`IdConductor`) REFERENCES `usuario` (`IdUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
