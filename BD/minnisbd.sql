-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-10-2016 a las 01:17:16
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
-- Estructura de tabla para la tabla `combos`
--

CREATE TABLE `combos` (
  `id_Comb` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `precio` float(10,2) DEFAULT NULL,
  `Estado` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `combos`
--

INSERT INTO `combos` (`id_Comb`, `nombre`, `descripcion`, `precio`, `Estado`) VALUES
(1, 'Alitas y cerveza', '1 orden de alitas y 2 cervezas', 150.00, 'inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `facebook` varchar(50) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id`, `nombre`, `direccion`, `facebook`, `telefono`, `celular`) VALUES
(1, 'Erick Vargas', 'Avenida Tecnológico #1500, Col. Lomas de Santiaguito. Morelia, Mich.', 'https://www.facebook.com/soldadospimienta/', '(443) 2-33-43-28', '443-168-1705');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE `cuentas` (
  `id_Cue` int(11) NOT NULL,
  `Estatus` varchar(45) DEFAULT NULL,
  `NumMesa` varchar(45) DEFAULT NULL,
  `id_Em` int(11) DEFAULT NULL,
  `Total` float(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_Em` int(11) NOT NULL,
  `nickname` varchar(35) DEFAULT NULL,
  `Nombre` varchar(35) DEFAULT NULL,
  `Apellido` varchar(35) DEFAULT NULL,
  `Rol` varchar(25) DEFAULT NULL,
  `Contraseña` varchar(50) DEFAULT NULL,
  `Estado` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_Em`, `nickname`, `Nombre`, `Apellido`, `Rol`, `Contraseña`, `Estado`) VALUES
(1, 'eVargas', 'Erick', 'Vargas', 'Administrador', '7af2d10b73ab7cd8f603937f7697cb5fe432c7ff', 'activo'),
(2, 'dCornejo', 'Daniel', 'Cornejo', 'Barman', 'd06118bcb774f0f949513b7c2c9fcb459dfcd001', 'activo'),
(3, 'aCarrillo', 'Armando', 'Carrillo', 'Mesero', 'd690dc5b7be4979b4fc7d4911e9a87dda56820cd', 'inactivo'),
(17, 'aMartinez', 'Antonio', 'Martinez', 'eVargas', '7af2d10b73ab7cd8f603937f7697cb5fe432c7ff', 'inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_Inv` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `medida` varchar(45) DEFAULT NULL,
  `cantidad` int(5) DEFAULT NULL,
  `minimo` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_Inv`, `nombre`, `medida`, `cantidad`, `minimo`, `descripcion`, `status`) VALUES
(1, 'Alitas', 'pza', 100, 100, 'Alitas de pollo', 'inactivo'),
(2, 'Carne', 'grs.', 5000, 1000, 'Porción de carne', 'inactivo'),
(3, 'Carne', 'grs.', 100, 80, 'Porcion de carne ', 'inactivo'),
(4, 'Cerveza Corona', 'ml', 40, 20, 'Cerveza Corona 355ml', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id_Menu` int(11) NOT NULL,
  `id_Plat` int(11) DEFAULT NULL,
  `id_Prom` int(11) DEFAULT NULL,
  `id_Comb` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `id_Mesa` int(11) NOT NULL,
  `NumMesa` varchar(25) DEFAULT NULL,
  `Estatus` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

CREATE TABLE `orden` (
  `id_Ord` int(11) NOT NULL,
  `id_Cue` int(11) NOT NULL,
  `id_Menu` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `estado` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platillo`
--

CREATE TABLE `platillo` (
  `id_Plat` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `categoria` varchar(45) DEFAULT NULL,
  `precio` float(10,2) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `Estado` varchar(25) DEFAULT NULL,
  `url` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `platillo`
--

INSERT INTO `platillo` (`id_Plat`, `nombre`, `categoria`, `precio`, `descripcion`, `Estado`, `url`) VALUES
(1, 'Orden de alitas', 'Wings', 50.20, '5 pzas de alitas bañadas en salsa de mando', 'activo', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promos`
--

CREATE TABLE `promos` (
  `id_Promo` int(11) NOT NULL,
  `Nombre` varchar(25) NOT NULL,
  `Descripcion` varchar(50) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Precio` float(10,2) DEFAULT NULL,
  `Estado` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `promos`
--

INSERT INTO `promos` (`id_Promo`, `Nombre`, `Descripcion`, `Fecha`, `Precio`, `Estado`) VALUES
(1, '2x1 de Chela', '2x2 en toda la cerveza nacional', '2016-11-05', 50.00, 'inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `r_c_pl`
--

CREATE TABLE `r_c_pl` (
  `id_Comb` int(11) NOT NULL,
  `id_Plat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `r_pl_in`
--

CREATE TABLE `r_pl_in` (
  `id_Inv` int(11) NOT NULL,
  `id_Plat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `r_pr_pl`
--

CREATE TABLE `r_pr_pl` (
  `id_Prom` int(11) NOT NULL,
  `id_Plat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_Ven` int(11) NOT NULL,
  `id_Cue` int(11) NOT NULL,
  `Estado` varchar(25) DEFAULT NULL,
  `Fecha_Apertura` date DEFAULT NULL,
  `Fecha_Cierre` date DEFAULT NULL,
  `Total_Cierre` float(4,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `combos`
--
ALTER TABLE `combos`
  ADD PRIMARY KEY (`id_Comb`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`id_Cue`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_Em`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_Inv`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_Menu`);

--
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`id_Mesa`);

--
-- Indices de la tabla `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`id_Ord`,`id_Cue`,`id_Menu`);

--
-- Indices de la tabla `platillo`
--
ALTER TABLE `platillo`
  ADD PRIMARY KEY (`id_Plat`);

--
-- Indices de la tabla `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`id_Promo`);

--
-- Indices de la tabla `r_c_pl`
--
ALTER TABLE `r_c_pl`
  ADD PRIMARY KEY (`id_Comb`,`id_Plat`);

--
-- Indices de la tabla `r_pl_in`
--
ALTER TABLE `r_pl_in`
  ADD PRIMARY KEY (`id_Inv`,`id_Plat`);

--
-- Indices de la tabla `r_pr_pl`
--
ALTER TABLE `r_pr_pl`
  ADD PRIMARY KEY (`id_Prom`,`id_Plat`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_Ven`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `combos`
--
ALTER TABLE `combos`
  MODIFY `id_Comb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `id_Cue` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_Em` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_Inv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id_Menu` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mesa`
--
ALTER TABLE `mesa`
  MODIFY `id_Mesa` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `orden`
--
ALTER TABLE `orden`
  MODIFY `id_Ord` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `platillo`
--
ALTER TABLE `platillo`
  MODIFY `id_Plat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `promos`
--
ALTER TABLE `promos`
  MODIFY `id_Promo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_Ven` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
