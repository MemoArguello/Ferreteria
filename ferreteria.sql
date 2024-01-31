-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-01-2024 a las 23:04:39
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `ferreteria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `id_auditoria` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `evento` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`id_auditoria`, `id_usuario`, `evento`, `fecha`) VALUES
(12, 7, 'Venta de Productos', '2024-01-30 14:44:25'),
(13, 7, 'Venta de Productos', '2024-01-30 17:08:52'),
(14, 7, 'Se editó una venta', '2024-01-31 23:04:56'),
(15, 7, 'Registro de Proveedor', '2024-01-31 23:13:06'),
(22, 7, 'Registro de Proveedor', '2024-01-31 23:18:30'),
(23, 7, 'Registro de Producto', '2024-01-31 23:32:18'),
(29, 7, 'Apertura de Caja', '2024-01-31 23:48:39'),
(40, 7, 'Clausura de Caja', '2024-01-31 23:57:11'),
(42, 7, 'Clausura de Caja', '2024-01-31 23:57:27'),
(46, 7, 'Apertura de Caja', '2024-02-01 00:01:21'),
(47, 7, 'Clausura de Caja', '2024-02-01 00:01:25'),
(48, 7, 'Se eliminó una Caja', '2024-02-01 00:01:28'),
(50, 7, 'Registro de Cliente', '2024-02-01 00:19:56'),
(51, 7, 'Registro de Cliente', '2024-02-01 00:21:05'),
(52, 7, 'Registro de Cliente', '2024-02-01 00:21:31'),
(53, 7, 'Registro de Cliente', '2024-02-01 00:22:17'),
(54, 7, 'Apertura de Caja', '2024-02-01 00:30:08'),
(55, 7, 'Registro de Producto', '2024-02-01 00:38:07'),
(56, 7, 'Registro de Proveedor', '2024-02-01 00:38:38'),
(57, 7, 'Registro de Proveedor', '2024-02-01 00:39:13'),
(58, 7, 'Registro de Proveedor', '2024-02-01 00:40:43'),
(59, 7, 'Registro de Producto', '2024-02-01 00:59:51'),
(60, 7, 'Registro de Producto', '2024-02-01 01:00:24'),
(61, 7, 'Registro de Producto', '2024-02-01 01:01:06'),
(62, 7, 'Registro de Producto', '2024-02-01 01:07:01'),
(63, 7, 'Registro de Producto', '2024-02-01 01:07:31'),
(64, 7, 'Registro de Cliente', '2024-02-01 01:18:31'),
(65, 7, 'Venta de Productos', '2024-01-31 21:48:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id_caja` int(11) NOT NULL,
  `fecha_apertura` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_cierre` datetime NOT NULL,
  `ingreso` float NOT NULL,
  `egreso` float NOT NULL,
  `saldo_cierre` float NOT NULL,
  `estado` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id_caja`, `fecha_apertura`, `fecha_cierre`, `ingreso`, `egreso`, `saldo_cierre`, `estado`) VALUES
