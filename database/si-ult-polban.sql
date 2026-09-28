-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jul 2026 pada 06.15
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
-- Database: `si-ult-polban`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2026-07-15-010642', 'App\\Database\\Migrations\\CreateRolesTable', 'default', 'App', 1784087062, 1),
(2, '2026-07-15-010702', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1784087062, 1),
(3, '2026-07-15-042634', 'App\\Database\\Migrations\\CreateTicketsTable', 'default', 'App', 1784090250, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(11) UNSIGNED NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Administrator Sistem', '2026-07-15 10:45:07', '2026-07-15 10:45:07'),
(2, 'Petugas ULT', 'Petugas Unit Layanan Terpadu', '2026-07-15 10:45:07', '2026-07-15 10:45:07'),
(3, 'Unit Tujuan', 'Unit yang memproses layanan', '2026-07-15 10:45:07', '2026-07-15 10:45:07'),
(4, 'Pemohon', 'Mahasiswa/Dosen/Publik', '2026-07-15 10:45:07', '2026-07-15 10:45:07'),
(5, 'Pimpinan', 'Pimpinan POLBAN', '2026-07-15 10:45:07', '2026-07-15 10:45:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) UNSIGNED NOT NULL,
  `ticket_number` varchar(30) NOT NULL,
  `service_name` varchar(150) NOT NULL,
  `applicant_name` varchar(150) NOT NULL,
  `applicant_type` varchar(50) DEFAULT NULL,
  `nim` varchar(30) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `ticket_title` varchar(255) NOT NULL,
  `ticket_description` text NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Submitted',
  `priority` varchar(20) NOT NULL DEFAULT 'Normal',
  `assigned_unit` varchar(100) DEFAULT NULL,
  `verified_by` varchar(100) DEFAULT NULL,
  `verification_note` text DEFAULT NULL,
  `submitted_at` datetime NOT NULL,
  `verified_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `source` varchar(20) DEFAULT 'Online'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tickets`
--

INSERT INTO `tickets` (`id`, `ticket_number`, `service_name`, `applicant_name`, `applicant_type`, `nim`, `email`, `phone`, `ticket_title`, `ticket_description`, `attachment`, `status`, `priority`, `assigned_unit`, `verified_by`, `verification_note`, `submitted_at`, `verified_at`, `completed_at`, `created_at`, `updated_at`, `source`) VALUES
(1, 'ULT-20260716-0001', 'Surat Aktif Kuliah', 'Andi Saputra', NULL, '231511001', 'andi@student.polban.ac.id', '081234567890', 'Permohonan Surat Aktif', 'Pengajuan surat aktif kuliah.', NULL, 'Need Revision', 'Normal', 'Jurusan', 'Petugas ULT', 'tes', '2026-07-16 08:29:40', '2026-07-17 09:29:33', NULL, NULL, NULL, 'Online'),
(2, 'ULT-20260716-0002', 'Legalisir Ijazah', 'Budi Santoso', NULL, '231511002', 'budi@student.polban.ac.id', '081234567891', 'Legalisir', 'Legalisir ijazah.', NULL, 'Need Revision', 'High', 'BAAK', 'Petugas ULT', 'tes', '2026-07-16 08:29:40', '2026-07-17 09:05:31', NULL, NULL, NULL, 'Online'),
(3, 'ULT-20260716-0003', 'Surat Keterangan Lulus', 'Citra Lestari', NULL, '231511003', 'citra@student.polban.ac.id', '081234567892', 'SKL', 'Permohonan SKL.', NULL, 'Rejected', 'Normal', 'BAAK', 'Petugas ULT', 'tes', '2026-07-16 08:29:40', '2026-07-17 08:46:54', NULL, NULL, NULL, 'Online'),
(4, 'ULT-20260720034128', 'Kemahasiswaan', 'bi eem', NULL, '12233', 'a@gmail.com', '09388', 'kjl', 'mll', NULL, 'Submitted', 'Normal', NULL, NULL, NULL, '2026-07-20 03:41:28', NULL, NULL, NULL, NULL, 'Online'),
(16, 'ULT-20260723092509902', 'beasiswa', 'zhufa', 'Mahasiswa', '0987665', 'zhufa@gmail.com', '0987666', 'tes', 'tes', NULL, 'Submitted', 'Normal', NULL, NULL, NULL, '2026-07-23 09:25:09', NULL, NULL, NULL, NULL, 'Online');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ticket_comments`
--

CREATE TABLE `ticket_comments` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ticket_logs`
--

CREATE TABLE `ticket_logs` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@ultpolban.ac.id', '081234567890', '$2y$10$I8v7QjaZF1oYEbCfzlH91u9tmCpT6GraKXHiOXBA4UTnA66uYJmIK', 1, 1, '2026-07-15 10:45:24', '2026-07-15 10:45:24');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ticket_comments`
--
ALTER TABLE `ticket_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ticket_logs`
--
ALTER TABLE `ticket_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `ticket_comments`
--
ALTER TABLE `ticket_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ticket_logs`
--
ALTER TABLE `ticket_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
