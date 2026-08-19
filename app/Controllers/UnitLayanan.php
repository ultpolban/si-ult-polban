<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UnitLayanan extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    /**
     * =========================================================
     * AMBIL DATA TIKET
     * Database baru menggunakan tabel: tickets
     * =========================================================
     */
    private function getTicket($id)
    {
        return $this->db
            ->table('tickets')
            ->where('id', $id)
            ->get()
            ->getRowArray();
    }

    /**
     * =========================================================
     * AMBIL SEMUA TIKET
     * =========================================================
     */
    private function getAllTickets()
    {
        return $this->db
            ->table('tickets')
            ->orderBy('id', 'DESC')
            ->get()
            ->getResultArray();
    }

    /**
     * =========================================================
     * FORMAT DATA TIKET UNTUK VIEW
     * =========================================================
     */
    private function formatTicket(array $ticket): array
    {
        return [
            'id' => $ticket['id'] ?? null,

            'no_tiket' => $ticket['ticket_number']
                ?? 'TKT-' . ($ticket['id'] ?? ''),

            'ticket_number' => $ticket['ticket_number']
                ?? 'TKT-' . ($ticket['id'] ?? ''),

            'judul' => $ticket['title']
                ?? 'Permohonan Layanan',

            'title' => $ticket['title']
                ?? 'Permohonan Layanan',

            'deskripsi' => $ticket['description']
                ?? 'Tidak ada deskripsi tambahan.',

            'description' => $ticket['description']
                ?? 'Tidak ada deskripsi tambahan.',

            'status' => $ticket['status']
                ?? 'Menunggu',

            'priority' => $ticket['priority']
                ?? 'Normal',

            'user_profile_id' => $ticket['user_profile_id']
                ?? null,

            'service_id' => $ticket['service_id']
                ?? null,

            'assigned_to' => $ticket['assigned_to']
                ?? null,

            'created_at' => $ticket['created_at']
                ?? $ticket['submitted_at']
                ?? null,

            'updated_at' => $ticket['updated_at']
                ?? null,

            'submitted_at' => $ticket['submitted_at']
                ?? null,

            'verified_at' => $ticket['verified_at']
                ?? null,

            'processed_at' => $ticket['processed_at']
                ?? null,

            'completed_at' => $ticket['completed_at']
                ?? null,

            'admin_note' => $ticket['admin_note']
                ?? '',

            'catatan' => $ticket['admin_note']
                ?? '',

            'nama_layanan' => 'Layanan',

            'nama_kategori' => 'Layanan ULT',

            'nama_unit' => 'Unit Layanan',

            'nama_pemohon' => 'Pemohon',

            'nim' => '-',

            'dokumen_hasil' => [],
        ];
    }

    /**
     * =========================================================
     * INDEX
     * =========================================================
     */
    public function index()
    {
        $tickets = $this->getAllTickets();

        $dataTiket = [];

        foreach ($tickets as $ticket) {
            $dataTiket[] = $this->formatTicket($ticket);
        }

        return view('unit_layanan/index', [
            'title' => 'Dashboard Unit Layanan',
            'tiket' => $dataTiket,
        ]);
    }

    /**
     * =========================================================
     * DETAIL TIKET
     * =========================================================
     */
    public function detail($id)
    {
        $ticket = $this->getTicket($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('unit-layanan/dashboard'))
                ->with('error', 'Data tiket tidak ditemukan');
        }

        $tiket = $this->formatTicket($ticket);

        return view('unit_layanan/detail', [
            'title' => 'Detail Tiket',
            'tiket' => $tiket,
        ]);
    }

    /**
     * =========================================================
     * PROSES TIKET
     * =========================================================
     */
    public function proses($id)
    {
        $ticket = $this->getTicket($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('unit-layanan/dashboard'))
                ->with('error', 'Data tiket tidak ditemukan');
        }

        $tiket = $this->formatTicket($ticket);

        return view('unit_layanan/proses', [
            'title' => 'Proses Tiket',
            'tiket' => $tiket,
        ]);
    }

    /**
     * =========================================================
     * UPDATE PROSES TIKET
     * =========================================================
     */
    public function updateProses($id)
    {
        $ticket = $this->getTicket($id);

        if (!$ticket) {
            return redirect()
                ->back()
                ->with('error', 'Data tiket tidak ditemukan');
        }

        $status = trim(
            (string) $this->request->getPost('status')
        );

        $catatan = trim(
            (string) $this->request->getPost('catatan')
        );

        if ($status === '') {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Status tiket wajib dipilih.');
        }

        $data = [
            'status' => $status,
            'admin_note' => $catatan,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        /*
         * Simpan timestamp sesuai status
         */
        switch (strtolower($status)) {

            case 'diproses':
                $data['processed_at'] = date('Y-m-d H:i:s');
                break;

            case 'selesai':
                $data['completed_at'] = date('Y-m-d H:i:s');
                break;

            case 'ditolak':
                $data['rejected_at'] = date('Y-m-d H:i:s');
                $data['rejection_reason'] = $catatan;
                break;
        }

        $this->db
            ->table('tickets')
            ->where('id', $id)
            ->update($data);

        return redirect()
            ->to(base_url('unit-layanan/detail/' . $id))
            ->with('success', 'Tiket berhasil diperbarui.');
    }

    /**
     * =========================================================
     * DASHBOARD
     * =========================================================
     */
    public function dashboard()
    {
        $builder = $this->db->table('tickets');

        $menunggu = $builder
            ->where('status', 'Menunggu')
            ->countAllResults();

        $diproses = $this->db
            ->table('tickets')
            ->where('status', 'Diproses')
            ->countAllResults();

        $selesai = $this->db
            ->table('tickets')
            ->where('status', 'Selesai')
            ->countAllResults();

        $total = $this->db
            ->table('tickets')
            ->countAllResults();

        $tickets = $this->getAllTickets();

        $dataTiket = [];

        foreach ($tickets as $ticket) {
            $dataTiket[] = $this->formatTicket($ticket);
        }

        return view('unit_layanan/dashboard', [
            'title' => 'Dashboard Unit Layanan',

            'menunggu' => $menunggu,

            'diproses' => $diproses,

            'selesai' => $selesai,

            'total' => $total,

            'tiket' => $dataTiket,
        ]);
    }

    /**
     * =========================================================
     * PROFIL PETUGAS
     * =========================================================
     */
    public function profile()
    {
        $session = session();

        $data = [
            'title' => 'Profil Petugas Unit Layanan',

            'name' => $session->get('name')
                ?: 'Budi Santoso',

            'nip' => $session->get('nip')
                ?: '198603122024011002',

            'email' => $session->get('email')
                ?: 'budi.santoso@polban.ac.id',

            'no_hp' => $session->get('no_hp')
                ?: '081298765432',

            'jabatan' => $session->get('jabatan')
                ?: 'Petugas Unit Layanan',
        ];

        return view(
            'unit_layanan/profile',
            $data
        );
    }

    /**
     * =========================================================
     * UPDATE PROFIL
     * =========================================================
     */
    public function updateProfile()
    {
        $session = session();

        $name = trim(
            (string) $this->request->getPost('name')
        );

        $nip = trim(
            (string) $this->request->getPost('nip')
        );

        $email = trim(
            (string) $this->request->getPost('email')
        );

        $no_hp = trim(
            (string) $this->request->getPost('no_hp')
        );

        $jabatan = trim(
            (string) $this->request->getPost('jabatan')
        );

        if ($name === '') {
            return redirect()
                ->to(base_url('unit-layanan/profile'))
                ->withInput()
                ->with(
                    'error',
                    'Nama Lengkap wajib diisi.'
                );
        }

        if ($nip === '') {
            return redirect()
                ->to(base_url('unit-layanan/profile'))
                ->withInput()
                ->with(
                    'error',
                    'NIP wajib diisi.'
                );
        }

        if ($email === '') {
            return redirect()
                ->to(base_url('unit-layanan/profile'))
                ->withInput()
                ->with(
                    'error',
                    'Email wajib diisi.'
                );
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()
                ->to(base_url('unit-layanan/profile'))
                ->withInput()
                ->with(
                    'error',
                    'Format email tidak valid.'
                );
        }

        $session->set([
            'name' => $name,
            'nip' => $nip,
            'email' => $email,
            'no_hp' => $no_hp,
            'jabatan' => $jabatan,
        ]);

        return redirect()
            ->to(base_url('unit-layanan/profile'))
            ->with(
                'success',
                'Profil berhasil diperbarui.'
            );
    }

    /**
     * =========================================================
     * UPLOAD
     * =========================================================
     *
     * Untuk sementara halaman upload tetap diarahkan
     * ke proses tiket karena database baru belum memiliki
     * tabel dokumen_hasil.
     */
    public function upload($id)
    {
        $ticket = $this->getTicket($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('unit-layanan/dashboard'))
                ->with('error', 'Data tiket tidak ditemukan');
        }

        $tiket = $this->formatTicket($ticket);

        return view('unit_layanan/upload', [
            'title' => 'Upload Dokumen Hasil',
            'tiket' => $tiket,
            'dokumen_hasil' => [],
        ]);
    }

    /**
     * =========================================================
     * SIMPAN UPLOAD
     * =========================================================
     *
     * Database baru belum memiliki tabel dokumen_hasil.
     * File tetap divalidasi dan disimpan ke folder uploads/hasil.
     */
    public function simpanUpload($id)
    {
        $ticket = $this->getTicket($id);

        if (!$ticket) {
            return redirect()
                ->back()
                ->with('error', 'Data tiket tidak ditemukan');
        }

        $files = $this->request->getFileMultiple('file_hasil');

        if ($files === null) {
            $files = [];
        }

        if (!is_array($files)) {
            $files = [$files];
        }

        if (empty($files)) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Silahkan pilih dokumen terlebih dahulu'
                );
        }

        $uploadPath = FCPATH . 'uploads/hasil';

        if (!is_dir($uploadPath)) {
            mkdir(
                $uploadPath,
                0777,
                true
            );
        }

        $uploaded = 0;

        foreach ($files as $file) {

            if (
                !$file ||
                !$file->isValid() ||
                $file->hasMoved()
            ) {
                continue;
            }

            if ($file->getSize() > 5242880) {
                return redirect()
                    ->back()
                    ->with(
                        'error',
                        'Ukuran file maksimal 5 MB.'
                    );
            }

            $extension = strtolower(
                $file->getClientExtension()
            );

            if (
                !in_array(
                    $extension,
                    ['pdf', 'jpg', 'jpeg', 'png'],
                    true
                )
            ) {
                return redirect()
                    ->back()
                    ->with(
                        'error',
                        'Format file hanya PDF, JPG, JPEG, atau PNG.'
                    );
            }

            $file->move(
                $uploadPath,
                $file->getRandomName()
            );

            $uploaded++;
        }

        if ($uploaded === 0) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tidak ada file yang berhasil diupload.'
                );
        }

        return redirect()
            ->to(
                base_url(
                    'unit-layanan/detail/' . $id
                )
            )
            ->with(
                'success',
                $uploaded . ' dokumen berhasil diupload.'
            );
    }

    /**
     * =========================================================
     * KIRIM KE ULT
     * =========================================================
     */
    public function kirim($id)
    {
        $ticket = $this->getTicket($id);

        if (!$ticket) {
            return redirect()
                ->back()
                ->with('error', 'Data tiket tidak ditemukan');
        }

        $status = strtolower(
            (string) ($ticket['status'] ?? '')
        );

        if ($status !== 'selesai') {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tiket hanya bisa dikirim setelah status Selesai.'
                );
        }

        $this->db
            ->table('tickets')
            ->where('id', $id)
            ->update([
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return redirect()
            ->to(
                base_url(
                    'unit-layanan/detail/' . $id
                )
            )
            ->with(
                'success',
                'Tiket berhasil dikirim ke Petugas ULT.'
            );
    }

    /**
     * =========================================================
     * KIRIM KE PEMOHON
     * =========================================================
     */
    public function kirimKePemohon($id)
    {
        $ticket = $this->getTicket($id);

        if (!$ticket) {
            return redirect()
                ->back()
                ->with('error', 'Data tiket tidak ditemukan');
        }

        $status = strtolower(
            (string) ($ticket['status'] ?? '')
        );

        if (
            !in_array(
                $status,
                ['selesai', 'diproses'],
                true
            )
        ) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tiket hanya bisa dikirim ke pemohon setelah status Selesai atau Diproses.'
                );
        }

        $data = [
            'status' => 'Selesai',
            'completed_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->db
            ->table('tickets')
            ->where('id', $id)
            ->update($data);

        return redirect()
            ->to(
                base_url(
                    'unit-layanan/detail/' . $id
                )
            )
            ->with(
                'success',
                'Tiket berhasil dikirim ke pemohon.'
            );
    }

    /**
     * =========================================================
     * RIWAYAT
     * =========================================================
     */
    public function riwayat()
    {
        return redirect()
            ->to(
                base_url(
                    'unit-layanan/dashboard'
                )
            );
    }

    /**
     * =========================================================
     * HAPUS DOKUMEN
     * =========================================================
     */
    public function hapusDokumen($id)
    {
        return redirect()
            ->back()
            ->with(
                'error',
                'Fitur penghapusan dokumen hasil belum tersedia pada struktur database baru.'
            );
    }
}