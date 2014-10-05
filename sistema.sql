-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2014 at 10:25 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sistema`
--

-- --------------------------------------------------------

--
-- Table structure for table `asignacion`
--

CREATE TABLE IF NOT EXISTS `asignacion` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `idVendedor` int(11) NOT NULL,
  `idAdmin` int(11) NOT NULL,
  PRIMARY KEY (`idProducto`),
  KEY `idVendedor` (`idVendedor`),
  KEY `idAdmin` (`idAdmin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE IF NOT EXISTS `color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`id`, `nombre`, `activo`) VALUES
(1, 'rojo', 1),
(2, 'azul', 1),
(3, 'blanco', 1),
(4, 'dorado', 1),
(5, 'amarillo', 1),
(6, 'naranja', 1),
(7, 'negro', 1),
(8, 'gris', 1);

-- --------------------------------------------------------

--
-- Table structure for table `compras`
--

CREATE TABLE IF NOT EXISTS `compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idMaterial` int(11) NOT NULL,
  `precio` float NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `fecha` date NOT NULL,
  `idCosto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idMaterial` (`idMaterial`),
  KEY `idCosto` (`idCosto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `costo`
--

CREATE TABLE IF NOT EXISTS `costo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `costo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gastos`
--

CREATE TABLE IF NOT EXISTS `gastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTipoGasto` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idCosto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo` (`idTipoGasto`),
  KEY `idTipoGasto` (`idTipoGasto`),
  KEY `idCosto` (`idCosto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accion` varchar(100) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fecha` (`fecha`),
  KEY `accion` (`accion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `accion`, `idUsuario`, `fecha`, `hora`) VALUES
(1, 'materiales/listar', 1, '2014-10-05', '2014-10-05 08:20:19'),
(2, 'inicio', 1, '2014-10-05', '2014-10-05 08:22:00');

-- --------------------------------------------------------

--
-- Table structure for table `lugar`
--

CREATE TABLE IF NOT EXISTS `lugar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `lugar`
--

INSERT INTO `lugar` (`id`, `nombre`, `activo`) VALUES
(1, 'kichink', 1);

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE IF NOT EXISTS `material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTipo` int(11) NOT NULL,
  `idColor` int(11) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  `cantidadMaterial` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idTipo` (`idTipo`),
  KEY `idColor` (`idColor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`id`, `idTipo`, `idColor`, `activo`, `cantidadMaterial`) VALUES
(1, 1, 1, 1, 1),
(2, 1, 2, 1, 1),
(3, 5, 5, 1, 1),
(4, 2, 6, 1, 1),
(5, 3, 8, 1, 1),
(6, 6, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `permiso`
--

CREATE TABLE IF NOT EXISTS `permiso` (
  `idRol` int(11) NOT NULL,
  `permiso` varchar(50) NOT NULL,
  PRIMARY KEY (`idRol`,`permiso`),
  KEY `idRol` (`idRol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permiso`
--

INSERT INTO `permiso` (`idRol`, `permiso`) VALUES
(1, 'materiales/listar'),
(1, 'productos/listar'),
(1, 'sesion/acceso_denegado'),
(2, 'sesion/acceso_denegado');

-- --------------------------------------------------------

--
-- Table structure for table `productomaterial`
--

CREATE TABLE IF NOT EXISTS `productomaterial` (
  `idProducto` int(11) NOT NULL,
  `idMaterial` int(11) NOT NULL,
  `cantidad` float DEFAULT '0',
  PRIMARY KEY (`idProducto`,`idMaterial`),
  KEY `fkMaterialPM` (`idMaterial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `precio` float DEFAULT '0',
  `descripcion` varchar(100) DEFAULT NULL,
  `idTipo` int(11) NOT NULL,
  `tiempo` float NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  `cantidadProducto` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tipo` (`idTipo`),
  KEY `idTipo` (`idTipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `descripcion`, `idTipo`, `tiempo`, `activo`, `cantidadProducto`) VALUES
