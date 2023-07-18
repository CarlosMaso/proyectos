-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 02-02-2023 a las 15:53:02
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
-- Base de datos: `tiendaOnline`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `dni` varchar(9) NOT NULL,
  `nombre` text NOT NULL,
  `apellidos` text NOT NULL,
  `edad` int(3) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(40) NOT NULL,
  `telefono` int(9) NOT NULL,
  `dirCliente` varchar(60) NOT NULL,
  `dirEntrega` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`dni`, `nombre`, `apellidos`, `edad`, `usuario`, `password`, `email`, `telefono`, `dirCliente`, `dirEntrega`) VALUES
('01346358F', 'Articuno', 'Zapdos ', 20, 'moltres', '$2y$10$0XAYtGMB1sBrbK6A0IDgPepKIPMdCSnJ34qaa.sWrbx4qyaCQWZ6O', 'fal@sete.com', 123456789, 'c/san san', 'c/moliners'),
('12345678A', 'admin', 'admin', 28, 'admin', '$2y$10$t6/6hioGt.2o7imbiA1k5.r8F9HISDIJ5XLw1.nYYKWH.6dRGJLpm', 'admin@admin.com', 123456789, 'c/san san núm17 1 piso', 'c/san san núm17 1 piso'),
('51590695Q', 'Carlos', 'Masó Merino', 29, 'masonator', '$2y$10$4b5HQTlXtSZootULUspw5uJu9a3B0p3NHjfs7rxPbG1DDZfrT8PbW', 'maso@carlos.com', 123456789, 'c/San san 32', 'aaaa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineasCarrito`
--

CREATE TABLE `lineasCarrito` (
  `idCarrito` varchar(10) NOT NULL,
  `idProd` int(10) NOT NULL,
  `cantidad` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lineasCarrito`
--

INSERT INTO `lineasCarrito` (`idCarrito`, `idProd`, `cantidad`) VALUES
('01346358F', 4, 1),
('1', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineasPedidos`
--

CREATE TABLE `lineasPedidos` (
  `idPedido` int(10) NOT NULL,
  `nlinea` int(10) NOT NULL,
  `idProducto` int(5) NOT NULL,
  `cantidad` int(5) NOT NULL,
  `precio` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lineasPedidos`
--

INSERT INTO `lineasPedidos` (`idPedido`, `nlinea`, `idProducto`, `cantidad`, `precio`) VALUES
(2, 0, 1, 1, 200),
(3, 0, 1, 1, 200),
(4, 0, 2, 1, 150),
(4, 1, 3, 1, 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(10) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `dniCliente` varchar(9) NOT NULL,
  `dirEntrega` varchar(50) NOT NULL,
  `totalCompra` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`idPedido`, `fecha`, `dniCliente`, `dirEntrega`, `totalCompra`) VALUES
(2, 'February 2, 2023, 3:15 pm', '51590695Q', 'C/Sansito', 200),
(3, 'February 2, 2023, 3:15 pm', '51590695Q', 'aaaa', 200),
(4, 'February 2, 2023, 3:42 pm', '51590695Q', 'aaaa', 250);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(5) NOT NULL,
  `nombre` varchar(35) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `precio` int(3) NOT NULL,
  `seccion` varchar(20) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `oferta` tinyint(1) NOT NULL,
  `masVendido` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `nombre`, `imagen`, `precio`, `seccion`, `descripcion`, `oferta`, `masVendido`) VALUES
(1, 'cámara canon', 'img/electronica/canon.jpg', 200, 'electronica', 'Cámara reflex canon, buena para hacer fotos y que esas fotos sean fotograficas', 0, 1),
(2, 'cámara nikon', 'img/electronica/nikon.jpg', 150, 'electronica', 'Cámara reflex nikon, nikonesta harás malas fotos', 0, 0),
(3, 'cámara lumix', 'img/electronica/lumix.jpg', 100, 'electronica', 'Cámara reflex lumix, el faro de luz de todo amante de la fotografia', 0, 0),
(4, 'monitor HP', 'img/electronica/monitorHP.jpg', 90, 'electronica', 'Monitor HP muchisimas pulgadas fullHD', 0, 0),
(5, 'monitor LG', 'img/electronica/monitorLG.jpg', 100, 'electronica', 'Monitor LG, 4k, se ve super guay', 0, 0),
(6, 'Iphone 14', 'img/electronica/iphone14.jpg', 60, 'electronica', 'Iphone 14, es bueno?... nose, es apple, compra! compra!', 0, 0),
(7, 'Samsung', 'img/electronica/samsung.jpg', 30, 'electronica', 'Está barato, hace lo que tiene que hacer, es un movil samsung', 0, 0),
(8, 'Xiaomi 12', 'img/electronica/xiaomi12.jpg', 45, 'electronica', 'Xiaomi mejor precio/calidad del mercado', 0, 1),
(9, 'smartwatch cuadrado', 'img/electronica/smartwatch1.jpg', 20, 'electronica', 'Si es tan listo, por que no se vende solo?', 0, 0),
(10, 'smartwatch hacendado', 'img/electronica/smartwatch2.jpg', 15, 'electronica', 'Es más barato, hace lo mismo que los otros', 0, 1),
(11, 'teclado gamer', 'img/electronica/tecladoGamer.jpg', 30, 'electronica', 'Tiene lucecitas, ergo es bueno', 0, 0),
(12, 'teclado normal', 'img/electronica/tecladoNormal.jpg', 25, 'electronica', 'No tiene lucecitas, pero sirve para hacer cosas de escribir', 0, 0),
(13, 'Muñeca Bratz', 'img/juguetes/bratz.jpg', 13, 'juguetes', 'Eres clonica o juegas diferente? Bratz!!', 0, 0),
(14, 'Casper', 'img/juguetes/casper.jpg', 15, 'juguetes', 'La mansión que todo niño quería tener', 0, 0),
(15, 'cocodrilo sacamuelas', 'img/juguetes/cocodrilo.jpg', 10, 'juguetes', 'No sufras más, te voy a curar, cocodrilo sacamuelas!!', 0, 0),
(16, 'Lego', 'img/juguetes/lego.jpg', 8, 'juguetes', 'Somos mejores que playmobil', 0, 1),
(17, 'Playmobil', 'img/juguetes/playmobil.jpg', 8, 'juguetes', 'Somos mejores que lego', 0, 0),
(18, 'Proyector Mickey', 'img/juguetes/proyector.jpg', 15, 'juguetes', 'Es disney, compra! compra!', 0, 0),
(19, 'Tamagochi', 'img/juguetes/tamagochi.jpg', 5, 'juguetes', 'Un grupo llamado Cariño tiene una canción sobre este', 1, 0),
(20, 'Terreneitor', 'img/juguetes/terreneitor.jpg', 15, 'juguetes', 'Puede ir por agua y tierra!!', 0, 0),
(21, 'Cartas Yugioh', 'img/juguetes/yugioh.jpg', 5, 'juguetes', 'Juego de cartas mitico, si invocas a exodia se acaba la partida', 0, 1),
(22, 'cafetera negra', 'img/cocina/cafetera1.jpg', 20, 'cocina', 'Hace cafe, va sin pilas', 0, 0),
(23, 'cafetera doble', 'img/cocina/cafetera2.jpg', 20, 'cocina', 'Hace cafe x2!!!', 0, 0),
(24, 'cafetera roja', 'img/cocina/cafetera3.jpg', 20, 'cocina', 'Hace cafe con un ligero sabor comunista', 0, 0),
(25, 'coctelera premium', 'img/cocina/coctelera1.jpg', 15, 'cocina', 'Para preprar cosas tan ricas como tu', 0, 0),
(26, 'coctelera hacendado', 'img/cocina/cafetera2.jpg', 10, 'cocina', 'Con un ligero gusto a metal, pero va bien', 0, 0),
(27, 'Kit coctel', 'img/cocina/coctelera3.jpg', 30, 'cocina', 'Seamos sinceros, la mitad de cosas no las vas a usar', 0, 0),
(28, 'Olla Eco', 'img/cocina/olla1.jpg', 15, 'cocina', 'Es de color verde, es eco', 0, 0),
(29, 'Olla roja', 'img/cocina/olla2.jpg', 20, 'cocina', 'Cuidado, que no se te vaya la olla!!', 1, 0),
(30, 'sartenes normales', 'img/cocina/sartenes1.jpg', 30, 'cocina', 'Muchas sartenes, para cocinar muchas cosas', 0, 0),
(31, 'sartenes verdes', 'img/cocina/sartenes2.jpg', 30, 'cocina', 'Sartenes verdes... ecologicas?', 0, 0),
(32, 'camiseta nintendo', 'img/ropa/camiseta1.jpg', 15, 'ropa', 'Para los más nintenderos!!', 0, 0),
(33, 'camiseta tortugas ninja', 'img/ropa/camiseta2.jpg', 15, 'ropa', 'Rafael, Michellangelo, Donatello y Leonardo', 1, 0),
(34, 'camiseta dragon ball', 'img/ropa/camiseta3.jpg', 15, 'ropa', 'Vamos a buscar las bolas de dragón!!', 0, 0),
(35, 'camiseta big bang theory', 'img/ropa/camiseta4.jpg', 15, 'ropa', 'Piedra, papel, tijeras, lagarto, spock!!', 0, 0),
(36, 'deportivas converse', 'img/ropa/converse.jpg', 10, 'ropa', 'Para conversar mejor!!', 0, 0),
(37, 'deportivas hacendado', 'img/ropa/deportivasHacendado.jpg', 8, 'ropa', 'Para caminar', 0, 0),
(38, 'deportivas Vans', 'img/ropa/vans.jpg', 15, 'ropa', 'Vans y vuelves', 0, 0),
(39, 'Pantalones vaqueros oscuros', 'img/ropa/pantalones1.jpg', 15, 'ropa', 'Bonitos, arregladitos, formales', 0, 0),
(40, 'Pantalones vaqueros claros', 'img/ropa/pantalones2.jpg', 15, 'ropa', 'Son claritos y chulos', 0, 0),
(41, 'Pantalones vaqueros campana', 'img/ropa/pantalones3.jpg', 15, 'ropa', 'Ding Dong!!', 1, 0),
(42, 'Antonio García', 'img/esclavismo/antonio.jpg', 700, 'esclavismo', 'Antonio es un crack de la programación, pero tiene un punto débil, las criptomonedas', 0, 0),
(43, 'Asunción López', 'img/esclavismo/asuncion.jpg', 800, 'esclavismo', 'Asun para las amigas, le gustan los remedios naturales, no tiene remedio', 0, 0),
(44, 'Carmen Pérez', 'img/esclavismo/carmen.jpg', 750, 'esclavismo', 'Se le da muy bien trabajar, pero no para de quejarse del gobierno', 0, 0),
(45, 'Jose Luis Sánchez', 'img/esclavismo/joseluis.jpg', 500, 'esclavismo', 'Sus amigos le llaman Horse Luis, no destaca en nada más', 1, 0),
(46, 'Manu Tención', 'img/esclavismo/manu.jpg', 700, 'esclavismo', 'Manu pierde el sueldo en el codede, a parte de eso, es majo', 0, 0),
(47, 'Olga González', 'img/esclavismo/olga.jpg', 900, 'esclavismo', 'Buenas ideas, trabajadora y bastante maja', 0, 0),
(48, 'Paula Martínez', 'img/esclavismo/paula.jpg', 750, 'esclavismo', 'Es influencer y alcoholica... no sabemos que cosa es peor', 0, 0),
(49, 'Roberto Rodrigez', 'img/esclavismo/roberto.jpg', 550, 'esclavismo', 'Es un pesado y se queja mucho, está en oferta por eso', 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
