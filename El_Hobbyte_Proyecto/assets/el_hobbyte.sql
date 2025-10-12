-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-10-2025 a las 13:00:01
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `el_hobbyte`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `casilla`
--

CREATE TABLE `casilla` (
  `id` int(11) NOT NULL,
  `id_partida` int(11) NOT NULL,
  `posicion` int(10) NOT NULL,
  `tipo_prueba` enum('magia','fuerza','habilidad') NOT NULL,
  `esfuerzo_necesario` int(11) NOT NULL CHECK (`esfuerzo_necesario` in (5,10,15,20,25,30,35,40,45,50)),
  `destapada` tinyint(1) NOT NULL DEFAULT 0,
  `resultado_prueba` enum('exito','fracaso') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `casilla`
--

INSERT INTO `casilla` (`id`, `id_partida`, `posicion`, `tipo_prueba`, `esfuerzo_necesario`, `destapada`, `resultado_prueba`) VALUES
(7, 15, 1, 'fuerza', 30, 0, NULL),
(8, 15, 2, 'fuerza', 15, 0, NULL),
(9, 15, 3, 'habilidad', 25, 0, NULL),
(10, 15, 4, 'magia', 5, 0, NULL),
(11, 15, 5, 'fuerza', 25, 1, 'fracaso'),
(12, 15, 6, 'habilidad', 50, 1, 'fracaso'),
(13, 15, 7, 'habilidad', 10, 1, 'fracaso'),
(14, 15, 8, 'habilidad', 20, 1, 'fracaso'),
(15, 15, 9, 'magia', 25, 0, NULL),
(16, 15, 10, 'habilidad', 5, 1, 'fracaso'),
(17, 15, 11, 'magia', 35, 1, 'fracaso'),
(18, 15, 12, 'magia', 40, 0, NULL),
(19, 15, 13, 'fuerza', 15, 0, NULL),
(20, 15, 14, 'magia', 15, 0, NULL),
(21, 15, 15, 'fuerza', 30, 0, NULL),
(22, 15, 16, 'magia', 50, 0, NULL),
(23, 15, 17, 'habilidad', 10, 0, NULL),
(24, 15, 18, 'habilidad', 20, 0, NULL),
(25, 15, 19, 'fuerza', 10, 0, NULL),
(26, 15, 20, 'magia', 45, 0, NULL),
(27, 16, 1, 'fuerza', 50, 1, 'fracaso'),
(28, 16, 2, 'habilidad', 20, 0, NULL),
(29, 16, 3, 'magia', 50, 1, 'fracaso'),
(30, 16, 4, 'fuerza', 10, 1, 'fracaso'),
(31, 16, 5, 'habilidad', 20, 1, 'fracaso'),
(32, 16, 6, 'magia', 15, 0, NULL),
(33, 16, 7, 'habilidad', 5, 1, 'fracaso'),
(34, 16, 8, 'habilidad', 40, 0, NULL),
(35, 16, 9, 'habilidad', 45, 0, NULL),
(36, 16, 10, 'magia', 30, 0, NULL),
(37, 16, 11, 'habilidad', 45, 0, NULL),
(38, 16, 12, 'magia', 40, 0, NULL),
(39, 16, 13, 'fuerza', 45, 0, NULL),
(40, 16, 14, 'habilidad', 40, 0, NULL),
(41, 16, 15, 'habilidad', 25, 0, NULL),
(42, 16, 16, 'habilidad', 10, 0, NULL),
(43, 16, 17, 'fuerza', 40, 0, NULL),
(44, 16, 18, 'habilidad', 25, 0, NULL),
(45, 16, 19, 'fuerza', 20, 0, NULL),
(46, 16, 20, 'habilidad', 45, 0, NULL),
(47, 17, 1, 'fuerza', 25, 1, 'fracaso'),
(48, 17, 2, 'magia', 25, 1, 'fracaso'),
(49, 17, 3, 'habilidad', 5, 1, 'fracaso'),
(50, 17, 4, 'habilidad', 30, 1, 'fracaso'),
(51, 17, 5, 'fuerza', 35, 0, NULL),
(52, 17, 6, 'magia', 10, 0, NULL),
(53, 17, 7, 'magia', 40, 0, NULL),
(54, 17, 8, 'fuerza', 10, 0, NULL),
(55, 17, 9, 'habilidad', 30, 0, NULL),
(56, 17, 10, 'habilidad', 15, 0, NULL),
(57, 17, 11, 'magia', 40, 0, NULL),
(58, 17, 12, 'habilidad', 5, 0, NULL),
(59, 17, 13, 'magia', 50, 0, NULL),
(60, 17, 14, 'habilidad', 25, 0, NULL),
(61, 17, 15, 'fuerza', 40, 0, NULL),
(62, 17, 16, 'magia', 25, 0, NULL),
(63, 17, 17, 'fuerza', 50, 0, NULL),
(64, 17, 18, 'fuerza', 35, 0, NULL),
(65, 17, 19, 'fuerza', 20, 0, NULL),
(66, 17, 20, 'habilidad', 10, 0, NULL),
(67, 18, 1, 'habilidad', 25, 1, 'fracaso'),
(68, 18, 2, 'magia', 5, 1, 'fracaso'),
(69, 18, 3, 'habilidad', 10, 1, 'fracaso'),
(70, 18, 4, 'magia', 50, 0, NULL),
(71, 18, 5, 'fuerza', 15, 1, 'fracaso'),
(72, 18, 6, 'fuerza', 40, 0, NULL),
(73, 18, 7, 'fuerza', 20, 1, 'exito'),
(74, 18, 8, 'magia', 35, 0, NULL),
(75, 18, 9, 'magia', 50, 0, NULL),
(76, 18, 10, 'habilidad', 40, 0, NULL),
(77, 18, 11, 'habilidad', 10, 0, NULL),
(78, 18, 12, 'fuerza', 25, 0, NULL),
(79, 18, 13, 'habilidad', 5, 0, NULL),
(80, 18, 14, 'habilidad', 45, 0, NULL),
(81, 18, 15, 'fuerza', 20, 0, NULL),
(82, 18, 16, 'magia', 10, 0, NULL),
(83, 18, 17, 'fuerza', 25, 0, NULL),
(84, 18, 18, 'magia', 30, 0, NULL),
(85, 18, 19, 'magia', 10, 0, NULL),
(86, 18, 20, 'fuerza', 50, 0, NULL),
(87, 19, 1, 'fuerza', 40, 1, 'exito'),
(88, 19, 2, 'habilidad', 30, 0, NULL),
(89, 19, 3, 'fuerza', 5, 0, NULL),
(90, 19, 4, 'habilidad', 40, 0, NULL),
(91, 19, 5, 'fuerza', 45, 0, NULL),
(92, 19, 6, 'habilidad', 15, 0, NULL),
(93, 19, 7, 'fuerza', 35, 0, NULL),
(94, 19, 8, 'fuerza', 35, 0, NULL),
(95, 19, 9, 'fuerza', 10, 0, NULL),
(96, 19, 10, 'magia', 35, 0, NULL),
(97, 19, 11, 'habilidad', 5, 0, NULL),
(98, 19, 12, 'habilidad', 30, 0, NULL),
(99, 19, 13, 'magia', 30, 0, NULL),
(100, 19, 14, 'magia', 30, 0, NULL),
(101, 19, 15, 'magia', 40, 0, NULL),
(102, 19, 16, 'magia', 40, 0, NULL),
(103, 19, 17, 'fuerza', 25, 0, NULL),
(104, 19, 18, 'habilidad', 10, 0, NULL),
(105, 19, 19, 'magia', 25, 0, NULL),
(106, 19, 20, 'magia', 50, 0, NULL),
(107, 20, 1, 'magia', 20, 1, 'exito'),
(108, 20, 2, 'magia', 45, 1, 'fracaso'),
(109, 20, 3, 'habilidad', 15, 0, NULL),
(110, 20, 4, 'habilidad', 25, 0, NULL),
(111, 20, 5, 'fuerza', 10, 0, NULL),
(112, 20, 6, 'habilidad', 35, 0, NULL),
(113, 20, 7, 'fuerza', 30, 0, NULL),
(114, 20, 8, 'magia', 20, 0, NULL),
(115, 20, 9, 'habilidad', 5, 0, NULL),
(116, 20, 10, 'fuerza', 25, 0, NULL),
(117, 20, 11, 'fuerza', 40, 0, NULL),
(118, 20, 12, 'magia', 10, 0, NULL),
(119, 20, 13, 'habilidad', 5, 0, NULL),
(120, 20, 14, 'habilidad', 40, 0, NULL),
(121, 20, 15, 'fuerza', 5, 0, NULL),
(122, 20, 16, 'magia', 40, 0, NULL),
(123, 20, 17, 'magia', 20, 0, NULL),
(124, 20, 18, 'fuerza', 45, 0, NULL),
(125, 20, 19, 'habilidad', 45, 0, NULL),
(126, 20, 20, 'fuerza', 35, 0, NULL),
(127, 21, 1, 'fuerza', 15, 0, NULL),
(128, 21, 2, 'magia', 40, 0, NULL),
(129, 21, 3, 'habilidad', 20, 0, NULL),
(130, 21, 4, 'habilidad', 15, 0, NULL),
(131, 21, 5, 'habilidad', 50, 1, 'exito'),
(132, 21, 6, 'habilidad', 35, 0, NULL),
(133, 21, 7, 'magia', 20, 0, NULL),
(134, 21, 8, 'fuerza', 35, 0, NULL),
(135, 21, 9, 'magia', 50, 0, NULL),
(136, 21, 10, 'magia', 5, 0, NULL),
(137, 21, 11, 'fuerza', 35, 0, NULL),
(138, 21, 12, 'magia', 40, 0, NULL),
(139, 21, 13, 'habilidad', 15, 0, NULL),
(140, 21, 14, 'magia', 15, 0, NULL),
(141, 21, 15, 'fuerza', 30, 0, NULL),
(142, 21, 16, 'habilidad', 45, 0, NULL),
(143, 21, 17, 'habilidad', 10, 0, NULL),
(144, 21, 18, 'magia', 25, 0, NULL),
(145, 21, 19, 'habilidad', 25, 0, NULL),
(146, 21, 20, 'habilidad', 25, 0, NULL),
(147, 22, 1, 'magia', 15, 1, 'exito'),
(148, 22, 2, 'habilidad', 15, 0, NULL),
(149, 22, 3, 'habilidad', 40, 0, NULL),
(150, 22, 4, 'magia', 15, 0, NULL),
(151, 22, 5, 'fuerza', 10, 0, NULL),
(152, 22, 6, 'fuerza', 25, 0, NULL),
(153, 22, 7, 'magia', 15, 0, NULL),
(154, 22, 8, 'habilidad', 25, 0, NULL),
(155, 22, 9, 'magia', 45, 0, NULL),
(156, 22, 10, 'fuerza', 50, 0, NULL),
(157, 22, 11, 'magia', 45, 0, NULL),
(158, 22, 12, 'habilidad', 15, 0, NULL),
(159, 22, 13, 'fuerza', 5, 0, NULL),
(160, 22, 14, 'fuerza', 30, 0, NULL),
(161, 22, 15, 'fuerza', 40, 0, NULL),
(162, 22, 16, 'magia', 50, 0, NULL),
(163, 22, 17, 'fuerza', 25, 0, NULL),
(164, 22, 18, 'fuerza', 40, 0, NULL),
(165, 22, 19, 'magia', 15, 0, NULL),
(166, 22, 20, 'habilidad', 15, 0, NULL),
(167, 23, 1, 'habilidad', 50, 1, 'fracaso'),
(168, 23, 2, 'fuerza', 15, 0, NULL),
(169, 23, 3, 'magia', 10, 0, NULL),
(170, 23, 4, 'magia', 50, 0, NULL),
(171, 23, 5, 'habilidad', 50, 0, NULL),
(172, 23, 6, 'fuerza', 15, 0, NULL),
(173, 23, 7, 'habilidad', 5, 0, NULL),
(174, 23, 8, 'magia', 40, 0, NULL),
(175, 23, 9, 'magia', 50, 0, NULL),
(176, 23, 10, 'habilidad', 45, 0, NULL),
(177, 23, 11, 'fuerza', 50, 0, NULL),
(178, 23, 12, 'fuerza', 40, 0, NULL),
(179, 23, 13, 'habilidad', 15, 0, NULL),
(180, 23, 14, 'magia', 15, 0, NULL),
(181, 23, 15, 'fuerza', 5, 0, NULL),
(182, 23, 16, 'habilidad', 20, 0, NULL),
(183, 23, 17, 'habilidad', 45, 0, NULL),
(184, 23, 18, 'fuerza', 30, 0, NULL),
(185, 23, 19, 'fuerza', 45, 0, NULL),
(186, 23, 20, 'magia', 20, 0, NULL),
(187, 24, 1, 'habilidad', 20, 1, 'exito'),
(188, 24, 2, 'fuerza', 50, 1, 'exito'),
(189, 24, 3, 'habilidad', 35, 1, 'exito'),
(190, 24, 4, 'magia', 15, 1, 'exito'),
(191, 24, 5, 'habilidad', 5, 1, 'fracaso'),
(192, 24, 6, 'habilidad', 50, 1, 'fracaso'),
(193, 24, 7, 'magia', 5, 1, 'exito'),
(194, 24, 8, 'fuerza', 20, 1, 'fracaso'),
(195, 24, 9, 'fuerza', 25, 1, 'fracaso'),
(196, 24, 10, 'magia', 25, 1, 'exito'),
(197, 24, 11, 'habilidad', 35, 0, NULL),
(198, 24, 12, 'fuerza', 15, 0, NULL),
(199, 24, 13, 'fuerza', 15, 0, NULL),
(200, 24, 14, 'magia', 5, 0, NULL),
(201, 24, 15, 'magia', 35, 0, NULL),
(202, 24, 16, 'fuerza', 45, 0, NULL),
(203, 24, 17, 'fuerza', 10, 0, NULL),
(204, 24, 18, 'habilidad', 10, 0, NULL),
(205, 24, 19, 'habilidad', 10, 0, NULL),
(206, 24, 20, 'magia', 35, 0, NULL),
(207, 25, 1, 'magia', 20, 0, NULL),
(208, 25, 2, 'habilidad', 45, 0, NULL),
(209, 25, 3, 'magia', 25, 0, NULL),
(210, 25, 4, 'habilidad', 15, 0, NULL),
(211, 25, 5, 'magia', 40, 0, NULL),
(212, 25, 6, 'fuerza', 25, 0, NULL),
(213, 25, 7, 'magia', 40, 0, NULL),
(214, 25, 8, 'habilidad', 10, 0, NULL),
(215, 25, 9, 'fuerza', 25, 0, NULL),
(216, 25, 10, 'magia', 35, 0, NULL),
(217, 25, 11, 'fuerza', 10, 0, NULL),
(218, 25, 12, 'magia', 25, 0, NULL),
(219, 25, 13, 'fuerza', 45, 0, NULL),
(220, 25, 14, 'habilidad', 50, 0, NULL),
(221, 25, 15, 'magia', 50, 0, NULL),
(222, 25, 16, 'magia', 35, 0, NULL),
(223, 25, 17, 'habilidad', 10, 0, NULL),
(224, 25, 18, 'fuerza', 50, 0, NULL),
(225, 25, 19, 'habilidad', 45, 0, NULL),
(226, 25, 20, 'magia', 35, 0, NULL),
(227, 26, 1, 'fuerza', 5, 1, 'exito'),
(228, 26, 2, 'fuerza', 45, 1, 'exito'),
(229, 26, 3, 'habilidad', 40, 1, 'exito'),
(230, 26, 4, 'habilidad', 30, 1, 'exito'),
(231, 26, 5, 'fuerza', 35, 1, 'fracaso'),
(232, 26, 6, 'habilidad', 45, 1, 'fracaso'),
(233, 26, 7, 'magia', 50, 1, 'fracaso'),
(234, 26, 8, 'magia', 20, 0, NULL),
(235, 26, 9, 'habilidad', 50, 0, NULL),
(236, 26, 10, 'fuerza', 35, 0, NULL),
(237, 26, 11, 'magia', 15, 0, NULL),
(238, 26, 12, 'habilidad', 20, 0, NULL),
(239, 26, 13, 'fuerza', 40, 0, NULL),
(240, 26, 14, 'habilidad', 30, 0, NULL),
(241, 26, 15, 'magia', 45, 0, NULL),
(242, 26, 16, 'magia', 30, 0, NULL),
(243, 26, 17, 'habilidad', 10, 0, NULL),
(244, 26, 18, 'fuerza', 5, 0, NULL),
(245, 26, 19, 'magia', 25, 0, NULL),
(246, 26, 20, 'fuerza', 10, 0, NULL),
(247, 27, 1, 'habilidad', 35, 1, 'exito'),
(248, 27, 2, 'fuerza', 25, 1, 'exito'),
(249, 27, 3, 'magia', 40, 1, 'exito'),
(250, 27, 4, 'habilidad', 35, 1, 'exito'),
(251, 27, 5, 'habilidad', 20, 1, 'fracaso'),
(252, 27, 6, 'magia', 45, 1, 'fracaso'),
(253, 27, 7, 'magia', 20, 1, 'fracaso'),
(254, 27, 8, 'fuerza', 20, 1, 'exito'),
(255, 27, 9, 'magia', 50, 1, 'fracaso'),
(256, 27, 10, 'magia', 30, 1, 'fracaso'),
(257, 27, 11, 'magia', 25, 0, NULL),
(258, 27, 12, 'magia', 10, 0, NULL),
(259, 27, 13, 'fuerza', 30, 0, NULL),
(260, 27, 14, 'habilidad', 15, 0, NULL),
(261, 27, 15, 'magia', 45, 0, NULL),
(262, 27, 16, 'magia', 30, 0, NULL),
(263, 27, 17, 'fuerza', 35, 0, NULL),
(264, 27, 18, 'habilidad', 20, 0, NULL),
(265, 27, 19, 'magia', 30, 0, NULL),
(266, 27, 20, 'fuerza', 30, 0, NULL),
(267, 28, 1, 'habilidad', 30, 1, 'exito'),
(268, 28, 2, 'habilidad', 10, 0, NULL),
(269, 28, 3, 'magia', 40, 0, NULL),
(270, 28, 4, 'habilidad', 5, 0, NULL),
(271, 28, 5, 'habilidad', 25, 0, NULL),
(272, 28, 6, 'fuerza', 35, 0, NULL),
(273, 28, 7, 'magia', 25, 0, NULL),
(274, 28, 8, 'habilidad', 35, 0, NULL),
(275, 28, 9, 'magia', 5, 0, NULL),
(276, 28, 10, 'magia', 20, 0, NULL),
(277, 28, 11, 'magia', 15, 0, NULL),
(278, 28, 12, 'magia', 40, 0, NULL),
(279, 28, 13, 'magia', 40, 0, NULL),
(280, 28, 14, 'magia', 40, 0, NULL),
(281, 28, 15, 'habilidad', 35, 0, NULL),
(282, 28, 16, 'magia', 20, 0, NULL),
(283, 28, 17, 'habilidad', 40, 0, NULL),
(284, 28, 18, 'fuerza', 25, 0, NULL),
(285, 28, 19, 'habilidad', 40, 0, NULL),
(286, 28, 20, 'habilidad', 45, 0, NULL),
(287, 29, 1, 'fuerza', 15, 1, 'fracaso'),
(288, 29, 2, 'habilidad', 15, 1, 'exito'),
(289, 29, 3, 'habilidad', 45, 1, 'exito'),
(290, 29, 4, 'fuerza', 40, 0, NULL),
(291, 29, 5, 'fuerza', 50, 0, NULL),
(292, 29, 6, 'fuerza', 10, 0, NULL),
(293, 29, 7, 'fuerza', 15, 0, NULL),
(294, 29, 8, 'habilidad', 5, 0, NULL),
(295, 29, 9, 'magia', 15, 0, NULL),
(296, 29, 10, 'habilidad', 25, 0, NULL),
(297, 29, 11, 'habilidad', 25, 0, NULL),
(298, 29, 12, 'fuerza', 40, 0, NULL),
(299, 29, 13, 'habilidad', 20, 0, NULL),
(300, 29, 14, 'magia', 10, 0, NULL),
(301, 29, 15, 'magia', 25, 0, NULL),
(302, 29, 16, 'magia', 10, 0, NULL),
(303, 29, 17, 'magia', 45, 0, NULL),
(304, 29, 18, 'fuerza', 25, 0, NULL),
(305, 29, 19, 'magia', 25, 0, NULL),
(306, 29, 20, 'habilidad', 5, 0, NULL),
(307, 30, 1, 'magia', 40, 1, 'fracaso'),
(308, 30, 2, 'habilidad', 45, 1, 'exito'),
(309, 30, 3, 'fuerza', 30, 1, 'fracaso'),
(310, 30, 4, 'habilidad', 35, 1, 'fracaso'),
(311, 30, 5, 'fuerza', 35, 0, NULL),
(312, 30, 6, 'habilidad', 40, 0, NULL),
(313, 30, 7, 'fuerza', 15, 0, NULL),
(314, 30, 8, 'habilidad', 50, 0, NULL),
(315, 30, 9, 'fuerza', 45, 0, NULL),
(316, 30, 10, 'habilidad', 45, 0, NULL),
(317, 30, 11, 'magia', 40, 0, NULL),
(318, 30, 12, 'habilidad', 20, 0, NULL),
(319, 30, 13, 'fuerza', 20, 0, NULL),
(320, 30, 14, 'magia', 50, 0, NULL),
(321, 30, 15, 'fuerza', 20, 0, NULL),
(322, 30, 16, 'habilidad', 30, 0, NULL),
(323, 30, 17, 'magia', 15, 0, NULL),
(324, 30, 18, 'magia', 20, 0, NULL),
(325, 30, 19, 'fuerza', 10, 0, NULL),
(326, 30, 20, 'magia', 15, 0, NULL),
(327, 31, 1, 'habilidad', 5, 1, 'exito'),
(328, 31, 2, 'habilidad', 10, 1, 'exito'),
(329, 31, 3, 'habilidad', 40, 1, 'fracaso'),
(330, 31, 4, 'fuerza', 50, 0, NULL),
(331, 31, 5, 'fuerza', 15, 0, NULL),
(332, 31, 6, 'fuerza', 30, 0, NULL),
(333, 31, 7, 'habilidad', 25, 0, NULL),
(334, 31, 8, 'magia', 20, 0, NULL),
(335, 31, 9, 'magia', 15, 0, NULL),
(336, 31, 10, 'fuerza', 10, 0, NULL),
(337, 31, 11, 'fuerza', 5, 0, NULL),
(338, 31, 12, 'habilidad', 30, 0, NULL),
(339, 31, 13, 'habilidad', 5, 0, NULL),
(340, 31, 14, 'magia', 35, 0, NULL),
(341, 31, 15, 'habilidad', 20, 0, NULL),
(342, 31, 16, 'magia', 20, 0, NULL),
(343, 31, 17, 'habilidad', 5, 0, NULL),
(344, 31, 18, 'fuerza', 10, 0, NULL),
(345, 31, 19, 'fuerza', 10, 0, NULL),
(346, 31, 20, 'habilidad', 20, 0, NULL),
(347, 32, 1, 'fuerza', 25, 0, NULL),
(348, 32, 2, 'habilidad', 40, 0, NULL),
(349, 32, 3, 'fuerza', 40, 0, NULL),
(350, 32, 4, 'habilidad', 10, 0, NULL),
(351, 32, 5, 'magia', 20, 0, NULL),
(352, 32, 6, 'fuerza', 50, 0, NULL),
(353, 32, 7, 'habilidad', 40, 0, NULL),
(354, 32, 8, 'habilidad', 35, 0, NULL),
(355, 32, 9, 'habilidad', 10, 0, NULL),
(356, 32, 10, 'magia', 50, 0, NULL),
(357, 32, 11, 'magia', 45, 0, NULL),
(358, 32, 12, 'habilidad', 30, 0, NULL),
(359, 32, 13, 'habilidad', 35, 0, NULL),
(360, 32, 14, 'magia', 30, 0, NULL),
(361, 32, 15, 'fuerza', 35, 0, NULL),
(362, 32, 16, 'fuerza', 45, 0, NULL),
(363, 32, 17, 'fuerza', 40, 0, NULL),
(364, 32, 18, 'habilidad', 35, 0, NULL),
(365, 32, 19, 'magia', 30, 0, NULL),
(366, 32, 20, 'fuerza', 20, 0, NULL),
(367, 33, 1, 'magia', 50, 0, NULL),
(368, 33, 2, 'fuerza', 45, 0, NULL),
(369, 33, 3, 'magia', 35, 0, NULL),
(370, 33, 4, 'habilidad', 50, 0, NULL),
(371, 33, 5, 'habilidad', 40, 0, NULL),
(372, 33, 6, 'magia', 30, 0, NULL),
(373, 33, 7, 'fuerza', 10, 0, NULL),
(374, 33, 8, 'habilidad', 50, 0, NULL),
(375, 33, 9, 'fuerza', 45, 0, NULL),
(376, 33, 10, 'magia', 35, 0, NULL),
(377, 33, 11, 'fuerza', 25, 0, NULL),
(378, 33, 12, 'fuerza', 45, 0, NULL),
(379, 33, 13, 'fuerza', 40, 0, NULL),
(380, 33, 14, 'magia', 10, 0, NULL),
(381, 33, 15, 'fuerza', 30, 0, NULL),
(382, 33, 16, 'fuerza', 50, 0, NULL),
(383, 33, 17, 'magia', 40, 0, NULL),
(384, 33, 18, 'fuerza', 50, 0, NULL),
(385, 33, 19, 'fuerza', 50, 0, NULL),
(386, 33, 20, 'fuerza', 30, 0, NULL),
(387, 37, 1, 'habilidad', 50, 0, NULL),
(388, 37, 2, 'magia', 25, 0, NULL),
(389, 37, 3, 'fuerza', 35, 0, NULL),
(390, 37, 4, 'magia', 10, 0, NULL),
(391, 37, 5, 'habilidad', 15, 0, NULL),
(392, 37, 6, 'habilidad', 30, 0, NULL),
(393, 37, 7, 'magia', 40, 0, NULL),
(394, 37, 8, 'magia', 5, 0, NULL),
(395, 37, 9, 'habilidad', 40, 0, NULL),
(396, 37, 10, 'fuerza', 25, 0, NULL),
(397, 37, 11, 'magia', 50, 0, NULL),
(398, 37, 12, 'fuerza', 50, 0, NULL),
(399, 37, 13, 'fuerza', 25, 0, NULL),
(400, 37, 14, 'fuerza', 20, 0, NULL),
(401, 37, 15, 'habilidad', 5, 0, NULL),
(402, 37, 16, 'magia', 5, 0, NULL),
(403, 37, 17, 'habilidad', 15, 0, NULL),
(404, 37, 18, 'habilidad', 45, 0, NULL),
(405, 37, 19, 'magia', 20, 0, NULL),
(406, 37, 20, 'magia', 25, 0, NULL),
(407, 38, 1, 'fuerza', 50, 1, 'fracaso'),
(408, 38, 2, 'magia', 5, 0, NULL),
(409, 38, 3, 'magia', 5, 0, NULL),
(410, 38, 4, 'habilidad', 20, 0, NULL),
(411, 38, 5, 'magia', 30, 0, NULL),
(412, 38, 6, 'habilidad', 45, 0, NULL),
(413, 38, 7, 'magia', 45, 0, NULL),
(414, 38, 8, 'fuerza', 20, 0, NULL),
(415, 38, 9, 'habilidad', 35, 0, NULL),
(416, 38, 10, 'magia', 50, 0, NULL),
(417, 38, 11, 'magia', 10, 0, NULL),
(418, 38, 12, 'magia', 35, 0, NULL),
(419, 38, 13, 'habilidad', 20, 0, NULL),
(420, 38, 14, 'magia', 25, 0, NULL),
(421, 38, 15, 'fuerza', 50, 0, NULL),
(422, 38, 16, 'habilidad', 20, 0, NULL),
(423, 38, 17, 'habilidad', 45, 0, NULL),
(424, 38, 18, 'magia', 50, 0, NULL),
(425, 38, 19, 'fuerza', 45, 0, NULL),
(426, 38, 20, 'magia', 45, 0, NULL),
(427, 39, 1, 'magia', 5, 1, 'exito'),
(428, 39, 2, 'habilidad', 20, 1, 'exito'),
(429, 39, 3, 'fuerza', 30, 1, 'exito'),
(430, 39, 4, 'magia', 50, 1, 'fracaso'),
(431, 39, 5, 'habilidad', 30, 1, 'fracaso'),
(432, 39, 6, 'habilidad', 40, 1, 'fracaso'),
(433, 39, 7, 'magia', 45, 1, 'fracaso'),
(434, 39, 8, 'habilidad', 40, 1, 'fracaso'),
(435, 39, 9, 'habilidad', 40, 0, NULL),
(436, 39, 10, 'habilidad', 15, 0, NULL),
(437, 39, 11, 'habilidad', 40, 0, NULL),
(438, 39, 12, 'magia', 40, 0, NULL),
(439, 39, 13, 'habilidad', 35, 0, NULL),
(440, 39, 14, 'habilidad', 50, 0, NULL),
(441, 39, 15, 'habilidad', 30, 0, NULL),
(442, 39, 16, 'magia', 35, 0, NULL),
(443, 39, 17, 'habilidad', 25, 0, NULL),
(444, 39, 18, 'magia', 35, 0, NULL),
(445, 39, 19, 'fuerza', 15, 0, NULL),
(446, 39, 20, 'fuerza', 30, 0, NULL),
(447, 40, 1, 'fuerza', 45, 0, NULL),
(448, 40, 2, 'fuerza', 20, 0, NULL),
(449, 40, 3, 'habilidad', 5, 0, NULL),
(450, 40, 4, 'magia', 10, 0, NULL),
(451, 40, 5, 'magia', 50, 0, NULL),
(452, 40, 6, 'magia', 10, 0, NULL),
(453, 40, 7, 'fuerza', 20, 0, NULL),
(454, 40, 8, 'magia', 5, 0, NULL),
(455, 40, 9, 'fuerza', 15, 0, NULL),
(456, 40, 10, 'magia', 40, 0, NULL),
(457, 40, 11, 'fuerza', 30, 0, NULL),
(458, 40, 12, 'fuerza', 15, 0, NULL),
(459, 40, 13, 'habilidad', 45, 0, NULL),
(460, 40, 14, 'fuerza', 30, 0, NULL),
(461, 40, 15, 'fuerza', 40, 0, NULL),
(462, 40, 16, 'habilidad', 20, 0, NULL),
(463, 40, 17, 'fuerza', 5, 0, NULL),
(464, 40, 18, 'magia', 10, 0, NULL),
(465, 40, 19, 'habilidad', 40, 0, NULL),
(466, 40, 20, 'habilidad', 35, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `heroe`
--

CREATE TABLE `heroe` (
  `id` int(11) NOT NULL,
  `id_partida` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `capacidad_maxima` int(11) NOT NULL DEFAULT 50,
  `capacidad_actual` int(11) NOT NULL DEFAULT 50,
  `estado` enum('activo','inactivo') NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `heroe`
--

INSERT INTO `heroe` (`id`, `id_partida`, `nombre`, `capacidad_maxima`, `capacidad_actual`, `estado`) VALUES
(11, 15, 'Gandalf', 50, 50, 'activo'),
(12, 15, 'Thorin', 50, 50, 'activo'),
(13, 15, 'Bilbo', 50, 50, 'activo'),
(14, 16, 'Gandalf', 50, 50, 'activo'),
(15, 16, 'Thorin', 50, 50, 'activo'),
(16, 16, 'Bilbo', 50, 50, 'activo'),
(17, 17, 'Gandalf', 50, 50, 'activo'),
(18, 17, 'Thorin', 50, 50, 'activo'),
(19, 17, 'Bilbo', 50, 50, 'activo'),
(20, 18, 'Gandalf', 50, 50, 'activo'),
(21, 18, '', 50, 30, ''),
(22, 18, 'Bilbo', 50, 50, 'activo'),
(23, 19, 'Gandalf', 50, 50, 'activo'),
(24, 19, '', 50, 10, ''),
(25, 19, 'Bilbo', 50, 50, 'activo'),
(26, 20, '', 50, 30, ''),
(27, 20, 'Thorin', 50, 50, 'activo'),
(28, 20, 'Bilbo', 50, 50, 'activo'),
(29, 21, 'Gandalf', 50, 50, 'activo'),
(30, 21, 'Thorin', 50, 50, 'activo'),
(31, 21, '0', 50, 0, ''),
(32, 22, '0', 50, 35, ''),
(33, 22, 'Thorin', 50, 50, 'activo'),
(34, 22, 'Bilbo', 50, 50, 'activo'),
(35, 23, 'Gandalf', 50, 50, 'activo'),
(36, 23, 'Thorin', 50, 50, 'activo'),
(37, 23, '0', 50, 0, ''),
(38, 24, 'Gandalf', 50, 5, 'activo'),
(39, 24, 'Thorin', 50, 0, 'activo'),
(40, 24, 'Bilbo', 50, 0, 'activo'),
(41, 25, 'Gandalf', 50, 50, 'activo'),
(42, 25, 'Thorin', 50, 50, 'activo'),
(43, 25, 'Bilbo', 50, 50, 'activo'),
(44, 26, 'Gandalf', 50, 0, 'inactivo'),
(45, 26, 'Thorin', 50, 0, 'activo'),
(46, 26, 'Bilbo', 50, 0, 'activo'),
(47, 27, 'Gandalf', 50, 0, 'inactivo'),
(48, 27, 'Thorin', 50, 5, 'activo'),
(49, 27, 'Bilbo', 50, 0, 'activo'),
(50, 28, 'Gandalf', 50, 50, 'activo'),
(51, 28, 'Thorin', 50, 50, 'activo'),
(52, 28, 'Bilbo', 50, 20, 'activo'),
(53, 29, 'Gandalf', 50, 50, 'activo'),
(54, 29, 'Thorin', 50, 0, 'inactivo'),
(55, 29, 'Bilbo', 50, 0, 'activo'),
(56, 30, 'Gandalf', 50, 0, 'inactivo'),
(57, 30, 'Thorin', 50, 0, 'inactivo'),
(58, 30, 'Bilbo', 50, 0, 'inactivo'),
(59, 31, 'Gandalf', 50, 50, 'activo'),
(60, 31, 'Thorin', 50, 50, 'activo'),
(61, 31, 'Bilbo', 50, 0, 'inactivo'),
(62, 32, 'Gandalf', 50, 50, 'activo'),
(63, 32, 'Thorin', 50, 50, 'activo'),
(64, 32, 'Bilbo', 50, 50, 'activo'),
(65, 33, 'Gandalf', 50, 50, 'activo'),
(66, 33, 'Thorin', 50, 50, 'activo'),
(67, 33, 'Bilbo', 50, 50, 'activo'),
(68, 37, 'Gandalf', 50, 50, 'activo'),
(69, 37, 'Thorin', 50, 50, 'activo'),
(70, 37, 'Bilbo', 50, 50, 'activo'),
(71, 38, 'Gandalf', 50, 50, 'activo'),
(72, 38, 'Thorin', 50, 0, 'inactivo'),
(73, 38, 'Bilbo', 50, 50, 'activo'),
(74, 39, 'Gandalf', 50, 0, 'inactivo'),
(75, 39, 'Thorin', 50, 20, 'activo'),
(76, 39, 'Bilbo', 50, 0, 'inactivo'),
(77, 40, 'Gandalf', 50, 50, 'activo'),
(78, 40, 'Thorin', 50, 50, 'activo'),
(79, 40, 'Bilbo', 50, 50, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE `partida` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL DEFAULT 'estandar',
  `casillas_totales` int(11) NOT NULL DEFAULT 20,
  `casillas_destapadas` int(11) NOT NULL DEFAULT 0,
  `casillas_perdidas_seguidas` int(11) NOT NULL DEFAULT 0,
  `estado` enum('en_curso','ganada','perdida','rendida') NOT NULL DEFAULT 'en_curso',
  `fecha_inicio` datetime DEFAULT current_timestamp(),
  `fecha_fin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`id`, `id_usuario`, `tipo`, `casillas_totales`, `casillas_destapadas`, `casillas_perdidas_seguidas`, `estado`, `fecha_inicio`, `fecha_fin`) VALUES
(15, 7, 'estandar', 20, 5, 5, 'perdida', '2025-10-10 00:23:06', NULL),
(16, 7, 'estandar', 20, 5, 5, 'perdida', '2025-10-10 01:04:08', NULL),
(17, 7, 'estandar', 20, 4, 4, 'en_curso', '2025-10-10 01:06:03', NULL),
(18, 7, 'estandar', 20, 5, 0, 'en_curso', '2025-10-10 01:15:49', NULL),
(19, 9, 'estandar', 20, 1, 0, 'en_curso', '2025-10-10 01:29:50', NULL),
(20, 9, 'estandar', 20, 2, 1, 'en_curso', '2025-10-10 01:37:30', NULL),
(21, 10, 'estandar', 20, 1, 0, 'en_curso', '2025-10-10 01:54:36', NULL),
(22, 10, 'estandar', 20, 1, 0, 'en_curso', '2025-10-10 02:06:47', NULL),
(23, 11, 'estandar', 20, 1, 1, 'en_curso', '2025-10-10 02:29:59', NULL),
(24, 11, 'estandar', 20, 10, 0, 'ganada', '2025-10-10 02:45:16', NULL),
(25, 11, 'estandar', 20, 0, 0, 'rendida', '2025-10-10 02:46:58', NULL),
(26, 12, 'estandar', 20, 7, 3, 'perdida', '2025-10-10 18:35:26', NULL),
(27, 12, 'estandar', 20, 10, 2, 'ganada', '2025-10-10 18:37:03', NULL),
(28, 12, 'estandar', 20, 1, 0, 'en_curso', '2025-10-10 18:49:39', NULL),
(29, 12, 'estandar', 20, 3, 0, 'en_curso', '2025-10-10 18:58:50', NULL),
(30, 15, 'estandar', 20, 4, 2, 'perdida', '2025-10-10 20:10:41', NULL),
(31, 15, 'estandar', 20, 3, 1, 'rendida', '2025-10-10 20:11:49', NULL),
(32, 15, 'estandar', 20, 0, 0, 'en_curso', '2025-10-10 20:16:25', NULL),
(33, 15, 'estandar', 20, 0, 0, 'rendida', '2025-10-10 20:27:14', NULL),
(36, 17, 'estandar', 20, 0, 0, 'en_curso', '2025-10-11 22:21:36', NULL),
(37, 17, 'estandar', 20, 0, 0, 'en_curso', '2025-10-11 22:30:09', NULL),
(38, 19, 'estandar', 20, 1, 1, 'rendida', '2025-10-11 22:33:22', NULL),
(39, 50, 'estandar', 20, 8, 5, 'perdida', '2025-10-12 12:50:57', NULL),
(40, 50, 'estandar', 20, 0, 0, 'rendida', '2025-10-12 12:55:20', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `rol` enum('jugador','administrador') NOT NULL DEFAULT 'jugador',
  `fecha_creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre_usuario`, `email`, `clave`, `rol`, `fecha_creacion`) VALUES
(3, 'Carlos', 'ramirez@email.com', '12345', 'administrador', '2025-10-05 20:00:31'),
(5, 'Sergio', 'perez@correo.com', '123456', 'administrador', '2025-10-09 03:20:32'),
(7, 'Fran', 'fran@correo.com', 'abcd', 'jugador', '2025-10-09 13:54:51'),
(9, 'Alvaro', 'nuca@correo.com', '1122', 'jugador', '2025-10-10 01:29:19'),
(10, 'Jose', 'lito@correo.com', '1111', 'jugador', '2025-10-10 01:52:33'),
(11, 'Marciano', 'marte@correo.com', '2222', 'jugador', '2025-10-10 02:29:38'),
(12, 'Juancar', 'juancar@correo.com', '0000', 'jugador', '2025-10-10 15:17:01'),
(15, 'Julio', 'julio@correo.com', '222222', 'jugador', '2025-10-10 20:09:01'),
(17, 'Julian', 'joo@correo.com', '1111', 'jugador', '2025-10-11 22:21:18'),
(19, 'Marisa', 'ma@correo.com', 'C4Nsvrd5', 'jugador', '2025-10-11 22:31:26'),
(35, 'Diego', 'rroo@gmail.com', '1111', 'jugador', '2025-10-12 04:04:52'),
(37, 'Sara', 'ramos@gmail.com', '1111', 'jugador', '2025-10-12 04:05:37'),
(38, 'Begoña', 'ram@gmail.com', '1111', 'jugador', '2025-10-12 04:06:12'),
(50, 'Laura', 'carlosramii2304@gmail.com', 'MibcnhXo', 'jugador', '2025-10-12 12:31:36');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `casilla`
--
ALTER TABLE `casilla`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_partida_posicion` (`id_partida`,`posicion`);

--
-- Indices de la tabla `heroe`
--
ALTER TABLE `heroe`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_partida_heroe` (`id_partida`,`nombre`);

--
-- Indices de la tabla `partida`
--
ALTER TABLE `partida`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `casilla`
--
ALTER TABLE `casilla`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=467;

--
-- AUTO_INCREMENT de la tabla `heroe`
--
ALTER TABLE `heroe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `casilla`
--
ALTER TABLE `casilla`
  ADD CONSTRAINT `casilla_ibfk_1` FOREIGN KEY (`id_partida`) REFERENCES `partida` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `heroe`
--
ALTER TABLE `heroe`
  ADD CONSTRAINT `heroe_ibfk_1` FOREIGN KEY (`id_partida`) REFERENCES `partida` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `partida`
--
ALTER TABLE `partida`
  ADD CONSTRAINT `partida_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