(5, 'bolsa 1', 300, NULL, 3, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`id`, `nombre`) VALUES
(1, 'admin'),
(2, 'vendor');

-- --------------------------------------------------------

--
-- Table structure for table `tipogasto`
--

CREATE TABLE IF NOT EXISTS `tipogasto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tipomaterial`
--

CREATE TABLE IF NOT EXISTS `tipomaterial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `unidad` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tipomaterial`
--

INSERT INTO `tipomaterial` (`id`, `nombre`, `unidad`) VALUES
(1, 'estambre', 'm'),
(2, 'hilo', 'm'),
(3, 'tela', 'm2'),
(4, 'pintura', 'litro'),
(5, 'diamantina', 'gr'),
(6, 'cinta', 'm');

-- --------------------------------------------------------

--
-- Table structure for table `tipoproducto`
--

CREATE TABLE IF NOT EXISTS `tipoproducto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tipoproducto`
--

INSERT INTO `tipoproducto` (`id`, `nombre`) VALUES
(3, 'Bolsa');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `password` varchar(300) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `idRol` int(15) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `rol` (`idRol`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `nombre`, `genero`, `password`, `telefono`, `idRol`, `activo`) VALUES
(1, 'anaglezr13@gmail.com', 'Ana', 'femenino', '$2y$10$ocUoCyr6UwRmloc9ThH1X.NehSxN5ltTSi3aNB2yJngSgnRsBso9i', '6158699', 1, 1),
(3, 'manu.mora.24@gmail.com', 'Manuel Mora', 'masculino', '$2y$10$D50b9yMwqyQN3fmHE179AuQznjYASf3g0J94J0PSnl.rYwpfnNQdG', '442556798', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ventas`
--

CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idProducto` int(11) NOT NULL,
  `idVendedor` int(11) NOT NULL,
  `idLugar` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `producto` (`idProducto`,`idVendedor`,`idLugar`),
  KEY `vendedor` (`idVendedor`),
  KEY `lugar` (`idLugar`),
  KEY `idLugar` (`idLugar`),
  KEY `idProducto` (`idProducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ventas`
--

INSERT INTO `ventas` (`id`, `idProducto`, `idVendedor`, `idLugar`, `fecha`, `cantidad`) VALUES
(2, 5, 3, 1, '2014-08-10', 5);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asignacion`
--
ALTER TABLE `asignacion`
  ADD CONSTRAINT `fkAsignacionAdmin` FOREIGN KEY (`idAdmin`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkAsignacionVendedor` FOREIGN KEY (`idVendedor`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `fkComprasCosto` FOREIGN KEY (`idCosto`) REFERENCES `costo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkComprasMaterial` FOREIGN KEY (`idMaterial`) REFERENCES `material` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gastos`
--
ALTER TABLE `gastos`
  ADD CONSTRAINT `fkGastoCosto` FOREIGN KEY (`idCosto`) REFERENCES `costo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkGastoTipo` FOREIGN KEY (`idTipoGasto`) REFERENCES `tipogasto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `fkMaterialColor` FOREIGN KEY (`idColor`) REFERENCES `color` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkTipoMaterial` FOREIGN KEY (`idTipo`) REFERENCES `tipomaterial` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `fkPermisoRol` FOREIGN KEY (`idRol`) REFERENCES `rol` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `productomaterial`
--
ALTER TABLE `productomaterial`
  ADD CONSTRAINT `fkMaterialPM` FOREIGN KEY (`idMaterial`) REFERENCES `material` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkProductoPM` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fkProductosTipo` FOREIGN KEY (`idTipo`) REFERENCES `tipoproducto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fkUsuarioRol` FOREIGN KEY (`idRol`) REFERENCES `rol` (`id`);

--
-- Constraints for table `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fkVentasLugar` FOREIGN KEY (`idLugar`) REFERENCES `lugar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkVentasProducto` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkVentasVendedor` FOREIGN KEY (`idVendedor`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
