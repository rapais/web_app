-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2024 at 07:15 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `master_table`
--

CREATE TABLE `master_table` (
  `Id` int(11) NOT NULL,
  `Jenis` varchar(100) NOT NULL,
  `NID` varchar(15) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Jabatan` varchar(100) NOT NULL,
  `Unit` varchar(100) NOT NULL,
  `Judul_pembelajaran` varchar(200) NOT NULL,
  `PIC_pelatihan` varchar(100) NOT NULL,
  `Batch` varchar(50) NOT NULL,
  `T_Mulai` date NOT NULL,
  `T_Selesai` date NOT NULL,
  `Instruktur` float NOT NULL,
  `Materi` float NOT NULL,
  `Peserta` float NOT NULL,
  `Penyelenggara` float NOT NULL,
  `Saran` varchar(300) NOT NULL,
  `Action` varchar(300) NOT NULL,
  `Progress` varchar(300) NOT NULL,
  `Per_pro` float NOT NULL,
  `Evidence` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_table`
--

INSERT INTO `master_table` (`Id`, `Jenis`, `NID`, `Nama`, `Jabatan`, `Unit`, `Judul_pembelajaran`, `PIC_pelatihan`, `Batch`, `T_Mulai`, `T_Selesai`, `Instruktur`, `Materi`, `Peserta`, `Penyelenggara`, `Saran`, `Action`, `Progress`, `Per_pro`, `Evidence`, `Status`) VALUES
(1, 'Post Evaluasi', 'xxxxx', 'fffff', 'xxxxx', 'xxxxx', 'Simulator PLTU Pulverized Coal (PC) Boiler', 'LIAS DWI HARYADI', '14080194-00072', '2023-01-02', '2023-01-06', 3.25, 3.5, 3, 3.25, 'Teori dalam pembelajaran masih kurang', 'Menyusun…', 'Teori dalam pembelajaran masih kurang : 1. Sudah dikoordinasikan dengan instruktur', 100, 'Array', 'Close'),
(2, 'Direct Complain', 'qqqqq', 'wwwww', 'eeeee', 'rrrrr', 'Product Launch', 'FERNANDO VALINTINO', '12020144-00001', '0000-00-00', '0000-00-00', 3, 3, 3, 3, 'Sangat baik', 'Mempertahankan kinerja', 'Sangat baik', 100, 'Screencapture WA Business', 'Close');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_table`
--
ALTER TABLE `master_table`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_table`
--
ALTER TABLE `master_table`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
