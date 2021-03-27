-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-03-2021 a las 23:29:56
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `batalla`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tableros`
--

CREATE TABLE `tableros` (
  `id` int(10) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `usuario1_id` int(10) NOT NULL,
  `usuario2_id` int(10) NOT NULL,
  `estatus` varchar(15) NOT NULL,
  `ganador_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tableros`
--

INSERT INTO `tableros` (`id`, `codigo`, `usuario1_id`, `usuario2_id`, `estatus`, `ganador_id`, `created_at`, `updated_at`) VALUES
(86, 'hHNnL', 13, 14, 'finalizado', 14, '2021-03-27 22:17:18', '2021-03-28 04:17:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tablero_barcos`
--

CREATE TABLE `tablero_barcos` (
  `id` int(10) NOT NULL,
  `tablero_id` int(10) NOT NULL,
  `usuario_id` int(10) NOT NULL,
  `barco1` int(10) NOT NULL,
  `barco2` int(10) NOT NULL,
  `barco3` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tablero_barcos`
--

INSERT INTO `tablero_barcos` (`id`, `tablero_id`, `usuario_id`, `barco1`, `barco2`, `barco3`, `created_at`, `updated_at`) VALUES
(148, 86, 13, 11, 9, 10, '2021-03-28 04:15:24', '2021-03-28 04:15:24'),
(149, 86, 14, 1, 2, 3, '2021-03-28 04:15:33', '2021-03-28 04:15:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tablero_movimiento`
--

CREATE TABLE `tablero_movimiento` (
  `id` int(10) NOT NULL,
  `tablero_id` int(10) NOT NULL,
  `usuario_id` int(10) NOT NULL,
  `posicion` int(10) NOT NULL,
  `estatus` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tablero_movimiento`
--

INSERT INTO `tablero_movimiento` (`id`, `tablero_id`, `usuario_id`, `posicion`, `estatus`, `created_at`, `updated_at`) VALUES
(408, 86, 13, 1, '1', '2021-03-28 04:15:50', '2021-03-28 04:15:50'),
(409, 86, 14, 1, '0', '2021-03-28 04:16:03', '2021-03-28 04:16:03'),
(410, 86, 13, 6, '0', '2021-03-28 04:16:18', '2021-03-28 04:16:18'),
(411, 86, 14, 9, '1', '2021-03-28 04:16:23', '2021-03-28 04:16:23'),
(412, 86, 13, 9, '0', '2021-03-28 04:16:30', '2021-03-28 04:16:30'),
(413, 86, 14, 10, '1', '2021-03-28 04:16:38', '2021-03-28 04:16:38'),
(414, 86, 13, 7, '0', '2021-03-28 04:16:44', '2021-03-28 04:16:44'),
(415, 86, 14, 11, '1', '2021-03-28 04:16:49', '2021-03-28 04:16:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `correo`, `password`, `created_at`, `updated_at`) VALUES
(12, 'prueba5@gmail.com', '$2y$10$jC6yxdrFuZokLgd/RMZz9.krVFmLKwfh/7LfM4TbSnHNnXUSEWjwq', '2021-03-28 02:34:11', '2021-03-28 02:34:11'),
(13, 'prueba1@gmail.com', '$2y$10$BrVEW4Yj3MfsBGlIwoyPAeYdPKJOsC99DGLWCQ/bVmwLiGFsFKzzy', '2021-03-28 02:34:29', '2021-03-28 02:34:29'),
(14, 'prueba2@gmail.com', '$2y$10$/fR5SdOeg3A5XPnTHF7RLO4/syb33E7ojnQv3Qgckhpw.wXV5CAxe', '2021-03-28 02:35:00', '2021-03-28 02:35:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tableros`
--
ALTER TABLE `tableros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tablero_barcos`
--
ALTER TABLE `tablero_barcos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `tablero_id` (`tablero_id`);

--
-- Indices de la tabla `tablero_movimiento`
--
ALTER TABLE `tablero_movimiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarioId` (`usuario_id`),
  ADD KEY `tableroId` (`tablero_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tableros`
--
ALTER TABLE `tableros`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de la tabla `tablero_barcos`
--
ALTER TABLE `tablero_barcos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT de la tabla `tablero_movimiento`
--
ALTER TABLE `tablero_movimiento`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=416;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tablero_barcos`
--
ALTER TABLE `tablero_barcos`
  ADD CONSTRAINT `tablero_id` FOREIGN KEY (`tablero_id`) REFERENCES `tableros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tablero_movimiento`
--
ALTER TABLE `tablero_movimiento`
  ADD CONSTRAINT `tableroId` FOREIGN KEY (`tablero_id`) REFERENCES `tableros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarioId` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
