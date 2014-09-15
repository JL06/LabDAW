-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2014 at 11:05 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cake`
--
--
-- Database: `cdcol`
--

-- --------------------------------------------------------

--
-- Table structure for table `cds`
--

CREATE TABLE IF NOT EXISTS `cds` (
  `titel` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `interpret` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `jahr` int(11) DEFAULT NULL,
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cds`
--

INSERT INTO `cds` (`titel`, `interpret`, `jahr`, `id`) VALUES
('Beauty', 'Ryuichi Sakamoto', 1990, 1),
('Goodbye Country (Hello Nightclub)', 'Groove Armada', 2001, 4),
('Glee', 'Bran Van 3000', 1997, 5);
--
-- Database: `phpmyadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `pma_bookmark`
--

CREATE TABLE IF NOT EXISTS `pma_bookmark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pma_column_info`
--

CREATE TABLE IF NOT EXISTS `pma_column_info` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin' AUTO_INCREMENT=41 ;

--
-- Dumping data for table `pma_column_info`
--

INSERT INTO `pma_column_info` (`id`, `db_name`, `table_name`, `column_name`, `comment`, `mimetype`, `transformation`, `transformation_options`) VALUES
(1, 'sistema', 'compras', 'idMaterial', '', '', '_', ''),
(2, 'sistema', 'compras', 'idCosto', '', '', '_', ''),
(3, 'sistema', 'compras', 'fecha', '', '', '_', ''),
(4, 'sistema', 'compras', 'cantidad', '', '', '_', ''),
(5, 'sistema', 'gastos', 'nombre', '', '', '_', ''),
(6, 'sistema', 'gastos', 'idCosto', '', '', '_', ''),
(7, 'sistema', 'material', 'idColor', '', '', '_', ''),
(8, 'sistema', 'material', 'idTipo', '', '', '_', ''),
(9, 'sistema', 'productos', 'idTipo', '', '', '_', ''),
(13, 'sistema', 'rol', 'nombre', '', '', '_', ''),
(12, 'sistema', 'rol', 'id', '', '', '_', ''),
(14, 'sistema', 'usuario', 'email', '', '', '_', ''),
(15, 'sistema', 'usuario', 'password', '', '', '_', ''),
(16, 'sistema', 'usuario', 'idRol', '', '', '_', ''),
(17, 'sistema', 'ventas', 'idProducto', '', '', '_', ''),
(18, 'sistema', 'ventas', 'idVendedor', '', '', '_', ''),
(19, 'sistema', 'ventas', 'idLugar', '', '', '_', ''),
(20, 'sistema', 'asignacion', 'idProducto', '', '', '_', ''),
(21, 'sistema', 'asignacion', 'idVendedor', '', '', '_', ''),
(22, 'sistema', 'asignacion', 'idAdmin', '', '', '_', ''),
(23, 'sistema', 'costo', 'id', '', '', '_', ''),
(24, 'sistema', 'costo', 'costo', '', '', '_', ''),
(25, 'sistema', 'productomaterial', 'idProducto', '', '', '_', ''),
(26, 'sistema', 'productomaterial', 'idMaterial', '', '', '_', ''),
(27, 'sistema', 'permiso', 'idRol', '', '', '_', ''),
(28, 'sistema', 'permiso', 'permiso', '', '', '_', ''),
(29, 'sistema', 'tipogasto', 'id', '', '', '_', ''),
(30, 'sistema', 'tipogasto', 'nombre', '', '', '_', ''),
(31, 'sistema', 'gastos', 'idTipoGasto', '', '', '_', ''),
(32, 'sistema', 'ventas', 'idProductos', '', '', '_', ''),
(33, 'sistema', 'tipomaterial', 'unidad', '', '', '_', ''),
(34, 'sistema', 'productos', 'cantidadMaterial', '', '', '_', ''),
(35, 'sistema', 'productos', 'tiempo', '', '', '_', ''),
(36, 'sistema', 'color', 'activo', '', '', '_', ''),
(37, 'sistema', 'lugar', 'activo', '', '', '_', ''),
(38, 'sistema', 'material', 'activo', '', '', '_', ''),
(39, 'sistema', 'productos', 'activo', '', '', '_', ''),
(40, 'sistema', 'usuario', 'activo', '', '', '_', '');

-- --------------------------------------------------------

--
-- Table structure for table `pma_designer_coords`
--

CREATE TABLE IF NOT EXISTS `pma_designer_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `x` int(11) DEFAULT NULL,
  `y` int(11) DEFAULT NULL,
  `v` tinyint(4) DEFAULT NULL,
  `h` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`db_name`,`table_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma_history`
