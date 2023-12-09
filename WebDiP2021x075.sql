-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 16, 2022 at 08:42 PM
-- Server version: 5.5.62-0+deb8u1
-- PHP Version: 7.2.25-1+0~20191128.32+debian8~1.gbp108445

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WebDiP2021x075`
--

-- --------------------------------------------------------

--
-- Table structure for table `boja`
--

CREATE TABLE `boja` (
  `id_boja` int(11) NOT NULL,
  `naziv_boje` varchar(50) NOT NULL,
  `red` smallint(6) NOT NULL,
  `green` smallint(6) NOT NULL,
  `blue` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `boja`
--

INSERT INTO `boja` (`id_boja`, `naziv_boje`, `red`, `green`, `blue`) VALUES
(1, 'Crvena', 255, 0, 0),
(2, 'Plava', 0, 0, 255),
(3, 'Zelena', 0, 255, 0),
(4, 'Ljubičasta', 153, 0, 153),
(5, 'Žuta', 255, 255, 0),
(6, 'CIjan', 0, 255, 255),
(7, 'Roza', 255, 0, 255),
(8, 'Crna', 0, 0, 0),
(9, 'BIjela', 255, 255, 255),
(10, 'Siva', 128, 128, 128);

-- --------------------------------------------------------

--
-- Table structure for table `dnevnik_rada`
--

CREATE TABLE `dnevnik_rada` (
  `id_zapis` int(11) NOT NULL,
  `id_korisnik` int(11) NOT NULL,
  `tip` varchar(255) COLLATE utf8_bin NOT NULL,
  `vrijeme` datetime NOT NULL,
  `upit` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `radnja` varchar(1000) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `dnevnik_rada`
--

INSERT INTO `dnevnik_rada` (`id_zapis`, `id_korisnik`, `tip`, `vrijeme`, `upit`, `radnja`) VALUES
(15, 38, 'prijava', '2022-06-09 18:14:10', NULL, NULL),
(16, 38, 'odjava', '2022-06-09 18:14:12', NULL, NULL),
(36, 37, 'prijava', '2022-06-10 17:31:21', NULL, NULL),
(37, 37, 'odjava', '2022-06-10 19:06:36', NULL, NULL),
(38, 37, 'prijava', '2022-06-11 18:43:21', NULL, NULL),
(39, 37, 'odjava', '2022-06-11 18:43:28', NULL, NULL),
(40, 37, 'prijava', '2022-06-11 18:45:13', NULL, NULL),
(41, 37, 'odjava', '2022-06-11 18:46:02', NULL, NULL),
(42, 37, 'prijava', '2022-06-11 19:05:02', NULL, NULL),
(43, 37, 'odjava', '2022-06-11 19:05:18', NULL, NULL),
(44, 37, 'prijava', '2022-06-11 19:44:03', NULL, NULL),
(45, 37, 'ostalo', '2022-06-12 18:53:05', NULL, 'Neuspješna prijava'),
(46, 37, 'prijava', '2022-06-12 18:53:12', NULL, NULL),
(86, 38, 'upit', '2022-06-13 18:55:21', 'Preuzimanje narudžbe', NULL),
(87, 38, 'upit', '2022-06-13 18:55:33', 'Kreirao narudžbu novog namještaja', NULL),
(88, 38, 'upit', '2022-06-13 18:55:49', 'Uredio narudžbu novog namještaja (id: 158)', NULL),
(89, 38, 'upit', '2022-06-13 18:56:06', 'Naručio dostupan namještaj (id: 1)', NULL),
(91, 49, 'ostalo', '2022-06-14 15:09:27', NULL, 'Registracija'),
(92, 49, 'ostalo', '2022-06-14 15:10:16', NULL, 'Aktivacija računa'),
(93, 49, 'prijava', '2022-06-14 15:11:02', NULL, NULL),
(94, 49, 'odjava', '2022-06-14 15:30:49', NULL, NULL),
(95, 49, 'prijava', '2022-06-14 15:30:55', NULL, NULL),
(96, 49, 'odjava', '2022-06-14 15:34:10', NULL, NULL),
(97, 38, 'prijava', '2022-06-14 15:34:18', NULL, NULL),
(98, 38, 'odjava', '2022-06-14 15:36:50', NULL, NULL),
(99, 49, 'prijava', '2022-06-14 15:36:54', NULL, NULL),
(100, 49, 'odjava', '2022-06-14 15:56:40', NULL, NULL),
(101, 38, 'prijava', '2022-06-14 15:56:45', NULL, NULL),
(102, 38, 'odjava', '2022-06-14 15:56:52', NULL, NULL),
(103, 49, 'prijava', '2022-06-14 15:56:58', NULL, NULL),
(105, 49, 'upit', '2022-06-14 17:16:17', 'Kreiranje novog namještaja', NULL),
(119, 49, 'upit', '2022-06-14 18:35:50', 'Ažuriranje namještaja id(4)', NULL),
(120, 49, 'odjava', '2022-06-14 20:27:48', NULL, NULL),
(121, 38, 'prijava', '2022-06-14 20:27:52', NULL, NULL),
(122, 38, 'upit', '2022-06-14 20:28:02', 'Kreirao narudžbu novog namještaja', NULL),
(123, 38, 'upit', '2022-06-14 20:28:09', 'Uredio narudžbu novog namještaja (id: 160)', NULL),
(124, 38, 'odjava', '2022-06-14 20:28:13', NULL, NULL),
(125, 49, 'prijava', '2022-06-14 20:28:17', NULL, NULL),
(126, 49, 'odjava', '2022-06-14 20:49:17', NULL, NULL),
(127, 49, 'prijava', '2022-06-14 20:49:34', NULL, NULL),
(128, 49, 'ostalo', '2022-06-15 09:31:55', NULL, 'Neuspješna prijava'),
(129, 49, 'prijava', '2022-06-15 09:32:01', NULL, NULL),
(138, 49, 'upit', '2022-06-15 10:10:58', 'Ažuriranje datuma i vremena isporuke (id narudžbe95)', NULL),
(139, 49, 'upit', '2022-06-15 10:13:42', 'Ažuriranje datuma i vremena isporuke (id narudžbe95)', NULL),
(140, 49, 'upit', '2022-06-15 10:14:01', 'Ažuriranje datuma i vremena isporuke (id narudžbe95)', NULL),
(141, 49, 'upit', '2022-06-15 10:14:20', 'Dodavanje datuma i vremena isporuke (id narudžbe: 159)', NULL),
(142, 49, 'upit', '2022-06-15 10:16:04', 'Dodavanje datuma i vremena isporuke (id narudžbe: 95)', NULL),
(143, 49, 'upit', '2022-06-15 10:16:18', 'Dodavanje datuma i vremena isporuke (id narudžbe: 159)', NULL),
(144, 49, 'upit', '2022-06-15 10:21:07', 'Dodavanje datuma i vremena isporuke (id narudžbe: 95)', NULL),
(145, 49, 'upit', '2022-06-15 10:22:11', 'Dodavanje datuma i vremena isporuke (id narudžbe: 159)', NULL),
(146, 49, 'upit', '2022-06-15 10:23:19', 'Dodavanje datuma i vremena isporuke (id narudžbe: 95)', NULL),
(147, 49, 'upit', '2022-06-15 10:23:23', 'Ažuriranje datuma i vremena isporuke (id narudžbe95)', NULL),
(148, 49, 'upit', '2022-06-15 10:23:42', 'Ažuriranje datuma i vremena isporuke (id narudžbe95)', NULL),
(149, 49, 'upit', '2022-06-15 10:25:24', 'Ažuriranje datuma i vremena isporuke (id narudžbe95)', NULL),
(150, 49, 'upit', '2022-06-15 10:25:58', 'Ažuriranje datuma i vremena isporuke (id narudžbe95)', NULL),
(151, 49, 'upit', '2022-06-15 10:26:10', 'Dodavanje datuma i vremena isporuke (id narudžbe: 159)', NULL),
(152, 49, 'upit', '2022-06-15 10:33:36', 'Potvrđivanje narudžbe (id narudžbe157)', NULL),
(153, 49, 'upit', '2022-06-15 10:33:43', 'Potvrđivanje narudžbe (id narudžbe85)', NULL),
(154, 49, 'upit', '2022-06-15 10:34:26', 'Potvrđivanje narudžbe (id narudžbe157)', NULL),
(155, 49, 'upit', '2022-06-15 10:34:36', 'Dodavanje datuma i vremena isporuke (id narudžbe: 157)', NULL),
(156, 49, 'upit', '2022-06-15 10:34:39', 'Ažuriranje datuma i vremena isporuke (id narudžbe157)', NULL),
(157, 49, 'upit', '2022-06-15 10:34:44', 'Ažuriranje datuma i vremena isporuke (id narudžbe157)', NULL),
(158, 49, 'upit', '2022-06-15 10:34:49', 'Potvrđivanje narudžbe (id narudžbe95)', NULL),
(159, 49, 'upit', '2022-06-15 10:34:52', 'Dodavanje datuma i vremena isporuke (id narudžbe: 95)', NULL),
(160, 49, 'upit', '2022-06-15 10:34:56', 'Potvrđivanje narudžbe (id narudžbe159)', NULL),
(161, 49, 'upit', '2022-06-15 10:39:33', 'Potvrđivanje narudžbe (id narudžbe95)', NULL),
(162, 49, 'upit', '2022-06-15 10:41:53', 'Potvrđivanje narudžbe (id narudžbe95)', NULL),
(163, 49, 'odjava', '2022-06-15 10:53:52', NULL, NULL),
(164, 38, 'prijava', '2022-06-15 10:53:58', NULL, NULL),
(165, 38, 'upit', '2022-06-15 10:54:05', 'Preuzimanje narudžbe', NULL),
(166, 38, 'odjava', '2022-06-15 10:54:13', NULL, NULL),
(167, 49, 'prijava', '2022-06-15 10:54:18', NULL, NULL),
(168, 49, 'upit', '2022-06-15 10:54:27', 'Potvrđivanje narudžbe (id narudžbe159)', NULL),
(169, 49, 'upit', '2022-06-15 11:04:04', 'Kreiranje namještaja i potvrđivanje narudžbe(id narudžbe: 160, id namještaja: 102)', NULL),
(170, 49, 'upit', '2022-06-15 11:04:08', 'Potvrđivanje narudžbe (id narudžbe: 157)', NULL),
(171, 49, 'upit', '2022-06-15 11:04:12', 'Dodavanje datuma i vremena isporuke (id narudžbe: 157)', NULL),
(172, 49, 'upit', '2022-06-15 11:04:15', 'Dodavanje datuma i vremena isporuke (id narudžbe: 160)', NULL),
(173, 49, 'upit', '2022-06-15 11:05:55', 'Ažuriranje namještaja id(102)', NULL),
(174, 49, 'odjava', '2022-06-15 11:06:44', NULL, NULL),
(175, 38, 'prijava', '2022-06-15 11:06:49', NULL, NULL),
(176, 38, 'upit', '2022-06-15 11:07:03', 'Kreirao narudžbu novog namještaja', NULL),
(177, 38, 'odjava', '2022-06-15 11:07:07', NULL, NULL),
(178, 49, 'prijava', '2022-06-15 11:07:11', NULL, NULL),
(179, 49, 'upit', '2022-06-15 11:07:16', 'Kreiranje namještaja i potvrđivanje narudžbe(id narudžbe: 161, id namještaja: 103)', NULL),
(180, 49, 'upit', '2022-06-15 11:10:31', 'Ažuriranje namještaja id(103)', NULL),
(181, 49, 'upit', '2022-06-15 11:13:49', 'Ažuriranje namještaja id(103)', NULL),
(182, 49, 'upit', '2022-06-15 11:17:01', 'Ažuriranje namještaja id(103)', NULL),
(183, 49, 'upit', '2022-06-15 11:20:33', 'Ažuriranje namještaja id(103)', NULL),
(184, 49, 'odjava', '2022-06-15 11:20:43', NULL, NULL),
(185, 38, 'prijava', '2022-06-15 11:20:55', NULL, NULL),
(186, 38, 'upit', '2022-06-15 11:20:59', 'Naručio dostupan namještaj (id: 1)', NULL),
(187, 38, 'upit', '2022-06-15 11:21:11', 'Preuzimanje narudžbe', NULL),
(188, 38, 'upit', '2022-06-15 11:21:45', 'Kreirao narudžbu novog namještaja', NULL),
(189, 38, 'upit', '2022-06-15 11:21:52', 'Uredio narudžbu novog namještaja (id: 163)', NULL),
(190, 38, 'odjava', '2022-06-15 13:06:27', NULL, NULL),
(191, 49, 'prijava', '2022-06-15 13:06:31', NULL, NULL),
(192, 49, 'upit', '2022-06-15 13:07:05', 'Ažuriranje namještaja id(4)', NULL),
(193, 49, 'odjava', '2022-06-15 13:15:55', NULL, NULL),
(194, 38, 'prijava', '2022-06-15 13:16:00', NULL, NULL),
(195, 38, 'odjava', '2022-06-15 13:16:13', NULL, NULL),
(196, 49, 'prijava', '2022-06-15 13:16:17', NULL, NULL),
(197, 49, 'upit', '2022-06-15 14:17:52', 'Odabir popusta (id: 3) za namještaj (id: 4)', NULL),
(198, 49, 'odjava', '2022-06-15 14:55:00', NULL, NULL),
(199, 37, 'prijava', '2022-06-15 14:55:05', NULL, NULL),
(200, 49, 'prijava', '2022-06-15 16:32:42', NULL, NULL),
(201, 49, 'upit', '2022-06-15 16:32:47', 'Ažuriranje datuma i vremena isporuke (id narudžbe: 89)', NULL),
(202, 49, 'upit', '2022-06-15 16:32:50', 'Ažuriranje datuma i vremena isporuke (id narudžbe: 89)', NULL),
(203, 49, 'upit', '2022-06-15 16:32:52', 'Ažuriranje datuma i vremena isporuke (id narudžbe: 89)', NULL),
(204, 49, 'upit', '2022-06-15 16:32:54', 'Ažuriranje datuma i vremena isporuke (id narudžbe: 89)', NULL),
(205, 49, 'upit', '2022-06-15 16:32:57', 'Ažuriranje datuma i vremena isporuke (id narudžbe: 89)', NULL),
(206, 49, 'upit', '2022-06-15 16:33:17', 'Odabir popusta (id: 3) za namještaj (id: 5)', NULL),
(207, 49, 'odjava', '2022-06-15 16:33:21', NULL, NULL),
(208, 49, 'prijava', '2022-06-15 17:27:28', NULL, NULL),
(209, 49, 'odjava', '2022-06-15 17:32:22', NULL, NULL),
(220, 49, 'prijava', '2022-06-15 18:14:51', NULL, NULL),
(221, 49, 'upit', '2022-06-15 18:15:14', 'Potvrđivanje narudžbe (id narudžbe: 164)', NULL),
(222, 49, 'upit', '2022-06-15 18:15:23', 'Dodavanje datuma i vremena isporuke (id narudžbe: 164)', NULL),
(223, 49, 'odjava', '2022-06-15 18:15:31', NULL, NULL),
(233, 49, 'prijava', '2022-06-16 09:36:44', NULL, NULL),
(234, 49, 'upit', '2022-06-16 09:42:36', 'Ažuriranje namještaja (id: 5)', NULL),
(235, 49, 'odjava', '2022-06-16 09:42:55', NULL, NULL),
(243, 49, 'prijava', '2022-06-16 09:44:55', NULL, NULL),
(244, 49, 'upit', '2022-06-16 09:45:16', 'Kreiranje namještaja i potvrđivanje narudžbe(id narudžbe: 167, id namještaja: 105)', NULL),
(245, 49, 'upit', '2022-06-16 09:45:38', 'Dodavanje datuma i vremena isporuke (id narudžbe: 167)', NULL),
(246, 49, 'upit', '2022-06-16 09:45:42', 'Ažuriranje datuma i vremena isporuke (id narudžbe: 167)', NULL),
(247, 49, 'odjava', '2022-06-16 09:45:46', NULL, NULL),
(251, 53, 'ostalo', '2022-06-16 13:59:51', NULL, 'Registracija'),
(252, 54, 'ostalo', '2022-06-16 14:00:32', NULL, 'Registracija'),
(253, 55, 'ostalo', '2022-06-16 14:00:52', NULL, 'Registracija'),
(263, 53, 'prijava', '2022-06-16 14:04:35', NULL, NULL),
(264, 53, 'odjava', '2022-06-16 14:04:53', NULL, NULL),
(265, 53, 'prijava', '2022-06-16 14:04:59', NULL, NULL),
(266, 54, 'prijava', '2022-06-16 14:05:09', NULL, NULL),
(267, 55, 'prijava', '2022-06-16 14:05:34', NULL, NULL),
(268, 54, 'odjava', '2022-06-16 14:13:20', NULL, NULL),
(269, 54, 'prijava', '2022-06-16 14:13:24', NULL, NULL),
(270, 54, 'odjava', '2022-06-16 14:13:56', NULL, NULL),
(271, 54, 'ostalo', '2022-06-16 14:14:00', NULL, 'Pokušaj logiranja u blokiran račun'),
(272, 54, 'prijava', '2022-06-16 14:14:11', NULL, NULL),
(273, 54, 'odjava', '2022-06-16 14:14:30', NULL, NULL),
(276, 53, 'odjava', '2022-06-16 14:17:06', NULL, NULL),
(283, 53, 'prijava', '2022-06-16 14:17:43', NULL, NULL),
(284, 53, 'odjava', '2022-06-16 14:18:11', NULL, NULL),
(287, 53, 'prijava', '2022-06-16 14:20:46', NULL, NULL),
(288, 53, 'upit', '2022-06-16 14:21:13', 'Kreiranje nove kategorije namjestaja', NULL),
(289, 53, 'upit', '2022-06-16 14:21:22', 'Kategorija namještaja uređena (kategorija id: 11)', NULL),
(290, 53, 'upit', '2022-06-16 14:21:38', 'Dodijeljivanje moderatora (id: 54) kategoriji (id: 11', NULL),
(291, 53, 'upit', '2022-06-16 14:21:43', 'Moderator (id: 54) uklonjen iz kategorije (id: 11', NULL),
(292, 53, 'upit', '2022-06-16 14:21:50', 'Dodijeljivanje moderatora (id: 54) kategoriji (id: 11', NULL),
(293, 54, 'prijava', '2022-06-16 14:22:21', NULL, NULL),
(294, 54, 'odjava', '2022-06-16 14:23:04', NULL, NULL),
(295, 54, 'prijava', '2022-06-16 14:23:43', NULL, NULL),
(296, 53, 'upit', '2022-06-16 14:27:53', 'Moderator (id: 54) uklonjen iz kategorije (id: 11', NULL),
(297, 53, 'upit', '2022-06-16 14:27:59', 'Dodijeljivanje moderatora (id: 54) kategoriji (id: 11', NULL),
(298, 54, 'prijava', '2022-06-16 14:28:29', NULL, NULL),
(299, 54, 'odjava', '2022-06-16 14:28:56', NULL, NULL),
(300, 53, 'upit', '2022-06-16 14:29:08', 'Moderator (id: 54) uklonjen iz kategorije (id: 11', NULL),
(301, 53, 'upit', '2022-06-16 14:29:14', 'Dodijeljivanje moderatora (id: 54) kategoriji (id: 11', NULL),
(302, 49, 'prijava', '2022-06-16 14:29:48', NULL, NULL),
(303, 49, 'odjava', '2022-06-16 14:29:55', NULL, NULL),
(304, 53, 'upit', '2022-06-16 14:30:10', 'Dodijeljivanje moderatora (id: 54) kategoriji (id: 11', NULL),
(305, 54, 'prijava', '2022-06-16 14:30:21', NULL, NULL),
(306, 54, 'odjava', '2022-06-16 14:30:59', NULL, NULL),
(307, 53, 'upit', '2022-06-16 14:31:04', 'Moderator (id: 54) uklonjen iz kategorije (id: 11', NULL),
(308, 53, 'upit', '2022-06-16 14:31:12', 'Dodijeljivanje moderatora (id: 54) kategoriji (id: 11', NULL),
(309, 54, 'prijava', '2022-06-16 14:31:23', NULL, NULL),
(310, 54, 'upit', '2022-06-16 14:32:08', 'Kreiranje novog namještaja', NULL),
(311, 54, 'upit', '2022-06-16 14:32:30', 'Ažuriranje namještaja (id: 106)', NULL),
(312, 53, 'odjava', '2022-06-16 14:39:09', NULL, NULL),
(313, 37, 'prijava', '2022-06-16 14:39:14', NULL, NULL),
(314, 37, 'odjava', '2022-06-16 14:39:18', NULL, NULL),
(315, 53, 'prijava', '2022-06-16 14:39:27', NULL, NULL),
(316, 53, 'prijava', '2022-06-16 14:47:39', NULL, NULL),
(317, 53, 'odjava', '2022-06-16 14:47:44', NULL, NULL),
(318, 54, 'prijava', '2022-06-16 14:47:50', NULL, NULL),
(319, 54, 'upit', '2022-06-16 14:48:01', 'Odabir popusta (id: 4) za namještaj (id: 106)', NULL),
(320, 54, 'odjava', '2022-06-16 14:48:27', NULL, NULL),
(321, 54, 'prijava', '2022-06-16 14:48:53', NULL, NULL),
(322, 54, 'upit', '2022-06-16 14:49:17', 'Kreiranje novog namještaja', NULL),
(323, 54, 'odjava', '2022-06-16 14:49:19', NULL, NULL),
(324, 54, 'prijava', '2022-06-16 14:50:11', NULL, NULL),
(325, 55, 'prijava', '2022-06-16 14:50:34', NULL, NULL),
(326, 55, 'upit', '2022-06-16 14:51:06', 'Naručio dostupan namještaj (id: 106)', NULL),
(327, 54, 'upit', '2022-06-16 14:51:21', 'Potvrđivanje narudžbe (id narudžbe: 168)', NULL),
(328, 54, 'upit', '2022-06-16 14:51:41', 'Dodavanje datuma i vremena isporuke (id narudžbe: 168)', NULL),
(329, 54, 'upit', '2022-06-16 14:51:43', 'Ažuriranje datuma i vremena isporuke (id narudžbe: 168)', NULL),
(330, 54, 'upit', '2022-06-16 14:51:47', 'Ažuriranje datuma i vremena isporuke (id narudžbe: 168)', NULL),
(331, 54, 'upit', '2022-06-16 14:51:59', 'Ažuriranje datuma i vremena isporuke (id narudžbe: 168)', NULL),
(332, 55, 'upit', '2022-06-16 14:52:04', 'Preuzimanje narudžbe', NULL),
(333, 55, 'upit', '2022-06-16 14:53:09', 'Kreirao narudžbu novog namještaja', NULL),
(334, 55, 'upit', '2022-06-16 14:53:16', 'Uredio narudžbu novog namještaja (id: 169)', NULL),
(335, 55, 'upit', '2022-06-16 14:53:35', 'Uredio narudžbu novog namještaja (id: 169)', NULL),
(336, 54, 'upit', '2022-06-16 14:53:43', 'Kreiranje namještaja i potvrđivanje narudžbe(id narudžbe: 169, id namještaja: 108)', NULL),
(337, 54, 'upit', '2022-06-16 14:53:46', 'Dodavanje datuma i vremena isporuke (id narudžbe: 169)', NULL),
(338, 55, 'upit', '2022-06-16 14:54:03', 'Preuzimanje narudžbe', NULL),
(339, 55, 'upit', '2022-06-16 14:57:31', 'Kreirao narudžbu novog namještaja', NULL),
(340, 55, 'upit', '2022-06-16 14:57:42', 'Uredio narudžbu novog namještaja (id: 170)', NULL),
(341, 54, 'upit', '2022-06-16 14:57:47', 'Kreiranje namještaja i potvrđivanje narudžbe(id narudžbe: 170, id namještaja: 109)', NULL),
(342, 54, 'upit', '2022-06-16 14:57:52', 'Dodavanje datuma i vremena isporuke (id narudžbe: 170)', NULL),
(343, 55, 'odjava', '2022-06-16 14:59:19', NULL, NULL),
(344, 55, 'prijava', '2022-06-16 15:01:01', NULL, NULL),
(351, 54, 'prijava', '2022-06-16 15:20:50', NULL, NULL),
(352, 53, 'prijava', '2022-06-16 15:20:59', NULL, NULL),
(353, 55, 'prijava', '2022-06-16 15:27:38', NULL, NULL),
(354, 54, 'upit', '2022-06-16 15:32:03', 'Odabir popusta (id: 1) za namještaj (id: 106)', NULL),
(355, 54, 'odjava', '2022-06-16 15:33:26', NULL, NULL),
(356, 53, 'upit', '2022-06-16 15:33:33', 'Moderator (id: 54) uklonjen iz kategorije (id: 11', NULL),
(357, 53, 'upit', '2022-06-16 15:33:38', 'Dodijeljivanje moderatora (id: 54) kategoriji (id: 1', NULL),
(358, 53, 'upit', '2022-06-16 15:33:43', 'Moderator (id: 54) uklonjen iz kategorije (id: 1', NULL),
(359, 53, 'upit', '2022-06-16 15:33:47', 'Dodijeljivanje moderatora (id: 54) kategoriji (id: 11', NULL),
(360, 54, 'prijava', '2022-06-16 15:33:56', NULL, NULL),
(361, 55, 'upit', '2022-06-16 15:34:52', 'Naručio dostupan namještaj (id: 106)', NULL),
(362, 54, 'upit', '2022-06-16 15:35:03', 'Potvrđivanje narudžbe (id narudžbe: 171)', NULL),
(363, 55, 'upit', '2022-06-16 15:35:36', 'Kreirao narudžbu novog namještaja', NULL),
(364, 54, 'upit', '2022-06-16 15:36:19', 'Kreiranje namještaja i potvrđivanje narudžbe(id narudžbe: 172, id namještaja: 110)', NULL),
(365, 55, 'prijava', '2022-06-16 16:31:06', NULL, NULL),
(366, 55, 'odjava', '2022-06-16 16:54:45', NULL, NULL),
(367, 49, 'ostalo', '2022-06-16 16:54:50', NULL, 'Neuspješna prijava'),
(368, 49, 'prijava', '2022-06-16 16:54:58', NULL, NULL),
(369, 49, 'odjava', '2022-06-16 16:55:16', NULL, NULL),
(371, 54, 'prijava', '2022-06-16 18:47:31', NULL, NULL),
(372, 54, 'odjava', '2022-06-16 19:34:07', NULL, NULL),
(380, 55, 'prijava', '2022-06-16 19:36:44', NULL, NULL),
(381, 55, 'upit', '2022-06-16 19:37:24', 'Preuzimanje narudžbe', NULL),
(382, 55, 'upit', '2022-06-16 19:37:27', 'Preuzimanje narudžbe', NULL),
(383, 55, 'odjava', '2022-06-16 19:37:45', NULL, NULL),
(384, 54, 'prijava', '2022-06-16 19:37:51', NULL, NULL),
(385, 54, 'odjava', '2022-06-16 19:38:03', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dz4_dnevnik`
--

