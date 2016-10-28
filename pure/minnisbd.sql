-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2016 a las 05:21:57
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `minnisbd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidoP` varchar(50) NOT NULL,
  `apellidoM` varchar(50) NOT NULL,
  `roll` set('Administrador','Mesero','Barman','Cosinero') NOT NULL,
  `pass` varchar(50) NOT NULL,
  `status` set('activo','inactivo','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `apellidoP`, `apellidoM`, `roll`, `pass`, `status`) VALUES
(1, 'Armando', 'Carrillo', 'Peña', 'Cosinero', '123456', 'activo'),
(3, 'Francisco Daniel', 'Cornejo', '', 'Administrador', '123456', 'activo'),
(5, 'Maria Eliuth', 'López', 'Gaytan', 'Barman', '123456', 'activo'),
(7, 'Miguel Arturo', '', '', 'Mesero', '123456', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `producto` varchar(50) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `existencia` int(11) NOT NULL,
  `minimo` int(11) NOT NULL,
  `status` set('activo','inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `producto`, `descripcion`, `existencia`, `minimo`, `status`) VALUES
(1, 'Carne', 'Porción de carne de 150 gr.', 200, 50, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platillos`
--

CREATE TABLE `platillos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `categoria` set('Alitas','Hamburguesas','Aderezos','Salsas','Bebidas','Combos','Ensaladas') NOT NULL,
  `indredientes` varchar(50) NOT NULL,
  `precio` int(11) NOT NULL,
  `precioDescuento` int(11) NOT NULL,
  `descuento` set('Si','No') NOT NULL,
  `status` set('activo','inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `platillos`
--

INSERT INTO `platillos` (`id`, `nombre`, `descripcion`, `categoria`, `indredientes`, `precio`, `precioDescuento`, `descuento`, `status`) VALUES
(1, 'Hamburguesa Sencilla', 'Incluye:\r\n1 Porción de carne de 150 gr', 'Hamburguesas', '1', 49, 49, 'No', 'activo'),
(2, 'Hamburguesa Doble', 'Incluye:\r\n2 Porción de carne de 150 gr', '', '1', 80, 70, 'Si', 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `platillos`
--
ALTER TABLE `platillos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `platillos`
--
ALTER TABLE `platillos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
