-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2026 at 05:11 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_user`
--

-- --------------------------------------------------------

--
-- Table structure for table `gambar`
--

CREATE TABLE IF NOT EXISTS `gambar` (
`id_gambar` int(80) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `gambar`
--

INSERT INTO `gambar` (`id_gambar`, `gambar`) VALUES
(23, 'uy.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `gambar2`
--

CREATE TABLE IF NOT EXISTS `gambar2` (
`id_gambar` int(100) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `gambar2`
--

INSERT INTO `gambar2` (`id_gambar`, `gambar`) VALUES
(16, 'bh.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_header`
--

CREATE TABLE IF NOT EXISTS `tb_header` (
`id_gambar` int(50) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `tb_header`
--

INSERT INTO `tb_header` (`id_gambar`, `gambar`) VALUES
(47, 'mb4.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemberitahuan`
--

CREATE TABLE IF NOT EXISTS `tb_pemberitahuan` (
`id_gambar` int(30) NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tb_pemberitahuan`
--

INSERT INTO `tb_pemberitahuan` (`id_gambar`, `gambar`) VALUES
(11, 'WhatsApp Image 2025-08-24 at 12.26.55.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sidebar`
--

CREATE TABLE IF NOT EXISTS `tb_sidebar` (
`id_gambar` int(30) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `tb_sidebar`
--

INSERT INTO `tb_sidebar` (`id_gambar`, `gambar`) VALUES
(39, 'WhatsApp Image 2026-01-25 at 12.00.32.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
`id` int(13) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `level` char(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `nama`, `level`) VALUES
(20, 'admin', '$2y$10$jRQne0XexAURLV9q8ZoY0.mkQBzzwE.PasDQcqR9mRJZMhM2Zb5Pm', 'Candra', '1'),
(21, 'admin123', '$2y$10$n4c/SY05aaMeNj/LARNTHO71VjYZFZMFYDZCpbwer2qqXiIwjESq.', 'Raka Candra', '2');

-- --------------------------------------------------------

--
-- Table structure for table `toy`
--

CREATE TABLE IF NOT EXISTS `toy` (
`id` int(80) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Jenis_Kelamin` varchar(200) NOT NULL,
  `Kursus` varchar(100) NOT NULL,
  `Alamat` varchar(100) NOT NULL,
  `Date` varchar(400) NOT NULL,
  `No_Hp` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1043 ;

--
-- Dumping data for table `toy`
--

INSERT INTO `toy` (`id`, `Nama`, `Jenis_Kelamin`, `Kursus`, `Alamat`, `Date`, `No_Hp`) VALUES
(1001, 'Candra', 'Laki-Laki', 'Komputer Kls 3 (12 x P)', 'Ciparagejaya', '02/01/2026/Friday', '085776821436'),
(1002, 'Rani', 'Perempuan', 'Komputer Kls 1 (8 x P)', 'Cibanjar', '02/01/2026/Friday', '085776821436'),
(1003, 'Fadli', 'Laki-Laki', 'Komputer Kls 1 (8 x P)', 'Ciparagejaya', '03/01/2026/Saturday', '085776821436'),
(1004, 'Rahmat', 'Laki-Laki', 'Komputer Kls 2 (8 x P)', 'Cibanjar', '03/01/2026/Saturday', '085776821436'),
(1005, 'Rohatin', 'Perempuan', 'Komputer Kls 1 (12 x P)', 'Tempuran', '03/01/2026/Saturday', '085776821436'),
(1006, 'Azri Faiz', 'Laki-Laki', 'Komputer Kls 3 (8 x P)', 'Tempuran', '03/01/2026/Saturday', '085776821436'),
(1007, 'Wahidik', 'Laki-Laki', 'Komputer Kls 2 (12 x P)', 'Tempuran', '03/01/2026/Saturday', '085776821436'),
(1008, 'Ayunin', 'Perempuan', 'Komputer Kls 2 (8 x P)', 'Ciparagejaya', '03/01/2026/Saturday', '085776821436'),
(1009, 'Faiz', 'Laki-Laki', 'Komputer Kls 2 (8 x P)', 'Tempuran', '03/01/2026/Saturday', '085776821436'),
(1010, 'Masni', 'Perempuan', 'Komputer Kls 2 (8 x P)', 'Ciparagejaya', '03/01/2026/Saturday', '085776821436'),
(1011, 'Farhan', 'Laki-Laki', 'Komputer Kls 2 (12 x P)', 'Tempuan', '03/01/2026/Saturday', '085776821436'),
(1012, 'Wastirah', 'Perempuan', 'Komputer Kls 1 (12 x P)', 'Tempuran', '03/01/2026/Saturday', '08577683276'),
(1013, 'Adil', 'Laki-Laki', 'Komputer Kls 3 (8 x P)', 'Pulomulya', '03/01/2026/Saturday', '085776821436'),
(1014, 'Dadan', 'Laki-Laki', 'Komputer Kls 1 (12 x P)', 'Ciparagejaya', '03/01/2026/Saturday', '08577683276'),
(1015, 'Sarif', 'Laki-Laki', 'Komputer Kls 1 (12 x P)', 'Tempuran', '03/01/2026/Saturday', '085776821436'),
(1016, 'Rahmawati', 'Perempuan', 'Komputer Kls 2 (8 x P)', 'Tempuran', '03/01/2026/Saturday', '085776821436'),
(1017, 'Warsih', 'Perempuan', 'Komputer Kls 1 (12 x P)', 'Tempuran', '03/01/2026/Saturday', '085776821436'),
(1018, 'Darma', 'Laki-Laki', 'Komputer Kls 2 (12 x P)', 'Ciparagejaya', '03/01/2026/Saturday', '085776821436'),
(1019, 'Arianti', 'Laki-Laki', 'Komputer Kls 1 (12 x P)', 'Cianjur', '03/01/2026/Saturday', '085776821436'),
(1020, 'Warna', 'Laki-Laki', 'Komputer Kls 2 (8 x P)', 'Tempuran', '03/01/2026/Saturday', '085776821436'),
(1021, 'Rani Mardia', 'Perempuan', 'Komputer Kls 3 (8 x P)', 'Tempuran', '03/01/2026/Saturday', '085776821436'),
(1022, 'Rahwi', 'Laki-Laki', 'Komputer Kls 1 (12 x P)', 'Tempuran', '03/01/2026/Saturday', '085776821436'),
(1023, 'Warni', 'Laki-Laki', 'Komputer Kls 1 (8 x P)', 'Tempuran', '03/01/2026/Saturday', '085776821436'),
(1024, 'Endi', 'Laki-Laki', 'Komputer Kls 1 (12 x P)', 'Ciparagejaya', '03/01/2026/Saturday', '085776821436'),
(1025, 'Candra', 'Laki-Laki', 'Komputer Kls 1 (12 x P)', 'Cibanjar', '03/01/2026/Saturday', '085776821436'),
(1026, 'Wisnu', 'Laki-Laki', 'Komputer Kls 1 (8 x P)', 'Dongel', '03/01/2026/Saturday', '085776821436'),
(1027, 'Dani', 'Laki-Laki', 'Komputer Kls 2 (8 x P)', 'Ciparagejaya', '03/01/2026/Saturday', '085776821436'),
(1028, 'Fasha', 'Laki-Laki', 'Komputer Kls 1 (8 x P)', 'Tempuran', '03/01/2026/Saturday', '085776821436'),
(1029, 'Warsan', 'Laki-Laki', 'Komputer Kls 1 (12 x P)', 'Tempuran', '03/01/2026/Saturday', '08577683276'),
(1030, 'Galing', 'Laki-Laki', 'Komputer Kls 1 (8 x P)', 'Tempuran', '03/01/2026/Saturday', '085776821436'),
(1031, 'Dani Rasta', 'Laki-Laki', 'Komputer Kls 1 (12 x P)', 'Pulomulya', '03/01/2026/Saturday', '085776821436'),
(1032, 'Rasminah', 'Laki-Laki', 'Komputer Kls 1 (8 x P)', 'Tempuran', '03/01/2026/Saturday', '085776821436'),
(1033, 'Nanang', 'Laki-Laki', 'Komputer Kls 2 (8 x P)', 'Tempuran', '03/01/2026/Saturday', '085776821436'),
(1034, 'Masni', 'Perempuan', 'Komputer Kls 2 (8 x P)', 'Tempuran', '03/01/2026/Saturday', '085776821436'),
(1035, 'Erasiman', 'Laki-Laki', 'Komputer Kls 1 (12 x P)', 'Tempuran', '03/01/2026/Saturday', '085776821436'),
(1036, 'Kasih', 'Perempuan', 'Komputer Kls 2 (8 x P)', 'Tempuran', '03/01/2026/Saturday', '085776821436'),
(1037, 'Erna', 'Perempuan', 'Komputer Kls 2 (8 x P)', 'Tempuran', '03/01/2026/Saturday', '085776821436'),
(1038, 'Tarman', 'Laki-Laki', 'Komputer Kls 1 (8 x P)', 'Tempuran', '03/01/2026/Saturday', '085776821436'),
(1039, 'Rasami', 'Laki-Laki', 'Komputer Kls 1 (12 x P)', 'Tempuran', '03/01/2026/Saturday', '085776821436'),
(1040, 'Jajang', 'Laki-Laki', 'Komputer Kls 1 (12 x P)', 'Tempuran', '03/01/2026/Saturday', '085776821436'),
(1041, 'Rastam', 'Laki-Laki', 'Komputer Kls 1 (8 x P)', 'Tempuran', '03/01/2026/Saturday', '085776821436'),
(1042, 'Harun', 'Laki-Laki', 'Komputer Kls 1 (8 x P)', 'Cibanjar', '21/01/2026/Wednesday', '085776821436');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gambar`
--
ALTER TABLE `gambar`
 ADD PRIMARY KEY (`id_gambar`);

--
-- Indexes for table `gambar2`
--
ALTER TABLE `gambar2`
 ADD PRIMARY KEY (`id_gambar`);

--
-- Indexes for table `tb_header`
--
ALTER TABLE `tb_header`
 ADD PRIMARY KEY (`id_gambar`);

--
-- Indexes for table `tb_pemberitahuan`
--
ALTER TABLE `tb_pemberitahuan`
 ADD PRIMARY KEY (`id_gambar`);

--
-- Indexes for table `tb_sidebar`
--
ALTER TABLE `tb_sidebar`
 ADD PRIMARY KEY (`id_gambar`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toy`
--
ALTER TABLE `toy`
 ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gambar`
--
ALTER TABLE `gambar`
MODIFY `id_gambar` int(80) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `gambar2`
--
ALTER TABLE `gambar2`
MODIFY `id_gambar` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tb_header`
--
ALTER TABLE `tb_header`
MODIFY `id_gambar` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `tb_pemberitahuan`
--
ALTER TABLE `tb_pemberitahuan`
MODIFY `id_gambar` int(30) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tb_sidebar`
--
ALTER TABLE `tb_sidebar`
MODIFY `id_gambar` int(30) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
MODIFY `id` int(13) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `toy`
--
ALTER TABLE `toy`
MODIFY `id` int(80) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1043;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
