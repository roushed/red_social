-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-01-2024 a las 18:59:35
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `red_social`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--
 
CREATE TABLE `contactos` (
  `nick` varchar(40) NOT NULL,
  `nick_contacto` varchar(40) NOT NULL,
  `admitir` enum('enviado','admitido','denegado') NOT NULL,
  `bloqueo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`nick`, `nick_contacto`, `admitir`, `bloqueo`) VALUES
('albert44', 'carmen88', 'admitido', 1),
('albert44', 'carol22', 'admitido', 0),
('albert44', 'pereico', 'admitido', 0),
('albert44', 'peterking', 'admitido', 1),
('carmen88', 'albert44', 'denegado', 1),
('carmen88', 'carol22', 'admitido', 0),
('carmen88', 'dani1', 'admitido', 0),
('carmen88', 'manu12', 'admitido', 0),
('carmen88', 'peterking', 'admitido', 0),
('carmen88', 'sole77', 'admitido', 0),
('carmen88', 'toni33', 'admitido', 0),
('carol22', 'albert44', 'admitido', 0),
('carol22', 'carmen88', 'admitido', 0),
('carol22', 'dani1', 'admitido', 0),
('carol22', 'toni33', 'admitido', 0),
('dani1', 'carmen88', 'admitido', 0),
('dani1', 'carol22', 'admitido', 0),
('dani1', 'gregorio', 'admitido', 0),
('dani1', 'maria99', 'admitido', 0),
('dani1', 'peterking', 'admitido', 0),
('gregorio', 'dani1', 'admitido', 0),
('gregorio', 'peterking', 'admitido', 0),
('manu12', 'carmen88', 'admitido', 0),
('manu12', 'maria99', 'admitido', 0),
('manu12', 'peterking', 'admitido', 0),
('maria99', 'dani1', 'admitido', 0),
('maria99', 'manu12', 'admitido', 0),
('maria99', 'peterking', 'admitido', 0),
('pereico', 'albert44', 'admitido', 0),
('pereico', 'peterking', 'admitido', 0),
('peterking', 'albert44', 'denegado', 1),
('peterking', 'carmen88', 'admitido', 0),
('peterking', 'dani1', 'admitido', 0),
('peterking', 'gregorio', 'admitido', 0),
('peterking', 'manu12', 'admitido', 0),
('peterking', 'maria99', 'admitido', 0),
('peterking', 'pereico', 'admitido', 0),
('peterking', 'sole77', 'admitido', 0),
('peterking', 'toni33', 'admitido', 0),
('sole77', 'albert44', 'admitido', 0),
('sole77', 'carmen88', 'admitido', 0),
('sole77', 'peterking', 'admitido', 0),
('toni33', 'carmen88', 'admitido', 0),
('toni33', 'carol22', 'admitido', 0),
('toni33', 'peterking', 'admitido', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `nombreG` varchar(40) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`nombreG`, `descripcion`) VALUES
('AMPA CEIP San Marcos', NULL),
('asdasdasdasdasd', 'dasdasdasdd'),
('CD Baloncesto', NULL),
('Cinefilos', 'Grupo de Cinefilos'),
('El grupo de Carmen', 'fsdsdfsd'),
('El Grupo de Toni', 'Bienvenidos'),
('Equipo A', 'fsd'),
('Grupo Billar', 'ja jaja ja'),
('Grupo de Tenis', 'fsd'),
('La boutique de la Abuela', 'jaja'),
('La clase de 3EP', NULL),
('La clase de 4EP', NULL),
('La clase de 5EP', NULL),
('Los Gambiteros', 'Un buen grupo de la hostia'),
('Los Karatekas', 'Grupo de karatecas'),
('Los Lobos', 'grupo de lobos'),
('Los Morados', 'jaja'),
('Los pirados', 'Grupo de los Pirados'),
('Los Planetas', 'ddd'),
('Los Ruteros 4x4', 'Un buen grupo para rutas 4x4'),
('Los Teloneros!', 'Buen grupo'),
('Los Wasaperos', 'Grupo de Whatsapp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `id_post` int(11) NOT NULL,
  `nick` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`id_post`, `nick`) VALUES
(270, 'dani1'),
(264, 'dani1'),
(266, 'dani1'),
(160, 'dani1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `nick` varchar(40) NOT NULL,
  `idperfil` tinyint(4) NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  `apellidos` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `ciudad` varchar(50) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`nick`, `idperfil`, `url`, `apellidos`, `nombre`, `ciudad`, `pais`, `fecha_nacimiento`, `descripcion`, `foto`) VALUES
('admin', 0, NULL, 'admin', 'admin', NULL, NULL, '0000-00-00', NULL, 'img_defecto.jpg'),
('albert44', 1, '', 'AGUADO', 'PEDRO', 'Aranjuez', 'España', '1995-10-05', 'Deportes,Música', 'img_defecto.jpg'),
('carmen88', 2, '', 'GOMEZ', 'CARMEN', 'Aranjuez', 'España', '1995-10-05', 'Deportes,Música, Cine', 'chica.jpg'),
('carol22', 3, '', 'JIMENEZ', 'CAROL', 'Aranjuez', 'España', '1995-10-05', 'Deportes,Música', 'img_defecto.jpg'),
('conguito', 1, NULL, '', '', NULL, NULL, '0000-00-00', NULL, 'img_defecto.jpg'),
('dani1', 4, '', 'PEREZ', 'DANI', 'Aranjuez', 'España', '1995-10-05', 'Deportes,Música', 'img_defecto.jpg'),
('gregorio', 1, NULL, '', '', NULL, NULL, '0000-00-00', NULL, 'img_defecto.jpg'),
('malaguita', 1, '', 'perez', 'malagueta', '', '', '2023-05-18', '', 'img_defecto.jpg'),
('manu12', 5, '', 'AGUADO', 'PEDRO', 'Aranjuez', 'España', '1995-10-05', 'Deportes,Música', 'img_defecto.jpg'),
('maria99', 6, '', 'PEREZ', 'MARIA', 'Aranjuez', 'España', '1995-10-05', 'Deportes,Música', 'img_defecto.jpg'),
('pereico', 7, '', 'AGUADO', 'PEDRO', 'Aranjuez', 'España', '1995-10-05', 'Deportes,Música', 'img_defecto.jpg'),
('peterking', 8, '', 'AGUADO', 'PEDROLAS', 'Aranjuez', 'España', '1995-10-05', 'Deportes,Música, Aerobic', 'gaara.jpg'),
('sole77', 9, '', 'PEREZ', 'SOLE', 'Aranjuez', 'España', '1998-10-05', 'Deportes,Música', 'img_defecto.jpg'),
('toni33', 10, '', 'AGUADO', 'PEDRO', 'Aranjuez', 'España', '1995-10-05', 'Deportes,Música', 'img_defecto.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE `post` (
  `idpost` int(11) NOT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `texto` varchar(250) NOT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `idpostR` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`idpost`, `subject`, `texto`, `imagen`, `fecha`, `idpostR`) VALUES
(1, 'Comentario de carol22', 'hola1', NULL, '2023-04-20', NULL),
(2, 'Comentario de peterking', 'Vamos hacer una prueba con esto a ver si funciona', NULL, '2023-04-20', NULL),
(3, 'Comentario de albert44', 'hola3', NULL, '2023-04-20', NULL),
(4, 'Comentarios de albert44', 'hola4', NULL, '2023-04-20', NULL),
(5, 'Comentario de sole77', 'hola5', NULL, '2023-04-20', NULL),
(6, 'Comentario de albert44', 'hola6', NULL, '2023-04-20', NULL),
(7, 'Comentario de manu12', 'hola7', NULL, '2023-04-20', NULL),
(8, 'Comentario de maria99', 'hola8', NULL, '2023-04-20', NULL),
(9, 'Dudas con cosas', 'Me gustaria resolver dudas', NULL, '2023-04-21', NULL),
(18, 'Me gusta el futbol!', 'eeee que pasa tron! del buenooo!!', NULL, '2023-04-21', NULL),
(19, 'Esto es una replica', 'A ver si funciona!', NULL, '2023-04-21', NULL),
(21, 'Vamos a celebrarlo!!', 'A celebrar un gran cumpleeeee das das dasd as das das dasdas as dasd asdadasdas das asdas asd asd asd asd asdas asd as dasd as asd as dasdasd asdas asdas adasdasd asd ds asdasdasd ', NULL, '2023-04-21', NULL),
(25, 'Vamos de ruta', 'Qaaaaaa', NULL, '2023-04-21', NULL),
(26, 'Los rutereros', 'Deeeee', NULL, '2023-04-21', NULL),
(30, 'A celebrarlo!', 'Voy hacer una prueba jaja', NULL, '2023-04-21', NULL),
(33, 'La vencvidad ya esta', 'Vamos hacer una prueba! si', NULL, '2023-04-21', NULL),
(35, 'A ver ', 'Si funciona', NULL, '2023-04-21', NULL),
(36, NULL, 'Probando', NULL, '2023-04-23', NULL),
(37, NULL, 'Probando', NULL, '2023-04-23', NULL),
(38, NULL, 'Vamo a proba', NULL, '2023-04-23', 34),
(39, NULL, 'hjghjghj', NULL, '2023-04-23', 34),
(40, NULL, 'jhghjghj', NULL, '2023-04-23', 34),
(41, NULL, 'Vamo a proba!', NULL, '2023-04-23', 34),
(42, NULL, 'A ver!!', NULL, '2023-04-23', 34),
(43, NULL, 'jAJEJEJE', NULL, '2023-04-23', 34),
(44, NULL, 'vALEE!!', NULL, '2023-04-23', 32),
(45, NULL, 'SShhhhh', NULL, '2023-04-23', 34),
(46, NULL, 'GDFGDG', NULL, '2023-04-23', 34),
(47, NULL, 'FSDFSDF', NULL, '2023-04-23', 34),
(48, NULL, 'fffff', NULL, '2023-04-23', 34),
(49, NULL, 'esto funciona', NULL, '2023-04-23', 34),
(50, 'Aqui va maria!', 'jejejejeje', NULL, '2023-04-24', NULL),
(51, 'Super Mario', 'Vamos a verla!', NULL, '2023-04-24', NULL),
(52, NULL, 'jeje vale', NULL, '2023-04-24', 51),
(53, NULL, 'Deeee', NULL, '2023-04-25', 25),
(54, 'Heyyyyyy', 'Hay alguien ahiii!!', NULL, '2023-04-25', NULL),
(55, NULL, 'Jajajajajaj jejejejej jijijiji', NULL, '2023-04-25', 35),
(56, 'Jajajajaj', 'Probandooo', NULL, '2023-04-25', NULL),
(59, NULL, 'Hola carmen', NULL, '2023-04-26', NULL),
(60, NULL, 'Que tal Peter?', NULL, '2023-04-26', NULL),
(61, NULL, 'bien , y tu que tal estas?', NULL, '2023-04-26', NULL),
(62, NULL, 'Pues ahí tirando', NULL, '2023-04-26', NULL),
(76, NULL, 'esto va muy loco!!', NULL, '2023-04-26', NULL),
(77, NULL, 'Se mezcla todo', NULL, '2023-04-26', NULL),
(78, NULL, 'Pruebo', NULL, '2023-04-26', NULL),
(79, NULL, 'EEEEEEEEEEEEEEEEE', NULL, '2023-04-26', NULL),
(80, NULL, 'para ya!', NULL, '2023-04-26', NULL),
(81, NULL, 'Hola Carmen!', NULL, '2023-04-26', NULL),
(82, NULL, 'Que tal Peter?', NULL, '2023-04-26', NULL),
(83, NULL, 'Haciendo pruebas si funciona el chat', NULL, '2023-04-26', NULL),
(84, NULL, 'A ver como se desarrolla...', NULL, '2023-04-26', NULL),
(85, NULL, 'bueno va tirando', NULL, '2023-04-26', NULL),
(86, NULL, 'Si, eso parece jaja', NULL, '2023-04-26', NULL),
(87, NULL, 'recibido!', NULL, '2023-04-26', NULL),
(88, NULL, 'si, todo correcto', NULL, '2023-04-26', NULL),
(89, NULL, 'valeeeeee', NULL, '2023-04-26', NULL),
(90, NULL, 'Hola Peteeeerr!', NULL, '2023-04-26', NULL),
(91, NULL, 'Que tal albertito', NULL, '2023-04-26', NULL),
(92, NULL, 'bien y tu??', NULL, '2023-04-26', NULL),
(93, NULL, 'guay aqui', NULL, '2023-04-26', NULL),
(94, NULL, 'Peter necesito ayuda!', NULL, '2023-04-26', NULL),
(95, NULL, 'Que tal los estudios?', NULL, '2023-04-26', NULL),
(96, NULL, 'cuando tu puedas', NULL, '2023-04-26', NULL),
(97, 'Bodita', 'Bodita', NULL, '2023-04-26', NULL),
(99, 'Cumpleaños', 'Cumple', NULL, '2023-04-26', NULL),
(101, 'Bicicleros', 'bicicleros al poder', NULL, '2023-04-26', NULL),
(102, 'Los troncheros', 'Eheee', NULL, '2023-04-26', NULL),
(103, 'Gambbasss', 'Gambas de las buenas! jeje', NULL, '2023-04-26', NULL),
(104, NULL, 'eeeeee', NULL, '2023-04-26', 100),
(105, NULL, 'Pruebo', NULL, '2023-04-26', 33),
(106, NULL, 'Vamos a probar', NULL, '2023-04-26', 100),
(107, NULL, 'dsadasd', NULL, '2023-04-26', 23),
(108, NULL, 'Waka Waka', NULL, '2023-04-26', 100),
(109, NULL, 'molt be', NULL, '2023-04-26', 100),
(110, NULL, 'probando 1 2 3', NULL, '2023-04-26', 100),
(111, NULL, 'A ver que pasa', NULL, '2023-04-26', 100),
(112, NULL, 'eeee', NULL, '2023-04-26', 100),
(113, NULL, 'Vamos a comprobar si esto va', NULL, '2023-04-26', 100),
(114, NULL, 'jeje', NULL, '2023-04-26', 100),
(115, NULL, 'Nain', NULL, '2023-04-26', 29),
(116, 'Animo!', 'Vamos a animar esto!', NULL, '2023-04-26', NULL),
(117, 'De', 'de', NULL, '2023-04-26', NULL),
(118, 'Feria', 'La Feria', NULL, '2023-04-26', NULL),
(120, 'Buenaaaa', 'Buenaaa', NULL, '2023-04-26', NULL),
(125, 'FIESTAAAAAAAAAAAA', 'FIESTAAAAAAAAAAAA', NULL, '2023-04-26', NULL),
(126, 'todos', 'todosss', NULL, '2023-04-26', NULL),
(128, NULL, 'Que haces Peterking!!', NULL, '2023-04-27', NULL),
(129, NULL, 'Que quieres Peter King?', NULL, '2023-04-27', NULL),
(130, NULL, 'PETEEEEEEERR!', NULL, '2023-04-27', NULL),
(132, NULL, 'Vaya cosa mas rara', NULL, '2023-04-27', 131),
(133, NULL, 'Si, es bastante raro...', NULL, '2023-04-27', 131),
(134, NULL, 'Jopeta', NULL, '2023-04-27', 131),
(135, NULL, 'Aqui puedo comentar', NULL, '2023-04-27', 131),
(136, NULL, 'Y aqui tambien puedo', NULL, '2023-04-27', 24),
(137, NULL, 'Aqui no me dejara comentar', NULL, '2023-04-27', 124),
(138, NULL, 'Vale', NULL, '2023-04-27', 24),
(139, NULL, 'bueno', NULL, '2023-04-27', 131),
(140, NULL, 'Muy bueno!', NULL, '2023-04-27', 127),
(142, NULL, 'funciona?', NULL, '2023-04-27', 141),
(144, 'eeee', 'eee', NULL, '2023-04-27', NULL),
(145, NULL, 'es una prueba de comentario', NULL, '2023-04-27', 143),
(146, NULL, 'Que guapo!', NULL, '2023-04-27', 144),
(147, 'Veniros!', 'JuaJua', NULL, '2023-04-27', NULL),
(151, 'Esto va para todos!', 'Para todos va este mensaje', NULL, '2023-04-27', NULL),
(152, 'ESTE MENSAJE SE ENVIARA A TODOS', 'ES UNA PRUEBA!', NULL, '2023-04-27', NULL),
(154, 'Esto es un mensaje de prueba', 'Esto es un mensaje de prueba', NULL, '2023-04-27', NULL),
(156, NULL, 'petercitooo!', NULL, '2023-04-27', NULL),
(157, 'Prueba amiga', 'Prueba amiga', NULL, '2023-04-27', NULL),
(158, 'PARA 2 PERSONAS', 'PARA 2 PERSONAS', NULL, '2023-04-27', NULL),
(159, 'WUEJUUUUUUUUU', 'WUEJUUUUUUUUU', NULL, '2023-04-27', NULL),
(160, 'VAMONOS DE RUTAAS!!', 'EEEEEE', NULL, '2023-04-27', NULL),
(161, 'Ya no soy admin', 'Ya no soy admin', NULL, '2023-04-27', NULL),
(162, 'Esto va pa los wasaperos', 'Esto va pa los wasapeross', NULL, '2023-04-27', NULL),
(163, NULL, 'jaja', NULL, '2023-04-29', 124),
(164, 'Bienvenido Lobos!', 'He creado el grupo de los lobos', NULL, '2023-04-29', NULL),
(167, 'AUUAAUAUAU', 'AAAAUUUUUUUUUUU!', NULL, '2023-04-29', NULL),
(169, 'La Manada', 'aaauu', NULL, '2023-04-29', NULL),
(170, NULL, 'Vamos a probar!', NULL, '2023-04-30', 124),
(171, NULL, 'Prueba de carmen', NULL, '2023-04-30', 166),
(172, NULL, 'jAJAJAJA', NULL, '2023-04-30', 166),
(173, NULL, 'probando', NULL, '2023-04-30', NULL),
(174, NULL, 'por que no puedo comentar', NULL, '2023-04-30', 24),
(176, NULL, 'jiji', NULL, '2023-04-30', 166),
(177, NULL, 'funciona', NULL, '2023-04-30', 124),
(178, NULL, 'Se eliminaron los mensajes', NULL, '2023-04-30', 162),
(180, NULL, 'Voy a probar aqui jeje', NULL, '2023-04-30', 154),
(183, NULL, 'Vale', NULL, '2023-04-30', 162),
(184, NULL, 'Guaaaaaaaa', NULL, '2023-04-30', 30),
(185, NULL, 'WIIIII', NULL, '2023-04-30', 30),
(186, NULL, 'Wajajae', NULL, '2023-04-30', 162),
(187, 'Los wasaperos de fiesta', 'Vamos a llevar a los wasaperos de fiesta', NULL, '2023-04-30', NULL),
(188, NULL, 'jajaaaaaaaaaa', NULL, '2023-04-30', 187),
(189, NULL, 'jiji', NULL, '2023-04-30', 187),
(190, NULL, 'que no pare la fiesta! don\'t stop the party', NULL, '2023-04-30', 187),
(191, NULL, 'a ver que tal va esto', NULL, '2023-04-30', 162),
(193, 'Wasaperos vamonos a la nieve', 'eeeeeee', NULL, '2023-04-30', NULL),
(194, NULL, 'si', NULL, '2023-04-30', 193),
(195, 'Prueba imagen', 'prueba imagen', NULL, '2023-05-01', NULL),
(196, 'Prueba Gaara', 'prueba gaara', NULL, '2023-05-01', NULL),
(197, 'Prueba Gaara', 'prueba de Gaara', 'gaara.jpg', '2023-05-01', NULL),
(198, 'prueba sin imagen', 'prueba sin imagen', NULL, '2023-05-01', NULL),
(199, 'prueba imagen', 'prueba imagen', 'jabon.jpg', '2023-05-01', NULL),
(200, NULL, 'pruebo', NULL, '2023-05-01', NULL),
(201, 'prueba sin imagen', 'prueba sin imagen', NULL, '2023-05-01', NULL),
(202, 'Vamos que nos vamos!!', 'Weeeeee', NULL, '2023-05-02', NULL),
(203, 'Vamos que nos Vamos!!', 'pruebo', NULL, '2023-05-02', NULL),
(204, 'Ultima prueba', 'fsdfsdfsd', NULL, '2023-05-02', NULL),
(205, 'NNNN', 'Vamos a organizar algo muy guapo, de lo mejor de lo mejor jajajajaj', NULL, '2023-05-02', NULL),
(206, NULL, 'voy a probar', NULL, '2023-05-03', NULL),
(207, NULL, 'molt be', NULL, '2023-05-03', NULL),
(208, NULL, 'Vale', NULL, '2023-05-03', 193),
(209, 'Ya es Fiesta!!!', 'Essssssssssssssssssssssssssssssss fsdfsdefsdf sd fsdf sdfsdf sdf sdf sdf sdf sdf ds sd fsdf sd sdfsdfsd fsdf sd fsdf sd fds sdf sdf sdf sd sdf sd fsd sd sd sd', NULL, '2023-05-03', NULL),
(210, NULL, 'Vamos hacer una prueba!', NULL, '2023-05-03', 209),
(211, NULL, 'Vale', NULL, '2023-05-04', NULL),
(212, NULL, 'prueba', NULL, '2023-05-04', NULL),
(215, 'Animacion', 'Una buena animacion', NULL, '2023-05-04', NULL),
(216, 'Aqui viene Peterking', 'Partiendo la pana', NULL, '2023-05-04', NULL),
(217, 'Jajaja', 'tocate los huevos! fdsf sdfsd fdfsdsdfsdfsdfsdfsdfdfsdfsdfsdfsdfsddfstocate los huevos! fdsf sdfsd fdfsdsdfsdfsdfsdfsdfdfsdfsdfsdfsdfsddfstocate los huevos! fdsf sdfsd fdfsdsdfsdfsdfsdfsdfdfsdfsdfsdfsdfsddfstocate los huevos! fdsf sdfsd fdfsdsdfsdfsd', NULL, '2023-05-04', NULL),
(218, 'Carmen haciendo pruebas', '1 2 3 4...', NULL, '2023-05-04', NULL),
(219, NULL, 'bueno..', NULL, '2023-05-04', 193),
(220, NULL, '  Habia una vez una jirafa que iba to rapido por ahi fdsfsdf sdfsd sdfsd fsdfsd sd sdf sdf ssdf sd fsdsdf sdf sdf sd fssd sdf sdf sd', NULL, '2023-05-04', 209),
(221, NULL, 'dsad as as sa asdsdsad as as sa asdsvdsad as as sa asdsdsad as as sa asdsdsad as as sa asdsdsad as as sa asdsdsad as as sa asdsdsad as as sa asdsdsad as as sa asdsdsad as as sa asdsdsad as as sa asdsdsad as as sa asdsdsad as as sa asdsdsad as as sa a', NULL, '2023-05-04', 209),
(222, NULL, 'No!', NULL, '2023-05-04', 215),
(223, NULL, 'vale', NULL, '2023-05-04', NULL),
(224, NULL, 'Jeje que bien!', NULL, '2023-05-04', 218),
(225, NULL, 'joe', NULL, '2023-05-04', 147),
(226, 'Toma ya', 'jhajajaja', 'jabon2.jpg', '2023-05-04', NULL),
(227, 'Nuevo Mensaje en Cinefilos', 'hola', 'ocaña_piso.jpg', '2023-05-04', NULL),
(228, 'Pato', 'pato pato pato', NULL, '2023-05-04', NULL),
(229, 'Primer mensaje de los pirados', 'waaau', NULL, '2023-05-04', NULL),
(230, NULL, 'Bienvenidos a Red Social Scarlatti, Se sentirá muy agusto en este espacio', NULL, '2023-05-04', NULL),
(231, NULL, 'Wuaauuu!', NULL, '2023-05-04', 205),
(232, NULL, 'si', NULL, '2023-05-04', NULL),
(233, NULL, 'hola', NULL, '2023-05-05', NULL),
(234, NULL, 'que hay?', NULL, '2023-05-05', NULL),
(235, NULL, 'Na, aqui!', NULL, '2023-05-05', NULL),
(236, 'Bienvenidos', 'aqui probando', NULL, '2023-05-05', NULL),
(237, NULL, 'Hola Peterking como te va todo?', NULL, '2023-05-05', NULL),
(238, NULL, 'Todo bien????', NULL, '2023-05-05', NULL),
(239, NULL, 'Respondeme cuando puedas', NULL, '2023-05-05', NULL),
(240, NULL, 'Si, todo bien', NULL, '2023-05-05', NULL),
(241, NULL, 'a ver si funciona', NULL, '2023-05-05', NULL),
(242, NULL, 'Si, funciona correctamente.', NULL, '2023-05-05', NULL),
(243, NULL, 'peteeerr', NULL, '2023-05-05', NULL),
(244, NULL, 'que pasa broo!!', NULL, '2023-05-05', NULL),
(245, NULL, 'tienes algo que hacer?', NULL, '2023-05-05', NULL),
(246, NULL, 'Vamos dani que tu puedes', NULL, '2023-05-05', NULL),
(247, NULL, 'Dani me puedes hacer un favor?', NULL, '2023-05-05', NULL),
(248, NULL, '?', NULL, '2023-05-05', NULL),
(249, NULL, 'Que favor?', NULL, '2023-05-05', NULL),
(250, NULL, 'Vale', NULL, '2023-05-05', NULL),
(251, NULL, 'No, no hay nada que hacer', NULL, '2023-05-05', NULL),
(252, NULL, 'peterkingggg!!', NULL, '2023-05-05', NULL),
(253, 'Jua Jua', 'Somos unos pirados!', NULL, '2023-05-06', NULL),
(254, 'hablemos de cine', 'jaja hablemos de cine', NULL, '2023-05-06', NULL),
(255, NULL, 'juas', NULL, '2023-05-06', 158),
(256, NULL, 'Vale', NULL, '2023-05-07', 205),
(257, NULL, 'funciona?', NULL, '2023-05-07', 21),
(258, NULL, 'Si, va bien', NULL, '2023-05-07', 21),
(259, NULL, 'EYY!', NULL, '2023-05-07', 30),
(260, 'A varios destinatarios!!', 'A ver si funciona!!', NULL, '2023-05-07', NULL),
(264, 'Prueba', 'lobitos!', NULL, '2023-05-07', NULL),
(265, 'Voy a probar', 'siii', NULL, '2023-05-07', NULL),
(266, 'mensaje difusion', 'Mensaje difusion', NULL, '2023-05-07', NULL),
(267, 'Prueba de peterkig', 'Prueba de peterking', NULL, '2023-05-07', NULL),
(268, 'IEE', 'IEE', NULL, '2023-05-07', NULL),
(269, 'carmencita', 'carmencita', NULL, '2023-05-07', NULL),
(270, 'ULTIMA PRUEBA DE PETER', 'Este es Peter', NULL, '2023-05-07', NULL),
(271, 'Mensaje de difusion de Dani', 'Para todos!!!', NULL, '2023-05-07', NULL),
(272, 'Para todos los destinatarios', 'Soy Manu', NULL, '2023-05-07', NULL),
(273, NULL, 'hola', NULL, '2023-05-07', NULL),
(274, 'Bienvenidos a mi grupo!', 'Aquí podrás debatir de todos los temas.', NULL, '2023-05-07', NULL),
(275, 'Vaya', 'Aqui nueva imagen', 'paisaje.jpg', '2023-05-07', NULL),
(276, 'Aqui imagen de prueba', 'zzzz', 'edificio.jpg', '2023-05-07', NULL),
(277, 'wUAAAA', 'ASASA', NULL, '2023-05-08', NULL),
(278, NULL, 'jaja', NULL, '2023-05-08', 193),
(279, NULL, 'wowwww', NULL, '2023-05-08', 154),
(280, NULL, 'Vamo pa ya', NULL, '2023-05-08', 18),
(281, NULL, 'Vamos animaros!', NULL, '2023-05-08', 196),
(282, NULL, 'Wekeee', NULL, '2023-05-08', 270),
(283, NULL, 'jeje', NULL, '2023-05-08', 270),
(284, NULL, 'Weeee', NULL, '2023-05-08', 270),
(285, NULL, 'Una pregunta Toni!', NULL, '2023-05-09', NULL),
(286, NULL, 'ff', NULL, '2023-12-20', 215),
(287, NULL, 'Hola Carmen', NULL, '2023-12-20', NULL),
(288, NULL, 'dsadasd', NULL, '2023-12-21', 217),
(289, NULL, 'dsadsadasd', NULL, '2023-12-21', 217),
(290, NULL, 'dsadasdasd', NULL, '2023-12-21', 217),
(291, NULL, 'dsadasdasdasd', NULL, '2023-12-21', 217),
(292, NULL, 'dsadasdasdsadasdsad', NULL, '2023-12-21', 217);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post_grupos`
--

CREATE TABLE `post_grupos` (
  `idpost` int(11) NOT NULL,
  `nombreG` varchar(40) NOT NULL,
  `nick_envia` varchar(40) DEFAULT NULL,
  `estado` enum('enviado','aprobado','rechazado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `post_grupos`
--

INSERT INTO `post_grupos` (`idpost`, `nombreG`, `nick_envia`, `estado`) VALUES
(1, 'AMPA CEIP San Marcos', 'dani1', 'enviado'),
(1, 'La clase de 3EP', 'albert44', 'enviado'),
(2, 'Los Wasaperos', 'peterking', 'aprobado'),
(3, 'CD Baloncesto', 'sole77', 'enviado'),
(4, 'CD Baloncesto', 'sole77', 'enviado'),
(5, 'La clase de 3EP', 'carol22', 'enviado'),
(9, 'Los Wasaperos', 'dani1', 'aprobado'),
(18, 'Los Wasaperos', 'peterking', 'aprobado'),
(19, 'Los Gambiteros', 'peterking', 'aprobado'),
(20, 'Los Wasaperos', 'peterking', 'enviado'),
(21, 'Los Wasaperos', 'carmen88', 'aprobado'),
(22, 'Los Wasaperos', 'carmen88', 'aprobado'),
(23, 'Los Wasaperos', 'carmen88', 'aprobado'),
(24, 'Los Gambiteros', 'carmen88', 'aprobado'),
(25, 'Los Ruteros 4x4', 'dani1', 'enviado'),
(26, 'Los Ruteros 4x4', 'dani1', 'enviado'),
(27, 'Los Wasaperos', 'dani1', 'aprobado'),
(28, 'Los Wasaperos', 'dani1', 'aprobado'),
(29, 'Los Wasaperos', 'peterking', 'aprobado'),
(30, 'Los Wasaperos', 'carmen88', 'aprobado'),
(31, 'Los Wasaperos', 'peterking', 'enviado'),
(32, 'Los Wasaperos', 'carmen88', 'aprobado'),
(33, 'Los Wasaperos', 'peterking', 'aprobado'),
(34, 'Los Wasaperos', 'carmen88', 'aprobado'),
(35, 'El grupo de Carmen', 'carmen88', 'aprobado'),
(41, 'Los Wasaperos', 'peterking', 'aprobado'),
(42, 'Los Wasaperos', 'peterking', 'aprobado'),
(43, 'Los Wasaperos', 'carmen88', 'aprobado'),
(44, 'Los Wasaperos', 'carmen88', 'aprobado'),
(45, 'Los Wasaperos', 'dani1', 'aprobado'),
(46, 'Los Wasaperos', 'dani1', 'aprobado'),
(47, 'Los Wasaperos', 'dani1', 'aprobado'),
(48, 'Los Wasaperos', 'dani1', 'aprobado'),
(49, 'Los Wasaperos', 'dani1', 'enviado'),
(50, 'Los Wasaperos', 'maria99', 'enviado'),
(51, 'Cinefilos', 'sole77', 'aprobado'),
(52, 'Cinefilos', 'sole77', 'aprobado'),
(53, 'Los Ruteros 4x4', 'peterking', 'enviado'),
(54, 'El grupo de Carmen', 'peterking', 'aprobado'),
(55, 'El grupo de Carmen', 'peterking', 'aprobado'),
(56, 'La clase de 3EP', 'carol22', 'enviado'),
(97, 'Los Ruteros 4x4', 'peterking', 'enviado'),
(97, 'Los Wasaperos', 'peterking', 'enviado'),
(99, 'Los Ruteros 4x4', 'peterking', 'enviado'),
(99, 'Los Wasaperos', 'peterking', 'enviado'),
(100, 'Los Ruteros 4x4', 'peterking', 'aprobado'),
(100, 'Los Wasaperos', 'peterking', 'aprobado'),
(101, 'Los Gambiteros', 'peterking', 'aprobado'),
(102, 'El grupo de Carmen', 'peterking', 'aprobado'),
(103, 'Los Gambiteros', 'peterking', 'aprobado'),
(105, 'Los Wasaperos', 'peterking', 'enviado'),
(108, 'Los Wasaperos', 'peterking', 'aprobado'),
(109, 'Los Wasaperos', 'peterking', 'aprobado'),
(110, 'Los Wasaperos', 'carmen88', 'aprobado'),
(111, 'Los Wasaperos', 'peterking', 'aprobado'),
(112, 'Los Wasaperos', 'peterking', 'aprobado'),
(113, 'Los Wasaperos', 'peterking', 'aprobado'),
(114, 'Los Wasaperos', 'carmen88', 'aprobado'),
(115, 'Los Wasaperos', 'peterking', 'aprobado'),
(116, 'La clase de 4EP', 'peterking', 'aprobado'),
(117, 'El grupo de Carmen', 'carmen88', 'aprobado'),
(118, 'Los Gambiteros', 'peterking', 'aprobado'),
(119, 'El grupo de Carmen', 'peterking', 'aprobado'),
(123, 'Los Wasaperos', 'peterking', 'aprobado'),
(124, 'Los Ruteros 4x4', 'carmen88', 'aprobado'),
(124, 'Los Wasaperos', 'carmen88', 'aprobado'),
(126, 'El grupo de Carmen', 'peterking', 'aprobado'),
(127, 'Los Gambiteros', 'peterking', 'aprobado'),
(127, 'Los Wasaperos', 'peterking', 'aprobado'),
(131, 'Los Gambiteros', 'peterking', 'aprobado'),
(131, 'Los Ruteros 4x4', 'peterking', 'aprobado'),
(132, 'Los Gambiteros', 'dani1', 'aprobado'),
(133, 'Los Gambiteros', 'peterking', 'aprobado'),
(134, 'Los Gambiteros', 'dani1', 'aprobado'),
(135, 'Los Gambiteros', 'peterking', 'aprobado'),
(136, 'Los Gambiteros', 'peterking', 'aprobado'),
(137, 'Los Ruteros 4x4', 'peterking', 'aprobado'),
(138, 'Los Gambiteros', 'dani1', 'aprobado'),
(139, 'Los Gambiteros', 'dani1', 'aprobado'),
(140, 'Los Wasaperos', 'carmen88', 'aprobado'),
(141, 'Los Teloneros!', 'albert44', 'aprobado'),
(142, 'Los Teloneros!', 'albert44', 'aprobado'),
(143, 'Los Teloneros!', 'peterking', 'aprobado'),
(144, 'Los Teloneros!', 'carmen88', 'aprobado'),
(145, 'Los Teloneros!', 'carmen88', 'aprobado'),
(146, 'Los Teloneros!', 'peterking', 'aprobado'),
(147, 'Los Teloneros!', 'peterking', 'aprobado'),
(153, 'Los Wasaperos', 'peterking', 'aprobado'),
(154, 'Los Wasaperos', 'peterking', 'aprobado'),
(155, 'Los Wasaperos', 'peterking', 'aprobado'),
(158, 'Los Ruteros 4x4', 'dani1', 'aprobado'),
(159, 'Los Ruteros 4x4', 'dani1', 'aprobado'),
(160, 'Los Ruteros 4x4', 'carmen88', 'aprobado'),
(161, 'Los Ruteros 4x4', 'carmen88', 'aprobado'),
(162, 'Los Wasaperos', 'carol22', 'aprobado'),
(163, 'Los Wasaperos', 'dani1', 'aprobado'),
(164, 'Los Lobos', 'dani1', 'aprobado'),
(165, 'Los Wasaperos', 'dani1', 'aprobado'),
(166, 'Los Wasaperos', 'carol22', 'aprobado'),
(167, 'Los Lobos', 'carmen88', 'aprobado'),
(168, 'Los Wasaperos', 'peterking', 'aprobado'),
(169, 'Los Lobos', 'peterking', 'aprobado'),
(170, 'Los Wasaperos', 'peterking', 'aprobado'),
(171, 'Los Wasaperos', 'carmen88', 'aprobado'),
(172, 'Los Wasaperos', 'carol22', 'aprobado'),
(174, 'Los Gambiteros', 'peterking', 'aprobado'),
(175, 'Los Wasaperos', 'peterking', 'aprobado'),
(176, 'Los Wasaperos', 'peterking', 'aprobado'),
(177, 'Los Wasaperos', 'peterking', 'aprobado'),
(178, 'Los Wasaperos', 'peterking', 'aprobado'),
(179, 'Los Wasaperos', 'carmen88', 'aprobado'),
(180, 'Los Wasaperos', 'peterking', 'aprobado'),
(181, 'Los Wasaperos', 'carol22', 'aprobado'),
(182, 'Los Wasaperos', 'carol22', 'aprobado'),
(183, 'Los Wasaperos', 'carol22', 'aprobado'),
(184, 'Los Wasaperos', 'carol22', 'aprobado'),
(185, 'Los Wasaperos', 'carol22', 'aprobado'),
(186, 'Los Wasaperos', 'carmen88', 'aprobado'),
(187, 'Los Wasaperos', 'peterking', 'aprobado'),
(188, 'Los Wasaperos', 'peterking', 'aprobado'),
(189, 'Los Wasaperos', 'carol22', 'aprobado'),
(190, 'Los Wasaperos', 'carmen88', 'aprobado'),
(191, 'Los Wasaperos', 'carmen88', 'aprobado'),
(192, 'Los Wasaperos', 'carmen88', 'aprobado'),
(193, 'Los Wasaperos', 'carmen88', 'aprobado'),
(194, 'Los Wasaperos', 'carol22', 'aprobado'),
(195, 'Los Wasaperos', 'peterking', 'aprobado'),
(196, 'Los Wasaperos', 'peterking', 'aprobado'),
(197, 'Los Wasaperos', 'peterking', 'aprobado'),
(198, 'Los Wasaperos', 'peterking', 'aprobado'),
(202, 'Los Wasaperos', NULL, 'enviado'),
(203, 'Los Wasaperos', 'peterking', 'aprobado'),
(204, 'Los Wasaperos', 'peterking', 'aprobado'),
(205, 'Los Wasaperos', 'peterking', 'aprobado'),
(208, 'Los Wasaperos', 'carmen88', 'enviado'),
(209, 'Los Gambiteros', 'peterking', 'aprobado'),
(210, 'Los Gambiteros', 'peterking', 'aprobado'),
(215, 'Los Gambiteros', 'dani1', 'aprobado'),
(216, 'Los Teloneros!', 'peterking', 'aprobado'),
(217, 'Los Teloneros!', 'albert44', 'aprobado'),
(218, 'El grupo de Carmen', 'carmen88', 'aprobado'),
(219, 'Los Wasaperos', 'peterking', 'aprobado'),
(220, 'Los Gambiteros', 'peterking', 'aprobado'),
(221, 'Los Gambiteros', 'peterking', 'aprobado'),
(222, 'Los Gambiteros', 'peterking', 'aprobado'),
(224, 'El grupo de Carmen', 'carmen88', 'aprobado'),
(225, 'Los Teloneros!', 'carmen88', 'aprobado'),
(226, 'La clase de 3EP', 'albert44', 'aprobado'),
(227, 'Cinefilos', 'sole77', 'aprobado'),
(228, 'La clase de 3EP', 'albert44', 'aprobado'),
(229, 'Los pirados', 'malaguita', 'aprobado'),
(231, 'Los Wasaperos', 'peterking', 'aprobado'),
(236, 'La boutique de la Abuela', 'gregorio', 'aprobado'),
(253, 'Los pirados', 'carmen88', 'aprobado'),
(254, 'Cinefilos', 'dani1', 'aprobado'),
(255, 'Los Ruteros 4x4', 'peterking', 'enviado'),
(256, 'Los Wasaperos', 'peterking', 'aprobado'),
(257, 'Los Wasaperos', 'carol22', 'aprobado'),
(258, 'Los Wasaperos', 'maria99', 'aprobado'),
(259, 'Los Wasaperos', 'peterking', 'aprobado'),
(260, 'Cinefilos', 'dani1', 'aprobado'),
(260, 'El grupo de Carmen', 'dani1', 'aprobado'),
(261, 'El grupo de Carmen', 'dani1', 'aprobado'),
(261, 'Los Lobos', 'dani1', 'aprobado'),
(262, 'El grupo de Carmen', 'dani1', 'aprobado'),
(262, 'Los Lobos', 'dani1', 'aprobado'),
(263, 'El grupo de Carmen', 'dani1', 'aprobado'),
(263, 'Los Lobos', 'dani1', 'aprobado'),
(264, 'El grupo de Carmen', 'peterking', 'aprobado'),
(264, 'Los Lobos', 'peterking', 'aprobado'),
(265, 'Los Lobos', 'carmen88', 'enviado'),
(266, 'El grupo de Carmen', 'carmen88', 'aprobado'),
(266, 'Los Lobos', 'carmen88', 'enviado'),
(267, 'El grupo de Carmen', 'peterking', 'enviado'),
(267, 'Los Lobos', 'peterking', 'enviado'),
(268, 'Los Wasaperos', 'peterking', 'aprobado'),
(270, 'Los Gambiteros', 'peterking', 'aprobado'),
(270, 'Los Wasaperos', 'peterking', 'aprobado'),
(271, 'Cinefilos', 'dani1', 'enviado'),
(274, 'El Grupo de Toni', 'toni33', 'aprobado'),
(275, 'El Grupo de Toni', 'peterking', 'aprobado'),
(276, 'Los Planetas', 'gregorio', 'aprobado'),
(277, 'Los Wasaperos', 'toni33', 'aprobado'),
(278, 'Los Wasaperos', 'toni33', 'aprobado'),
(279, 'Los Wasaperos', 'peterking', 'aprobado'),
(280, 'Los Wasaperos', 'peterking', 'aprobado'),
(281, 'Los Wasaperos', 'peterking', 'aprobado'),
(282, 'Los Gambiteros', 'peterking', 'aprobado'),
(283, 'Los Gambiteros', 'dani1', 'aprobado'),
(284, 'Los Gambiteros', 'carol22', 'aprobado'),
(286, 'Los Gambiteros', 'dani1', 'aprobado'),
(288, 'Los Teloneros!', 'albert44', 'aprobado'),
(289, 'Los Teloneros!', 'albert44', 'aprobado'),
(290, 'Los Teloneros!', 'albert44', 'aprobado'),
(291, 'Los Teloneros!', 'albert44', 'aprobado'),
(292, 'Los Teloneros!', 'albert44', 'aprobado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post_usuarios`
--

CREATE TABLE `post_usuarios` (
  `idpost` int(11) NOT NULL,
  `nick_recibe` varchar(40) NOT NULL,
  `nick_envia` varchar(40) DEFAULT NULL,
  `leido` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `post_usuarios`
--

INSERT INTO `post_usuarios` (`idpost`, `nick_recibe`, `nick_envia`, `leido`) VALUES
(78, 'peterking', 'carmen88', 1),
(81, 'carmen88', 'peterking', 1),
(82, 'peterking', 'carmen88', 1),
(83, 'carmen88', 'peterking', 1),
(84, 'peterking', 'carmen88', 1),
(85, 'peterking', 'carmen88', 1),
(86, 'carmen88', 'peterking', 1),
(87, 'peterking', 'carmen88', 1),
(88, 'carmen88', 'peterking', 1),
(89, 'peterking', 'carmen88', 1),
(90, 'peterking', 'albert44', 1),
(91, 'albert44', 'peterking', 1),
(92, 'peterking', 'albert44', 1),
(93, 'albert44', 'peterking', 1),
(94, 'peterking', 'carmen88', 1),
(95, 'peterking', 'albert44', 1),
(96, 'peterking', 'carmen88', 1),
(123, 'carmen88', 'peterking', 1),
(124, 'dani1', 'carmen88', 1),
(125, 'albert44', 'carmen88', 1),
(125, 'dani1', 'carmen88', 1),
(126, 'carmen88', 'peterking', 1),
(126, 'dani1', 'peterking', 1),
(127, 'albert44', 'peterking', 1),
(127, 'carol22', 'peterking', 1),
(127, 'peterking', 'dani1', 1),
(128, 'peterking', 'dani1', 1),
(129, 'peterking', 'carol22', 1),
(130, 'peterking', 'carmen88', 1),
(151, 'albert44', 'peterking', 1),
(151, 'carmen88', 'peterking', 1),
(151, 'carol22', 'peterking', 1),
(151, 'dani1', 'peterking', 1),
(151, 'manu12', 'peterking', 1),
(151, 'maria99', 'peterking', 1),
(151, 'pereico', 'peterking', 1),
(151, 'sole77', 'peterking', 1),
(152, 'albert44', 'peterking', 1),
(152, 'carmen88', 'peterking', 1),
(152, 'carol22', 'peterking', 1),
(152, 'dani1', 'peterking', 1),
(152, 'manu12', 'peterking', 1),
(152, 'maria99', 'peterking', 1),
(152, 'pereico', 'peterking', 1),
(152, 'sole77', 'peterking', 1),
(153, 'albert44', 'peterking', 1),
(153, 'carmen88', 'peterking', 1),
(153, 'carol22', 'peterking', 1),
(153, 'dani1', 'peterking', 1),
(153, 'manu12', 'peterking', 1),
(153, 'maria99', 'peterking', 1),
(153, 'pereico', 'peterking', 1),
(153, 'sole77', 'peterking', 1),
(154, 'albert44', 'peterking', 1),
(154, 'carmen88', 'peterking', 1),
(154, 'carol22', 'peterking', 1),
(154, 'dani1', 'peterking', 1),
(154, 'manu12', 'peterking', 1),
(154, 'maria99', 'peterking', 1),
(154, 'pereico', 'peterking', 1),
(154, 'sole77', 'peterking', 1),
(156, 'peterking', 'carol22', 1),
(157, 'carmen88', 'albert44', 1),
(157, 'pereico', 'albert44', 1),
(158, 'peterking', 'dani1', 1),
(159, 'carmen88', 'dani1', 1),
(159, 'maria99', 'dani1', 1),
(199, 'carmen88', 'peterking', 1),
(200, 'peterking', 'carmen88', 1),
(201, 'carmen88', 'peterking', 1),
(206, 'peterking', 'carmen88', 1),
(207, 'peterking', 'carmen88', 1),
(211, 'albert44', 'peterking', 1),
(212, 'albert44', 'peterking', 1),
(213, 'albert44', 'peterking', 1),
(214, 'albert44', 'peterking', 1),
(223, 'dani1', 'peterking', 1),
(230, 'gregorio', 'admin', 1),
(232, 'carmen88', 'peterking', 1),
(233, 'dani1', 'gregorio', 1),
(234, 'dani1', 'gregorio', 1),
(235, 'gregorio', 'dani1', 1),
(237, 'peterking', 'dani1', 1),
(238, 'peterking', 'dani1', 1),
(239, 'peterking', 'carmen88', 1),
(240, 'dani1', 'peterking', 1),
(241, 'peterking', 'maria99', 1),
(242, 'peterking', 'maria99', 1),
(243, 'peterking', 'dani1', 1),
(244, 'dani1', 'peterking', 1),
(245, 'dani1', 'peterking', 1),
(246, 'dani1', 'carmen88', 1),
(247, 'dani1', 'maria99', 1),
(248, 'dani1', 'maria99', 1),
(249, 'maria99', 'dani1', 1),
(250, 'peterking', 'carmen88', 1),
(251, 'peterking', 'dani1', 1),
(252, 'peterking', 'pereico', 1),
(270, 'carmen88', 'peterking', 1),
(270, 'dani1', 'peterking', 1),
(271, 'carmen88', 'dani1', 1),
(271, 'carol22', 'dani1', 1),
(271, 'gregorio', 'dani1', 0),
(271, 'maria99', 'dani1', 0),
(271, 'peterking', 'dani1', 1),
(272, 'carmen88', 'manu12', 1),
(272, 'maria99', 'manu12', 0),
(272, 'peterking', 'manu12', 1),
(273, 'carmen88', 'carol22', 0),
(285, 'toni33', 'peterking', 0),
(287, 'carmen88', 'dani1', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `nick` varchar(40) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tlfno` varchar(9) DEFAULT NULL,
  `no_leidos` int(11) NOT NULL,
  `online` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nick`, `pwd`, `email`, `tlfno`, `no_leidos`, `online`) VALUES
('admin', 'admin', 'admin@gmail.com', '5533344', 0, 0),
('albert44', 'albert44', 'albert44@domenico.es', '11111111', 0, 0),
('carmen88', 'carmen88', 'carmen88@domenico.es', '11111111', 0, 0),
('carol22', 'carol22', 'carol22@domenico.es', '11111111', 1, 0),
('conguito', 'hola1$', 'conguito@gmail.com', '323231', 0, 0),
('dani1', 'dani1', 'dani1@domenico.es', '11111111', 1, 0),
('gregorio', 'gregorio', 'gregorio@gmail.com', '444332233', 0, 0),
('malaguita', 'hola1$', 'malaguita@gmail.com', '5444', 1, 0),
('manu12', 'manu12', 'manu12@domenico.es', '11111111', 0, 0),
('maria99', 'maria99', 'maria99@domenico.es', '11111111', 0, 0),
('pereico', 'hola1$', 'pereico@gmail.com', '5444', 0, 0),
('peterking', 'peterking', 'peterking@domenico.es', '11111111', 0, 1),
('sole77', 'sole77', 'sole77@domenico.es', '11111111', 0, 0),
('toni33', 'toni33', 'toni33@domenico.es', '11111111', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_grupo`
--

CREATE TABLE `usuarios_grupo` (
  `nick_contacto` varchar(40) NOT NULL,
  `nombreG` varchar(40) NOT NULL,
  `moderador` tinyint(1) DEFAULT NULL,
  `admitido` tinyint(1) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios_grupo`
--

INSERT INTO `usuarios_grupo` (`nick_contacto`, `nombreG`, `moderador`, `admitido`, `admin`) VALUES
('albert44', 'La clase de 3EP', 1, 1, 1),
('albert44', 'La clase de 4EP', 1, 1, 0),
('albert44', 'Los Lobos', 0, 1, 0),
('albert44', 'Los Teloneros!', 1, 1, 1),
('carmen88', 'asdasdasdasdasd', 1, 1, 0),
('carmen88', 'El grupo de Carmen', 1, 1, 1),
('carmen88', 'Equipo A', 0, 1, 0),
('carmen88', 'Los pirados', 0, 1, 0),
('carmen88', 'Los Planetas', 0, 1, 0),
('carmen88', 'Los Teloneros!', 0, 1, 0),
('carol22', 'AMPA CEIP San Marcos', 1, 1, 1),
('carol22', 'La clase de 3EP', 0, 1, 0),
('carol22', 'Los Gambiteros', 0, 1, 0),
('carol22', 'Los Wasaperos', 1, 1, 0),
('dani1', 'AMPA CEIP San Marcos', 1, 1, 0),
('dani1', 'Cinefilos', 0, 1, 0),
('dani1', 'El grupo de Carmen', 1, 1, 0),
('dani1', 'Los Gambiteros', 1, 1, 0),
('dani1', 'Los Lobos', 1, 1, 1),
('dani1', 'Los Ruteros 4x4', 1, 1, 1),
('gregorio', 'La boutique de la Abuela', 1, 1, 1),
('gregorio', 'Los Planetas', 1, 1, 1),
('malaguita', 'Los Gambiteros', 0, 1, 0),
('malaguita', 'Los Karatekas', 1, 1, 1),
('malaguita', 'Los Morados', 1, 1, 1),
('malaguita', 'Los pirados', 1, 1, 1),
('maria99', 'Los Wasaperos', 0, 1, 0),
('peterking', 'El Grupo de Toni', 0, 1, 0),
('peterking', 'Equipo A', 1, 1, 1),
('peterking', 'Grupo Billar', 1, 1, 1),
('peterking', 'Grupo de Tenis', 1, 1, 1),
('peterking', 'La clase de 4EP', 1, 1, 1),
('peterking', 'Los Gambiteros', 1, 1, 1),
('peterking', 'Los Lobos', 0, 1, 0),
('peterking', 'Los Ruteros 4x4', 0, 1, 0),
('peterking', 'Los Teloneros!', 0, 1, 0),
('peterking', 'Los Wasaperos', 1, 1, 1),
('sole77', 'CD Baloncesto', 0, 0, 0),
('sole77', 'Cinefilos', 1, 1, 1),
('sole77', 'La clase de 3EP', 0, 0, 0),
('toni33', 'El Grupo de Toni', 1, 1, 1),
('toni33', 'Los Gambiteros', 0, 1, 0),
('toni33', 'Los Wasaperos', 0, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE `visitas` (
  `id` int(11) NOT NULL,
  `nick_perfil` varchar(40) NOT NULL,
  `nick_visitante` varchar(40) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `visitas`
--

INSERT INTO `visitas` (`id`, `nick_perfil`, `nick_visitante`, `fecha`) VALUES
(1, 'albert44', 'carmen88', '2023-05-09'),
(2, 'albert44', 'peterking', '2023-05-09'),
(3, 'carmen88', 'peterking', '2023-05-09'),
(4, 'carmen88', 'toni33', '2023-05-09'),
(5, 'dani1', 'peterking', '2023-05-09'),
(6, 'maria99', 'dani1', '2023-05-09'),
(7, 'maria99', 'manu12', '2023-05-06'),
(8, 'maria99', 'peterking', '2023-05-09'),
(9, 'peterking', 'carmen88', '2023-05-09'),
(10, 'peterking', 'dani1', '2023-05-09'),
(11, 'peterking', 'maria99', '2023-05-09'),
(12, 'peterking', 'toni33', '2023-05-09'),
(13, 'toni33', 'peterking', '2023-05-09'),
(14, 'carmen88', 'peterking', '2023-05-09'),
(15, 'carmen88', 'peterking', '2023-05-09'),
(16, 'peterking', 'carmen88', '2023-05-09'),
(17, 'peterking', 'pereico', '2023-05-09'),
(18, 'carmen88', 'peterking', '2023-05-09'),
(19, 'carmen88', 'peterking', '2023-05-09'),
(20, 'carmen88', 'peterking', '2023-05-09'),
(21, 'carmen88', 'peterking', '2023-05-09'),
(22, 'carmen88', 'peterking', '2023-05-09'),
(23, 'carmen88', 'peterking', '2023-05-09'),
(24, 'carmen88', 'peterking', '2023-05-09'),
(25, 'carmen88', 'peterking', '2023-05-09'),
(26, 'carmen88', 'peterking', '2023-05-09'),
(27, 'carmen88', 'peterking', '2023-05-09'),
(28, 'carmen88', 'peterking', '2023-05-09'),
(29, 'carmen88', 'peterking', '2023-05-09'),
(30, 'carmen88', 'toni33', '2023-05-09'),
(31, 'dani1', 'peterking', '2023-05-10'),
(32, 'sole77', 'peterking', '2023-05-10'),
(33, 'sole77', 'carmen88', '2023-05-10'),
(34, 'sole77', 'carmen88', '2023-05-10'),
(35, 'sole77', 'carmen88', '2023-05-10'),
(36, 'carmen88', 'sole77', '2023-05-10'),
(37, 'carol22', 'toni33', '2023-05-10'),
(38, 'carol22', 'toni33', '2023-05-10'),
(39, 'carol22', 'toni33', '2023-05-10'),
(40, 'carmen88', 'dani1', '2023-12-20'),
(41, 'carmen88', 'dani1', '2023-12-20'),
(42, 'carmen88', 'dani1', '2023-12-20'),
(43, 'peterking', 'dani1', '2023-12-20'),
(44, 'carmen88', 'dani1', '2023-12-20'),
(45, 'carmen88', 'dani1', '2023-12-20'),
(46, 'carmen88', 'dani1', '2023-12-20'),
(47, 'carmen88', 'dani1', '2023-12-20'),
(48, 'carmen88', 'dani1', '2023-12-20'),
(49, 'carmen88', 'dani1', '2023-12-20'),
(50, 'carmen88', 'dani1', '2023-12-20'),
(51, 'carmen88', 'dani1', '2023-12-20'),
(52, 'carmen88', 'dani1', '2023-12-20'),
(53, 'peterking', 'dani1', '2023-12-20'),
(54, 'peterking', 'dani1', '2023-12-20'),
(55, 'peterking', 'dani1', '2023-12-20'),
(56, 'peterking', 'dani1', '2023-12-20'),
(57, 'carmen88', 'dani1', '2023-12-20'),
(58, 'carmen88', 'dani1', '2023-12-20'),
(59, 'pereico', 'albert44', '2024-01-19');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`nick`,`nick_contacto`),
  ADD KEY `fk_cu2` (`nick_contacto`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`nombreG`);

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD KEY `id_post` (`id_post`),
  ADD KEY `nick` (`nick`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`nick`,`idperfil`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`idpost`);

--
-- Indices de la tabla `post_grupos`
--
ALTER TABLE `post_grupos`
  ADD PRIMARY KEY (`idpost`,`nombreG`),
  ADD KEY `fk_pg_g` (`nombreG`),
  ADD KEY `fk_pg_u` (`nick_envia`);

--
-- Indices de la tabla `post_usuarios`
--
ALTER TABLE `post_usuarios`
  ADD PRIMARY KEY (`idpost`,`nick_recibe`),
  ADD KEY `fk_pu_u` (`nick_recibe`),
  ADD KEY `fk_pu_u2` (`nick_envia`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`nick`);

--
-- Indices de la tabla `usuarios_grupo`
--
ALTER TABLE `usuarios_grupo`
  ADD PRIMARY KEY (`nick_contacto`,`nombreG`),
  ADD KEY `fk_ug_g` (`nombreG`);

--
-- Indices de la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nick_visitante` (`nick_visitante`),
  ADD KEY `nick_perfil` (`nick_perfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `idpost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=293;

--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD CONSTRAINT `fk_cu` FOREIGN KEY (`nick`) REFERENCES `usuarios` (`nick`),
  ADD CONSTRAINT `fk_cu2` FOREIGN KEY (`nick_contacto`) REFERENCES `usuarios` (`nick`);

--
-- Filtros para la tabla `post_grupos`
--
ALTER TABLE `post_grupos`
  ADD CONSTRAINT `fk_pg_g` FOREIGN KEY (`nombreG`) REFERENCES `grupos` (`nombreG`),
  ADD CONSTRAINT `fk_pg_u` FOREIGN KEY (`nick_envia`) REFERENCES `usuarios` (`nick`);

--
-- Filtros para la tabla `post_usuarios`
--
ALTER TABLE `post_usuarios`
  ADD CONSTRAINT `fk_pu_u` FOREIGN KEY (`nick_recibe`) REFERENCES `usuarios` (`nick`),
  ADD CONSTRAINT `fk_pu_u2` FOREIGN KEY (`nick_envia`) REFERENCES `usuarios` (`nick`);

--
-- Filtros para la tabla `usuarios_grupo`
--
ALTER TABLE `usuarios_grupo`
  ADD CONSTRAINT `fk_ug_g` FOREIGN KEY (`nombreG`) REFERENCES `grupos` (`nombreG`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ug_u` FOREIGN KEY (`nick_contacto`) REFERENCES `usuarios` (`nick`);

--
-- Filtros para la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD CONSTRAINT `nick_perfil` FOREIGN KEY (`nick_perfil`) REFERENCES `perfiles` (`nick`),
  ADD CONSTRAINT `nick_visitante` FOREIGN KEY (`nick_visitante`) REFERENCES `usuarios` (`nick`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
