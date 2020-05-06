-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2020 at 04:48 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `operasional`
--

-- --------------------------------------------------------

--
-- Table structure for table `kirim`
--

CREATE TABLE `kirim` (
  `id_kirim` int(255) NOT NULL,
  `id_stokpile` int(255) NOT NULL,
  `id_truk` int(255) NOT NULL,
  `tanggal_kirim` date NOT NULL,
  `nosurat` varchar(8) NOT NULL,
  `id_transaksi` int(255) NOT NULL,
  `batubara` float NOT NULL,
  `lokasi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kirim`
--

INSERT INTO `kirim` (`id_kirim`, `id_stokpile`, `id_truk`, `tanggal_kirim`, `nosurat`, `id_transaksi`, `batubara`, `lokasi`) VALUES
(1, 5, 37, '2020-02-24', '20096227', 11, 50.7, 'Jetty U Port Sei Puting'),
(2, 5, 43, '2020-02-25', '20096228', 11, 49.8, 'Jetty U Port Sei Puting'),
(3, 5, 46, '2020-02-26', '20096252', 11, 48.75, 'Jetty U Port Sei Puting'),
(4, 5, 46, '2020-02-24', '20096514', 11, 50.3, 'Jetty U Port Sei Puting');

-- --------------------------------------------------------

--
-- Table structure for table `kontrak`
--

CREATE TABLE `kontrak` (
  `id_kontrak` int(255) NOT NULL,
  `no_kontrak` varchar(10) NOT NULL,
  `id_mitra` int(255) NOT NULL,
  `tanggal` date NOT NULL,
  `tanggal1` date NOT NULL,
  `bagihasil` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kontrak`
--

INSERT INTO `kontrak` (`id_kontrak`, `no_kontrak`, `id_mitra`, `tanggal`, `tanggal1`, `bagihasil`) VALUES
(30, '1039211', 1, '2020-02-23', '2021-02-23', '15%'),
(31, '1040021', 3, '2020-02-29', '2021-02-28', '20%');

-- --------------------------------------------------------

--
-- Table structure for table `mitra`
--

CREATE TABLE `mitra` (
  `id_mitra` int(255) NOT NULL,
  `nama_cv` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mitra`
--

INSERT INTO `mitra` (`id_mitra`, `nama_cv`, `alamat`, `telp`) VALUES
(1, 'CV. Ananda', 'Jl. Mawar No. 9 Sumbawa Besar,Kab. Sumbawa, Nusa Tenggara Barat.', '0812-5115-5781'),
(2, 'CV. Berkat Batuah', 'JL. A. Yani, Km. 75, 400 RT. 01, Desa Batubalian, Melayu, Kec. Banjarmasin Tengah, Kota Banjarmasin, Kalimantan Selatan 70122', '087998655666'),
(3, 'CV. Gunung Hidayah', 'Jl. Rawa Gelam I No. 9', '0514 7674107'),
(4, 'CV. Rezeki', 'Jl. P.M Noor Block C No. 19 Komplek Permata Hijau Banjar Baru', '(021) 4602015'),
(5, 'CV. Lintas Borneo Khatulistiwa', 'Jl. Prona I gg. Bina Karya no 13 RT. 20 RW. 02 Banjarmasin', '08125552500'),
(6, 'PD. Baramarta', 'Komplek Pangeran Antasari No.36 Martapura', '0811 7124007');

-- --------------------------------------------------------

--
-- Table structure for table `produksi`
--

CREATE TABLE `produksi` (
  `id_produksi` int(255) NOT NULL,
  `tgl` date NOT NULL,
  `shift` enum('Siang','Malam') NOT NULL,
  `id_truk` int(255) NOT NULL,
  `id_stokpile` int(255) NOT NULL,
  `muatan` float NOT NULL,
  `kosong` float NOT NULL,
  `volume` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produksi`
--

INSERT INTO `produksi` (`id_produksi`, `tgl`, `shift`, `id_truk`, `id_stokpile`, `muatan`, `kosong`, `volume`) VALUES
(42, '2020-02-23', 'Siang', 47, 5, 50.12, 12.5, 37.62),
(43, '2020-02-24', 'Siang', 48, 2, 49.93, 11.7, 38.23),
(44, '2020-02-23', 'Malam', 41, 4, 48.37, 14.6, 33.77),
(45, '2020-02-25', 'Malam', 50, 5, 47.12, 15.1, 32.02),
(46, '2020-02-24', 'Malam', 49, 2, 54.55, 13.3, 41.25),
(47, '2020-02-26', 'Siang', 47, 5, 46.45, 14.87, 31.58),
(48, '2020-02-27', 'Siang', 48, 2, 52.24, 13.21, 39.03),
(49, '2020-02-28', 'Siang', 49, 4, 48.98, 12.16, 36.82),
(50, '2020-02-26', 'Malam', 50, 5, 49.1, 11.1, 38),
(51, '2020-02-27', 'Malam', 41, 2, 47.3, 13.2, 34.1),
(52, '2020-02-28', 'Siang', 41, 5, 50.41, 11.2, 39.21),
(53, '2020-02-29', 'Siang', 47, 5, 53.71, 13.91, 39.8),
(54, '2020-02-28', 'Malam', 48, 5, 56.12, 14.83, 41.29),
(55, '2020-02-29', 'Malam', 49, 5, 48.72, 12.33, 36.39),
(56, '2020-03-01', 'Siang', 50, 5, 49.34, 13.76, 35.58),
(57, '2020-03-02', 'Siang', 41, 5, 55.34, 13.17, 42.17),
(58, '2020-03-01', 'Malam', 49, 5, 56.23, 12.93, 43.3);

-- --------------------------------------------------------

--
-- Table structure for table `stokpile`
--

CREATE TABLE `stokpile` (
  `id_stokpile` int(2) NOT NULL,
  `kode_lahan` enum('Pit Barat','Pit Utara','Pit Selatan','Pit Timur') NOT NULL,
  `stok` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stokpile`
--

INSERT INTO `stokpile` (`id_stokpile`, `kode_lahan`, `stok`) VALUES
(2, 'Pit Utara', 152.61),
(4, 'Pit Timur', 70.59),
(5, 'Pit Barat', 68.19);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(255) NOT NULL,
  `no_transaksi` varchar(10) NOT NULL,
  `id_mitra` int(255) NOT NULL,
  `tanggal` date NOT NULL,
  `surveyor` enum('Geoservices','Anindya','SGS Indonesia','Surveyor Indonesia','Sucofindo','CCIC','lOL','Carsurin') NOT NULL,
  `tonase` float NOT NULL,
  `harga` varchar(15) NOT NULL,
  `target` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `no_transaksi`, `id_mitra`, `tanggal`, `surveyor`, `tonase`, `harga`, `target`) VALUES
(11, '1056391', 2, '2020-02-29', 'Geoservices', 370, '5180000000', 170.45);

-- --------------------------------------------------------

--
-- Table structure for table `truk`
--

CREATE TABLE `truk` (
  `id_truk` int(255) NOT NULL,
  `kode_truk` varchar(5) NOT NULL,
  `merk` varchar(40) NOT NULL,
  `daya_angkut` float NOT NULL,
  `nopolisi` varchar(11) NOT NULL,
  `id_mitra` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `truk`
--

INSERT INTO `truk` (`id_truk`, `kode_truk`, `merk`, `daya_angkut`, `nopolisi`, `id_mitra`) VALUES
(37, 'A001', 'Hino 500', 70, 'DA 124A BA5', 1),
(41, 'PD01', 'Hino Truk Ranger FM 350 T/H', 50, 'DA 5231 BA', 6),
(43, 'A002', 'Hino 235 TI', 60, 'DA P34 GH55', 1),
(44, 'G003', 'Hino 500', 70, 'DA P74 BB71', 3),
(45, 'G007', 'Hino Truk Ranger FM 350 T/H', 50, 'DA P39 JH62', 3),
(46, 'A009', 'Hino 700 Series Profia SS1E Tractor Head', 65, 'DA L58 JG82', 1),
(47, 'PD02', 'Hino 500', 50, 'DA P34 CH75', 6),
(48, 'PD03', 'Hino 700 Series Profia SS1E Tractor Head', 70, 'DA L93 NG45', 6),
(49, 'PD04', 'Hino Truk Ranger FM 350 T/H', 65, 'DA F40 NV62', 6),
(50, 'PD05', 'Hino Truk Ranger SG 260', 55, 'DA W12 lJ21', 6);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(1) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kirim`
--
ALTER TABLE `kirim`
  ADD PRIMARY KEY (`id_kirim`),
  ADD KEY `id_produksi` (`id_stokpile`),
  ADD KEY `id_kontrak` (`id_transaksi`),
  ADD KEY `id_truk` (`id_truk`);

--
-- Indexes for table `kontrak`
--
ALTER TABLE `kontrak`
  ADD PRIMARY KEY (`id_kontrak`),
  ADD KEY `id_mitra` (`id_mitra`);

--
-- Indexes for table `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id_mitra`);

--
-- Indexes for table `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`id_produksi`),
  ADD KEY `id_stokpile` (`id_stokpile`),
  ADD KEY `id_truk` (`id_truk`);

--
-- Indexes for table `stokpile`
--
ALTER TABLE `stokpile`
  ADD PRIMARY KEY (`id_stokpile`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_mitra` (`id_mitra`);

--
-- Indexes for table `truk`
--
ALTER TABLE `truk`
  ADD PRIMARY KEY (`id_truk`),
  ADD KEY `id_mitra` (`id_mitra`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kirim`
--
ALTER TABLE `kirim`
  MODIFY `id_kirim` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kontrak`
--
ALTER TABLE `kontrak`
  MODIFY `id_kontrak` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `mitra`
--
ALTER TABLE `mitra`
  MODIFY `id_mitra` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id_produksi` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `stokpile`
--
ALTER TABLE `stokpile`
  MODIFY `id_stokpile` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `truk`
--
ALTER TABLE `truk`
  MODIFY `id_truk` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kirim`
--
ALTER TABLE `kirim`
  ADD CONSTRAINT `kirim_ibfk_1` FOREIGN KEY (`id_stokpile`) REFERENCES `stokpile` (`id_stokpile`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kirim_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kirim_ibfk_3` FOREIGN KEY (`id_truk`) REFERENCES `truk` (`id_truk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kontrak`
--
ALTER TABLE `kontrak`
  ADD CONSTRAINT `kontrak_ibfk_1` FOREIGN KEY (`id_mitra`) REFERENCES `mitra` (`id_mitra`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produksi`
--
ALTER TABLE `produksi`
  ADD CONSTRAINT `produksi_ibfk_1` FOREIGN KEY (`id_stokpile`) REFERENCES `stokpile` (`id_stokpile`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produksi_ibfk_2` FOREIGN KEY (`id_truk`) REFERENCES `truk` (`id_truk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_mitra`) REFERENCES `mitra` (`id_mitra`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `truk`
--
ALTER TABLE `truk`
  ADD CONSTRAINT `truk_ibfk_1` FOREIGN KEY (`id_mitra`) REFERENCES `mitra` (`id_mitra`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
