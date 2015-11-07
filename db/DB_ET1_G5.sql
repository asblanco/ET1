-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-11-2015 a las 15:25:47
-- Versión del servidor: 5.5.44-0+deb8u1
-- Versión de PHP: 5.6.13-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `DB_ET1_G5`
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
('Consultar Funcionalidad', 'Permite consultar las funcionalidades existentes.'),
('Consultar Pagina', 'Permite consultar las paginas existentes.'),
('Consultar Rol', 'Permite consultar los roles existentes.'),
('Consultar Usuario', 'Permite consultar usuarios de la aplicación.'),
('Crear Funcionalidad', 'Permite crear nuevas funcionalidades.'),
('Crear Pagina', 'Permite subir paginas.'),
('Crear Rol', 'Permite crear roles.'),
('Crear Usuario', 'Permite crear usuarios de la aplicación.'),
('Eliminar Funcionalidad.', 'Permite eliminar funcionalidades.'),
('Eliminar Pagina', 'Permite eliminar paginas existentes.'),
('Eliminar Rol', 'Permite eliminar roles'),
('Eliminar Usuario', 'Permite eliminar usuarios de la aplicación.'),
('Modificar Funcionalidad.', 'Permite modificar funcionalidades existentes.'),
('Modificar Pagina', 'Permite modificar paginas'),
('Modificar Rol', 'Permite modificar roles existentes.'),
('Modificar Usuario', 'Permite modificar usuarios de la aplicación.');

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
  `Url` varchar(65) NOT NULL,
  `DescPag` varchar(65) DEFAULT NULL,
  `NombreFun` varchar(65) DEFAULT NULL,
  `NombrePag` varchar(65) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Pagina`
--

INSERT INTO `Pagina` (`Url`, `DescPag`, `NombreFun`, `NombrePag`) VALUES
('/vistas/vista_func.php', NULL, 'Consultar Funcionalidad', 'Vista Funcionalidad'),
('/vistas/vista_func_add.php', NULL, 'Crear Funcionalidad', 'Crear Funcionalidad'),
('/vistas/vista_func_del.php', NULL, 'Eliminar Funcionalidad.', 'Eliminar Funcionalidad'),
('/vistas/vista_func_mod.php', NULL, 'Modificar Funcionalidad.', 'Modificar Funcionalidad'),
('/vistas/vista_pag.php', NULL, 'Consultar Pagina', 'Vista Pagina'),
('/vistas/vista_pag_add.php', NULL, 'Crear Pagina', 'Crear Pagina'),
('/vistas/vista_pag_del.php', NULL, 'Eliminar Pagina', 'Eliminar Pagina'),
('/vistas/vista_pag_mod.php', NULL, 'Modificar Pagina', 'Modificar Pagina'),
('/vistas/vista_rol.php', NULL, 'Consultar Rol', 'Vista Rol'),
('/vistas/vista_rol_add.php', NULL, 'Crear Rol', 'Crear Rol'),
('/vistas/vista_rol_del.php', NULL, 'Eliminar Rol', 'Eliminar Rol'),
('/vistas/vista_rol_mod.php', NULL, 'Modificar Rol', 'Modificar Rol'),
('/vistas/vista_usu.php', NULL, 'Consultar Usuario', 'Vista Usuarios'),
('/vistas/vista_usu_del.php', NULL, 'Eliminar Usuario', 'Eliminar Usuario'),
('/vistas/vista_usu_mod.php', NULL, 'Modificar Usuario', 'Modificar Usuario'),
('vistas/vista_usu_add.php', NULL, 'Crear Usuario', 'Crear Usuario');

--
-- Disparadores `Pagina`
--
DELIMITER //
CREATE TRIGGER `after_insert_pagina` AFTER INSERT ON `Pagina`
 FOR EACH ROW INSERT INTO Usu_Pag (Login, Url, NombrePag) VALUES ('admin', NEW.Url, NEW.NombrePag)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Rol`
--