--

CREATE TABLE IF NOT EXISTS `pma_history` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sqlquery` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`,`db`,`table`,`timevalue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pma_pdf_pages`
--

CREATE TABLE IF NOT EXISTS `pma_pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`page_nr`),
  KEY `db_name` (`db_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pma_recent`
--

CREATE TABLE IF NOT EXISTS `pma_recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma_recent`
--

INSERT INTO `pma_recent` (`username`, `tables`) VALUES
('root', '[{"db":"sistema","table":"usuario"},{"db":"sistema","table":"tipomaterial"},{"db":"sistema","table":"tipogasto"},{"db":"sistema","table":"rol"},{"db":"sistema","table":"productos"},{"db":"sistema","table":"productomaterial"},{"db":"sistema","table":"permiso"},{"db":"sistema","table":"material"},{"db":"sistema","table":"lugar"},{"db":"sistema","table":"color"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma_relation`
--

CREATE TABLE IF NOT EXISTS `pma_relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  KEY `foreign_field` (`foreign_db`,`foreign_table`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma_table_coords`
--

CREATE TABLE IF NOT EXISTS `pma_table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT '0',
  `x` float unsigned NOT NULL DEFAULT '0',
  `y` float unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma_table_info`
--

CREATE TABLE IF NOT EXISTS `pma_table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`db_name`,`table_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma_table_uiprefs`
--

CREATE TABLE IF NOT EXISTS `pma_table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`,`db_name`,`table_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma_tracking`
--

CREATE TABLE IF NOT EXISTS `pma_tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) unsigned NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin,
  `data_sql` longtext COLLATE utf8_bin,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`db_name`,`table_name`,`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma_userconfig`
--

