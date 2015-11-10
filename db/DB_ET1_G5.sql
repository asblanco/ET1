-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 10-11-2015 a las 00:56:22
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
('Administrar', NULL),
('Alta Apuestas', NULL),
('Alta Socios', NULL),
('Baja Apuestas', NULL),
('Baja Socios', NULL),
('Consulta Apuestas', NULL),
('Consulta Socios', NULL),
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
('Gestion Jornadas', NULL),
('Gestion Premios', NULL),
('Menu', NULL),
('Modificacion Apuestas', NULL),
('Modificacion Socios', NULL),
('Modificar Funcionalidad', 'Permite modificar funcionalidades existentes.'),
('Modificar Pagina', 'Permite modificar paginas'),
('Modificar Rol', 'Permite modificar roles existentes.'),
('Modificar Usuario', 'Permite modificar usuarios de la aplicación.');

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
('/paginas/Administrar.php', NULL, 'Administrar', 'Administrar'),
('/paginas/C_Alta_Apuestas.php', NULL, 'Alta Apuestas', 'Alta Apuestas'),
('/paginas/C_Alta_Socios.php', NULL, 'Alta Socios', 'Alta Socios'),
('/paginas/C_Baja_Apuestas.php', NULL, 'Baja Apuestas', 'Baja Apuestas'),
('/paginas/C_Baja_Socios.php', NULL, 'Baja Socios', 'Baja Socios'),
('/paginas/C_Consulta_Apuestas.php', NULL, 'Consulta Apuestas', 'Consulta Apuestas'),
('/paginas/C_Consulta_Socios.php', NULL, 'Consulta Socios', 'Consulta Socios'),
('/paginas/C_Gestion_Jornadas.php', NULL, 'Gestion Jornadas', 'Gestion Jornadas'),
('/paginas/C_Gestion_Premios.php', NULL, 'Gestion Premios', 'Gestion Premios'),
('/paginas/C_Menu.php', NULL, 'Menu', 'Menu'),
('/paginas/C_Modificacion_Apuestas.php', NULL, 'Modificacion Apuestas', 'Modificacion Apuestas'),
('/paginas/C_Modificacion_Socios.php', NULL, 'Modificacion Socios', 'Modificacion Socios'),
('/vistas/vista_func.php', NULL, 'Consultar Funcionalidad', 'Vista Funcionalidad'),
('/vistas/vista_func_add.php', NULL, 'Crear Funcionalidad', 'Crear Funcionalidad'),
('/vistas/vista_func_del.php', NULL, 'Eliminar Funcionalidad.', 'Eliminar Funcionalidad'),
('/vistas/vista_func_mod.php', NULL, 'Modificar Funcionalidad', 'Modificar Funcionalidad'),
('/vistas/vista_pag.php', NULL, 'Consultar Pagina', 'Vista Pagina'),
('/vistas/vista_pag_add.php', NULL, 'Crear Pagina', 'Crear Pagina'),
('/vistas/vista_pag_del.php', NULL, 'Eliminar Pagina', 'Eliminar Pagina'),
('/vistas/vista_pag_mod.php', NULL, 'Modificar Pagina', 'Modificar Pagina'),
('/vistas/vista_rol.php', NULL, 'Consultar Rol', 'Vista Rol'),
('/vistas/vista_rol_add.php', NULL, 'Crear Rol', 'Crear Rol'),
('/vistas/vista_rol_del.php', NULL, 'Eliminar Rol', 'Eliminar Rol'),
('/vistas/vista_rol_mod.php', NULL, 'Modificar Rol', 'Modificar Rol'),
('/vistas/vista_usu.php', NULL, 'Consultar Usuario', 'Vista Usuarios'),
('/vistas/vista_usu_add.php', NULL, 'Crear Usuario', 'Crear Usuario'),
('/vistas/vista_usu_del.php', NULL, 'Eliminar Usuario', 'Eliminar Usuario'),
('/vistas/vista_usu_mod.php', NULL, 'Modificar Usuario', 'Modificar Usuario');

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
('Administrador', 'Consultar Funcionalidad'),
('Administrador', 'Consultar Pagina'),
('Administrador', 'Consultar Rol'),
('Administrador', 'Consultar Usuario'),
('Administrador', 'Crear Funcionalidad'),
('Administrador', 'Crear Pagina'),
('Administrador', 'Crear Rol'),
('Administrador', 'Crear Usuario'),
('Administrador', 'Eliminar Funcionalidad.'),
('Administrador', 'Eliminar Pagina'),
('Administrador', 'Eliminar Rol'),
('Administrador', 'Eliminar Usuario'),
('Administrador', 'Modificar Funcionalidad'),
('Administrador', 'Modificar Pagina'),
('Administrador', 'Modificar Rol'),
('Administrador', 'Modificar Usuario');

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
('admin', '/paginas/Administrar.php', 'Administrar'),
('admin', '/paginas/C_Alta_Apuestas.php', 'Alta Apuestas'),
('admin', '/paginas/C_Alta_Socios.php', 'Alta Socios'),
('admin', '/paginas/C_Baja_Apuestas.php', 'Baja Apuestas'),
('admin', '/paginas/C_Baja_Socios.php', 'Baja Socios'),
('admin', '/paginas/C_Consulta_Apuestas.php', 'Consulta Apuestas'),
('admin', '/paginas/C_Consulta_Socios.php', 'Consulta Socios'),
('admin', '/paginas/C_Gestion_Jornadas.php', 'Gestion Jornadas'),
('admin', '/paginas/C_Gestion_Premios.php', 'Gestion Premios'),
('admin', '/paginas/C_Menu.php', 'Menu'),
('admin', '/paginas/C_Modificacion_Apuestas.php', 'Modificacion Apuestas'),
('admin', '/paginas/C_Modificacion_Socios.php', 'Modificacion Socios'),
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
('admin', '/vistas/vista_usu_add.php', 'Crear Usuario'),
('admin', '/vistas/vista_usu_del.php', 'Eliminar Usuario'),
('admin', '/vistas/vista_usu_mod.php', 'Modificar Usuario');

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
