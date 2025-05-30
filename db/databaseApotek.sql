-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2025 at 07:09 AM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `Resi` varchar(20) NOT NULL,
  `idPembelian` int(11) DEFAULT NULL,
  `idPegawai` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detailfaktursupplier`
--

CREATE TABLE `detailfaktursupplier` (
  `idDetail` int(11) NOT NULL,
  `NoFaktur` varchar(15) NOT NULL,
  `KodeProduk` varchar(10) NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `SubTotal` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detailpembelianoffline`
--

CREATE TABLE `detailpembelianoffline` (
  `idDetail` int(11) NOT NULL,
  `NoTransaksi` int(11) NOT NULL,
  `kodeProduk` varchar(255) NOT NULL,
  `jumlahProduk` int(11) NOT NULL,
  `subTotal` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detailpembelianonline`
--

CREATE TABLE `detailpembelianonline` (
  `idDetail` int(11) NOT NULL,
  `idPembelian` int(11) NOT NULL,
  `kodeProduk` varchar(255) NOT NULL,
  `jumlahProduk` int(11) NOT NULL,
  `subTotal` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faktursupplier`
--

CREATE TABLE `faktursupplier` (
  `NoFaktur` varchar(15) NOT NULL,
  `Tanggal` date NOT NULL,
  `KodeSupplier` varchar(10) NOT NULL,
  `TotalPembayaran` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `No_Konsultasi` int(11) NOT NULL,
  `ID_User` int(11) NOT NULL,
  `NIP` char(20) NOT NULL,
  `Keluhan_Pasien` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembelianoffline`
--

CREATE TABLE `pembelianoffline` (
  `NoTransaksi` int(11) NOT NULL,
  `idPegawai` varchar(255) NOT NULL,
  `tglPembelian` date NOT NULL,
  `jenisPembayaran` varchar(255) NOT NULL,
  `totalHarga` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembelianonline`
--

CREATE TABLE `pembelianonline` (
  `idPembelian` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `tglPembelian` date NOT NULL,
  `jenisPembayaran` varchar(255) NOT NULL,
  `totalHarga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `KodeSupplier` varchar(10) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `NoHP` varchar(15) NOT NULL,
  `Alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `detailfaktursupplier`
--
ALTER TABLE `detailfaktursupplier`
  ADD PRIMARY KEY (`idDetail`),
  ADD KEY `fk_detailfaktur_faktur` (`NoFaktur`),
  ADD KEY `fk_detailfaktur_produk` (`KodeProduk`);

--
-- Indexes for table `detailpembelianoffline`
--
ALTER TABLE `detailpembelianoffline`
  ADD PRIMARY KEY (`idDetail`),
  ADD KEY `fk_detailoffline_transaksi` (`NoTransaksi`),
  ADD KEY `fk_detailoffline_produk` (`kodeProduk`);

--
-- Indexes for table `detailpembelianonline`
--
ALTER TABLE `detailpembelianonline`
  ADD PRIMARY KEY (`idDetail`),
  ADD KEY `fk_online_kodeProduk` (`kodeProduk`),
  ADD KEY `fk_online_pembelian` (`idPembelian`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`NIP`);

--
-- Indexes for table `faktursupplier`
--
ALTER TABLE `faktursupplier`
  ADD PRIMARY KEY (`NoFaktur`),
  ADD KEY `fk_faktur_supplier` (`KodeSupplier`);

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
  ADD UNIQUE KEY `idPegawai` (`idPegawai`),
  ADD KEY `fk_IDbagian` (`IDbagian`);

--
-- Indexes for table `pembelianoffline`
--
ALTER TABLE `pembelianoffline`
  ADD PRIMARY KEY (`NoTransaksi`),
  ADD KEY `idPegawai` (`idPegawai`);

--
-- Indexes for table `pembelianonline`
--
ALTER TABLE `pembelianonline`
  ADD PRIMARY KEY (`idPembelian`),
  ADD KEY `fk_user_pembelian` (`idUser`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detailfaktursupplier`
--
ALTER TABLE `detailfaktursupplier`
  MODIFY `idDetail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detailpembelianoffline`
--
ALTER TABLE `detailpembelianoffline`
  MODIFY `idDetail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detailpembelianonline`
--
ALTER TABLE `detailpembelianonline`
  MODIFY `idDetail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `No_Konsultasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembelianoffline`
--
ALTER TABLE `pembelianoffline`
  MODIFY `NoTransaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembelianonline`
--
ALTER TABLE `pembelianonline`
  MODIFY `idPembelian` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`idPembelian`) REFERENCES `pembelianonline` (`idPembelian`),
  ADD CONSTRAINT `delivery_ibfk_2` FOREIGN KEY (`idPegawai`) REFERENCES `pegawai` (`idPegawai`),
  ADD CONSTRAINT `fk_delivery_pegawai` FOREIGN KEY (`idPegawai`) REFERENCES `pegawai` (`idPegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_delivery_pembelian` FOREIGN KEY (`idPembelian`) REFERENCES `pembelianonline` (`idPembelian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detailfaktursupplier`
--
ALTER TABLE `detailfaktursupplier`
  ADD CONSTRAINT `detailfaktursupplier_ibfk_1` FOREIGN KEY (`NoFaktur`) REFERENCES `faktursupplier` (`NoFaktur`) ON DELETE CASCADE,
  ADD CONSTRAINT `detailfaktursupplier_ibfk_2` FOREIGN KEY (`KodeProduk`) REFERENCES `produk` (`KodeProduk`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_detailfaktur_faktur` FOREIGN KEY (`NoFaktur`) REFERENCES `faktursupplier` (`NoFaktur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detailfaktur_produk` FOREIGN KEY (`KodeProduk`) REFERENCES `produk` (`KodeProduk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detailpembelianoffline`
--
ALTER TABLE `detailpembelianoffline`
  ADD CONSTRAINT `fk_detail_kodeProduk` FOREIGN KEY (`kodeProduk`) REFERENCES `produk` (`KodeProduk`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_transaksi` FOREIGN KEY (`NoTransaksi`) REFERENCES `pembelianoffline` (`NoTransaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detailoffline_produk` FOREIGN KEY (`kodeProduk`) REFERENCES `produk` (`KodeProduk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detailoffline_transaksi` FOREIGN KEY (`NoTransaksi`) REFERENCES `pembelianoffline` (`NoTransaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detailpembelianonline`
--
ALTER TABLE `detailpembelianonline`
  ADD CONSTRAINT `fk_detailonline_pembelian` FOREIGN KEY (`idPembelian`) REFERENCES `pembelianonline` (`idPembelian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detailonline_produk` FOREIGN KEY (`kodeProduk`) REFERENCES `produk` (`KodeProduk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_online_kodeProduk` FOREIGN KEY (`kodeProduk`) REFERENCES `produk` (`KodeProduk`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_online_pembelian` FOREIGN KEY (`idPembelian`) REFERENCES `pembelianonline` (`idPembelian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `faktursupplier`
--
ALTER TABLE `faktursupplier`
  ADD CONSTRAINT `faktursupplier_ibfk_1` FOREIGN KEY (`KodeSupplier`) REFERENCES `supplier` (`KodeSupplier`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_faktur_supplier` FOREIGN KEY (`KodeSupplier`) REFERENCES `supplier` (`KodeSupplier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD CONSTRAINT `fk_konsultasi_dokter` FOREIGN KEY (`NIP`) REFERENCES `dokter` (`NIP`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_konsultasi_user` FOREIGN KEY (`ID_User`) REFERENCES `user` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `konsultasi_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `user` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `konsultasi_ibfk_2` FOREIGN KEY (`NIP`) REFERENCES `dokter` (`NIP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `fk_IDbagian` FOREIGN KEY (`IDbagian`) REFERENCES `bagiandetail` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pegawai_bagian` FOREIGN KEY (`IDbagian`) REFERENCES `bagiandetail` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembelianoffline`
--
ALTER TABLE `pembelianoffline`
  ADD CONSTRAINT `fk_pegawai` FOREIGN KEY (`idPegawai`) REFERENCES `pegawai` (`idPegawai`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pembelianoffline_pegawai` FOREIGN KEY (`idPegawai`) REFERENCES `pegawai` (`idPegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembelianonline`
--
ALTER TABLE `pembelianonline`
  ADD CONSTRAINT `fk_pembelianonline_user` FOREIGN KEY (`idUser`) REFERENCES `user` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_pembelian` FOREIGN KEY (`idUser`) REFERENCES `user` (`ID_User`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `fk_produk_supplier` FOREIGN KEY (`KodeSupplier`) REFERENCES `supplier` (`KodeSupplier`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_supplier` FOREIGN KEY (`KodeSupplier`) REFERENCES `supplier` (`KodeSupplier`) ON DELETE CASCADE,
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`KodeSupplier`) REFERENCES `supplier` (`KodeSupplier`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
