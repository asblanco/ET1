-- Servidor: localhost
-- Tiempo de generación: 20-10-2015 a las 17:56:33
-- Versión del servidor: 5.5.44-0+deb8u1
-- Versión de PHP: 5.6.13-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `Gestor de Permisos`
--
DROP DATABASE IF EXISTS DB_ET1_G5;
CREATE DATABASE DB_ET1_G5 default character set utf8 default collate utf8_spanish_ci;
grant usage on *.* to 'admin'@'localhost';
drop user 'admin'@'localhost';
create user 'admin'@'localhost' identified by 'iu';
grant all on DB_ET1_G5.* to 'admin'@'localhost';

USE DB_ET1_G5;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Funcionalidad`
--

CREATE TABLE IF NOT EXISTS `Funcionalidad` (
  `NombreFun` varchar(65) NOT NULL,
  `DescFun` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Funcionalidad`
--

INSERT INTO `Funcionalidad` (`NombreFun`, `DescFun`) VALUES
('Crear Usuario', 'Permite crear usuarios de la aplicación.'),
('Consultar Usuario', 'Permite consultar usuarios de la aplicación.'),
('Modificar Usuario', 'Permite modificar usuarios de la aplicación.'),
('Eliminar Usuario', 'Permite eliminar usuarios de la aplicación.');

--
-- Disparadores `Funcionalidad`
--
DELIMITER //
CREATE TRIGGER `after_insert_funcionalidad` AFTER INSERT ON `Funcionalidad`
 FOR EACH ROW INSERT INTO Rol_Fun (NombreRol, NombreFun) VALUES ("Administrador", NEW.NombreFun)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pagina`
--

CREATE TABLE IF NOT EXISTS `Pagina` (
  `Url` varchar(65) NOT NULL COMMENT 'url',
  `DescPag` varchar(65) DEFAULT NULL COMMENT 'descripcion de pagina',
  `NombreFun` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Disparadores `Pagina`
--
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
  `DescRol` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Rol`
--

INSERT INTO `Rol` (`NombreRol`, `DescRol`) VALUES
('Administrador', ' El administrador debe poder modificar todo. Teniendo todas las funcionalidades asignadas.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Rol_Fun`
--

CREATE TABLE IF NOT EXISTS `Rol_Fun` (
  `NombreRol` varchar(65) NOT NULL,
  `NombreFun` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Rol_Fun`
--

INSERT INTO `Rol_Fun` (`NombreRol`, `NombreFun`) VALUES
('Administrador', 'Crear Usuario'),
('Administrador', 'Modificar Usuario'),
('Administrador', 'Consultar Usuario'),
('Administrador', 'Eliminar Usuario') ;


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
  `FechaAlta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`Login`, `Password`, `Nombre`, `Apellidos`, `Email`, `FechaAlta`) VALUES
('admin', 'admin', 'admin', 'admin', 'admin', '2015-10-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usu_Pag`
--

CREATE TABLE IF NOT EXISTS `Usu_Pag` (
  `Login` varchar(65) NOT NULL,
  `Url` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usu_Rol`
--

CREATE TABLE IF NOT EXISTS `Usu_Rol` (
  `Login` varchar(65) NOT NULL,
  `NombreRol` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Usu_Rol`
--

INSERT INTO `Usu_Rol` (`Login`, `NombreRol`) VALUES
('admin', 'Administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Funcionalidad`
--
ALTER TABLE `Funcionalidad`
 ADD PRIMARY KEY (`NombreFun`);

--
-- Indices de la tabla `Pagina`
--
ALTER TABLE `Pagina`
 ADD PRIMARY KEY (`Url`), ADD UNIQUE KEY `url` (`Url`), ADD UNIQUE KEY `NombreFun` (`NombreFun`);

--
-- Indices de la tabla `Rol`
--
ALTER TABLE `Rol`
 ADD PRIMARY KEY (`NombreRol`);

--
-- Indices de la tabla `Rol_Fun`
--
ALTER TABLE `Rol_Fun`
 ADD PRIMARY KEY (`NombreRol`,`NombreFun`), ADD KEY `FK2_Funcionalidad` (`NombreFun`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
 ADD PRIMARY KEY (`Login`);

--
-- Indices de la tabla `Usu_Pag`
--
ALTER TABLE `Usu_Pag`
 ADD PRIMARY KEY (`Login`,`Url`), ADD KEY `FK_Pagina` (`Url`);

--
-- Indices de la tabla `Usu_Rol`
--
ALTER TABLE `Usu_Rol`
 ADD PRIMARY KEY (`Login`,`NombreRol`), ADD KEY `FK_Rol` (`NombreRol`);

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
