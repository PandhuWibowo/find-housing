-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 17, 2021 at 07:51 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cari_alamat`
--

-- --------------------------------------------------------

--
-- Table structure for table `citizens`
--

CREATE TABLE `citizens` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `nik` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendidikan` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pernikahan` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `domisili` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `citizens`
--

INSERT INTO `citizens` (`id_user`, `nik`, `nama`, `alamat`, `no_telp`, `pendidikan`, `pekerjaan`, `status_pernikahan`, `tgl_lahir`, `domisili`) VALUES
(1, '3201111211040003', 'Raihan Hafidz Ruliyansah', 'Perumahan Z', '081399999999', 'SMA', 'Pelajar', 'Belum Kawin', '2000-01-01', 'Jakarta'),
(1, '3172012203010006', 'Rakha Hadi Ruliyansah', 'Perumahan Yang Sama', '081399999998', 'SMA', 'Pelajar', 'Belum Kawin', '2001-01-01', 'Depok');

-- --------------------------------------------------------

--
-- Table structure for table `detil_kk`
--

CREATE TABLE `detil_kk` (
  `id_kk` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik_keluarga` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_keluarga` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detil_kk`
--

INSERT INTO `detil_kk` (`id_kk`, `nik_keluarga`, `status_keluarga`) VALUES
('3172010502090982', '3201111211040003', 'Anak'),
('3172010502090982', '3172012203010006', 'Anak');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kartu_keluarga`
--

CREATE TABLE `kartu_keluarga` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `id_kk` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik_kepala_keluarga` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_tempat_tinggal` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domisili` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kartu_keluarga`
--

INSERT INTO `kartu_keluarga` (`id_user`, `id_kk`, `nik_kepala_keluarga`, `status_tempat_tinggal`, `domisili`) VALUES
(1, '3172010502090982', '3275111002880003', 'Sewa', 'Jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_03_17_115118_create_citizens_table', 1),
(5, '2021_03_17_120140_create_kartu_keluarga_table', 1),
(6, '2021_03_17_120502_create_detil_kk_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `alamat`, `no_telp`, `jabatan`, `password`) VALUES
(1, 'John Doe', 'Perumahan A', '08911111111', 'superAdmin', '$2y$10$rAgHfADIZ/kPlSpJu/fgyeKUAK/Zfu6EfJIiCMW8IPsKSIli3dHri'),
(3, 'Johnson', 'Perumahan C', '08922222222', 'superAdmin', '$2y$10$Ei9XOnxrykk46UKZYy/BiOJJJG8zXms6OjifK/Aba9C9r1AiysMte');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `citizens`
--
ALTER TABLE `citizens`
  ADD PRIMARY KEY (`nik`),
  ADD KEY `citizens_id_user_foreign` (`id_user`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kartu_keluarga`
--
ALTER TABLE `kartu_keluarga`
  ADD PRIMARY KEY (`id_kk`),
  ADD UNIQUE KEY `kartu_keluarga_nik_kepala_keluarga_unique` (`nik_kepala_keluarga`),
  ADD KEY `kartu_keluarga_id_user_foreign` (`id_user`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
