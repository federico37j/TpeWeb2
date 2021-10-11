-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-10-2021 a las 23:57:37
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
(41, 'Se solucionó el problema del centro de salud ', 'Uno de los profesionales que terminó la residencia que justamente llevaba adelante en ese centro de salud, fue designado como médico generalista. De ese modo, se resolvió el problema que afectaba a la barriada desde abril, y que contaba con diversos reclamos que se habían hecho públicos.', '2021-10-11 23:43:31', 20),
(44, 'Fuerte retracción en la oferta departamentos ', 'El presidente del Centro de Martilleros de Tandil Gustavo Favre consideró que eso se debe principalmente a la nueva ley, que ya cumplió un año desde que comenzó a implementarse. En cuanto a la venta de propiedades, indicó que “va remontando muy lento, y a precios en dólares mucho más bajos de los qu', '2021-10-10 18:45:58', 4),
(45, 'Independiente dejó ver su peor versión', 'En el Martignoni, Pueblo Nuevo lo vapuleó por 80-60. Liderados por un notable Menna (29 puntos), los olavarrienses aseguraron su presencia en segunda fase. El rojinegro deberá vencer a Smata para avanzar.', '2021-10-06 18:47:52', 2),
(46, 'Ferro no lo liquidó y lo pagó con dos puntos', 'En la Estación, igualó 2-2 con Loma Negra. La visita jugó casi una hora en inferioridad numérica. Abad dejó de ser el entrenador del tricolor.', '2021-10-04 18:49:42', 2),
(47, 'Soberbia actuación de Argentina', 'Liderado por un Messi brillante, el equipo de Scaloni ganó 3-0 en el Monumental. El rosarino abrió el marcador, y también anotaron De Paul y Lautaro Martínez. El jueves, el choque ante Perú, nuevamente en Núñez.', '2021-10-10 18:50:03', 2),
(48, 'Una familia volcó en Cerro Leones', 'Una familia volcó en Cerro Leones, tres menores resultaron heridos y uno debió ser trasladado a Mar del Plata', '2021-10-09 18:51:43', 21),
(49, 'La OMS recomendó una tercera dosis', 'La OMS recomendó una tercera dosis contra el coronavirus a personas inmunodeprimidas', '2021-10-09 18:53:12', 3),
(50, 'Comisión de Producción', 'Se estima que podría recibir dictamen favorable para habilitar su tratamiento en la sesión del jueves próximo. La iniciativa avanza sobre los ejes salud pública, información a los consumidores y sostener la calidad de los productos ', '2021-10-11 23:54:38', 3),
(51, 'El Concejo busca sancionar una ordenanza', 'La propuesta se encuentra en estudio en la Comisión de Producción y se estima que podría recibir dictamen favorable para habilitar su tratamiento en la sesión del jueves próximo.', '2021-10-11 23:54:38', 3),
(52, 'Más de dos años después', 'El jueves se comenzaron a implementar en el Municipio las capacitaciones obligatorias en materia de género, a cargo de la Unicen.', '2021-10-11 23:57:07', 4);

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
(2, 'Deportes'),
(3, 'Sociales'),
(4, 'La Ciudad'),
(20, 'Salud'),
(21, 'Policiales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `email`, `password`, `rol`) VALUES
(5, 'admin@gmail.com', '$2y$10$H9EU/6Z47z6Pqp99PWJgAeVGLajqN0uOn/AkySU2F2TL8QYtiZAu2', 1),
(6, 'usuario@gmail.com', '$2y$10$jmNs9nvTKdVTcUvbeMWRTOp4TryFpZ/eGOG3OosB5rhnV5j5ikN0.', 0),
(7, 'federicoarambillet37@gmail.com', '$2y$10$Lx9dLddxkhJwgDWGl.O77eTcrdIvhH5FlM1hRqASTfNYtEfUDTbyu', 0);

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
  MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `seccion`
--
ALTER TABLE `seccion`
  MODIFY `id_seccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
