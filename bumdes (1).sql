-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Agu 2026 pada 12.10
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bumdes`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `approval_dokumens`
--

CREATE TABLE `approval_dokumens` (
  `id_approval` bigint(20) UNSIGNED NOT NULL,
  `id_surat` bigint(20) UNSIGNED NOT NULL,
  `tanggal_approval` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `arsip_digitals`
--

CREATE TABLE `arsip_digitals` (
  `id_arsip` bigint(20) UNSIGNED NOT NULL,
  `id_surat` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_file` varchar(255) NOT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `upload_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `arsip_digitals`
--

INSERT INTO `arsip_digitals` (`id_arsip`, `id_surat`, `nama_file`, `kategori`, `upload_date`, `created_at`, `updated_at`) VALUES
(1, 1, 'arsip/yorS1JmpEiS44crfMrl9STnhtB57t9lq3V4ntbWz.pdf', 'Surat Masuk', '2026-08-09 09:39:46', '2026-08-09 02:39:46', '2026-08-09 02:39:46'),
(2, 2, 'arsip/P3X9ricXAGj3iDIA0BzFRUFOJWk3cOiUDDcCKriI.pdf', 'Surat Masuk', '2026-08-09 09:46:45', '2026-08-09 02:46:45', '2026-08-09 02:46:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_keranjangs`
--

