-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 27, 2018 at 04:50 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iwan_antrian`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminx`
--

CREATE TABLE `adminx` (
  `kd` varchar(50) NOT NULL,
  `usernamex` varchar(50) NOT NULL,
  `passwordx` varchar(50) NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminx`
--

INSERT INTO `adminx` (`kd`, `usernamex`, `passwordx`, `postdate`) VALUES
('1234567890', 'admin', 'admin', '2018-03-26 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `kd` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telp` varchar(100) NOT NULL,
  `noantrian` varchar(50) NOT NULL,
  `masalah` longtext NOT NULL,
  `postdate` datetime NOT NULL,
  `yg_dibawa` longtext NOT NULL,
  `proses` enum('true','false') NOT NULL DEFAULT 'false',
  `berhasil` enum('true','false') NOT NULL DEFAULT 'false',
  `proses_postdate` datetime NOT NULL,
  `berhasil_postdate` datetime NOT NULL,
  `jml_menit` varchar(50) NOT NULL,
  `jml_jam` varchar(50) NOT NULL,
  `display` enum('true','false') NOT NULL DEFAULT 'false',
  `solusi` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`kd`, `nama`, `alamat`, `telp`, `noantrian`, `masalah`, `postdate`, `yg_dibawa`, `proses`, `berhasil`, `proses_postdate`, `berhasil_postdate`, `jml_menit`, `jml_jam`, `display`, `solusi`) VALUES
('11a54b849df09a468000537df6f27bd6', '7', '7', '7', '2', '8', '2018-03-27 08:24:06', '7', 'true', 'false', '2018-03-27 08:26:28', '0000-00-00 00:00:00', '', '', 'true', '7'),
('7d65ac034d71e20d95312b50d826d78d', '8', '8', '8', '1', '8', '2018-03-27 08:24:02', '8', 'true', 'false', '2018-03-27 08:24:40', '0000-00-00 00:00:00', '', '', 'true', '8');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminx`
--
ALTER TABLE `adminx`
  ADD PRIMARY KEY (`kd`);

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`kd`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
