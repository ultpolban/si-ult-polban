<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LogAktivitasController extends BaseController
{
    public function index()
    {
        // Parameter URL untuk Filter, Search, Limit, dan Page
        $search   = $this->request->getGet('search') ?? '';
        $status   = $this->request->getGet('status') ?? '';
        $limit    = (int)($this->request->getGet('limit') ?? 10);
        $page     = (int)($this->request->getGet('page') ?? 1);

        // Master Data Dummy (25 Log)
        $allLogs = [
            ['waktu' => '21 Agu 2026', 'jam' => '15:30:10 WIB', 'aktor' => 'Admin ULT 01', 'nip' => 'NIP: 198503122010121001', 'aktivitas' => 'Disposisi', 'objek_tiket' => 'ULT-025', 'detail' => 'Meneruskan tiket ke <strong>Unit Akademik</strong> dengan prioritas', 'priority' => 'High', 'ip_address' => '10.15.2.42'],
            ['waktu' => '21 Agu 2026', 'jam' => '15:12:00 WIB', 'aktor' => 'Siti Nurjanah', 'nip' => 'Petugas Kemahasiswaan', 'aktivitas' => 'Verifikasi', 'objek_tiket' => 'ULT-024', 'detail' => 'Memverifikasi kelengkapan berkas beasiswa pemohon <strong>Rizky Febian</strong>', 'priority' => null, 'ip_address' => '10.15.3.88'],
            ['waktu' => '21 Agu 2026', 'jam' => '14:45:10 WIB', 'aktor' => 'Budi Santoso', 'nip' => 'Petugas Keuangan', 'aktivitas' => 'Export Data', 'objek_tiket' => '-', 'detail' => 'Mengunduh Laporan Keuangan Harian format Excel (.xlsx)', 'priority' => null, 'ip_address' => '10.15.4.11'],
            ['waktu' => '21 Agu 2026', 'jam' => '14:10:05 WIB', 'aktor' => 'Dewi Lestari', 'nip' => 'Petugas Layanan Informasi', 'aktivitas' => 'Disposisi', 'objek_tiket' => 'ULT-023', 'detail' => 'Meneruskan tiket legalisir ijazah ke <strong>Subbag Kemahasiswaan</strong>', 'priority' => 'Medium', 'ip_address' => '10.15.2.15'],
            ['waktu' => '21 Agu 2026', 'jam' => '13:50:22 WIB', 'aktor' => 'Ahmad Fauzi', 'nip' => 'NIP: 199005142018011002', 'aktivitas' => 'Verifikasi', 'objek_tiket' => 'ULT-022', 'detail' => 'Memverifikasi dokumen pengajuan cuti akademik pemohon <strong>Asep Sunandar</strong>', 'priority' => null, 'ip_address' => '10.15.3.102'],
            ['waktu' => '21 Agu 2026', 'jam' => '11:30:00 WIB', 'aktor' => 'System Automator', 'nip' => 'System Core Engine', 'aktivitas' => 'Lainnya', 'objek_tiket' => 'ULT-021', 'detail' => 'Mengirim email notifikasi otomatis ke pemohon tiket <strong>ULT-021</strong>', 'priority' => null, 'ip_address' => '127.0.0.1'],
            ['waktu' => '21 Agu 2026', 'jam' => '10:15:40 WIB', 'aktor' => 'Rina Marlina', 'nip' => 'Petugas Loket Walk-in', 'aktivitas' => 'Disposisi', 'objek_tiket' => 'ULT-020', 'detail' => 'Membuat tiket tamu <strong>Walk-in</strong> dan mendisposisikan ke <strong>Unit Keuangan</strong>', 'priority' => 'Low', 'ip_address' => '10.15.1.05'],
            ['waktu' => '21 Agu 2026', 'jam' => '09:40:12 WIB', 'aktor' => 'Admin ULT 01', 'nip' => 'NIP: 198503122010121001', 'aktivitas' => 'Verifikasi', 'objek_tiket' => 'ULT-019', 'detail' => 'Menolak verifikasi tiket pengajuan surat keterangan pengganti KTM', 'priority' => null, 'ip_address' => '10.15.2.42'],
            ['waktu' => '21 Agu 2026', 'jam' => '09:05:50 WIB', 'aktor' => 'Eko Prasetyo', 'nip' => 'IT Support ULT', 'aktivitas' => 'Lainnya', 'objek_tiket' => '-', 'detail' => 'Melakukan pembersihan cache sistem dan sinkronisasi basis data harian', 'priority' => null, 'ip_address' => '10.15.5.99'],
            ['waktu' => '21 Agu 2026', 'jam' => '08:30:15 WIB', 'aktor' => 'Siti Nurjanah', 'nip' => 'Petugas Kemahasiswaan', 'aktivitas' => 'Disposisi', 'objek_tiket' => 'ULT-018', 'detail' => 'Meneruskan rekomendasi beasiswa ke <strong>Direktorat Kemahasiswaan</strong>', 'priority' => 'High', 'ip_address' => '10.15.3.88'],
            ['waktu' => '20 Agu 2026', 'jam' => '16:00:00 WIB', 'aktor' => 'Admin ULT 02', 'nip' => 'NIP: 198704152012012003', 'aktivitas' => 'Disposisi', 'objek_tiket' => 'ULT-017', 'detail' => 'Meneruskan permohonan ke <strong>Unit Sarpras</strong>', 'priority' => 'Medium', 'ip_address' => '10.15.2.43'],
            ['waktu' => '20 Agu 2026', 'jam' => '15:20:10 WIB', 'aktor' => 'Budi Santoso', 'nip' => 'Petugas Keuangan', 'aktivitas' => 'Verifikasi', 'objek_tiket' => 'ULT-016', 'detail' => 'Verifikasi pembayaran UKT mahasiswa', 'priority' => null, 'ip_address' => '10.15.4.11'],
            ['waktu' => '20 Agu 2026', 'jam' => '14:10:00 WIB', 'aktor' => 'Dewi Lestari', 'nip' => 'Petugas Layanan Informasi', 'aktivitas' => 'Lainnya', 'objek_tiket' => 'ULT-015', 'detail' => 'Pembaruan status tiket dari Open ke In Progress', 'priority' => null, 'ip_address' => '10.15.2.15'],
            ['waktu' => '20 Agu 2026', 'jam' => '13:00:00 WIB', 'aktor' => 'Siti Nurjanah', 'nip' => 'Petugas Kemahasiswaan', 'aktivitas' => 'Disposisi', 'objek_tiket' => 'ULT-014', 'detail' => 'Meneruskan berkas ke jurusan Elektro', 'priority' => 'Low', 'ip_address' => '10.15.3.88'],
            ['waktu' => '20 Agu 2026', 'jam' => '11:15:30 WIB', 'aktor' => 'Admin ULT 01', 'nip' => 'NIP: 198503122010121001', 'aktivitas' => 'Export Data', 'objek_tiket' => '-', 'detail' => 'Export data log mingguan', 'priority' => null, 'ip_address' => '10.15.2.42'],
            ['waktu' => '20 Agu 2026', 'jam' => '10:00:15 WIB', 'aktor' => 'Ahmad Fauzi', 'nip' => 'NIP: 199005142018011002', 'aktivitas' => 'Verifikasi', 'objek_tiket' => 'ULT-013', 'detail' => 'Verifikasi surat pengantar magang', 'priority' => null, 'ip_address' => '10.15.3.102'],
            ['waktu' => '20 Agu 2026', 'jam' => '09:30:22 WIB', 'aktor' => 'Rina Marlina', 'nip' => 'Petugas Loket Walk-in', 'aktivitas' => 'Disposisi', 'objek_tiket' => 'ULT-012', 'detail' => 'Disposisi permohonan transkrip nilai', 'priority' => 'High', 'ip_address' => '10.15.1.05'],
            ['waktu' => '20 Agu 2026', 'jam' => '08:45:00 WIB', 'aktor' => 'System Automator', 'nip' => 'System Core Engine', 'aktivitas' => 'Lainnya', 'objek_tiket' => '-', 'detail' => 'Auto backup log database', 'priority' => null, 'ip_address' => '127.0.0.1'],
            ['waktu' => '19 Agu 2026', 'jam' => '16:10:05 WIB', 'aktor' => 'Budi Santoso', 'nip' => 'Petugas Keuangan', 'aktivitas' => 'Verifikasi', 'objek_tiket' => 'ULT-011', 'detail' => 'Verifikasi kuitansi pembayaran pendaftaran', 'priority' => null, 'ip_address' => '10.15.4.11'],
            ['waktu' => '19 Agu 2026', 'jam' => '15:00:00 WIB', 'aktor' => 'Admin ULT 02', 'nip' => 'NIP: 198704152012012003', 'aktivitas' => 'Disposisi', 'objek_tiket' => 'ULT-010', 'detail' => 'Disposisi surat masuk universitas', 'priority' => 'Medium', 'ip_address' => '10.15.2.43'],
            ['waktu' => '19 Agu 2026', 'jam' => '14:22:11 WIB', 'aktor' => 'Dewi Lestari', 'nip' => 'Petugas Layanan Informasi', 'aktivitas' => 'Verifikasi', 'objek_tiket' => 'ULT-009', 'detail' => 'Verifikasi data permohonan informasi publik', 'priority' => null, 'ip_address' => '10.15.2.15'],
            ['waktu' => '19 Agu 2026', 'jam' => '13:10:00 WIB', 'aktor' => 'Siti Nurjanah', 'nip' => 'Petugas Kemahasiswaan', 'aktivitas' => 'Disposisi', 'objek_tiket' => 'ULT-008', 'detail' => 'Meneruskan pengajuan lomba mahasiswa', 'priority' => 'Low', 'ip_address' => '10.15.3.88'],
            ['waktu' => '19 Agu 2026', 'jam' => '11:00:00 WIB', 'aktor' => 'Eko Prasetyo', 'nip' => 'IT Support ULT', 'aktivitas' => 'Lainnya', 'objek_tiket' => '-', 'detail' => 'Maintenance server internal', 'priority' => null, 'ip_address' => '10.15.5.99'],
            ['waktu' => '19 Agu 2026', 'jam' => '10:05:12 WIB', 'aktor' => 'Admin ULT 01', 'nip' => 'NIP: 198503122010121001', 'aktivitas' => 'Export Data', 'objek_tiket' => '-', 'detail' => 'Export data rekapitulasi bulanan', 'priority' => null, 'ip_address' => '10.15.2.42'],
            ['waktu' => '19 Agu 2026', 'jam' => '08:15:00 WIB', 'aktor' => 'Rina Marlina', 'nip' => 'Petugas Loket Walk-in', 'aktivitas' => 'Disposisi', 'objek_tiket' => 'ULT-007', 'detail' => 'Disposisi pengaduan fasilitas kampus', 'priority' => 'High', 'ip_address' => '10.15.1.05'],
        ];

        // Filter Proses
        $filtered = array_filter($allLogs, function ($item) use ($search, $status) {
            $matchSearch = empty($search) || 
                stripos($item['objek_tiket'], $search) !== false || 
                stripos($item['aktor'], $search) !== false || 
                stripos($item['nip'], $search) !== false;

            $matchStatus = empty($status) || $item['aktivitas'] === $status;

            return $matchSearch && $matchStatus;
        });

        // Hitung Paginasi
        $totalData  = count($filtered);
        $totalPages = ceil($totalData / $limit);
        if ($page < 1) $page = 1;
        if ($page > $totalPages && $totalPages > 0) $page = $totalPages;

        $offset     = ($page - 1) * $limit;
        $pagedLogs  = array_slice(array_values($filtered), $offset, $limit);

        $startData  = $totalData > 0 ? $offset + 1 : 0;
        $endData    = min($offset + $limit, $totalData);

        $data = [
            'title'       => 'Riwayat Log Sistem - SI-ULT POLBAN',
            'totalLog'    => count($allLogs),
            'disposisi'   => 12,
            'verifikasi'  => 8,
            'lainnya'     => 5,
            'logs'        => $pagedLogs,
            'totalFiltered' => $totalData,
            'startData'   => $startData,
            'endData'     => $endData,
            'currentPage' => $page,
            'totalPages'  => $totalPages,
            'search'      => $search,
            'status'      => $status,
            'limit'       => $limit
        ];

        return view('log_aktivitas', $data);
    }
}