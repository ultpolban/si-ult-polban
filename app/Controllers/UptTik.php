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

        $resultFile = null;
        $files = $this->request->getFileMultiple('file_hasil');
        if (!empty($files)) {
            foreach ($files as $file) {
                if ($file && $file->isValid()) {
                    if ($file->getSizeByUnit('mb') > 5 || !in_array(strtolower($file->getClientExtension()), ['pdf', 'jpg', 'jpeg', 'png'], true)) {
                        return redirect()->back()->withInput()->with('error', 'Format dokumen hasil tidak valid atau melebihi 5 MB.');
                    }

                    $uploadPath = WRITEPATH . 'uploads/upt_tik';
                    if (!is_dir($uploadPath) && !mkdir($uploadPath, 0750, true)) {
                        return redirect()->back()->withInput()->with('error', 'Folder upload UPT TIK gagal dibuat.');
                    }

                    $resultFile = $file->getRandomName();
                    $file->move($uploadPath, $resultFile);
                    break;
                }
            }
        }

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

        if ($resultFile !== null) {
            $data['result_file'] = $resultFile;
            $data['result_note'] = 'Dokumen hasil layanan diunggah.';
        }

        if (!$this->ticketModel->update($id, $data)) {
            if ($resultFile !== null) {
                @unlink(WRITEPATH . 'uploads/upt_tik/' . $resultFile);
            }

            return redirect()->back()->withInput()->with('error', 'Data tiket UPT TIK gagal diperbarui.');
        }

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

    public function kirim(int $id)
    {
        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()->to(base_url('upt-tik/data-tiket'))
                ->with('error', 'Tiket UPT TIK tidak ditemukan.');
        }

        $status = strtolower(trim((string) ($ticket['status'] ?? '')));

        if (!in_array($status, ['completed', 'complete', 'selesai'], true)) {
            return redirect()->to(base_url('upt-tik/detail/' . $id))
                ->with('error', 'Tiket harus berstatus Selesai sebelum dikirim ke Petugas ULT.');
        }

        $updated = $this->ticketModel->update($id, [
            'sent_to_ult' => 1,
            'sent_to_ult_at' => date('Y-m-d H:i:s'),
        ]);

        if (!$updated) {
            return redirect()->to(base_url('upt-tik/detail/' . $id))
                ->with('error', 'Tiket gagal dikirim ke Petugas ULT.');
        }

        $this->writeActivity(
            'TICKET_SENT_TO_ULT',
            'Mengirim tiket ' . $ticket['ticket_number'] . ' ke Petugas ULT',
            $id,
            $ticket['status'] ?? null
        );

        return redirect()->to(base_url('upt-tik/detail/' . $id))
            ->with('success', 'Tiket berhasil dikirim ke Petugas ULT.');
    }

    public function kirimKePemohon(int $id)
    {
        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()->to(base_url('upt-tik/data-tiket'))
                ->with('error', 'Tiket UPT TIK tidak ditemukan.');
        }

        $status = strtolower(trim((string) ($ticket['status'] ?? '')));

        if (!in_array($status, ['completed', 'complete', 'selesai'], true)) {
            return redirect()->to(base_url('upt-tik/detail/' . $id))
                ->with('error', 'Tiket harus berstatus Selesai sebelum dikirim ke Pemohon.');
        }

        $updated = $this->ticketModel->update($id, [
            'sent_to_applicant' => 1,
            'sent_to_applicant_at' => date('Y-m-d H:i:s'),
        ]);

        if (!$updated) {
            return redirect()->to(base_url('upt-tik/detail/' . $id))
                ->with('error', 'Hasil layanan gagal dikirim ke Pemohon.');
        }

        $this->writeActivity(
            'TICKET_SENT_TO_APPLICANT',
            'Mengirim hasil layanan tiket ' . $ticket['ticket_number'] . ' ke Pemohon',
            $id,
            $ticket['status'] ?? null
        );

        return redirect()->to(base_url('upt-tik/detail/' . $id))
            ->with('success', 'Hasil layanan berhasil dikirim ke Pemohon.');
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
