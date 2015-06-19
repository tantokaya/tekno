-- phpMyAdmin SQL Dump
-- version 4.0.10deb0ubuntu1ppa1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 13, 2015 at 10:49 AM
-- Server version: 5.5.38-0ubuntu0.12.04.1-log
-- PHP Version: 5.4.29-3+deb.sury.org~lucid+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tecnokal_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('6bc3c614afacdbde5a022a778af8f910', '66.102.6.138', 'Mozilla/5.0 (Windows NT 6.1; rv:6.0) Gecko/20110814 Firefox/6.0 Google favicon', 1426208283, ''),
('bb94077b87ceab692a2200c5884e1403', '202.46.3.46', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1426214518, 'a:7:{s:9:"user_data";s:0:"";s:9:"logged_in";s:13:"aingLoginYeuh";s:8:"username";s:4:"adit";s:12:"nama_lengkap";s:18:"Aditya Nursyahbani";s:4:"foto";s:0:"";s:8:"id_level";s:2:"01";s:3:"nip";s:18:"198803272014021001";}'),
('d11a304b98fe0335ed7104ad065ab34c', '202.46.3.46', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 Safari/537.36', 1426211152, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `id_level` varchar(20) NOT NULL,
  `blokir` enum('Y','N') NOT NULL DEFAULT 'N',
  `foto` varchar(50) NOT NULL,
  `nip` varchar(100) DEFAULT NULL,
  `wp_code` char(16) NOT NULL,
  `hp` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`username`, `password`, `nama_lengkap`, `id_level`, `blokir`, `foto`, `nip`, `wp_code`, `hp`, `email`) VALUES
