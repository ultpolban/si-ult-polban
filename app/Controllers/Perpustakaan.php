<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PerpustakaanTicketModel;

class Perpustakaan extends BaseController
{
    protected $db;
    protected PerpustakaanTicketModel $ticketModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->ticketModel = new PerpustakaanTicketModel();
    }

    private function queryTiket(): \CodeIgniter\Database\BaseBuilder
    {
        return $this->db->table('perpustakaan_tickets t')
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

    private function statusTampilan($status): string
    {
        $status = strtolower(trim((string) $status));

        $mapping = [
            'draft' => 'Menunggu',
            'submitted' => 'Menunggu',
            'menunggu' => 'Menunggu',
            'verification' => 'Diproses',
            'processing' => 'Diproses',
            'in_progress' => 'Diproses',
            'diproses' => 'Diproses',
            'completed' => 'Selesai',
            'complete' => 'Selesai',
            'selesai' => 'Selesai',
        ];

        return $mapping[$status] ?? ucfirst($status);
    }

    private function statusCounts(array $tickets): array
    {
        $counts = [
            'menunggu' => 0,
            'diproses' => 0,
            'selesai' => 0,
        ];

        foreach ($tickets as $ticket) {
            $status = strtolower(trim((string) ($ticket['status'] ?? '')));

            switch ($status) {
                case 'draft':
                case 'submitted':
                case 'menunggu':
                    $counts['menunggu']++;
                    break;
                case 'verification':
                case 'processing':
                case 'in_progress':
                case 'diproses':
                    $counts['diproses']++;
                    break;
                case 'completed':
                case 'complete':
                case 'selesai':
                    $counts['selesai']++;
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
            'title' => 'Dashboard Perpustakaan',
            'unit' => 'Perpustakaan',
            'tickets' => $tickets,
            'tiket' => $tickets,
            'total' => count($tickets),
            'totalTiket' => count($tickets),
            'menunggu' => $counts['menunggu'],
            'diproses' => $counts['diproses'],
            'selesai' => $counts['selesai'],
            'dataTiketUrl' => site_url('perpustakaan/data-tiket'),
        ];

        return view('perpustakaan/dashboard', $data);
    }

    public function dataTiket()
    {
        $keyword = trim((string) $this->request->getGet('keyword'));
        $tickets = $this->queryTiket()->orderBy('t.id', 'DESC')->get()->getResultArray();

        if ($keyword !== '') {
            $tickets = array_values(array_filter(
                $tickets,
                static fn ($ticket) => str_contains(strtolower(implode(' ', array_map('strval', $ticket))), strtolower($keyword))
            ));
        }

        foreach ($tickets as &$ticket) {
            $ticket['status_tampilan'] = $this->statusTampilan($ticket['status'] ?? '');
        }

        return view('perpustakaan/data_tiket', [
            'tickets' => $tickets,
            'tiket' => $tickets,
            'keyword' => $keyword,
            'unit' => 'Perpustakaan',
            'nama_unit' => 'Perpustakaan',
        ]);
    }

    public function statistik()
    {
        $tickets = $this->queryTiket()->orderBy('t.id', 'DESC')->get()->getResultArray();
        $counts = $this->statusCounts($tickets);

        return view('perpustakaan/statistik', [
            'title' => 'Statistik Perpustakaan',
            'unit' => 'Perpustakaan',
            'tickets' => $tickets,
            'tiket' => $tickets,
            'total' => count($tickets),
            'totalTiket' => count($tickets),
            'menunggu' => $counts['menunggu'],
            'diproses' => $counts['diproses'],
            'selesai' => $counts['selesai'],
            'statistikLayanan' => [],
            'dataTiketUrl' => site_url('perpustakaan/data-tiket'),
        ]);
    }

    public function logAktivitas()
    {
        $keyword = trim((string) $this->request->getGet('keyword'));
        $selectedUnit = trim((string) $this->request->getGet('unit'));

        $logs = $this->db->table('perpustakaan_activity_logs al')
            ->select('al.ticket_id, t.ticket_number AS no_tiket, t.unit_name AS unit, t.service_name AS layanan, al.action AS aktivitas, al.status, al.created_at AS waktu')
            ->join('perpustakaan_tickets t', 't.id = al.ticket_id', 'left');

        if ($keyword !== '') {
            $logs = $logs
                ->groupStart()
                ->like('t.ticket_number', $keyword)
                ->orLike('t.unit_name', $keyword)
                ->orLike('t.service_name', $keyword)
                ->orLike('al.action', $keyword)
                ->orLike('t.status', $keyword)
                ->groupEnd();
        }

        if ($selectedUnit !== '' && strcasecmp($selectedUnit, 'Perpustakaan') !== 0) {
            $logs = $logs->where('1 = 0');
        }

        return view('perpustakaan/log_aktivitas', [
            'unit' => 'Perpustakaan',
            'units' => ['Perpustakaan'],
            'logs' => $logs->orderBy('al.created_at', 'DESC')->get()->getResultArray(),
            'keyword' => $keyword,
        ]);
    }

    public function profile()
    {
        $session = session();

        return view('perpustakaan/profile', [
            'title' => 'Profil Petugas Perpustakaan',
            'name' => $session->get('name') ?: 'Petugas Perpustakaan',
            'nip' => $session->get('nip') ?: '198705152024011001',
            'email' => $session->get('email') ?: 'petugas.perpustakaan@polban.ac.id',
            'no_hp' => $session->get('no_hp') ?: '081234567890',
            'jabatan' => $session->get('jabatan') ?: 'Petugas Unit Layanan',
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

        return redirect()->to(base_url('perpustakaan/profile'))->with('success', 'Profil berhasil diperbarui.');
    }

    public function detail($id)
    {
        $tiket = $this->queryTiket()->where('t.id', $id)->get()->getRowArray();

        if (!$tiket) {
            return redirect()->to(base_url('perpustakaan/dashboard'))->with('error', 'Data tiket tidak ditemukan.');
        }

        $tiket['status_tampilan'] = $this->statusTampilan($tiket['status'] ?? '');
        $tiket['dokumen_hasil'] = !empty($tiket['result_file'])
            ? [[
                'nama_file' => $tiket['result_file'],
                'nama_asli' => $tiket['result_file'],
            ]]
            : [];

        if (($tiket['deskripsi'] ?? '') === '') {
            $tiket['deskripsi'] = '-';
        }

        if (!isset($tiket['catatan'])) {
            $tiket['catatan'] = $tiket['admin_note'] ?? '';
        }

        return view('perpustakaan/detail', ['title' => 'Detail Tiket Perpustakaan', 'tiket' => $tiket]);
    }

    public function proses($id)
    {
        $tiket = $this->queryTiket()->where('t.id', $id)->get()->getRowArray();

        if (!$tiket) {
            return redirect()->to(base_url('perpustakaan/dashboard'))->with('error', 'Data tiket tidak ditemukan.');
        }

        $tiket['status_tampilan'] = $this->statusTampilan($tiket['status'] ?? '');
        $tiket['dokumen_hasil'] = !empty($tiket['result_file'])
            ? [[
                'nama_file' => $tiket['result_file'],
                'nama_asli' => $tiket['result_file'],
            ]]
            : [];

        if (($tiket['deskripsi'] ?? '') === '') {
            $tiket['deskripsi'] = '-';
        }

        return view('perpustakaan/proses', ['title' => 'Proses Tiket Perpustakaan', 'tiket' => $tiket]);
    }

    public function updateProses($id)
    {
        $tiket = $this->queryTiket()->where('t.id', $id)->get()->getRowArray();

        if (!$tiket) {
            return redirect()->back()->with('error', 'Data tiket tidak ditemukan.');
        }

        $status = strtolower(trim((string) $this->request->getPost('status')));
        $catatan = trim((string) $this->request->getPost('catatan'));

        $statusMap = [
            'menunggu' => 'submitted',
            'diproses' => 'processing',
            'selesai' => 'completed',
        ];

        if (!isset($statusMap[$status])) {
            return redirect()->back()->withInput()->with('error', 'Status tiket tidak valid.');
        }

        $update = [
            'status' => $statusMap[$status],
            'admin_note' => $catatan,
            'processed_at' => date('Y-m-d H:i:s'),
        ];

        if ($status === 'selesai') {
            $update['completed_at'] = date('Y-m-d H:i:s');
        }

        $this->ticketModel->update($id, $update);

        return redirect()->to(base_url('perpustakaan/detail/' . $id))->with('success', 'Status tiket Perpustakaan berhasil diperbarui.');
    }

    public function upload($id)
    {
        $ticket = $this->queryTiket()->where('t.id', $id)->get()->getRowArray();

        if (!$ticket) {
            return redirect()->to('perpustakaan/data-tiket')->with('error', 'Tiket Perpustakaan tidak ditemukan.');
        }

        return view('perpustakaan/upload', ['tiket' => $ticket, 'unit' => 'Perpustakaan']);
    }

    public function simpanUpload($id)
    {
        $ticket = $this->queryTiket()->where('t.id', $id)->get()->getRowArray();
        $file = $this->request->getFile('dokumen');

        if (!$ticket || !$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'Dokumen Perpustakaan tidak valid.');
        }

        $directory = WRITEPATH . 'uploads/perpustakaan';
        if (!is_dir($directory)) {
            mkdir($directory, 0750, true);
        }
        $name = $file->getRandomName();
        $file->move($directory, $name);
        $this->ticketModel->update($id, [
            'result_file' => $name,
            'result_note' => 'Dokumen hasil layanan diunggah.',
        ]);

        return redirect()->to('perpustakaan/detail/' . $id)->with('success', 'Dokumen hasil layanan berhasil diunggah.');
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
        $filePath = WRITEPATH . 'uploads/perpustakaan/' . $safeFileName;

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

    public function kirim($id)
    {
        $ticket = $this->queryTiket()->where('t.id', $id)->get()->getRowArray();

        if (!$ticket) {
            return redirect()->back()->with('error', 'Tiket tidak ditemukan.');
        }

        $this->ticketModel->update($id, ['status' => 'completed', 'completed_at' => date('Y-m-d H:i:s')]);
        $this->log('STATUS_CHANGED', 'Mengubah status tiket ' . $ticket['ticket_number'], (int) $id, 'completed');

        return redirect()->to('perpustakaan/detail/' . $id)->with('success', 'Tiket Perpustakaan dikirim ke pemohon.');
    }

    public function kirimKePemohon($id)
    {
        return $this->kirim($id);
    }

    private function log(string $action, string $activity, ?int $ticketId = null, ?string $status = null, ?string $note = null): void
    {
        db_connect()->table('perpustakaan_activity_logs')->insert([
            'user_id' => (int) session()->get('user_id') ?: null,
            'ticket_id' => $ticketId,
            'action' => $action,
            'activity' => $activity,
            'status' => $status,
            'note' => $note,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function riwayat()
    {
        return view('perpustakaan/riwayat', [
            'tickets' => $this->queryTiket()->orderBy('t.id', 'DESC')->get()->getResultArray(),
            'unit' => 'Perpustakaan',
        ]);
    }

    public function hapusDokumen($id)
    {
        $ticket = $this->ticketModel->find($id);

        if ($ticket && !empty($ticket['result_file'])) {
            $path = WRITEPATH . 'uploads/perpustakaan/' . $ticket['result_file'];
            if (is_file($path)) {
                unlink($path);
            }
            $this->ticketModel->update($id, [
                'result_file' => null,
                'result_note' => null,
            ]);
        }

        return redirect()->back()->with('success', 'Dokumen berhasil dihapus.');
    }
}
