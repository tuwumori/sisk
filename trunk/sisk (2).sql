-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 22. Januari 2012 jam 11:44
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
  `STATUS_ID` int(11) NOT NULL,
  `NAMA_CAPEG` varchar(255) default NULL,
  `STATUS_PEGAWAI` decimal(1,0) default NULL,
  PRIMARY KEY  (`CAPEG_ID`),
  KEY `STATUS_ID` (`STATUS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data untuk tabel `calon_pegawai`
--


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
(2, 'tes psikologi', 0.084),
(3, 'tes akademik', 0.113),
(4, 'tes kepribadian', 0.182),
(5, 'tes wawancara', 0.207),
(6, 'tes pengetahuan', 0.415);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_pegawai_per_pertanyaan`
--

CREATE TABLE IF NOT EXISTS `nilai_pegawai_per_pertanyaan` (
  `NILAI_PEG_PERTANYAAN_ID` int(11) NOT NULL auto_increment,
  `PERTANYAAN_ID` int(11) default NULL,
  `CAPEG_ID` int(11) default NULL,
  `NILAI` int(11) default NULL,
  PRIMARY KEY  (`NILAI_PEG_PERTANYAAN_ID`),
  KEY `FK_RELATIONSHIP_7` (`CAPEG_ID`),
  KEY `FK_RELATIONSHIP_9` (`PERTANYAAN_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data untuk tabel `nilai_pegawai_per_pertanyaan`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian`
--

CREATE TABLE IF NOT EXISTS `penilaian` (
  `PENILAIAN_ID` int(11) NOT NULL auto_increment,
  `KRITERIA_ID` int(11) default NULL,
  `SUBKRITERIA_ID` int(11) default NULL,
  `BAGIAN_ID` int(11) default NULL,
  `CAPEG_ID` int(11) default NULL,
  `TOTAL_NILAI` decimal(10,0) NOT NULL,
  PRIMARY KEY  (`PENILAIAN_ID`),
  KEY `FK_RELATIONSHIP_1` (`KRITERIA_ID`),
  KEY `FK_RELATIONSHIP_2` (`CAPEG_ID`),
  KEY `FK_RELATIONSHIP_3` (`SUBKRITERIA_ID`),
  KEY `FK_RELATIONSHIP_4` (`BAGIAN_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data untuk tabel `penilaian`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `pertanyaan`
--

CREATE TABLE IF NOT EXISTS `pertanyaan` (
  `PERTANYAAN_ID` int(11) NOT NULL auto_increment,
  `BAGIAN_ID` int(11) default NULL,
  `KRITERIA_ID` int(11) default NULL,
  `NAMA_PERTANYAAN` varchar(255) default NULL,
  PRIMARY KEY  (`PERTANYAAN_ID`),
  KEY `FK_RELATIONSHIP_5` (`KRITERIA_ID`),
  KEY `FK_RELATIONSHIP_8` (`BAGIAN_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

--
-- Dumping data untuk tabel `pertanyaan`
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
-- Struktur dari tabel `status_penerimaan`
--

CREATE TABLE IF NOT EXISTS `status_penerimaan` (
  `STATUS_ID` int(11) NOT NULL auto_increment,
  `STATUS` varchar(225) NOT NULL,
  PRIMARY KEY  (`STATUS_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `status_penerimaan`
--

INSERT INTO `status_penerimaan` (`STATUS_ID`, `STATUS`) VALUES
(1, 'DITERIMA DI BAGIAN CUSTOMER'),
(2, 'DITERIMA DI BAGIAN PRODUKSI'),
(3, 'DITERIMA DI BAGIAN MARKETING'),
(4, 'GAGAL');

-- --------------------------------------------------------

--
-- Struktur dari tabel `subkriteria`
--

CREATE TABLE IF NOT EXISTS `subkriteria` (
  `SUBKRITERIA_ID` int(11) NOT NULL auto_increment,
  `KRITERIA_ID` int(11) NOT NULL,
  `NAMA_SUBKRITERIA` varchar(255) default NULL,
  `PRIORITAS_SUBKRITERIA` decimal(10,3) default NULL,
  `BOBOT` int(11) default NULL,
  PRIMARY KEY  (`SUBKRITERIA_ID`),
  KEY `KRITERIA_ID` (`KRITERIA_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data untuk tabel `subkriteria`
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
(4, 'HRD', 2, 'hrd', '393c7e33e91519e87e1894cbc9dcd8eb');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `calon_pegawai`
--
ALTER TABLE `calon_pegawai`
  ADD CONSTRAINT `calon_pegawai_ibfk_1` FOREIGN KEY (`STATUS_ID`) REFERENCES `status_penerimaan` (`STATUS_ID`);

--
-- Ketidakleluasaan untuk tabel `nilai_pegawai_per_pertanyaan`
--
ALTER TABLE `nilai_pegawai_per_pertanyaan`
  ADD CONSTRAINT `FK_RELATIONSHIP_7` FOREIGN KEY (`CAPEG_ID`) REFERENCES `calon_pegawai` (`CAPEG_ID`),
  ADD CONSTRAINT `FK_RELATIONSHIP_9` FOREIGN KEY (`PERTANYAAN_ID`) REFERENCES `pertanyaan` (`PERTANYAAN_ID`);

--
-- Ketidakleluasaan untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `FK_RELATIONSHIP_1` FOREIGN KEY (`KRITERIA_ID`) REFERENCES `kriteria` (`KRITERIA_ID`),
  ADD CONSTRAINT `FK_RELATIONSHIP_2` FOREIGN KEY (`CAPEG_ID`) REFERENCES `calon_pegawai` (`CAPEG_ID`),
  ADD CONSTRAINT `FK_RELATIONSHIP_3` FOREIGN KEY (`SUBKRITERIA_ID`) REFERENCES `subkriteria` (`SUBKRITERIA_ID`),
  ADD CONSTRAINT `FK_RELATIONSHIP_4` FOREIGN KEY (`BAGIAN_ID`) REFERENCES `bagian` (`BAGIAN_ID`);

--
-- Ketidakleluasaan untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD CONSTRAINT `FK_RELATIONSHIP_5` FOREIGN KEY (`KRITERIA_ID`) REFERENCES `kriteria` (`KRITERIA_ID`),
  ADD CONSTRAINT `FK_RELATIONSHIP_8` FOREIGN KEY (`BAGIAN_ID`) REFERENCES `bagian` (`BAGIAN_ID`);

--
-- Ketidakleluasaan untuk tabel `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD CONSTRAINT `subkriteria_ibfk_1` FOREIGN KEY (`KRITERIA_ID`) REFERENCES `kriteria` (`KRITERIA_ID`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`KODEROLE`) REFERENCES `role_pengguna` (`KODEROLE`);
