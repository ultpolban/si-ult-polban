<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserProfileModel;
use App\Models\ServiceRequestModel;
use App\Models\MasterServiceModel;
use App\Models\MasterServiceUnitModel;
use App\Models\MasterServiceRequirementModel;

class TendikTicketController extends BaseController
{
    protected UserModel $userModel;
    protected UserProfileModel $userProfileModel;
    protected ServiceRequestModel $serviceRequestModel;
    protected MasterServiceModel $serviceModel;
    protected MasterServiceUnitModel $serviceUnitModel;
    protected MasterServiceRequirementModel $requirementModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->userProfileModel = new UserProfileModel();
        $this->serviceRequestModel = new ServiceRequestModel();
        $this->serviceModel = new MasterServiceModel();
        $this->serviceUnitModel = new MasterServiceUnitModel();
        $this->requirementModel = new MasterServiceRequirementModel();
    }

    /**
     * =========================================================
     * CHECK ROLE / AKSES TENDIK
     * =========================================================
     */
    private function checkTendikRole()
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        $profile = $this->userProfileModel
            ->where('user_id', $userId)
            ->where('deleted_at', null)
            ->first();

        if (!$profile) {
            return redirect()
                ->to('/dashboard-tendik')
                ->with('error', 'Profil Tendik tidak ditemukan.');
        }

        $db = \Config\Database::connect();

        $applicantType = $db->table('master_applicant_types')
            ->where('id', $profile['applicant_type_id'])
            ->get()
            ->getRowArray();

        if (!$applicantType || $applicantType['code'] !== 'TENDIK') {
            return redirect()
                ->to('/dashboard-tendik')
                ->with('error', 'Akses hanya diperbolehkan untuk akun Tendik.');
        }

        $session->set('user_profile_id', $profile['id']);

        return null;
    }

    /**
     * Pastikan user sudah login dan ambil profile Tendik.
     */
    private function getTendikProfile(): ?array
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return null;
        }

        $userId = (int) $session->get('user_id');

        if ($userId <= 0) {
            $user = $session->get('user');

            if (is_array($user)) {
                $userId = (int) ($user['id'] ?? $user['user_id'] ?? 0);
            }
        }

        if ($userId <= 0) {
            return null;
        }

        $profile = $this->userProfileModel
            ->getComplete()
            ->where('user_profiles.user_id', $userId)
            ->first();

        if (!$profile) {
            return null;
        }

        // Tendik harus applicant type TENDIK
        if (($profile['applicant_type_code'] ?? '') !== 'TENDIK') {
            return null;
        }

        return $profile;
    }

    /**
     * Ambil data user Tendik.
     */
    private function getCurrentUser(): ?array
    {
        $profile = $this->getTendikProfile();

        if (!$profile) {
            return null;
        }

        return $profile;
    }

/**
 * Generate nomor tiket.
 */
