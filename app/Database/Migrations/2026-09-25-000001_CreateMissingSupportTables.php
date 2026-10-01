<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Membuat tabel pendukung yang masih dipakai aplikasi namun belum
 * ada di skema:
 *
 *  - visitor_logs               (statistik kunjungan landing page)
 *  - service_statistics         (layanan dengan pengajuan terbanyak)
 *  - service_requests           (parent dari service_request_files)
 *  - ticket_logs                (riwayat aktivitas tiket)
 *  - penanganan_tiket           (penanganan tiket per petugas)
 *  - dokumen_hasil              (dokumen hasil penanganan)
 *  - service_requirements       (legacy; gunakan master_service_requirements)
 *  - <unit>_activity_logs       (log aktivitas tiap unit layanan)
 */
class CreateMissingSupportTables extends Migration
{
    /**
     * Unit layanan yang membutuhkan tabel activity log sendiri.
     */
    private const ACTIVITY_LOG_UNITS = [
        'administrasi_umum',
        'akademik',
        'jurusan',
        'kemahasiswaan',
        'keuangan',
        'perpustakaan',
        'upt_tik',
    ];

    public function up()
    {
        // ==========================================================
        // VISITOR LOGS - statistik kunjungan landing page
        // ==========================================================
        $this->db->query(
            'CREATE TABLE IF NOT EXISTS `visitor_logs` (
                `id`           INT UNSIGNED NOT NULL AUTO_INCREMENT,
                `visitor_ip`   VARCHAR(45) NOT NULL,
                `visited_date` DATE NOT NULL,
                `created_at`   DATETIME NULL DEFAULT NULL,
                PRIMARY KEY (`id`),
                KEY `visitor_logs_ip_date_idx` (`visitor_ip`, `visited_date`),
                KEY `visitor_logs_date_idx` (`visited_date`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci'
        );

        // ==========================================================
        // SERVICE STATISTICS - jumlah pengajuan per layanan/tahun
        // ==========================================================
        $this->db->query(
            'CREATE TABLE IF NOT EXISTS `service_statistics` (
                `id`               INT UNSIGNED NOT NULL AUTO_INCREMENT,
                `service_id`       INT UNSIGNED NOT NULL,
                `year`             SMALLINT UNSIGNED NOT NULL,
                `total_submission` INT UNSIGNED NOT NULL DEFAULT 0,
                `updated_at`       DATETIME NULL DEFAULT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `service_statistics_service_year_uq` (`service_id`, `year`),
                KEY `service_statistics_year_idx` (`year`),
                CONSTRAINT `service_statistics_service_fk`
                    FOREIGN KEY (`service_id`) REFERENCES `master_services` (`id`)
                    ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci'
        );

        // ==========================================================
        // SERVICE REQUESTS - parent untuk service_request_files
        // ==========================================================
        $this->db->query(
            'CREATE TABLE IF NOT EXISTS `service_requests` (
                `id`              BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                `ticket_number`   VARCHAR(30) NOT NULL,
                `user_profile_id` INT UNSIGNED NULL,
                `user_id`         INT UNSIGNED NULL,
                `service_id`      INT UNSIGNED NULL,
                `status`          VARCHAR(30) NOT NULL DEFAULT \'submitted\',
                `description`     TEXT NULL,
                `admin_note`      TEXT NULL,
                `submitted_at`    DATETIME NULL DEFAULT NULL,
                `created_at`      DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at`      DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
                `deleted_at`      DATETIME NULL DEFAULT NULL,
                PRIMARY KEY (`id`),
                KEY `service_requests_ticket_number_idx` (`ticket_number`),
                KEY `service_requests_service_id_idx` (`service_id`),
                KEY `service_requests_user_profile_id_idx` (`user_profile_id`),
                KEY `service_requests_user_id_idx` (`user_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci'
        );

        // ==========================================================
        // TICKET LOGS - riwayat aktivitas tiket
        // ==========================================================
        $this->db->query(
            'CREATE TABLE IF NOT EXISTS `ticket_logs` (
                `id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                `ticket_id`  BIGINT UNSIGNED NOT NULL,
                `activity`   TEXT NULL,
                `user_name`  VARCHAR(150) NULL,
                `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                KEY `ticket_logs_ticket_id_idx` (`ticket_id`),
                CONSTRAINT `ticket_logs_ticket_fk`
                    FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`)
                    ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci'
        );

        // ==========================================================
        // PENANGANAN TIKET - header penanganan oleh petugas
        // ==========================================================
        $this->db->query(
            'CREATE TABLE IF NOT EXISTS `penanganan_tiket` (
                `id`          INT UNSIGNED NOT NULL AUTO_INCREMENT,
                `tiket_id`    BIGINT UNSIGNED NULL,
                `petugas_id`  INT UNSIGNED NULL,
                `status`      VARCHAR(30) NOT NULL DEFAULT \'pending\',
                `catatan`     TEXT NULL,
                `file_hasil1` VARCHAR(255) NULL,
                `file_hasil2` VARCHAR(255) NULL,
                `file_hasil3` VARCHAR(255) NULL,
                `created_at`  DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at`  DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                KEY `penanganan_tiket_tiket_id_idx` (`tiket_id`),
                KEY `penanganan_tiket_petugas_id_idx` (`petugas_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci'
        );

        // ==========================================================
        // DOKUMEN HASIL - file hasil dari penanganan tiket
        // ==========================================================
        $this->db->query(
            'CREATE TABLE IF NOT EXISTS `dokumen_hasil` (
                `id`            INT UNSIGNED NOT NULL AUTO_INCREMENT,
                `penanganan_id` INT UNSIGNED NULL,
                `nama_file`     VARCHAR(255) NOT NULL,
                `nama_asli`     VARCHAR(255) NULL,
                `ukuran_file`   INT UNSIGNED NULL,
                `tipe_file`     VARCHAR(100) NULL,
                `created_at`    DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at`    DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                KEY `dokumen_hasil_penanganan_id_idx` (`penanganan_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci'
        );

        // ==========================================================
        // SERVICE REQUIREMENTS (legacy - master_service_requirements
        // adalah tabel yang dipakai saat ini)
        // ==========================================================
        $this->db->query(
            'CREATE TABLE IF NOT EXISTS `service_requirements` (
                `id`          INT UNSIGNED NOT NULL AUTO_INCREMENT,
                `service_id`  INT UNSIGNED NOT NULL,
                `requirement` VARCHAR(255) NOT NULL,
                `is_active`   TINYINT(1) NOT NULL DEFAULT 1,
                `created_at`  DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at`  DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                KEY `service_requirements_service_id_idx` (`service_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci'
        );
        // ==========================================================
        // ACTIVITY LOG PER UNIT LAYANAN
        // ==========================================================
        foreach (self::ACTIVITY_LOG_UNITS as $unit) {
            $this->db->query(
                'CREATE TABLE IF NOT EXISTS `' . $unit . '_activity_logs` (
                    `id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                    `user_id`    INT UNSIGNED NULL,
                    `ticket_id`  BIGINT UNSIGNED NULL,
                    `action`     VARCHAR(100) NULL,
                    `activity`   TEXT NULL,
                    `status`     VARCHAR(40) NULL,
                    `note`       TEXT NULL,
                    `ip_address` VARCHAR(45) NULL,
                    `user_agent` VARCHAR(255) NULL,
                    `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY (`id`),
                    KEY `' . $unit . '_activity_logs_user_id_idx` (`user_id`),
                    KEY `' . $unit . '_activity_logs_ticket_id_idx` (`ticket_id`),
                    KEY `' . $unit . '_activity_logs_created_at_idx` (`created_at`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci'
            );
        }
    }

    public function down()
    {
        foreach (self::ACTIVITY_LOG_UNITS as $unit) {
            $this->db->query('DROP TABLE IF EXISTS `' . $unit . '_activity_logs`');
        }

        $this->db->query('DROP TABLE IF EXISTS `service_requirements`');
        $this->db->query('DROP TABLE IF EXISTS `dokumen_hasil`');
        $this->db->query('DROP TABLE IF EXISTS `penanganan_tiket`');
        $this->db->query('DROP TABLE IF EXISTS `ticket_logs`');
        $this->db->query('DROP TABLE IF EXISTS `service_requests`');
        $this->db->query('DROP TABLE IF EXISTS `service_statistics`');
        $this->db->query('DROP TABLE IF EXISTS `visitor_logs`');
    }
}