CREATE TABLE `dz4_dnevnik` (
  `id` int(11) NOT NULL,
  `korisnik` int(11) NOT NULL,
  `uloga` int(20) NOT NULL,
  `putanja` varchar(2000) CHARACTER SET utf8mb4 NOT NULL,
  `datum_vrijeme` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dz4_dnevnik`
--

INSERT INTO `dz4_dnevnik` (`id`, `korisnik`, `uloga`, `putanja`, `datum_vrijeme`) VALUES
(6, 3, 1, 'localhost/zadaca_04/multimedija.php', '2022-05-31 19:35:27'),
(7, 3, 1, 'barka.foi.hr/WebDiP/2021/zadaca_04/rmilosevi/multimedija.php', '2022-05-31 21:24:13');

-- --------------------------------------------------------

--
-- Table structure for table `dz4_korisnici`
--

CREATE TABLE `dz4_korisnici` (
  `id_korisnik` int(11) NOT NULL,
  `uloga_korisnika` int(11) NOT NULL,
  `ime` varchar(50) DEFAULT NULL,
  `prezime` varchar(50) DEFAULT NULL,
  `godina_rodenja` datetime NOT NULL,
  `korisnicko_ime` varchar(50) DEFAULT NULL,
  `lozinka` varchar(50) DEFAULT NULL,
  `salt` varchar(255) NOT NULL,
  `lozinka_265` char(64) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `broj_neuspjesnih_prijava` int(11) DEFAULT NULL,
  `uvjeti_koristenja` datetime DEFAULT NULL,
  `status_racuna` tinyint(4) DEFAULT NULL,
  `datum_registracije` datetime DEFAULT NULL,
  `aktivacijski_kod` varchar(255) DEFAULT NULL,
  `zapamti_me` int(11) DEFAULT NULL,
  `popuni_podatke` int(11) DEFAULT NULL,
  `redoslijed_prikazivanja` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dz4_korisnici`
--

INSERT INTO `dz4_korisnici` (`id_korisnik`, `uloga_korisnika`, `ime`, `prezime`, `godina_rodenja`, `korisnicko_ime`, `lozinka`, `salt`, `lozinka_265`, `email`, `broj_neuspjesnih_prijava`, `uvjeti_koristenja`, `status_racuna`, `datum_registracije`, `aktivacijski_kod`, `zapamti_me`, `popuni_podatke`, `redoslijed_prikazivanja`) VALUES
(3, 1, 'Mate', 'Matic', '1998-05-21 19:41:55', 'mmatic', '1234', ';?cd41~Ṣ6]+??ը`?Y?????J?0?', '8ef2615370f6f2826220bc5f6bfc42a18869fe52cbf274335210a1f4f199149c', 'mm@foi.hr', 0, '2022-05-31 11:32:00', 1, '2022-05-31 11:32:00', NULL, 1, 0, 0),
(5, 2, 'Frane', 'Franic', '1992-05-15 19:41:55', 'ffranic', 'ff12', '@?}?j?D1?_9+u?*???\r???(??lX?', '0bcb151cd310d24a28702e59dc77b17c39bfa1d07e0f1f551417ef0ed0f3d839', 'ff@foi.hr', 0, '2022-05-31 12:41:07', 1, '2022-05-31 12:41:07', NULL, 0, 0, 0),
(6, 3, 'Ana', 'Anic', '1987-05-06 19:41:55', 'ana123', 'qwe', '7pх?/??l\n???#1(??????????`s', '3fd5a4891a089c1c78ff1f9aeacd4a736f401b1b8a35661b119b1e9f2ee3f012', 'aa@foi.hr', 0, '2022-05-31 12:41:36', 1, '2022-05-31 12:41:36', NULL, 0, 1, 0),
(10, 1, 'Ive', 'Ivic', '1995-05-11 19:41:55', 'iivic', '99', '??N?rL>???o?g?;?)??괇lK?MЋ???', '7b1e9cc95f8a4d4a890681a0c59de88757f405d0d2eacb94a472219d2330bc64', 'ii@foi.hr', 0, NULL, 1, '2022-05-31 18:15:16', NULL, 1, 0, 1),
(16, 1, 'Ante', 'Antic', '1996-12-12 21:46:12', 'antea', 'aaa', '', '73db128cecd42213e3ab4f378cde4412cbbf8439d226e55d98355380c5efc097', 'antea@foi.hr', 0, NULL, 1, '2022-05-31 21:46:12', NULL, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategorija_namjestaja`
--

CREATE TABLE `kategorija_namjestaja` (
  `id_kategorija_namjestaja` int(11) NOT NULL,
  `naziv_kategorije` varchar(100) NOT NULL,
  `opis` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategorija_namjestaja`
--

INSERT INTO `kategorija_namjestaja` (`id_kategorija_namjestaja`, `naziv_kategorije`, `opis`) VALUES
(1, 'Ormari', 'Ormari za odjeću.'),
(2, 'Stolovi', NULL),
(3, 'Kaučevi', NULL),
(4, 'Stolice', 'Blagovaonske i radne stolice.'),
(5, 'Kreveti', 'Samo najbolji kreveti za vašu spavaću sobu.'),
(6, 'Noćni ormarići', NULL),
(7, 'Kuhinjski ormarići', NULL),
(8, 'Lampe', NULL),
(9, 'Fotelje', 'Savršene za opuštanje nakon dugog radnog dana.'),
(10, 'Hladnjaci', 'Čuvajte svu vašu hranu na sigurnom!'),
(11, 'Kategorija', 'Opis v2');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id_korisnik` int(11) NOT NULL,
  `uloga_korisnika` int(11) NOT NULL,
  `ime` varchar(50) DEFAULT NULL,
  `prezime` varchar(50) DEFAULT NULL,
  `korisnicko_ime` varchar(50) DEFAULT NULL,
  `lozinka` varchar(50) DEFAULT NULL,
  `salt` varchar(255) NOT NULL,
  `lozinka_256` char(64) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `broj_neuspjesnih_prijava` int(11) DEFAULT NULL,
  `uvjeti_koristenja` datetime NOT NULL,
  `status_racuna` tinyint(4) DEFAULT NULL,
  `datum_registracije` datetime DEFAULT NULL,
  `aktivacijski_kod` varchar(255) DEFAULT NULL,
  `sortiranje` tinyint(1) NOT NULL,
  `pretraga` tinyint(1) NOT NULL,
  `adresa` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id_korisnik`, `uloga_korisnika`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `salt`, `lozinka_256`, `email`, `broj_neuspjesnih_prijava`, `uvjeti_koristenja`, `status_racuna`, `datum_registracije`, `aktivacijski_kod`, `sortiranje`, `pretraga`, `adresa`) VALUES
(37, 3, 'Ive', 'Ivić', 'iivic', '12345', '25245823f1fb39031a28f7d8310755f0db72575360a9c320b27245b9ef43e747', '744ceb7430b152e72ccc2f05d9e811c92193a87e60981077a9e4d48b1c3e28a6', 'iivic@foi.hr', 0, '2022-06-09 15:46:27', 1, '2022-06-09 15:46:27', '4204a1e9191e9b19c142059d0a9663e1', 1, 1, 0),
(38, 1, 'Mate', 'Matić', 'mmatic', 'aaaaa', 'e3d97ae4c12664398a679151861f5e674941df1f91dca8665fe9a3236a1669ed', 'f4a957809b6f1cb1e70b00063d4316d241fdb84747608c73894dc2225d68f97d', 'mmatic@foi.hr', 0, '2022-06-09 16:56:11', 1, '2022-06-09 16:56:11', 'd0ff0e7dbb936b6b66d9f7eec0f19932', 1, 1, 1),
(49, 2, 'Ana', 'Anić', 'ana', 'qwert', '0cf44c7d356b37f600be72f348e1e1dd2a2218acf78bb1aeead4b0c412ff2e07', 'c0365b44d792bef9afe59b015a3715e06a70e274c5f873a00122d8f2343f54fb', 'aanic@foi.hr', 0, '2022-06-14 15:09:27', 1, '2022-06-14 15:09:27', '23fdff6bc6645143457bdb1201970100', 1, 0, 0),
(53, 3, 'Administrator', 'Administrator', 'admin', 'admin', '9a8d871923eda9ed5174cb6e73d91f373ddce2128a00729abed645e2508a553b', '67d2378add9124c117f81ebbacf2534baea183004ea14d0c2c3a10e92521d794', 'admin.istrator@foi.hr', 0, '2022-06-16 13:59:51', 1, '2022-06-16 13:59:51', 'a577c40c2fce34379339ac96303051ed', 1, 1, 0),
(54, 2, 'Moderator', 'Moderator', 'moderator', 'moderator', 'dc504224e45b0eda7ad0ea5ed614a4c13e5a2576e816ff7feb2bf8594dec76ef', 'd7d27395727cf5c0111a4cd8144c5605d8cefba060f34b87be222c1d2bffcf84', 'mod.erator@foi.hr', 0, '2022-06-16 14:00:32', 1, '2022-06-16 14:00:32', 'f17e66215d0d272589a78498cc726b23', 1, 1, 0),
(55, 1, 'Korisnik', 'Korisnik', 'korisnik', 'korisnik', '713e18b220650ecdb8235d37817505165400c4f15ad106322e2ba6ac07dcfeb2', 'a44eaed92b9db4c368920dc8d953c66781161eee178554db711a020b84e91494', 'kor.isnik@foi.hr', 0, '2022-06-16 14:00:52', 1, '2022-06-16 14:00:52', '4ad757f190687812b7bafa5771249c3e', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `materijal`
--

CREATE TABLE `materijal` (
  `id_materijal` int(11) NOT NULL,
  `naziv_materijala` varchar(50) NOT NULL,
  `opis` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `materijal`
--

INSERT INTO `materijal` (`id_materijal`, `naziv_materijala`, `opis`) VALUES
(1, 'Hrastovina', 'Drvo hrasta.'),
(2, 'Borovina', 'Drvo bora.'),
(3, 'Iverica', 'Jeftini materijal nastao od ostataka iz obrade drva.'),
(4, 'Tkanina', NULL),
(5, 'Kamen', 'Proizveden na otoku Braču.'),
(6, 'Baršun', NULL),
(7, 'Svila', 'Najkvalitetnija kineska svila.'),
(8, 'Plastika', NULL),
(9, 'Aluminij', NULL),
(10, 'PVC', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `moderatori_kategorije`
--

CREATE TABLE `moderatori_kategorije` (
  `id_korisnik` int(11) NOT NULL,
  `id_kategorija` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `moderatori_kategorije`
--

INSERT INTO `moderatori_kategorije` (`id_korisnik`, `id_kategorija`) VALUES
(49, 1),
(54, 11);

-- --------------------------------------------------------

--
-- Table structure for table `namjestaj`
--

CREATE TABLE `namjestaj` (
  `id_namjestaj` int(11) NOT NULL,
  `naziv` varchar(100) NOT NULL,
  `cijena` double DEFAULT NULL,
  `sirina` double NOT NULL,
  `visina` double NOT NULL,
  `duzina` double NOT NULL,
  `boja` int(11) NOT NULL,
  `vrsta_materijala` int(11) NOT NULL,
  `kategorija_namjestaja` int(11) NOT NULL,
  `status_namjestaja` int(11) NOT NULL,
  `slika` varchar(255) DEFAULT NULL,
  `datum_unosa` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `namjestaj`
--

INSERT INTO `namjestaj` (`id_namjestaj`, `naziv`, `cijena`, `sirina`, `visina`, `duzina`, `boja`, `vrsta_materijala`, `kategorija_namjestaja`, `status_namjestaja`, `slika`, `datum_unosa`) VALUES
(106, 'Namjestaj1', 75, 2, 1, 2, 2, 3, 11, 2, 'Annotation 2022-06-16 143153.jpg', '2022-06-16 14:32:08'),
(107, 'test2', 1, 1, 1, 1, 5, 5, 11, 1, 'Annotation 2022-06-16 144909.jpg', '2022-06-16 14:49:15'),
(108, 'test2324', 50, 1, 1, 1, 1, 1, 11, 2, NULL, '2022-06-16 14:53:09'),
(109, 'test2324', 100, 1, 1, 1, 1, 1, 11, 2, NULL, '2022-06-16 14:57:31'),
(110, 'test', 50, 1, 1, 1, 4, 1, 11, 2, NULL, '2022-06-16 15:35:36');

-- --------------------------------------------------------

--
-- Table structure for table `narudzba`
--

CREATE TABLE `narudzba` (
  `id_narudzba` int(11) NOT NULL,
  `id_namjestaj` int(11) NOT NULL,
  `cijena` double DEFAULT NULL,
  `datum_narudzbe` datetime NOT NULL,
  `datum_i_vrijeme_isporuke` datetime DEFAULT NULL,
  `status_narudzbe` int(11) NOT NULL,
  `narucitelj` int(11) NOT NULL,
  `adresa_dostave` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `narudzba`
--

INSERT INTO `narudzba` (`id_narudzba`, `id_namjestaj`, `cijena`, `datum_narudzbe`, `datum_i_vrijeme_isporuke`, `status_narudzbe`, `narucitelj`, `adresa_dostave`) VALUES
(168, 106, 63.75, '2022-06-16 14:51:06', '2022-06-03 14:51:00', 4, 55, NULL),
(170, 109, 100, '2022-06-16 14:57:31', '2022-06-01 14:57:00', 3, 55, NULL),
(171, 106, 56.25, '2022-06-16 15:34:52', NULL, 4, 55, NULL),
(172, 110, 50, '2022-06-16 15:35:36', NULL, 4, 55, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `popust`
--

CREATE TABLE `popust` (
  `id_popust` int(11) NOT NULL,
  `naziv_popusta` varchar(100) NOT NULL,
  `iznos` decimal(10,2) NOT NULL,
  `opis` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `popust`
--

INSERT INTO `popust` (`id_popust`, `naziv_popusta`, `iznos`, `opis`) VALUES
(1, 'Studentski popust', '0.25', '25% popusta za sve studente uz priloženu iksicu.'),
(2, 'Umirovljenički popust', '0.30', '30% popusta za sve umirovljenike.'),
(3, 'Ljetni popust', '0.10', '10% popusta na ljeto.'),
(4, 'Proljetni popust', '0.15', '15% popusta na proljeće.'),
(5, 'Crni Petak', '0.65', '65% popusta na crni petak.'),
(6, 'Vikend popust', '0.05', '5% popusta vikendom.'),
(7, 'Popust za mlade mame', '0.10', '10% popusta za mame mlađe od 25 godina.'),
(8, 'Zimski popust', '0.20', '20% popusta zimi.'),
(9, 'Jesensko sniženje', '0.33', '33% popusta prva dva tjedna jeseni.'),
(10, 'B00MBA promocija', '0.80', '80% popusta na odabrane artikle iz "B00MBA" promocije.');

-- --------------------------------------------------------

--
-- Table structure for table `popust_namjestaja`
--

CREATE TABLE `popust_namjestaja` (
  `id_popust` int(11) NOT NULL,
  `id_namjestaja` int(11) NOT NULL,
  `traje_od` datetime DEFAULT NULL,
  `traje_do` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `popust_namjestaja`
--

INSERT INTO `popust_namjestaja` (`id_popust`, `id_namjestaja`, `traje_od`, `traje_do`) VALUES
(1, 106, '2022-06-10 15:32:00', '2022-06-18 15:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `status_namjestaja`
--

CREATE TABLE `status_namjestaja` (
  `id_status_namjestaja` int(11) NOT NULL,
  `naziv_statusa` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status_namjestaja`
--

INSERT INTO `status_namjestaja` (`id_status_namjestaja`, `naziv_statusa`) VALUES
(0, 'Nedostupan'),
(1, 'Dostupan'),
(2, 'Kupljen');

-- --------------------------------------------------------

--
-- Table structure for table `status_narudzbe`
--

CREATE TABLE `status_narudzbe` (
  `id_status_narudzbe` int(11) NOT NULL,
  `naziv_statusa_narudzbe` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status_narudzbe`
--

INSERT INTO `status_narudzbe` (`id_status_narudzbe`, `naziv_statusa_narudzbe`) VALUES
(1, 'U obradi'),
(2, 'Naručen'),
(3, 'Dostava u tijeku'),
(4, 'Isporučen');

-- --------------------------------------------------------

--
-- Table structure for table `uloga_korisnika`
--

CREATE TABLE `uloga_korisnika` (
  `id_uloga_korisnika` int(11) NOT NULL,
  `naziv` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uloga_korisnika`
--

INSERT INTO `uloga_korisnika` (`id_uloga_korisnika`, `naziv`) VALUES
(1, 'Registrirani korisnik'),
(2, 'Moderator'),
(3, 'Administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boja`
--
ALTER TABLE `boja`
  ADD PRIMARY KEY (`id_boja`);

--
-- Indexes for table `dnevnik_rada`
--
ALTER TABLE `dnevnik_rada`
  ADD PRIMARY KEY (`id_zapis`),
  ADD KEY `id_korisnik` (`id_korisnik`);

--
-- Indexes for table `dz4_dnevnik`
--
ALTER TABLE `dz4_dnevnik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `korisnik` (`korisnik`);

--
-- Indexes for table `dz4_korisnici`
--
ALTER TABLE `dz4_korisnici`
  ADD PRIMARY KEY (`id_korisnik`),
  ADD KEY `fk_korisnik_uloga_korisnika_idx` (`uloga_korisnika`);

--
-- Indexes for table `kategorija_namjestaja`
--
ALTER TABLE `kategorija_namjestaja`
  ADD PRIMARY KEY (`id_kategorija_namjestaja`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id_korisnik`),
  ADD KEY `fk_korisnik_uloga_korisnika_idx` (`uloga_korisnika`);

--
-- Indexes for table `materijal`
--
ALTER TABLE `materijal`
  ADD PRIMARY KEY (`id_materijal`);

--
-- Indexes for table `moderatori_kategorije`
--
ALTER TABLE `moderatori_kategorije`
  ADD PRIMARY KEY (`id_korisnik`,`id_kategorija`),
  ADD KEY `fk_moderatori_kategorije_2_idx` (`id_kategorija`);

--
-- Indexes for table `namjestaj`
--
ALTER TABLE `namjestaj`
  ADD PRIMARY KEY (`id_namjestaj`),
  ADD KEY `fk_namjestaj_1_idx` (`status_namjestaja`),
  ADD KEY `fk_namjestaj_2_idx` (`kategorija_namjestaja`),
  ADD KEY `fk_namjestaj_3_idx` (`vrsta_materijala`),
  ADD KEY `fk_namjestaj_4_idx` (`boja`);

--
-- Indexes for table `narudzba`
--
ALTER TABLE `narudzba`
  ADD PRIMARY KEY (`id_narudzba`),
  ADD KEY `fk_narudzba_1_idx` (`status_narudzbe`),
  ADD KEY `fk_narudzba_2_idx` (`narucitelj`),
  ADD KEY `id_namjestaj` (`id_namjestaj`);

--
-- Indexes for table `popust`
--
ALTER TABLE `popust`
  ADD PRIMARY KEY (`id_popust`);

--
-- Indexes for table `popust_namjestaja`
--
ALTER TABLE `popust_namjestaja`
  ADD PRIMARY KEY (`id_popust`,`id_namjestaja`),
  ADD KEY `fk_popust_namjestaja_2_idx` (`id_namjestaja`);

--
-- Indexes for table `status_namjestaja`
--
ALTER TABLE `status_namjestaja`
  ADD PRIMARY KEY (`id_status_namjestaja`);

--
-- Indexes for table `status_narudzbe`
--
ALTER TABLE `status_narudzbe`
  ADD PRIMARY KEY (`id_status_narudzbe`);

--
-- Indexes for table `uloga_korisnika`
--
ALTER TABLE `uloga_korisnika`
  ADD PRIMARY KEY (`id_uloga_korisnika`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dnevnik_rada`
--
ALTER TABLE `dnevnik_rada`
  MODIFY `id_zapis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=386;
--
-- AUTO_INCREMENT for table `dz4_dnevnik`
--
ALTER TABLE `dz4_dnevnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `dz4_korisnici`
--
ALTER TABLE `dz4_korisnici`
  MODIFY `id_korisnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `kategorija_namjestaja`
--
ALTER TABLE `kategorija_namjestaja`
  MODIFY `id_kategorija_namjestaja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id_korisnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `namjestaj`
--
ALTER TABLE `namjestaj`
  MODIFY `id_namjestaj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT for table `narudzba`
--
ALTER TABLE `narudzba`
  MODIFY `id_narudzba` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;
--
-- AUTO_INCREMENT for table `popust`
--
ALTER TABLE `popust`
  MODIFY `id_popust` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dnevnik_rada`
--
ALTER TABLE `dnevnik_rada`
  ADD CONSTRAINT `dnevnik_rada_ibfk_1` FOREIGN KEY (`id_korisnik`) REFERENCES `korisnik` (`id_korisnik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dz4_dnevnik`
--
ALTER TABLE `dz4_dnevnik`
  ADD CONSTRAINT `fk_dnevnik_korisnik` FOREIGN KEY (`korisnik`) REFERENCES `dz4_korisnici` (`id_korisnik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `fk_korisnik_1` FOREIGN KEY (`uloga_korisnika`) REFERENCES `uloga_korisnika` (`id_uloga_korisnika`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `moderatori_kategorije`
--
ALTER TABLE `moderatori_kategorije`
  ADD CONSTRAINT `moderatori_kategorije_ibfk_1` FOREIGN KEY (`id_korisnik`) REFERENCES `korisnik` (`id_korisnik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `moderatori_kategorije_ibfk_2` FOREIGN KEY (`id_kategorija`) REFERENCES `kategorija_namjestaja` (`id_kategorija_namjestaja`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `namjestaj`
--
ALTER TABLE `namjestaj`
  ADD CONSTRAINT `fk_namjestaj_1` FOREIGN KEY (`status_namjestaja`) REFERENCES `status_namjestaja` (`id_status_namjestaja`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_namjestaj_3` FOREIGN KEY (`vrsta_materijala`) REFERENCES `materijal` (`id_materijal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_namjestaj_4` FOREIGN KEY (`boja`) REFERENCES `boja` (`id_boja`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `namjestaj_ibfk_1` FOREIGN KEY (`kategorija_namjestaja`) REFERENCES `kategorija_namjestaja` (`id_kategorija_namjestaja`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `narudzba`
--
ALTER TABLE `narudzba`
  ADD CONSTRAINT `fk_narudzba_1` FOREIGN KEY (`status_narudzbe`) REFERENCES `status_narudzbe` (`id_status_narudzbe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `narudzba_ibfk_1` FOREIGN KEY (`narucitelj`) REFERENCES `korisnik` (`id_korisnik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `narudzba_ibfk_2` FOREIGN KEY (`id_namjestaj`) REFERENCES `namjestaj` (`id_namjestaj`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `popust_namjestaja`
--
ALTER TABLE `popust_namjestaja`
  ADD CONSTRAINT `popust_namjestaja_ibfk_1` FOREIGN KEY (`id_popust`) REFERENCES `popust` (`id_popust`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `popust_namjestaja_ibfk_2` FOREIGN KEY (`id_namjestaja`) REFERENCES `namjestaj` (`id_namjestaj`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
