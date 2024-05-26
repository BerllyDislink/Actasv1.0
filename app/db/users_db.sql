-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-05-2024 a las 23:59:18
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
--
-- Base de datos: `users_db`
--

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `actas`
--

CREATE TABLE `actas` (
  `actas_id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `fecha_de_creacion` date NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Volcado de datos para la tabla `actas`
--

INSERT INTO `actas` (
    `actas_id`,
    `nombre`,
    `descripcion`,
    `fecha_de_creacion`
  )
VALUES (3, 'acta', 'faasgsdhgdfg', '2024-05-01'),
  (5, 'sdgsdg', 'dsgsdg', '2024-05-01'),
  (6, 'sdfdsf', 'sdfsdf', '2024-05-02');
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `compromisos`
--

CREATE TABLE `compromisos` (
  `compromisos_id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `estado` int(1) NOT NULL,
  `fk_actas_id` int(11) DEFAULT NULL,
  `responsable_users_id` int(11) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Volcado de datos para la tabla `compromisos`
--

INSERT INTO `compromisos` (
    `compromisos_id`,
    `nombre`,
    `descripcion`,
    `estado`,
    `fk_actas_id`,
    `responsable_users_id`
  )
VALUES (5, 'sdf', 'sdf', 1, 3, 27),
  (16, 'das', 'asd', 2, 5, 28),
  (17, 'das', 'asd', 2, 5, 28),
  (23, 'fgjhsfghfsgh', 'sfghsfghsfgh', 3, 5, 29);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `password` varchar(128) NOT NULL,
  `nombres` varchar(250) NOT NULL,
  `apellidos` varchar(250) NOT NULL,
  `facultad` varchar(250) NOT NULL,
  `carrera` varchar(250) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (
    `users_id`,
    `correo`,
    `password`,
    `nombres`,
    `apellidos`,
    `facultad`,
    `carrera`
  )
VALUES (27, 'da', 'ads', 'ads', 'da', 'ads', 'ads'),
  (
    28,
    'nataniel@hotmail.com',
    '$2y$10$2btCB3C6TtcbXVt6O6EAH.2qqhFrN3bM98N9Lk0TvlCb.BpENh2/C',
    'a',
    'a',
    'a',
    'a'
  ),
  (
    29,
    'erhdfh',
    'dfhdafh',
    'dfhdfh',
    'dfahdfah',
    'adfhadfh',
    'adfhdfh'
  ),
  (
    30,
    'a',
    '$2y$10$Ci6Bu.aMyldR75duHGbRj.8q6ZnVSQ94X.ZQ.hDiIlLy7HNez7jkG',
    's',
    's',
    's',
    's'
  );
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `users_actas`
--

CREATE TABLE `users_actas` (
  `fk_actas_id` int(11) NOT NULL,
  `fk_users_id` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Volcado de datos para la tabla `users_actas`
--

INSERT INTO `users_actas` (`fk_actas_id`, `fk_users_id`)
VALUES (3, 27),
  (3, 28),
  (3, 29),
  (5, 30);
--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actas`
--
ALTER TABLE `actas`
ADD PRIMARY KEY (`actas_id`);
--
-- Indices de la tabla `compromisos`
--
ALTER TABLE `compromisos`
ADD PRIMARY KEY (`compromisos_id`),
  ADD KEY `fk_actas_id` (`fk_actas_id`),
  ADD KEY `fk_users_id` (`responsable_users_id`);
--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY (`users_id`);
--
-- Indices de la tabla `users_actas`
--
ALTER TABLE `users_actas`
ADD UNIQUE KEY `unique_pair` (`fk_actas_id`, `fk_users_id`) USING BTREE,
  ADD KEY `fk_actas_id` (`fk_actas_id`),
  ADD KEY `fk_users_id` (`fk_users_id`);
--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actas`
--
ALTER TABLE `actas`
MODIFY `actas_id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 7;
--
-- AUTO_INCREMENT de la tabla `compromisos`
--
ALTER TABLE `compromisos`
MODIFY `compromisos_id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 24;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 31;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compromisos`
--
ALTER TABLE `compromisos`
ADD CONSTRAINT `compromisos_ibfk_1` FOREIGN KEY (`fk_actas_id`) REFERENCES `actas` (`actas_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compromisos_ibfk_2` FOREIGN KEY (`responsable_users_id`) REFERENCES `users` (`users_id`) ON DELETE
SET NULL ON UPDATE CASCADE;
--
-- Filtros para la tabla `users_actas`
--
ALTER TABLE `users_actas`
ADD CONSTRAINT `users_actas_ibfk_1` FOREIGN KEY (`fk_actas_id`) REFERENCES `actas` (`actas_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_actas_ibfk_2` FOREIGN KEY (`fk_users_id`) REFERENCES `users` (`users_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;