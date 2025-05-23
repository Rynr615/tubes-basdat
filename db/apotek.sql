-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 16, 2025 at 09:24 AM
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
-- Database: `apotek`
--

-- --------------------------------------------------------

--
-- Table structure for table `bagiandetail`
--

CREATE TABLE `bagiandetail` (
  `ID` varchar(20) NOT NULL,
  `bagian` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `Resi` varchar(20) NOT NULL,
  `JenisKelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `NoHP` varchar(15) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Alamat` text NOT NULL,
  `idPembelian` varchar(255) DEFAULT NULL,
  `idPegawai` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `NIP` char(20) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `JenisKelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `Spesialis` varchar(50) NOT NULL,
  `NoHP` varchar(15) NOT NULL,
  `Alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fakturpembelianoffline`
--

CREATE TABLE `fakturpembelianoffline` (
  `ID` varchar(255) NOT NULL,
  `KodeTransaksi` varchar(255) NOT NULL,
  `ProdukDibeli` varchar(255) NOT NULL,
  `TotalProduk` varchar(255) NOT NULL,
  `TotalPembayaran` decimal(10,0) NOT NULL,
  `Tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fakturpembelianonline`
--

CREATE TABLE `fakturpembelianonline` (
  `ID` varchar(255) NOT NULL,
  `KodeTransaksi` varchar(255) NOT NULL,
  `ProdukDibeli` varchar(255) NOT NULL,
  `TotalProduk` varchar(255) NOT NULL,
  `TotalPembayaran` decimal(10,0) NOT NULL,
  `Tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faktursupplier`
--

CREATE TABLE `faktursupplier` (
  `ID` varchar(10) NOT NULL,
  `NamaProduk` varchar(100) NOT NULL,
  `TotalBHP` int(11) DEFAULT NULL,
  `TotalObat` int(11) DEFAULT NULL,
  `TotalPembayaran` decimal(15,2) NOT NULL,
  `Tanggal` date NOT NULL,
  `KodeSupplier` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `No_Konsultasi` int(11) NOT NULL,
  `ID_User` int(11) NOT NULL,
  `NIP` char(20) NOT NULL,
  `Keluhan_Pasien` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `idPegawai` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tglLahir` date NOT NULL,
  `usia` int(11) NOT NULL,
  `noHp` varchar(15) NOT NULL,
  `IDbagian` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `jenisKelamin` enum('Laki-laki','Perempuan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembelianoffline`
--

CREATE TABLE `pembelianoffline` (
  `NoTransaksi` varchar(255) NOT NULL,
  `kodeProduk` varchar(255) DEFAULT NULL,
  `idPegawai` varchar(255) DEFAULT NULL,
  `jumlahProduk` int(11) NOT NULL,
  `tglPembelian` date NOT NULL,
  `jenisPembayaran` varchar(255) NOT NULL,
  `totalHarga` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembelianonline`
--

CREATE TABLE `pembelianonline` (
  `idPembelian` varchar(255) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `kodeProduk` varchar(255) DEFAULT NULL,
  `ProdukDibeli` varchar(255) NOT NULL,
  `tglPembelian` date NOT NULL,
  `jenisPembayaran` varchar(255) NOT NULL,
  `totalHarga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `KodeProduk` varchar(255) NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `Jenis` enum('BHP','Obat') NOT NULL,
  `Harga` decimal(10,0) NOT NULL,
  `Fungsi` text DEFAULT NULL,
  `Stok` int(11) NOT NULL,
  `Expired` date NOT NULL,
  `KodeSupplier` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`KodeProduk`, `Nama`, `Jenis`, `Harga`, `Fungsi`, `Stok`, `Expired`, `KodeSupplier`) VALUES
('B0010', 'Masker Medis', 'BHP', 10000, 'Untuk mencegah penyebaran penyakit', 100, '2026-10-10', 'SUP0020'),
('B0020', 'Jarum suntik', 'BHP', 15000, 'Alat untuk menyuntikkan zat ke dalam tubuh', 15, '2025-07-01', 'SUP0040'),
('O001', 'Paracetamol', 'Obat', 2000, 'Meredakan nyeri dan menurunkan demam', 25, '2027-03-10', 'SUP0010'),
('O002', 'Amoxicilin', 'Obat', 7000, 'Untuk mengatasi infeksi bakteri', 30, '2027-08-17', 'SUP0030'),
('O003', 'Cetirizine', 'Obat', 11000, 'Meredakan gejala akibat reaksi alergi', 65, '2027-11-12', 'SUP0050');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `KodeSupplier` varchar(10) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `NoHP` varchar(15) NOT NULL,
  `Alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`KodeSupplier`, `Nama`, `NoHP`, `Alamat`) VALUES
('SUP0010', 'PT.Kimia Farma', '08123456789', 'Jalan Cimaung No.1, Kecamatan Fauna, Kota Bogor'),
('SUP0020', 'PT. Medika Sehat', '08213456789', 'Jalan Sehat itu indah No.2, Kecamatan sehati, Kota Bandung'),
('SUP0030', 'PT. Karya Pratama', '08321456789', 'Jalan Bengkoang No9, Kecamatan timunsuri, Kota Buah'),
('SUP0040', 'PT. Jayamas Medika', '08453216789', 'Jalan Jayajayajaya No13, Kecamatan misquen, Kota Keramat'),
('SUP0050', 'PT. Sehat Sukses', '0897654321', 'Jalan SuksesYes No100, Kecamatan Aye, Kota Beunghar');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID_User` int(11) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `JenisKelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `Alamat` text NOT NULL,
  `NoHP` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bagiandetail`
--
ALTER TABLE `bagiandetail`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`Resi`),
  ADD KEY `idPembelian` (`idPembelian`),
  ADD KEY `idPegawai` (`idPegawai`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`NIP`);

--
-- Indexes for table `fakturpembelianoffline`
--
ALTER TABLE `fakturpembelianoffline`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_KodeTransaksi` (`KodeTransaksi`);

--
-- Indexes for table `fakturpembelianonline`
--
ALTER TABLE `fakturpembelianonline`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_KodeTransaksi_Online` (`KodeTransaksi`);

--
-- Indexes for table `faktursupplier`
--
ALTER TABLE `faktursupplier`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `KodeSupplier` (`KodeSupplier`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`No_Konsultasi`),
  ADD KEY `ID_User` (`ID_User`),
  ADD KEY `NIP` (`NIP`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`idPegawai`),
  ADD KEY `fk_IDbagian` (`IDbagian`);

--
-- Indexes for table `pembelianoffline`
--
ALTER TABLE `pembelianoffline`
  ADD PRIMARY KEY (`NoTransaksi`),
  ADD KEY `kodeProduk` (`kodeProduk`),
  ADD KEY `idPegawai` (`idPegawai`);

--
-- Indexes for table `pembelianonline`
--
ALTER TABLE `pembelianonline`
  ADD PRIMARY KEY (`idPembelian`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `kodeProduk` (`kodeProduk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`KodeProduk`),
  ADD KEY `KodeSupplier` (`KodeSupplier`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`KodeSupplier`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_User`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`idPembelian`) REFERENCES `pembelianonline` (`idPembelian`),
  ADD CONSTRAINT `delivery_ibfk_2` FOREIGN KEY (`idPegawai`) REFERENCES `pegawai` (`idPegawai`);

--
-- Constraints for table `fakturpembelianoffline`
--
ALTER TABLE `fakturpembelianoffline`
  ADD CONSTRAINT `fk_KodeTransaksi` FOREIGN KEY (`KodeTransaksi`) REFERENCES `pembelianoffline` (`NoTransaksi`) ON UPDATE CASCADE;

--
-- Constraints for table `fakturpembelianonline`
--
ALTER TABLE `fakturpembelianonline`
  ADD CONSTRAINT `fk_KodeTransaksi_Online` FOREIGN KEY (`KodeTransaksi`) REFERENCES `pembelianonline` (`idPembelian`) ON UPDATE CASCADE;

--
-- Constraints for table `faktursupplier`
--
ALTER TABLE `faktursupplier`
  ADD CONSTRAINT `faktursupplier_ibfk_1` FOREIGN KEY (`KodeSupplier`) REFERENCES `supplier` (`KodeSupplier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD CONSTRAINT `konsultasi_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `user` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `konsultasi_ibfk_2` FOREIGN KEY (`NIP`) REFERENCES `dokter` (`NIP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `fk_IDbagian` FOREIGN KEY (`IDbagian`) REFERENCES `bagiandetail` (`ID`) ON UPDATE CASCADE;

--
-- Constraints for table `pembelianoffline`
--
ALTER TABLE `pembelianoffline`
  ADD CONSTRAINT `pembelianoffline_ibfk_1` FOREIGN KEY (`kodeProduk`) REFERENCES `produk` (`KodeProduk`),
  ADD CONSTRAINT `pembelianoffline_ibfk_2` FOREIGN KEY (`idPegawai`) REFERENCES `pegawai` (`idPegawai`);

--
-- Constraints for table `pembelianonline`
--
ALTER TABLE `pembelianonline`
  ADD CONSTRAINT `pembelianonline_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`ID_User`),
  ADD CONSTRAINT `pembelianonline_ibfk_2` FOREIGN KEY (`kodeProduk`) REFERENCES `produk` (`KodeProduk`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`KodeSupplier`) REFERENCES `supplier` (`KodeSupplier`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
