<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PetugasController extends BaseController
{
    private function getAllTiket()
    {
        $db = db_connect();

        $tickets = $db->table('tickets t')
            ->select('
                t.id,
                t.ticket_number AS nomor_tiket,
                t.status,
                t.priority AS prioritas,
                t.created_at,
                t.submitted_at,
                t.title AS layanan,
                t.description AS deskripsi,
                u.full_name AS nama_pemohon,
                u.email,
                u.phone_number AS no_hp
            ')
            ->join('user_profiles up', 'up.id = t.user_profile_id', 'left')
            ->join('users u', 'u.id = up.user_id', 'left')
            ->orderBy('t.id', 'DESC')
            ->get()
            ->getResultArray();

        foreach ($tickets as &$ticket) {
            $status = strtolower($ticket['status'] ?? 'submitted');

$ticket['status'] = match ($status) {
    'submitted'   => 'Submitted',
    'verified'    => 'Verified',
    'assigned'    => 'Disposisi',
    'in_progress' => 'In Progress',
    'completed'   => 'Completed',
    'rejected'    => 'Rejected',
    'need_revision' => 'Need Revision',
    default       => ucfirst($status),
};

            $ticket['prioritas'] = ucfirst(
                strtolower($ticket['prioritas'] ?? 'normal')
            );

            $ticket['tanggal'] = !empty($ticket['created_at'])
                ? date('d F Y', strtotime($ticket['created_at']))
                : '-';
        }

        return $tickets;
    }

    public function dashboard()
    {
        $dataTiket = $this->getAllTiket();

        $data = [
            'total_tiket'   => count($dataTiket),
            'submitted'     => count(array_filter(
                $dataTiket,
                fn($t) => $t['status'] === 'Submitted'
            )),
            'assigned'      => count(array_filter(
                $dataTiket,
                fn($t) => $t['status'] === 'Verified'
            )),
            'in_progress'   => count(array_filter(
                $dataTiket,
                fn($t) => $t['status'] === 'Disposisi'
            )),
            'completed'     => count(array_filter(
                $dataTiket,
                fn($t) => $t['status'] === 'Completed'
            )),
            'need_revision' => count(array_filter(
                $dataTiket,
                fn($t) => $t['status'] === 'Need Revision'
            )),
            'rejected'      => count(array_filter(
                $dataTiket,
                fn($t) => $t['status'] === 'Rejected'
            )),
        ];

        return view('petugas/dashboard', $data);
    }

    public function tiket()
    {
        return view('petugas/tiket', [
            'tickets' => $this->getAllTiket()
        ]);
    }

    public function detail($id = null)
    {
        $tiket = $this->findTiket($id);

        return view('petugas/detail', [
            'id' => $id,
            'tiket' => $tiket
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
            'id'    => $id
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
            'id'    => $id
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
private function findTiket($id)
{
    if ($id === null) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $db = db_connect();

    $tiket = $db->table('tickets t')
        ->select('
            t.id,
            t.ticket_number AS nomor_tiket,
            t.status,
            t.priority AS prioritas,
            t.created_at,
            t.submitted_at,
            t.title AS layanan,
            t.description AS deskripsi,
            u.full_name AS nama_pemohon,
            u.email,
            u.phone_number AS no_hp
        ')
        ->join('user_profiles up', 'up.id = t.user_profile_id', 'left')
        ->join('users u', 'u.id = up.user_id', 'left')
        ->where('t.id', $id)
        ->get()
        ->getRowArray();

    if (!$tiket) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

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

    $tiket['tanggal'] = !empty($tiket['created_at'])
        ? date('d F Y', strtotime($tiket['created_at']))
        : '-';

    return $tiket;
}
    public function laporanTamu()
    {
        return view('petugas/laporan_tamu');
    }

    public function statistikTiket()
    {
        $dataTiket = $this->getAllTiket();

        $submitted     = count(array_filter($dataTiket, fn($t) => $t['status'] === 'Submitted'));
        $verified      = count(array_filter($dataTiket, fn($t) => $t['status'] === 'Verified'));
        $disposisi     = count(array_filter($dataTiket, fn($t) => $t['status'] === 'Disposisi'));
        $completed     = count(array_filter($dataTiket, fn($t) => $t['status'] === 'Completed'));
        $need_revision = count(array_filter($dataTiket, fn($t) => $t['status'] === 'Need Revision'));
        $rejected      = count(array_filter($dataTiket, fn($t) => $t['status'] === 'Rejected'));

        $data = [
            'total_tiket'    => count($dataTiket),
            'submitted'      => $submitted,
            'assigned'       => $verified,
            'in_progress'    => $disposisi,
            'completed'      => $completed,
            'need_revision'  => $need_revision,
            'rejected'       => $rejected,
        ];

        return view('petugas/statistik_tiket', $data);
    }

    /**
     * API Endpoint yang diperbarui untuk mendukung filter berdasarkan Periode & Tanggal Custom
     */
    public function apiStatistikData()
    {
        $dataTiket = $this->getAllTiket();
        $periode = $this->request->getGet('periode') ?? 'semua';
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        // Filter data berdasarkan parameter periode yang dipilih
        $filteredTiket = array_filter($dataTiket, function($t) use ($periode, $startDate, $endDate) {
            $tglTiket = date('Y-m-d', strtotime($t['created_at']));
            
            switch ($periode) {
                case 'hari':
                    return $tglTiket === date('Y-m-d');
                case 'minggu':
                    $startWeek = date('Y-m-d', strtotime('monday this week'));
                    $endWeek = date('Y-m-d', strtotime('sunday this week'));
                    return $tglTiket >= $startWeek && $tglTiket <= $endWeek;
                case 'bulan':
                    return date('Y-m', strtotime($tglTiket)) === date('Y-m');
                case 'tahun':
                    return date('Y', strtotime($tglTiket)) === date('Y');
                case 'custom':
                    if (!empty($startDate) && !empty($endDate)) {
                        return $tglTiket >= $startDate && $tglTiket <= $endDate;
                    }
                    return true;
                case 'semua':
                default:
                    return true;
            }
        });

        $total_tiket   = count($filteredTiket);
        $submitted     = count(array_filter($filteredTiket, fn($t) => $t['status'] === 'Submitted'));
        $assigned      = count(array_filter($filteredTiket, fn($t) => $t['status'] === 'Verified'));
        $in_progress   = count(array_filter($filteredTiket, fn($t) => $t['status'] === 'Disposisi'));
        $completed     = count(array_filter($filteredTiket, fn($t) => $t['status'] === 'Completed'));
        $need_revision = count(array_filter($filteredTiket, fn($t) => $t['status'] === 'Need Revision'));
        $rejected      = count(array_filter($filteredTiket, fn($t) => $t['status'] === 'Rejected'));

        $efisiensi = $total_tiket > 0 ? round((($completed + $in_progress) / $total_tiket) * 100) : 0;

        // Buat dynamic timeline berdasarkan data yang terfilter
        $timeline = [];
        foreach (array_slice(array_reverse($filteredTiket), 0, 5) as $item) {
            $timeline[] = [
                'kode' => $item['nomor_tiket'],
                'pemohon' => $item['nama_pemohon'],
                'layanan' => $item['layanan'],
                'waktu' => $item['created_at'],
                'detail' => $item['deskripsi'],
                'status' => $item['status'],
                'status_class' => $item['status'] == 'Completed' ? 'badge-ult-green' : 'badge-ult-orange',
                'dot_class' => $item['status'] == 'Completed' ? 'success' : 'warning',
                'disposisi' => $item['kategori']
            ];
        }

        return $this->response->setJSON([
            'status' => 'success',
            'data' => [
                'total_tiket'   => $total_tiket,
                'submitted'     => $submitted,
                'assigned'      => $assigned,
                'in_progress'   => $in_progress,
                'completed'     => $completed,
                'need_revision' => $need_revision,
                'rejected'      => $rejected,
                'efisiensi'     => $efisiensi,
                'timeline'      => $timeline
            ]
        ]);
    }

    public function laporanTiket()
    {
        return view('petugas/laporan_tiket');
    }

    public function trackingTiket()
    {
        return view('petugas/tracking_tiket');
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
            'log_list' => []
        ];

        return view('petugas/log_aktivitas', $data);
    }
}
