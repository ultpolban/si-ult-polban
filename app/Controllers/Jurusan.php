<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JurusanTicketModel;

class Jurusan extends BaseController
{
    protected $db;
    protected $ticketModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->ticketModel = new JurusanTicketModel();
    }

    protected function queryTiket(): \CodeIgniter\Database\BaseBuilder
    {
        return $this->db->table('jurusan_tickets t')
            ->select(
                't.*, t.ticket_number AS no_tiket,
                 t.title AS judul,
                 t.description AS deskripsi,
                  t.service_name AS nama_layanan,
                  t.service_category AS nama_kategori,
                  t.unit_name AS nama_unit,
                  t.applicant_name AS nama_pemohon'
            )
            ->groupBy('t.id');
    }

    protected function normalizeStatus(string $status): ?string
    {
        $status = strtolower(trim($status));

        $map = [
            'draft' => 'submitted',
            'submitted' => 'submitted',
            'menunggu' => 'submitted',
            'waiting' => 'submitted',
            'verification' => 'processing',
            'processing' => 'processing',
            'in_progress' => 'processing',
            'diproses' => 'processing',
            'completed' => 'completed',
            'complete' => 'completed',
            'selesai' => 'completed',
            'rejected' => 'rejected',
            'ditolak' => 'rejected',
        ];

        return $map[$status] ?? null;
    }

    protected function statusTampilan(string $status): string
    {
        switch ($this->normalizeStatus($status)) {
            case 'submitted':
                return 'Menunggu';
            case 'processing':
                return 'Diproses';
            case 'completed':
                return 'Selesai';
            case 'rejected':
                return 'Ditolak';
            default:
                return 'Menunggu';
        }
    }

    protected function statusCounts(array $tickets): array
    {
        $counts = [
            'menunggu' => 0,
            'diproses' => 0,
            'selesai' => 0,
            'ditolak' => 0,
        ];

        foreach ($tickets as $ticket) {
            $status = $this->normalizeStatus((string) ($ticket['status'] ?? ''));

            switch ($status) {
                case 'submitted':
                    $counts['menunggu']++;
                    break;
                case 'processing':
                    $counts['diproses']++;
                    break;
                case 'completed':
                    $counts['selesai']++;
                    break;
                case 'rejected':
                    $counts['ditolak']++;
                    break;
            }
        }

        return $counts;
    }

    public function index()
    {
        return $this->dashboard();
    }

    public function dashboard()
    {
        $tickets = $this->queryTiket()->orderBy('t.id', 'DESC')->get()->getResultArray();
        $counts = $this->statusCounts($tickets);
        $data = [
            'title' => 'Dashboard Layanan Jurusan',
            'unit' => 'Jurusan',
            'tickets' => $tickets,
            'tiket' => $tickets,
            'total' => count($tickets),
            'totalTiket' => count($tickets),
            'menunggu' => $counts['menunggu'],
            'diproses' => $counts['diproses'],
            'selesai' => $counts['selesai'],
            'ditolak' => $counts['ditolak'],
            'dataTiketUrl' => site_url('jurusan/data-tiket'),
        ];

        return view('jurusan/dashboard', $data);
    }

    public function dataTiket()
    {
        $keyword = trim((string) $this->request->getGet('keyword'));
        $tickets = $this->queryTiket()->orderBy('t.id', 'DESC')->get()->getResultArray();

        if ($keyword !== '') {
            $tickets = array_values(array_filter(
                $tickets,
                static function ($ticket) use ($keyword) {
                    $haystack = strtolower(implode(' ', array_map('strval', $ticket)));
                    return str_contains($haystack, strtolower($keyword));
                }
            ));
        }

        foreach ($tickets as &$ticket) {
            $ticket['status_tampilan'] = $this->statusTampilan($ticket['status'] ?? '');
        }

        return view('jurusan/data_tiket', [
            'title' => 'Data Tiket Jurusan',
            'tickets' => $tickets,
            'tiket' => $tickets,
            'keyword' => $keyword,
            'unit' => 'Jurusan',
            'nama_unit' => 'Jurusan',
        ]);
    }

    public function statistik()
    {
        $tickets = $this->queryTiket()->orderBy('t.id', 'DESC')->get()->getResultArray();
        $counts = $this->statusCounts($tickets);

        return view('jurusan/statistik', [
            'title' => 'Statistik Layanan Jurusan',
            'unit' => 'Jurusan',
            'tickets' => $tickets,
            'tiket' => $tickets,
            'total' => count($tickets),
            'totalTiket' => count($tickets),
            'menunggu' => $counts['menunggu'],
            'diproses' => $counts['diproses'],
            'selesai' => $counts['selesai'],
            'ditolak' => $counts['ditolak'],
            'statistikLayanan' => [],
            'dataTiketUrl' => site_url('jurusan/data-tiket'),
        ]);
    }

    public function logAktivitas()
    {
        $keyword = trim((string) $this->request->getGet('keyword'));

        $query = $this->db->table('jurusan_activity_logs al')
            ->select('al.ticket_id, t.ticket_number AS no_tiket, t.unit_name AS unit, t.service_name AS layanan, al.action AS aktivitas, al.status, al.created_at AS waktu')
            ->join('jurusan_tickets t', 't.id = al.ticket_id', 'left');

        if ($keyword !== '') {
            $query = $query
                ->groupStart()
                ->like('t.ticket_number', $keyword)
                ->orLike('t.unit_name', $keyword)
                ->orLike('t.service_name', $keyword)
                ->orLike('al.action', $keyword)
                ->orLike('t.status', $keyword)
                ->groupEnd();
        }

        return view('jurusan/log_aktivitas', [
            'title' => 'Log Aktivitas Layanan Jurusan',
            'unit' => 'Jurusan',
            'units' => ['Jurusan'],
            'logs' => $query->orderBy('al.created_at', 'DESC')->get()->getResultArray(),
            'keyword' => $keyword,
        ]);
    }

    public function profile()
    {
        $session = session();

        return view('jurusan/profile', [
            'title' => 'Profil Petugas Jurusan',
            'name' => $session->get('name') ?: 'Petugas Jurusan',
            'nip' => $session->get('nip') ?: '198705152024011001',
            'email' => $session->get('email') ?: 'petugas.jurusan@polban.ac.id',
            'no_hp' => $session->get('no_hp') ?: '081234567890',
            'jabatan' => $session->get('jabatan') ?: 'Petugas Unit Layanan',
        ]);
    }

    public function detail($id)
    {
        $ticket = $this->queryTiket()
            ->where('t.id', $id)
            ->get()
            ->getRowArray();

        if (!$ticket) {
            return redirect()->to('/jurusan/data-tiket')->with('error', 'Data tiket tidak ditemukan.');
        }

        $ticket['status_tampilan'] = $this->statusTampilan($ticket['status'] ?? '');

        return view('jurusan/detail', [
            'title' => 'Detail Tiket Jurusan',
            'ticket' => $ticket,
            'unit' => 'Jurusan',
        ]);
    }

    public function updateProfile()
    {
        $session = session();

        $session->set([
            'name' => trim((string) $this->request->getPost('name')),
            'nip' => trim((string) $this->request->getPost('nip')),
            'email' => trim((string) $this->request->getPost('email')),
            'no_hp' => trim((string) $this->request->getPost('no_hp')),
            'jabatan' => trim((string) $this->request->getPost('jabatan')),
        ]);

        return redirect()->to('/jurusan/profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function proses($id)
    {
        $ticket = $this->ticketModel->queryTickets()->where('jurusan_tickets.id', (int) $id)->first();
        if (!$ticket) {
            return redirect()->to('/jurusan/data-tiket')->with('error', 'Data tiket tidak ditemukan.');
        }

        return view('jurusan/proses', [
            'title' => 'Proses Tiket Jurusan',
            'tiket' => $ticket,
            'ticket' => $ticket,
            'unit' => 'Jurusan',
        ]);
    }

    public function updateProses($id)
    {
        $ticket = $this->ticketModel->find((int) $id);
        if (!$ticket) {
            return redirect()->back()->with('error', 'Data tiket tidak ditemukan.');
        }

        $status = strtolower(trim((string) $this->request->getPost('status')));
        $statusMap = [
            'menunggu' => 'submitted',
            'diproses' => 'processing',
            'selesai' => 'completed',
            'ditolak' => 'rejected',
        ];
        if (!isset($statusMap[$status])) {
            return redirect()->back()->withInput()->with('error', 'Status tiket tidak valid.');
        }

        $this->ticketModel->update((int) $id, [
            'status' => $statusMap[$status],
            'admin_note' => trim((string) $this->request->getPost('catatan')),
            'processed_at' => date('Y-m-d H:i:s'),
            'completed_at' => $status === 'selesai' ? date('Y-m-d H:i:s') : null,
        ]);

        return redirect()->to('/jurusan/detail/' . (int) $id)
            ->with('success', 'Status tiket Jurusan berhasil diperbarui.');
    }

    public function lihatFile(string $fileName)
    {
        return $this->serveUploadedFile($fileName, false);
    }

    public function downloadFile(string $fileName)
    {
        return $this->serveUploadedFile($fileName, true);
    }

    private function serveUploadedFile(string $fileName, bool $download)
    {
        $safeFileName = basename($fileName);
        $filePath = WRITEPATH . 'uploads/jurusan/' . $safeFileName;

        if (!is_file($filePath)) {
            return redirect()->back()->with('error', 'File hasil layanan tidak ditemukan.');
        }

        $mimeType = mime_content_type($filePath) ?: 'application/octet-stream';
        $response = $this->response;
        $response->setHeader('Content-Type', $mimeType);
        $response->setHeader(
            'Content-Disposition',
            ($download ? 'attachment' : 'inline') . '; filename="' . $safeFileName . '"'
        );
        $response->setBody(file_get_contents($filePath));

        return $response;
    }

    public function upload($id)
    {
        $ticket = $this->ticketModel->find((int) $id);
        if (!$ticket) {
            return redirect()->to('/jurusan/data-tiket')->with('error', 'Data tiket tidak ditemukan.');
        }

        return view('jurusan/upload', ['tiket' => $ticket, 'unit' => 'Jurusan']);
    }

    public function simpanUpload($id)
    {
        $ticket = $this->ticketModel->find((int) $id);
        $file = $this->request->getFile('dokumen');
        if (!$ticket || !$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'Dokumen Jurusan tidak valid.');
        }

        $directory = WRITEPATH . 'uploads/jurusan';
        if (!is_dir($directory)) {
            mkdir($directory, 0750, true);
        }
        $name = $file->getRandomName();
        $file->move($directory, $name);
        $this->ticketModel->update((int) $id, [
            'result_file' => $name,
            'result_note' => 'Dokumen hasil layanan diunggah.',
        ]);

        return redirect()->to('/jurusan/detail/' . (int) $id)
            ->with('success', 'Dokumen hasil layanan berhasil diunggah.');
    }
}
