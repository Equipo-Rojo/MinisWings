-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-11-2016 a las 16:48:57
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
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id` int(11) NOT NULL,
  `id_Emp` int(11) NOT NULL,
  `Fecha_Entrada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Fecha_Salida` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id`, `id_Emp`, `Fecha_Entrada`, `Fecha_Salida`) VALUES
(20, 1, '2016-11-01 18:38:42', '2016-11-01 18:38:45'),
(21, 2, '2016-11-01 18:38:50', '2016-11-01 18:39:27'),
(26, 1, '2016-11-02 15:42:49', '2016-11-02 15:48:54'),
(27, 3, '2016-11-02 15:43:20', '2016-11-02 15:45:20'),
(28, 2, '2016-11-02 15:44:12', '2016-11-02 15:45:14');

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
(1, 'Alitas y cerveza', '1 orden de alitas y 1 cervezas', 90.00, 'activo');

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
-- Estructura de tabla para la tabla `corte`
--

CREATE TABLE `corte` (
  `id_Cort` int(11) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Subtotal` float(100,2) NOT NULL,
  `Cortesias` float(100,2) NOT NULL,
  `Total` float(100,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `corte`
--

INSERT INTO `corte` (`id_Cort`, `Fecha`, `Subtotal`, `Cortesias`, `Total`) VALUES
(9, '2016-11-01 16:30:28', 170.00, 90.00, 80.00),
(10, '2016-11-01 16:36:00', 170.00, 90.00, 80.00);

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

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`id_Cue`, `Estatus`, `NumMesa`, `id_Em`, `Total`) VALUES
(1, 'Pagada', '1', 1, 30.00),
(2, 'Pagada', '2', 1, 50.00),
(3, 'Cortesia', '6', 1, 90.00),
(4, 'Abierta', '1', 2, NULL),
(5, 'Seleccionar...', '6', 2, NULL),
(6, 'Abierta', '2', 2, NULL);

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
  `Contraseña` varchar(100) DEFAULT NULL,
  `Estado` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_Em`, `nickname`, `Nombre`, `Apellido`, `Rol`, `Contraseña`, `Estado`) VALUES
