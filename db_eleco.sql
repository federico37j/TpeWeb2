-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2021 a las 20:46:10
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_eleco`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id_comentario` int(11) NOT NULL,
  `descripcion` varchar(450) NOT NULL,
  `puntaje` int(11) NOT NULL,
  `fecha_actual` datetime NOT NULL,
  `id_noticia` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id_comentario`, `descripcion`, `puntaje`, `fecha_actual`, `id_noticia`, `id_usuario`) VALUES
(38, 'Testing comentario noticia....', 2, '2021-11-24 16:40:28', 137, 12),
(39, 'Testing comentario noticia....', 4, '2021-11-24 16:40:49', 137, 12),
(40, 'Testing comentario noticia....', 2, '2021-11-24 16:41:04', 137, 12),
(41, 'Testing comentario noticia....', 4, '2021-11-24 16:41:47', 138, 12),
(42, 'Testing comentario noticia....', 3, '2021-11-24 16:41:58', 138, 12),
(43, 'Testing comentario noticia....', 3, '2021-11-24 16:42:44', 139, 28),
(44, 'Testing comentario noticia....', 2, '2021-11-24 16:42:55', 139, 28),
(45, 'Testing comentario noticia....', 5, '2021-11-24 16:43:05', 140, 28),
(46, 'Testing comentario noticia....', 4, '2021-11-24 16:43:12', 140, 28),
(47, 'Testing comentario noticia....', 4, '2021-11-24 16:43:26', 141, 28),
(48, 'Testing comentario noticia....', 5, '2021-11-24 16:43:35', 141, 28),
(49, 'Testing comentario noticia....', 3, '2021-11-24 16:43:56', 142, 28),
(50, 'Testing comentario noticia....', 4, '2021-11-24 16:44:02', 142, 28),
(51, 'Testing comentario noticia....', 2, '2021-11-24 16:44:12', 143, 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id_imagen` int(11) NOT NULL,
  `imagen` varchar(45) NOT NULL,
  `id_noticia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id_imagen`, `imagen`, `id_noticia`) VALUES
(71, 'img/noticias/619e91c096997.jpg', 137),
(72, 'img/noticias/619e91f5143d0.jpg', 138),
(73, 'img/noticias/619e921c4a16b.jpg', 139),
(74, 'img/noticias/619e925369342.jpg', 140),
(75, 'img/noticias/619e92fdd32b5.jpg', 141),
(76, 'img/noticias/619e93752aa25.jpg', 142),
(77, 'img/noticias/619e94755b0c4.jpeg', 143);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticia` (
  `id_noticia` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `detalle` varchar(300) NOT NULL,
  `fecha_subida` datetime NOT NULL,
  `id_seccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`id_noticia`, `titulo`, `detalle`, `fecha_subida`, `id_seccion`) VALUES
(137, 'Ogier es puntero en Croacia', 'El francés Sébastien Ogier, con Toyota, pasó a comandar ayer el Rally de Croacia, tercera competencia de la temporada del Mundial.', '2021-11-23 17:25:00', 33),
(138, 'En Portugal, continua la gira', 'El tandilense González volverá a competir en dupla con el italiano Bolelli. Debutarán ante Klaasen y McLachlan, segundos preclasificados.', '2021-11-24 02:26:00', 33),
(139, 'Santamarina busca hacer pie', 'Recibe a Brown de Adrogué. Se adelantó el horario y comenzará a las 15. El aurinegro llega con cinco partidos seguidos sin ganar e importantes bajas en su formación.', '2021-11-22 16:33:00', 33),
(140, 'Fiscales reclaman medidas', 'La flamante Asociación de Agentes Fiscales provinciales solicitó la designación de funcionarios en puestos vacantes.', '2021-11-21 16:28:00', 34),
(141, 'Una imprudente maniobra', 'Ayer por la tarde, un automóvil embistió a una moto mientras circulaba por la avenida España al intentar realizar una maniobra prohibida.', '2021-11-24 16:30:00', 34),
(142, 'Dos internos a facazos', 'Una pelea entre internos en la celda que compartían, faca en mano, terminó en un homicidio.', '2021-11-24 16:32:00', 34),
(143, 'La Escuela Técnica 1', 'Ofrece educación secundaria gratuita con orientación en electromecánica y rápida salida laboral', '2021-11-24 16:36:00', 35);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE `seccion` (
  `id_seccion` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`id_seccion`, `nombre`) VALUES
(33, 'Deportes'),
(34, 'Policiales'),
(35, 'La Ciudad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `email`, `password`, `id_rol`) VALUES
(12, 'admin@gmail.com', '$2y$10$1vgm4zxsUiir6rKgN5EET.lIaDo9vY1dYeHMzc7Mvwh5W3g4p80cu', 1),
(28, 'usuario@gmail.com', '$2y$10$PMSVP5H8L0TqxCUDWcGih.UYQ6tJrVMKG8J5d5jPe3FmyU2XaQLoK', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `fk_comentario_noticia1_idx` (`id_noticia`),
  ADD KEY `fk_comentario_usuario1_idx` (`id_usuario`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id_imagen`),
  ADD KEY `fk_imagen_noticia1_idx` (`id_noticia`);

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id_noticia`),
  ADD KEY `fk_noticia_seccion_idx` (`id_seccion`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`id_seccion`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_usuario_rol1_idx` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `seccion`
--
ALTER TABLE `seccion`
  MODIFY `id_seccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fk_comentario_noticia1` FOREIGN KEY (`id_noticia`) REFERENCES `noticia` (`id_noticia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comentario_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `fk_imagen_noticia1` FOREIGN KEY (`id_noticia`) REFERENCES `noticia` (`id_noticia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `fk_noticia_seccion` FOREIGN KEY (`id_seccion`) REFERENCES `seccion` (`id_seccion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_rol1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
