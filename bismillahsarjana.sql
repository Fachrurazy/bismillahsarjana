-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2021 at 01:54 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bismillahsarjana`
--

-- --------------------------------------------------------

--
-- Table structure for table `distanion`
--

CREATE TABLE `distanion` (
  `id` int(10) UNSIGNED NOT NULL,
  `Tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Distance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `distanion`
--

INSERT INTO `distanion` (`id`, `Tujuan`, `Distance`, `Duration`, `Value`, `created_at`, `updated_at`) VALUES
(1, 'Jl. Raya Mayor Oking Jaya Atmaja No.9, Cirimekar, Cibinong, Bogor, Jawa Barat 16917|Jalan Raya Mayor Oking Jaya Atmaja No.KM, RW No.101, Ciriung, Cibinong, Bogor, Jawa Barat 16917', '6,6 km', '20 menit', '6604', '2021-05-19 05:42:33', '2021-05-19 05:42:33'),
(2, 'Jl. Raya Mayor Oking Jaya Atmaja No.9, Cirimekar, Cibinong, Bogor, Jawa Barat 16917|Jalan Raya Mayor Oking Jaya Atmaja No.KM, RW No.101, Ciriung, Cibinong, Bogor, Jawa Barat 16917', '6,6 km', '20 min', '6604', '2021-05-19 05:56:49', '2021-05-19 05:56:49');

-- --------------------------------------------------------

--
-- Table structure for table `estimation`
--

CREATE TABLE `estimation` (
  `id` int(10) UNSIGNED NOT NULL,
  `origin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distance_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `estimation`
--

INSERT INTO `estimation` (`id`, `origin`, `destination`, `distance`, `distance_value`, `duration`, `duration_value`, `created_at`, `updated_at`) VALUES
(1, 'RSUD Cibinong', 'Jl. Raya Mayor Oking Jaya Atmaja No.9, Cirimekar, Cibinong, Bogor, Jawa Barat 16917|Jalan Raya Mayor Oking Jaya Atmaja No.KM, RW No.101, Ciriung, Cibinong, Bogor, Jawa Barat 16917', '6,6 km', '6604', '20 min', '1209', '2021-05-19 09:09:24', '2021-05-19 09:09:24'),
(2, 'Cibinong City Mall, Jalan Tegar Beriman, Pakansari, Bogor, Jawa Barat, Indonesia', 'Jl. Raya Mayor Oking Jaya Atmaja No.9, Cirimekar, Cibinong, Bogor, Jawa Barat 16917|Jalan Raya Mayor Oking Jaya Atmaja No.KM, RW No.101, Ciriung, Cibinong, Bogor, Jawa Barat 16917', '3,8 km', '3830', '13 min', '804', '2021-05-20 06:05:42', '2021-05-20 06:05:42'),
(3, 'cibinong city mall', 'Jl. Raya Mayor Oking Jaya Atmaja No.9, Cirimekar, Cibinong, Bogor, Jawa Barat 16917|Jalan Raya Mayor Oking Jaya Atmaja No.KM, RW No.101, Ciriung, Cibinong, Bogor, Jawa Barat 16917', '3,8 km', '3830', '13 menit', '804', '2021-05-20 06:06:56', '2021-05-20 06:06:56'),
(4, 'RSUD Cibinong', 'Jl. Raya Mayor Oking Jaya Atmaja No.9, Cirimekar, Cibinong, Bogor, Jawa Barat 16917|Jalan Raya Mayor Oking Jaya Atmaja No.KM, RW No.101, Ciriung, Cibinong, Bogor, Jawa Barat 16917', '6,6 km', '6605', '20 min', '1205', '2021-05-21 06:06:57', '2021-05-21 06:06:57'),
(5, 'Cibinong City Mall, Jalan Tegar Beriman, Pakansari, Bogor, Jawa Barat, Indonesia', 'Jl. Raya Mayor Oking Jaya Atmaja No.9, Cirimekar, Cibinong, Bogor, Jawa Barat 16917|Jalan Raya Mayor Oking Jaya Atmaja No.KM, RW No.101, Ciriung, Cibinong, Bogor, Jawa Barat 16917', '3,8 km', '3831', '13 min', '805', '2021-05-21 06:16:23', '2021-05-21 06:16:23'),
(6, 'Alam Sutera, Jl. Serpong Raya, Pondok Jagung, Kota Tangerang Selatan, Banten, Indonesia', 'Jl. Raya Mayor Oking Jaya Atmaja No.9, Cirimekar, Cibinong, Bogor, Jawa Barat 16917|Jalan Raya Mayor Oking Jaya Atmaja No.KM, RW No.101, Ciriung, Cibinong, Bogor, Jawa Barat 16917', '63,3 km', '63272', '1 jam 7 menit', '3991', '2021-05-21 06:18:10', '2021-05-21 06:18:10'),
(7, 'Cibinong City Mall, Jalan Tegar Beriman, Pakansari, Bogor, Jawa Barat, Indonesia', 'Cibinong Square, Pakansari, Bogor, Jawa Barat, Indonesia', '0,8 km', '831', '2 menit', '147', '2021-05-21 07:59:58', '2021-05-21 07:59:58');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `koordinat`
--

CREATE TABLE `koordinat` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_koordinat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `long` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `koordinat`
--

INSERT INTO `koordinat` (`id`, `nama_koordinat`, `lat`, `long`, `created_at`, `updated_at`) VALUES
(2, 'Cibinong green residence, Jalan Al-Falah, Harapan Jaya, Bogor, Jawa Barat, Indonesia', '-6.460146600000001', '106.8395364', '2021-05-08 11:52:58', '2021-05-08 11:52:58'),
(3, 'Perumahan Grand Pesona Telaga Cibinong, Jalan Raya Cikaret, Harapan Jaya, kabupten bogor, Jawa Barat, Indonesia', '-6.4682301', '106.8343819', '2021-05-08 11:53:14', '2021-05-08 11:53:14'),
(4, 'Dago, Kota Bandung, Jawa Barat, Indonesia', '-6.877257699999999', '107.6174119', '2021-05-19 04:25:43', '2021-05-19 04:25:43'),
(5, 'Bandung, Kota Bandung, Jawa Barat, Indonesia', '-6.9174639', '107.6191228', '2021-05-19 05:20:39', '2021-05-19 05:20:39'),
(6, 'Alam Sutera, Jl. Serpong Raya, Pondok Jagung, Kota Tangerang Selatan, Banten, Indonesia', '-6.2575466', '106.657614', '2021-05-20 06:55:34', '2021-05-20 06:55:34');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_05_08_163034_create_koordinat', 2),
(5, '2021_05_19_123312_distanation_migration', 3),
(6, '2021_05_19_153027_create__destination_migration', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', NULL, '$2y$10$qHJJCcUjNSwsrAhkS7aky.JCFrwbuQhHMyhFk2PbSwjRDBMq.OaCS', NULL, '2021-05-08 07:52:20', '2021-05-08 07:52:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `distanion`
--
ALTER TABLE `distanion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estimation`
--
ALTER TABLE `estimation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `koordinat`
--
ALTER TABLE `koordinat`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `distanion`
--
ALTER TABLE `distanion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `estimation`
--
ALTER TABLE `estimation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `koordinat`
--
ALTER TABLE `koordinat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
