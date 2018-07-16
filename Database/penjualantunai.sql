-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 16, 2018 at 01:56 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualantunai`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kd_brg` varchar(6) NOT NULL,
  `nm_brg` varchar(30) NOT NULL,
  `jns_brg` varchar(20) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kd_brg`, `nm_brg`, `jns_brg`, `satuan`, `harga`, `stok`) VALUES
('BR0001', 'Minyak Kayu', 'Marine Lubricants', 'Drum', 20000, 100),
('BR0002', 'Minyak Rem', 'Transmission Oils', 'Pail', 50000, 100),
('BR0003', 'Minyak Gajah', 'Full Synthetic Grind', 'Tangki', 90000, 100),
('BR0004', 'Minyak Kelapa', 'Marine Lubricants', 'Drum', 70000, 100),
('BR0005', 'Minyak Sayur', 'Marine Lubricants', 'Tangki', 50000, 100);

-- --------------------------------------------------------

--
-- Table structure for table `detilpesan`
--

CREATE TABLE `detilpesan` (
  `no_po` varchar(6) DEFAULT NULL,
  `kd_brg` varchar(6) DEFAULT NULL,
  `tgl_kirim` date DEFAULT NULL,
  `jml_brg` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detilretur`
--

CREATE TABLE `detilretur` (
  `no_retur` varchar(6) NOT NULL,
  `kd_brg` varchar(6) NOT NULL,
  `jml_retur` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faktur`
--

CREATE TABLE `faktur` (
  `no_faktur` varchar(6) NOT NULL,
  `tgl_faktur` date NOT NULL,
  `no_stt` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `kd_plg` varchar(6) NOT NULL,
  `nm_plg` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `telepon` varchar(15) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`kd_plg`, `nm_plg`, `alamat`, `telepon`) VALUES
('PLG003', 'PT. Ageng Langgeng1', 'Cikupa', '083891882918'),
('PLG004', 'PT. Indosua Agromulia', 'Kuningan', '081283992819'),
('PLG005', 'PT. Budi Luhur', 'Ciledug', '089782536273'),
('PLG006', 'PT. Kapal Api', 'Surabaya', '089783627212');

-- --------------------------------------------------------

--
-- Table structure for table `po`
--

CREATE TABLE `po` (
  `no_po` varchar(6) NOT NULL,
  `tgl_po` date NOT NULL,
  `kd_plg` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `retur`
--

CREATE TABLE `retur` (
  `no_retur` varchar(6) NOT NULL,
  `tgl_retur` date NOT NULL,
  `no_faktur` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sj`
--

CREATE TABLE `sj` (
  `no_sj` varchar(6) NOT NULL,
  `tgl_sj` date NOT NULL,
  `no_po` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stt`
--

CREATE TABLE `stt` (
  `no_stt` varchar(6) NOT NULL,
  `tgl_stt` date NOT NULL,
  `no_sj` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kd_brg`);

--
-- Indexes for table `detilpesan`
--
ALTER TABLE `detilpesan`
  ADD KEY `no_po` (`no_po`,`kd_brg`),
  ADD KEY `kd_brg` (`kd_brg`);

--
-- Indexes for table `detilretur`
--
ALTER TABLE `detilretur`
  ADD KEY `no_retur` (`no_retur`,`kd_brg`),
  ADD KEY `kd_brg` (`kd_brg`);

--
-- Indexes for table `faktur`
--
ALTER TABLE `faktur`
  ADD PRIMARY KEY (`no_faktur`),
  ADD KEY `no_stt` (`no_stt`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`kd_plg`);

--
-- Indexes for table `po`
--
ALTER TABLE `po`
  ADD PRIMARY KEY (`no_po`),
  ADD KEY `kd_pelanggan` (`kd_plg`);

--
-- Indexes for table `retur`
--
ALTER TABLE `retur`
  ADD PRIMARY KEY (`no_retur`),
  ADD KEY `no_faktur` (`no_faktur`);

--
-- Indexes for table `sj`
--
ALTER TABLE `sj`
  ADD PRIMARY KEY (`no_sj`),
  ADD KEY `no_po` (`no_po`);

--
-- Indexes for table `stt`
--
ALTER TABLE `stt`
  ADD PRIMARY KEY (`no_stt`),
  ADD KEY `no_sj` (`no_sj`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detilpesan`
--
ALTER TABLE `detilpesan`
  ADD CONSTRAINT `detilpesan_ibfk_1` FOREIGN KEY (`no_po`) REFERENCES `po` (`no_po`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detilpesan_ibfk_2` FOREIGN KEY (`kd_brg`) REFERENCES `barang` (`kd_brg`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detilretur`
--
ALTER TABLE `detilretur`
  ADD CONSTRAINT `detilretur_ibfk_1` FOREIGN KEY (`kd_brg`) REFERENCES `barang` (`kd_brg`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detilretur_ibfk_2` FOREIGN KEY (`no_retur`) REFERENCES `retur` (`no_retur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `faktur`
--
ALTER TABLE `faktur`
  ADD CONSTRAINT `faktur_ibfk_1` FOREIGN KEY (`no_stt`) REFERENCES `stt` (`no_stt`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `po`
--
ALTER TABLE `po`
  ADD CONSTRAINT `po_ibfk_1` FOREIGN KEY (`kd_plg`) REFERENCES `pelanggan` (`kd_plg`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `retur`
--
ALTER TABLE `retur`
  ADD CONSTRAINT `retur_ibfk_1` FOREIGN KEY (`no_faktur`) REFERENCES `faktur` (`no_faktur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sj`
--
ALTER TABLE `sj`
  ADD CONSTRAINT `sj_ibfk_1` FOREIGN KEY (`no_po`) REFERENCES `po` (`no_po`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stt`
--
ALTER TABLE `stt`
  ADD CONSTRAINT `stt_ibfk_1` FOREIGN KEY (`no_sj`) REFERENCES `sj` (`no_sj`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