private function generateTicketNumber(): string
{
    do {
        $ticketNumber = 'ULT-TENDIK-' . date('YmdHis') . '-' . random_int(100, 999);

        $exists = $this->serviceRequestModel
            ->where('ticket_number', $ticketNumber)
            ->first();
    } while ($exists);

    return $ticketNumber;
}

    /**
     * Dashboard/create ticket.
     */
    public function create()
    {
        $profile = $this->getTendikProfile();

        if (!$profile) {
            return redirect()->to('/login')
                ->with('error', 'Sesi login tidak valid.');
        }

        // Ambil unit layanan aktif
        $units = $this->serviceUnitModel
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->orderBy('name', 'ASC')
            ->findAll();

        /*
         * Data pemohon diambil otomatis dari database.
         * Nama dan NIK tidak dapat diubah dari form.
         */
        $pemohon = [
            'nama' => $profile['full_name']
                ?? $profile['name']
                ?? '-',

            'nik' => $profile['nik']
                ?? $profile['identity_number']
                ?? '-',
        ];

        return view('tendik/ticket/create', [
            'title'   => 'Ajukan Layanan',
            'user'    => $pemohon,
            'profile' => $profile,
            'units'   => $units,
        ]);
    }

    /**
     * AJAX: Jenis layanan berdasarkan unit.
     */
    public function jenisLayanan()
    {
        $profile = $this->getTendikProfile();

        if (!$profile) {
            return redirect()->to('/login')
                ->with('error', 'Sesi login tidak valid.');
        }

        $unitId = $this->request->getGet('unit_id');

        if (!$unitId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Unit layanan tidak ditemukan.',
                'data'    => [],
            ]);
        }

        $services = $this->serviceModel
            ->where('service_unit_id', $unitId)
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->orderBy('name', 'ASC')
            ->findAll();

        return $this->response->setJSON([
            'success' => true,
            'data'    => $services,
        ]);
    }

    /**
     * AJAX: Persyaratan berdasarkan jenis layanan.
     */
    public function persyaratan()
    {
        $profile = $this->getTendikProfile();

        if (!$profile) {
            return redirect()->to('/login')
                ->with('error', 'Sesi login tidak valid.');
        }

        $serviceId = $this->request->getGet('service_id');

        if (!$serviceId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Jenis layanan tidak ditemukan.',
                'data'    => [],
            ]);
        }

        $requirements = $this->requirementModel
            ->where('service_id', $serviceId)
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();

        return $this->response->setJSON([
            'success' => true,
            'data'    => $requirements,
        ]);
    }

    /**
     * Simpan ticket / pengajuan layanan.
     */
    public function store()
    {
        $profile = $this->getTendikProfile();

        if (!$profile) {
            return redirect()->to('/login')
                ->with('error', 'Sesi login tidak valid.');
        }

        $request = service('request');

        $serviceId = (int) $request->getPost('jenis_layanan');

        /*
         * Backward compatibility:
         * Kalau view lama masih mengirim service_id,
         * coba gunakan sebagai service ID.
         */
        if ($serviceId <= 0) {
            $serviceId = (int) $request->getPost('service_id');
        }

        $description = trim((string) $request->getPost('keterangan'));

        $action = $request->getPost('action');

        // Default submit
        if (!in_array($action, ['draft', 'submit'], true)) {
            $action = 'submit';
        }

        /*
         * Validasi dasar.
         * Draft boleh belum lengkap.
         */
        if ($action === 'submit') {
            if ($serviceId <= 0) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Silakan pilih layanan.');
            }
        }

        /*
         * Pastikan service benar-benar ada.
         */
        $service = null;

        if ($serviceId > 0) {
            $service = $this->serviceModel
                ->where('id', $serviceId)
                ->where('is_active', 1)
                ->first();

            if (!$service) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Layanan yang dipilih tidak ditemukan.');
            }

            /*
             * Pada submit, cek dokumen wajib sesuai persyaratan layanan.
             */
            if ($action === 'submit') {
                $requirements = $this->requirementModel
                    ->where('service_id', $serviceId)
                    ->where('is_active', 1)
                    ->orderBy('sort_order', 'ASC')
                    ->findAll();

                $files = $request->getFiles();

                $documents = $files['dokumen'] ?? [];

                foreach ($requirements as $requirement) {

                    if ((int) ($requirement['is_required'] ?? 0) !== 1) {
                        continue;
                    }

                    $file = $documents[$requirement['id']] ?? null;

                    if (
                        !$file ||
                        !$file->isValid() ||
                        $file->hasMoved()
                    ) {
                        return redirect()->back()
                            ->withInput()
                            ->with(
                                'error',
                                'Dokumen "' .
                                $requirement['name'] .
                                '" wajib diupload.'
                            );
                    }
                }
            }
        }

        $status = $action === 'draft'
            ? 'draft'
            : 'submitted';

        $now = date('Y-m-d H:i:s');

        $data = [
            'ticket_number'   => $this->generateTicketNumber(),
            'user_profile_id' => (int) $profile['id'],
            'service_id'      => $serviceId > 0 ? $serviceId : null,
            'title'           => 'Pengajuan Layanan Tendik',
            'description'     => $description,
            'status'          => $status,
            'priority'        => 'normal',
            'submitted_at'    => $status === 'submitted' ? $now : null,
            'created_at'      => $now,
            'updated_at'      => $now,
        ];

        $db = db_connect();

        $db->transStart();

        try {
            $requestId = $this->serviceRequestModel->insert($data, true);

            if (!$requestId) {
                throw new \RuntimeException('Gagal menyimpan pengajuan.');
            }

            /*
             * Upload dokumen sesuai persyaratan layanan.
             */
            if ($serviceId > 0) {
                $this->saveUploadedDocuments(
                    $requestId,
                    $serviceId
                );
            }

            /*
             * Simpan log aktivitas.
             */
            $db->table('service_request_logs')->insert([
                'service_request_id' => $requestId,
                'user_id'            => (int) $profile['user_id'],
                'old_status'         => null,
                'new_status'         => $status,
                'action'             => $action === 'draft'
                    ? 'create_draft'
                    : 'submit',
                'description'        => $action === 'draft'
                    ? 'Membuat draft pengajuan layanan.'
                    : 'Mengajukan layanan.',
                'ip_address'         => $request->getIPAddress(),
                'user_agent'         => (string) $request->getUserAgent(),
                'created_at'         => $now,
            ]);

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \RuntimeException('Transaksi gagal disimpan.');
            }

            if ($action === 'draft') {
                return redirect()
                    ->to('/tendik/ticket/draft')
                    ->with('success', 'Draft pengajuan berhasil disimpan.');
            }

            session()->setFlashdata(
                'ticket_number',
                $data['ticket_number']
            );

            return redirect()
                ->to('/tendik/ticket/success')
                ->with('success', 'Pengajuan layanan berhasil dikirim.');

        } catch (\Throwable $e) {

            if ($db->transStatus() !== false) {
                $db->transRollback();
            }

            log_message(
                'error',
                'TendikTicketController::store - ' . $e->getMessage()
            );

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Simpan draft pengajuan layanan.
     */
    public function saveDraft()
    {
        $profile = $this->getTendikProfile();

        if (!$profile) {
            return redirect()->to('/login')
                ->with('error', 'Sesi login tidak valid.');
        }

        $request = service('request');

        $serviceId = (int) $request->getPost('jenis_layanan');

        if ($serviceId <= 0) {
            $serviceId = (int) $request->getPost('service_id');
        }

        if ($serviceId <= 0) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Silakan pilih jenis layanan terlebih dahulu.');
        }

        $service = $this->serviceModel
            ->where('id', $serviceId)
            ->where('is_active', 1)
            ->first();

        if (!$service) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Jenis layanan tidak valid.');
        }

        $now = date('Y-m-d H:i:s');

        $data = [
            'ticket_number'   => $this->generateTicketNumber(),
            'user_profile_id' => (int) $profile['id'],
            'service_id'      => $serviceId,
            'title'           => 'Pengajuan Layanan Tendik',
            'description'     => trim((string) $request->getPost('keterangan')),
            'status'          => 'draft',
            'priority'        => 'normal',
            'submitted_at'    => null,
            'created_at'      => $now,
            'updated_at'      => $now,
        ];

        $db = db_connect();

        $db->transStart();

        try {
            $requestId = $this->serviceRequestModel->insert($data, true);

            if (!$requestId) {
                throw new \RuntimeException('Gagal menyimpan draft.');
            }

            /*
             * Upload dokumen sesuai persyaratan layanan.
             */
            $this->saveUploadedDocuments(
                $requestId,
                $serviceId
            );

            /*
             * Simpan log aktivitas.
             */
            $db->table('service_request_logs')->insert([
                'service_request_id' => $requestId,
                'user_id'            => (int) $profile['user_id'],
                'old_status'         => null,
                'new_status'         => 'draft',
                'action'             => 'create_draft',
                'description'        => 'Membuat draft pengajuan layanan.',
                'ip_address'         => $request->getIPAddress(),
                'user_agent'         => (string) $request->getUserAgent(),
                'created_at'         => $now,
            ]);

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \RuntimeException('Transaksi gagal disimpan.');
            }

        } catch (\Throwable $e) {

            if ($db->transStatus() !== false) {
                $db->transRollback();
            }

            log_message(
                'error',
                'TendikTicketController::saveDraft - ' . $e->getMessage()
            );

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }

        return redirect()
            ->to('/tendik/ticket/draft')
            ->with('success', 'Pengajuan berhasil disimpan sebagai draft.');
    }

    /**
     * =========================================================
     * SIMPAN FILE / DOKUMEN PERSYARATAN
     * =========================================================
     */
    private function saveUploadedDocuments(
        $serviceRequestId,
        $serviceId
    ) {
        $db = db_connect();

        $files = $this->request->getFiles();

        $documents = $files['dokumen'] ?? [];

        if (empty($documents)) {
            return;
        }

        $requirements = $this->requirementModel
            ->where('service_id', $serviceId)
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();

        $requirementMap = [];

        foreach ($requirements as $requirement) {
            $requirementMap[$requirement['id']] = $requirement;
        }

        $now = date('Y-m-d H:i:s');

        foreach ($documents as $requirementId => $file) {

            if (!isset($requirementMap[$requirementId])) {
                continue;
            }

            if (
                !$file ||
                !$file->isValid() ||
                $file->hasMoved()
            ) {
                continue;
            }

            $requirement = $requirementMap[$requirementId];

            // =================================================
            // UKURAN
            // =================================================

            $maxSize = ((int) ($requirement['max_file_size'] ?? 2048)) * 1024;

            if ($file->getSize() > $maxSize) {
                continue;
            }

            // =================================================
            // EXTENSION
            // =================================================

            $extension = strtolower($file->getClientExtension());

            $allowed = $requirement['allowed_extensions']
                ?? 'pdf,jpg,jpeg,png,doc,docx,xls,xlsx';

            $allowedExtensions = array_map(
                'trim',
                explode(',', strtolower($allowed))
            );

            if (!in_array($extension, $allowedExtensions)) {
                continue;
            }

            // =================================================
            // FOLDER
            // =================================================

            $uploadPath = FCPATH .
                'uploads/service_requests/' .
                $serviceRequestId .
                '/';

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            // =================================================
            // FILE NAME
            // =================================================

            $newName = $file->getRandomName();

            $file->move($uploadPath, $newName);

            // =================================================
            // DATABASE
            // =================================================

            $db->table('service_request_files')->insert([
                'service_request_id' => $serviceRequestId,
                'requirement_id'     => $requirementId,
                'original_name'      => $file->getClientName(),
                'file_name'          => $newName,
                'file_path'          => 'uploads/service_requests/' .
                    $serviceRequestId .
                    '/' .
                    $newName,
                'file_extension'     => $extension,
                'mime_type'          => $file->getClientMimeType(),
                'file_size'          => $file->getSize(),
                'is_verified'        => 0,
                'created_at'         => $now,
                'updated_at'         => $now,
            ]);
        }
    }

    /**
     * Halaman sukses.
     */
    public function success()
    {
        $profile = $this->getTendikProfile();

        if (!$profile) {
            return redirect()->to('/login');
        }

        $ticketNumber = session()->getFlashdata('ticket_number');

        if (!$ticketNumber) {
            return redirect()->to('/tendik/ticket/history');
        }

        $ticket = $this->serviceRequestModel
            ->select('
                service_requests.*,
                master_services.name AS service_name,
                master_services.code AS service_code
            ')
            ->join(
                'master_services',
                'master_services.id = service_requests.service_id',
                'left'
            )
            ->where('service_requests.ticket_number', $ticketNumber)
            ->where('service_requests.user_profile_id', $profile['id'])
            ->first();

        if (!$ticket) {
            return redirect()->to('/tendik/ticket/history');
        }

        return view('tendik/ticket/success', [
            'title'  => 'Pengajuan Berhasil Dikirim',
            'user'   => $profile,
            'ticket' => $ticket,
        ]);
    }

  /**
 * =========================================================
 * HISTORY / TRACKING TIKET TENDIK
 * =========================================================
 */
public function history()
{
    $check = $this->checkTendikRole();

    if ($check) {
        return $check;
    }

    $db = \Config\Database::connect();

    $userId = session()->get('user_id');

    if (empty($userId)) {
        return redirect()
            ->to(base_url('login'))
            ->with(
                'error',
                'Silakan login terlebih dahulu.'
            );
    }

    // =====================================================
    // PROFILE
    // =====================================================

    $userProfile = $db->table('user_profiles')
        ->where('user_id', $userId)
        ->where('deleted_at', null)
        ->get()
        ->getRowArray();

    if (!$userProfile) {
        return redirect()
            ->to(base_url('dashboard-tendik'))
            ->with(
                'error',
                'Data profil tendik tidak ditemukan.'
            );
    }

    // =====================================================
    // TICKETS
    // =====================================================

    $tickets = $db->table('service_requests sr')
        ->select('
            sr.id,
            sr.ticket_number,
            sr.description,
            sr.status,
            sr.created_at,
            sr.submitted_at,

            ms.name AS service_name,
            ms.service_unit_id,

            msu.name AS unit_name
        ')
        ->join(
            'master_services ms',
            'ms.id = sr.service_id',
            'left'
        )
        ->join(
            'master_service_units msu',
            'msu.id = ms.service_unit_id',
            'left'
        )
        ->where(
            'sr.user_profile_id',
            $userProfile['id']
        )
        ->where(
            'sr.status !=',
            'draft'
        )
        ->orderBy(
            'sr.created_at',
            'DESC'
        )
        ->get()
        ->getResultArray();

    // =====================================================
    // FORMAT
    // =====================================================

    $formattedTickets = [];

    foreach ($tickets as $ticket) {

        $status = strtolower(
            $ticket['status'] ?? ''
        );

        switch ($status) {

            case 'submitted':
                $statusLabel = 'Submitted';
                break;

            case 'processed':
            case 'diproses':
            case 'in_progress':
                $statusLabel = 'Diproses';
                break;

            case 'completed':
            case 'selesai':
                $statusLabel = 'Selesai';
                break;

            case 'rejected':
            case 'ditolak':
                $statusLabel = 'Ditolak';
                break;

            default:
                $statusLabel = ucfirst(
                    $ticket['status'] ?? '-'
                );
                break;
        }

        $createdAt =
            $ticket['submitted_at']
            ??
            $ticket['created_at']
            ??
            null;

        $formattedDate = '-';

        if ($createdAt) {

            $formattedDate = date(
                'd F Y H:i',
                strtotime($createdAt)
            );
        }

        $formattedTickets[] = [

            'id' =>
                $ticket['id'],

            'nomor' =>
                $ticket['ticket_number']
                ?? '-',

            'unit_layanan' =>
                $ticket['unit_name']
                ?? '-',

            'layanan' =>
                $ticket['service_name']
                ?? '-',

            'keterangan' =>
                $ticket['description']
                ?? '-',

            'dokumen' =>
                null,

            'status' =>
                $statusLabel,

            'created_at' =>
                $formattedDate,
        ];
    }

    return view(
        'tendik/ticket/history',
        [
            'title' =>
                'Tracking Tiket',

            'tickets' =>
                $formattedTickets
        ]
    );
}
/**
 * =========================================================
 * DRAFT
 * =========================================================
 */
public function draft()
{
    $profile = $this->getTendikProfile();

    if (!$profile) {
        return redirect()
            ->to('/login')
            ->with('error', 'Sesi login tidak valid.');
    }

    $db = \Config\Database::connect();

    $builder = $db->table('service_requests sr');

    $builder->select([
        'sr.id',
        'sr.ticket_number',
        'sr.user_profile_id',
        'sr.service_id',
        'sr.title',
        'sr.description',
        'sr.status',
        'sr.created_at',
        'sr.updated_at',

        'ms.name AS service_name',
        'ms.service_unit_id',

        'msu.name AS unit_name'
    ]);

    $builder->join(
        'master_services ms',
        'ms.id = sr.service_id',
        'left'
    );

    $builder->join(
        'master_service_units msu',
        'msu.id = ms.service_unit_id',
        'left'
    );

$builder->where('sr.status', 'draft');
$builder->where('sr.user_profile_id', $profile['id']);

    $builder->orderBy(
        'sr.created_at',
        'DESC'
    );

    $drafts = $builder
        ->get()
        ->getResultArray();

    // =====================================================
    // CEK DOKUMEN
    // =====================================================

    foreach ($drafts as &$draft) {

        $requirements = $db->table(
            'master_service_requirements'
        )
        ->where(
            'service_id',
            $draft['service_id']
        )
        ->where(
            'is_active',
            1
        )
        ->where(
            'is_required',
            1
        )
        ->get()
        ->getResultArray();

        $totalRequired = count($requirements);

        // Tidak ada dokumen wajib
        if ($totalRequired === 0) {

            $draft['document_complete'] = true;

            continue;
        }

        // =================================================
        // DOKUMEN YANG SUDAH DIUPLOAD
        // =================================================

        $uploaded = $db->table(
            'service_request_files srf'
        )
        ->join(
            'master_service_requirements msr',
            'msr.id = srf.requirement_id',
            'inner'
        )
        ->where(
            'srf.service_request_id',
            $draft['id']
        )
        ->where(
            'msr.service_id',
            $draft['service_id']
        )
        ->where(
            'msr.is_active',
            1
        )
        ->where(
            'msr.is_required',
            1
        )
        ->where(
            'srf.deleted_at',
            null
        )
        ->get()
        ->getResultArray();

        $uploadedRequirementIds = [];

        foreach ($uploaded as $file) {

            $uploadedRequirementIds[
                $file['requirement_id']
            ] = true;
        }

        // =================================================
        // CEK SEMUA REQUIREMENT
        // =================================================

        $complete = true;

        foreach ($requirements as $requirement) {

            if (
                !isset(
                    $uploadedRequirementIds[
                        $requirement['id']
                    ]
                )
            ) {

                $complete = false;

                break;
            }
        }

        $draft['document_complete'] = $complete;
    }

    unset($draft);

    // =====================================================
    // VIEW
    // =====================================================

    return view(
        'tendik/ticket/draft',
        [
            'title'   => 'Draft Pengajuan',
            'user'    => $profile,
            'profile' => $profile,
            'drafts'  => $drafts
        ]
    );
}

   public function editDraft($id)
{
    $check = $this->checkTendikRole();

    if ($check) {
        return $check;
    }

    $profile = $this->getTendikProfile();

    if (!$profile) {
        return redirect()
            ->to('/login')
            ->with('error', 'Sesi login tidak valid.');
    }

    $db = \Config\Database::connect();

    /*
     * Ambil draft berdasarkan:
     * - ID draft
     * - user_profile_id milik Tendik yang login
     * - status draft
     */
    $builder = $db->table('service_requests sr');

    $builder->select([
        'sr.id',
        'sr.ticket_number',
        'sr.user_profile_id',
        'sr.service_id',
        'sr.title',
        'sr.description',
        'sr.status',
        'sr.priority',
        'sr.submitted_at',
        'sr.created_at',
        'sr.updated_at',
        'ms.name AS service_name',
        'ms.code AS service_code',
        'ms.service_unit_id',
        'msu.name AS unit_name',
    ]);

    $builder->join(
        'master_services ms',
        'ms.id = sr.service_id',
        'left'
    );

    $builder->join(
        'master_service_units msu',
        'msu.id = ms.service_unit_id',
        'left'
    );

    $builder->where('sr.id', (int) $id);
    $builder->where(
        'sr.user_profile_id',
        (int) $profile['id']
    );
    $builder->where('sr.status', 'draft');

    $draft = $builder->get()->getRowArray();

    if (!$draft) {
        return redirect()
            ->to('/tendik/ticket/draft')
            ->with(
                'error',
                'Draft tidak ditemukan atau sudah tidak dapat diedit.'
            );
    }

    /*
     * Ambil semua unit layanan aktif
     */
    $units = $db->table('master_service_units')
        ->where('is_active', 1)
        ->where('deleted_at', null)
        ->orderBy('sort_order', 'ASC')
        ->orderBy('name', 'ASC')
        ->get()
        ->getResultArray();

    /*
     * Ambil semua layanan aktif
     */
    $services = $db->table('master_services')
        ->where('is_active', 1)
        ->where('deleted_at', null)
        ->orderBy('sort_order', 'ASC')
        ->orderBy('name', 'ASC')
        ->get()
        ->getResultArray();

    /*
     * Ambil requirement layanan dari draft
     */
    $requirements = [];

    if (!empty($draft['service_id'])) {

        $requirements = $this->requirementModel
            ->where(
                'service_id',
                (int) $draft['service_id']
            )
            ->where('is_active', 1)
            ->where('deleted_at', null)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
    }

    /*
     * Ambil file yang sudah diupload
     */
    $uploadedFiles = [];

    $files = $db->table('service_request_files srf')
        ->select([
            'srf.id',
            'srf.service_request_id',
            'srf.requirement_id',
            'srf.original_name',
            'srf.file_path',
            'srf.file_size',
            'srf.mime_type',
            'srf.is_verified',
            'msr.name AS requirement_name',
        ])
        ->join(
            'master_service_requirements msr',
            'msr.id = srf.requirement_id',
            'left'
        )
        ->where(
            'srf.service_request_id',
            (int) $draft['id']
        )
        ->where('srf.deleted_at', null)
        ->orderBy('msr.sort_order', 'ASC')
        ->get()
        ->getResultArray();

    foreach ($files as $file) {
        $uploadedFiles[
            (int) $file['requirement_id']
        ] = $file;
    }

    return view('tendik/ticket/edit_draft', [
        'title'         => 'Lanjutkan Draft',
        'user'          => $profile,
        'profile'       => $profile,
        'draft'         => $draft,
        'units'         => $units,
        'services'      => $services,
        'requirements'  => $requirements,
        'uploadedFiles' => $uploadedFiles,
    ]);
}

   public function updateDraft($id)
{
    $check = $this->checkTendikRole();

    if ($check) {
        return $check;
    }

    $profile = $this->getTendikProfile();

    if (!$profile) {
        return redirect()
            ->to('/login')
            ->with('error', 'Sesi login tidak valid.');
    }

    $db = \Config\Database::connect();
    $request = service('request');

    /*
     * Ambil draft milik Tendik yang sedang login.
     */
    $draft = $this->serviceRequestModel
        ->where('id', (int) $id)
        ->where(
            'user_profile_id',
            (int) $profile['id']
        )
        ->where('status', 'draft')
        ->first();

    if (!$draft) {
        return redirect()
            ->to('/tendik/ticket/draft')
            ->with(
                'error',
                'Draft tidak ditemukan atau sudah tidak dapat diedit.'
            );
    }


    /*
     * Ambil input form.
     *
     * View edit_draft menggunakan:
     * - unit_id
     * - jenis_layanan
     * - description
     * - dokumen[requirement_id]
     */
    $unitId = (int) $request->getPost('unit_id');

    $serviceId = (int) $request->getPost('jenis_layanan');

    if ($serviceId <= 0) {
        $serviceId = (int) $request->getPost('service_id');
    }

    $description = trim(
        (string) $request->getPost('description')
    );

    $action = $request->getPost('action');

    if (!in_array(
        $action,
        ['draft', 'submit'],
        true
    )) {
        $action = 'draft';
    }


    /*
     * Validasi layanan.
     */
    if ($serviceId <= 0) {

        if ($action === 'submit') {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Silakan pilih layanan.'
                );
        }

    }


    /*
     * Ambil layanan aktif.
     */
    $service = null;

    if ($serviceId > 0) {

        $service = $this->serviceModel
            ->where('id', $serviceId)
            ->where('is_active', 1)
            ->where('deleted_at', null)
            ->first();

        if (!$service) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Layanan yang dipilih tidak ditemukan.'
                );
        }
    }


    /*
     * Pastikan unit yang dikirim
     * sesuai dengan unit layanan.
     */
    if (
        $service &&
        $unitId > 0 &&
        (int) $service['service_unit_id'] !== $unitId
    ) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Unit layanan tidak sesuai dengan jenis layanan.'
            );
    }


    /*
     * Validasi submit.
     */
    if ($action === 'submit') {

        if ($description === '') {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Keterangan wajib diisi.'
                );
        }
    }


    /*
     * Cek apakah layanan berubah.
     */
    $oldServiceId = (int) (
        $draft['service_id'] ?? 0
    );

    $serviceChanged =
        $oldServiceId !== $serviceId;


    $now = date('Y-m-d H:i:s');

    $newStatus =
        $action === 'submit'
            ? 'submitted'
            : 'draft';


    $db->transStart();

    try {

        /*
         * Jika layanan berubah,
         * hapus dokumen lama.
         */
        if ($serviceChanged) {

            $oldFiles = $db->table(
                'service_request_files'
            )
                ->where(
                    'service_request_id',
                    (int) $id
                )
                ->where(
                    'deleted_at',
                    null
                )
                ->get()
                ->getResultArray();


            foreach ($oldFiles as $oldFile) {

                $oldPath =
                    FCPATH .
                    ltrim(
                        $oldFile['file_path'],
                        '/'
                    );

                if (
                    !empty($oldFile['file_path']) &&
                    is_file($oldPath)
                ) {

                    @unlink($oldPath);

                }
            }


            /*
             * Soft delete file lama.
             */
            $db->table(
                'service_request_files'
            )
                ->where(
                    'service_request_id',
                    (int) $id
                )
                ->update([
                    'deleted_at' => $now,
                ]);
        }


        /*
         * Update service request.
         */
        $updateData = [
            'service_id'  =>
                $serviceId > 0
                    ? $serviceId
                    : null,

            'description' =>
                $description,

            'title' =>
                'Pengajuan Layanan Tendik',

            'status' =>
                $newStatus,

            'updated_at' =>
                $now,
        ];


        /*
         * submitted_at hanya diisi ketika
         * draft benar-benar diajukan.
         */
        if ($newStatus === 'submitted') {

            $updateData['submitted_at'] =
                $now;

        } else {

            $updateData['submitted_at'] =
                null;

        }


        $updated = $this->serviceRequestModel
            ->update(
                (int) $id,
                $updateData
            );


        if (!$updated) {

            throw new \RuntimeException(
                'Gagal memperbarui draft.'
            );
        }


        /*
         * =========================
         * UPLOAD DOKUMEN
         * =========================
         *
         * Format:
         * dokumen[requirement_id]
         */
        $documents =
            $request->getFiles()['dokumen']
            ?? [];


        /*
         * Ambil requirement layanan baru.
         */
        $requirements = [];

        if ($serviceId > 0) {

            $requirements =
                $this->requirementModel
                    ->where(
                        'service_id',
                        $serviceId
                    )
                    ->where(
                        'is_active',
                        1
                    )
                    ->where(
                        'deleted_at',
                        null
                    )
                    ->orderBy(
                        'sort_order',
                        'ASC'
                    )
                    ->findAll();
        }


        /*
         * Upload setiap dokumen berdasarkan
         * requirement ID.
         */
     foreach ($documents as $requirementId => $file) {

    if (
        !$file ||
        !$file->isValid() ||
        $file->hasMoved()
    ) {
        continue;
    }


    /*
     * Requirement ID
     */
    $requirementId = (int) $requirementId;


    /*
     * Pastikan requirement memang
     * milik service yang dipilih.
     */
    $requirement = null;

    foreach ($requirements as $item) {

        if (
            (int) $item['id']
            === $requirementId
        ) {

            $requirement = $item;

            break;
        }
    }


    if (!$requirement) {
        continue;
    }


    /*
     * =========================
     * AMBIL METADATA SEBELUM MOVE
     * =========================
     */

    $originalName =
        $file->getClientName();

    $fileSize =
        $file->getSize();

    $mimeType =
        $file->getMimeType();

    $extension =
        strtolower(
            $file->getClientExtension()
        );


    /*
     * =========================
     * VALIDASI UKURAN
     * =========================
     */

    $maxSizeKb =
        (int) (
            $requirement['max_file_size']
            ?? 2048
        );

    $maxSizeBytes =
        $maxSizeKb * 1024;


    if ($fileSize > $maxSizeBytes) {

        throw new \RuntimeException(
            'Ukuran dokumen "' .
            $requirement['name'] .
            '" melebihi batas maksimal ' .
            $maxSizeKb .
            ' KB.'
        );
    }


    /*
     * =========================
     * VALIDASI EXTENSION
     * =========================
     */

    $allowedExtensions = [
        'pdf',
        'doc',
        'docx',
        'jpg',
        'jpeg',
        'png',
        'xls',
        'xlsx',
    ];


    if (
        !empty(
            $requirement['allowed_extensions']
        )
    ) {

        $allowedExtensions =
            array_map(
                'trim',
                explode(
                    ',',
                    strtolower(
                        $requirement[
                            'allowed_extensions'
                        ]
                    )
                )
            );
    }


    if (
        !in_array(
            $extension,
            $allowedExtensions,
            true
        )
    ) {

        throw new \RuntimeException(
            'Format dokumen "' .
            $requirement['name'] .
            '" tidak diperbolehkan.'
        );
    }


    /*
     * =========================
     * HAPUS FILE LAMA
     * =========================
     */

    $oldFile =
        $db->table(
            'service_request_files'
        )
        ->where(
            'service_request_id',
            (int) $id
        )
        ->where(
            'requirement_id',
            $requirementId
        )
        ->where(
            'deleted_at',
            null
        )
        ->get()
        ->getRowArray();


    if ($oldFile) {

        $oldPath =
            FCPATH .
            ltrim(
                $oldFile['file_path'],
                '/'
            );


        if (
            !empty(
                $oldFile['file_path']
            ) &&
            is_file($oldPath)
        ) {

            @unlink($oldPath);
        }


        $db->table(
            'service_request_files'
        )
        ->where(
            'id',
            (int) $oldFile['id']
        )
        ->update([
            'deleted_at' => $now,
        ]);
    }


    /*
     * =========================
     * FOLDER UPLOAD
     * =========================
     */

    $uploadPath =
        FCPATH .
        'uploads/service_requests/' .
        (int) $id;


    if (!is_dir($uploadPath)) {

        mkdir(
            $uploadPath,
            0775,
            true
        );
    }


    /*
     * =========================
     * NAMA FILE BARU
     * =========================
     */

    $newName =
        $file->getRandomName();


    /*
     * =========================
     * MOVE FILE
     * =========================
     *
     * Setelah titik ini JANGAN lagi
     * memanggil getMimeType(),
     * getSize(), dll dari $file.
     */

    $file->move(
        $uploadPath,
        $newName
    );


    /*
     * Path relatif yang disimpan
     * ke database.
     */

    $relativePath =
        'uploads/service_requests/' .
        (int) $id .
        '/' .
        $newName;


    /*
     * =========================
     * SIMPAN DATA FILE
     * =========================
     */

    $db->table(
        'service_request_files'
    )->insert([

        'service_request_id' =>
            (int) $id,

        'requirement_id' =>
            $requirementId,

        'original_name' =>
            $originalName,

        'file_name' =>
            $newName,

        'file_path' =>
            $relativePath,

        'file_extension' =>
            $extension,

        'mime_type' =>
            $mimeType,

        'file_size' =>
            $fileSize,

        'is_verified' =>
            0,

        'created_at' =>
            $now,

    ]);
}


        /*
         * =========================
         * VALIDASI DOKUMEN SUBMIT
         * =========================
         */
        if ($action === 'submit') {

            foreach (
                $requirements
                as $requirement
            ) {

                if (
                    (int)$requirement[
                        'is_required'
                    ] !== 1
                ) {
                    continue;
                }


                $uploaded =
                    $db->table(
                        'service_request_files'
                    )
                        ->where(
                            'service_request_id',
                            (int)$id
                        )
                        ->where(
                            'requirement_id',
                            (int)$requirement['id']
                        )
                        ->where(
                            'deleted_at',
                            null
                        )
                        ->countAllResults();


                if ($uploaded <= 0) {

                    throw new \RuntimeException(
                        'Dokumen "' .
                        $requirement['name'] .
                        '" wajib diupload.'
                    );
                }
            }
        }


        /*
         * =========================
         * LOG
         * =========================
         */
        $db->table(
            'service_request_logs'
        )->insert([
            'service_request_id' =>
                (int)$id,

            'user_id' =>
                (int)$profile['user_id'],

            'old_status' =>
                'draft',

            'new_status' =>
                $newStatus,

            'action' =>
                $action === 'submit'
                    ? 'submit'
                    : 'update_draft',

            'description' =>
                $action === 'submit'
                    ? 'Draft diajukan menjadi pengajuan layanan.'
                    : 'Draft pengajuan diperbarui.',

            'ip_address' =>
                $request->getIPAddress(),

            'user_agent' =>
                (string)$request->getUserAgent(),

            'created_at' =>
                $now,
        ]);


        $db->transComplete();


        if (
            $db->transStatus() === false
        ) {

            throw new \RuntimeException(
                'Gagal menyimpan perubahan draft.'
            );
        }


        /*
         * =========================
         * HASIL
         * =========================
         */
        if ($newStatus === 'draft') {

            return redirect()
                ->to('/tendik/ticket/draft')
                ->with(
                    'success',
                    'Draft berhasil diperbarui.'
                );
        }


        /*
         * Simpan nomor tiket
         * untuk halaman success.
         */
        session()->setFlashdata(
            'ticket_number',
            $draft['ticket_number']
        );


        return redirect()
            ->to('/tendik/ticket/success')
            ->with(
                'success',
                'Pengajuan berhasil dikirim.'
            );


    } catch (\Throwable $e) {

        /*
         * Rollback jika transaksi masih aktif.
         */
        if ($db->transStatus() !== false) {

            $db->transRollback();

        }


        log_message(
            'error',
            'TendikTicketController::updateDraft - ' .
            $e->getMessage()
        );


        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                $e->getMessage()
            );
    }
}