CREATE TABLE `detail_keranjangs` (
  `id_detail` bigint(20) UNSIGNED NOT NULL,
  `id_keranjang` bigint(20) UNSIGNED NOT NULL,
  `id_produk` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksis`
--

CREATE TABLE `detail_transaksis` (
  `id_detail` bigint(20) UNSIGNED NOT NULL,
  `id_transaksi` bigint(20) UNSIGNED NOT NULL,
  `id_produk` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_transaksis`
--

INSERT INTO `detail_transaksis` (`id_detail`, `id_transaksi`, `id_produk`, `jumlah`, `harga`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 1, 5000.00, 5000.00, '2026-08-09 00:57:48', '2026-08-09 00:57:48'),
(2, 2, 6, 4, 5000.00, 20000.00, '2026-08-09 01:03:31', '2026-08-09 01:03:31'),
(3, 3, 6, 2, 5000.00, 10000.00, '2026-08-09 01:27:25', '2026-08-09 01:27:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_produks`
--

CREATE TABLE `kategori_produks` (
  `id_kategori` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori_produks`
--

INSERT INTO `kategori_produks` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Pangan', '2026-08-09 00:10:52', '2026-08-09 00:10:52'),
(2, 'Hasil Tani & Perkebunan', '2026-08-09 00:24:09', '2026-08-09 00:24:09'),
(3, 'Kerajinan Desa', '2026-08-09 00:24:09', '2026-08-09 00:24:09'),
(4, 'Kuliner & Olahan', '2026-08-09 00:24:09', '2026-08-09 00:24:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjangs`
--

CREATE TABLE `keranjangs` (
  `id_keranjang` bigint(20) UNSIGNED NOT NULL,
  `id_pelanggan` bigint(20) UNSIGNED NOT NULL,
  `tanggal` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `keranjangs`
--

INSERT INTO `keranjangs` (`id_keranjang`, `id_pelanggan`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 1, '2026-08-09 07:57:02', '2026-08-09 00:57:02', '2026-08-09 00:57:02'),
(2, 2, '2026-08-09 08:02:48', '2026-08-09 01:02:48', '2026-08-09 01:02:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0000_01_01_000000_create_roles_table', 1),
(2, '0001_01_01_000000_create_users_table', 1),
(3, '0001_01_01_000001_create_cache_table', 1),
(4, '0001_01_01_000002_create_jobs_table', 1),
(5, '2026_08_04_114758_create_kategori_produks_table', 1),
(6, '2026_08_04_114759_create_produks_table', 1),
(7, '2026_08_04_114830_create_pelanggans_table', 1),
(8, '2026_08_04_114835_create_transaksi_penjualans_table', 1),
(9, '2026_08_04_114836_create_detail_transaksis_table', 1),
(10, '2026_08_04_114837_create_keranjangs_table', 1),
(11, '2026_08_04_114838_create_detail_keranjangs_table', 1),
(12, '2026_08_04_114842_create_surats_table', 1),
(13, '2026_08_04_114844_create_approval_dokumens_table', 1),
(14, '2026_08_04_114844_create_pemasukan_kas_table', 1),
(15, '2026_08_04_114844_create_pengeluaran_kas_table', 1),
(16, '2026_08_04_114845_create_arsip_digitals_table', 1),
(17, '2026_08_04_114845_create_laporan_keuangans_table', 1),
(18, '2026_08_09_000000_add_gambar_and_deskripsi_to_produks_table', 2),
(19, '2026_08_09_000001_update_transaksi_penjualans_table', 3),
(20, '2026_08_09_090141_add_id_transaksi_to_pemasukan_kas_table', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggans`
--

CREATE TABLE `pelanggans` (
  `id_pelanggan` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pelanggans`
--

INSERT INTO `pelanggans` (`id_pelanggan`, `nama`, `email`, `password`, `no_hp`, `alamat`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Budi Santoso', 'budi.santoso@example.com', '$2y$12$MKs5rxBhYjpChMoks6mSPuaV7myjJfEqRZSrsFoOXUAZQebRjfuRC', '081298765432', 'Jl. Melati No. 12, RT 02/RW 03, Desa Sinar Jaya', 'aktif', '2026-08-09 00:56:46', '2026-08-09 00:56:46'),
(2, 'mamat', 'mamat@gmail.com', '$2y$12$zBfGp7kmT35.eh3P8XqPXuLQyXQcsskgBe.gzMo21yK7OQk6ycilC', '083822451232', 'edw', 'aktif', '2026-08-09 01:00:53', '2026-08-09 01:00:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasukan_kas`
--

CREATE TABLE `pemasukan_kas` (
  `id_pemasukan` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` decimal(15,2) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `id_transaksi` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran_kas`
--

CREATE TABLE `pengeluaran_kas` (
  `id_pengeluaran` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` decimal(15,2) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produks`
--

CREATE TABLE `produks` (
  `id_produk` bigint(20) UNSIGNED NOT NULL,
  `id_kategori` bigint(20) UNSIGNED NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produks`
--

INSERT INTO `produks` (`id_produk`, `id_kategori`, `nama_produk`, `harga`, `stok`, `satuan`, `gambar`, `deskripsi`, `status`, `created_at`, `updated_at`) VALUES
(6, 1, 'Telur', 5000.00, 25, 'pcs', 'produk/RkOXLgnDGgN5V6uhe4W8aByCPgRHxFSF2stJLSZI.jpg', 'bb vb j', 'aktif', '2026-08-09 00:36:22', '2026-08-09 01:27:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id_role` bigint(20) UNSIGNED NOT NULL,
  `nama_role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id_role`, `nama_role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2026-08-04 05:17:45', '2026-08-04 05:17:45'),
(2, 'Sekretaris', '2026-08-04 05:17:46', '2026-08-04 05:17:46'),
(3, 'Bendahara', '2026-08-04 05:17:46', '2026-08-04 05:17:46'),
(4, 'Direktur', '2026-08-04 05:17:46', '2026-08-04 05:17:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5CHbdZ2ZKuTX8AclDHnbsxBnkqQa8GwNiKJdI08o', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YToxMTp7czo2OiJfdG9rZW4iO3M6NDA6IlZXdnR1UG5aNFpjVm95SXZNZnAwYW5KOXAwOWk4Smp0eENLZUNDcGciO3M6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vZGFzaGJvYXJkIjtzOjU6InJvdXRlIjtzOjk6ImRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MTk6InBlbGFuZ2dhbl9sb2dnZWRfaW4iO2I6MTtzOjEyOiJwZWxhbmdnYW5faWQiO2k6MjtzOjE0OiJwZWxhbmdnYW5fbmFtYSI7czo1OiJtYW1hdCI7czoxNToicGVsYW5nZ2FuX2VtYWlsIjtzOjE1OiJtYW1hdEBnbWFpbC5jb20iO3M6MTU6ImFkbWluX2xvZ2dlZF9pbiI7YjoxO3M6ODoiYWRtaW5faWQiO2k6NDtzOjE0OiJhZG1pbl91c2VybmFtZSI7czo4OiJkaXJla3R1ciI7czoxMDoiYWRtaW5fcm9sZSI7aTo0O30=', 1786270107),
('xoTFudK4G4GzpHI8gNDmpjRxZH0eE0zijDQ0xVPg', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiZ0o1RzJwUzMzT3pzaHpPWmwyQlZyOTRTQXlnVDRWbFhwYjhFYk9qdiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sb2dpbiI7czo1OiJyb3V0ZSI7czoxMToiYWRtaW4ubG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjE5OiJwZWxhbmdnYW5fbG9nZ2VkX2luIjtiOjE7czoxMjoicGVsYW5nZ2FuX2lkIjtpOjE7czoxNDoicGVsYW5nZ2FuX25hbWEiO3M6MTI6IkJ1ZGkgU2FudG9zbyI7czoxNToicGVsYW5nZ2FuX2VtYWlsIjtzOjI0OiJidWRpLnNhbnRvc29AZXhhbXBsZS5jb20iO30=', 1786265404);

-- --------------------------------------------------------

--
-- Struktur dari tabel `surats`
--

CREATE TABLE `surats` (
  `id_surat` bigint(20) UNSIGNED NOT NULL,
  `nomor_surat` varchar(255) NOT NULL,
  `jenis_surat` varchar(255) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `penerima` varchar(255) DEFAULT NULL,
  `pengirim` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `surats`
--

INSERT INTO `surats` (`id_surat`, `nomor_surat`, `jenis_surat`, `perihal`, `penerima`, `pengirim`, `status`, `created_at`, `updated_at`) VALUES
(1, '12', 'masuk', 'sda', 'dada', 'ada', 'disetujui', '2026-08-09 02:39:46', '2026-08-09 02:44:22'),
(2, '3', 'masuk', 'ada', 'dad', 'dad', 'diajukan', '2026-08-09 02:46:45', '2026-08-09 02:51:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_penjualans`
--

CREATE TABLE `transaksi_penjualans` (
  `id_transaksi` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `id_pelanggan` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal` datetime NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `metode_bayar` varchar(255) NOT NULL,
  `alamat_pengiriman` text DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi_penjualans`
--

INSERT INTO `transaksi_penjualans` (`id_transaksi`, `id_user`, `id_pelanggan`, `tanggal`, `total`, `metode_bayar`, `alamat_pengiriman`, `catatan`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2026-08-09 07:57:48', 5000.00, 'COD / Bayar di Tempat', 'Jl. Melati No. 12, RT 02/RW 03, Desa Sinar Jaya (Penerima: Budi Santoso - Telp: 081298765432)', 'Mohon diantar siang hari', 'batal', '2026-08-09 00:57:48', '2026-08-09 01:01:54'),
(2, 1, 2, '2026-08-09 08:03:31', 20000.00, 'COD / Bayar di Tempat', 'edw (Penerima: mamat - Telp: 083822451232)', NULL, 'selesai', '2026-08-09 01:03:31', '2026-08-09 01:04:03'),
(3, NULL, 2, '2026-08-09 08:27:25', 10000.00, 'COD / Bayar di Tempat', 'edw (Penerima: mamat - Telp: 083822451232)', NULL, 'menunggu_konfirmasi', '2026-08-09 01:27:25', '2026-08-09 01:27:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_role` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'aktif',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `id_role`, `name`, `username`, `email`, `no_hp`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'User Admin', 'admin', 'admin@bumdes.com', NULL, 'aktif', NULL, '$2y$12$yn7bUBdC4G8CE6PTDg8IHuZ5NUQPUGb.ohYoSVdiqEHQZV/raZAcW', NULL, '2026-08-04 05:17:46', '2026-08-04 05:55:07'),
(2, 2, 'User Sekretaris', 'sekretaris', 'sekretaris@bumdes.com', NULL, 'aktif', NULL, '$2y$12$48yK8h53Ma3CPdNT6/7lH.F582P2VmBQvhJ3Z82xss9ehJEqs//sG', NULL, '2026-08-04 05:17:46', '2026-08-09 02:37:38'),
(3, 3, 'User Bendahara', 'bendahara', 'bendahara@bumdes.com', NULL, 'aktif', NULL, '$2y$12$3fRTOgmlRSkHHIlwrxLFH.YsZCAFV/ylG7Bq4w7n8g1fgNEs4jkAC', NULL, '2026-08-04 05:17:46', '2026-08-09 01:54:21'),
(4, 4, 'User Direktur', 'direktur', 'direktur@bumdes.com', NULL, 'aktif', NULL, '$2y$12$PgC8TxTnIGuJBMpQTpqtgewrysMQxKFvlAcvSIfyRQX8TAxjLjvZO', NULL, '2026-08-04 05:17:47', '2026-08-09 01:54:21');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `approval_dokumens`
--
ALTER TABLE `approval_dokumens`
  ADD PRIMARY KEY (`id_approval`),
  ADD KEY `approval_dokumens_id_surat_foreign` (`id_surat`);

--
-- Indeks untuk tabel `arsip_digitals`
--
ALTER TABLE `arsip_digitals`
  ADD PRIMARY KEY (`id_arsip`),
  ADD KEY `arsip_digitals_id_surat_foreign` (`id_surat`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `detail_keranjangs`
--
ALTER TABLE `detail_keranjangs`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `detail_keranjangs_id_keranjang_foreign` (`id_keranjang`),
  ADD KEY `detail_keranjangs_id_produk_foreign` (`id_produk`);

--
-- Indeks untuk tabel `detail_transaksis`
--
ALTER TABLE `detail_transaksis`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `detail_transaksis_id_transaksi_foreign` (`id_transaksi`),
  ADD KEY `detail_transaksis_id_produk_foreign` (`id_produk`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_produks`
--
ALTER TABLE `kategori_produks`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `keranjangs`
--
ALTER TABLE `keranjangs`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `keranjangs_id_pelanggan_foreign` (`id_pelanggan`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pelanggans`
--
ALTER TABLE `pelanggans`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pemasukan_kas`
--
ALTER TABLE `pemasukan_kas`
  ADD PRIMARY KEY (`id_pemasukan`);

--
-- Indeks untuk tabel `pengeluaran_kas`
--
ALTER TABLE `pengeluaran_kas`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indeks untuk tabel `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `produks_id_kategori_foreign` (`id_kategori`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `surats`
--
ALTER TABLE `surats`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indeks untuk tabel `transaksi_penjualans`
--
ALTER TABLE `transaksi_penjualans`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `transaksi_penjualans_id_user_foreign` (`id_user`),
  ADD KEY `transaksi_penjualans_id_pelanggan_foreign` (`id_pelanggan`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_id_role_foreign` (`id_role`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `approval_dokumens`
--
ALTER TABLE `approval_dokumens`
  MODIFY `id_approval` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `arsip_digitals`
--
ALTER TABLE `arsip_digitals`
  MODIFY `id_arsip` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `detail_keranjangs`
--
ALTER TABLE `detail_keranjangs`
  MODIFY `id_detail` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksis`
--
ALTER TABLE `detail_transaksis`
  MODIFY `id_detail` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori_produks`
--
ALTER TABLE `kategori_produks`
  MODIFY `id_kategori` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `keranjangs`
--
ALTER TABLE `keranjangs`
  MODIFY `id_keranjang` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `pelanggans`
--
ALTER TABLE `pelanggans`
  MODIFY `id_pelanggan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pemasukan_kas`
--
ALTER TABLE `pemasukan_kas`
  MODIFY `id_pemasukan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran_kas`
--
ALTER TABLE `pengeluaran_kas`
  MODIFY `id_pengeluaran` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produks`
--
ALTER TABLE `produks`
  MODIFY `id_produk` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `surats`
--
ALTER TABLE `surats`
  MODIFY `id_surat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaksi_penjualans`
--
ALTER TABLE `transaksi_penjualans`
  MODIFY `id_transaksi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `approval_dokumens`
--
ALTER TABLE `approval_dokumens`
  ADD CONSTRAINT `approval_dokumens_id_surat_foreign` FOREIGN KEY (`id_surat`) REFERENCES `surats` (`id_surat`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `arsip_digitals`
--
ALTER TABLE `arsip_digitals`
  ADD CONSTRAINT `arsip_digitals_id_surat_foreign` FOREIGN KEY (`id_surat`) REFERENCES `surats` (`id_surat`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_keranjangs`
--
ALTER TABLE `detail_keranjangs`
  ADD CONSTRAINT `detail_keranjangs_id_keranjang_foreign` FOREIGN KEY (`id_keranjang`) REFERENCES `keranjangs` (`id_keranjang`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_keranjangs_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produks` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `detail_transaksis`
--
ALTER TABLE `detail_transaksis`
  ADD CONSTRAINT `detail_transaksis_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produks` (`id_produk`),
  ADD CONSTRAINT `detail_transaksis_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi_penjualans` (`id_transaksi`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `keranjangs`
--
ALTER TABLE `keranjangs`
  ADD CONSTRAINT `keranjangs_id_pelanggan_foreign` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggans` (`id_pelanggan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `produks`
--
ALTER TABLE `produks`
  ADD CONSTRAINT `produks_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_produks` (`id_kategori`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_penjualans`
--
ALTER TABLE `transaksi_penjualans`
  ADD CONSTRAINT `transaksi_penjualans_id_pelanggan_foreign` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggans` (`id_pelanggan`),
  ADD CONSTRAINT `transaksi_penjualans_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_role_foreign` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
