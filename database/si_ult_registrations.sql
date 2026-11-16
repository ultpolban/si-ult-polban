-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Nov 2026 pada 06.26
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_ult_registrations`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `registration_requests`
--

CREATE TABLE `registration_requests` (
  `id` int(11) UNSIGNED NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `applicant_type_id` int(11) UNSIGNED NOT NULL,
  `applicant_type_code` varchar(20) NOT NULL,
  `applicant_type_name` varchar(100) NOT NULL,
  `study_program_id` int(11) UNSIGNED DEFAULT NULL,
  `study_program_name` varchar(150) DEFAULT NULL,
  `class_id` int(11) UNSIGNED DEFAULT NULL,
  `class_name` varchar(100) DEFAULT NULL,
  `nim` varchar(30) DEFAULT NULL,
  `nik` varchar(30) DEFAULT NULL,
  `student_name` varchar(150) DEFAULT NULL,
  `institution_name` varchar(200) DEFAULT NULL,
  `position` varchar(150) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `purpose` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `processed_by` int(11) UNSIGNED DEFAULT NULL,
  `processed_by_name` varchar(150) DEFAULT NULL,
  `processed_at` datetime DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
  `created_user_id` int(11) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `registration_requests`
--

INSERT INTO `registration_requests` (`id`, `full_name`, `email`, `password_hash`, `applicant_type_id`, `applicant_type_code`, `applicant_type_name`, `study_program_id`, `study_program_name`, `class_id`, `class_name`, `nim`, `nik`, `student_name`, `institution_name`, `position`, `phone_number`, `address`, `purpose`, `status`, `processed_by`, `processed_by_name`, `processed_at`, `rejection_reason`, `created_user_id`, `created_at`, `updated_at`, `deleted_at`, `gender`) VALUES
(15, 'alif', 'alif@gmail.com', '$2y$10$PSsYjQt7/UVkGuDzza0ktON9WqoWC4fYf.f9xlAedaYUiBvs.DbRe', 1, 'MHS', 'Mahasiswa', 23, 'Teknik Informatika', 22, 'Teknik Informatika 3A', '987654321', NULL, NULL, NULL, NULL, '081234567890', 'cimahi', 'tes', 'pending', NULL, NULL, NULL, NULL, NULL, '2026-09-18 09:42:58', '2026-09-18 09:42:58', NULL, 'L'),
(16, 'Agus', 'agus@gmail.com', '$2y$10$pyG/ilV.UpcIIm.xexNXDuGSSRga6XkTebbIs5TD/yZsWvmjNFH8W', 1, 'MHS', 'Mahasiswa', 23, 'Teknik Informatika', 22, 'Teknik Informatika 3A', '987654321', NULL, NULL, NULL, NULL, '081234567890', 'Cimahi', 'tes', 'approved', 3, 'Admin', '2026-09-18 09:47:09', NULL, 31, '2026-09-18 09:46:41', '2026-09-18 09:47:09', NULL, 'L'),
(17, 'Ucok Sigarantang', 'aditiasetiadi239@gmail.com', '$2y$10$TYAku.qxf/L8MvOmu5j.QeHSvU1UnO13OEwrWB.v2AiKf91BvzkFy', 4, 'DOSEN', 'Dosen', NULL, NULL, NULL, NULL, NULL, '721987319387', NULL, NULL, NULL, '08761781718', 'Medan', NULL, 'approved', 1, 'Super Administrator', '2026-10-27 00:08:47', NULL, 9, '2026-10-27 00:07:56', '2026-10-27 00:08:47', NULL, 'L');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `registration_requests`
--
ALTER TABLE `registration_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `status` (`status`),
  ADD KEY `applicant_type_code` (`applicant_type_code`),
  ADD KEY `created_at` (`created_at`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `registration_requests`
--
ALTER TABLE `registration_requests`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
