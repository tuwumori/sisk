-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 27, 2012 at 03:00 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sisk`
--

-- --------------------------------------------------------

--
-- Table structure for table `bagian`
--

CREATE TABLE IF NOT EXISTS `bagian` (
  `BAGIAN_ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_BAGIAN` varchar(255) DEFAULT NULL,
  `NILAI_MINIMUM` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`BAGIAN_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `bagian`
--

INSERT INTO `bagian` (`BAGIAN_ID`, `NAMA_BAGIAN`, `NILAI_MINIMUM`) VALUES
(2, 'Bagian Customer', 0.20),
(3, 'Bagian Produksi', 0.20),
(4, 'Bagian Marketing', 0.20);

-- --------------------------------------------------------

--
-- Table structure for table `calon_pegawai`
--

CREATE TABLE IF NOT EXISTS `calon_pegawai` (
  `CAPEG_ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_CAPEG` varchar(255) DEFAULT NULL,
  `STATUS_PEGAWAI` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`CAPEG_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `calon_pegawai`
--

INSERT INTO `calon_pegawai` (`CAPEG_ID`, `NAMA_CAPEG`, `STATUS_PEGAWAI`) VALUES
(1, 'Ronald Renaldi', 'Gagal'),
(2, 'Yoga Kurniawan', 'Gagal'),
(3, 'orang baru', 'Gagal'),
(4, 'orang keren', 'Gagal'),
(5, 'gak jelas', 'Gagal'),
(6, 'ronald renaldi baru', NULL),
(7, 'aha', NULL),
(8, 'baru banget', 'Diterima di Bagian Produksi'),
(9, 'tel', 'Diterima di Bagian Produksi'),
(10, 'we', 'Diterima di Bagian Produksi');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE IF NOT EXISTS `kriteria` (
  `KRITERIA_ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_KRITERIA` varchar(255) DEFAULT NULL,
  `PRIORITAS_KRITERIA` decimal(10,3) DEFAULT NULL,
  PRIMARY KEY (`KRITERIA_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`KRITERIA_ID`, `NAMA_KRITERIA`, `PRIORITAS_KRITERIA`) VALUES
(2, 'tes psikologi', 0.076),
(3, 'tes akademik', 0.150),
(4, 'tes kepribadian', 0.178),
(5, 'tes wawancara', 0.242),
(6, 'tes pengetahuan', 0.356);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_pegawai_per_pertanyaan`
--

CREATE TABLE IF NOT EXISTS `nilai_pegawai_per_pertanyaan` (
  `NILAI_PEG_PERTANYAAN_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PERTANYAAN_ID` int(11) DEFAULT NULL,
  `CAPEG_ID` int(11) DEFAULT NULL,
  `NILAI` int(11) DEFAULT NULL,
  PRIMARY KEY (`NILAI_PEG_PERTANYAAN_ID`),
  KEY `FK_RELATIONSHIP_7` (`CAPEG_ID`),
  KEY `FK_RELATIONSHIP_9` (`PERTANYAAN_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=661 ;

--
-- Dumping data for table `nilai_pegawai_per_pertanyaan`
--

