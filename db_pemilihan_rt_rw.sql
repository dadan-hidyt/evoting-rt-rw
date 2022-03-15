-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2022 at 06:25 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pemilihan_rt_rw`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_calon`
--

CREATE TABLE `tbl_calon` (
  `id` int(11) NOT NULL,
  `nomor_calon` bigint(20) DEFAULT NULL,
  `nama_calon` varchar(225) DEFAULT NULL,
  `deskripsi_calon` text DEFAULT NULL,
  `foto_calon` varchar(120) DEFAULT NULL,
  `banner_calon` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_calon`
--

INSERT INTO `tbl_calon` (`id`, `nomor_calon`, `nama_calon`, `deskripsi_calon`, `foto_calon`, `banner_calon`) VALUES
(1, 1, 'dadan hidayat', 'dadada', 'dada', 'dada');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_peserta`
--

CREATE TABLE `tbl_peserta` (
  `id_peserta` int(11) NOT NULL,
  `nik` varchar(50) DEFAULT 'null',
  `nama` varchar(120) DEFAULT NULL,
  `no_kk` varchar(20) DEFAULT NULL,
  `token` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='ini adalah tabel untuk menyimpan data data orang yang mengikuti pemilihan';

--
-- Dumping data for table `tbl_peserta`
--

INSERT INTO `tbl_peserta` (`id_peserta`, `nik`, `nama`, `no_kk`, `token`) VALUES
(1, '20211428837664533322233', 'Muhamad Afif hermawan', '2022222222333', '887');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id` int(11) NOT NULL,
  `nama_pengaturan` varchar(100) DEFAULT NULL,
  `value` varchar(225) DEFAULT NULL,
  `label` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`id`, `nama_pengaturan`, `value`, `label`) VALUES
(1, 'nama_aplikasi', 'PEMILU KETUA RT 03', 'Nama Website'),
(2, 'tutup_pemilihan', 'false', 'Tutup Pemilihan'),
(4, 'icon', 'assets/icons/favicon.png', 'Favicon');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_suara`
--

CREATE TABLE `tbl_suara` (
  `id` int(11) NOT NULL,
  `id_peserta` int(11) DEFAULT NULL,
  `no_calon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_calon`
--
ALTER TABLE `tbl_calon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_peserta`
--
ALTER TABLE `tbl_peserta`
  ADD UNIQUE KEY `unq_tbl_peserta` (`token`),
  ADD UNIQUE KEY `pk_tbl_peserta` (`id_peserta`,`nik`);

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_suara`
--
ALTER TABLE `tbl_suara`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unq_tbl_suara` (`id_peserta`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_calon`
--
ALTER TABLE `tbl_calon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_peserta`
--
ALTER TABLE `tbl_peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_suara`
--
ALTER TABLE `tbl_suara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
