-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-09-2014 a las 23:25:42
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sistema`
--
CREATE DATABASE IF NOT EXISTS `sistema` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sistema`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `color`
--

DROP TABLE IF EXISTS `color`;
CREATE TABLE IF NOT EXISTS `color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Truncar tablas antes de insertar `color`
--

TRUNCATE TABLE `color`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

DROP TABLE IF EXISTS `compras`;
CREATE TABLE IF NOT EXISTS `compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `material` int(11) NOT NULL,
  `precio` float NOT NULL,
  `concepto` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `material` (`material`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- RELACIONES PARA LA TABLA `compras`:
--   `material`
--       `material` -> `id`
--

--
-- Truncar tablas antes de insertar `compras`
--

TRUNCATE TABLE `compras`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

DROP TABLE IF EXISTS `gastos`;
CREATE TABLE IF NOT EXISTS `gastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` int(11) NOT NULL,
  `precio` float NOT NULL,
  `concepto` varchar(100) DEFAULT NULL,
  `fecha` date NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo` (`tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- RELACIONES PARA LA TABLA `gastos`:
--   `tipo`
--       `tipogasto` -> `id`
--

--
-- Truncar tablas antes de insertar `gastos`
--

TRUNCATE TABLE `gastos`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

DROP TABLE IF EXISTS `genero`;
CREATE TABLE IF NOT EXISTS `genero` (
  `tipogenero` varchar(10) NOT NULL,
  PRIMARY KEY (`tipogenero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncar tablas antes de insertar `genero`
--

TRUNCATE TABLE `genero`;
--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`tipogenero`) VALUES
('Femenino'),
('Masculino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugar`
--

DROP TABLE IF EXISTS `lugar`;
CREATE TABLE IF NOT EXISTS `lugar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Truncar tablas antes de insertar `lugar`
--

TRUNCATE TABLE `lugar`;
--
-- Volcado de datos para la tabla `lugar`
--

INSERT INTO `lugar` (`id`, `nombre`) VALUES
(1, 'kichink');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

DROP TABLE IF EXISTS `material`;
CREATE TABLE IF NOT EXISTS `material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `tipo` int(11) NOT NULL,
  `color` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `color` (`color`),
  KEY `color_2` (`color`),
  KEY `tipo` (`tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- RELACIONES PARA LA TABLA `material`:
--   `tipo`
--       `tipomaterial` -> `id`
--   `color`
--       `color` -> `id`
--

--
-- Truncar tablas antes de insertar `material`
--

TRUNCATE TABLE `material`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `precio` float NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `tipo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo` (`tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- RELACIONES PARA LA TABLA `productos`:
--   `tipo`
--       `tipoproducto` -> `id`
--

--
-- Truncar tablas antes de insertar `productos`
--

TRUNCATE TABLE `productos`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `tiporol` varchar(15) NOT NULL,
  PRIMARY KEY (`tiporol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncar tablas antes de insertar `rol`
--

TRUNCATE TABLE `rol`;
--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`tiporol`) VALUES
('Administrador'),
('Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipogasto`
--

DROP TABLE IF EXISTS `tipogasto`;
CREATE TABLE IF NOT EXISTS `tipogasto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Truncar tablas antes de insertar `tipogasto`
--

TRUNCATE TABLE `tipogasto`;
--
-- Volcado de datos para la tabla `tipogasto`
--

INSERT INTO `tipogasto` (`id`, `nombre`) VALUES
(1, 'Viatico'),
(2, 'Sueldo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipomaterial`
--

DROP TABLE IF EXISTS `tipomaterial`;
CREATE TABLE IF NOT EXISTS `tipomaterial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Truncar tablas antes de insertar `tipomaterial`
--

TRUNCATE TABLE `tipomaterial`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoproducto`
--

DROP TABLE IF EXISTS `tipoproducto`;
CREATE TABLE IF NOT EXISTS `tipoproducto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Truncar tablas antes de insertar `tipoproducto`
--

TRUNCATE TABLE `tipoproducto`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(30) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `clave` varchar(30) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `rol` varchar(15) NOT NULL,
  `correo` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `genero` (`genero`,`rol`),
  KEY `rol` (`rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- RELACIONES PARA LA TABLA `usuario`:
--   `rol`
--       `rol` -> `tiporol`
--   `genero`
--       `genero` -> `tipogenero`
--

--
-- Truncar tablas antes de insertar `usuario`
--

TRUNCATE TABLE `usuario`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto` int(11) NOT NULL,
  `vendedor` int(11) NOT NULL,
  `lugar` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `producto` (`producto`,`vendedor`,`lugar`),
  KEY `vendedor` (`vendedor`),
  KEY `lugar` (`lugar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- RELACIONES PARA LA TABLA `ventas`:
--   `lugar`
--       `lugar` -> `id`
--   `producto`
--       `productos` -> `id`
--   `vendedor`
--       `usuario` -> `id`
--

--
-- Truncar tablas antes de insertar `ventas`
--

TRUNCATE TABLE `ventas`;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`material`) REFERENCES `material` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD CONSTRAINT `tipogastogas` FOREIGN KEY (`tipo`) REFERENCES `tipogasto` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `tipomaterial` FOREIGN KEY (`tipo`) REFERENCES `tipomaterial` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `colormaterial` FOREIGN KEY (`color`) REFERENCES `color` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productostipo` FOREIGN KEY (`tipo`) REFERENCES `tipoproducto` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `rolusuario` FOREIGN KEY (`rol`) REFERENCES `rol` (`tiporol`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuariogenero` FOREIGN KEY (`genero`) REFERENCES `genero` (`tipogenero`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `lugarventas` FOREIGN KEY (`lugar`) REFERENCES `lugar` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productoventas` FOREIGN KEY (`producto`) REFERENCES `productos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `vendedorventas` FOREIGN KEY (`vendedor`) REFERENCES `usuario` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
