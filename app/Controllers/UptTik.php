<?php

namespace App\Controllers;

use App\Models\UptTikTicketModel;
use App\Models\UptTikActivityLogModel;

class UptTik extends BaseController
{
    private const UNIT_NAME = 'UPT Teknologi Informasi dan Komunikasi';

    private UptTikTicketModel $ticketModel;
    private UptTikActivityLogModel $activityLogModel;

    public function __construct()
    {
        $this->ticketModel = new UptTikTicketModel();
        $this->activityLogModel = new UptTikActivityLogModel();
    }

    public function index()
    {
        return $this->dashboard();
    }

    public function dashboard()
    {
        $this->writeActivity('DASHBOARD_VIEW', 'Membuka dashboard UPT TIK');
        $tickets = $this->ticketModel->findAll();

        return view('upt_tik/dashboard', $this->dashboardData($tickets));
    }

    public function dataTiket()
    {
        $this->writeActivity('TICKET_LIST_VIEW', 'Membuka data tiket UPT TIK');
        $keyword = trim((string) $this->request->getGet('keyword'));
        $query = $this->ticketModel->orderBy('id', 'DESC');

        if ($keyword !== '') {
            $query->groupStart()
                ->like('ticket_number', $keyword)
                ->orLike('applicant_name', $keyword)
                ->orLike('service_name', $keyword)
                ->orLike('status', $keyword)
                ->groupEnd();
        }

        $tickets = $query->paginate(15, 'upt_tik');

        return view('upt_tik/data_tiket', [
            'tiket' => $tickets,
            'keyword' => $keyword,
            'nama_unit' => self::UNIT_NAME,
            'pager' => $this->ticketModel->pager,
        ]);
    }

    public function detail(int $id)
    {
        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()->to(base_url('upt-tik/data-tiket'))
                ->with('error', 'Tiket UPT TIK tidak ditemukan.');
        }

        $this->writeActivity(
            'TICKET_DETAIL_VIEW',
            'Melihat detail tiket ' . $ticket['ticket_number'],
            $id,
            $ticket['status'] ?? null
        );

