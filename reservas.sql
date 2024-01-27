-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-01-2024 a las 20:23:43
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `reservas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `ID` int(11) NOT NULL,
  `NOM_CLI` varchar(100) NOT NULL,
  `APE_CLI` varchar(100) NOT NULL,
  `DOC_CLI` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`ID`, `NOM_CLI`, `APE_CLI`, `DOC_CLI`) VALUES
(1, 'CONSUMIDOR ', 'FINAL', '11111111'),
(2, 'RODRIGO', 'CORREA', '34449871'),
(3, 'JUAN', 'PEREZ', '25698789'),
(4, 'LUCAS', 'PERIE', '56897414'),
(5, 'MARTIN', 'PERIE', '33669875');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `ID` int(11) NOT NULL,
  `NUM_HAB` int(11) NOT NULL,
  `DESCRIPCION` varchar(100) NOT NULL,
  `CANT_HUESPEDES` int(11) NOT NULL,
  `DISPONIBILIDAD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`ID`, `NUM_HAB`, `DESCRIPCION`, `CANT_HUESPEDES`, `DISPONIBILIDAD`) VALUES
(1, 1001, '2 CAMAS 1 BAÑO', 4, 0),
(2, 2002, '1 cama 1 baño', 1, 0),
(3, 3003, '3 camas 1 baño', 3, 0),
(4, 4004, '1 CAMA MATRIMONIAL 2 CAMAS INDIVIDUALES', 4, 0),
(5, 5005, '2 camas matrimoniales 2 baños', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservaciones`
--

CREATE TABLE `reservaciones` (
  `ID` int(11) NOT NULL,
  `NUM_HAB` int(11) NOT NULL,
  `ID_CLIENTE` int(11) NOT NULL,
  `CHECKIN` datetime NOT NULL,
  `CHECKOUT` datetime NOT NULL,
  `ESTADO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservaciones`
--

INSERT INTO `reservaciones` (`ID`, `NUM_HAB`, `ID_CLIENTE`, `CHECKIN`, `CHECKOUT`, `ESTADO`) VALUES
(1, 1001, 1, '2024-01-28 15:35:00', '2024-01-31 15:34:00', 0),
(2, 1001, 1, '2024-01-27 19:36:00', '2024-01-28 12:36:00', 0),
(3, 2002, 1, '2024-01-28 17:43:00', '2024-01-31 16:43:00', 0),
(4, 2002, 3, '2024-01-27 16:51:00', '2024-01-28 14:51:00', 0),
(5, 5005, 4, '2024-01-29 15:56:00', '2024-02-02 20:56:00', 0),
(6, 5005, 5, '2024-01-28 15:57:00', '2024-01-29 05:57:00', 0),
(7, 5005, 1, '2024-01-29 11:14:00', '2024-01-29 12:14:00', 0),
(8, 3003, 1, '2024-02-08 16:15:00', '2024-02-10 16:18:00', 0),
(9, 3003, 1, '2024-03-09 16:15:00', '2024-03-09 16:18:00', 0),
(10, 4004, 1, '2024-03-09 16:15:00', '2024-03-09 16:18:00', 0),
(11, 4004, 1, '2024-04-06 16:15:00', '2024-04-07 16:18:00', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `NUM_HAB` (`NUM_HAB`);

--
-- Indices de la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NUM_HAB` (`NUM_HAB`),
  ADD KEY `ID_CLIENTE` (`ID_CLIENTE`),
  ADD KEY `NUM_HAB_2` (`NUM_HAB`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  ADD CONSTRAINT `reservaciones_ibfk_1` FOREIGN KEY (`NUM_HAB`) REFERENCES `habitaciones` (`NUM_HAB`),
  ADD CONSTRAINT `reservaciones_ibfk_2` FOREIGN KEY (`ID_CLIENTE`) REFERENCES `clientes` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
