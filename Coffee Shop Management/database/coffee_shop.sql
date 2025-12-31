-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2025 at 10:23 AM
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
-- Database: `coffee_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `informasi_pegawai`
--

CREATE TABLE `informasi_pegawai` (
  `ID_Informasi_Pegawai` int(11) NOT NULL,
  `ID_Pegawai` int(11) DEFAULT NULL,
  `Nomor_KTP` varchar(16) DEFAULT NULL,
  `Gaji` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `informasi_pegawai`
--

INSERT INTO `informasi_pegawai` (`ID_Informasi_Pegawai`, `ID_Pegawai`, `Nomor_KTP`, `Gaji`) VALUES
(1, 1, '1234567890123456', 7500000.00),
(2, 2, '2345678901234567', 6500000.00),
(3, 3, '3456789012345678', 7000000.00),
(4, 4, '4567890123456789', 6800000.00),
(5, 5, '5678901234567890', 7200000.00),
(6, 6, '6789012345678901', 6600000.00);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `ID_Kategori` int(11) NOT NULL,
  `Nama_Kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_produk`
--

INSERT INTO `kategori_produk` (`ID_Kategori`, `Nama_Kategori`) VALUES
(1, 'Coffee'),
(2, 'Non-Coffee'),
(3, 'Blended'),
(4, 'Frappe'),
(5, 'Tea');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `ID_Pegawai` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Alamat` varchar(255) DEFAULT NULL,
  `Nomor_Telepon` varchar(15) DEFAULT NULL,
  `Jenis_Kelamin` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`ID_Pegawai`, `Username`, `Password`, `Nama`, `Alamat`, `Nomor_Telepon`, `Jenis_Kelamin`) VALUES
(1, 'admin', 'admin123', 'Ahmad Fauzi', 'Jl. Merdeka No. 123, Jakarta', '081234567890', 'Laki-laki'),
(2, 'sari_dewi', 'sari123', 'Sari Dewi', 'Jl. Melati No. 45, Bandung', '081298765432', 'Perempuan'),
(3, 'budi_s', 'budi123', 'Budi Santoso', 'Jl. Kenanga No. 67, Surabaya', '081345678901', 'Laki-laki'),
(4, 'rina_m', 'rina123', 'Rina Maulida', 'Jl. Anggrek No. 89, Yogyakarta', '081356789012', 'Perempuan'),
(5, 'david_w', 'david123', 'David Wijaya', 'Jl. Mawar No. 12, Bali', '081367890123', 'Laki-laki'),
(6, 'lina_k', 'lina123', 'Lina Kartika', 'Jl. Flamboyan No. 34, Medan', '081378901234', 'Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `ID_Pelanggan` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Alamat` varchar(255) DEFAULT NULL,
  `Nomor_Telepon` varchar(15) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`ID_Pelanggan`, `Username`, `Password`, `Nama`, `Alamat`, `Nomor_Telepon`, `Email`) VALUES
(1, 'khesa764', 'khesa123', 'Muhammad Khesa Rhafi', 'Bogor', '0895392666544', 'khesa@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `ID_Pesanan` int(11) NOT NULL,
  `ID_Pelanggan` int(11) DEFAULT NULL,
  `ID_Produk` int(11) DEFAULT NULL,
  `Jumlah` int(11) NOT NULL,
  `Alamat_Pengiriman` varchar(255) DEFAULT NULL,
  `Tanggal_Pesanan` date NOT NULL,
  `Status_Pesanan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`ID_Pesanan`, `ID_Pelanggan`, `ID_Produk`, `Jumlah`, `Alamat_Pengiriman`, `Tanggal_Pesanan`, `Status_Pesanan`) VALUES
(1, 1, 2, 2, 'Parung', '2025-10-26', 'Belum Dikirim');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `ID_Produk` int(11) NOT NULL,
  `Nama_Produk` varchar(100) NOT NULL,
  `Harga` decimal(12,2) NOT NULL,
  `Stok` int(11) NOT NULL,
  `ID_Kategori` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`ID_Produk`, `Nama_Produk`, `Harga`, `Stok`, `ID_Kategori`) VALUES
(1, 'Cappuccino', 35000.00, 50, 1),
(2, 'Mocha', 40000.00, 43, 1),
(3, 'Espresso', 25000.00, 60, 1),
(4, 'Americano', 28000.00, 55, 1),
(5, 'Flat White', 38000.00, 40, 1),
(6, 'Affogato', 45000.00, 30, 1),
(7, 'Kombucha', 32000.00, 25, 2),
(8, 'Iced Tea', 22000.00, 35, 5),
(9, 'Thai Tea', 28000.00, 30, 5),
(10, 'Mocha Blended', 42000.00, 40, 3),
(11, 'Chocolate Blended', 38000.00, 45, 3),
(12, 'Green Tea Blended', 37000.00, 35, 3),
(13, 'Strawberry Frappe', 35000.00, 30, 4),
(14, 'Blueberry Frappe', 35000.00, 25, 4),
(15, 'Mango Frappe', 35000.00, 28, 4);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `ID_Transaksi` int(11) NOT NULL,
  `ID_Pesanan` int(11) DEFAULT NULL,
  `Tanggal` date NOT NULL,
  `Total_Harga` decimal(12,2) NOT NULL,
  `Metode_Pembayaran` varchar(20) DEFAULT NULL,
  `Status_Pembayaran` varchar(20) DEFAULT NULL,
  `ID_Pegawai` int(11) DEFAULT NULL,
  `ID_Pelanggan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`ID_Transaksi`, `ID_Pesanan`, `Tanggal`, `Total_Harga`, `Metode_Pembayaran`, `Status_Pembayaran`, `ID_Pegawai`, `ID_Pelanggan`) VALUES
(1, NULL, '2025-10-26', 80000.00, 'GOPAY', 'Pending', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `informasi_pegawai`
--
ALTER TABLE `informasi_pegawai`
  ADD PRIMARY KEY (`ID_Informasi_Pegawai`),
  ADD KEY `ID_Pegawai` (`ID_Pegawai`);

--
-- Indexes for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`ID_Kategori`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`ID_Pegawai`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`ID_Pelanggan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`ID_Pesanan`),
  ADD KEY `ID_Pelanggan` (`ID_Pelanggan`),
  ADD KEY `ID_Produk` (`ID_Produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`ID_Produk`),
  ADD KEY `ID_Kategori` (`ID_Kategori`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`ID_Transaksi`),
  ADD KEY `ID_Pesanan` (`ID_Pesanan`),
  ADD KEY `ID_Pegawai` (`ID_Pegawai`),
  ADD KEY `ID_Pelanggan` (`ID_Pelanggan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `informasi_pegawai`
--
ALTER TABLE `informasi_pegawai`
  MODIFY `ID_Informasi_Pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `ID_Kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `ID_Pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `ID_Pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `ID_Pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `ID_Produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `ID_Transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `informasi_pegawai`
--
ALTER TABLE `informasi_pegawai`
  ADD CONSTRAINT `informasi_pegawai_ibfk_1` FOREIGN KEY (`ID_Pegawai`) REFERENCES `pegawai` (`ID_Pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`ID_Pelanggan`) REFERENCES `pelanggan` (`ID_Pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`ID_Produk`) REFERENCES `produk` (`ID_Produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`ID_Kategori`) REFERENCES `kategori_produk` (`ID_Kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`ID_Pesanan`) REFERENCES `pesanan` (`ID_Pesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`ID_Pegawai`) REFERENCES `pegawai` (`ID_Pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`ID_Pelanggan`) REFERENCES `pelanggan` (`ID_Pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
