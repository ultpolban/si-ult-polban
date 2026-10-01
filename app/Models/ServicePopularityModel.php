<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * =====================================================================
 *  MODEL SERVICE POPULARITY
 * ---------------------------------------------------------------------
 *  Sumber angka "layanan yang sering diakses / sering digunakan" untuk
 *  landing page.
 *
 *  Dipakai:
 *   - ServiceController::detail()  -> mencatat kunjungan
 *   - Home (landing page)          -> membaca peringkat
 * =====================================================================
 */
class ServicePopularityModel extends Model
{
    protected $table = 'service_popularity';

    protected $primaryKey = 'service_id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'service_id',
        'view_count',
        'submission_count',
        'last_viewed_at',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = false;

    /**
     * Catat satu kunjungan ke halaman detail layanan.
     *
     * Pakai INSERT ... ON DUPLICATE KEY UPDATE supaya aman walau baris
     * untuk layanan tersebut belum ada.
     */
    public function recordView(int $serviceId): void
    {
        if ($serviceId <= 0) {
            return;
        }

        $now = date('Y-m-d H:i:s');

        $this->db->query(
            'INSERT INTO service_popularity
                 (service_id, view_count, submission_count, last_viewed_at, created_at, updated_at)
             VALUES (?, 1, 0, ?, ?, ?)
             ON DUPLICATE KEY UPDATE
                 view_count       = view_count + 1,
                 last_viewed_at   = VALUES(last_viewed_at),
                 updated_at       = VALUES(updated_at)',
            [$serviceId, $now, $now, $now]
        );
    }

    /**
     * Tambah angka pengajuan (dipakai bila ada tiket baru).
     */
    public function addSubmissions(int $serviceId, int $amount = 1): void
    {
        if ($serviceId <= 0 || $amount <= 0) {
            return;
        }

        $now = date('Y-m-d H:i:s');

        $this->db->query(
            'INSERT INTO service_popularity
                 (service_id, view_count, submission_count, created_at, updated_at)
             VALUES (?, 0, ?, ?, ?)
             ON DUPLICATE KEY UPDATE
                 submission_count = submission_count + VALUES(submission_count),
                 updated_at       = VALUES(updated_at)',
            [$serviceId, $amount, $now, $now]
        );
    }

    /**
     * Layanan paling sering DIACCESSED (halaman detailnya dibuka).
     *
     * @return list<array<string, mixed>>
     */
    public function topViewed(int $limit = 6): array
    {
        return $this->db->table('service_popularity')
            ->select(
                'service_popularity.service_id,
                 service_popularity.view_count,
                 master_services.name AS service_name,
                 master_services.description AS service_description,
                 master_service_units.name AS unit_name'
            )
            ->join('master_services', 'master_services.id = service_popularity.service_id', 'left')
            ->join('master_service_units', 'master_service_units.id = master_services.service_unit_id', 'left')
            ->where('master_services.deleted_at', null)
            ->where('service_popularity.view_count >', 0)
            ->orderBy('service_popularity.view_count', 'DESC')
            ->orderBy('master_services.sort_order', 'ASC', false)
            ->limit($limit)
            ->get()
            ->getResultArray();
    }

    /**
     * Layanan paling banyak DIGUNAKAN (paling banyak pengajuan).
     *
     * Angka dijumlahkan dari tiga sumber:
     *   - service_popularity.submission_count  (agregat)
     *   - tickets                             (tiket nyata)
     *   - service_statistics                  (arsip per tahun)
     *
     * @return list<array<string, mixed>>
     */
    public function topUsed(int $limit = 6): array
    {
        $from = $this->db->escape(date('Y-m-d 00:00:00'));
        $to   = $this->db->escape(date('Y-m-d 23:59:59'));

        return $this->db->table('service_popularity')
            ->select(
                'service_popularity.service_id,
                 master_services.name AS service_name,
                 master_services.description AS service_description,
                 master_service_units.name AS unit_name,
                 COALESCE(t.cnt, 0) AS ticket_submission,
                 COALESCE(s.cnt, 0) AS archive_submission,
                 service_popularity.submission_count AS pop_submission'
            )
            ->join('master_services', 'master_services.id = service_popularity.service_id', 'left')
            ->join('master_service_units', 'master_service_units.id = master_services.service_unit_id', 'left')
            // CATATAN: nilai tanggal di-escape manual (bukan binding ?)
            // karena CodeIgniter tidak mengikat parameter di dalam
            // subquery JOIN.
            ->join(
                '(SELECT service_id, COUNT(*) AS cnt
                    FROM tickets
                   WHERE deleted_at IS NULL
                     AND created_at BETWEEN ' . $from . ' AND ' . $to . '
                   GROUP BY service_id) AS t',
                't.service_id = service_popularity.service_id',
                'left'
            )
            ->join(
                '(SELECT service_id, SUM(total_submission) AS cnt
                    FROM service_statistics
                   GROUP BY service_id) AS s',
                's.service_id = service_popularity.service_id',
                'left'
            )
            ->where('master_services.deleted_at', null)
            ->groupStart()
                ->where('t.cnt >', 0)
                ->orWhere('s.cnt >', 0)
                ->orWhere('service_popularity.submission_count >', 0)
            ->groupEnd()
            ->orderBy(
                '(COALESCE(t.cnt,0) + COALESCE(s.cnt,0) + service_popularity.submission_count)',
                'DESC',
                false
            )
            ->orderBy('master_services.sort_order', 'ASC', false)
            ->limit($limit)
            ->get()
            ->getResultArray();
    }

    /**
     * Apakah sudah ada data popularitas sama sekali?
     */
    public function hasAnyData(): bool
    {
        $viewed = (int) $this->db->table('service_popularity')
            ->where('view_count >', 0)
            ->countAllResults();

        $used = (int) $this->db->table('service_popularity')
            ->where('submission_count >', 0)
            ->countAllResults();

        $tickets = (int) $this->db->table('tickets')
            ->where('deleted_at', null)
            ->countAllResults();

        return $viewed > 0 || $used > 0 || $tickets > 0;
    }
}
