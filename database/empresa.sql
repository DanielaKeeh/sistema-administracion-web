-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-01-2026 a las 22:52:31
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `empresa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `apellidos` varchar(128) NOT NULL,
  `correo` varchar(128) NOT NULL,
  `pass` varchar(32) DEFAULT NULL,
  `rol` int(1) NOT NULL,
  `archivo_nombre` varchar(255) DEFAULT NULL,
  `archivo_file` varchar(255) DEFAULT NULL,
  `ver detalle` int(11) DEFAULT NULL,
  `editar` int(11) DEFAULT NULL,
  `eliminar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `apellidos`, `correo`, `pass`, `rol`, `archivo_nombre`, `archivo_file`, `ver detalle`, `editar`, `eliminar`) VALUES
(1, 'Daniela ', 'Maldonado', 'Daniela@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, 'imagenMujer.jpg', '692d459f6c816_imagenMujer.jpg', NULL, NULL, NULL),
(2, 'Avir', 'Del Toro', 'Avir@gmail.com', '1bc2213a4bf306c4bd42403b6afd9ead', 2, 'ImagenHombre.jpg', '692d45ad84804_ImagenHombre.jpg', NULL, NULL, 0),
(3, 'Karol', 'Lopez', 'Karol@gmail.com', '25d55ad283aa400af464c76d713c07ad', 2, 'imagenMujer.jpg', '692d45b698d7a_imagenMujer.jpg', NULL, NULL, 0),
(4, 'Brian', 'Vazquez', 'Brian@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, 'ImagenHombre.jpg', '692d45bf9ddea_ImagenHombre.jpg', NULL, NULL, 0),
(5, 'Luis', 'Torres', 'Luis@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2, 'ImagenHombre.jpg', '692d45c622a24_ImagenHombre.jpg', NULL, NULL, 0),
(6, 'Adrian', 'Gomez', 'Adrian@gmail.com', 'e2fc714c4727ee9395f324cd2e7f331f', 2, 'ImagenHombre.jpg', '692d45a6690e4_ImagenHombre.jpg', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) DEFAULT NULL,
  `codigo` varchar(32) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `costo` double DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `archivo_nombre` varchar(255) DEFAULT NULL,
  `archivo_file` varchar(255) DEFAULT NULL,
  `ver detalle` varchar(255) DEFAULT NULL,
  `editar` varchar(255) DEFAULT NULL,
  `eliminar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `codigo`, `descripcion`, `costo`, `stock`, `archivo_nombre`, `archivo_file`, `ver detalle`, `editar`, `eliminar`) VALUES
(1, 'Strawberry Kit-Kat', '01', 'Nestlé Kit Kat Mini Barras de chocolate tipo oblea japonesas con sabor a fruta, fresa, 10 piezas - Tokyo Snack Land', 92, 50, 'KitKat.webp', '692d3baa0d863_KitKat.webp', NULL, NULL, NULL),
(2, 'Strawberry Pocky', '02', 'Pocky Galleta Japonesa Fresa 40gr.', 49, 50, 'pocky.webp', '692d3c5a367b9_pocky.webp', NULL, NULL, '0'),
(3, 'Strawberry  Mochi', '03', 'Mochi Ice Cream; Ripe Strawberry - 9.1 Oz Box', 150, 50, 'Mochi.webp', '692d3d0f323ed_Mochi.webp', NULL, NULL, '0'),
(4, 'PopinCookin', '04', 'Kracie Popin Cookin Candy Sweets Making Kit for Kids (Pack of 5)', 125, 50, 'PopinCooking.webp', '692d427381ff5_PopinCooking.webp', NULL, NULL, '0'),
(5, 'chocolate 2', '05', 'chocolate', 10, 100, '692d3baa0d863_KitKat.webp', '692db2c892027_692d3baa0d863_KitKat.webp', NULL, NULL, '0');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