('adit', '486b6c6b267bc61677367eb6b6458764', 'Aditya Nursyahbani', '01', 'N', '', '198803272014021001', 'WP-2.1.0', '08561500166', 'gudhel@aditya-nursyahbani.com'),
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', '01', 'N', '', '1001111', '', '', ''),
('amin', 'e10adc3949ba59abbe56e057f20f883e', 'Amin Krisna', '02', 'N', '', '1001112', '', '', ''),
('budi', '456b39e6cf4fdc9bda6b84b0a0b557dd', 'Budiman Wijayanto', '03', 'N', '', '1001113', '', '', ''),
('rangkuti', '81dc9bdb52d04dc20036dbd8313ed055', 'Rangkuti  Sembodo', '01', 'N', '', '1001114', 'WP-2.0.1', '08568838783', 'rang@gmail.com'),
('tanto', '839bf59995cd3c79fd9d4b499ecae9c6', 'Hartanto Kurniawan', '01', 'N', '', '1001115', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_agenda`
--

CREATE TABLE IF NOT EXISTS `tbl_agenda` (
  `agenda_id` int(10) NOT NULL AUTO_INCREMENT,
  `agenda_code` char(16) NOT NULL,
  `agenda_name` varchar(200) NOT NULL,
  `agenda_desc` text NOT NULL,
  `agenda_mulai` date NOT NULL,
  `agenda_akhir` date NOT NULL,
  `agenda_lokasi` varchar(200) NOT NULL,
  `mitra_code` char(16) NOT NULL,
  `nip` char(16) NOT NULL,
  PRIMARY KEY (`agenda_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `tbl_agenda`
--

INSERT INTO `tbl_agenda` (`agenda_id`, `agenda_code`, `agenda_name`, `agenda_desc`, `agenda_mulai`, `agenda_akhir`, `agenda_lokasi`, `mitra_code`, `nip`) VALUES
(10, 'AG00000001', 'ADSFADS', 'DSAFDSF', '0000-00-00', '0000-00-00', 'dsafdsf', 'MT00000001', '0'),
(11, 'AG00000002', 'DAFDS', 'ASDFASFDF', '0000-00-00', '0000-00-00', 'sadfsdaf', 'MT00000001', '1001111'),
(13, 'AG00000003', 'BRAM SUNATAN', 'SUNATAN SI BRAM', '2015-03-14', '2015-03-15', 'Jakarta', 'MT00000001', '1001111'),
(14, 'AG00000004', 'UNDANGAN PERESMIAN', 'PERESMIAN KANTOR KEPENGURUSAN TAMAN TEKNO', '2015-03-16', '2015-03-17', 'Bandung', 'MT00000001', '1001111'),
(15, 'AG00000005', 'UNDANGAN KAWINAN', 'LKSJFKLASJKFL;JSKL;FJSDKFJKLS;JF;KLADSJFKL;SDJ;FKLJAKLF;JDS;LFKJADSKL;FDASL;JKFL;JDSKLF;JDSLK;FJDSKLJFKDSLJFKL;DSJFKLSJFKL;JKLKLJSALK;FJKASLJF', '2015-03-12', '2015-03-27', '', 'MT00000002', '1001111'),
(16, 'AG00000006', 'RAPAT INISIASI', 'TES KETERANGAN', '2015-03-12', '2015-03-12', 'R Rapat 1', 'MT00000001', '1001111'),
(17, 'AG00000007', 'RAPAT LAPORAN PENDAHULUAN', 'TES', '2015-03-16', '2015-03-17', 'R Rapat 1', 'MT00000001', '1001111'),
(18, 'AG00000008', 'RAPAT ANGGARAN', 'TES', '2015-03-17', '2015-03-17', 'R Rapat 2', 'MT00000002', '1001111'),
(19, 'AG00000009', 'UNDANGAN RAPAT', 'TES', '2015-03-13', '2015-03-13', 'R Rapat 1', 'MT00000001', '1988032720140210');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chat`
--

CREATE TABLE IF NOT EXISTS `tbl_chat` (
  `id_chat` int(99) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pesan` text NOT NULL,
  PRIMARY KEY (`id_chat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_chat`
--

INSERT INTO `tbl_chat` (`id_chat`, `user`, `waktu`, `pesan`) VALUES
(1, 'Administrator', '2015-03-09 00:46:47', 'test'),
(2, 'Administrator', '2015-03-09 01:09:15', 'Udah senin aja'),
(3, 'Administrator', '2015-03-09 01:40:48', 'test'),
(4, 'Administrator', '2015-03-09 01:40:59', 'masa sih'),
(5, 'Administrator', '2015-03-09 01:41:10', 'masa sih'),
(6, 'Hartanto Kurniawan', '2015-03-09 02:10:55', 'Pagi broo...'),
(7, 'Aditya Nursyahbani', '2015-03-09 04:29:06', 'pagi juga bro...'),
(8, 'Administrator', '2015-03-11 02:31:40', 'Test bram');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dokumen`
--

CREATE TABLE IF NOT EXISTS `tbl_dokumen` (
  `dok_id` int(10) NOT NULL AUTO_INCREMENT,
  `dok_code` char(16) NOT NULL,
  `dok_judul` varchar(100) NOT NULL,
  `dok_desc` text NOT NULL,
  `dok_file_1` varchar(50) NOT NULL,
  `dok_file_2` varchar(50) NOT NULL,
  `dok_file_3` varchar(50) NOT NULL,
  `nip` char(16) NOT NULL,
  PRIMARY KEY (`dok_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_icon`
--

CREATE TABLE IF NOT EXISTS `tbl_icon` (
  `icon_id` int(10) NOT NULL AUTO_INCREMENT,
  `icon_name` varchar(30) NOT NULL,
  PRIMARY KEY (`icon_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `tbl_icon`
--

INSERT INTO `tbl_icon` (`icon_id`, `icon_name`) VALUES
(1, 'icon-adjust'),
(2, 'icon-asterisk'),
(3, 'icon-ban-circle'),
(4, 'icon-bar-chart'),
(5, 'icon-barcode'),
(6, 'icon-beaker'),
(7, 'icon-beer'),
(8, 'icon-bell'),
(9, 'icon-bell-alt'),
(10, 'icon-bolt'),
(11, 'icon-book'),
(12, 'icon-bookmark'),
(13, 'icon-bookmark-empty'),
(14, 'icon-briefcase'),
(15, 'icon-bullhorn'),
(16, 'icon-calendar'),
(17, 'icon-camera'),
(18, 'icon-camera-retro'),
(19, 'icon-certificate'),
(20, 'icon-check'),
(21, 'icon-check_empty'),
(22, 'icon-circle'),
(23, 'icon-circle-blank'),
(24, 'icon-cloud'),
(25, 'icon-cloud-download'),
(26, 'icon-cloud-upload'),
(27, 'icon-coffee'),
(28, 'icon-cog'),
(29, 'icon-cogs'),
(30, 'icon-comment'),
(31, 'icon-comment-alt'),
(32, 'icon-comments'),
(33, 'icon-comments-alt'),
(34, 'icon-credit-card'),
(35, 'icon-dashboard'),
(36, 'icon-desktop'),
(37, 'icon-dowload'),
(38, 'icon-download-alt'),
(39, 'icon-edit');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lampiran`
--

CREATE TABLE IF NOT EXISTS `tbl_lampiran` (
  `lampiran_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `lampiran_nama` text,
  `lampiran_size` int(11) DEFAULT NULL,
  `lampiran_ext` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`lampiran_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_lampiran`
--

INSERT INTO `tbl_lampiran` (`lampiran_id`, `lampiran_nama`, `lampiran_size`, `lampiran_ext`) VALUES
(1, 'drh_petunjuk.pdf', 179546, 'pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lampiran_agenda`
--

CREATE TABLE IF NOT EXISTS `tbl_lampiran_agenda` (
  `lampiran_agenda_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `agenda_code` char(20) NOT NULL,
  `lampiran_id` bigint(20) NOT NULL,
  PRIMARY KEY (`lampiran_agenda_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_lampiran_agenda`
--

INSERT INTO `tbl_lampiran_agenda` (`lampiran_agenda_id`, `agenda_code`, `lampiran_id`) VALUES
(1, 'AG00000009', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_level`
--

CREATE TABLE IF NOT EXISTS `tbl_level` (
  `id_level` char(2) NOT NULL,
  `level` char(30) NOT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_level`
--

INSERT INTO `tbl_level` (`id_level`, `level`) VALUES
('01', 'Super Admin'),
('02', 'Admin'),
('03', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mitra`
--

CREATE TABLE IF NOT EXISTS `tbl_mitra` (
  `mitra_id` int(10) NOT NULL AUTO_INCREMENT,
  `mitra_code` char(16) NOT NULL,
  `mitra_name` varchar(100) NOT NULL,
  `mitra_addr` varchar(200) NOT NULL,
  `mitra_telp` varchar(200) NOT NULL,
  `mitra_email` varchar(200) NOT NULL,
  `mitra_desc` text NOT NULL,
  `mitra_cp` varchar(100) NOT NULL,
  PRIMARY KEY (`mitra_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_mitra`
--

INSERT INTO `tbl_mitra` (`mitra_id`, `mitra_code`, `mitra_name`, `mitra_addr`, `mitra_telp`, `mitra_email`, `mitra_desc`, `mitra_cp`) VALUES
(1, 'MT00000001', 'PEMKOT BOGOR', 'JL RAYA BOGOR', '025199388', 'pemkot@bogor.go.id', '"LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT, SED DO EIUSMOD TEMPOR INCIDIDUNT UT LABORE ET DOLORE MAGNA ALIQUA. UT ENIM AD MINIM VENIAM, QUIS NOSTRUD EXERCITATION ULLAMCO LABORIS NISI UT ALIQUIP EX EA COMMODO CONSEQUAT. DUIS AUTE IRURE DOLOR IN REPREHENDERIT IN VOLUPTATE VELIT ESSE CILLUM DOLORE EU FUGIAT NULLA PARIATUR. EXCEPTEUR SINT OCCAECAT CUPIDATAT NON PROIDENT, SUNT IN CULPA QUI OFFICIA DESERUNT MOLLIT ANIM ID EST LABORUM."', 'BPK RUDY'),
(2, 'MT00000002', 'PEMKAB MALANG', 'JL MALANG RAYA NO 01', '031994884', '', '"LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT, SED DO EIUSMOD TEMPOR INCIDIDUNT UT LABORE ET DOLORE MAGNA ALIQUA. UT ENIM AD MINIM VENIAM, QUIS NOSTRUD EXERCITATION ULLAMCO LABORIS NISI UT ALIQUIP EX EA COMMODO CONSEQUAT. DUIS AUTE IRURE DOLOR IN REPREHENDERIT IN VOLUPTATE VELIT ESSE CILLUM DOLORE EU FUGIAT NULLA PARIATUR. EXCEPTEUR SINT OCCAECAT CUPIDATAT NON PROIDENT, SUNT IN CULPA QUI OFFICIA DESERUNT MOLLIT ANIM ID EST LABORUM."', 'BPK FERRI');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stkk`
--

CREATE TABLE IF NOT EXISTS `tbl_stkk` (
  `stkk_id` int(10) NOT NULL AUTO_INCREMENT,
  `stkk_code` char(16) NOT NULL,
  `stkk_name` varchar(200) NOT NULL,
  `wp_code` char(16) NOT NULL,
  `stkk_desc` text NOT NULL,
  PRIMARY KEY (`stkk_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_stkk`
--

INSERT INTO `tbl_stkk` (`stkk_id`, `stkk_code`, `stkk_name`, `wp_code`, `stkk_desc`) VALUES
(4, 'STKK-01', 'APLIKASI KOLABORASI', 'WP-2.0.1', '"LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT, SED DO EIUSMOD TEMPOR INCIDIDUNT UT LABORE ET DOLORE MAGNA ALIQUA. UT ENIM AD MINIM VENIAM, QUIS NOSTRUD EXERCITATION ULLAMCO LABORIS NISI UT ALIQUIP EX EA COMMODO CONSEQUAT. DUIS AUTE IRURE DOLOR IN REPREHENDERIT IN VOLUPTATE VELIT ESSE CILLUM DOLORE EU FUGIAT NULLA PARIATUR. EXCEPTEUR SINT OCCAECAT CUPIDATAT NON PROIDENT, SUNT IN CULPA QUI OFFICIA DESERUNT MOLLIT ANIM ID EST LABORUM."');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tugas`
--

CREATE TABLE IF NOT EXISTS `tbl_tugas` (
  `tugas_id` int(16) NOT NULL AUTO_INCREMENT,
  `tugas_code` char(16) NOT NULL,
  `tugas_name` varchar(200) NOT NULL,
  `icon_id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`tugas_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tbl_tugas`
--

INSERT INTO `tbl_tugas` (`tugas_id`, `tugas_code`, `tugas_name`, `icon_id`, `username`) VALUES
(13, 'TU000000002', 'Memberikan tugas ke divisi pengembangan', 31, 'admin'),
(14, 'TU000000003', 'Membeli peralatan jaringan', 4, 'admin'),
(15, 'TU000000004', 'Buat manual book aplikasi siimeral', 11, 'admin'),
(16, 'TU000000005', 'Laporan pajak', 10, 'admin'),
(17, 'TU000000006', 'Berkas SPPT belum ketemu', 15, 'tanto');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wbs`
--

CREATE TABLE IF NOT EXISTS `tbl_wbs` (
  `wbs_id` int(10) NOT NULL AUTO_INCREMENT,
  `wbs_code` char(16) NOT NULL,
  `wbs_name` varchar(200) NOT NULL,
  `wbs_desc` text NOT NULL,
  PRIMARY KEY (`wbs_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_wbs`
--

INSERT INTO `tbl_wbs` (`wbs_id`, `wbs_code`, `wbs_name`, `wbs_desc`) VALUES
(1, 'WBS-2.0', 'PENGEMBANGAN SISTEM', 'DIVISI PENGEMBANGAN SISTEM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wp`
--

CREATE TABLE IF NOT EXISTS `tbl_wp` (
  `wp_id` int(10) NOT NULL AUTO_INCREMENT,
  `wp_code` char(16) NOT NULL,
  `wp_name` varchar(200) NOT NULL,
  `wp_desc` text NOT NULL,
  `wbs_code` char(16) NOT NULL,
  PRIMARY KEY (`wp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_wp`
--

INSERT INTO `tbl_wp` (`wp_id`, `wp_code`, `wp_name`, `wp_desc`, `wbs_code`) VALUES
(2, 'WP-2.0.1', 'E-GOVERNMENT', 'BERTUJUAN MENGINVENTARISIR APLIKASI APA SAJA YANG DIBUTUHKAN OLEH PEMDA BERDASARKAN BLUEPRINT DARI KEMENKOMINFO, PENGGUNAAN MASTER DATA, DENGAN MEMPERTIMBANGKAN KOMPETITOR DAN POSITIONING PADA SISI PENGEMBANGAN SISTEM (COMPLIMENTARY), INTEGRASI SISTEM, EIS, DSS, DAN SETERUSNYA. DAERAH MITRA : 2 (KOTA BOGOR DAN KABUPATEN BOJONEGORO)', 'WBS2.0'),
(3, 'WP-2.1.0', 'PORTAL POTENSI', 'BERTUJUAN MENGUASAI ALTERNATIF TEKNOLOGI APA SAJA YANG DIPERGUNAKAN DAN DIKEMBANGKAN PADA PORTAL POTENSI (CONTOH : IR, INDEXING, ANALYZER, DLL) DENGAN MEMPERTIMBANGKAN ROAD MAP PENGEMBANGAN FITUR-FITUR PORTAL POTENSI ITU SENDIRI, PENINGKATAN JUMLAH PENGGUNA DAN HIT RATE, PENYAJIAN DATA GEOSPASIAL, DENGAN ORIENTASI DIMANA KOMPONEN-KOMPONEN YANG ADA BISA DIMAKSIMALKAN PENGGUNAANNYA. DILAKUKAN TIDAK HANYA BERFOKUS PADA BAGIAN IMPLEMENTASI SAJA, TETAPI JUGA PENDALAMAN TEORI TENTANG PROSES YANG TERJADI DI DALAM SISTEM.', 'WBS-2.0'),
(4, 'WP-2.1.1', 'MOBILE PROGRAMMING', 'BERTUJUAN UNTUK MENGIKUTI TREN PERKEMBANGAN GLOBAL DIMANA SAAT INI CENDERUNG MENGARAH KEPADA PERANGKAT BERGERAK.  PROTOTIPE YANG DIKEMBANGKAN AKAN DIIMPLEMENTASIKAN PADA BEBERAPA DAERAH PERCONTOHAN DENGAN TIDAK MENGESAMPINGKAN POTENSI INTEGRASI DENGAN SISTEM YANG SUDAH ADA', 'WBS-2.0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