public function deleteDraft($id)
{
    $check = $this->checkTendikRole();

    if ($check) {
        return $check;
    }

    $profile = $this->getTendikProfile();

    if (!$profile) {
        return redirect()
            ->to('/login')
            ->with('error', 'Sesi login tidak valid.');
    }

    $id = (int) $id;

    if ($id <= 0) {
        return redirect()
            ->to('/tendik/ticket/draft')
            ->with('error', 'ID draft tidak valid.');
    }

    $db = db_connect();

    /*
     * Cari draft milik user yang sedang login.
     */
    $draft = $db->table('service_requests')
        ->where('id', $id)
        ->where(
            'user_profile_id',
            (int) $profile['id']
        )
        ->where('status', 'draft')
        ->get()
        ->getRowArray();

    if (!$draft) {
        return redirect()
            ->to('/tendik/ticket/draft')
            ->with(
                'error',
                'Draft tidak ditemukan atau sudah tidak dapat dihapus.'
            );
    }

    $db->transStart();

    try {

        /*
         * =====================================
         * 1. AMBIL FILE
         * =====================================
         */
        $files = $db->table('service_request_files')
            ->where(
                'service_request_id',
                $id
            )
            ->get()
            ->getResultArray();


        /*
         * =====================================
         * 2. HAPUS FILE FISIK
         * =====================================
         */
        foreach ($files as $file) {

            if (empty($file['file_path'])) {
                continue;
            }

            $filePath =
                FCPATH .
                ltrim(
                    $file['file_path'],
                    '/'
                );

            if (is_file($filePath)) {
                @unlink($filePath);
            }
        }


        /*
         * =====================================
         * 3. HAPUS DATA FILE DARI DATABASE
         * =====================================
         */
        $db->table('service_request_files')
            ->where(
                'service_request_id',
                $id
            )
            ->delete();


        /*
         * =====================================
         * 4. HAPUS LOG DARI DATABASE
         * =====================================
         *
         * Wajib dilakukan sebelum menghapus
         * service_requests karena log memiliki
         * relasi ke service_request_id.
         */
        $db->table('service_request_logs')
            ->where(
                'service_request_id',
                $id
            )
            ->delete();


        /*
         * =====================================
         * 5. HAPUS SERVICE REQUEST
         * =====================================
         */
        $deleted = $db->table('service_requests')
            ->where('id', $id)
            ->where(
                'user_profile_id',
                (int) $profile['id']
            )
            ->where('status', 'draft')
            ->delete();


        if (!$deleted) {
            throw new \RuntimeException(
                'Gagal menghapus draft dari database.'
            );
        }


        /*
         * =====================================
         * SELESAI TRANSAKSI
         * =====================================
         */
        $db->transComplete();


        if ($db->transStatus() === false) {
            throw new \RuntimeException(
                'Transaksi penghapusan draft gagal.'
            );
        }


        return redirect()
            ->to('/tendik/ticket/draft')
            ->with(
                'success',
                'Draft berhasil dihapus.'
            );

    } catch (\Throwable $e) {

        log_message(
            'error',
            'TendikTicketController::deleteDraft - ' .
            $e->getMessage()
        );

        return redirect()
            ->to('/tendik/ticket/draft')
            ->with(
                'error',
                'Gagal menghapus draft: ' .
                $e->getMessage()
            );
    }
}

    /**
 * =========================================================
 * DETAIL TIKET TENDIK
 * =========================================================
 */
