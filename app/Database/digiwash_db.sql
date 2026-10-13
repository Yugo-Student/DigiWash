-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2026 at 04:40 PM
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
-- Database: `digiwash_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(10) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `noHP` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `noHP`, `email`, `password`, `created_at`, `updated_at`, `status`, `foto`) VALUES
(1, 'Admin DigiWash', '081200000001', 'admin@digiwash.test', '$2y$10$k3cyB68nEezeQTk.v2nmLeFwPSbvMxaEubA9/zBvbgLvumHcS70Oq', '2026-10-09 13:03:42', '2026-10-10 14:07:30', 'aktif', '1791641250_d87a8959c52f4a65e0ee.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `alamat_pelanggan`
--

CREATE TABLE `alamat_pelanggan` (
  `id_alamat` int(10) UNSIGNED NOT NULL,
  `id_pelanggan` int(10) UNSIGNED NOT NULL,
  `label` varchar(30) NOT NULL,
  `nama_penerima` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `catatan_kurir` varchar(150) DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kurir`
--

CREATE TABLE `kurir` (
  `id_kurir` int(10) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `status` enum('tersedia','bertugas','nonaktif') NOT NULL DEFAULT 'tersedia',
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kurir`
--

INSERT INTO `kurir` (`id_kurir`, `nama`, `no_hp`, `status`, `email`, `password`, `created_at`, `updated_at`, `foto`) VALUES
(1, 'Andi Kurniawan', '081200000020', 'tersedia', 'andi@digiwash.test', '$2y$10$k3cyB68nEezeQTk.v2nmLeFwPSbvMxaEubA9/zBvbgLvumHcS70Oq', '2026-10-09 13:03:42', '2026-10-09 13:03:42', NULL),
(2, 'Rudi Hartono', '081200000021', 'tersedia', 'rudi@digiwash.test', '$2y$10$k3cyB68nEezeQTk.v2nmLeFwPSbvMxaEubA9/zBvbgLvumHcS70Oq', '2026-10-09 13:03:42', '2026-10-09 13:03:42', NULL),
(3, 'Ziya', '089023433456', 'tersedia', 'kurir@digiwash.test', '$2y$10$UFNta2swSXWf.gNU9zTEa.V5GRDjF2DkdI1xmKpXZ.Y/xAdFhq/Ma', '2026-10-10 13:57:23', '2026-10-10 14:22:56', '1791642176_8c9390f39b998f540ffc.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(10) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `alamat_alternatif` text DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `no_hp`, `alamat`, `alamat_alternatif`, `email`, `tanggal_lahir`, `jenis_kelamin`, `password`, `created_at`, `updated_at`, `foto`, `status`) VALUES
(1, 'Budi Santoso', '081200000010', 'Jl. A. Yani Km 5, Banjarbaru', NULL, 'budi@digiwash.test', NULL, NULL, '$2y$10$k3cyB68nEezeQTk.v2nmLeFwPSbvMxaEubA9/zBvbgLvumHcS70Oq', '2026-10-09 13:03:42', '2026-10-09 13:03:42', NULL, 'aktif'),
(2, 'Siti Rahma', '081200000011', 'Jl. Lambung Mangkurat No. 12, Banjarmasin', 'Jl. Veteran No. 3, Banjarmasin', 'siti@digiwash.test', NULL, NULL, '$2y$10$k3cyB68nEezeQTk.v2nmLeFwPSbvMxaEubA9/zBvbgLvumHcS70Oq', '2026-10-09 13:03:42', '2026-10-10 14:26:29', '1791642389_5bca7a32eb6f9bb93fbc.jpeg', 'aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `uq_admin_email` (`email`),
  ADD UNIQUE KEY `uq_admin_noHP` (`noHP`);

--
-- Indexes for table `alamat_pelanggan`
--
ALTER TABLE `alamat_pelanggan`
  ADD PRIMARY KEY (`id_alamat`),
  ADD KEY `fk_alamat_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`id_kurir`),
  ADD UNIQUE KEY `uq_kurir_email` (`email`),
  ADD UNIQUE KEY `uq_kurir_no_hp` (`no_hp`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD UNIQUE KEY `uq_pelanggan_email` (`email`),
  ADD UNIQUE KEY `uq_pelanggan_no_hp` (`no_hp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alamat_pelanggan`
--
ALTER TABLE `alamat_pelanggan`
  MODIFY `id_alamat` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kurir`
--
ALTER TABLE `kurir`
  MODIFY `id_kurir` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alamat_pelanggan`
--
ALTER TABLE `alamat_pelanggan`
  ADD CONSTRAINT `fk_alamat_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
