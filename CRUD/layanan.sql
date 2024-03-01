-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2024 at 07:58 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `no_regis` int(11) NOT NULL,
  `tg_regis` varchar(10) NOT NULL,
  `no_rm` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `poliklinik` varchar(30) NOT NULL,
  `nama_dok` varchar(30) NOT NULL,
  `keluhan` varchar(30) NOT NULL,
  `diagnosa` varchar(30) NOT NULL,
  `tindakan` varchar(30) NOT NULL,
  `terapi_obat` varchar(30) NOT NULL,
  `jadwal` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`no_regis`, `tg_regis`, `no_rm`, `nama`, `poliklinik`, `nama_dok`, `keluhan`, `diagnosa`, `tindakan`, `terapi_obat`, `jadwal`) VALUES
(1, '20-11-2024', '1234', 'ariel', 'umum', 'fahmi', 'sakit kepala', 'demam', 'makan teratur', 'paracetamol 3x1', 'senis dan kamis');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`no_regis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `no_regis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
