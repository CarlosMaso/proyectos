-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 01-05-2023 a las 07:38:24
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ligaInfantil`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abril`
--

CREATE TABLE `abril` (
  `idAlumno` int(5) NOT NULL,
  `kichoPoomsae` int(3) NOT NULL,
  `destreza` int(3) NOT NULL,
  `salto` int(3) NOT NULL,
  `combate` int(3) NOT NULL,
  `extra` int(3) NOT NULL,
  `total` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `abril`
--

INSERT INTO `abril` (`idAlumno`, `kichoPoomsae`, `destreza`, `salto`, `combate`, `extra`, `total`) VALUES
(10, 0, 0, 0, 0, 0, 0),
(11, 0, 0, 0, 0, 0, 0),
(12, 0, 0, 0, 0, 0, 0),
(13, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `nom` text NOT NULL,
  `any` int(4) NOT NULL,
  `id` int(4) NOT NULL,
  `total` int(10) NOT NULL,
  `idProfesor` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`nom`, `any`, `id`, `total`, `idProfesor`) VALUES
('Pablito Martinez', 2000, 10, 25, '12345678A'),
('Manolito Rodrigez', 2000, 11, 0, '12345678A'),
('Marta García', 2000, 12, 30, '12345678A'),
('Rosa Rosae', 2000, 13, 0, '12345678A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diciembre`
--

CREATE TABLE `diciembre` (
  `idAlumno` int(5) NOT NULL,
  `kichoPoomsae` int(3) NOT NULL,
  `destreza` int(3) NOT NULL,
  `salto` int(3) NOT NULL,
  `combate` int(3) NOT NULL,
  `extra` int(3) NOT NULL,
  `total` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `diciembre`
--

INSERT INTO `diciembre` (`idAlumno`, `kichoPoomsae`, `destreza`, `salto`, `combate`, `extra`, `total`) VALUES
(10, 0, 0, 0, 0, 0, 0),
(11, 0, 0, 0, 0, 0, 0),
(12, 0, 0, 0, 0, 0, 0),
(13, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enero`
--

CREATE TABLE `enero` (
  `idAlumno` int(5) NOT NULL,
  `kichoPoomsae` int(3) NOT NULL,
  `destreza` int(3) NOT NULL,
  `salto` int(3) NOT NULL,
  `combate` int(3) NOT NULL,
  `extra` int(3) NOT NULL,
  `total` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `enero`
--

INSERT INTO `enero` (`idAlumno`, `kichoPoomsae`, `destreza`, `salto`, `combate`, `extra`, `total`) VALUES
(10, 0, 0, 0, 0, 0, 0),
(11, 0, 0, 0, 0, 0, 0),
(12, 0, 0, 0, 0, 0, 0),
(13, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `febrero`
--

CREATE TABLE `febrero` (
  `idAlumno` int(5) NOT NULL,
  `kichoPoomsae` int(11) NOT NULL,
  `destreza` int(11) NOT NULL,
  `salto` int(11) NOT NULL,
  `combate` int(11) NOT NULL,
  `extra` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `febrero`
--

INSERT INTO `febrero` (`idAlumno`, `kichoPoomsae`, `destreza`, `salto`, `combate`, `extra`, `total`) VALUES
(10, 0, 0, 0, 0, 0, 0),
(11, 0, 0, 0, 0, 0, 0),
(12, 0, 0, 0, 0, 0, 0),
(13, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `junio`
--

CREATE TABLE `junio` (
  `idAlumno` int(5) NOT NULL,
  `kichoPoomsae` int(3) NOT NULL,
  `destreza` int(3) NOT NULL,
  `salto` int(3) NOT NULL,
  `combate` int(3) NOT NULL,
  `extra` int(3) NOT NULL,
  `total` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `junio`
--

INSERT INTO `junio` (`idAlumno`, `kichoPoomsae`, `destreza`, `salto`, `combate`, `extra`, `total`) VALUES
(10, 0, 0, 0, 0, 0, 0),
(11, 0, 0, 0, 0, 0, 0),
(12, 0, 0, 0, 0, 0, 0),
(13, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `idProfesor` varchar(9) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`idProfesor`, `usuario`, `password`) VALUES
('11122233Z', 'profeMati', '$2y$10$9eDFTrjvcqpWl.wILU3WGuwjzgb3FNWF5IFUF0C8HGHgwcgAWL3EW'),
('12345678A', 'admin', '$2y$10$fXiY6/hXrUhqkt2mYrQa/O1I.L43xUUWGSjq322PSPwDC6g/xj7k2'),
('99999999P', 'profe123', '$2y$10$TLeUKzgYxnUZDNkpEznBeOwO4fzBVy0zi0vft6VnxkVHvKPgg2ccy');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marzo`
--

CREATE TABLE `marzo` (
  `idAlumno` int(5) NOT NULL,
  `kichoPoomsae` int(3) NOT NULL,
  `destreza` int(3) NOT NULL,
  `salto` int(3) NOT NULL,
  `combate` int(3) NOT NULL,
  `extra` int(3) NOT NULL,
  `total` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marzo`
--

INSERT INTO `marzo` (`idAlumno`, `kichoPoomsae`, `destreza`, `salto`, `combate`, `extra`, `total`) VALUES
(10, 0, 0, 0, 0, 0, 0),
(11, 0, 0, 0, 0, 0, 0),
(12, 0, 0, 0, 0, 0, 0),
(13, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mayo`
--

CREATE TABLE `mayo` (
  `idAlumno` int(5) NOT NULL,
  `kichoPoomsae` int(3) NOT NULL,
  `destreza` int(3) NOT NULL,
  `salto` int(3) NOT NULL,
  `combate` int(3) NOT NULL,
  `extra` int(3) NOT NULL,
  `total` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mayo`
--

INSERT INTO `mayo` (`idAlumno`, `kichoPoomsae`, `destreza`, `salto`, `combate`, `extra`, `total`) VALUES
(10, 0, 0, 5, 0, 0, 5),
(11, 0, 0, 0, 0, 0, 0),
(12, 0, 0, 0, 0, 0, 0),
(13, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noviembre`
--

CREATE TABLE `noviembre` (
  `idAlumno` int(5) NOT NULL,
  `kichoPoomsae` int(3) NOT NULL,
  `destreza` int(3) NOT NULL,
  `salto` int(3) NOT NULL,
  `combate` int(3) NOT NULL,
  `extra` int(3) NOT NULL,
  `total` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `noviembre`
--

INSERT INTO `noviembre` (`idAlumno`, `kichoPoomsae`, `destreza`, `salto`, `combate`, `extra`, `total`) VALUES
(10, 0, 0, 0, 0, 0, 0),
(11, 0, 0, 0, 0, 0, 0),
(12, 0, 0, 0, 0, 0, 0),
(13, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `octubre`
--

CREATE TABLE `octubre` (
  `idAlumno` int(5) NOT NULL,
  `kichoPoomsae` int(3) NOT NULL,
  `destreza` int(3) NOT NULL,
  `salto` int(3) NOT NULL,
  `combate` int(3) NOT NULL,
  `extra` int(3) NOT NULL,
  `total` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `octubre`
--

INSERT INTO `octubre` (`idAlumno`, `kichoPoomsae`, `destreza`, `salto`, `combate`, `extra`, `total`) VALUES
(10, 5, 5, 5, 5, 0, 20),
(11, 0, 0, 0, 0, 0, 0),
(12, 10, 5, 10, 5, 0, 30),
(13, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporal`
--

CREATE TABLE `temporal` (
  `nom` text NOT NULL,
  `any` int(4) NOT NULL,
  `id` int(4) NOT NULL,
  `total` int(10) NOT NULL,
  `idProfesor` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abril`
--
ALTER TABLE `abril`
  ADD PRIMARY KEY (`idAlumno`);

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `diciembre`
--
ALTER TABLE `diciembre`
  ADD PRIMARY KEY (`idAlumno`);

--
-- Indices de la tabla `enero`
--
ALTER TABLE `enero`
  ADD PRIMARY KEY (`idAlumno`);

--
-- Indices de la tabla `febrero`
--
ALTER TABLE `febrero`
  ADD PRIMARY KEY (`idAlumno`);

--
-- Indices de la tabla `junio`
--
ALTER TABLE `junio`
  ADD PRIMARY KEY (`idAlumno`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`idProfesor`);

--
-- Indices de la tabla `marzo`
--
ALTER TABLE `marzo`
  ADD PRIMARY KEY (`idAlumno`);

--
-- Indices de la tabla `mayo`
--
ALTER TABLE `mayo`
  ADD PRIMARY KEY (`idAlumno`);

--
-- Indices de la tabla `noviembre`
--
ALTER TABLE `noviembre`
  ADD PRIMARY KEY (`idAlumno`);

--
-- Indices de la tabla `octubre`
--
ALTER TABLE `octubre`
  ADD PRIMARY KEY (`idAlumno`);

--
-- Indices de la tabla `temporal`
--
ALTER TABLE `temporal`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
