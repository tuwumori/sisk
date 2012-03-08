-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 08. Maret 2012 jam 19:22
-- Versi Server: 5.0.67
-- Versi PHP: 5.2.6

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
-- Struktur dari tabel `bagian`
--

CREATE TABLE IF NOT EXISTS `bagian` (
  `BAGIAN_ID` int(11) NOT NULL auto_increment,
  `NAMA_BAGIAN` varchar(255) default NULL,
  `NILAI_MINIMUM` decimal(10,2) default NULL,
  PRIMARY KEY  (`BAGIAN_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `bagian`
--

INSERT INTO `bagian` (`BAGIAN_ID`, `NAMA_BAGIAN`, `NILAI_MINIMUM`) VALUES
(2, 'Bagian Customer', 0.20),
(3, 'Bagian Produksi', 0.20),
(4, 'Bagian Marketing', 0.20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `calon_pegawai`
--

CREATE TABLE IF NOT EXISTS `calon_pegawai` (
  `CAPEG_ID` int(11) NOT NULL auto_increment,
  `NAMA_CAPEG` varchar(255) default NULL,
  `BAGIAN_ID` int(11) NOT NULL,
  `NILAI_PEGAWAI` varchar(255) NOT NULL,
  PRIMARY KEY  (`CAPEG_ID`),
  KEY `BAGIAN_ID` (`BAGIAN_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `calon_pegawai`
--

INSERT INTO `calon_pegawai` (`CAPEG_ID`, `NAMA_CAPEG`, `BAGIAN_ID`, `NILAI_PEGAWAI`) VALUES
(1, 'Ronald Renaldi', 2, '0.259');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE IF NOT EXISTS `kriteria` (
  `KRITERIA_ID` int(11) NOT NULL auto_increment,
  `NAMA_KRITERIA` varchar(255) default NULL,
  `PRIORITAS_KRITERIA` decimal(10,3) default NULL,
  PRIMARY KEY  (`KRITERIA_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`KRITERIA_ID`, `NAMA_KRITERIA`, `PRIORITAS_KRITERIA`) VALUES
(2, 'tes psikologi', 0.076),
(3, 'tes akademik', 0.150),
(4, 'tes kepribadian', 0.178),
(5, 'tes wawancara', 0.242),
(6, 'tes pengetahuan', 0.356);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian`
--

CREATE TABLE IF NOT EXISTS `penilaian` (
  `PENILAIAN_ID` int(11) NOT NULL auto_increment,
  `KRITERIA_ID` int(11) default NULL,
  `SUBKRITERIA_ID` int(11) default NULL,
  `CAPEG_ID` int(11) default NULL,
  `TOTAL_NILAI` decimal(10,3) NOT NULL,
  PRIMARY KEY  (`PENILAIAN_ID`),
  KEY `FK_RELATIONSHIP_1` (`KRITERIA_ID`),
  KEY `FK_RELATIONSHIP_2` (`CAPEG_ID`),
  KEY `FK_RELATIONSHIP_3` (`SUBKRITERIA_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data untuk tabel `penilaian`
--

INSERT INTO `penilaian` (`PENILAIAN_ID`, `KRITERIA_ID`, `SUBKRITERIA_ID`, `CAPEG_ID`, `TOTAL_NILAI`) VALUES
(16, 2, 6, 1, 0.005),
(17, 3, 12, 1, 0.019),
(18, 4, 18, 1, 0.029),
(19, 5, 24, 1, 0.052),
(20, 6, 30, 1, 0.154);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_pengguna`
--

CREATE TABLE IF NOT EXISTS `role_pengguna` (
  `KODEROLE` int(11) NOT NULL auto_increment,
  `ROLE` varchar(255) NOT NULL,
  PRIMARY KEY  (`KODEROLE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `role_pengguna`
--

INSERT INTO `role_pengguna` (`KODEROLE`, `ROLE`) VALUES
(1, 'ADMIN'),
(2, 'HRD');

-- --------------------------------------------------------

--
-- Struktur dari tabel `subkriteria`
--

CREATE TABLE IF NOT EXISTS `subkriteria` (
  `SUBKRITERIA_ID` int(11) NOT NULL auto_increment,
  `KRITERIA_ID` int(11) NOT NULL,
  `NAMA_SUBKRITERIA` varchar(255) default NULL,
  `PRIORITAS_SUBKRITERIA` decimal(10,3) default NULL,
  PRIMARY KEY  (`SUBKRITERIA_ID`),
  KEY `KRITERIA_ID` (`KRITERIA_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data untuk tabel `subkriteria`
--

INSERT INTO `subkriteria` (`SUBKRITERIA_ID`, `KRITERIA_ID`, `NAMA_SUBKRITERIA`, `PRIORITAS_SUBKRITERIA`) VALUES
(6, 2, 'sangat bagus', 0.062),
(7, 2, 'baik', 0.125),
(8, 2, 'cukup', 0.164),
(9, 2, 'kurang', 0.215),
(10, 2, 'sangat kurang', 0.433),
(11, 3, 'sangat bagus', 0.062),
(12, 3, 'baik', 0.125),
(13, 3, 'cukup', 0.164),
(14, 3, 'kurang', 0.215),
(15, 3, 'sangat kurang', 0.433),
(16, 4, 'sangat bagus', 0.062),
(17, 4, 'baik', 0.125),
(18, 4, 'cukup', 0.164),
(19, 4, 'kurang', 0.215),
(20, 4, 'sangat kurang', 0.433),
(21, 5, 'sangat bagus', 0.062),
(22, 5, 'baik', 0.125),
(23, 5, 'cukup', 0.164),
(24, 5, 'kurang', 0.215),
(25, 5, 'sangat kurang', 0.433),
(26, 6, 'sangat bagus', 0.062),
(27, 6, 'baik', 0.125),
(28, 6, 'cukup', 0.164),
(29, 6, 'kurang', 0.215),
(30, 6, 'sangat kurang', 0.433);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `USERID` int(11) NOT NULL auto_increment,
  `NAMA` varchar(255) default NULL,
  `KODEROLE` int(11) default NULL,
  `USERNAME` varchar(255) default NULL,
  `PASSWORD` varchar(255) default NULL,
  PRIMARY KEY  (`USERID`),
  KEY `KODEROLE` (`KODEROLE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`USERID`, `NAMA`, `KODEROLE`, `USERNAME`, `PASSWORD`) VALUES
(3, 'Administrator', 1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(4, 'HRD', 2, 'hrd', '4bf31e6f4b818056eaacb83dff01c9b8');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `calon_pegawai`
--
ALTER TABLE `calon_pegawai`
  ADD CONSTRAINT `calon_pegawai_ibfk_1` FOREIGN KEY (`BAGIAN_ID`) REFERENCES `bagian` (`BAGIAN_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_3` FOREIGN KEY (`CAPEG_ID`) REFERENCES `calon_pegawai` (`CAPEG_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`KRITERIA_ID`) REFERENCES `kriteria` (`KRITERIA_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`SUBKRITERIA_ID`) REFERENCES `subkriteria` (`SUBKRITERIA_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD CONSTRAINT `subkriteria_ibfk_1` FOREIGN KEY (`KRITERIA_ID`) REFERENCES `kriteria` (`KRITERIA_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`KODEROLE`) REFERENCES `role_pengguna` (`KODEROLE`) ON DELETE CASCADE ON UPDATE CASCADE;
