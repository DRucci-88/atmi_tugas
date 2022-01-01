-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2022 at 12:03 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atmi`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `mahasiswa_id` varchar(5) NOT NULL,
  `mahasiswa_name` varchar(50) NOT NULL,
  `mahasiswa_nim` varchar(20) NOT NULL,
  `mahasiswa_jurusan` varchar(50) NOT NULL,
  `mahasiswa_asal_sekolah` varchar(50) NOT NULL,
  `mahasiswa_tanggal_lahir` varchar(20) NOT NULL,
  `mahasiswa_nomor_telepon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`mahasiswa_id`, `mahasiswa_name`, `mahasiswa_nim`, `mahasiswa_jurusan`, `mahasiswa_asal_sekolah`, `mahasiswa_tanggal_lahir`, `mahasiswa_nomor_telepon`) VALUES
('10', 'Asep Budi Naik', '006', 'Tataboga', 'SMA Padang Pasir', '2021-12-01', '08953520000'),
('8', 'William Adisurya', '003', 'Teknik Rekayasa Mekatronika', 'SMA Tadika Mesra', '2000-12-01', '08789456');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_nilai`
--

CREATE TABLE `mahasiswa_nilai` (
  `mahasiswa_nilai_id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `mata_kuliah_id` int(11) NOT NULL,
  `nilai` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `mata_kuliah_id` mediumint(9) NOT NULL,
  `mata_kuliah_nama` varchar(50) NOT NULL,
  `mata_kuliah_bobot` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`mata_kuliah_id`, `mata_kuliah_nama`, `mata_kuliah_bobot`) VALUES
(1, 'Pendidikan Agama', 1),
(2, 'Bahasa Inggris 1', 2),
(3, 'Kesehatan dan Keselamatan Kerja', 1),
(4, 'Gambar Teknik', 2),
(5, 'Matematika Teknik 1', 2),
(6, 'Rangkaian Listrik', 2),
(7, 'Teknologi Manufaktur', 2),
(8, 'Algoritma dan Pemrograman', 2),
(9, 'Fisika Terapan', 2),
(10, 'Ilmu Bahan', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hak_akses`
--

CREATE TABLE `tbl_hak_akses` (
  `id` int(11) NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hak_akses`
--

INSERT INTO `tbl_hak_akses` (`id`, `id_user_level`, `id_menu`) VALUES
(15, 1, 1),
(19, 1, 3),
(21, 2, 1),
(24, 1, 9),
(28, 2, 3),
(29, 2, 2),
(30, 1, 2),
(32, 3, 10),
(33, 3, 11),
(34, 3, 12),
(35, 3, 13),
(36, 3, 3),
(37, 3, 2),
(38, 3, 1),
(39, 3, 9),
(40, 4, 14),
(41, 4, 15),
(42, 4, 1),
(43, 4, 2),
(44, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(30) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `is_main_menu` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL COMMENT 'y=yes,n=no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `title`, `url`, `icon`, `is_main_menu`, `is_aktif`) VALUES
(1, 'KELOLA MENU', 'kelolamenu', 'fa fa-server', 0, 'y'),
(2, 'KELOLA PENGGUNA', 'user', 'fa fa-user-o', 0, 'y'),
(3, 'level PENGGUNA', 'userlevel', 'fa fa-users', 0, 'y'),
(9, 'Contoh Form', 'welcome/form', 'fa fa-id-card', 0, 'y'),
(10, 'mahasiswa dashboard', 'mahasiswa', 'fa fa-gamepad', 0, 'y'),
(11, 'mahasiswa hasil studi', 'mahasiswa/hasil_studi', 'fa fa-bomb', 0, 'y'),
(12, 'mahasiswa keungan', 'mahasiswa/keuangan', 'fa fa-balance-scale', 0, 'y'),
(13, 'mahasiswa riwayat absensi', 'mahasiswa/riwayat_absensi', 'fa fa-audio-description', 0, 'y'),
(14, 'Dosen Dashboard', 'dosen', 'fa fa-gamepad', 0, 'y'),
(15, 'Dosen Penilian', 'dosen/penilaian', 'fa fa-snowflake-o', 0, 'y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id_setting` int(11) NOT NULL,
  `nama_setting` varchar(50) NOT NULL,
  `value` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`id_setting`, `nama_setting`, `value`) VALUES
(1, 'Tampil Menu', 'ya');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_users` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_users`, `full_name`, `email`, `password`, `images`, `id_user_level`, `is_aktif`) VALUES
(7, 'Administrator', 'admin@polinatmi.ac.id', '$2y$04$6wapLIUsd2.ACt8L6Xo.3eo197IIb5LAlpEV.ti5GLu6EgTJKxUNW', 'admin.png', 1, 'y'),
(8, 'William Adisurya', 'william@gmail.com', '$2y$04$QGeBtroqn6MMiOShH0JqH.vbECoDTOtbO0kHB5X2WkxCrqhQSW4HC', 'wil.jpg', 3, 'y'),
(9, 'Jipak Ukulele', 'jipak@gmail.com', '$2y$04$NV85071spzRVRK.IROIFwOEUu5zgGwtVA3ljiV7Bb.SFj8Is3SF9S', 'kucing.jpg', 4, 'y'),
(10, 'Asep Budi Naik', 'asep@gmail.com', '$2y$04$zwrfzUuNLBSikDlbsunUNewt2upGsKL8vayDK3vnHRtZeRMCn4Yp2', 'monochrome12.jpg', 3, 'y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_level`
--

CREATE TABLE `tbl_user_level` (
  `id_user_level` int(11) NOT NULL,
  `nama_level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_level`
--

INSERT INTO `tbl_user_level` (`id_user_level`, `nama_level`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'MAHASISWA'),
(4, 'DOSEN'),
(5, 'KEUANGAN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`mahasiswa_id`);

--
-- Indexes for table `mahasiswa_nilai`
--
ALTER TABLE `mahasiswa_nilai`
  ADD PRIMARY KEY (`mahasiswa_nilai_id`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`mata_kuliah_id`);

--
-- Indexes for table `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_users`);

--
-- Indexes for table `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  ADD PRIMARY KEY (`id_user_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mahasiswa_nilai`
--
ALTER TABLE `mahasiswa_nilai`
  MODIFY `mahasiswa_nilai_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `mata_kuliah_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  MODIFY `id_user_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
