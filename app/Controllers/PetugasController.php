<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PetugasController extends BaseController
{
    private function getAllTiket()
    {
        $session = session();
        
        if (!$session->has('list_tiket_temp')) {
            $initialData = [
                [
                    'id' => 1,
                    'nomor_tiket' => 'ULT-20260720-0001',
                    'nama_pemohon' => 'Rafi Putra',
                    'nim' => '231511001',
                    'nik' => '3201123456780001',
                    'layanan' => 'Surat Aktif Kuliah',
                    'kategori' => 'Akademik',
                    'prioritas' => 'High',
                    'status' => 'Submitted',
                    'dokumen' => '',
                    'tanggal' => '20 Juli 2026',
                    'created_at' => '2026-07-20 08:30:00',
                    'email' => 'rafi@student.polban.ac.id',
                    'no_hp' => '081234567890',
                    'deskripsi' => 'Saya mengajukan Surat Aktif Kuliah untuk keperluan beasiswa.'
                ],
                [
                    'id' => 2,
                    'nomor_tiket' => 'ULT-20260721-0002',
                    'nama_pemohon' => 'Siti Nurhaliza',
                    'nim' => '231511002',
                    'nik' => '3201123456780002',
                    'layanan' => 'Bantuan UKT',
                    'kategori' => 'Keuangan',
                    'prioritas' => 'Medium',
                    'status' => 'Verified',
                    'dokumen' => '',
                    'tanggal' => '21 Juli 2026',
                    'created_at' => '2026-07-21 09:15:00',
                    'email' => 'siti@student.polban.ac.id',
                    'no_hp' => '081298765432',
                    'deskripsi' => 'Mengajukan bantuan pembayaran UKT semester ganjil.'
                ],
                [
                    'id' => 3,
                    'nomor_tiket' => 'ULT-20260722-0003',
                    'nama_pemohon' => 'Ahmad Fauzi',
                    'nim' => '231511003',
                    'nik' => '3201123456780003',
                    'layanan' => 'Beasiswa Prestasi',
                    'kategori' => 'Kemahasiswaan',
                    'prioritas' => 'Low',
                    'status' => 'Disposisi',
                    'dokumen' => '',
                    'tanggal' => '22 Juli 2026',
                    'created_at' => '2026-07-22 10:00:00',
                    'email' => 'ahmad@student.polban.ac.id',
                    'no_hp' => '081377788899',
                    'deskripsi' => 'Mengajukan beasiswa prestasi akademik.'
                ]
            ];
            $session->set('list_tiket_temp', $initialData);
        }

        return $session->get('list_tiket_temp');
    }

    public function dashboard()
    {
        $dataTiket = $this->getAllTiket();
        
        $data = [
            'total_tiket'   => count($dataTiket),
            'submitted'     => count(array_filter($dataTiket, fn($t) => $t['status'] === 'Submitted')),
            'assigned'      => count(array_filter($dataTiket, fn($t) => $t['status'] === 'Verified')),
            'in_progress'   => count(array_filter($dataTiket, fn($t) => $t['status'] === 'Disposisi')),
            'completed'     => count(array_filter($dataTiket, fn($t) => $t['status'] === 'Completed')),
            'need_revision' => count(array_filter($dataTiket, fn($t) => $t['status'] === 'Need Revision')),
            'rejected'      => count(array_filter($dataTiket, fn($t) => $t['status'] === 'Rejected')),
        ];

        return view('petugas/dashboard', $data);
    }

    public function tiket()
    {
        return view('petugas/tiket', [
            'tiket_list' => $this->getAllTiket()
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
        
        $session = session();
        $allTiket = $this->getAllTiket();
        foreach ($allTiket as &$tiket) {
            if ((int)$tiket['id'] === (int)$id) {
                $tiket['status'] = 'Verified';
            }
        }
        $session->set('list_tiket_temp', $allTiket);

        return redirect()
            ->to(base_url('petugas/tiket'))
            ->with('success', 'Verifikasi tiket berhasil disimpan!');
    }

    public function disposisi($id = null)
    {
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

        $session = session();
        $allTiket = $this->getAllTiket();
        foreach ($allTiket as &$tiket) {
            if ((int)$tiket['id'] === (int)$id) {
                $tiket['status'] = 'Disposisi';
            }
        }
        $session->set('list_tiket_temp', $allTiket);

        return redirect()
            ->to(base_url('petugas/tiket'))
            ->with('success', 'Disposisi tiket berhasil dikirim!');
    }

    private function findTiket($id)
    {
        if ($id === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $allTiket = $this->getAllTiket();

        foreach ($allTiket as $tiket) {
            if ((int) $tiket['id'] === (int) $id) {
                return $tiket;
            }
        }

        return $allTiket[0];
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