(1, 'eVargas', 'Erick', 'Vargas', 'Administrador', '7af2d10b73ab7cd8f603937f7697cb5fe432c7ff', 'activo'),
(2, 'dCornejo', 'Daniel', 'Cornejo', 'Barman', 'd06118bcb774f0f949513b7c2c9fcb459dfcd001', 'activo'),
(3, 'aCarrillo', 'Armando', 'Carrillo', 'Mesero', 'd690dc5b7be4979b4fc7d4911e9a87dda56820cd', 'activo'),
(17, 'aMartinez', 'Antonio', 'Martinez', 'Cocinero', '34aeaebc66db027f02c2fd446dcdb8462af5d3c1', 'activo');

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
(1, 'Alitas', 'pza', 10, 100, 'Alitas de pollo', 'activo'),
(2, 'Carne', 'grs.', 5000, 1000, 'Porción de carne', 'inactivo'),
(3, 'Carne', 'grs.', 100, 80, 'Porcion de carne ', 'inactivo'),
(4, 'Cerveza Corona', 'ml', 40, 20, 'Cerveza Corona 355ml', 'inactivo'),
(5, 'Cerveza Victoria', 'ml.', 79, 50, 'Cerveza Victoria de vidrio 355ml.', 'activo');

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

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`id_Mesa`, `NumMesa`, `Estatus`) VALUES
(1, '1', 'Ocupada'),
(2, '2', 'Ocupada'),
(3, '3', 'Libre'),
(4, '4', 'Libre'),
(5, '5', 'Libre'),
(6, '6', 'Ocupada'),
(7, '8', 'Libre'),
(8, '7', 'Libre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

CREATE TABLE `orden` (
  `id_Ord` int(11) NOT NULL,
  `id_Cue` int(11) NOT NULL,
  `id_Menu` int(11) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `estado` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orden`
--

INSERT INTO `orden` (`id_Ord`, `id_Cue`, `id_Menu`, `tipo`, `cantidad`, `estado`) VALUES
(1, 1, 2, 'platillo', 1, 'Servido'),
(2, 3, 2, 'platillo', 3, 'Servido'),
(3, 2, 1, 'promos', 1, 'Servido'),
(4, 4, 2, 'platillo', 1, 'Cancelado'),
(5, 6, 2, 'platillo', 2, 'Listo'),
(6, 4, 1, 'promos', 1, 'Terminada'),
(7, 6, 1, 'combos', 1, 'Pedido');

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
(1, 'Orden de alitas', 'Wings', 50.20, '5 pzas de alitas bañadas en salsa de mando', 'inactivo', ''),
(2, 'Cerveza Victoria', 'Bebidas', 30.00, 'Cerveza Victoria de 355 ml.', 'activo', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promos`
--

CREATE TABLE `promos` (
  `id_Promo` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `Descripcion` varchar(50) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `precio` float(10,2) DEFAULT NULL,
  `Estado` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `promos`
--

INSERT INTO `promos` (`id_Promo`, `nombre`, `Descripcion`, `Fecha`, `precio`, `Estado`) VALUES
(1, 'Alitas y cerveza', '1 Orden de alitas con 2 cervezas', '2016-11-05', 50.00, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `r_c_pl`
--

CREATE TABLE `r_c_pl` (
  `id_Comb` int(11) NOT NULL,
  `id_Plat` int(11) NOT NULL,
  `cant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `r_c_pl`
--

INSERT INTO `r_c_pl` (`id_Comb`, `id_Plat`, `cant`) VALUES
(1, 1, 1),
(1, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `r_pl_in`
--

CREATE TABLE `r_pl_in` (
  `id_Inv` int(11) NOT NULL,
  `id_Plat` int(11) NOT NULL,
  `cant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `r_pl_in`
--

INSERT INTO `r_pl_in` (`id_Inv`, `id_Plat`, `cant`) VALUES
(1, 1, 5),
(5, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `r_pr_pl`
--

CREATE TABLE `r_pr_pl` (
  `id_Prom` int(11) NOT NULL,
  `id_Plat` int(11) NOT NULL,
  `cant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `r_pr_pl`
--

INSERT INTO `r_pr_pl` (`id_Prom`, `id_Plat`, `cant`) VALUES
(1, 1, 1),
(1, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_Ven` int(11) NOT NULL,
  `id_Cue` int(11) NOT NULL,
  `Estado` varchar(25) DEFAULT NULL,
  `Fecha_Apertura` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Fecha_Cierre` date DEFAULT NULL,
  `Total_Cierre` float(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_Ven`, `id_Cue`, `Estado`, `Fecha_Apertura`, `Fecha_Cierre`, `Total_Cierre`) VALUES
(1, 1, 'Cerrada', '2016-10-31 22:29:24', '2016-10-31', 30.00),
(2, 2, 'Cerrada', '2016-11-01 00:29:30', '2016-11-01', 50.00),
(3, 3, 'Cortesia', '2016-11-01 02:30:11', '2016-10-31', 90.00),
(4, 4, 'Abierta', '2016-11-01 16:53:11', NULL, NULL),
(5, 5, 'Abierta', '2016-11-01 16:53:41', NULL, NULL),
(6, 6, 'Abierta', '2016-11-01 16:53:59', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `corte`
--
ALTER TABLE `corte`
  ADD PRIMARY KEY (`id_Cort`);

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
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
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
-- AUTO_INCREMENT de la tabla `corte`
--
ALTER TABLE `corte`
  MODIFY `id_Cort` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `id_Cue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_Em` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_Inv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id_Menu` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mesa`
--
ALTER TABLE `mesa`
  MODIFY `id_Mesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `orden`
--
ALTER TABLE `orden`
  MODIFY `id_Ord` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `platillo`
--
ALTER TABLE `platillo`
  MODIFY `id_Plat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `promos`
--
ALTER TABLE `promos`
  MODIFY `id_Promo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_Ven` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