(37, '2024-01-31 21:07:31', '0000-00-00 00:00:00', 0, 31000, 0, 'Abierto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id`, `descripcion`) VALUES
(1, 'Administrador/a'),
(2, 'Cajero/a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `descripcion`) VALUES
(7, 'Herramientas de Mano'),
(8, 'Escaleras'),
(9, 'Herramientas de Construccion'),
(13, 'Herramientas para construccion e instaladores'),
(19, 'Herramientas manuales para huerto y jardin'),
(29, 'Componentes diversos'),
(30, 'Productos de fijacion y sellado'),
(44, 'Alicates');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id_ciudad` int(11) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`id_ciudad`, `id_departamento`, `nombre`) VALUES
(1, 1, 'Asunción'),
(2, 17, 'Bahía Negra'),
(3, 17, 'Carmelo Peralta'),
(4, 17, 'Puerto Casado'),
(5, 17, 'Fuerte Olimpo'),
(6, 11, 'Ciudad del Este'),
(7, 11, 'Doctor Juan León Mallorquín'),
(8, 11, 'Doctor Raúl Peña'),
(9, 11, 'Domingo Martínez de Irala'),
(10, 11, 'Hernandarias'),
(11, 11, 'Iruña'),
(12, 11, 'Itakyry'),
(13, 11, 'Juan E. O´Leary'),
(14, 11, 'Los Cedrales'),
(15, 11, 'Mbaracayú'),
(16, 11, 'Minga Guazú'),
(17, 11, 'Minga Porá'),
(18, 11, 'Naranjal'),
(19, 11, 'Ñacunday'),
(20, 11, 'Presidente Franco'),
(21, 11, 'San Alberto'),
(22, 11, 'San Cristóbal'),
(23, 11, 'Santa Fe del Paraná'),
(24, 11, 'Santa Rita'),
(25, 11, 'Santa Rosa del Monday'),
(26, 11, 'Tavapy'),
(27, 11, 'Colonia Yguazú'),
(28, 13, 'Bella Vista Norte'),
(29, 13, 'Capitán Bado'),
(30, 13, 'Pedro Juan Caballero'),
(31, 13, 'Zanja Pytá'),
(32, 13, 'Karapaí'),
(33, 16, 'Filadelfia'),
(34, 16, 'Loma Plata'),
(35, 16, 'Mcal. Estigarribia'),
(36, 6, 'Caaguazú'),
(37, 6, 'Carayaó'),
(38, 6, 'Cnel. Oviedo'),
(39, 6, 'Doctor Cecilio Báez'),
(40, 6, 'J.E. Estigarribia'),
(41, 6, 'Campo 9'),
(42, 6, 'Doctor Juan Manuel Frutos'),
(43, 6, 'José Domingo Ocampos'),
(44, 6, 'La Pastora'),
(45, 6, 'Mcal. Francisco S. López'),
(46, 6, 'Nueva Londres'),
(47, 6, 'Nueva Toledo'),
(48, 6, 'Raúl Arsenio Oviedo'),
(49, 6, 'Repatriación'),
(50, 6, 'R. I. Tres Corrales'),
(51, 6, 'San Joaquín'),
(52, 6, 'San José de los Arroyos'),
(53, 6, 'Mbutuy'),
(54, 6, 'Simón Bolívar'),
(55, 6, 'Tembiaporá'),
(56, 6, 'Tres de Febrero'),
(57, 6, 'Vaquería'),
(58, 6, 'Yhú'),
(59, 7, '3 de Mayo'),
(60, 7, 'Abaí'),
(61, 7, 'Buena Vista'),
(62, 7, 'Caazapá'),
(63, 7, 'Doctor Moisés S. Bertoni'),
(64, 7, 'Fulgencio Yegros'),
(65, 7, 'General Higinio Morínigo'),
(66, 7, 'Maciel'),
(67, 7, 'San Juan Nepomuceno'),
(68, 7, 'Tavaí'),
(69, 7, 'Yuty'),
(70, 14, 'Colonia Anahí'),
(71, 14, 'Corpus Christi'),
(72, 14, 'Curuguaty'),
(73, 14, 'Gral. Francisco Caballero Álvarez'),
(74, 14, 'Itanará'),
(75, 14, 'Katueté'),
(76, 14, 'La Paloma'),
(77, 14, 'Maracaná'),
(78, 14, 'Nueva Esperanza'),
(79, 14, 'Salto del Guairá'),
(80, 14, 'Villa Ygatimí'),
(81, 14, 'Yasy Cañy'),
(82, 14, 'Ybyrarovaná'),
(83, 14, 'Ypejhú'),
(84, 14, 'Yby Pytá'),
(85, 1, 'Areguá'),
(86, 1, 'Capiatá'),
(87, 1, 'Fernando de la Mora'),
(88, 1, 'Guarambaré'),
(89, 1, 'Itá'),
(90, 1, 'Itauguá'),
(91, 1, 'J. Augusto Saldivar'),
(92, 1, 'Lambaré'),
(93, 1, 'Limpio'),
(94, 1, 'Luque'),
(95, 1, 'Mariano Roque Alonso'),
(96, 1, 'Ñemby'),
(97, 1, 'Nueva Italia'),
(98, 1, 'San Antonio'),
(99, 1, 'San Lorenzo'),
(100, 1, 'Villa Elisa'),
(101, 1, 'Villeta'),
(102, 1, 'Ypacaraí'),
(103, 1, 'Ypané'),
(104, 2, 'Arroyito'),
(105, 2, 'Azotey'),
(106, 2, 'Belén'),
(107, 2, 'Concepción'),
(108, 2, 'Horqueta'),
(109, 2, 'Loreto'),
(110, 2, 'San Carlos del Apa'),
(111, 2, 'San Lázaro'),
(112, 2, 'Yby Yaú'),
(113, 2, 'Sargento José Félix López'),
(114, 2, 'San Alfredo'),
(115, 2, 'Paso Barreto'),
(116, 4, 'Altos'),
(117, 4, 'Arroyos y Esteros'),
(118, 4, 'Atyrá'),
(119, 4, 'Caacupé'),
(120, 4, 'Caraguatay'),
(121, 4, 'Emboscada'),
(122, 4, 'Eusebio Ayala'),
(123, 4, 'Isla Pucú'),
(124, 4, 'Itacurubí'),
(125, 4, 'Juan de Mena'),
(126, 4, 'Loma Grande'),
(127, 4, 'Mbocayaty del Yhaguy'),
(128, 4, 'Nueva Colombia'),
(129, 4, 'Piribebuy'),
(130, 4, 'Primero de Marzo'),
(131, 4, 'San Bernardino'),
(132, 4, 'San José Obrero'),
(133, 4, 'Santa Elena'),
(134, 4, 'Tobatí'),
(135, 4, 'Valenzuela'),
(136, 5, 'Borja'),
(137, 5, 'Colonia Independencia'),
(138, 5, 'Coronel Martínez'),
(139, 5, 'Dr. Bottrell'),
(140, 5, 'Fassardi'),
(141, 5, 'Félix Pérez Cardozo'),
(142, 5, 'Garay'),
(143, 5, 'Itapé'),
(144, 5, 'Iturbe'),
(145, 5, 'Mbocayaty'),
(146, 5, 'Natalicio Talavera'),
(147, 5, 'Ñumí'),
(148, 5, 'Paso Yobái'),
(149, 5, 'San Salvador'),
(150, 5, 'Tebicuary'),
(151, 5, 'Troche'),
(152, 5, 'Villarrica'),
(153, 5, 'Yataity'),
(154, 8, 'Alto Verá'),
(155, 8, 'Bella Vista'),
(156, 8, 'Cambyretá'),
(157, 8, 'Capitán Meza'),
(158, 8, 'Capitán Miranda'),
(159, 8, 'Carlos Antonio López'),
(160, 8, 'Carmen del Paraná'),
(161, 8, 'Coronel Bogado'),
(162, 8, 'Edelira'),
(163, 8, 'Encarnación'),
(164, 8, 'Fram'),
(165, 8, 'General Artigas'),
(166, 8, 'General Delgado'),
(167, 8, 'Hohenau'),
(168, 8, 'Itapúa Poty'),
(169, 8, 'Jesús'),
(170, 8, 'Colonia La Paz'),
(171, 8, 'José Leandro Oviedo'),
(172, 8, 'Mayor Otaño'),
(173, 8, 'Natalio'),
(174, 8, 'Nueva Alborada'),
(175, 8, 'Obligado'),
(176, 8, 'Pirapó'),
(177, 8, 'San Cosme y Damián'),
(178, 8, 'San Juan del Paraná'),
(179, 8, 'San Pedro del Paraná'),
(180, 8, 'San Rafael del Paraná'),
(181, 8, 'Maria Auxiliadora'),
(182, 8, 'Trinidad'),
(183, 8, 'Yatytay'),
(184, 9, 'Ayolas'),
(185, 9, 'San Ignacio'),
(186, 9, 'San Juan Bautista'),
(187, 9, 'San Miguel'),
(188, 9, 'San Patricio'),
(189, 9, 'Santa María'),
(190, 9, 'Santa Rosa'),
(191, 9, 'Santiago'),
(192, 9, 'Villa Florida'),
(193, 9, 'Yabebyry'),
(194, 12, 'Alberdi'),
(195, 12, 'Cerrito'),
(196, 12, 'Desmochados'),
(197, 12, 'General José Eduvigis Díaz'),
(198, 12, 'Guazú Cuá'),
(199, 12, 'Humaitá'),
(200, 12, 'Isla Umbú'),
(201, 12, 'Laureles'),
(202, 12, 'Mayor José J. Martínez'),
(203, 12, 'Paso de Patria'),
(204, 12, 'Pilar'),
(205, 12, 'San Juan Bautista del Ñeembucú'),
(206, 12, 'Tacuaras'),
(207, 12, 'Villa Franca'),
(208, 12, 'Villalbín'),
(209, 12, 'Villa Oliva'),
(210, 10, 'Acahay'),
(211, 10, 'Caapucú'),
(212, 10, 'Carapeguá'),
(213, 10, 'Escobar'),
(214, 10, 'Gral. Bernardino Caballero'),
(215, 10, 'La Colmena'),
(216, 10, 'María Antonia'),
(217, 10, 'Mbuyapey'),
(218, 10, 'Paraguarí'),
(219, 10, 'Pirayú'),
(220, 10, 'Quiindy'),
(221, 10, 'Quyquyhó'),
(222, 10, 'San Roque González de Santa Cruz'),
(223, 10, 'Sapucai'),
(224, 10, 'Tebicuarymí'),
(225, 10, 'Yaguarón'),
(226, 10, 'Ybycuí'),
(227, 10, 'Ybytymí'),
(228, 15, 'Benjamín Aceval'),
(229, 15, 'Dr. José Falcón'),
(230, 15, 'General José María Bruguez'),
(231, 15, 'Nanawa'),
(232, 15, 'Colonia Paratodo'),
(233, 15, 'Pozo Colorado'),
(234, 15, 'Puerto Pinasco'),
(235, 15, 'Tte. Irala Fernández'),
(236, 15, 'Esteban Martínez'),
(237, 15, 'Villa Hayes'),
(238, 3, 'Antequera'),
(239, 3, 'Capiibary'),
(240, 3, 'Choré'),
(241, 3, 'General Elizardo Aquino'),
(242, 3, 'General Isidoro Resquín'),
(243, 3, 'Guayaibí'),
(244, 3, 'Itacurubí del Rosario'),
(245, 3, 'Liberación'),
(246, 3, 'Lima'),
(247, 3, 'Rio Verde'),
(248, 3, 'Nueva Germania'),
(249, 3, 'San Estanislao'),
(250, 3, 'San Pablo'),
(251, 3, 'Villa de San Pedro'),
(252, 3, 'San Vicente Pancholo'),
(253, 3, 'Santa Rosa del Aguaray'),
(254, 3, 'Tacuatí'),
(255, 3, 'Unión'),
(256, 3, '25 de Diciembre'),
(257, 3, 'Villa del Rosario'),
(258, 3, 'Yataity del Norte'),
(259, 3, 'Yrybucuá');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `cedula` text NOT NULL,
  `nombre` text NOT NULL,
  `ruc` text NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `id_ciudad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `cedula`, `nombre`, `ruc`, `id_departamento`, `id_ciudad`) VALUES
(27, '213213', 'Juan Lopez', ' 23213', 9, 185),
(28, '1234567', 'Leo Messi', '2132133', 9, 186),
(30, '213213', 'Mariana Lopez', '2313123', 8, 163),
(31, '21312312', 'Roberto Lopez', '123213123', 9, 188),
(32, '213213123', 'Maria Acosta', '123123', 9, 184),
(33, '23121312', 'Juan Acosta', '3423423', 9, 185);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_ferreteria`
--

CREATE TABLE `datos_ferreteria` (
  `id_datos` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `ciudad` int(11) NOT NULL,
  `departamento` text NOT NULL,
  `telefono` text NOT NULL,
  `correo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `datos_ferreteria`
--

INSERT INTO `datos_ferreteria` (`id_datos`, `nombre`, `ciudad`, `departamento`, `telefono`, `correo`) VALUES
(1, 'Ferreteria', 184, 'misiones', '21321312', 'prueba@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id_departamento` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `capital` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id_departamento`, `nombre`, `capital`) VALUES
(1, 'Central', 'Areguá'),
(2, 'Concepción', 'Concepción'),
(3, 'San Pedro', 'San Pedro de Ycuamandiyú'),
(4, 'Cordillera', 'Caacupé'),
(5, 'Guairá', 'Villarrica'),
(6, 'Caaguazú', 'Coronel Oviedo'),
(7, 'Caazapá', 'Caazapá'),
(8, 'Itapúa', 'Encarnación'),
(9, 'Misiones', 'San Juan Bautista'),
(10, 'Paraguarí', 'Paraguarí'),
(11, 'Alto Paraná', 'Ciudad del Este'),
(12, 'Ñeembucú', 'Pilar'),
(13, 'Amambay', 'Pedro Juan Caballero'),
(14, 'Canindeyú', 'Salto del Guairá'),
(15, 'Presidente Hayes', 'Villa Hayes'),
(16, 'Boquerón', 'Filadelfia'),
(17, 'Alto Paraguay', 'Fuerte Olimpo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `id_detalle` int(11) NOT NULL,
  `id_factura` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `costo_unitario` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `estado` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_factura`
--

INSERT INTO `detalle_factura` (`id_detalle`, `id_factura`, `id_producto`, `cantidad`, `costo_unitario`, `total`, `estado`) VALUES
(53, 75, 50, 3, '60000.00', '180000.00', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id_factura` int(11) NOT NULL,
  `codigo_factura` varchar(50) NOT NULL,
  `cliente` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id_factura`, `codigo_factura`, `cliente`, `tipo`, `fecha_creacion`) VALUES
(75, '234324', 30, 'Productos', '2024-02-01 01:48:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` text NOT NULL,
  `categoria` int(11) NOT NULL,
  `lote` text NOT NULL,
  `stock` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `precio_compra` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `categoria`, `lote`, `stock`, `precio`, `precio_compra`, `id_proveedor`) VALUES
(27, 'Destornillador Phillips', 7, 'L12312312', 40, 30000, 20000, 11),
(28, 'Llave ajustable', 44, 'L213213', 40, 45000, 31000, 12),
(29, 'Destornillador Phillips', 7, 'L12345', 100, 45000, 35000, 7),
(30, 'Martillo de garra', 7, 'L12346', 80, 60000, 48000, 11),
(31, 'Llave ajustable', 7, 'L12347', 120, 55000, 44000, 12),
(32, 'Cuchillo de uso general', 7, 'L12348', 90, 40000, 32000, 13),
(33, 'Alicate de punta fina', 7, 'L12349', 110, 50000, 40000, 7),
(34, 'Escalera de aluminio de 6 escalones', 8, 'L12350', 30, 80000, 64000, 11),
(35, 'Escalera extensible de 10 escalones', 8, 'L12351', 20, 120000, 96000, 12),
(36, 'Escalera de tijera de fibra de vidrio', 8, 'L12352', 25, 95000, 76000, 13),
(37, 'Escalera telescopica de aluminio', 8, 'L12353', 35, 70000, 56000, 7),
(38, 'Escalera articulada de 4x4 escalones', 8, 'L12354', 28, 110000, 88000, 11),
(39, 'Paleta de albañil', 9, 'L12355', 50, 35000, 28000, 12),
(40, 'Hormigonera electrica', 9, 'L12356', 8, 300000, 240000, 13),
(41, 'Pala de punta', 9, 'L12357', 45, 40000, 32000, 7),
(42, 'Carretilla de obra', 9, 'L12358', 20, 90000, 72000, 11),
(43, 'Cincel para concreto', 9, 'L12359', 55, 42000, 33600, 12),
(44, 'Nivel laser', 13, 'L12360', 15, 150000, 120000, 13),
(45, 'Sierra de azulejos', 13, 'L12361', 12, 110000, 88000, 7),
(46, 'Martillo demoledor', 13, 'L12362', 8, 180000, 144000, 11),
(47, 'Taladro percutor', 13, 'L12363', 18, 75000, 60000, 12),
(48, 'Atornillador inalambrico', 13, 'L12364', 20, 65000, 52000, 13),
(49, 'Podadora de ramas para jardin', 29, 'L1001', 50, 85000, 68000, 7),
(50, 'Pala para jardinero', 29, 'L1002', 30, 60000, 48000, 11),
(51, 'Cortasetos manual', 29, 'L1003', 40, 75000, 60000, 12),
(52, 'Rastrillo para jardin', 29, 'L1004', 25, 55000, 44000, 13),
(53, 'Tijeras de podar', 29, 'L1005', 35, 70000, 56000, 7),
(54, 'Conector electrico universal', 29, 'L2001', 100, 45000, 36000, 11),
(55, 'Adaptador de corriente', 29, 'L2002', 80, 55000, 44000, 12),
(56, 'Interruptor de luz', 29, 'L2003', 120, 40000, 32000, 13),
(57, 'Cable de conexion', 29, 'L2004', 90, 50000, 40000, 7),
(58, 'Fusible de seguridad', 29, 'L2005', 110, 48000, 38400, 11),
(59, 'Tornillo de acero inoxidable', 30, 'L3001', 200, 120000, 96000, 12),
(60, 'Adhesivo para madera', 30, 'L3002', 150, 95000, 76000, 13),
(61, 'Clavo de alta resistencia', 30, 'L3003', 180, 110000, 88000, 7),
(62, 'Cinta de doble cara', 30, 'L3004', 130, 80000, 64000, 11),
(63, 'Sellador de silicona', 30, 'L3005', 160, 90000, 72000, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_prov` text NOT NULL,
  `ruc` text NOT NULL,
  `telefono` text NOT NULL,
  `departamento` int(11) NOT NULL,
  `distrito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nombre_prov`, `ruc`, `telefono`, `departamento`, `distrito`) VALUES
(7, 'Paraguayans Products', '13123', '12313213', 1, 1),
(11, 'Pandolfo S.A', '21321321', '12345678', 9, 185),
(12, 'Importadora Boggiani S.A', '213123', '23123123', 8, 163),
(13, 'San Carlos Ferretería', '213213', '123123123', 11, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `usuario` varchar(250) NOT NULL,
  `codigo` varchar(250) NOT NULL,
  `id_cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `correo`, `usuario`, `codigo`, `id_cargo`) VALUES
(7, 'admin@gmail.com', 'Admin', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(10, 'prueba@gmail.com', 'cajero1', '827ccb0eea8a706c4c34a16891f84e7b', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id_auditoria`),
  ADD KEY `auditoria_usuario` (`id_usuario`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id_caja`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id_ciudad`),
  ADD KEY `id_departamento` (`id_departamento`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `departamento` (`id_departamento`,`id_ciudad`),
  ADD KEY `cliente_ciudad` (`id_ciudad`);

--
-- Indices de la tabla `datos_ferreteria`
--
ALTER TABLE `datos_ferreteria`
  ADD PRIMARY KEY (`id_datos`),
  ADD KEY `ciudad` (`ciudad`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id_departamento`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_factura` (`id_factura`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `cliente` (`cliente`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `categoria` (`categoria`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`),
  ADD KEY `departamento` (`departamento`),
  ADD KEY `distrito` (`distrito`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_cargo` (`id_cargo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id_auditoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id_caja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `datos_ferreteria`
--
ALTER TABLE `datos_ferreteria`
  MODIFY `id_datos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD CONSTRAINT `auditoria_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD CONSTRAINT `depa_ciudad` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id_departamento`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ciudad` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudades` (`id_ciudad`),
  ADD CONSTRAINT `cliente_depar` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id_departamento`);

--
-- Filtros para la tabla `datos_ferreteria`
--
ALTER TABLE `datos_ferreteria`
  ADD CONSTRAINT `ciudad_ferr` FOREIGN KEY (`ciudad`) REFERENCES `ciudades` (`id_ciudad`);

--
-- Filtros para la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `detalle_factura_ibfk_1` FOREIGN KEY (`id_factura`) REFERENCES `facturas` (`id_factura`),
  ADD CONSTRAINT `detalle_factura_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `categoria_producto` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `proveedor_produc` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`);

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `departamento_prov` FOREIGN KEY (`departamento`) REFERENCES `departamentos` (`id_departamento`),
  ADD CONSTRAINT `distrito_prov` FOREIGN KEY (`distrito`) REFERENCES `ciudades` (`id_ciudad`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuario_cargo` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;