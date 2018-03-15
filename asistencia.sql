-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 15-03-2018 a las 09:33:01
-- Versión del servidor: 5.7.21-0ubuntu0.17.10.1
-- Versión de PHP: 7.1.11-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `asistencia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datospersonales`
--

CREATE TABLE `datospersonales` (
  `id_personal` char(6) NOT NULL,
  `id_grupo_fk` char(2) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `fechanacimiento` date NOT NULL,
  `sexo` varchar(25) NOT NULL,
  `dni` char(8) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `instituto` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datospersonales`
--

INSERT INTO `datospersonales` (`id_personal`, `id_grupo_fk`, `nombres`, `apellidos`, `fechanacimiento`, `sexo`, `dni`, `direccion`, `instituto`, `estado`) VALUES
('C00001', 'T1', 'Kevin Joel', 'Tantaruna Gastelu', '1999-04-22', 'M', '71441696', 'Jr . Jose Pardo 398 Km 18 1/2 Carabayllo Lima', 'SENATI', 1),
('C00002', 'T1', 'Ronaldo', 'Farfan ayma', '1998-01-05', 'M', '71834775', 'Mz I lote 11 haras de chillon Puente Piedra', 'SENATI', 1),
('C00003', 'T1', 'Saul', 'Mendez Espinal', '1997-10-29', 'M', '72003602', 'AV.napo-urb Naranjal-independencia', 'SENATI', 1),
('C00004', 'T1', 'Cristhofer', 'Montalvo Fiestas', '1999-08-24', 'M', '76180544', 'Av Victorial Esperanza Baja Lote 42 Huaral', 'SENATI', 1),
('C00005', 'T1', 'Aldair', 'Saguma Villavicencio', '1998-06-15', 'M', '72421682', 'Saul Cantoral - MZ K2 lt6', 'SENATI', 1),
('C00006', 'T1', 'Bherkinn Wernner', 'Salazar Abarca', '1998-05-01', 'M', '75367542', 'Mz. J1 Lt 6 \"Asoc.Huertos de Santa Rosa\"', 'SENATI', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepractica`
--

CREATE TABLE `detallepractica` (
  `id_detalle` char(6) NOT NULL,
  `id_persona_fk` char(6) NOT NULL,
  `horas_total` double DEFAULT '0',
  `fecha_inicio` date NOT NULL,
  `fecha_final` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detallepractica`
--

INSERT INTO `detallepractica` (`id_detalle`, `id_persona_fk`, `horas_total`, `fecha_inicio`, `fecha_final`) VALUES
('CD0001', 'C00001', 0, '2018-02-19', NULL),
('CD0002', 'C00002', 0, '2018-02-22', NULL),
('CD0003', 'C00003', 0, '2018-02-19', NULL),
('CD0004', 'C00004', 0, '2018-03-02', NULL),
('CD0005', 'C00005', 0, '2018-02-23', NULL),
('CD0006', 'C00006', 0, '2018-01-11', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id_grupo` char(2) NOT NULL,
  `nombre_grupo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id_grupo`, `nombre_grupo`) VALUES
('T1', 'Turno mañana'),
('T2', 'Turno tarde');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `id_registro` int(11) NOT NULL,
  `id_persona_fk` char(6) NOT NULL,
  `fecha` date NOT NULL,
  `hora_ingreso` time NOT NULL,
  `hora_salida` time DEFAULT NULL,
  `horas_dia` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`id_registro`, `id_persona_fk`, `fecha`, `hora_ingreso`, `hora_salida`, `horas_dia`) VALUES
(16, 'C00005', '2018-03-12', '08:10:00', NULL, NULL),
(17, 'C00004', '2018-03-12', '08:00:00', NULL, NULL),
(18, 'C00001', '2018-03-12', '08:20:00', NULL, NULL),
(21, 'C00002', '2018-03-12', '08:00:00', NULL, NULL),
(22, 'C00006', '2018-03-12', '10:12:00', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datospersonales`
--
ALTER TABLE `datospersonales`
  ADD PRIMARY KEY (`id_personal`),
  ADD KEY `id_grupo_fk` (`id_grupo_fk`);

--
-- Indices de la tabla `detallepractica`
--
ALTER TABLE `detallepractica`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_persona_fk` (`id_persona_fk`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `id_persona_fk` (`id_persona_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `datospersonales`
--
ALTER TABLE `datospersonales`
  ADD CONSTRAINT `fk_grupo` FOREIGN KEY (`id_grupo_fk`) REFERENCES `grupo` (`id_grupo`);

--
-- Filtros para la tabla `detallepractica`
--
ALTER TABLE `detallepractica`
  ADD CONSTRAINT `detallepractica_ibfk_1` FOREIGN KEY (`id_persona_fk`) REFERENCES `datospersonales` (`id_personal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `registro_ibfk_1` FOREIGN KEY (`id_persona_fk`) REFERENCES `datospersonales` (`id_personal`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
