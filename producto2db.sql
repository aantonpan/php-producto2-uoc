-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql_producto2
-- Tiempo de generación: 20-04-2025 a las 22:12:38
-- Versión del servidor: 8.0.41
-- Versión de PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `producto2db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transfer_hotel`
--

CREATE TABLE `transfer_hotel` (
  `id_hotel` int NOT NULL,
  `id_zona` int DEFAULT NULL,
  `Comision` int DEFAULT NULL,
  `usuario` int DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `transfer_hotel`
--

INSERT INTO `transfer_hotel` (`id_hotel`, `id_zona`, `Comision`, `usuario`, `password`, `nombre`, `direccion`) VALUES
(1, 1, 10, 101, 'pass123', 'Hotel Gran Canaria', 'Av. de Tirajana 3'),
(2, 2, 12, 102, 'pass456', 'Resort Sol y Mar', 'Calle Atlántico 45'),
(3, 3, 15, 103, 'pass789', 'Playa Blanca Suites', 'Paseo Costa 19'),
(4, 4, 8, 104, 'pass321', 'Maspalomas Palace', 'Av. de los Palmerales 21'),
(5, 5, 9, 105, 'pass654', 'Bahía Azul', 'Calle del Mar 14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transfer_precios`
--

CREATE TABLE `transfer_precios` (
  `id_precios` int NOT NULL,
  `id_vehiculo` int NOT NULL,
  `id_hotel` int NOT NULL,
  `Precio` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `transfer_precios`
--

INSERT INTO `transfer_precios` (`id_precios`, `id_vehiculo`, `id_hotel`, `Precio`) VALUES
(34, 1, 1, 29),
(35, 1, 2, 45),
(36, 1, 3, 38),
(37, 1, 4, 31),
(38, 1, 5, 42),
(39, 2, 1, 42),
(40, 2, 2, 36),
(41, 2, 3, 29),
(42, 2, 4, 36),
(43, 2, 5, 43),
(44, 3, 1, 33),
(45, 3, 2, 35),
(46, 3, 3, 27),
(47, 3, 4, 32),
(48, 3, 5, 29),
(49, 4, 1, 25),
(50, 4, 2, 38),
(51, 4, 3, 39),
(52, 4, 4, 32),
(53, 4, 5, 46),
(54, 5, 1, 33),
(55, 5, 2, 26),
(56, 5, 3, 32),
(57, 5, 4, 32),
(58, 5, 5, 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transfer_reservas`
--

CREATE TABLE `transfer_reservas` (
  `id_reserva` int NOT NULL,
  `localizador` varchar(100) NOT NULL,
  `id_hotel` int DEFAULT NULL,
  `id_tipo_reserva` int NOT NULL,
  `id_cliente` int NOT NULL,
  `fecha_reserva` datetime NOT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  `id_destino` int NOT NULL,
  `fecha_entrada` date NOT NULL,
  `hora_entrada` time NOT NULL,
  `numero_vuelo_entrada` varchar(50) NOT NULL,
  `origen_vuelo_entrada` varchar(50) NOT NULL,
  `hora_vuelo_salida` time NOT NULL,
  `fecha_vuelo_salida` date NOT NULL,
  `num_viajeros` int NOT NULL,
  `id_vehiculo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `transfer_reservas`
--

INSERT INTO `transfer_reservas` (`id_reserva`, `localizador`, `id_hotel`, `id_tipo_reserva`, `id_cliente`, `fecha_reserva`, `fecha_modificacion`, `id_destino`, `fecha_entrada`, `hora_entrada`, `numero_vuelo_entrada`, `origen_vuelo_entrada`, `hora_vuelo_salida`, `fecha_vuelo_salida`, `num_viajeros`, `id_vehiculo`) VALUES
(5, 'LOC67FD6FF9F18B7', NULL, 1, 5, '2025-04-14 20:28:41', NULL, 3, '2025-04-29', '22:29:00', 'A3455', 'Barcelona', '22:30:00', '2025-04-30', 2, 5),
(6, 'LOC67FD706E7CC0E', NULL, 1, 5, '2025-04-14 20:30:38', NULL, 2, '2025-05-04', '23:30:00', 'A3455', 'lolita', '22:31:00', '2025-05-11', 4, 5),
(8, 'LOC67FE61987A1BD', NULL, 1, 5, '2025-04-15 13:39:36', NULL, 2, '2025-05-04', '23:30:00', 'A3455', 'Barcelona', '22:31:00', '2025-05-11', 3, 5),
(9, 'LOC67FE619FD606F', NULL, 1, 5, '2025-04-15 13:39:43', NULL, 2, '2025-05-04', '23:30:00', 'A3455', 'Barcelona', '22:31:00', '2025-05-11', 3, 5),
(12, 'LOC67FE61D2B3FE5', NULL, 1, 5, '2025-04-15 13:40:34', NULL, 2, '2025-05-04', '23:30:00', 'A3455', 'Maldivas', '22:31:00', '2025-05-11', 9, 4),
(13, 'LOC67FE64C4A0CDA', NULL, 1, 5, '2025-04-15 13:53:08', NULL, 1, '2025-05-15', '15:55:00', 'A37809', 'Madrid', '16:53:00', '2025-05-24', 4, 1),
(15, 'LOC67FEB6D95C805', NULL, 1, 5, '2025-04-15 19:43:21', NULL, 1, '2025-04-24', '21:46:00', 'A3788', 'Barcelona', '21:46:00', '2025-04-26', 8, 3),
(16, 'LOC68028F294E6ED', NULL, 2, 5, '2025-04-18 17:43:05', NULL, 1, '2025-04-26', '21:42:00', 'A3789', 'Maldivas', '19:44:00', '2025-05-02', 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transfer_tipo_reserva`
--

CREATE TABLE `transfer_tipo_reserva` (
  `id_tipo_reserva` int NOT NULL,
  `descripcion` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `transfer_tipo_reserva`
--

INSERT INTO `transfer_tipo_reserva` (`id_tipo_reserva`, `descripcion`) VALUES
(1, 'Aeropuerto → Hotel'),
(2, 'Hotel → Aeropuerto'),
(4, 'Excursión'),
(5, 'Traslado Privado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transfer_vehiculo`
--

CREATE TABLE `transfer_vehiculo` (
  `id_vehiculo` int NOT NULL,
  `descripcion` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `email_conductor` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `transfer_vehiculo`
--

INSERT INTO `transfer_vehiculo` (`id_vehiculo`, `descripcion`, `email_conductor`, `password`) VALUES
(1, 'Mercedes Vito (8 pax)', 'conductor1@mail.com', 'pass123'),
(2, 'Volkswagen Caravelle (7 pax)', 'conductor2@mail.com', 'pass123'),
(3, 'Ford Transit (9 pax)', 'conductor3@mail.com', 'pass123'),
(4, 'Renault Trafic (9 pax)', 'conductor4@mail.com', 'pass123'),
(5, 'Citroen Jumpy (6 pax)', 'conductor5@mail.com', 'pass123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transfer_viajeros`
--

CREATE TABLE `transfer_viajeros` (
  `id_viajero` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido1` varchar(100) NOT NULL,
  `apellido2` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `codigoPostal` varchar(100) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `imagen_perfil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `transfer_viajeros`
--

INSERT INTO `transfer_viajeros` (`id_viajero`, `nombre`, `apellido1`, `apellido2`, `direccion`, `codigoPostal`, `ciudad`, `pais`, `email`, `password`, `imagen_perfil`) VALUES
(1, 'Manolo', 'García', 'López', 'Av Corts Catalanes 234', '08036', 'Barcelona', 'Espanya', 'probaviajero@mail.com', '$2y$10$8CRAIrs6mvTyYf1Dq305qOUglB2zyCMcyNjn.7n8sDnrTtOJUg8Pe', NULL),
(2, 'Argos', 'Anton', 'Panchón', 'Carrer de', '08036', 'Barcelona', 'España', 'aantonpan@uoc.edu', '$2y$10$1cFuBJLcuPSZpyHLoq8D7e.mFX.EsoP4e.GGpinlieCHXIeuEtfKC', 'perfil_1744824048_doncic.png'),
(3, 'admin1', '', '', '', '', '', '', 'admin1@mail.com', '$2y$10$cgrkXaWagIgJbR/pr/Juc.Oxxo9EEUYkdx/GtMO0nia1eal5ILbi2', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transfer_zona`
--

CREATE TABLE `transfer_zona` (
  `id_zona` int NOT NULL,
  `descripcion` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `transfer_zona`
--

INSERT INTO `transfer_zona` (`id_zona`, `descripcion`) VALUES
(1, 'Playa del Inglés'),
(2, 'Maspalomas'),
(3, 'Puerto Rico'),
(4, 'Las Palmas'),
(5, 'San Agustín');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipo` enum('particular','admin') DEFAULT 'particular',
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `email`, `password`, `tipo`, `creado_en`) VALUES
(5, 'aantonpan', 'aantonpan@uoc.edu', '$2y$10$1cFuBJLcuPSZpyHLoq8D7e.mFX.EsoP4e.GGpinlieCHXIeuEtfKC', 'particular', '2025-04-15 19:08:41'),
(6, 'admin', 'admin@mail.com', '$2y$10$IvMUXpddJ0IQ4G5DdknfJeWBIbKlW07SAheyl8kLNZpMG4W2tNhHu', 'admin', '2025-04-18 21:01:11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `transfer_hotel`
--
ALTER TABLE `transfer_hotel`
  ADD PRIMARY KEY (`id_hotel`),
  ADD KEY `FK_HOTEL_ZONA` (`id_zona`);

--
-- Indices de la tabla `transfer_precios`
--
ALTER TABLE `transfer_precios`
  ADD PRIMARY KEY (`id_precios`),
  ADD KEY `FK_PRECIOS_HOTEL` (`id_hotel`),
  ADD KEY `FK_PRECIOS_VEHICULO` (`id_vehiculo`);

--
-- Indices de la tabla `transfer_reservas`
--
ALTER TABLE `transfer_reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `FK_RESERVAS_DESTINO` (`id_destino`),
  ADD KEY `FK_RESERVAS_HOTEL` (`id_hotel`),
  ADD KEY `FK_RESERVAS_TIPO` (`id_tipo_reserva`),
  ADD KEY `FK_RESERVAS_VEHICULO` (`id_vehiculo`);

--
-- Indices de la tabla `transfer_tipo_reserva`
--
ALTER TABLE `transfer_tipo_reserva`
  ADD PRIMARY KEY (`id_tipo_reserva`);

--
-- Indices de la tabla `transfer_vehiculo`
--
ALTER TABLE `transfer_vehiculo`
  ADD PRIMARY KEY (`id_vehiculo`);

--
-- Indices de la tabla `transfer_viajeros`
--
ALTER TABLE `transfer_viajeros`
  ADD PRIMARY KEY (`id_viajero`);

--
-- Indices de la tabla `transfer_zona`
--
ALTER TABLE `transfer_zona`
  ADD PRIMARY KEY (`id_zona`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `transfer_hotel`
--
ALTER TABLE `transfer_hotel`
  MODIFY `id_hotel` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `transfer_precios`
--
ALTER TABLE `transfer_precios`
  MODIFY `id_precios` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `transfer_reservas`
--
ALTER TABLE `transfer_reservas`
  MODIFY `id_reserva` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `transfer_tipo_reserva`
--
ALTER TABLE `transfer_tipo_reserva`
  MODIFY `id_tipo_reserva` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `transfer_vehiculo`
--
ALTER TABLE `transfer_vehiculo`
  MODIFY `id_vehiculo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `transfer_viajeros`
--
ALTER TABLE `transfer_viajeros`
  MODIFY `id_viajero` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `transfer_zona`
--
ALTER TABLE `transfer_zona`
  MODIFY `id_zona` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `transfer_hotel`
--
ALTER TABLE `transfer_hotel`
  ADD CONSTRAINT `FK_HOTEL_ZONA` FOREIGN KEY (`id_zona`) REFERENCES `transfer_zona` (`id_zona`);

--
-- Filtros para la tabla `transfer_precios`
--
ALTER TABLE `transfer_precios`
  ADD CONSTRAINT `FK_PRECIOS_HOTEL` FOREIGN KEY (`id_hotel`) REFERENCES `transfer_hotel` (`id_hotel`),
  ADD CONSTRAINT `FK_PRECIOS_VEHICULO` FOREIGN KEY (`id_vehiculo`) REFERENCES `transfer_vehiculo` (`id_vehiculo`);

--
-- Filtros para la tabla `transfer_reservas`
--
ALTER TABLE `transfer_reservas`
  ADD CONSTRAINT `FK_RESERVAS_DESTINO` FOREIGN KEY (`id_destino`) REFERENCES `transfer_hotel` (`id_hotel`),
  ADD CONSTRAINT `FK_RESERVAS_HOTEL` FOREIGN KEY (`id_hotel`) REFERENCES `transfer_hotel` (`id_hotel`),
  ADD CONSTRAINT `FK_RESERVAS_TIPO` FOREIGN KEY (`id_tipo_reserva`) REFERENCES `transfer_tipo_reserva` (`id_tipo_reserva`),
  ADD CONSTRAINT `FK_RESERVAS_VEHICULO` FOREIGN KEY (`id_vehiculo`) REFERENCES `transfer_vehiculo` (`id_vehiculo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