public function detail($id)
{
    $check = $this->checkTendikRole();

    if ($check) {
        return $check;
    }

    $db = \Config\Database::connect();

    $userProfileId =
        session()->get('user_profile_id');

    if (empty($userProfileId)) {

        return redirect()
            ->to(
                base_url(
                    'tendik/ticket/history'
                )
            )
            ->with(
                'error',
                'Data profil tendik tidak ditemukan.'
            );
    }

    // =====================================================
    // TIKET
    // =====================================================

    $ticket = $db->table(
        'service_requests sr'
    )
        ->select('
            sr.id,
            sr.ticket_number,
            sr.user_profile_id,
            sr.service_id,
            sr.title,
            sr.description,
            sr.status,
            sr.priority,
            sr.submitted_at,
            sr.created_at,
            sr.updated_at,

            ms.name AS service_name,
            ms.service_unit_id,

            msu.name AS unit_name
        ')
        ->join(
            'master_services ms',
            'ms.id = sr.service_id',
            'left'
        )
        ->join(
            'master_service_units msu',
            'msu.id = ms.service_unit_id',
            'left'
        )
        ->where(
            'sr.id',
            $id
        )
        ->where(
            'sr.user_profile_id',
            $userProfileId
        )
        ->where(
            'sr.status !=',
            'draft'
        )
        ->get()
        ->getRowArray();

    if (!$ticket) {

        return redirect()
            ->to(
                base_url(
                    'tendik/ticket/history'
                )
            )
            ->with(
                'error',
                'Tiket tidak ditemukan atau bukan milik Anda.'
            );
    }

    // =====================================================
    // DOKUMEN
    // =====================================================

    $files = $db->table(
        'service_request_files srf'
    )
        ->select('
            srf.id,
            srf.requirement_id,
            srf.original_name,
            srf.file_name,
            srf.file_path,
            srf.file_extension,
            srf.mime_type,
            srf.file_size,
            srf.is_verified,

            msr.name AS requirement_name
        ')
        ->join(
            'master_service_requirements msr',
            'msr.id = srf.requirement_id',
            'left'
        )
        ->where(
            'srf.service_request_id',
            $id
        )
        ->where(
            'srf.deleted_at',
            null
        )
        ->orderBy(
            'msr.sort_order',
            'ASC'
        )
        ->get()
        ->getResultArray();

    // =====================================================
    // STATUS LABEL
    // =====================================================

    $status = strtolower(
        trim(
            $ticket['status'] ?? ''
        )
    );

    switch ($status) {

        case 'submitted':
            $statusLabel = 'Submitted';
            break;

        case 'processed':
        case 'diproses':
        case 'in_progress':
            $statusLabel = 'Diproses';
            break;

        case 'completed':
        case 'selesai':
            $statusLabel = 'Selesai';
            break;

        case 'rejected':
        case 'ditolak':
            $statusLabel = 'Ditolak';
            break;

        default:
            $statusLabel = ucfirst(
                $ticket['status'] ?? '-'
            );
            break;
    }

    $ticket['status_label'] =
        $statusLabel;

    // =====================================================
    // VIEW
    // =====================================================

    return view(
        'tendik/ticket/detail',
        [
            'title' =>
                'Detail Tiket',

            'ticket' =>
                $ticket,

            'files' =>
                $files
        ]
    );
}

    /**
     * Reply / balasan.
     *
     * Karena tidak ada tabel replies khusus,
     * balasan disimpan sebagai service_request_logs.
     */
    public function reply($ticket)
    {
        $profile = $this->getTendikProfile();

        if (!$profile) {
            return redirect()->to('/login');
        }

        $request = service('request');

        $message = trim((string) $request->getPost('reply'));

        if ($message === '') {
            $message = trim((string) $request->getPost('message'));
        }

        if ($message === '') {
            return redirect()->back()
                ->with('error', 'Balasan tidak boleh kosong.');
        }

        $builder = $this->serviceRequestModel
            ->where(
                'user_profile_id',
                $profile['id']
            );

        if (is_numeric($ticket)) {
            $builder->where('id', (int) $ticket);
        } else {
            $builder->where('ticket_number', $ticket);
        }

        $ticketData = $builder->first();

        if (!$ticketData) {
            return redirect()
                ->to('/tendik/ticket/history')
                ->with('error', 'Ticket tidak ditemukan.');
        }

        $now = date('Y-m-d H:i:s');

        db_connect()
            ->table('service_request_logs')
            ->insert([
                'service_request_id' => $ticketData['id'],
                'user_id'            => (int) $profile['user_id'],
                'old_status'         => $ticketData['status'],
                'new_status'         => $ticketData['status'],
                'action'             => 'reply',
                'description'        => $message,
                'ip_address'         => $request->getIPAddress(),
                'user_agent'         => (string) $request->getUserAgent(),
                'created_at'         => $now,
            ]);

        return redirect()
            ->back()
            ->with('success', 'Balasan berhasil dikirim.');
    }
}