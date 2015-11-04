USE DB_ET1_G5;

-- Base de datos para gestionar apuestas, socios, premios y jornadas

-- Usuarios
INSERT INTO `Usuario` (`Login`, `Password`, `Nombre`, `Apellidos`, `Email`, `FechaAlta`, `Idioma`) VALUES
('pep', 'e80f8d9487d224130fd34ccdad305d7e', 'Pepe', 'Gonzalez', 'pepe@gmail.com', '2015-11-01', 'es'),
-- password: apuestas
('mary', '48fe23e027192280f231991dd7768c29', 'Maria', 'Rodriguez', 'maria@yahoo.es', '2015-10-29', 'es'),
-- password: premios
('merluzo', 'b9d8a7dfd4e3217829f9208196c64f64', 'Juan', 'Perez Perez', 'juan@outlook.com', '2015-11-01', 'en'),
-- password: socios
('mero', 'ec2632d51e709e21d6883db018f08d62', 'Mero', 'Rodriguez', 'mero@yahoo.es', '2015-10-29', 'en');
-- password: jornadas

-- Roles
INSERT INTO `Rol` (`NombreRol`, `DescRol`) VALUES
('Gestor de apuestas',   'Gestiona las apuestas de la pagina'),
('Gestor de premios',    'Gestiona los premios de la pagina'),
('Gestor de socios',     'Gestiona los socios de la pagina'),
('Gestor de jornadas',   'Gestiona los socios de la pagina');

-- Funcionalidades
-- Alta, baja, consulta y modificacion de apuestas, socios, jornadas y premios
INSERT INTO `Funcionalidad` (`NombreFun`, `DescFun`) VALUES
('Alta apuestas',        'Permite dar de alta apuestas de la aplicación.'),
('Alta socios',          'Permite dar de alta socios de la aplicación.'),
('Alta premios',         'Permite dar de alta premios de la aplicación.'),
('Alta jornadas',        'Permite dar de alta jornadas de la aplicación.'),
('Baja apuestas',        'Permite dar de baja apuestas de la aplicación.'),
('Baja socios',          'Permite dar de baja socios de la aplicación.'),
('Baja premios',         'Permite dar de baja premios de la aplicación.'),
('Baja jornadas',        'Permite dar de baja jornadas de la aplicación.'),
('Consulta apuestas',    'Permite consultar apuestas de la aplicación.'),
('Consulta socios',      'Permite consultar socios de la aplicación.'),
('Consulta premios',     'Permite consultar premios de la aplicación.'),
('Consulta jornadas',    'Permite consultar las jornadas.'),
('Modifica apuestas',    'Permite modificar las apuestas.'),
('Modifica socios',      'Permite modificar los socios.'),
('Modifica jornadas',    'Permite modificar las jornadas.'),
('Modifica premios',     'Permite modificar los premios.');

-- Paginas
INSERT INTO `Pagina` (`Url`, `DescPag`, `NombreFun`, `NombrePag`) VALUES
-- Jornadas y premios se gestionan desde la misma pagina 
('Pagina 0', 'Esta pagina da de alta apuestas',  'Alta apuestas',        'Dar de alta apuestas'),
('Pagina 2', 'Esta pagina da de alta socios',    'Alta socios',          'Dar de alta socios'),
('Pagina 3', 'Esta pagina da de alta premios',   'Alta premios',         'Dar de alta premios'),
('Pagina 4', 'Esta pagina da de alta jornadas',  'Alta jornadas',        'Dar de alta jornadas'),
('Pagina 5', 'Esta pagina da de baja apuestas',  'Baja apuestas',        'Dar de baja apuestas'),
('Pagina 6', 'Esta pagina da de baja socios',    'Baja socios',          'Dar de baja socios'),
('Pagina 7', 'Esta pagina da de baja premios',   'Baja premios',         'Dar de baja premios'),
('Pagina 8', 'Esta pagina da de baja jornadas',  'Baja jornadas',        'Dar de baja jornadas'),
('Pagina 9', 'Esta pagina modifica apuestas',    'Modifica apuestas',    'Modificar apuestas'),
('Pagina 10', 'Esta pagina modifica socios',     'Modifica socios',      'Modificar socios'),
('Pagina 11', 'Esta pagina modifica premios',    'Modifica premios',     'Modificar premios'),
('Pagina 12', 'Esta pagina modifica jornadas',   'Modifica jornadas',    'Modificar jornadas'),
('Pagina 13', 'Esta pagina consulta apuestas',   'Consulta apuestas',    'Consultar apuestas'),
('Pagina 14', 'Esta pagina consulta socios',     'Consulta socios',      'Consultar socios'),
('Pagina 15', 'Esta pagina consulta premios',    'Consulta premios',     'Consultar premios'),
('Pagina 16', 'Esta pagina consulta jornadas',   'Consulta jornadas',    'Consultar jornadas');

-- Tabla Rol_Fun
INSERT INTO `Rol_Fun` (`NombreRol`, `NombreFun`) VALUES
('Gestor de apuestas',   'Alta apuestas'),
('Gestor de apuestas',   'Baja apuestas'),
('Gestor de apuestas',   'Modifica apuestas'),
('Gestor de apuestas',   'Consulta apuestas'),
('Gestor de premios',    'Alta premios'),
('Gestor de premios',    'Baja premios'),
('Gestor de premios',    'Modifica premios'),
('Gestor de premios',    'Consulta premios'),
('Gestor de socios',     'Alta socios'),
('Gestor de socios',     'Baja socios'),
('Gestor de socios',     'Modifica socios'),
('Gestor de socios',     'Consulta socios'),
('Gestor de jornadas',   'Alta jornadas'),
('Gestor de jornadas',   'Baja jornadas'),
('Gestor de jornadas',   'Modifica jornadas'),
('Gestor de jornadas',   'Consulta jornadas');

-- Tabla Usu_Pag
INSERT INTO `Usu_Pag` (`Login`, `Url`, `NombrePag`) VALUES
('pep',      'Pagina 0',    'Pagina 0'),
('mary',     'Pagina 2',    'Pagina 2'),
('merluzo',  'Pagina 3',    'Pagina 3'),
('mero',     'Pagina 4',    'Pagina 4'),
('pep',      'Pagina 5',    'Pagina 5'),
('mary',     'Pagina 6',    'Pagina 6'),
('merluzo',  'Pagina 7',    'Pagina 7'),
('mero',     'Pagina 8',    'Pagina 8'),
('pep',      'Pagina 9',    'Pagina 9'),
('mary',     'Pagina 10',   'Pagina 10'),
('merluzo',  'Pagina 11',   'Pagina 11'),
('mero',     'Pagina 12',   'Pagina 12'),
('pep',      'Pagina 13',   'Pagina 13'),
('mary',     'Pagina 14',   'Pagina 14'),
('merluzo',  'Pagina 15',   'Pagina 15'),
('mero',     'Pagina 16',   'Pagina 16');

-- Tabla Usu_Rol
INSERT INTO `Usu_Rol` (`Login`, `NombreRol`) VALUES
('pep',      'Gestor de apuestas'),
('mary',     'Gestor de premios'),
('merluzo',  'Gestor de socios'),
('mero',     'Gestor de jornadas');