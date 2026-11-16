<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\PetugasTicketStatistics;

class PetugasController extends BaseController
{
    /**
     * Mengambil seluruh tiket untuk dashboard, daftar tiket,
     * statistik, dan API statistik.
     */
    private function getAllTiket()
    {
        $db = db_connect();

        $tickets = $db->table('tickets t')
           
->select("
    t.id,
    t.ticket_number AS nomor_tiket,
    t.status,
    t.priority AS prioritas,
    t.created_at,
    t.submitted_at,
    t.title AS layanan,
    t.description AS deskripsi,

 COALESCE(
    NULLIF(up.student_name, ''),
    NULLIF(up.name, ''),
    u.full_name
) AS nama_pemohon,

up.nim,
up.nik,
u.identity_number,
up.email AS email_profil,
up.phone AS no_hp_profil,
u.full_name,
u.email,
u.phone_number AS no_hp,
COUNT(DISTINCT srf.id) AS jumlah_lampiran
")

            ->join(
                'user_profiles up',
                'up.id = t.user_profile_id',
                'left'
            )
            ->join(
                'users u',
                'u.id = up.user_id',
                'left'
            )
            ->join(
                'service_requests sr',
                'sr.ticket_number = t.ticket_number',
                'left'
            )
            ->join(
                'service_request_files srf',
                'srf.service_request_id = sr.id',
                'left'
            )
            ->groupBy('t.id')
            ->orderBy('t.id', 'DESC')
            ->get()
            ->getResultArray();

        foreach ($tickets as &$ticket) {
            $status = strtolower(
                trim($ticket['status'] ?? 'submitted')
            );

            $ticket['status'] = match ($status) {
                'submitted'     => 'Submitted',
                'verified'      => 'Verified',
                'assigned'      => 'Disposisi',
                'in_progress'   => 'In Progress',
                'completed'     => 'Completed',
                'rejected'      => 'Rejected',
                'need_revision' => 'Need Revision',
                default         => ucfirst($status),
            };

            $ticket['prioritas'] = ucfirst(
                strtolower($ticket['prioritas'] ?? 'normal')
            );

            $tanggal = $ticket['submitted_at']
                ?? $ticket['created_at']
                ?? null;

            $ticket['tanggal'] = !empty($tanggal)
                ? date('d F Y', strtotime($tanggal))
                : '-';

            $ticket['jumlah_lampiran'] = (int) (
                $ticket['jumlah_lampiran'] ?? 0
            );

            // Samakan format data identitas agar bisa dipakai view.
            $ticket['nim'] = $ticket['nim'] ?? '';
            $ticket['nik'] = $ticket['nik'] ?? '';

            $ticket['email'] = !empty($ticket['email_profil'])
                ? $ticket['email_profil']
                : ($ticket['email'] ?? '');

            $ticket['no_hp'] = !empty($ticket['no_hp_profil'])
                ? $ticket['no_hp_profil']
                : ($ticket['no_hp'] ?? '');
        }

        unset($ticket);

        return $tickets;
    }

    public function dashboard()
    {
        $dataTiket = $this->getAllTiket();
        $statistics = new PetugasTicketStatistics();
        $allStatistics = $statistics->calculate($dataTiket);
        $monthlyTickets = $statistics->filterByPeriod($dataTiket, 'bulan');
        $monthlyStatistics = $statistics->calculate($monthlyTickets);

        $data = [
            'jumlahTiket' => $allStatistics['total_tiket'],
            'jumlahSubmitted' => $allStatistics['submitted'],
            'jumlahVerified' => $allStatistics['verified'],
            'jumlahDisposisi' => $allStatistics['disposisi']
                + $allStatistics['in_progress'],
            'chartLabels' => $monthlyStatistics['status_labels'],
            'chartValues' => $monthlyStatistics['status_values'],
        ];

        return view('petugas/dashboard', $data);
    }

    public function tiket()
    {
        return view('petugas/tiket', [
            'tickets' => $this->getAllTiket(),
        ]);
    }

  
public function detail($id = null)
{
    $tiket = $this->findTiket($id);

    $db = db_connect();

    $attachments = [];

    if (!empty($tiket)) {
        // Cari service request berdasarkan nomor tiket.
        $serviceRequest = $db->table('service_requests')
            ->select('id')
            ->where('ticket_number', $tiket['nomor_tiket'])
            ->get()
            ->getRowArray();

        if (!empty($serviceRequest)) {
            // Ambil lampiran beserta nama persyaratannya.
            $attachments = $db->table('service_request_files')
                ->select('
                    service_request_files.*,
                    master_service_requirements.name AS requirement_name
                ')
                ->join(
                    'master_service_requirements',
                    'master_service_requirements.id = service_request_files.requirement_id',
                    'left'
                )
                ->where(
                    'service_request_files.service_request_id',
                    (int) $serviceRequest['id']
                )
                ->where('service_request_files.deleted_at', null)
                ->orderBy('service_request_files.created_at', 'ASC')
                ->get()
                ->getResultArray();
                dd([
    'nomor_tiket' => $tiket['nomor_tiket'] ?? null,
    'service_request' => $serviceRequest,
    'jumlah_lampiran' => count($attachments),
    'attachments' => $attachments,
]);
        }
    }

    return view('petugas/detail', [
        'id'          => $id,
        'tiket'       => $tiket,
        'attachments' => $attachments,
    ]);
}



    public function verifikasi($id = null)
    {
        if ($id === null) {
            return redirect()->to(base_url('petugas/tiket'));
        }

        $tiket = $this->findTiket($id);

        return view('petugas/verifikasi', [
            'title' => 'Verifikasi Tiket Permohonan',
            'tiket' => $tiket,
            'id'    => $id,
        ]);
    }

    public function simpanVerifikasi($id = null)
    {
        $id = $id ?? $this->request->getPost('id');

        if ($id === null) {
            return redirect()
                ->to(base_url('petugas/tiket'))
                ->with('error', 'ID tiket tidak ditemukan.');
        }

        $db = db_connect();

        $db->table('tickets')
            ->where('id', $id)
            ->update([
                'status'      => 'verified',
                'verified_at' => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ]);

        return redirect()
            ->to(base_url('petugas/tiket'))
            ->with('success', 'Verifikasi tiket berhasil disimpan!');
    }

    public function disposisi($id = null)
    {
        if ($id === null) {
            return redirect()->to(base_url('petugas/tiket'));
        }

        $tiket = $this->findTiket($id);

        return view('petugas/disposisi', [
            'title' => 'Disposisi Tiket Permohonan',
            'tiket' => $tiket,
            'id'    => $id,
        ]);
    }

    public function kirimDisposisi($id = null)
    {
        $id = $id ?? $this->request->getPost('id');

        if ($id === null) {
            return redirect()
                ->to(base_url('petugas/tiket'))
                ->with('error', 'ID tiket tidak ditemukan.');
        }

        $db = db_connect();

        $db->table('tickets')
            ->where('id', $id)
            ->update([
                'status'     => 'assigned',
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return redirect()
            ->to(base_url('tracking'))
            ->with('success', 'Disposisi tiket berhasil dikirim!');
    }

    /**
     * Mengambil detail tiket beserta identitas pemohon.
     */
    private function findTiket($id)
    {
        if ($id === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $db = db_connect();

        $tiket = $db->table('tickets t')
            ->select("
                t.id,
                t.ticket_number AS nomor_tiket,
                t.status,
                t.priority AS prioritas,
                t.created_at,
                t.submitted_at,
                t.title AS layanan,
                t.description AS deskripsi,

                COALESCE(
                    NULLIF(up.student_name, ''),
                    NULLIF(up.name, ''),
                    u.full_name
                ) AS nama_pemohon,

                up.nim,
                up.nik,
                u.identity_number,
                up.email AS email_profil,
                up.phone AS no_hp_profil,

                u.full_name,
                u.email,
                u.phone_number AS no_hp
            ")
            ->join(
                'user_profiles up',
                'up.id = t.user_profile_id',
                'left'
            )
            ->join(
                'users u',
                'u.id = up.user_id',
                'left'
            )
            ->where('t.id', $id)
            ->get()
            ->getRowArray();

        if (!$tiket) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Status untuk ditampilkan pada halaman detail.
        $status = strtolower($tiket['status'] ?? 'submitted');

        $tiket['status'] = match ($status) {
            'submitted'     => 'Submitted',
            'verified'      => 'Verified',
            'assigned'      => 'Disposisi',
            'in_progress'   => 'In Progress',
            'completed'     => 'Completed',
            'rejected'      => 'Rejected',
            'need_revision' => 'Need Revision',
            default         => ucfirst($status),
        };

        $tiket['prioritas'] = ucfirst(
            strtolower($tiket['prioritas'] ?? 'normal')
        );

        $tanggal = $tiket['submitted_at']
            ?? $tiket['created_at']
            ?? null;

        $tiket['tanggal'] = !empty($tanggal)
            ? date('d F Y', strtotime($tanggal))
            : '-';

        // Nama pemohon: prioritaskan nama pada profil.
        $tiket['nama_pemohon'] = $tiket['nama_pemohon']
            ?: ($tiket['full_name'] ?? '-');

        // Identitas: NIK/NIM mengikuti data profil pemohon.
        $tiket['identitas'] = !empty($tiket['nik'])
            ? $tiket['nik']
            : (
                $tiket['nim']
                ?: ($tiket['identity_number'] ?? '-')
            );

        // Email dan nomor HP: profil dahulu, akun sebagai fallback.
        $tiket['email'] = !empty($tiket['email_profil'])
            ? $tiket['email_profil']
            : ($tiket['email'] ?? '-');

        $tiket['no_hp'] = !empty($tiket['no_hp_profil'])
            ? $tiket['no_hp_profil']
            : ($tiket['no_hp'] ?? '-');

        $tiket['nim'] = $tiket['nim'] ?? '';
        $tiket['nik'] = $tiket['nik'] ?? '';

        return $tiket;
    }

    public function laporanTamu()
    {
        return view('petugas/laporan_tamu');
    }

    public function statistikTiket()
    {
        $dataTiket = $this->getAllTiket();
        $statistics = new PetugasTicketStatistics();
        $period = $this->request->getGet('periode') ?? 'bulan';
        $filteredTickets = $statistics->filterByPeriod(
            $dataTiket,
            $period,
            $this->request->getGet('start_date'),
            $this->request->getGet('end_date')
        );
        $summary = $statistics->calculate($filteredTickets);

        $data = [
            'total_tiket'   => $summary['total_tiket'],
            'submitted'     => $summary['submitted'],
            'assigned'      => $summary['verified'],
            'disposisi'     => $summary['disposisi'],
            'in_progress'   => $summary['in_progress'],
            'completed'     => $summary['completed'],
            'need_revision' => $summary['need_revision'],
            'rejected'      => $summary['rejected'],
            'efisiensi'     => $summary['total_tiket'] > 0
                ? (int) round(
                    (
                        ($summary['completed'] + $summary['in_progress'])
                        / $summary['total_tiket']
                    ) * 100
                )
                : 0,
        ];

        return view('petugas/statistik_tiket', $data);
    }

    public function apiStatistikData()
    {
        $dataTiket = $this->getAllTiket();

        $periode = $this->request->getGet('periode') ?? 'semua';
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $statistics = new PetugasTicketStatistics();
        $filteredTiket = $statistics->filterByPeriod(
            $dataTiket,
            $periode,
            $startDate,
            $endDate
        );
        $summary = $statistics->calculate($filteredTiket);
        $efisiensi = $summary['total_tiket'] > 0
            ? round((
                ($summary['completed'] + $summary['in_progress'])
                / $summary['total_tiket']
            ) * 100)
            : 0;

        $timeline = [];

        foreach (array_slice(array_reverse($filteredTiket), 0, 5) as $item) {
            $timeline[] = [
                'kode'         => $item['nomor_tiket'],
                'pemohon'      => $item['nama_pemohon'],
                'layanan'      => $item['layanan'],
                'waktu'        => $item['submitted_at'] ?? $item['created_at'],
                'detail'       => $item['deskripsi'],
                'status'       => $item['status'],
                'status_class' => $item['status'] === 'Completed'
                    ? 'badge-ult-green'
                    : 'badge-ult-orange',
                'dot_class'    => $item['status'] === 'Completed'
                    ? 'success'
                    : 'warning',
                'disposisi'    => $item['kategori'] ?? '-',
            ];
        }

        return $this->response->setJSON([
            'status' => 'success',
            'data' => [
                ...$summary,
                'assigned' => $summary['disposisi'],
                'efisiensi'     => $efisiensi,
                'timeline'      => $timeline,
            ],
        ]);
    }

    public function laporanTiket()
    {
        return view('petugas/laporan_tiket');
    }

    public function trackingTiket()
    {
        $db = db_connect();

        $tickets = $db->table('tickets')
            ->select("
                tickets.*,
                master_services.name AS service_name,
                master_service_units.name AS unit_name,
                user_profiles.*
            ")
            ->join(
                'master_services',
                'master_services.id = tickets.service_id',
                'left'
            )
            ->join(
                'master_service_units',
                'master_service_units.id = master_services.service_unit_id',
                'left'
            )
            ->join(
                'user_profiles',
                'user_profiles.id = tickets.user_profile_id',
                'left'
            )
            ->whereIn('tickets.status', [
                'assigned',
                'in_progress',
                'completed',
            ])
            ->orderBy('tickets.updated_at', 'DESC')
            ->get()
            ->getResultArray();

        return view('petugas/tracking_tiket', [
            'tickets' => $tickets,
        ]);
    }

    public function profile()
    {
        return view('petugas/profile');
    }

    public function log_aktivitas()
    {
        $data = [
            'title'    => 'Log Aktivitas Petugas',
            'search'   => $this->request->getGet('search'),
            'status'   => $this->request->getGet('status'),
            'kategori' => $this->request->getGet('kategori'),
            'limit'    => $this->request->getGet('limit') ?? 10,
            'log_list' => [],
        ];

        return view('petugas/log_aktivitas', $data);
    }
}
