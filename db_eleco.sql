-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-10-2021 a las 01:06:27
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
(1, 'Croacia', 'El francés Sébastien Ogier, con Toyota, pasó a comandar ayer el Rally de Croacia, tercera competencia de la temporada del Mundial.', '2021-09-30 20:42:46', 2),
(2, 'En Portugal, continua la gira', 'El tandilense González volverá a competir en dupla con el italiano Bolelli. Debutarán ante Klaasen y McLachlan, segundos preclasificados.', '2021-09-30 20:42:46', 1),
(3, 'Fiscales reclaman medidas', 'La flamante Asociación de Agentes Fiscales provinciales solicitó la designación de funcionarios en puestos vacantes.', '2021-09-30 20:44:03', 1),
(27, 'Hola', 'Detalle', '2021-10-15 19:09:00', 3),
(30, 'La flamante', 'La flamante Asociación de Agentes Fiscales provinciales solicitó la designación de funcionarios en puestos vacantes.', '2021-10-21 19:30:00', 3),
(31, 'La flamante', 'Test La flamante Asociación de Agentes Fiscales provinciales solicitó la designación de funcionarios en puestos vacantes.', '2021-10-21 19:30:00', 2),
(32, 'La flamante', 'La flamante Asociación de Agentes Fiscales provinciales solicitó la designación de funcionarios en puestos vacantes.', '2021-10-21 19:30:00', 3),
(33, 'Nueva', 'La flamante Asociación de Agentes Fiscales provinciales solicitó la designación de funcionarios en puestos vacantes.', '2021-10-03 19:34:00', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE `seccion` (
  `id_seccion` int(11) NOT NULL,
  `nombre_seccion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`id_seccion`, `nombre_seccion`) VALUES
(1, 'Policiales'),
(2, 'Deportes'),
(3, 'Sociales'),
(4, 'La Ciudad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `password`, `rol`) VALUES
(5, 'admin@gmail.com', '$2y$10$H9EU/6Z47z6Pqp99PWJgAeVGLajqN0uOn/AkySU2F2TL8QYtiZAu2', 1),
(6, 'usuario@gmail.com', '$2y$10$jmNs9nvTKdVTcUvbeMWRTOp4TryFpZ/eGOG3OosB5rhnV5j5ikN0.', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id_noticia`),
  ADD KEY `fk_noticia_seccion_idx` (`id_seccion`);

--
-- Indices de la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`id_seccion`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `seccion`
--
ALTER TABLE `seccion`
  MODIFY `id_seccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `fk_noticia_seccion` FOREIGN KEY (`id_seccion`) REFERENCES `seccion` (`id_seccion`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
