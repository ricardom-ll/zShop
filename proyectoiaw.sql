-- phpMyAdmin SQL Dump
-- version 5.2.1deb1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 17-01-2024 a las 22:26:44
-- Versión del servidor: 10.11.4-MariaDB-1~deb12u1
-- Versión de PHP: 8.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectoiaw`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `imagen`) VALUES
(1, 'T-shirts', 'imgcategorias/1.jpg'),
(2, 'Blouses', 'imgcategorias/2.jpg'),
(3, 'Dresses', 'imgcategorias/3.jpg'),
(4, 'Hoodies', 'imgcategorias/4.jpg'),
(5, 'Leggings', 'imgcategorias/5.jpg'),
(6, 'Sleepwear', 'imgcategorias/6.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indefinido`
--

CREATE TABLE `indefinido` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `texto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `indefinido`
--

INSERT INTO `indefinido` (`id`, `nombre`, `imagen`, `texto`) VALUES
(1, 'Travis Johnson', 'images/model.png', 'Massive Dynamic has over 10 years of experience in Design. We take pride in delivering Intelligent Designs and Engaging Experiences for clients all over the World. I thrive on problem solving and working with clients to seek out the best possible design solution.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `idcat` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `detalle` text NOT NULL,
  `precio` float NOT NULL,
  `fecalta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `idcat`, `nombre`, `detalle`, `precio`, `fecalta`) VALUES
(1, 1, 'Camisa', 'Camisa Nueva', 28, '2024-01-05'),
(2, 2, 'Blusa', 'Blusa nueva', 40.5, '2024-01-09'),
(3, 3, 'Vestido', 'Vestido nuevo', 99.99, '2024-01-09'),
(4, 4, 'Sudadera', 'Sudadera nueva', 32.2, '2024-01-09'),
(5, 5, 'Mallas', 'Mallas nuevas', 8, '2024-01-09'),
(6, 6, 'Pijama', 'Pijama nuevo', 12.4, '2024-01-09'),
(8, 1, 'Camiseta Nike', 'Camiseta Algodon Nike', 52.27, '2024-01-17'),
(9, 1, 'Camiseta Puma', 'Camiseta Puma', 33, '2024-01-17'),
(10, 2, 'Blusa Adidas', 'Blusa Adidas de lana', 22.22, '2024-01-17'),
(11, 3, 'Vestido Louis Vouitton', 'Vestido Rojo', 235.43, '2024-01-17'),
(12, 4, 'Sudadera  Adidas', 'Sudadera Adidas con capucha', 45.49, '2024-01-17'),
(13, 5, 'Mallas Kelme', 'Mallas Kelme negras', 12.5, '2024-01-17'),
(14, 6, 'Camison', 'Camison Negro', 38.25, '2024-01-17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `slides`
--

CREATE TABLE `slides` (
  `id` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `slides`
--

INSERT INTO `slides` (`id`, `nombre`, `imagen`) VALUES
(1, 'Chica', 'images/15.jpg'),
(2, 'Corbatas', 'images/16.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `login` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`login`, `password`, `imagen`, `nombre`) VALUES
('ricardo', 'd5f0127d48c67deef4d0bea33fe7159479103403', 'images/ricardo.jpg', 'Ricardo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `indefinido`
--
ALTER TABLE `indefinido`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcat` (`idcat`);

--
-- Indices de la tabla `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idcat`) REFERENCES `categorias` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