CREATE TABLE IF NOT EXISTS `Rol` (
  `NombreRol` varchar(65) NOT NULL,
  `DescRol` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Rol`
--

INSERT INTO `Rol` (`NombreRol`, `DescRol`) VALUES
('Administrador', ' El administrador debe poder modificar todo. Teniendo todas las funcionalidades asignadas.'),
('Gestor de Funcionalidades', 'Crea y elimina funcionalidades.'),
('Gestor de Paginas', 'Sube y elimina paginas.'),
('Gestor de Roles', 'Crea, elimina y asigna roles.'),
('Gestor de Usuarios', 'Crea, borra y edita usuarios.');

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
('Administrador', 'Consultar Funcionalidad'),
('Gestor de Funcionalidades', 'Consultar Funcionalidad'),
('Administrador', 'Consultar Pagina'),
('Gestor de Paginas', 'Consultar Pagina'),
('Administrador', 'Consultar Rol'),
('Gestor de Roles', 'Consultar Rol'),
('Administrador', 'Consultar Usuario'),
('Gestor de Usuarios', 'Consultar Usuario'),
('Administrador', 'Crear Funcionalidad'),
('Gestor de Funcionalidades', 'Crear Funcionalidad'),
('Administrador', 'Crear Pagina'),
('Gestor de Paginas', 'Crear Pagina'),
('Administrador', 'Crear Rol'),
('Gestor de Roles', 'Crear Rol'),
('Administrador', 'Crear Usuario'),
('Gestor de Usuarios', 'Crear Usuario'),
('Administrador', 'Eliminar Funcionalidad.'),
('Gestor de Funcionalidades', 'Eliminar Funcionalidad.'),
('Administrador', 'Eliminar Pagina'),
('Gestor de Paginas', 'Eliminar Pagina'),
('Administrador', 'Eliminar Rol'),
('Gestor de Roles', 'Eliminar Rol'),
('Administrador', 'Eliminar Usuario'),
('Gestor de Usuarios', 'Eliminar Usuario'),
('Administrador', 'Modificar Funcionalidad.'),
('Gestor de Funcionalidades', 'Modificar Funcionalidad.'),
('Administrador', 'Modificar Pagina'),
('Gestor de Paginas', 'Modificar Pagina'),
('Administrador', 'Modificar Rol'),
('Gestor de Roles', 'Modificar Rol'),
('Administrador', 'Modificar Usuario'),
('Gestor de Usuarios', 'Modificar Usuario');

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
  `FechaAlta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Idioma` enum('es','en') CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'es'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`Login`, `Password`, `Nombre`, `Apellidos`, `Email`, `FechaAlta`, `Idioma`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', 'admin', '2015-10-13 22:00:00', 'es');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usu_Pag`
--

CREATE TABLE IF NOT EXISTS `Usu_Pag` (
  `Login` varchar(65) NOT NULL,
  `Url` varchar(100) NOT NULL,
  `NombrePag` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `Usu_Pag`
--

INSERT INTO `Usu_Pag` (`Login`, `Url`, `NombrePag`) VALUES
('admin', '/vistas/vista_func.php', 'Vista Funcionalidad'),
('admin', '/vistas/vista_func_add.php', 'Crear Funcionalidad'),
('admin', '/vistas/vista_func_del.php', 'Eliminar Funcionalidad'),
('admin', '/vistas/vista_func_mod.php', 'Modificar Funcionalidad'),
('admin', '/vistas/vista_pag.php', 'Consultar Pagina'),
('admin', '/vistas/vista_pag_add.php', 'Crear Pagina'),
('admin', '/vistas/vista_pag_del.php', 'Eliminar Pagina'),
('admin', '/vistas/vista_pag_mod.php', 'Modificar Pagina'),
('admin', '/vistas/vista_rol.php', 'Vista Rol'),
('admin', '/vistas/vista_rol_add.php', 'Crear Rol'),
('admin', '/vistas/vista_rol_del.php', 'Eliminar Rol'),
('admin', '/vistas/vista_rol_mod.php', 'Modificar Rol'),
('admin', '/vistas/vista_usu.php', 'Vista Usuarios'),
('admin', '/vistas/vista_usu_del.php', 'Eliminar Usuario'),
('admin', '/vistas/vista_usu_mod.php', 'Modificar Usuario'),
('admin', 'vistas/vista_usu_add.php', 'Crear Usuario');

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
 ADD PRIMARY KEY (`Url`), ADD UNIQUE KEY `NombrePag` (`NombrePag`), ADD KEY `FK_Fun` (`NombreFun`);

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
