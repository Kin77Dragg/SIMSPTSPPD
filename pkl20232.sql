-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2024 at 07:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pkl20232`
--

-- --------------------------------------------------------

--
-- Table structure for table `headersurat`
--

CREATE TABLE `headersurat` (
  `IdSurat` int(11) NOT NULL,
  `NomorSurat` varchar(50) NOT NULL,
  `SifatSurat` varchar(30) DEFAULT NULL,
  `Lampiran` varchar(30) DEFAULT NULL,
  `Perihal` text DEFAULT NULL,
  `TglSurat` datetime NOT NULL DEFAULT current_timestamp(),
  `TujuanSurat` text NOT NULL,
  `HariAwal` varchar(50) NOT NULL DEFAULT current_timestamp(),
  `HariAkhir` varchar(50) NOT NULL DEFAULT current_timestamp(),
  `TanggalAwal` datetime NOT NULL DEFAULT current_timestamp(),
  `TanggalAkhir` datetime NOT NULL DEFAULT current_timestamp(),
  `TempatKegiatan` text NOT NULL,
  `AcaraKegiatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `headersurat`
--

INSERT INTO `headersurat` (`IdSurat`, `NomorSurat`, `SifatSurat`, `Lampiran`, `Perihal`, `TglSurat`, `TujuanSurat`, `HariAwal`, `HariAkhir`, `TanggalAwal`, `TanggalAkhir`, `TempatKegiatan`, `AcaraKegiatan`) VALUES
(0, '170/10/KOMISI.II/DPRD/2024', 'Penting', '1 (Satu)', 'makan malam bareng kawan kawan dprd', '0000-00-00 00:00:00', 'bapak yeri ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'berkas', 'makan bersama'),
(1, '1', NULL, NULL, NULL, '2024-02-29 17:11:42', '', '0000-00-00 00:00:00', '2024-03-01 14:52:55', '0000-00-00 00:00:00', '2024-03-01 00:00:00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `keperluan`
--

CREATE TABLE `keperluan` (
  `KodeKeperluan` int(11) NOT NULL,
  `Keperluan` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `idlevel` int(2) NOT NULL,
  `namalevel` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`idlevel`, `namalevel`) VALUES
(1, 'Ketua Dewan'),
(2, 'Kabag'),
(3, 'Komisi'),
(4, 'Anggota Dewan'),
(5, 'Pendamping'),
(6, 'Operator / Admin'),
(7, 'Super Admin');

-- --------------------------------------------------------

--
-- Table structure for table `pangkatgolongan`
--

CREATE TABLE `pangkatgolongan` (
  `idPangGol` int(5) NOT NULL,
  `Pangkat` varchar(20) NOT NULL,
  `Golongan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_login` int(30) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `no_pegawai` varchar(20) NOT NULL,
  `idlevel` int(2) DEFAULT NULL,
  `idunit` int(2) DEFAULT NULL,
  `Status` enum('Aktif','TidakAktif') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_login`, `nik`, `username`, `nama_lengkap`, `password`, `no_pegawai`, `idlevel`, `idunit`, `Status`) VALUES
(1, '1771050312030003', 'Ikhwan', 'Ikhwan Fauzi', '033213', '20552011', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pesertakegiatan`
--

CREATE TABLE `pesertakegiatan` (
  `idPeserta` int(20) NOT NULL,
  `idSurat` int(11) NOT NULL,
  `id_login` int(30) NOT NULL,
  `Setuju` enum('Setuju','Tidak Setuju') NOT NULL,
  `WaktuSetuju` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `idunit` int(2) NOT NULL,
  `namaunit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`idunit`, `namaunit`) VALUES
(1, 'Ketua'),
(2, 'Sekwan'),
(3, 'Komisi 1'),
(4, 'Komisi 2'),
(5, 'Komisi 3'),
(6, 'Umum dan Keuangan'),
(7, 'Fasilitasi Penganggaran dan Pengawasan'),
(8, 'Perlengkapan'),
(9, 'Hukum, Persidangan dan Perundang-undangan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `headersurat`
--
ALTER TABLE `headersurat`
  ADD PRIMARY KEY (`IdSurat`),
  ADD KEY `NomorSurat` (`NomorSurat`);

--
-- Indexes for table `keperluan`
--
ALTER TABLE `keperluan`
  ADD PRIMARY KEY (`KodeKeperluan`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`idlevel`);

--
-- Indexes for table `pangkatgolongan`
--
ALTER TABLE `pangkatgolongan`
  ADD PRIMARY KEY (`idPangGol`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `pesertakegiatan`
--
ALTER TABLE `pesertakegiatan`
  ADD PRIMARY KEY (`idPeserta`),
  ADD KEY `idSurat` (`idSurat`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`idunit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keperluan`
--
ALTER TABLE `keperluan`
  MODIFY `KodeKeperluan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `idlevel` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pangkatgolongan`
--
ALTER TABLE `pangkatgolongan`
  MODIFY `idPangGol` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_login` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pesertakegiatan`
--
ALTER TABLE `pesertakegiatan`
  MODIFY `idPeserta` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `idunit` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