INSERT INTO `nilai_pegawai_per_pertanyaan` (`NILAI_PEG_PERTANYAAN_ID`, `PERTANYAAN_ID`, `CAPEG_ID`, `NILAI`) VALUES
(1, 5, 1, 0),
(2, 6, 1, 0),
(3, 7, 1, 0),
(4, 8, 1, 0),
(5, 9, 1, 0),
(6, 10, 1, 0),
(7, 11, 1, 0),
(8, 12, 1, 0),
(9, 13, 1, 0),
(10, 14, 1, 0),
(11, 15, 1, 0),
(12, 16, 1, 0),
(13, 17, 1, 0),
(14, 18, 1, 0),
(15, 19, 1, 0),
(16, 20, 1, 0),
(17, 21, 1, 0),
(18, 22, 1, 0),
(19, 23, 1, 0),
(20, 24, 1, 0),
(21, 25, 1, 0),
(22, 26, 1, 0),
(23, 27, 1, 0),
(24, 28, 1, 0),
(25, 29, 1, 0),
(26, 30, 1, 0),
(27, 31, 1, 0),
(28, 32, 1, 0),
(29, 33, 1, 0),
(30, 34, 1, 0),
(31, 35, 1, 0),
(32, 36, 1, 0),
(33, 37, 1, 0),
(34, 38, 1, 0),
(35, 39, 1, 0),
(36, 40, 1, 0),
(37, 41, 1, 0),
(38, 42, 1, 0),
(39, 43, 1, 0),
(40, 44, 1, 0),
(41, 45, 1, 0),
(42, 46, 1, 0),
(43, 47, 1, 0),
(44, 48, 1, 0),
(45, 49, 1, 0),
(46, 50, 1, 0),
(47, 52, 1, 0),
(48, 53, 1, 0),
(49, 54, 1, 0),
(50, 55, 1, 0),
(51, 56, 1, 0),
(52, 57, 1, 0),
(53, 58, 1, 0),
(54, 59, 1, 0),
(55, 60, 1, 0),
(56, 61, 1, 0),
(57, 62, 1, 0),
(58, 63, 1, 0),
(59, 64, 1, 0),
(60, 65, 1, 0),
(61, 66, 1, 0),
(62, 67, 1, 0),
(63, 68, 1, 0),
(64, 69, 1, 0),
(65, 70, 1, 0),
(66, 71, 1, 0),
(67, 5, 2, 0),
(68, 6, 2, 0),
(69, 7, 2, 0),
(70, 8, 2, 0),
(71, 9, 2, 0),
(72, 10, 2, 0),
(73, 11, 2, 0),
(74, 12, 2, 0),
(75, 13, 2, 0),
(76, 14, 2, 0),
(77, 15, 2, 0),
(78, 16, 2, 0),
(79, 17, 2, 0),
(80, 18, 2, 0),
(81, 19, 2, 0),
(82, 20, 2, 0),
(83, 21, 2, 0),
(84, 22, 2, 0),
(85, 23, 2, 0),
(86, 24, 2, 0),
(87, 25, 2, 0),
(88, 26, 2, 0),
(89, 27, 2, 0),
(90, 28, 2, 0),
(91, 29, 2, 0),
(92, 30, 2, 0),
(93, 31, 2, 0),
(94, 32, 2, 0),
(95, 33, 2, 0),
(96, 34, 2, 0),
(97, 35, 2, 0),
(98, 36, 2, 0),
(99, 37, 2, 0),
(100, 38, 2, 0),
(101, 39, 2, 0),
(102, 40, 2, 0),
(103, 41, 2, 0),
(104, 42, 2, 0),
(105, 43, 2, 0),
(106, 44, 2, 0),
(107, 45, 2, 0),
(108, 46, 2, 0),
(109, 47, 2, 0),
(110, 48, 2, 0),
(111, 49, 2, 0),
(112, 50, 2, 0),
(113, 52, 2, 0),
(114, 53, 2, 0),
(115, 54, 2, 0),
(116, 55, 2, 0),
(117, 56, 2, 0),
(118, 57, 2, 0),
(119, 58, 2, 0),
(120, 59, 2, 0),
(121, 60, 2, 0),
(122, 61, 2, 0),
(123, 62, 2, 0),
(124, 63, 2, 0),
(125, 64, 2, 0),
(126, 65, 2, 0),
(127, 66, 2, 0),
(128, 67, 2, 0),
(129, 68, 2, 0),
(130, 69, 2, 0),
(131, 70, 2, 0),
(132, 71, 2, 0),
(133, 5, 3, 0),
(134, 6, 3, 0),
(135, 7, 3, 0),
(136, 8, 3, 0),
(137, 9, 3, 0),
(138, 10, 3, 0),
(139, 11, 3, 0),
(140, 12, 3, 0),
(141, 13, 3, 0),
(142, 14, 3, 0),
(143, 15, 3, 0),
(144, 16, 3, 0),
(145, 17, 3, 0),
(146, 18, 3, 0),
(147, 19, 3, 0),
(148, 20, 3, 0),
(149, 21, 3, 0),
(150, 22, 3, 0),
(151, 23, 3, 0),
(152, 24, 3, 0),
(153, 25, 3, 0),
(154, 26, 3, 0),
(155, 27, 3, 0),
(156, 28, 3, 0),
(157, 29, 3, 0),
(158, 30, 3, 0),
(159, 31, 3, 0),
(160, 32, 3, 0),
(161, 33, 3, 0),
(162, 34, 3, 0),
(163, 35, 3, 0),
(164, 36, 3, 0),
(165, 37, 3, 0),
(166, 38, 3, 0),
(167, 39, 3, 0),
(168, 40, 3, 0),
(169, 41, 3, 0),
(170, 42, 3, 0),
(171, 43, 3, 0),
(172, 44, 3, 0),
(173, 45, 3, 0),
(174, 46, 3, 0),
(175, 47, 3, 0),
(176, 48, 3, 0),
(177, 49, 3, 0),
(178, 50, 3, 0),
(179, 52, 3, 0),
(180, 53, 3, 0),
(181, 54, 3, 0),
(182, 55, 3, 0),
(183, 56, 3, 0),
(184, 57, 3, 0),
(185, 58, 3, 0),
(186, 59, 3, 0),
(187, 60, 3, 0),
(188, 61, 3, 0),
(189, 62, 3, 0),
(190, 63, 3, 0),
(191, 64, 3, 0),
(192, 65, 3, 0),
(193, 66, 3, 0),
(194, 67, 3, 0),
(195, 68, 3, 0),
(196, 69, 3, 0),
(197, 70, 3, 0),
(198, 71, 3, 0),
(199, 5, 4, 0),
(200, 6, 4, 0),
(201, 7, 4, 0),
(202, 8, 4, 0),
(203, 9, 4, 0),
(204, 10, 4, 0),
(205, 11, 4, 0),
(206, 12, 4, 0),
(207, 13, 4, 0),
(208, 14, 4, 0),
(209, 15, 4, 0),
(210, 16, 4, 0),
(211, 17, 4, 0),
(212, 18, 4, 0),
(213, 19, 4, 0),
(214, 20, 4, 0),
(215, 21, 4, 0),
(216, 22, 4, 0),
(217, 23, 4, 0),
(218, 24, 4, 0),
(219, 25, 4, 0),
(220, 26, 4, 0),
(221, 27, 4, 0),
(222, 28, 4, 0),
(223, 29, 4, 0),
(224, 30, 4, 0),
(225, 31, 4, 0),
(226, 32, 4, 0),
(227, 33, 4, 0),
(228, 34, 4, 0),
(229, 35, 4, 0),
(230, 36, 4, 0),
(231, 37, 4, 0),
(232, 38, 4, 0),
(233, 39, 4, 0),
(234, 40, 4, 0),
(235, 41, 4, 0),
(236, 42, 4, 0),
(237, 43, 4, 0),
(238, 44, 4, 0),
(239, 45, 4, 0),
(240, 46, 4, 0),
(241, 47, 4, 0),
(242, 48, 4, 0),
(243, 49, 4, 0),
(244, 50, 4, 0),
(245, 52, 4, 0),
(246, 53, 4, 0),
(247, 54, 4, 0),
(248, 55, 4, 0),
(249, 56, 4, 0),
(250, 57, 4, 0),
(251, 58, 4, 0),
(252, 59, 4, 0),
(253, 60, 4, 0),
(254, 61, 4, 0),
(255, 62, 4, 0),
(256, 63, 4, 0),
(257, 64, 4, 0),
(258, 65, 4, 0),
(259, 66, 4, 0),
(260, 67, 4, 0),
(261, 68, 4, 0),
(262, 69, 4, 0),
(263, 70, 4, 0),
(264, 71, 4, 0),
(265, 5, 5, 0),
(266, 6, 5, 0),
(267, 7, 5, 0),
(268, 8, 5, 0),
(269, 9, 5, 0),
(270, 10, 5, 0),
(271, 11, 5, 0),
(272, 12, 5, 0),
(273, 13, 5, 0),
(274, 14, 5, 0),
(275, 15, 5, 0),
(276, 16, 5, 0),
(277, 17, 5, 0),
(278, 18, 5, 0),
(279, 19, 5, 0),
(280, 20, 5, 0),
(281, 21, 5, 0),
(282, 22, 5, 0),
(283, 23, 5, 0),
(284, 24, 5, 0),
(285, 25, 5, 0),
(286, 26, 5, 0),
(287, 27, 5, 0),
(288, 28, 5, 0),
(289, 29, 5, 0),
(290, 30, 5, 0),
(291, 31, 5, 0),
(292, 32, 5, 0),
(293, 33, 5, 0),
(294, 34, 5, 0),
(295, 35, 5, 0),
(296, 36, 5, 0),
(297, 37, 5, 0),
(298, 38, 5, 0),
(299, 39, 5, 0),
(300, 40, 5, 0),
(301, 41, 5, 0),
(302, 42, 5, 0),
(303, 43, 5, 0),
(304, 44, 5, 0),
(305, 45, 5, 0),
(306, 46, 5, 0),
(307, 47, 5, 0),
(308, 48, 5, 0),
(309, 49, 5, 0),
(310, 50, 5, 0),
(311, 52, 5, 0),
(312, 53, 5, 0),
(313, 54, 5, 0),
(314, 55, 5, 0),
(315, 56, 5, 0),
(316, 57, 5, 0),
(317, 58, 5, 0),
(318, 59, 5, 0),
(319, 60, 5, 0),
(320, 61, 5, 0),
(321, 62, 5, 0),
(322, 63, 5, 0),
(323, 64, 5, 0),
(324, 65, 5, 0),
(325, 66, 5, 0),
(326, 67, 5, 0),
(327, 68, 5, 0),
(328, 69, 5, 0),
(329, 70, 5, 0),
(330, 71, 5, 0),
(331, 5, 6, 80),
(332, 6, 6, 80),
(333, 7, 6, 80),
(334, 8, 6, 80),
(335, 9, 6, 80),
(336, 10, 6, 80),
(337, 11, 6, 80),
(338, 12, 6, 80),
(339, 13, 6, 80),
(340, 14, 6, 80),
(341, 15, 6, 80),
(342, 16, 6, 80),
(343, 17, 6, 80),
(344, 18, 6, 80),
(345, 19, 6, 80),
(346, 20, 6, 80),
(347, 21, 6, 80),
(348, 22, 6, 80),
(349, 23, 6, 80),
(350, 24, 6, 80),
(351, 25, 6, 80),
(352, 26, 6, 80),
(353, 27, 6, 0),
(354, 28, 6, 0),
(355, 29, 6, 0),
(356, 30, 6, 0),
(357, 31, 6, 0),
(358, 32, 6, 0),
(359, 33, 6, 0),
(360, 34, 6, 0),
(361, 35, 6, 0),
(362, 36, 6, 0),
(363, 37, 6, 0),
(364, 38, 6, 0),
(365, 39, 6, 0),
(366, 40, 6, 0),
(367, 41, 6, 0),
(368, 42, 6, 0),
(369, 43, 6, 0),
(370, 44, 6, 0),
(371, 45, 6, 0),
(372, 46, 6, 0),
(373, 47, 6, 0),
(374, 48, 6, 0),
(375, 49, 6, 0),
(376, 50, 6, 0),
(377, 52, 6, 0),
(378, 53, 6, 0),
(379, 54, 6, 0),
(380, 55, 6, 0),
(381, 56, 6, 0),
(382, 57, 6, 0),
(383, 58, 6, 0),
(384, 59, 6, 0),
(385, 60, 6, 0),
(386, 61, 6, 0),
(387, 62, 6, 0),
(388, 63, 6, 0),
(389, 64, 6, 0),
(390, 65, 6, 0),
(391, 66, 6, 0),
(392, 67, 6, 0),
(393, 68, 6, 0),
(394, 69, 6, 0),
(395, 70, 6, 0),
(396, 71, 6, 0),
(397, 5, 7, NULL),
(398, 6, 7, NULL),
(399, 7, 7, NULL),
(400, 8, 7, NULL),
(401, 9, 7, NULL),
(402, 10, 7, NULL),
(403, 11, 7, NULL),
(404, 12, 7, NULL),
(405, 13, 7, NULL),
(406, 14, 7, NULL),
(407, 15, 7, NULL),
(408, 16, 7, NULL),
(409, 17, 7, NULL),
(410, 18, 7, NULL),
(411, 19, 7, NULL),
(412, 20, 7, NULL),
(413, 21, 7, NULL),
(414, 22, 7, NULL),
(415, 23, 7, NULL),
(416, 24, 7, NULL),
(417, 25, 7, NULL),
(418, 26, 7, NULL),
(419, 27, 7, NULL),
(420, 28, 7, NULL),
(421, 29, 7, NULL),
(422, 30, 7, NULL),
(423, 31, 7, NULL),
(424, 32, 7, NULL),
(425, 33, 7, NULL),
(426, 34, 7, NULL),
(427, 35, 7, NULL),
(428, 36, 7, NULL),
(429, 37, 7, NULL),
(430, 38, 7, NULL),
(431, 39, 7, NULL),
(432, 40, 7, NULL),
(433, 41, 7, NULL),
(434, 42, 7, NULL),
(435, 43, 7, NULL),
(436, 44, 7, NULL),
(437, 45, 7, NULL),
(438, 46, 7, NULL),
(439, 47, 7, NULL),
(440, 48, 7, NULL),
(441, 49, 7, NULL),
(442, 50, 7, NULL),
(443, 52, 7, NULL),
(444, 53, 7, NULL),
(445, 54, 7, NULL),
(446, 55, 7, NULL),
(447, 56, 7, NULL),
(448, 57, 7, NULL),
(449, 58, 7, NULL),
(450, 59, 7, NULL),
(451, 60, 7, NULL),
(452, 61, 7, NULL),
(453, 62, 7, NULL),
(454, 63, 7, NULL),
(455, 64, 7, NULL),
(456, 65, 7, NULL),
(457, 66, 7, NULL),
(458, 67, 7, NULL),
(459, 68, 7, NULL),
(460, 69, 7, NULL),
(461, 70, 7, NULL),
(462, 71, 7, NULL),
(463, 5, 8, 80),
(464, 6, 8, 80),
(465, 7, 8, 80),
(466, 8, 8, 80),
(467, 9, 8, 80),
(468, 10, 8, 80),
(469, 11, 8, 80),
(470, 12, 8, 80),
(471, 13, 8, 80),
(472, 14, 8, 80),
(473, 15, 8, 80),
(474, 16, 8, 80),
(475, 17, 8, 80),
(476, 18, 8, 80),
(477, 19, 8, 80),
(478, 20, 8, 80),
(479, 21, 8, 80),
(480, 22, 8, 80),
(481, 23, 8, 80),
(482, 24, 8, 80),
(483, 25, 8, 80),
(484, 26, 8, 80),
(485, 27, 8, 0),
(486, 28, 8, 0),
(487, 29, 8, 0),
(488, 30, 8, 0),
(489, 31, 8, 0),
(490, 32, 8, 0),
(491, 33, 8, 0),
(492, 34, 8, 0),
(493, 35, 8, 0),
(494, 36, 8, 0),
(495, 37, 8, 0),
(496, 38, 8, 0),
(497, 39, 8, 0),
(498, 40, 8, 0),
(499, 41, 8, 0),
(500, 42, 8, 0),
(501, 43, 8, 0),
(502, 44, 8, 0),
(503, 45, 8, 0),
(504, 46, 8, 0),
(505, 47, 8, 0),
(506, 48, 8, 0),
(507, 49, 8, 0),
(508, 50, 8, 0),
(509, 52, 8, 0),
(510, 53, 8, 0),
(511, 54, 8, 0),
(512, 55, 8, 0),
(513, 56, 8, 0),
(514, 57, 8, 0),
(515, 58, 8, 0),
(516, 59, 8, 0),
(517, 60, 8, 0),
(518, 61, 8, 0),
(519, 62, 8, 0),
(520, 63, 8, 0),
(521, 64, 8, 0),
(522, 65, 8, 0),
(523, 66, 8, 0),
(524, 67, 8, 0),
(525, 68, 8, 0),
(526, 69, 8, 0),
(527, 70, 8, 0),
(528, 71, 8, 0),
(529, 5, 9, 0),
(530, 6, 9, 0),
(531, 7, 9, 0),
(532, 8, 9, 0),
(533, 9, 9, 0),
(534, 10, 9, 0),
(535, 11, 9, 0),
(536, 12, 9, 0),
(537, 13, 9, 0),
(538, 14, 9, 0),
(539, 15, 9, 0),
(540, 16, 9, 0),
(541, 17, 9, 0),
(542, 18, 9, 0),
(543, 19, 9, 0),
(544, 20, 9, 0),
(545, 21, 9, 0),
(546, 22, 9, 0),
(547, 23, 9, 0),
(548, 24, 9, 0),
(549, 25, 9, 0),
(550, 26, 9, 0),
(551, 27, 9, 0),
(552, 28, 9, 0),
(553, 29, 9, 0),
(554, 30, 9, 0),
(555, 31, 9, 0),
(556, 32, 9, 0),
(557, 33, 9, 0),
(558, 34, 9, 0),
(559, 35, 9, 0),
(560, 36, 9, 0),
(561, 37, 9, 0),
(562, 38, 9, 0),
(563, 39, 9, 0),
(564, 40, 9, 0),
(565, 41, 9, 0),
(566, 42, 9, 0),
(567, 43, 9, 0),
(568, 44, 9, 0),
(569, 45, 9, 0),
(570, 46, 9, 0),
(571, 47, 9, 0),
(572, 48, 9, 0),
(573, 49, 9, 80),
(574, 50, 9, 80),
(575, 52, 9, 80),
(576, 53, 9, 80),
(577, 54, 9, 0),
(578, 55, 9, 80),
(579, 56, 9, 80),
(580, 57, 9, 80),
(581, 58, 9, 80),
(582, 59, 9, 80),
(583, 60, 9, 80),
(584, 61, 9, 80),
(585, 62, 9, 80),
(586, 63, 9, 80),
(587, 64, 9, 8),
(588, 65, 9, 0),
(589, 66, 9, 80),
(590, 67, 9, 80),
(591, 68, 9, 80),
(592, 69, 9, 80),
(593, 70, 9, 80),
(594, 71, 9, 80),
(595, 5, 10, 0),
(596, 6, 10, 0),
(597, 7, 10, 0),
(598, 8, 10, 0),
(599, 9, 10, 0),
(600, 10, 10, 0),
(601, 11, 10, 0),
(602, 12, 10, 0),
(603, 13, 10, 0),
(604, 14, 10, 0),
(605, 15, 10, 0),
(606, 16, 10, 0),
(607, 17, 10, 0),
(608, 18, 10, 0),
(609, 19, 10, 0),
(610, 20, 10, 0),
(611, 21, 10, 0),
(612, 22, 10, 0),
(613, 23, 10, 0),
(614, 24, 10, 0),
(615, 25, 10, 0),
(616, 26, 10, 0),
(617, 27, 10, 0),
(618, 28, 10, 0),
(619, 29, 10, 0),
(620, 30, 10, 0),
(621, 31, 10, 0),
(622, 32, 10, 0),
(623, 33, 10, 0),
(624, 34, 10, 0),
(625, 35, 10, 0),
(626, 36, 10, 0),
(627, 37, 10, 0),
(628, 38, 10, 0),
(629, 39, 10, 0),
(630, 40, 10, 0),
(631, 41, 10, 0),
(632, 42, 10, 0),
(633, 43, 10, 0),
(634, 44, 10, 0),
(635, 45, 10, 0),
(636, 46, 10, 0),
(637, 47, 10, 0),
(638, 48, 10, 0),
(639, 49, 10, 0),
(640, 50, 10, 0),
(641, 52, 10, 0),
(642, 53, 10, 0),
(643, 54, 10, 0),
(644, 55, 10, 0),
(645, 56, 10, 0),
(646, 57, 10, 0),
(647, 58, 10, 0),
(648, 59, 10, 0),
(649, 60, 10, 0),
(650, 61, 10, 0),
(651, 62, 10, 0),
(652, 63, 10, 0),
(653, 64, 10, 0),
(654, 65, 10, 0),
(655, 66, 10, 0),
(656, 67, 10, 0),
(657, 68, 10, 0),
(658, 69, 10, 0),
(659, 70, 10, 0),
(660, 71, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE IF NOT EXISTS `penilaian` (
  `PENILAIAN_ID` int(11) NOT NULL AUTO_INCREMENT,
  `KRITERIA_ID` int(11) DEFAULT NULL,
  `SUBKRITERIA_ID` int(11) DEFAULT NULL,
  `BAGIAN_ID` int(11) DEFAULT NULL,
  `CAPEG_ID` int(11) DEFAULT NULL,
  `TOTAL_NILAI` decimal(10,3) NOT NULL,
  PRIMARY KEY (`PENILAIAN_ID`),
  KEY `FK_RELATIONSHIP_1` (`KRITERIA_ID`),
  KEY `FK_RELATIONSHIP_2` (`CAPEG_ID`),
  KEY `FK_RELATIONSHIP_3` (`SUBKRITERIA_ID`),
  KEY `FK_RELATIONSHIP_4` (`BAGIAN_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=346 ;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`PENILAIAN_ID`, `KRITERIA_ID`, `SUBKRITERIA_ID`, `BAGIAN_ID`, `CAPEG_ID`, `TOTAL_NILAI`) VALUES
(76, 3, 15, 3, 4, 0.000),
(77, 2, 10, 3, 4, 0.000),
(78, 4, 20, 3, 4, 0.000),
(79, 5, 25, 3, 4, 0.000),
(80, 6, 30, 3, 4, 0.000),
(81, 3, 15, 4, 4, 0.000),
(82, 2, 10, 4, 4, 0.000),
(83, 4, 20, 4, 4, 0.000),
(84, 5, 25, 4, 4, 0.000),
(85, 6, 30, 4, 4, 0.000),
(86, 3, 15, 2, 4, 0.000),
(87, 2, 10, 2, 4, 0.000),
(88, 4, 20, 2, 4, 0.000),
(89, 5, 25, 2, 4, 0.000),
(90, 6, 30, 2, 4, 0.000),
(91, 3, 15, 3, 5, 0.000),
(92, 2, 10, 3, 5, 0.000),
(93, 4, 20, 3, 5, 0.000),
(94, 5, 25, 3, 5, 0.000),
(95, 6, 30, 3, 5, 0.000),
(96, 3, 15, 4, 5, 0.000),
(97, 2, 10, 4, 5, 0.000),
(98, 4, 20, 4, 5, 0.000),
(99, 5, 25, 4, 5, 0.000),
(100, 6, 30, 4, 5, 0.000),
(101, 3, 15, 2, 5, 0.000),
(102, 2, 10, 2, 5, 0.000),
(103, 4, 20, 2, 5, 0.000),
(104, 5, 25, 2, 5, 0.000),
(105, 6, 30, 2, 5, 0.000),
(121, 3, 15, 3, 1, 0.000),
(122, 2, 10, 3, 1, 0.000),
(123, 4, 20, 3, 1, 0.000),
(124, 5, 25, 3, 1, 0.000),
(125, 6, 30, 3, 1, 0.000),
(126, 3, 15, 4, 1, 0.000),
(127, 2, 10, 4, 1, 0.000),
(128, 4, 20, 4, 1, 0.000),
(129, 5, 25, 4, 1, 0.000),
(130, 6, 30, 4, 1, 0.000),
(131, 3, 15, 2, 1, 0.000),
(132, 2, 10, 2, 1, 0.000),
(133, 4, 20, 2, 1, 0.000),
(134, 5, 25, 2, 1, 0.000),
(135, 6, 30, 2, 1, 0.000),
(136, 3, 15, 3, 2, 0.000),
(137, 2, 10, 3, 2, 0.000),
(138, 4, 20, 3, 2, 0.000),
(139, 5, 25, 3, 2, 0.000),
(140, 6, 30, 3, 2, 0.000),
(141, 3, 15, 4, 2, 0.000),
(142, 2, 10, 4, 2, 0.000),
(143, 4, 20, 4, 2, 0.000),
(144, 5, 25, 4, 2, 0.000),
(145, 6, 30, 4, 2, 0.000),
(146, 3, 15, 2, 2, 0.000),
(147, 2, 10, 2, 2, 0.000),
(148, 4, 20, 2, 2, 0.000),
(149, 5, 25, 2, 2, 0.000),
(150, 6, 30, 2, 2, 0.000),
(151, 3, 15, 3, 3, 0.000),
(152, 2, 10, 3, 3, 0.000),
(153, 4, 20, 3, 3, 0.000),
(154, 5, 25, 3, 3, 0.000),
(155, 6, 30, 3, 3, 0.000),
(156, 3, 15, 4, 3, 0.000),
(157, 2, 10, 4, 3, 0.000),
(158, 4, 20, 4, 3, 0.000),
(159, 5, 25, 4, 3, 0.000),
(160, 6, 30, 4, 3, 0.000),
(161, 3, 15, 2, 3, 0.000),
(162, 2, 10, 2, 3, 0.000),
(163, 4, 20, 2, 3, 0.000),
(164, 5, 25, 2, 3, 0.000),
(165, 6, 30, 2, 3, 0.000),
(256, 3, 12, 3, 6, 0.014),
(257, 2, 7, 3, 6, 0.011),
(258, 4, 19, 3, 6, 0.039),
(259, 5, 24, 3, 6, 0.045),
(260, 6, 29, 3, 6, 0.089),
(261, 3, 15, 4, 6, 0.049),
(262, 2, 10, 4, 6, 0.036),
(263, 4, 20, 4, 6, 0.079),
(264, 5, 25, 4, 6, 0.090),
(265, 6, 30, 4, 6, 0.180),
(266, 3, 15, 2, 6, 0.049),
(267, 2, 10, 2, 6, 0.036),
(268, 4, 20, 2, 6, 0.079),
(269, 5, 25, 2, 6, 0.090),
(270, 6, 30, 2, 6, 0.180),
(286, 3, 12, 3, 8, 0.014),
(287, 2, 7, 3, 8, 0.011),
(288, 4, 19, 3, 8, 0.039),
(289, 5, 24, 3, 8, 0.045),
(290, 6, 29, 3, 8, 0.089),
(291, 3, 15, 4, 8, 0.049),
(292, 2, 10, 4, 8, 0.036),
(293, 4, 20, 4, 8, 0.079),
(294, 5, 25, 4, 8, 0.090),
(295, 6, 30, 4, 8, 0.180),
(296, 3, 15, 2, 8, 0.049),
(297, 2, 10, 2, 8, 0.036),
(298, 4, 20, 2, 8, 0.079),
(299, 5, 25, 2, 8, 0.090),
(300, 6, 30, 2, 8, 0.180),
(316, 3, 15, 3, 9, 0.049),
(317, 2, 10, 3, 9, 0.036),
(318, 4, 20, 3, 9, 0.079),
(319, 5, 25, 3, 9, 0.090),
(320, 6, 30, 3, 9, 0.180),
(321, 3, 15, 4, 9, 0.049),
(322, 2, 10, 4, 9, 0.036),
(323, 4, 20, 4, 9, 0.079),
(324, 5, 25, 4, 9, 0.090),
(325, 6, 30, 4, 9, 0.180),
(326, 3, 12, 2, 9, 0.014),
(327, 2, 8, 2, 9, 0.014),
(328, 4, 19, 2, 9, 0.039),
(329, 5, 24, 2, 9, 0.045),
(330, 6, 29, 2, 9, 0.089),
(331, 3, 15, 3, 10, 0.049),
(332, 2, 10, 3, 10, 0.036),
(333, 4, 20, 3, 10, 0.079),
(334, 5, 25, 3, 10, 0.090),
(335, 6, 30, 3, 10, 0.180),
(336, 3, 15, 4, 10, 0.049),
(337, 2, 10, 4, 10, 0.036),
(338, 4, 20, 4, 10, 0.079),
(339, 5, 25, 4, 10, 0.090),
(340, 6, 30, 4, 10, 0.180),
(341, 3, 15, 2, 10, 0.049),
(342, 2, 10, 2, 10, 0.036),
(343, 4, 20, 2, 10, 0.079),
(344, 5, 25, 2, 10, 0.090),
(345, 6, 30, 2, 10, 0.180);

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--

CREATE TABLE IF NOT EXISTS `pertanyaan` (
  `PERTANYAAN_ID` int(11) NOT NULL AUTO_INCREMENT,
  `BAGIAN_ID` int(11) DEFAULT NULL,
  `KRITERIA_ID` int(11) DEFAULT NULL,
  `NAMA_PERTANYAAN` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`PERTANYAAN_ID`),
  KEY `FK_RELATIONSHIP_5` (`KRITERIA_ID`),
  KEY `FK_RELATIONSHIP_8` (`BAGIAN_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `pertanyaan`
--

INSERT INTO `pertanyaan` (`PERTANYAAN_ID`, `BAGIAN_ID`, `KRITERIA_ID`, `NAMA_PERTANYAAN`) VALUES
(5, 3, 3, 'tes verbal atau bahasa'),
(6, 3, 3, 'tes numerik atau angka'),
(7, 3, 3, 'tes logika'),
(8, 3, 3, 'tes spasial atau gambar'),
(9, 3, 2, 'Test kecerdasan'),
(10, 3, 2, 'Tes kepribadian'),
(11, 3, 2, 'Tes bakat'),
(12, 3, 2, 'Tes minat'),
(13, 3, 2, 'Tes prestasi'),
(14, 3, 4, 'kedewasaan emosi'),
(15, 3, 4, 'kesukaan bergaul'),
(16, 3, 4, 'tanggung jawab'),
(17, 3, 4, 'penyesuaian diri'),
(18, 3, 5, 'prestasi akademik'),
(19, 3, 5, 'kualitas pribadi'),
(20, 3, 5, 'pengalaman kerja dalam bidang produksi'),
(21, 3, 5, 'kompetensi komunikasi'),
(22, 3, 5, 'orientasi karier'),
(23, 3, 6, 'kemampuan dalam melaksanakan tugas produksi'),
(24, 3, 6, 'bertanggung jawab atas pekerjaan'),
(25, 3, 6, 'kemampuan bekerja individu atau team'),
(26, 3, 6, 'ketepatan waktu dalam meyelesaikan tugas'),
(27, 4, 3, 'tes verbal atau bahasa'),
(28, 4, 3, 'tes numerik atau angka'),
(29, 4, 3, 'tes logika'),
(30, 4, 3, 'tes spasial atau gambar'),
(31, 4, 2, 'tes kecerdasan'),
(32, 4, 2, 'Tes kepribadian'),
(33, 4, 2, 'Tes bakat'),
(34, 4, 2, 'Tes minat'),
(35, 4, 2, 'Tes Prestasi'),
(36, 4, 4, 'kedewasaan emosi'),
(37, 4, 4, 'kesukaan bergaul'),
(38, 4, 4, 'tanggung jawab'),
(39, 4, 4, 'penyesuaian diri'),
(40, 4, 5, 'prestasi akademik'),
(41, 4, 5, 'kualitas pribadi'),
(42, 4, 5, 'pengalaman kerja dalam bidang marketing'),
(43, 4, 5, 'kompetensi komunikasi'),
(44, 4, 5, 'orientasi karier'),
(45, 4, 6, 'Kecakapan Berbicara'),
(46, 4, 6, 'Keandalan dalam melaksanakan tugas'),
(47, 4, 6, 'inisiatif'),
(48, 4, 6, 'kreatif'),
(49, 2, 3, 'tes verbal atau bahasa'),
(50, 2, 3, 'tes numerik atau angka'),
(52, 2, 3, 'tes logika'),
(53, 2, 3, 'tes spasial atau gambar'),
(54, 2, 2, 'Test kecerdasan'),
(55, 2, 2, 'Tes kepribadian'),
(56, 2, 2, 'Tes bakat'),
(57, 2, 2, 'Tes minat'),
(58, 2, 2, 'Tes Prestasi'),
(59, 2, 4, 'kedewasaan emosi'),
(60, 2, 4, 'kesukaan bergaul'),
(61, 2, 4, 'tanggung jawab'),
(62, 2, 4, 'penyesuaian diri'),
(63, 2, 5, 'prestasi akademik'),
(64, 2, 5, 'kualitas pribadi'),
(65, 2, 5, 'pengalaman kerja dalam bidang customer'),
(66, 2, 5, 'kompetensi komunikasi'),
(67, 2, 5, 'orientasi karier'),
(68, 2, 6, 'kemampuan dalam melayani pelanggan'),
(69, 2, 6, 'bertanggung jawab atas pekerjaan'),
(70, 2, 6, 'dapat melaksankan tugas dengan cukup'),
(71, 2, 6, 'dedikasi');

-- --------------------------------------------------------

--
-- Table structure for table `role_pengguna`
--

CREATE TABLE IF NOT EXISTS `role_pengguna` (
  `KODEROLE` int(11) NOT NULL AUTO_INCREMENT,
  `ROLE` varchar(255) NOT NULL,
  PRIMARY KEY (`KODEROLE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `role_pengguna`
--

INSERT INTO `role_pengguna` (`KODEROLE`, `ROLE`) VALUES
(1, 'ADMIN'),
(2, 'HRD');

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria`
--

CREATE TABLE IF NOT EXISTS `subkriteria` (
  `SUBKRITERIA_ID` int(11) NOT NULL AUTO_INCREMENT,
  `KRITERIA_ID` int(11) NOT NULL,
  `NAMA_SUBKRITERIA` varchar(255) DEFAULT NULL,
  `PRIORITAS_SUBKRITERIA` decimal(10,3) DEFAULT NULL,
  `BOBOT` int(11) DEFAULT NULL,
  PRIMARY KEY (`SUBKRITERIA_ID`),
  KEY `KRITERIA_ID` (`KRITERIA_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `subkriteria`
--

INSERT INTO `subkriteria` (`SUBKRITERIA_ID`, `KRITERIA_ID`, `NAMA_SUBKRITERIA`, `PRIORITAS_SUBKRITERIA`, `BOBOT`) VALUES
(6, 2, 'sangat bagus', 0.062, 5),
(7, 2, 'baik', 0.125, 4),
(8, 2, 'cukup', 0.164, 3),
(9, 2, 'kurang', 0.215, 2),
(10, 2, 'sangat kurang', 0.433, 1),
(11, 3, 'sangat bagus', 0.062, 5),
(12, 3, 'baik', 0.125, 4),
(13, 3, 'cukup', 0.164, 3),
(14, 3, 'kurang', 0.215, 2),
(15, 3, 'sangat kurang', 0.433, 1),
(16, 4, 'sangat bagus', 0.062, 5),
(17, 4, 'baik', 0.125, 4),
(18, 4, 'cukup', 0.164, 3),
(19, 4, 'kurang', 0.215, 2),
(20, 4, 'sangat kurang', 0.433, 1),
(21, 5, 'sangat bagus', 0.062, 5),
(22, 5, 'baik', 0.125, 4),
(23, 5, 'cukup', 0.164, 3),
(24, 5, 'kurang', 0.215, 2),
(25, 5, 'sangat kurang', 0.433, 1),
(26, 6, 'sangat bagus', 0.062, 5),
(27, 6, 'baik', 0.125, 4),
(28, 6, 'cukup', 0.164, 3),
(29, 6, 'kurang', 0.215, 2),
(30, 6, 'sangat kurang', 0.433, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `USERID` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA` varchar(255) DEFAULT NULL,
  `KODEROLE` int(11) DEFAULT NULL,
  `USERNAME` varchar(255) DEFAULT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`USERID`),
  KEY `KODEROLE` (`KODEROLE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USERID`, `NAMA`, `KODEROLE`, `USERNAME`, `PASSWORD`) VALUES
(3, 'Administrator', 1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(4, 'HRD', 2, 'hrd', '4bf31e6f4b818056eaacb83dff01c9b8');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nilai_pegawai_per_pertanyaan`
--
ALTER TABLE `nilai_pegawai_per_pertanyaan`
  ADD CONSTRAINT `FK_RELATIONSHIP_7` FOREIGN KEY (`CAPEG_ID`) REFERENCES `calon_pegawai` (`CAPEG_ID`),
  ADD CONSTRAINT `FK_RELATIONSHIP_9` FOREIGN KEY (`PERTANYAAN_ID`) REFERENCES `pertanyaan` (`PERTANYAAN_ID`);

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `FK_RELATIONSHIP_1` FOREIGN KEY (`KRITERIA_ID`) REFERENCES `kriteria` (`KRITERIA_ID`),
  ADD CONSTRAINT `FK_RELATIONSHIP_2` FOREIGN KEY (`CAPEG_ID`) REFERENCES `calon_pegawai` (`CAPEG_ID`),
  ADD CONSTRAINT `FK_RELATIONSHIP_3` FOREIGN KEY (`SUBKRITERIA_ID`) REFERENCES `subkriteria` (`SUBKRITERIA_ID`),
  ADD CONSTRAINT `FK_RELATIONSHIP_4` FOREIGN KEY (`BAGIAN_ID`) REFERENCES `bagian` (`BAGIAN_ID`);

--
-- Constraints for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD CONSTRAINT `FK_RELATIONSHIP_5` FOREIGN KEY (`KRITERIA_ID`) REFERENCES `kriteria` (`KRITERIA_ID`),
  ADD CONSTRAINT `FK_RELATIONSHIP_8` FOREIGN KEY (`BAGIAN_ID`) REFERENCES `bagian` (`BAGIAN_ID`);

--
-- Constraints for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD CONSTRAINT `subkriteria_ibfk_1` FOREIGN KEY (`KRITERIA_ID`) REFERENCES `kriteria` (`KRITERIA_ID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`KODEROLE`) REFERENCES `role_pengguna` (`KODEROLE`);