CREATE TABLE IF NOT EXISTS `pma_userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `config_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma_userconfig`
--

INSERT INTO `pma_userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2014-08-14 20:40:28', '{"collation_connection":"utf8mb4_general_ci"}');
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
  PRIMARY KEY (`idProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE IF NOT EXISTS `color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `activo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`id`, `nombre`, `activo`) VALUES
(1, 'rojo', 0),
(2, 'azul', 0),
(3, 'blanco', 0),
(4, 'dorado', 0),
(5, 'amarillo', 0),
(6, 'naranja', 0),
(7, 'negro', 0),
(8, 'gris', 0);

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
  KEY `material` (`idMaterial`)
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
  KEY `tipo` (`idTipoGasto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lugar`
--

CREATE TABLE IF NOT EXISTS `lugar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `activo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `lugar`
--

INSERT INTO `lugar` (`id`, `nombre`, `activo`) VALUES
(1, 'kichink', 0);

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE IF NOT EXISTS `material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTipo` int(11) NOT NULL,
  `idColor` int(11) NOT NULL,
  `activo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `color` (`idColor`),
  KEY `color_2` (`idColor`),
  KEY `tipo` (`idTipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`id`, `idTipo`, `idColor`, `activo`) VALUES
(1, 1, 1, 0),
(2, 1, 2, 0),
(3, 5, 5, 0),
(4, 2, 6, 0),
(5, 3, 8, 0),
(6, 6, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `permiso`
--

CREATE TABLE IF NOT EXISTS `permiso` (
  `idRol` int(11) NOT NULL,
  `permiso` varchar(50) NOT NULL,
  PRIMARY KEY (`idRol`,`permiso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `productomaterial`
--

CREATE TABLE IF NOT EXISTS `productomaterial` (
  `idProducto` int(11) NOT NULL,
  `idMaterial` int(11) NOT NULL,
  PRIMARY KEY (`idProducto`,`idMaterial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productomaterial`
--

INSERT INTO `productomaterial` (`idProducto`, `idMaterial`) VALUES
(6, 1),
(6, 2),
(7, 3),
(7, 5),
(7, 6),
(8, 2),
(8, 4);

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `precio` float NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `idTipo` int(11) NOT NULL,
  `cantidadMaterial` float NOT NULL,
  `tiempo` float NOT NULL,
  `activo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo` (`idTipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `descripcion`, `idTipo`, `cantidadMaterial`, `tiempo`, `activo`) VALUES
(1, 'Llavero gato', 35.5, '10cm x 10cm', 1, 0, 0, 0),
(2, 'Collar de cuentas', 52, '30 cm de radio', 2, 0, 0, 0),
(3, 'Taza', 32, 'llavero de taza', 1, 0, 0, 0),
(4, 'llavero flor', 23, '', 1, 0, 0, 0),
(5, 'Bolsa hippie', 50, '30 cm de ancho', 3, 0, 0, 0),
(6, 'Llavero de estambre', 20, '', 1, 0, 0, 0),
(7, 'Bolsa hippie 2', 70, '45 cm', 3, 0, 0, 0),
(8, 'collar fashion', 40, '', 2, 0, 0, 0);

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
(2, 'hilo', ''),
(3, 'tela', ''),
(4, 'pintura', ''),
(5, 'diamantina', ''),
(6, 'cinta', '');

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
(1, 'Llavero'),
(2, 'Collar'),
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
  `activo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `genero` (`genero`,`idRol`),
  KEY `rol` (`idRol`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `nombre`, `genero`, `password`, `telefono`, `idRol`, `activo`) VALUES
(1, 'anaglezr13@gmail.com', 'Ana', 'femenino', '$2y$10$ocUoCyr6UwRmloc9ThH1X.NehSxN5ltTSi3aNB2yJngSgnRsBso9i', '6158699', 1, 0),
(2, 'lalaufresa@gmail.com', 'Laura Treviño', 'femenino', '$2y$10$KHss9CPVJjgs.nNDw5N2GOF1QtsSMytIMKIDfykp8JeItX4f97Y2y', '442969432', 2, 0),
(3, 'manu.mora.24@gmail.com', 'Manuel Mora', 'masculino', '$2y$10$D50b9yMwqyQN3fmHE179AuQznjYASf3g0J94J0PSnl.rYwpfnNQdG', '442556798', 2, 0);

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
  KEY `lugar` (`idLugar`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ventas`
--

INSERT INTO `ventas` (`id`, `idProducto`, `idVendedor`, `idLugar`, `fecha`, `cantidad`) VALUES
(1, 1, 1, 1, '2010-09-14', 3),
(2, 1, 1, 1, '2010-09-14', 2),
(3, 2, 1, 1, '2008-09-14', 1),
(4, 1, 1, 1, '2010-09-14', 3),
(5, 2, 1, 1, '2006-09-14', 5);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`idMaterial`) REFERENCES `material` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `colormaterial` FOREIGN KEY (`idColor`) REFERENCES `color` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tipomaterial` FOREIGN KEY (`idTipo`) REFERENCES `tipomaterial` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productostipo` FOREIGN KEY (`idTipo`) REFERENCES `tipoproducto` (`id`) ON UPDATE CASCADE;
--
-- Database: `test`
--
--
-- Database: `webauth`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_pwd`
--

CREATE TABLE IF NOT EXISTS `user_pwd` (
  `name` char(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `pass` char(32) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `user_pwd`
--

INSERT INTO `user_pwd` (`name`, `pass`) VALUES
('xampp', 'wampp');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
