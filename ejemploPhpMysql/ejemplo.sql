-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-09-2015 a las 03:12:00
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.9

--
-- Base de datos: `ejemplo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noticia` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `noticia`) VALUES
(1, '<p>El peso de la producción agrícola y las manufacturas derivadas en las exportaciones de la Argentina se acentuó desde la salida de la convertibilidad. En la actualidad, más del 40% de las ventas externas nacionales corresponden a este rubro. Por eso, el declive pronunciado de las cotizaciones de las materias primas es una referencia de extrema relevancia para trazar un diagnóstico de la actual coyuntura económica.</p>'),
(2, '<p>Los precios del petróleo cayeron en forma contundente este martes al cierre de los intercambios europeos, tras la publicación de índices manufactureros decepcionantes en China y Estados Unidos, que levantan las preocupaciones sobre la demanda de crudo.</p>\r\n<p>\r\nLos precios internacionales del petróleo cerraron con un retroceso de más de un 7% tras una sesión volátil y el barril de Brent bajó del nivel de los 50 dólares.</p>'),
(3, '<p>CHIMPAY (AVM).- Un minucioso testimonio acerca de un milagro de Ceferino Namuncurá, que se habría dado con una niña en Perú, le fue enviado al papa Francisco.</p>\r\n<p>\r\nEl padre Pedro Narambuena, de Trelew, concurre desde hace años a Chimpay y es una parte importante de la organización. "Vivo esta fiesta, para mí es un momento muy especial cuando llega agosto y hay que prepararse para el viaje hasta aquí, con qué gusto lo hago", comenta el padre Pedro.</p>'),
(4, '<p>El gobierno provincial entregó ayer las llaves de siete nuevas motoniveladoras -marca John Deere- a la Dirección de Vialidad Rionegrina (DVR) para que sean asignadas como refuerzo en las delegaciones de Viedma, Pomona, San Antonio Oeste, General Roca, Los Menucos y Bariloche. En poco tiempo más habrá en operatividad 31 máquinas viales que permitirá duplicar el actual parque.</p>');
