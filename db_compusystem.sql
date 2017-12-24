-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-12-2017 a las 22:58:23
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_compusystem`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `idarticulo` int(11) NOT NULL,
  `idcategoria` int(11) NOT NULL,
  `codigo` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `stock_minimo` int(11) NOT NULL,
  `descripcion` varchar(512) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `imagen` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`idarticulo`, `idcategoria`, `codigo`, `nombre`, `stock`, `stock_minimo`, `descripcion`, `imagen`, `estado`) VALUES
(1, 2, '25486', 'Impresora Epson L120', 42, 30, 'Solo Impresola con tanque para recargar tinta', '2380464.jpg', 'Activo'),
(2, 1, '855545', 'Monitor HP Americano M1960', 52, 50, 'Monitores Clase A semi nuevas ', 'hp_1951g.jpg', 'Activo'),
(3, 2, '5345465', 'Impresora L575', 64, 15, 'Impresora multifuncional, para altos volúmenes de impresión, el sistema original de Tanque de Tinta de Epson, con capacidad para imprimir con calidad 7500 páginas a color o 4500 páginas en negro', 'b5z4Tlckdpqfbj9F.jpg', 'Activo'),
(4, 7, '21564', 'Scanner genius ColorPage Slim', 35, 10, 'Ideal para escanear fotos, armar álbumes digitales y utilizar para trabajos escolares o universitarios', 'slim1200_g.jpg', 'Activo'),
(5, 6, '846565', 'Disco duro sata aeagate hdd 1000GB', 158, 50, '', 'disco-duro-sata-seagate-hdd-.jpg', 'Activo'),
(6, 15, '825456', 'Memoria Ram 8 Kingston', 60, 50, '', 'ram.jpg', 'Activo'),
(7, 14, '859654', 'Procesador Intel I7 7MAG', 50, 15, '', '4.jpg', 'Activo'),
(8, 14, '859648', 'Procesador I3 7G', 218, 50, '', 'CP-INTEL-BX80677I37100-1.jpg', 'Activo'),
(9, 16, '98587', 'CASE Micro ATX', 140, 50, '', 'Micro-ATX-Caja-de-la-computadora-por.jpg', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(256) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre`, `descripcion`, `condicion`) VALUES
(1, 'Monitor', '', 1),
(2, 'Impresora', '', 1),
(3, 'Memoria', '', 1),
(4, 'Targeta Video', '', 1),
(5, 'Tarjeta Red', '', 1),
(6, 'Disco duro', 'Dispositivo de almacenamiento de datos', 1),
(7, 'Scanner', 'Se utiliza para introducir imágenes de papel, libros y digitalizarlos mediante la computadora', 1),
(8, 'Mouse', 'Utilizado para facilitar el manejo de un entorno gráfico', 1),
(9, 'Mouse', 'Utilizado para facilitar el manejo de un entorno gráfico', 0),
(10, 'Teclado', 'Es un dispositivo o periférico de entrada, en parte inspirado en el teclado de las máquinas de escribir', 1),
(11, 'Parlante', ' Dispositivo utilizado para la reproducción de sonido. Altavoz y pantalla acústica no son sinónimos', 1),
(12, 'Tarjeta madre', 'Tarjeta principal en la estructura interna del computador donde se encuentran los circuitos electrónicos,', 1),
(13, 'Lector DVD', 'Dispositivo o aparato electrónico utilizado para reproducir discos DVD y CD.', 1),
(14, 'Procesador ', '', 1),
(15, 'Memoria Ram', '', 1),
(16, 'CASE', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ingreso`
--

CREATE TABLE `detalle_ingreso` (
  `iddetalle_ingreso` int(11) NOT NULL,
  `idingreso` int(11) NOT NULL,
  `idarticulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_compra` decimal(11,2) NOT NULL,
  `precio_venta` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `detalle_ingreso`
--

INSERT INTO `detalle_ingreso` (`iddetalle_ingreso`, `idingreso`, `idarticulo`, `cantidad`, `precio_compra`, `precio_venta`) VALUES
(1, 1, 2, 2, '500.00', '600.00'),
(2, 1, 1, 10, '900.00', '1100.00'),
(3, 2, 3, 15, '1800.00', '2350.00'),
(4, 3, 4, 5, '480.00', '700.00'),
(5, 4, 5, 40, '250.00', '360.00'),
(6, 5, 9, 80, '290.00', '380.00'),
(8, 7, 8, 50, '1100.00', '1350.00'),
(9, 8, 6, 20, '230.00', '350.00'),
(10, 9, 6, 22, '290.00', '350.00');

--
-- Disparadores `detalle_ingreso`
--
DELIMITER $$
CREATE TRIGGER `tr_updStockIngreso` AFTER INSERT ON `detalle_ingreso` FOR EACH ROW BEGIN
	UPDATE articulo SET stock = stock + NEW.cantidad 
	WHERE articulo.idarticulo = NEW.idarticulo;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `iddetalle_venta` int(11) NOT NULL,
  `idventa` int(11) NOT NULL,
  `idarticulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` decimal(11,2) NOT NULL,
  `descuento` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`iddetalle_venta`, `idventa`, `idarticulo`, `cantidad`, `precio_venta`, `descuento`) VALUES
(1, 6, 2, 2, '600.00', '0.00'),
(2, 6, 1, 1, '1100.00', '0.00'),
(3, 7, 2, 1, '600.00', '0.00'),
(4, 8, 2, 1, '600.00', '0.00'),
(5, 9, 2, 1, '600.00', '0.00'),
(6, 10, 2, 1, '600.00', '0.00'),
(7, 11, 2, 1, '600.00', '0.00'),
(8, 12, 2, 2, '600.00', '0.00'),
(9, 13, 2, 1, '600.00', '0.00'),
(10, 14, 2, 1, '600.00', '0.00'),
(11, 15, 1, 3, '1100.00', '0.00'),
(12, 16, 2, 2, '600.00', '0.00'),
(13, 17, 2, 2, '600.00', '10.00'),
(14, 18, 1, 1, '1100.00', '0.00'),
(15, 19, 2, 1, '600.00', '0.00'),
(16, 20, 3, 1, '2350.00', '0.00'),
(17, 21, 5, 2, '360.00', '0.00'),
(18, 21, 8, 2, '1350.00', '0.00'),
(19, 22, 6, 2, '350.00', '0.00');

--
-- Disparadores `detalle_venta`
--
DELIMITER $$
CREATE TRIGGER `tr_updStockVenta` AFTER INSERT ON `detalle_venta` FOR EACH ROW BEGIN
	UPDATE articulo SET stock = stock - NEW.cantidad 
	WHERE articulo.idarticulo = NEW.idarticulo;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dosificacion`
--

CREATE TABLE `dosificacion` (
  `iddosificacion` int(11) NOT NULL,
  `nro_autorizacion` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `llave` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_limite_emision` date NOT NULL,
  `estado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `dosificacion`
--

INSERT INTO `dosificacion` (`iddosificacion`, `nro_autorizacion`, `llave`, `fecha_limite_emision`, `estado`) VALUES
(1, '7904006306693', 'zZ7Z]xssKqkEf_6K9uH(EcV+%x+u[Cca9T%+_$kiLjT8(zr3T9b5Fx2xG-D+_EBS', '2017-11-30', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `idempresa` int(11) NOT NULL,
  `iddosificacion` int(11) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `representante_legal` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `razon_social` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `actividad_economica` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `nit` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `imagen` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`idempresa`, `iddosificacion`, `nombre`, `representante_legal`, `razon_social`, `actividad_economica`, `nit`, `imagen`, `estado`) VALUES
(1, 1, 'CompuSystem', 'Eloy Juan Condori Lopez', 'Servicio', 'Compra y Venta', '4785647016', 'CompuSistem.png', 'Funcionamiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso`
--

CREATE TABLE `ingreso` (
  `idingreso` int(11) NOT NULL,
  `idproveedor` int(11) NOT NULL,
  `tipo_comprobante` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `serie_comprobante` varchar(7) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `num_comprobante` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `impuesto` decimal(4,2) NOT NULL,
  `estado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `ingreso`
--

INSERT INTO `ingreso` (`idingreso`, `idproveedor`, `tipo_comprobante`, `serie_comprobante`, `num_comprobante`, `fecha_hora`, `impuesto`, `estado`, `imagen`) VALUES
(1, 2, 'Factura', '0058585', '45859', '2017-11-14 17:36:50', '13.00', 'A', ''),
(2, 7, 'Factura', '064', '52458', '2017-11-21 11:13:33', '13.00', 'A', ''),
(3, 1, 'Factura', '568', '584464', '2017-11-21 11:14:33', '13.00', 'A', ''),
(4, 2, 'Factura', '254', '854', '2017-11-21 11:15:25', '13.00', 'A', ''),
(5, 8, 'Boleta', '', '569', '2017-11-21 11:38:29', '0.00', 'A', ''),
(7, 8, 'Recibo', '', '02156', '2017-11-21 11:46:12', '0.00', 'A', ''),
(8, 8, 'Recibo', '', '00584', '2017-11-21 11:48:00', '0.00', 'A', ''),
(9, 1, 'Factura', '02545', '025', '2017-12-21 17:57:13', '13.00', 'A', 'presentacion-de-recibo-de-pago-9-638.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idpersona` int(11) NOT NULL,
  `tipo_persona` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo_documento` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `num_documento` varchar(15) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `direccion` varchar(70) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idpersona`, `tipo_persona`, `nombre`, `tipo_documento`, `num_documento`, `direccion`, `telefono`, `email`) VALUES
(1, 'Proveedor', 'Maria Bustillos Cossio', 'NIT', '4588254016', 'Huyustus, Galería Ave María Local 7c. Comercio Nro. 1073 - La Paz,', '2463310', ''),
(2, 'Proveedor', 'Rodolgo Guzman Coarite', 'C.I.', '5442585', 'Calle Uyustus Nº 158 ', '2583205', 'rodolfinguzman@gmail.com'),
(3, 'Inactivo', 'ddddd', 'C.I.', '454245', 'ddddd', '23423445', ''),
(4, 'Cliente', 'Edgar Peralta', 'C.I.', '7452214', 'Z/ San martin', '74445258', 'gth@gmail.com'),
(5, 'Cliente', 'Edwin Ajahuanca Callisaya', 'NIT', '8599645016', 'Z/ Villa Adela', '60585596', 'edwiajahuanca@gmail.com'),
(6, 'Cliente', 'Wendy Conde Mendoza', 'NIT', '8995664018', 'Zona Tembladerani', '75214016', ''),
(7, 'Proveedor', 'Esteban Cosme ', 'NIT', '4485596015', 'Z/ Uyustus ', '2825978', 'estebancosme@gmail.com'),
(8, 'Proveedor', 'Cardozo Computadoras & Sistemas', 'C.I.', '5965417', 'Murillo, La Paz', '2315054', ''),
(9, 'Cliente', 'Rosario Perez Sosa', 'NIT', '4569855', 'z/ alto tejada ', '2859654', ''),
(10, 'Cliente', 'Denny Gonzalo Castillo', 'NIT', '7748552017', 'Z/ Villa adela', '', ''),
(11, 'Cliente', 'Marcelo Tintaya Quispe', 'C.I.', '6596485', 'Z/ Cementerio', '2859685', ''),
(12, 'Cliente', 'Jose Luis Lopez Perez', 'NIT', '6698787012', 'Z/ Satelite', '2569865', ''),
(13, 'Cliente', 'Daniel Mamani Conde', 'NIT', '5965485016', 'Z/ Ballivian', '', ''),
(14, 'Cliente', 'Pamela Mayta', 'C.I.', '8458596', 'Z/ Villa Dolores', '', ''),
(15, 'Cliente', 'Alejandro Velasquez Aguilar', 'NIT', '8596459011', 'Z/ Minero', '', ''),
(16, 'Cliente', 'Rene Quispe Mamani', 'NIT', '4585965014', 'Z/ Satelite', '', ''),
(17, 'Cliente', 'Jaime Salazar Mamani', 'NIT', '9658545018', 'Z/ Villa Dolores', '', ''),
(18, 'Cliente', 'Saul Fernando Mamani Perez', 'C.I.', '7748544', 'Z/ Los Andes', '', ''),
(19, 'Cliente', 'Javier Perez Lopez', 'NIT', '7784458017', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `idsucursal` int(11) NOT NULL,
  `idempresa` int(11) NOT NULL,
  `sucursal` varchar(120) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `departamento` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `celular` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`idsucursal`, `idempresa`, `sucursal`, `direccion`, `departamento`, `telefono`, `celular`, `estado`) VALUES
(1, 1, 'Casa Matriz', 'C/ Calatayd Ed/ Internacional N/ 1100', 'La Paz', '2592005', '772074858', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `idtipo_usuario` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`idtipo_usuario`, `nombre`, `estado`) VALUES
(1, 'Administrador', 1),
(2, 'Vendedor', 1),
(3, 'Almacenero', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `imagen` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ap_paterno` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ap_materno` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `genero` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `idtipo_usuario` int(11) NOT NULL,
  `estado` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ci` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `imagen`, `ap_paterno`, `ap_materno`, `fecha_nacimiento`, `genero`, `idtipo_usuario`, `estado`, `ci`) VALUES
(1, 'Raul ', 'raul.ricky90@gmail.com', '$2y$10$wcLBePxR2na/fK.2QrbVjOsVdM7O1ekYSG.Vw2HQrdG8LZJ/cteMu', 'LtB19ha353gV2aOs4IcvMEwqoafn9kLeghYq1XzECAfFyMNWorFZGMJQbFmi', '2017-11-08 21:18:31', '2017-12-21 21:30:48', 'raul.jpg', 'Condori', 'Lopez', '1990-12-10', 'Masculino', 1, 'Activo', '8449644'),
(3, 'Luis', 'luis.pad7@gmail.com', '$2y$10$aNkfXGczdX/sYxHfH2vZb.MrZyJA/xFkHiizaX7Sddl7SUQoaAEpe', NULL, '2016-10-25 00:37:20', '2016-10-25 00:37:20', '', '', '', '0000-00-00', '', 2, 'Activo', ''),
(4, 'Yhamir Valdez Ochi', 'yhamirvaldez@hotmail.com', '$2y$10$.fPW1qA7M96R8/UHl6nhbuTuDaEvpevw0HIWQChnvf.sWw.sM22GG', 'Doc72pVg4GMzimqM7ghKtJKukK2ciDpxXhTaKT7H0l8WoV04poZMtlhBcbuC', '2017-11-23 20:39:16', '2017-12-21 21:30:55', 'sheldon-enojado.jpg', '', '', '0000-00-00', '', 2, 'Activo', ''),
(5, 'Edwin', 'edwincon85@hotmail.com', '$2y$10$ErmKLvGrcqXhS.O4hlR1.eqvH7ulouDUrBjA/oQ40YwHkU9UkxVzy', NULL, NULL, '2017-11-24 01:04:15', '39996_103106086413464_7951698_n.jpg', 'Ajahuanca', 'Callisaya', '1989-01-20', 'Masculino', 3, 'Activo', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `idventa` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `idsucursal` int(11) NOT NULL,
  `tipo_comprobante` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `serie_comprobante` varchar(7) COLLATE utf8_spanish2_ci NOT NULL,
  `num_comprobante` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `impuesto` decimal(4,2) NOT NULL,
  `total_venta` decimal(11,2) NOT NULL,
  `estado` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `codigo_control` varchar(15) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `qr` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`idventa`, `idcliente`, `idsucursal`, `tipo_comprobante`, `serie_comprobante`, `num_comprobante`, `fecha_hora`, `impuesto`, `total_venta`, `estado`, `codigo_control`, `qr`) VALUES
(4, 4, 1, 'Factura', '0001', '0001', '2017-11-14 17:02:46', '13.00', '2200.00', 'A', NULL, NULL),
(5, 5, 1, 'Factura', '000002', '000002', '2017-11-15 14:51:06', '13.00', '2300.00', 'A', NULL, NULL),
(6, 5, 1, 'Factura', '000001', '000001', '2017-11-15 16:02:01', '13.00', '2300.00', 'A', NULL, NULL),
(7, 4, 1, 'FACTURA', '00003', '00003', '2017-11-18 17:56:11', '0.00', '600.00', 'A', '7B-F3-48-A8', NULL),
(8, 4, 1, 'FACTURA', '00004', '00004', '2017-11-18 18:02:20', '13.00', '600.00', 'A', '7B-F3-48-A8', NULL),
(9, 4, 1, 'FACTURA', '00005', '00005', '2017-11-18 18:06:15', '13.00', '600.00', 'A', NULL, NULL),
(10, 4, 1, 'FACTURA', '00005', '00005', '2017-11-18 18:08:46', '13.00', '600.00', 'A', NULL, NULL),
(11, 4, 1, 'FACTURA', '00005', '00005', '2017-11-18 18:11:05', '13.00', '600.00', 'A', NULL, NULL),
(12, 4, 1, 'FACTURA', '000008', '00000008', '2017-11-18 18:15:57', '13.00', '1200.00', 'A', NULL, NULL),
(13, 4, 1, 'FACTURA', '00006', '00006', '2017-11-18 18:17:21', '13.00', '600.00', 'A', 'C2-27-4D-FF-F2', NULL),
(14, 4, 1, 'FACTURA', '00007', '00007', '2017-11-18 19:26:23', '13.00', '600.00', 'A', '68-20-51-F0-2B', NULL),
(15, 5, 1, 'FACTURA', '00009', '00009', '2017-11-18 19:30:23', '13.00', '3300.00', 'A', 'E3-A9-85-CE', NULL),
(16, 5, 1, 'FACTURA', '00010', '00010', '2017-11-18 19:40:00', '13.00', '1200.00', 'A', 'AA-E6-10-89-96', NULL),
(17, 5, 1, 'FACTURA', '00011', '00011', '2017-11-19 13:28:27', '13.00', '1190.00', 'A', '56-B2-1F-FD-E5', 'qrcode'),
(18, 5, 1, 'FACTURA', '00012', '00012', '2017-11-19 13:33:52', '13.00', '1100.00', 'A', 'B6-B7-12-FA', 'qrcode1265007213'),
(19, 6, 1, 'FACTURA', '0001', '00001', '2017-11-20 21:35:57', '13.00', '600.00', 'A', '8D-47-6E-34-B5', 'qrcode174508421'),
(20, 13, 1, 'FACTURA', '00015', '00015', '2017-11-21 12:01:30', '13.00', '2350.00', 'A', 'E1-51-18-2B', 'qrcode1622340930'),
(21, 12, 1, 'FACTURA', '', '00016', '2017-11-21 12:06:25', '13.00', '3420.00', 'A', 'ED-02-1C-34-7E', 'qrcode468318446'),
(22, 10, 1, 'FACTURA', '', '21', '2017-12-21 17:35:24', '13.00', '700.00', 'A', 'EB-2D-48-EA-DC', 'qrcode253641905');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`idarticulo`),
  ADD KEY `fk_articulo_categoria_idx` (`idcategoria`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  ADD PRIMARY KEY (`iddetalle_ingreso`),
  ADD KEY `fk_detalle_ingreso_idx` (`idingreso`),
  ADD KEY `fk_detalle_ingreso_articulo_idx` (`idarticulo`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`iddetalle_venta`),
  ADD KEY `fk_detalle_venta_articulo_idx` (`idarticulo`),
  ADD KEY `fk_detalle_venta_idx` (`idventa`);

--
-- Indices de la tabla `dosificacion`
--
ALTER TABLE `dosificacion`
  ADD PRIMARY KEY (`iddosificacion`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`idempresa`),
  ADD KEY `iddosificacion` (`iddosificacion`);

--
-- Indices de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD PRIMARY KEY (`idingreso`),
  ADD KEY `fk_ingreso_persona_idx` (`idproveedor`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idpersona`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`idsucursal`),
  ADD KEY `idempresa` (`idempresa`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`idtipo_usuario`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `idtipo_usuario` (`idtipo_usuario`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idventa`),
  ADD KEY `fk_venta_cliente_idx` (`idcliente`),
  ADD KEY `idsucursal` (`idsucursal`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `idarticulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  MODIFY `iddetalle_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `iddetalle_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `dosificacion`
--
ALTER TABLE `dosificacion`
  MODIFY `iddosificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `idempresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  MODIFY `idingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idpersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `idsucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `idtipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD CONSTRAINT `fk_articulo_categoria` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_ingreso`
--
ALTER TABLE `detalle_ingreso`
  ADD CONSTRAINT `fk_detalle_ingreso` FOREIGN KEY (`idingreso`) REFERENCES `ingreso` (`idingreso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_ingreso_articulo` FOREIGN KEY (`idarticulo`) REFERENCES `articulo` (`idarticulo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `fk_detalle_venta` FOREIGN KEY (`idventa`) REFERENCES `venta` (`idventa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_venta_articulo` FOREIGN KEY (`idarticulo`) REFERENCES `articulo` (`idarticulo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `empresa_ibfk_1` FOREIGN KEY (`iddosificacion`) REFERENCES `dosificacion` (`iddosificacion`) ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD CONSTRAINT `fk_ingreso_persona` FOREIGN KEY (`idproveedor`) REFERENCES `persona` (`idpersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD CONSTRAINT `sucursal_ibfk_1` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`idempresa`) ON UPDATE NO ACTION;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`idtipo_usuario`) REFERENCES `tipo_usuario` (`idtipo_usuario`) ON UPDATE NO ACTION;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_cliente` FOREIGN KEY (`idcliente`) REFERENCES `persona` (`idpersona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`idsucursal`) REFERENCES `sucursal` (`idsucursal`) ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
