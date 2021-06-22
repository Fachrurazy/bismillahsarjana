-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jun 2021 pada 07.38
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Struktur dari tabel `cabang`
--

CREATE TABLE `cabang` (
  `id` int(11) NOT NULL,
  `Kode_Cabang` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Nama_Cabang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Pemilik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Latitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Longitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cabang`
--

INSERT INTO `cabang` (`id`, `Kode_Cabang`, `Nama_Cabang`, `Pemilik`, `Telepon`, `Alamat`, `Latitude`, `Longitude`, `created_at`, `updated_at`) VALUES
(1, 'C0', 'Pabrik', 'Bang Irman', '082121212121', 'Jl. Siliwangi No.372, Manggahang, Kec. Baleendah, Bandung, Jawa Barat 40375, Indonesia', '-7.013085699999999', '107.6455816', '2021-06-18 16:35:04', '2021-06-18 16:35:04'),
(2, 'C1', 'Cibitung', 'Mas Apis', '089832632892', 'Suplyer nazar paint bekasi, Wanasari, Cibitung, Bekasi, West Java 17520, Indonesia', '-6.2447368', '107.0893353', '2021-06-18 14:59:20', '2021-06-18 14:59:20'),
(3, 'C2', 'Bintara', 'Mas Tegar', '081289473981', 'Toko Cat Tembok Kiloan Nazar Paint, Jl. Bintara No.14, RT.002/RW.009, Bintara, Bekasi Barat, Bekasi City, West Java 17134, Indonesia', '-6.2320719', '106.962546', '2021-06-18 15:02:41', '2021-06-18 15:02:41'),
(4, 'C3', 'Kranji', 'Mas Alvian', '081290044090', 'Toko Cat Tembok Kiloan Nazar Paint 2, Jl. Patriot, RT.004/RW.014, Jakasampurna, Kec. Bekasi Bar., Kota Bks, Jawa Barat 17145, Indonesia', '-6.2402719', '106.9698461', '2021-06-18 15:04:42', '2021-06-18 15:04:42'),
(5, 'C4', 'Cileungsi Indah', 'Bu Lili', '081590398421', 'Nazar Paint blok A no 111 Cileungsi Indah, Cileungsi Kidul, Kec. Cileungsi, Bogor, Jawa Barat 16820, Indonesia', '-6.4076092', '106.9658947', '2021-06-18 15:05:59', '2021-06-18 15:05:59'),
(6, 'C5', 'Jatikramat', 'Mas Apis', '089832637485', 'Nazar Paint Jatikramat, Jl. Raya Jati Kramat Indah II No.60, RT.004/RW.003, Jatikramat, Kec. Jatiasih, Kota Bks, Jawa Barat 17421, Indonesia', '-6.2860957', '106.9410857', '2021-06-18 15:07:43', '2021-06-18 15:07:43'),
(7, 'C6', 'Handoyo', 'Mas Faskha', '089149612987', 'Jalan Raya Narogong No.508, Bantargebang, Kota Bekasi, Jawa Barat, Indonesia', '-6.3105664', '106.9847585', '2021-06-18 15:08:49', '2021-06-18 15:08:49'),
(8, 'C7', 'Tebet', 'Bang Buyung', '081233444090', 'TOKO CAT KILOAN TEBET, Jl. Asem Baris Raya No.16, RT.1/RW.5, Kb. Baru, Kec. Tebet, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12830, Indonesia', '-6.227895900000001', '106.8586937', '2021-06-18 15:09:50', '2021-06-18 15:09:50'),
(9, 'C8', 'Cakung', 'Mas Haris', '089233474512', 'Jual Cat Tembok Kiloan Nazar, Jl. Kayu Tinggi, RT.3/RW.6, Cakung Timur, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta, Indonesia', '-6.1676666', '106.9483334', '2021-06-18 15:12:16', '2021-06-18 15:12:16'),
(10, 'C9', 'Tanjung Priok', 'Mba Ayu', '089121212987', 'Cat Ayu, RT.8/RW.6, Sunter Agung, Kota Jakarta Utara, Daerah Khusus Ibukota Jakarta, Indonesia', '-6.1269396', '106.8573167', '2021-06-18 15:13:17', '2021-06-18 15:13:17'),
(11, 'C10', 'Jatijajar', 'mas kemal', '082121212121', 'Nazar paint jatijajar, Jatijajar, Kota Depok, Jawa Barat, Indonesia', '-6.414000199999999', '106.8704251', '2021-06-11 11:46:11', '2021-06-11 11:46:11'),
(12, 'C11', 'Cilodong', 'Mas aji', '082121212121', 'TOKO CAT TEMBOK KILOAN NAZAR PAINT STUDIO ALAM, Jalan Kemang Raya, Kalibaru, Kota Depok, Jawa Barat, Indonesia', '-6.4235896', '106.8357255', '2021-06-11 11:42:34', '2021-06-11 11:42:34'),
(13, 'C12', 'Darno Bogor', 'Bapak Darno', '089672536223', 'Darno (bp dewa.), Jl. Anggrek No.7, Wanaherang, Kec. Gn. Putri, Bogor, Jawa Barat 16965, Indonesia', '-6.4252892', '106.9481792', '2021-06-18 15:14:29', '2021-06-18 15:14:29'),
(14, 'C13', 'Cibinong', 'Bang Ajis', '089832420892', 'Alfamidi Kampung sawah, Jl. Kp. Sawah No.34, Jatimulya, Cilodong, Depok City, West Java 16413, Indonesia', '-6.455612399999999', '106.8264144', '2021-06-18 15:16:12', '2021-06-18 15:16:12'),
(15, 'C14', 'Cikaret', 'mama adit', '082121212121', 'TOKO CAT TEMBOK NAZAR PAINT CIKARET, Jalan Raya Cikaret, Harapan Jaya, Bogor, Jawa Barat, Indonesia', '-6.468566', '106.8417005', '2021-06-11 11:43:41', '2021-06-11 11:43:41'),
(16, 'C15', 'Babakanmadang', 'mas farhan', '082121212121', 'Nazar Paint, Citaringgul, Babakan Madang, Bogor, Jawa Barat, Indonesia', '-6.561322199999999', '106.8579398', '2021-06-11 11:49:09', '2021-06-11 11:49:09'),
(17, 'C16', 'Karadenan', 'Mas Adit', '082121212121', 'TOKO CAT TEMBOK NAZAR PAINT KARADENAN, Jalan Mandala Raya, Karadenan, Bogor, Jawa Barat, Indonesia', '-6.522043999999999', '106.8131834', '2021-06-11 11:41:32', '2021-06-11 11:41:32'),
(18, 'C17', 'Citayam', 'mama aji', '082121212121', 'Nazar Paint Citayam, Rawa Panjang, Bogor, Jawa Barat, Indonesia', '-6.4673531', '106.8032647', '2021-06-11 11:45:25', '2021-06-11 11:45:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `distanion`
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
-- Dumping data untuk tabel `distanion`
--

INSERT INTO `distanion` (`id`, `Tujuan`, `Distance`, `Duration`, `Value`, `created_at`, `updated_at`) VALUES
(1, 'Jl. Raya Mayor Oking Jaya Atmaja No.9, Cirimekar, Cibinong, Bogor, Jawa Barat 16917|Jalan Raya Mayor Oking Jaya Atmaja No.KM, RW No.101, Ciriung, Cibinong, Bogor, Jawa Barat 16917', '6,6 km', '20 menit', '6604', '2021-05-19 05:42:33', '2021-05-19 05:42:33'),
(2, 'Jl. Raya Mayor Oking Jaya Atmaja No.9, Cirimekar, Cibinong, Bogor, Jawa Barat 16917|Jalan Raya Mayor Oking Jaya Atmaja No.KM, RW No.101, Ciriung, Cibinong, Bogor, Jawa Barat 16917', '6,6 km', '20 min', '6604', '2021-05-19 05:56:49', '2021-05-19 05:56:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `estimation`
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
-- Dumping data untuk tabel `estimation`
--

INSERT INTO `estimation` (`id`, `origin`, `destination`, `distance`, `distance_value`, `duration`, `duration_value`, `created_at`, `updated_at`) VALUES
(31, 'TOKO CAT TEMBOK NAZAR PAINT CIKARET, Jalan Raya Cikaret, Harapan Jaya, Bogor, Jawa Barat, Indonesia', 'Nazar paint jatijajar, Jatijajar, Kota Depok, Jawa Barat, Indonesia', '10,5 km', '10511', '25 min', '1499', '2021-06-11 12:15:26', '2021-06-11 12:15:26'),
(33, 'TOKO CAT TEMBOK NAZAR PAINT CIKARET, Jalan Raya Cikaret, Harapan Jaya, Bogor, Jawa Barat, Indonesia', 'Toko Cat Nazar Cilodong, Jalan Kampung Sawah Ps. Pucung, Jatimulya, Kota Depok, Jawa Barat, Indonesia', '3,8 km', '3781', '11 menit', '676', '2021-06-11 12:18:57', '2021-06-11 12:18:57'),
(34, 'Toko Cat Nazar Cilodong, Jalan Kampung Sawah Ps. Pucung, Jatimulya, Kota Depok, Jawa Barat, Indonesia', 'Nazar Paint Citayam, Rawa Panjang, Bogor, Jawa Barat, Indonesia', '10,3 km', '10263', '26 menit', '1577', '2021-06-11 12:18:57', '2021-06-11 12:18:57'),
(35, 'TOKO CAT TEMBOK NAZAR PAINT CIKARET, Jalan Raya Cikaret, Harapan Jaya, Bogor, Jawa Barat, Indonesia', 'Nazar Paint Citayam, Rawa Panjang, Bogor, Jawa Barat, Indonesia', '8,1 km', '8118', '18 menit', '1070', '2021-06-11 12:24:26', '2021-06-11 12:24:26'),
(36, 'TOKO CAT TEMBOK NAZAR PAINT CIKARET, Jalan Raya Cikaret, Harapan Jaya, Bogor, Jawa Barat, Indonesia', 'TOKO CAT TEMBOK NAZAR PAINT KARADENAN, Jalan Mandala Raya, Karadenan, Bogor, Jawa Barat, Indonesia', '10,2 km', '10181', '22 menit', '1305', '2021-06-11 12:25:39', '2021-06-11 12:25:39'),
(37, 'TOKO CAT TEMBOK NAZAR PAINT KARADENAN, Jalan Mandala Raya, Karadenan, Bogor, Jawa Barat, Indonesia', 'Nazar Paint, Citaringgul, Babakan Madang, Bogor, Jawa Barat, Indonesia', '12,1 km', '12102', '25 menit', '1511', '2021-06-11 12:25:39', '2021-06-11 12:25:39'),
(38, 'Nazar paint jatijajar, Jatijajar, Kota Depok, Jawa Barat, Indonesia', 'Nazar Paint, Citaringgul, Babakan Madang, Bogor, Jawa Barat, Indonesia', '22,7 km', '22707', '38 min', '2307', '2021-06-11 12:29:15', '2021-06-11 12:29:15'),
(39, 'Nazar paint jatijajar, Jatijajar, Kota Depok, Jawa Barat, Indonesia', 'Toko Cat Nazar Cilodong, Jalan Kampung Sawah Ps. Pucung, Jatimulya, Kota Depok, Jawa Barat, Indonesia', '7,9 km', '7889', '21 min', '1237', '2021-06-11 12:30:19', '2021-06-11 12:30:19'),
(40, 'Nazar Paint Citayam, Rawa Panjang, Bogor, Jawa Barat, Indonesia', 'TOKO CAT TEMBOK NAZAR PAINT KARADENAN, Jalan Mandala Raya, Karadenan, Bogor, Jawa Barat, Indonesia', '8,3 km', '8339', '19 min', '1117', '2021-06-11 12:30:55', '2021-06-11 12:30:55'),
(41, 'Cilodong', 'Babakanmadang', '27,4 km', '27437', '49 menit', '2914', '2021-06-11 15:42:29', '2021-06-11 15:42:29'),
(42, 'TOKO CAT TEMBOK NAZAR PAINT CIKARET, Jalan Raya Cikaret, Harapan Jaya, Bogor, Jawa Barat, Indonesia', 'TOKO CAT TEMBOK NAZAR PAINT KARADENAN, Jalan Mandala Raya, Karadenan, Bogor, Jawa Barat, Indonesia', '10,2 km', '10181', '22 min', '1305', '2021-06-20 08:45:07', '2021-06-20 08:45:07'),
(43, 'Nazar Paint, Jl. Moh. Toha, RT.02 rw05, Pasawahan, Bandung, Jawa Barat, Indonesia', 'Nazar Paint Indah Warna, Jalan Karanglo, Plumbon, Banguntapan, Bantul, Daerah Istimewa Yogyakarta, Indonesia', '559 km', '559294', '7 jam 30 menit', '26980', '2021-06-20 08:47:53', '2021-06-20 08:47:53'),
(44, 'Nazar Paint, Jl. Moh. Toha, RT.02 rw05, Pasawahan, Bandung, Jawa Barat, Indonesia', 'Nazar Paint Indah Warna, Jalan Karanglo, Plumbon, Banguntapan, Bantul, Daerah Istimewa Yogyakarta, Indonesia', '559 km', '559294', '7 jam 30 menit', '26980', '2021-06-20 10:33:24', '2021-06-20 10:33:24'),
(45, 'RSUD Cibinong, Jalan KSR Dadi Kusmayadi, Tengah, Bogor, Jawa Barat, Indonesia', 'Cibinong City Mall, Jalan Tegar Beriman, Pakansari, Bogor, Jawa Barat, Indonesia', '2,9 km', '2.87', '8 min', '482', '2021-06-20 10:36:14', '2021-06-20 10:36:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `koordinat`
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
-- Dumping data untuk tabel `koordinat`
--

INSERT INTO `koordinat` (`id`, `nama_koordinat`, `lat`, `long`, `created_at`, `updated_at`) VALUES
(2, 'Cibinong green residence, Jalan Al-Falah, Harapan Jaya, Bogor, Jawa Barat, Indonesia', '-6.460146600000001', '106.8395364', '2021-05-08 11:52:58', '2021-05-08 11:52:58'),
(3, 'Perumahan Grand Pesona Telaga Cibinong, Jalan Raya Cikaret, Harapan Jaya, kabupten bogor, Jawa Barat, Indonesia', '-6.4682301', '106.8343819', '2021-05-08 11:53:14', '2021-05-08 11:53:14'),
(4, 'Dago, Kota Bandung, Jawa Barat, Indonesia', '-6.877257699999999', '107.6174119', '2021-05-19 04:25:43', '2021-05-19 04:25:43'),
(5, 'Bandung, Kota Bandung, Jawa Barat, Indonesia', '-6.9174639', '107.6191228', '2021-05-19 05:20:39', '2021-05-19 05:20:39'),
(6, 'Alam Sutera, Jl. Serpong Raya, Pondok Jagung, Kota Tangerang Selatan, Banten, Indonesia', '-6.2575466', '106.657614', '2021-05-20 06:55:34', '2021-05-20 06:55:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `matrixjarak`
--

CREATE TABLE `matrixjarak` (
  `id` int(11) NOT NULL,
  `Kode_Origin` int(11) NOT NULL,
  `Kode_Destination` int(11) NOT NULL,
  `Distance` decimal(6,1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `matrixjarak`
--

INSERT INTO `matrixjarak` (`id`, `Kode_Origin`, `Kode_Destination`, `Distance`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '136.0', '2021-06-20 10:50:54', '2021-06-20 10:50:54'),
(2, 1, 3, '145.1', '2021-06-20 11:08:37', '2021-06-20 11:08:37'),
(235, 1, 4, '145.8', '2021-06-20 13:31:23', '2021-06-20 13:31:23'),
(242, 2, 3, '22.9', '2021-06-20 13:36:26', '2021-06-20 13:36:26'),
(243, 2, 4, '18.6', '2021-06-20 13:36:33', '2021-06-20 13:36:33'),
(244, 3, 4, '2.0', '2021-06-20 13:38:05', '2021-06-20 13:38:05'),
(245, 1, 5, '148.1', '2021-06-21 14:23:50', '2021-06-21 14:23:50'),
(246, 2, 5, '28.7', '2021-06-21 14:24:40', '2021-06-21 14:24:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_05_08_163034_create_koordinat', 2),
(5, '2021_05_19_123312_distanation_migration', 3),
(6, '2021_05_19_153027_create__destination_migration', 4),
(7, '2021_05_24_124205_cabang_migration', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `routes`
--

CREATE TABLE `routes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `origin_lat` varchar(255) DEFAULT NULL,
  `origin_long` varchar(255) DEFAULT NULL,
  `first_destination` varchar(255) DEFAULT NULL,
  `first_destination_lat` varchar(255) DEFAULT NULL,
  `first_destination_long` varchar(255) DEFAULT NULL,
  `last_destination` varchar(255) DEFAULT NULL,
  `last_destination_lat` varchar(255) DEFAULT NULL,
  `last_destination_long` varchar(255) DEFAULT NULL,
  `respons_data` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `routes`
--

INSERT INTO `routes` (`id`, `name`, `origin`, `origin_lat`, `origin_long`, `first_destination`, `first_destination_lat`, `first_destination_long`, `last_destination`, `last_destination_lat`, `last_destination_long`, `respons_data`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Cibinong City Mall, Jalan Tegar Beriman, Pakansari, Bogor, Jawa Barat, Indonesia', '-6.4842002', NULL, 'RSUD Cibinong, Jalan KSR Dadi Kusmayadi, Tengah, Bogor, Jawa Barat, Indonesia', '-6.4733034', NULL, 'Cibinong Square, Pakansari, Bogor, Jawa Barat, Indonesia', '-6.4792499', NULL, NULL, '2021-06-06 08:34:50', '2021-06-06 08:34:50'),
(2, 'Pabrik - Cikaret - Cibinong', 'Nazar Paint, Jl. Moh. Toha No.85-95, RT.02 rw05, Pasawahan, Kec. Dayeuhkolot, Bandung, Jawa Barat 40256', '-6.970129083857602', '107.61686219943017', 'Bojong Gede, Bogor, Jawa Barat, Indonesia', '-6.4792109', '106.8001396', 'Cibinong City Mall, Jalan Tegar Beriman, Pakansari, Bogor, Jawa Barat, Indonesia', '-6.4842002', '106.8423123', NULL, '2021-06-06 09:53:35', '2021-06-06 09:53:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rute`
--

CREATE TABLE `rute` (
  `id` int(11) NOT NULL,
  `Kelompok` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rute`
--

INSERT INTO `rute` (`id`, `Kelompok`, `created_at`, `update_at`) VALUES
(8, 'RUTE01', '2021-06-21 04:47:02', '2021-06-21 04:47:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rute_detail`
--

CREATE TABLE `rute_detail` (
  `id` int(11) NOT NULL,
  `id_cabang` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_rute` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rute_detail`
--

INSERT INTO `rute_detail` (`id`, `id_cabang`, `created_at`, `updated_at`, `id_rute`) VALUES
(11, 1, '2021-06-21 04:47:02', '2021-06-21 04:47:02', 8),
(12, 3, '2021-06-21 04:47:02', '2021-06-21 04:47:02', 8),
(13, 4, '2021-06-21 04:47:02', '2021-06-21 04:47:02', 8),
(14, 2, '2021-06-21 04:47:02', '2021-06-21 04:47:02', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `savingmatrix`
--

CREATE TABLE `savingmatrix` (
  `id` int(11) NOT NULL,
  `Kode_Origin` int(11) NOT NULL,
  `Kode_Destination` int(11) NOT NULL,
  `Saving` decimal(6,1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `savingmatrix`
--

INSERT INTO `savingmatrix` (`id`, `Kode_Origin`, `Kode_Destination`, `Saving`, `created_at`, `updated_at`) VALUES
(138, 2, 3, '258.2', '2021-06-20 13:39:42', '2021-06-20 13:39:42'),
(140, 2, 4, '263.2', '2021-06-20 13:40:59', '2021-06-20 13:40:59'),
(141, 3, 4, '288.9', '2021-06-20 13:41:12', '2021-06-20 13:41:12'),
(142, 2, 5, '255.4', '2021-06-21 14:31:14', '2021-06-21 14:31:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', NULL, '$2y$10$qHJJCcUjNSwsrAhkS7aky.JCFrwbuQhHMyhFk2PbSwjRDBMq.OaCS', NULL, '2021-05-08 07:52:20', '2021-05-08 07:52:20');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Kode_Cabang` (`Kode_Cabang`);

--
-- Indeks untuk tabel `distanion`
--
ALTER TABLE `distanion`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `estimation`
--
ALTER TABLE `estimation`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `koordinat`
--
ALTER TABLE `koordinat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `matrixjarak`
--
ALTER TABLE `matrixjarak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Kode_Origin` (`Kode_Origin`),
  ADD KEY `Kode_Destination` (`Kode_Destination`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rute`
--
ALTER TABLE `rute`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rute_detail`
--
ALTER TABLE `rute_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rute` (`id_rute`,`id_cabang`),
  ADD KEY `id_cabang` (`id_cabang`);

--
-- Indeks untuk tabel `savingmatrix`
--
ALTER TABLE `savingmatrix`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Kode_Origin` (`Kode_Origin`),
  ADD KEY `Kode_Destination` (`Kode_Destination`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cabang`
--
ALTER TABLE `cabang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `distanion`
--
ALTER TABLE `distanion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `estimation`
--
ALTER TABLE `estimation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `koordinat`
--
ALTER TABLE `koordinat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `matrixjarak`
--
ALTER TABLE `matrixjarak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `rute`
--
ALTER TABLE `rute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `rute_detail`
--
ALTER TABLE `rute_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `savingmatrix`
--
ALTER TABLE `savingmatrix`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `matrixjarak`
--
ALTER TABLE `matrixjarak`
  ADD CONSTRAINT `matrixjarak_ibfk_1` FOREIGN KEY (`Kode_Origin`) REFERENCES `cabang` (`id`),
  ADD CONSTRAINT `matrixjarak_ibfk_2` FOREIGN KEY (`Kode_Destination`) REFERENCES `cabang` (`id`);

--
-- Ketidakleluasaan untuk tabel `rute_detail`
--
ALTER TABLE `rute_detail`
  ADD CONSTRAINT `rute_detail_ibfk_1` FOREIGN KEY (`id_rute`) REFERENCES `rute` (`id`),
  ADD CONSTRAINT `rute_detail_ibfk_2` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id`);

--
-- Ketidakleluasaan untuk tabel `savingmatrix`
--
ALTER TABLE `savingmatrix`
  ADD CONSTRAINT `savingmatrix_ibfk_1` FOREIGN KEY (`Kode_Origin`) REFERENCES `cabang` (`id`),
  ADD CONSTRAINT `savingmatrix_ibfk_2` FOREIGN KEY (`Kode_Destination`) REFERENCES `cabang` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
