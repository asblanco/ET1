-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 15-10-2015 a las 19:26:42
-- Versión del servidor: 5.5.38
-- Versión de PHP: 5.4.4-14+deb7u4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `GestorPermisos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Funcionalidad`
--

CREATE TABLE IF NOT EXISTS `Funcionalidad` (
  `NombreFun` varchar(65) NOT NULL,
  `DescFun` varchar(65) DEFAULT NULL,
  PRIMARY KEY (`NombreFun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Funcionalidad`
--

INSERT INTO `Funcionalidad` (`NombreFun`, `DescFun`) VALUES
('Visitar', 'Permite visualizar las páginas a las que se tiene acceso.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pagina`
--

CREATE TABLE IF NOT EXISTS `Pagina` (
  `Url` varchar(65) NOT NULL COMMENT 'url',
  `DescPag` varchar(65) DEFAULT NULL COMMENT 'descripcion de pagina',
  `NombreFun` varchar(65) NOT NULL,
  PRIMARY KEY (`Url`),
  UNIQUE KEY `url` (`Url`),
  UNIQUE KEY `NombreFun` (`NombreFun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Disparadores `Pagina`
--
DROP TRIGGER IF EXISTS `before_insert_pagina`;
DELIMITER //
CREATE TRIGGER `before_insert_pagina` BEFORE INSERT ON `Pagina`
 FOR EACH ROW BEGIN
DECLARE
num INT;
SELECT COUNT(*) INTO num
FROM Funcionalidad
WHERE NombreFun=NEW.NombreFun;
IF (num=0) THEN
INSERT INTO Funcionalidad (NombreFun, DescFun) VALUES (NEW.NombreFun, NULL);
END IF;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `after_insert_pagina`;
DELIMITER //
CREATE TRIGGER `after_insert_pagina` AFTER INSERT ON `Pagina`
 FOR EACH ROW INSERT INTO Usu_Pag (Login, Url) VALUES ('admin', NEW.Url)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Rol`
--

CREATE TABLE IF NOT EXISTS `Rol` (
  `NombreRol` varchar(65) NOT NULL,
  `DescRol` varchar(65) DEFAULT NULL,
  PRIMARY KEY (`NombreRol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Rol`
--

INSERT INTO `Rol` (`NombreRol`, `DescRol`) VALUES
('Lector', 'Rol por defecto al registrarse. Funcionalidad: Visitar.');

--
-- Disparadores `Rol`
--
DROP TRIGGER IF EXISTS `after_insert_rol`;
DELIMITER //
CREATE TRIGGER `after_insert_rol` AFTER INSERT ON `Rol`
 FOR EACH ROW INSERT INTO Usu_Rol (Login, NombreRol) VALUES ('admin', NEW.NombreRol)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Rol_Fun`
--

CREATE TABLE IF NOT EXISTS `Rol_Fun` (
  `NombreRol` varchar(65) NOT NULL,
  `NombreFun` varchar(65) NOT NULL,
  PRIMARY KEY (`NombreRol`,`NombreFun`),
  KEY `FK2_Funcionalidad` (`NombreFun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Rol_Fun`
--

INSERT INTO `Rol_Fun` (`NombreRol`, `NombreFun`) VALUES
('Lector', 'Visitar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE IF NOT EXISTS `Usuario` (
  `Login` varchar(65) NOT NULL,
  `Password` varchar(65) NOT NULL,
  `Nombre` varchar(65) NOT NULL,
  `Apellidos` varchar(65) NOT NULL,
  `Email` varchar(65) NOT NULL,
  `FechaAlta` date NOT NULL,
  PRIMARY KEY (`Login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`Login`, `Password`, `Nombre`, `Apellidos`, `Email`, `FechaAlta`) VALUES
('admin', 'admin', 'admin', 'adsfs', 'dfdf', '2015-10-15');

--
-- Disparadores `Usuario`
--
DROP TRIGGER IF EXISTS `after_insert_usuario`;
DELIMITER //
CREATE TRIGGER `after_insert_usuario` AFTER INSERT ON `Usuario`
 FOR EACH ROW INSERT INTO Usu_Rol (Login, NombreRol) VALUES (NEW.Login, 'Lector')
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usu_Pag`
--

CREATE TABLE IF NOT EXISTS `Usu_Pag` (
  `Login` varchar(65) NOT NULL,
  `Url` varchar(65) NOT NULL,
  PRIMARY KEY (`Login`,`Url`),
  KEY `FK_Pagina` (`Url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usu_Rol`
--

CREATE TABLE IF NOT EXISTS `Usu_Rol` (
  `Login` varchar(65) NOT NULL,
  `NombreRol` varchar(65) NOT NULL,
  PRIMARY KEY (`Login`,`NombreRol`),
  KEY `FK_Rol` (`NombreRol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Usu_Rol`
--

INSERT INTO `Usu_Rol` (`Login`, `NombreRol`) VALUES
('admin', 'Lector');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Pagina`
--
ALTER TABLE `Pagina`
  ADD CONSTRAINT `FK_Fun` FOREIGN KEY (`NombreFun`) REFERENCES `Funcionalidad` (`NombreFun`);

--
-- Filtros para la tabla `Rol_Fun`
--
ALTER TABLE `Rol_Fun`
  ADD CONSTRAINT `FK2_Funcionalidad` FOREIGN KEY (`NombreFun`) REFERENCES `Funcionalidad` (`NombreFun`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK2_Rol` FOREIGN KEY (`NombreRol`) REFERENCES `Rol` (`NombreRol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Usu_Pag`
--
ALTER TABLE `Usu_Pag`
  ADD CONSTRAINT `FK2_Usuario` FOREIGN KEY (`Login`) REFERENCES `Usuario` (`Login`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Pagina` FOREIGN KEY (`Url`) REFERENCES `Pagina` (`Url`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Usu_Rol`
--
ALTER TABLE `Usu_Rol`
  ADD CONSTRAINT `FK_Rol` FOREIGN KEY (`NombreRol`) REFERENCES `Rol` (`NombreRol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Usuario` FOREIGN KEY (`Login`) REFERENCES `Usuario` (`Login`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