        return view('upt_tik/detail', [
            'tiket' => $ticket,
            'nama_unit' => self::UNIT_NAME,
        ]);
    }

    public function proses(int $id)
    {
        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()->to(base_url('upt-tik/data-tiket'))
                ->with('error', 'Tiket UPT TIK tidak ditemukan.');
        }

        $this->writeActivity(
            'TICKET_PROCESS_VIEW',
            'Membuka halaman proses tiket ' . $ticket['ticket_number'],
            $id,
            $ticket['status'] ?? null
        );

        return view('upt_tik/proses', [
            'tiket' => $ticket,
            'nama_unit' => self::UNIT_NAME,
        ]);
    }

    public function updateProses(int $id)
    {
        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()->to(base_url('upt-tik/data-tiket'))
                ->with('error', 'Tiket UPT TIK tidak ditemukan.');
        }

        $statusInput = strtolower(trim((string) $this->request->getPost('status')));
        $statusMap = [
            'menunggu' => 'submitted',
            'diproses' => 'processing',
            'selesai' => 'completed',
        ];

        if (!isset($statusMap[$statusInput])) {
            return redirect()->back()->with('error', 'Status tiket tidak valid.');
        }

        $newStatus = $statusMap[$statusInput];
        $adminNote = trim((string) $this->request->getPost('catatan'));

        $data = [
            'status' => $newStatus,
            'admin_note' => $adminNote,
            'processed_at' => $newStatus === 'processing'
                ? date('Y-m-d H:i:s')
                : ($ticket['processed_at'] ?? null),
            'completed_at' => $newStatus === 'completed'
                ? date('Y-m-d H:i:s')
                : ($ticket['completed_at'] ?? null),
        ];

        $this->ticketModel->update($id, $data);

        $this->writeActivity(
            'TICKET_PROCESSED',
            'Memproses tiket ' . $ticket['ticket_number'],
            $id,
            $newStatus
        );

        if ($newStatus !== ($ticket['status'] ?? null)) {
            $this->writeActivity(
                'STATUS_CHANGED',
                'Mengubah status tiket ' . $ticket['ticket_number'],
                $id,
                $newStatus
            );
        }

        if ($adminNote !== '') {
            $this->writeActivity(
                'NOTE_ADDED',
                'Menambahkan catatan pada tiket ' . $ticket['ticket_number'],
                $id,
                $newStatus,
                $adminNote
            );
        }

        return redirect()->to(base_url('upt-tik/detail/' . $id))
            ->with('success', 'Status tiket UPT TIK berhasil diperbarui.');
    }

    public function statistik()
    {
        return view('upt_tik/statistik', $this->dashboardData(
            $this->ticketModel->findAll()
        ));
    }

    public function profile()
    {
        $user = db_connect()->table('users')
            ->select('id, full_name, identity_number, phone_number, email, is_active')
            ->where('id', (int) session()->get('user_id'))
            ->get()
            ->getRowArray() ?: [];

        $this->writeActivity('PROFILE_VIEW', 'Membuka profil petugas');

        return view('upt_tik/profile', [
            'profile' => $user,
            'unit' => self::UNIT_NAME,
        ]);
    }

    public function updateProfile()
    {
        $userId = (int) session()->get('user_id');
        $data = [
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'identity_number' => trim((string) $this->request->getPost('identity_number')),
            'phone_number' => trim((string) $this->request->getPost('phone_number')),
        ];

        if ($data['full_name'] === '') {
            return redirect()->back()->with('error', 'Nama lengkap wajib diisi.');
        }

        db_connect()->table('users')->where('id', $userId)->update($data);
        session()->set('full_name', $data['full_name']);
        $this->writeActivity('PROFILE_UPDATED', 'Mengubah profil petugas');

        return redirect()->to(base_url('upt-tik/profile'))
            ->with('success', 'Profil berhasil diperbarui.');
    }

    public function logAktivitas()
    {
        $this->writeActivity('ACTIVITY_LOG_VIEW', 'Membuka log aktivitas UPT TIK');
        $keyword = trim((string) $this->request->getGet('keyword'));
        $query = $this->activityLogModel->withUsers();

        if ($keyword !== '') {
            $query->groupStart()
                ->like('upt_tik_activity_logs.activity', $keyword)
                ->orLike('upt_tik_activity_logs.action', $keyword)
                ->orLike('users.full_name', $keyword)
                ->orLike('upt_tik_activity_logs.status', $keyword)
                ->groupEnd();
        }

        return view('upt_tik/log_aktivitas', [
            'logs' => $query->paginate(20, 'upt_tik_logs'),
            'pager' => $this->activityLogModel->pager,
            'keyword' => $keyword,
            'unit' => self::UNIT_NAME,
        ]);
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
        $filePath = WRITEPATH . 'uploads/upt_tik/' . $safeFileName;

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

    private function writeActivity(
        string $action,
        string $activity,
        ?int $ticketId = null,
        ?string $status = null,
        ?string $note = null
    ): void {
        $this->activityLogModel->insert([
            'user_id' => (int) session()->get('user_id') ?: null,
            'ticket_id' => $ticketId,
            'action' => $action,
            'activity' => $activity,
            'status' => $status,
            'note' => $note,
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => $this->request->getUserAgent()->getAgentString(),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    private function dashboardData(array $tickets): array
    {
        $counts = [
            'submitted' => 0,
            'processing' => 0,
            'completed' => 0,
            'rejected' => 0,
        ];

        foreach ($tickets as $ticket) {
            $status = $ticket['status'] ?? 'submitted';
            if (array_key_exists($status, $counts)) {
                $counts[$status]++;
            }
        }

        return [
            'title' => 'Dashboard UPT TIK',
            'unit' => self::UNIT_NAME,
            'total' => count($tickets),
            'menunggu' => $counts['submitted'],
            'diproses' => $counts['processing'],
            'selesai' => $counts['completed'],
            'ditolak' => $counts['rejected'],
        ];
    }
}
