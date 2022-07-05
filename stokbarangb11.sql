-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2022 at 06:48 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stokbarangb11`
--

-- --------------------------------------------------------

--
-- Table structure for table `keluar`
--

CREATE TABLE `keluar` (
  `idkeluar` varchar(11) NOT NULL,
  `tanggalkeluar` date NOT NULL,
  `idbarang` int(11) NOT NULL,
  `namabarang` varchar(35) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `jumlahstock` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keluar`
--

INSERT INTO `keluar` (`idkeluar`, `tanggalkeluar`, `idbarang`, `namabarang`, `keterangan`, `jumlahstock`) VALUES
('001', '2021-12-17', 1105, 'pilok', 'keluar', 250),
('002', '2021-12-18', 1106, 'Knalpot', 'keluar', 120);

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` varchar(11) NOT NULL,
  `tanggalmasuk` date NOT NULL,
  `idbarang` int(25) NOT NULL,
  `namabarang` varchar(35) NOT NULL,
  `keterangan` varchar(11) NOT NULL,
  `jumlahstock` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `tanggalmasuk`, `idbarang`, `namabarang`, `keterangan`, `jumlahstock`) VALUES
('0002', '2021-12-29', 1101, 'Oli Yamaha', 'Masuk', 155),
('0003', '2021-12-28', 1102, 'Rantai', 'Masuk', 155),
('0004', '2022-12-24', 1103, 'Gir', 'Masuk', 20),
('0005', '2021-12-25', 1104, 'gir', 'Masuk', 175);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `idbarang` int(11) NOT NULL,
  `namabarang` varchar(25) NOT NULL,
  `keterangan` varchar(25) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`idbarang`, `namabarang`, `keterangan`, `stock`) VALUES
(1101, 'Oli Yamaha', 'Masuk', 155),
(1102, 'Rantai', 'Keluar', 155),
(1103, 'Gir', 'Masuk', 200),
(1104, 'Ban', 'Masuk', 65),
(1105, 'pilok', 'Keluar', 15),
(1106, 'Knalpot', 'Keluar', 80);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(100) NOT NULL,
  `namakaryawan` varchar(50) NOT NULL,
  `status` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `username`, `password`, `namakaryawan`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Lutvi Sahara', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`idkeluar`);

--
-- Indexes for table `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idbarang`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
