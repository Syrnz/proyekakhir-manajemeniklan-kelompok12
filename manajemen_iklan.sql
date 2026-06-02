-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 02, 2026 at 02:48 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manajemen_iklan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('super','staff') DEFAULT 'staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'RudiBayuSuganda', 'rudib6929@gmail.com', '$2y$10$s6xPqjkPrJHydXnRlV/D5eZRtXoBUrb8NLZeyCJVTgobAmbCSAhR.', 'staff'),
(2, 'Reno Irvansyah', 'vasyah@gmail.com', '$2y$10$.AlN9iyIWi51y9baenDxyOVxnlzTcsIfJ1qT4cjshFGllZK363wEK', 'staff'),
(3, 'admin', 'admin@gmail.com', '$2y$10$wvEZMttw0tzwTuzw8BB2yewlaxG133FjA.CbhvalLSOYCmL5yLWu.', 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembayaran`
--

CREATE TABLE `detail_pembayaran` (
  `id_detail` int NOT NULL,
  `id_pembayaran` int NOT NULL,
  `tanggal_dibuat_tagihan` datetime DEFAULT NULL,
  `nominal_bayar` decimal(15,2) DEFAULT NULL,
  `metode_pembayaran` enum('transfer bank','qris','cash','e-wallet') DEFAULT 'transfer bank',
  `tanggal_bayar` datetime DEFAULT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `status_bayar` enum('lunas','belum lunas') DEFAULT 'belum lunas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_pembayaran`
--

INSERT INTO `detail_pembayaran` (`id_detail`, `id_pembayaran`, `tanggal_dibuat_tagihan`, `nominal_bayar`, `metode_pembayaran`, `tanggal_bayar`, `bukti_pembayaran`, `status_bayar`) VALUES
(5, 5, '2026-06-02 19:47:45', 8750000.00, 'transfer bank', '2026-06-02 19:48:04', '1780404484_Cuplikan layar 2025-09-28 204706.png', 'lunas'),
(6, 6, '2026-06-02 20:02:10', 24000000.00, 'transfer bank', '2026-06-02 20:02:29', '1780405349_Cuplikan layar 2025-09-28 202449.png', 'lunas'),
(7, 7, '2026-06-02 20:52:02', 10500000.00, 'qris', '2026-06-02 20:52:19', '1780408339_Cuplikan layar 2025-09-26 164201.png', 'lunas'),
(8, 8, '2026-06-02 20:59:37', 154000000.00, 'e-wallet', '2026-06-02 20:59:54', '1780408794_images.jpg', 'lunas'),
(9, 9, '2026-06-02 21:06:24', 11200000.00, 'qris', '2026-06-02 21:06:40', '1780409200_images.jpg', 'lunas'),
(10, 10, '2026-06-02 21:09:28', 216000000.00, 'transfer bank', '2026-06-02 21:09:49', '1780409389_images.jpg', 'lunas'),
(11, 12, '2026-06-02 21:17:23', 21000000.00, 'transfer bank', '2026-06-02 21:17:37', '1780409857_images.jpg', 'lunas'),
(12, 13, '2026-06-02 21:19:42', 70000000.00, 'qris', '2026-06-02 21:19:56', '1780409996_images.jpg', 'lunas'),
(13, 14, '2026-06-02 21:24:11', 154000000.00, 'e-wallet', '2026-06-02 21:24:31', '1780410271_images.jpg', 'lunas'),
(14, 18, '2026-06-02 21:34:57', 228000000.00, 'transfer bank', '2026-06-02 21:35:13', '1780410913_images.jpg', 'lunas'),
(15, 20, '2026-06-02 21:37:34', 80000000.00, 'e-wallet', '2026-06-02 21:37:49', '1780411069_images.jpg', 'lunas');

-- --------------------------------------------------------

--
-- Table structure for table `iklan`
--

CREATE TABLE `iklan` (
  `id_iklan` int NOT NULL,
  `id_pelanggan` int NOT NULL,
  `id_lokasi` int NOT NULL,
  `judul_iklan` varchar(150) NOT NULL,
  `file_iklan` varchar(255) DEFAULT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `durasi_hari` int DEFAULT NULL,
  `total_harga` decimal(12,2) NOT NULL,
  `status_iklan` enum('belum_tayang','aktif','selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'belum_tayang',
  `status_pembayaran` enum('pending','lunas') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status_data` enum('aktif','selesai','dibatalkan') NOT NULL DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `iklan`
--

INSERT INTO `iklan` (`id_iklan`, `id_pelanggan`, `id_lokasi`, `judul_iklan`, `file_iklan`, `tanggal_mulai`, `tanggal_selesai`, `durasi_hari`, `total_harga`, `status_iklan`, `status_pembayaran`, `created_at`, `updated_at`, `status_data`) VALUES
(6, 6, 107, 'Bali', '1780404385_Screenshot 2026-05-31 235334.png', '2026-06-02', '2026-06-09', 7, 8750000.00, 'selesai', 'lunas', '2026-06-02 12:46:25', '2026-06-02 12:46:38', 'selesai'),
(7, 2, 106, 'Anniv Snezynaya', '1780405166_Cuplikan layar 2025-09-28 204734.png', '2026-06-07', '2026-06-23', 16, 24000000.00, 'selesai', 'lunas', '2026-06-02 12:59:26', '2026-06-02 13:03:03', 'selesai'),
(8, 8, 106, 'Pomo  Rhamadan', '1780408265_Cuplikan layar 2025-09-26 164201.png', '2026-06-04', '2026-06-11', 7, 10500000.00, 'selesai', 'lunas', '2026-06-02 13:51:05', '2026-06-02 13:52:42', 'selesai'),
(9, 7, 95, 'Sewa Properti Murah', '1780408451_Cuplikan layar 2025-09-26 164201.png', '2026-06-05', '2026-06-16', 11, 66000000.00, 'belum_tayang', 'pending', '2026-06-02 13:54:11', '2026-06-02 13:54:11', 'dibatalkan'),
(10, 3, 92, 'Promo Makanan', '1780408664_images.jpg', '2026-06-02', '2026-06-30', 28, 154000000.00, 'selesai', 'lunas', '2026-06-02 13:57:44', '2026-06-02 14:00:13', 'selesai'),
(11, 9, 98, 'Promo Makan', '1780409032_images.jpg', '2026-07-02', '2026-07-16', 14, 49000000.00, 'belum_tayang', 'pending', '2026-06-02 14:03:52', '2026-06-02 14:03:52', 'dibatalkan'),
(12, 1, 110, 'promo beli 3 gratis 1', '1780409131_images.jpg', '2026-06-10', '2026-06-17', 7, 11200000.00, 'aktif', 'lunas', '2026-06-02 14:05:31', '2026-06-02 14:05:31', 'selesai'),
(13, 10, 96, 'Diskon 50%', '1780409294_images.jpg', '2026-06-03', '2026-06-30', 27, 216000000.00, 'aktif', 'lunas', '2026-06-02 14:08:14', '2026-06-02 14:08:14', 'selesai'),
(14, 6, 103, 'gratis pemasangan', '1780409486_images.jpg', '2026-06-30', '2026-07-30', 30, 28500000.00, 'belum_tayang', 'pending', '2026-06-02 14:11:26', '2026-06-02 14:11:26', 'dibatalkan'),
(15, 5, 120, 'Bisa cicilan', '1780409605_images.jpg', '2026-06-09', '2026-06-17', 8, 112000000.00, 'aktif', 'pending', '2026-06-02 14:13:25', '2026-06-02 14:15:04', 'aktif'),
(16, 5, 120, 'Bisa cicilan', '1780409615_images.jpg', '2026-06-09', '2026-06-17', 8, 112000000.00, 'belum_tayang', 'pending', '2026-06-02 14:13:35', '2026-06-02 14:13:35', 'selesai'),
(17, 9, 108, 'Gratis pemasangan', '1780409796_images.jpg', '2026-06-10', '2026-06-30', 20, 21000000.00, 'belum_tayang', 'lunas', '2026-06-02 14:16:36', '2026-06-02 14:16:36', 'aktif'),
(18, 4, 93, 'Solusi untuk pemasaran', '1780409920_images.jpg', '2026-06-05', '2026-06-15', 10, 70000000.00, 'aktif', 'lunas', '2026-06-02 14:18:40', '2026-06-02 14:18:40', 'aktif'),
(19, 7, 114, 'Promo bulan baru', '1780410096_images.jpg', '2026-07-01', '2026-07-14', 13, 143000000.00, 'aktif', 'pending', '2026-06-02 14:21:36', '2026-06-02 14:21:36', 'aktif'),
(20, 8, 92, 'Garansi 1 tahun', '1780410187_images.jpg', '2026-06-02', '2026-06-30', 28, 154000000.00, 'aktif', 'lunas', '2026-06-02 14:23:07', '2026-06-02 14:23:07', 'aktif'),
(21, 2, 104, 'Layanan digital serbaguna', '1780410343_images.jpg', '2026-08-01', '2026-08-15', 14, 18200000.00, 'belum_tayang', 'pending', '2026-06-02 14:25:43', '2026-06-02 14:25:43', 'aktif'),
(22, 3, 95, 'Produk murah Meriah', '1780410437_images.jpg', '2026-06-25', '2026-06-30', 5, 30000000.00, 'aktif', 'pending', '2026-06-02 14:27:17', '2026-06-02 14:43:05', 'aktif'),
(23, 1, 105, 'Barang  bekas rasa baru', '1780410528_images.jpg', '2026-06-29', '2026-07-07', 8, 8800000.00, 'belum_tayang', 'pending', '2026-06-02 14:28:48', '2026-06-02 14:28:48', 'aktif'),
(24, 10, 112, 'Penerbangan gratis makan', '1780410819_images.jpg', '2026-06-10', '2026-06-29', 19, 228000000.00, 'aktif', 'lunas', '2026-06-02 14:33:39', '2026-06-02 14:33:39', 'aktif'),
(25, 7, 91, 'Property Siap Pakai', '1780410996_images.jpg', '2026-08-01', '2026-08-17', 16, 80000000.00, 'aktif', 'lunas', '2026-06-02 14:36:36', '2026-06-02 14:40:42', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_iklan`
--

CREATE TABLE `jenis_iklan` (
  `id_jenis` int NOT NULL,
  `nama_jenis` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jenis_iklan`
--

INSERT INTO `jenis_iklan` (`id_jenis`, `nama_jenis`) VALUES
(1, 'Videotron'),
(2, 'Billboard'),
(3, 'Banner');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_keuangan`
--

CREATE TABLE `laporan_keuangan` (
  `id_laporan` int NOT NULL,
  `id_detail` int DEFAULT NULL,
  `pemasukan` decimal(12,2) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `laporan_keuangan`
--

INSERT INTO `laporan_keuangan` (`id_laporan`, `id_detail`, `pemasukan`, `tanggal_masuk`, `created_at`) VALUES
(3, 5, 8750000.00, '2026-06-02', '2026-06-02 12:48:04'),
(4, 6, 24000000.00, '2026-06-02', '2026-06-02 13:02:29'),
(5, 7, 10500000.00, '2026-06-02', '2026-06-02 13:52:19'),
(6, 8, 154000000.00, '2026-06-02', '2026-06-02 13:59:54'),
(7, 9, 11200000.00, '2026-06-02', '2026-06-02 14:06:40'),
(8, 10, 216000000.00, '2026-06-02', '2026-06-02 14:09:49'),
(9, 11, 21000000.00, '2026-06-02', '2026-06-02 14:17:37'),
(10, 12, 70000000.00, '2026-06-02', '2026-06-02 14:19:56'),
(11, 13, 154000000.00, '2026-06-02', '2026-06-02 14:24:31'),
(12, 14, 228000000.00, '2026-06-02', '2026-06-02 14:35:13'),
(13, 15, 80000000.00, '2026-06-02', '2026-06-02 14:37:49');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_iklan`
--

CREATE TABLE `lokasi_iklan` (
  `id_lokasi` int NOT NULL,
  `id_jenis` int DEFAULT NULL,
  `kode_lokasi` varchar(20) NOT NULL,
  `nama_lokasi` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `status` enum('tersedia','disewa','maintenance') DEFAULT 'tersedia',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lokasi_iklan`
--

INSERT INTO `lokasi_iklan` (`id_lokasi`, `id_jenis`, `kode_lokasi`, `nama_lokasi`, `alamat`, `harga`, `status`, `created_at`) VALUES
(91, 1, 'VDT001', 'Videotron Alun-Alun Kota', 'Jl. Ahmad Yani No.1', 5000000.00, 'disewa', '2026-06-01 19:52:11'),
(92, 1, 'VDT002', 'Videotron Simpang Lima', 'Jl. Pahlawan No.12', 5500000.00, 'disewa', '2026-06-01 19:52:11'),
(93, 1, 'VDT003', 'Videotron Mall Center', 'Jl. Gatot Subroto No.8', 7000000.00, 'disewa', '2026-06-01 19:52:11'),
(94, 1, 'VDT004', 'Videotron Terminal Utama', 'Jl. Raya Terminal', 4500000.00, 'tersedia', '2026-06-01 19:52:11'),
(95, 1, 'VDT005', 'Videotron Stasiun Kota', 'Jl. Stasiun Timur', 6000000.00, 'disewa', '2026-06-01 19:52:11'),
(96, 1, 'VDT006', 'Videotron Bundaran Besar', 'Jl. Sudirman', 8000000.00, 'tersedia', '2026-06-01 19:52:11'),
(97, 1, 'VDT007', 'Videotron Kampus Utama', 'Jl. Pendidikan', 4000000.00, 'maintenance', '2026-06-01 19:52:11'),
(98, 1, 'VDT008', 'Videotron Pasar Modern', 'Jl. Niaga Baru', 3500000.00, 'tersedia', '2026-06-01 19:52:11'),
(99, 1, 'VDT009', 'Videotron Flyover Barat', 'Jl. Lingkar Barat', 6500000.00, 'tersedia', '2026-06-01 19:52:11'),
(100, 1, 'VDT010', 'Videotron Bandara', 'Jl. Bandara Internasional', 9000000.00, 'tersedia', '2026-06-01 19:52:11'),
(101, 3, 'BNR001', 'Banner Jalan Mawar', 'Jl. Mawar No.5', 1000000.00, 'tersedia', '2026-06-01 19:52:11'),
(102, 3, 'BNR002', 'Banner Jalan Melati', 'Jl. Melati No.10', 1200000.00, 'tersedia', '2026-06-01 19:52:11'),
(103, 3, 'BNR003', 'Banner Jalan Kenanga', 'Jl. Kenanga No.2', 950000.00, 'tersedia', '2026-06-01 19:52:11'),
(104, 3, 'BNR004', 'Banner Depan Sekolah', 'Jl. Pendidikan Barat', 1300000.00, 'disewa', '2026-06-01 19:52:11'),
(105, 3, 'BNR005', 'Banner Dekat Pasar', 'Jl. Pasar Baru', 1100000.00, 'disewa', '2026-06-01 19:52:11'),
(106, 3, 'BNR006', 'Banner Area Stadion', 'Jl. Stadion Utama', 1500000.00, 'tersedia', '2026-06-01 19:52:11'),
(107, 3, 'BNR007', 'Banner Area Kampus', 'Jl. Mahasiswa', 1250000.00, 'tersedia', '2026-06-01 19:52:11'),
(108, 3, 'BNR008', 'Banner Jalan Veteran', 'Jl. Veteran No.20', 1050000.00, 'disewa', '2026-06-01 19:52:11'),
(109, 3, 'BNR009', 'Banner Simpang Tiga', 'Jl. Simpang Raya', 1400000.00, 'tersedia', '2026-06-01 19:52:11'),
(110, 3, 'BNR010', 'Banner Kawasan Industri', 'Jl. Industri Timur', 1600000.00, 'tersedia', '2026-06-01 19:52:11'),
(111, 2, 'BLB001', 'Billboard Gerbang Kota', 'Jl. Gerbang Utama', 10000000.00, 'tersedia', '2026-06-01 19:52:11'),
(112, 2, 'BLB002', 'Billboard Jalan Nasional', 'Jl. Nasional KM 5', 12000000.00, 'disewa', '2026-06-01 19:52:11'),
(113, 2, 'BLB003', 'Billboard Dekat Mall', 'Jl. Supermall Center', 9500000.00, 'tersedia', '2026-06-01 19:52:11'),
(114, 2, 'BLB004', 'Billboard Flyover Timur', 'Jl. Flyover Timur', 11000000.00, 'disewa', '2026-06-01 19:52:11'),
(115, 2, 'BLB005', 'Billboard Bundaran Selatan', 'Jl. Bundaran Selatan', 10500000.00, 'tersedia', '2026-06-01 19:52:11'),
(116, 2, 'BLB006', 'Billboard Exit Tol', 'Jl. Exit Tol Utama', 13000000.00, 'tersedia', '2026-06-01 19:52:11'),
(117, 2, 'BLB007', 'Billboard Area Wisata', 'Jl. Wisata Pantai', 8500000.00, 'tersedia', '2026-06-01 19:52:11'),
(118, 2, 'BLB008', 'Billboard Kawasan Bisnis', 'Jl. Business Center', 15000000.00, 'tersedia', '2026-06-01 19:52:11'),
(119, 2, 'BLB009', 'Billboard Simpang Empat', 'Jl. Simpang Empat Besar', 9800000.00, 'tersedia', '2026-06-01 19:52:11'),
(120, 2, 'BLB010', 'Billboard Area Perkantoran', 'Jl. Office Tower', 14000000.00, 'tersedia', '2026-06-01 19:52:11');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int NOT NULL,
  `kode_pelanggan` char(16) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `no_hp` char(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `kode_pelanggan`, `nama_pelanggan`, `email`, `no_hp`, `alamat`, `created_at`) VALUES
(1, 'COMP202606020001', 'PT Maju Jaya Sejahtera', 'info@majujayasejahtera.co.id', '0215556789', 'Gedung Menara Mulia Lt. 15, Jl. Jend. Gatot Subroto, Jakarta Selatan', '2026-06-01 19:56:16'),
(2, 'COMP202606020002', 'CV Sinar Baru Digital', 'marcom@sinarbarudigital.com', '0318432110', 'Ruko Juanda Makmur Blok D No. 4, Sidoarjo, Jawa Timur', '2026-06-01 19:56:16'),
(3, 'COMP202606020003', 'PT Indofood Makmur Tbk', 'corporate@indofoodmakmur.co.id', '0217788990', 'Kawasan Industri Wijayakusuma Blok B/12, Semarang', '2026-06-01 19:56:16'),
(4, 'COMP202606020004', 'PT Techindo Solusi Digital', 'hello@techindo.id', '081234567890', 'Jl. AM Sangaji No. 87, Jetis, Yogyakarta', '2026-06-01 19:56:16'),
(5, 'COMP202606020005', 'PT Bank Mandiri (Persero) Tbk', 'cc@bankmandiri.co.id', '0213998877', 'Plaza Mandiri, Jl. Jend. Gatot Subroto Kav. 36-38, Jakarta', '2026-06-01 19:56:16'),
(6, 'COMP202606020006', 'CV Bali Agung Lestari', 'info@baliagunglestari.com', '0361445566', 'Jl. Bypass Ngurah Rai No. 100, Kuta, Bali', '2026-06-01 19:56:16'),
(7, 'COMP202606020007', 'PT Nusantara Property Group', 'marketing@nusantaraproperty.com', '0411778899', 'Sudirman Loop Avenue Kav. 45, Makassar', '2026-06-01 19:56:16'),
(8, 'COMP202606020008', 'PT Unilever Indonesia Tbk', 'media.relations@unilever.com', '0213822334', 'Gedung Grha Unilever, BSD Green Office Park Kav. 3, Tangerang', '2026-06-01 19:56:16'),
(9, 'COMP202606020009', 'PT Borneo Energi Utama', 'admin@borneoenergi.co.id', '0542114477', 'Jl. Sudirman No. 22, Balikpapan, Kalimantan Timur', '2026-06-01 19:56:16'),
(10, 'COMP202606020010', 'PT Sriwijaya Air', 'corporate.secretary@sriwijayaair.co.id', '0211122334', 'Jl. Marsekal Suryadarma No. 9, Tangerang, Banten', '2026-06-01 19:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int NOT NULL,
  `id_iklan` int NOT NULL,
  `kode_invoice` varchar(50) NOT NULL,
  `total_tagihan` decimal(12,2) NOT NULL,
  `status_pembayaran` enum('pending','sebagian','lunas') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_iklan`, `kode_invoice`, `total_tagihan`, `status_pembayaran`, `created_at`, `updated_at`) VALUES
(5, 6, '1', 8750000.00, 'lunas', '2026-06-02 12:46:53', '2026-06-02 12:48:15'),
(6, 7, '2', 24000000.00, 'lunas', '2026-06-02 13:01:32', '2026-06-02 13:02:34'),
(7, 8, '3', 10500000.00, 'lunas', '2026-06-02 13:51:36', '2026-06-02 13:52:24'),
(8, 10, '4', 154000000.00, 'lunas', '2026-06-02 13:58:58', '2026-06-02 14:00:00'),
(9, 12, '5', 11200000.00, 'lunas', '2026-06-02 14:05:49', '2026-06-02 14:06:47'),
(10, 13, '6', 216000000.00, 'lunas', '2026-06-02 14:08:27', '2026-06-02 14:09:54'),
(11, 15, '7', 112000000.00, 'lunas', '2026-06-02 14:15:22', '2026-06-02 14:15:22'),
(12, 17, '8', 21000000.00, 'lunas', '2026-06-02 14:16:58', '2026-06-02 14:17:42'),
(13, 18, '9', 70000000.00, 'lunas', '2026-06-02 14:19:07', '2026-06-02 14:20:02'),
(14, 20, '10', 154000000.00, 'lunas', '2026-06-02 14:23:23', '2026-06-02 14:24:36'),
(15, 19, '11', 143000000.00, 'pending', '2026-06-02 14:23:37', '2026-06-02 14:23:37'),
(16, 21, '12', 18200000.00, 'pending', '2026-06-02 14:26:00', '2026-06-02 14:26:00'),
(17, 22, '13', 30000000.00, 'pending', '2026-06-02 14:27:29', '2026-06-02 14:27:29'),
(18, 24, '15', 228000000.00, 'lunas', '2026-06-02 14:33:56', '2026-06-02 14:35:22'),
(19, 23, '16', 8800000.00, 'pending', '2026-06-02 14:34:19', '2026-06-02 14:34:19'),
(20, 25, '17', 80000000.00, 'lunas', '2026-06-02 14:36:52', '2026-06-02 14:37:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_pembayaran`
--
ALTER TABLE `detail_pembayaran`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_pembayaran` (`id_pembayaran`);

--
-- Indexes for table `iklan`
--
ALTER TABLE `iklan`
  ADD PRIMARY KEY (`id_iklan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_lokasi` (`id_lokasi`);

--
-- Indexes for table `jenis_iklan`
--
ALTER TABLE `jenis_iklan`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `laporan_keuangan`
--
ALTER TABLE `laporan_keuangan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD UNIQUE KEY `id_detail` (`id_detail`);

--
-- Indexes for table `lokasi_iklan`
--
ALTER TABLE `lokasi_iklan`
  ADD PRIMARY KEY (`id_lokasi`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD UNIQUE KEY `kode_pelanggan` (`kode_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD UNIQUE KEY `kode_invoice` (`kode_invoice`),
  ADD KEY `id_iklan` (`id_iklan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_pembayaran`
--
ALTER TABLE `detail_pembayaran`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `iklan`
--
ALTER TABLE `iklan`
  MODIFY `id_iklan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `jenis_iklan`
--
ALTER TABLE `jenis_iklan`
  MODIFY `id_jenis` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `laporan_keuangan`
--
ALTER TABLE `laporan_keuangan`
  MODIFY `id_laporan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `lokasi_iklan`
--
ALTER TABLE `lokasi_iklan`
  MODIFY `id_lokasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pembayaran`
--
ALTER TABLE `detail_pembayaran`
  ADD CONSTRAINT `detail_pembayaran_ibfk_1` FOREIGN KEY (`id_pembayaran`) REFERENCES `pembayaran` (`id_pembayaran`);

--
-- Constraints for table `iklan`
--
ALTER TABLE `iklan`
  ADD CONSTRAINT `iklan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE RESTRICT,
  ADD CONSTRAINT `iklan_ibfk_2` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi_iklan` (`id_lokasi`) ON DELETE RESTRICT;

--
-- Constraints for table `lokasi_iklan`
--
ALTER TABLE `lokasi_iklan`
  ADD CONSTRAINT `lokasi_iklan_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_iklan` (`id_jenis`) ON DELETE RESTRICT;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_iklan`) REFERENCES `iklan` (`id_iklan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
