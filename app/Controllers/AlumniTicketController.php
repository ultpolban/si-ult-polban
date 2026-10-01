<?php

namespace App\Controllers;

use App\Models\ServiceRequestModel;
use App\Models\UserProfileModel;
use App\Models\MasterServiceUnitModel;
use App\Models\MasterServiceModel;
use App\Models\MasterServiceRequirementModel;

class AlumniTicketController extends BaseController
{
    // =====================================================
    // CREATE
    // =====================================================
    public function create()
    {
        $unitModel = new MasterServiceUnitModel();

        // =====================================================
        // AMBIL USER LOGIN DARI SESSION
        // =====================================================

        $user = session()->get('user') ?? [];

        $userId = (int) (
            session()->get('user_id')
            ?? ($user['id'] ?? 0)
        );

        // =====================================================
        // CEK USER LOGIN
        // =====================================================

        if ($userId <= 0) {
            return redirect()
                ->to(base_url('login'))
                ->with(
                    'error',
                    'Sesi login tidak ditemukan. Silakan login kembali.'
                );
        }

        // =====================================================
        // AMBIL PROFILE ALUMNI DARI DATABASE
        // =====================================================

        $profileModel = new UserProfileModel();

        $profile = $profileModel
            ->where('user_id', $userId)
            ->where('deleted_at', null)
            ->first();

        // =====================================================
        // CEK PROFILE
        // =====================================================

        if (!$profile) {
            return redirect()
                ->to(base_url('dashboard-alumni'))
                ->with(
                    'error',
                    'Data profil alumni tidak ditemukan.'
                );
        }

        // =====================================================
        // SIMPAN ID PROFILE KE SESSION
        // =====================================================

        $userProfileId = (int) $profile['id'];

        session()->set([
            'user_profile_id' => $userProfileId,
            'alumni_profile'  => $profile,
        ]);

        // =====================================================
        // AMBIL UNIT LAYANAN
        // =====================================================

        $units = $unitModel
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();

        // =====================================================
        // DATA PEMOHON
        // =====================================================

        $pemohon = [

            'nama' =>
                $profile['name']
                ?? $user['nama']
                ?? $user['full_name']
                ?? 'Alumni',

            'nik' =>
                $profile['nik']
                ?? $user['nik']
                ?? '',

            'nim' =>
                $profile['nim']
                ?? $user['nim']
                ?? '',

            'email' =>
                $profile['email']
                ?? $user['email']
                ?? '',

            'telepon' =>
                $profile['phone']
                ?? $user['no_hp']
                ?? $user['phone_number']
                ?? '',
        ];

        // =====================================================
        // DATA VIEW
        // =====================================================

        $data = [

            'title' =>
                'Ajukan Layanan',

            'user' =>
                $pemohon,

            'profile' =>
                $profile,

            'userProfileId' =>
                $userProfileId,

            'units' =>
                $units,
        ];

        // =====================================================
        // TAMPILKAN HALAMAN
        // =====================================================

        return view(
            'alumni/ticket/create',
            $data
        );
    }

    public function jenisLayanan()
{
    $unitId = $this->request->getGet('unit_id');

    if (!$unitId) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Unit layanan tidak ditemukan.',
            'data'    => [],
        ]);
    }

    $serviceModel = new MasterServiceModel();

    $services = $serviceModel
        ->where('service_unit_id', $unitId)
        ->where('is_active', 1)
        ->orderBy('sort_order', 'ASC')
        ->findAll();

    return $this->response->setJSON([
        'success' => true,
        'data'    => $services,
    ]);
}

public function persyaratan()
{
    $serviceId = $this->request->getGet('service_id');

    if (!$serviceId) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Jenis layanan tidak ditemukan.',
            'data'    => [],
        ]);
    }

    $requirementModel = new MasterServiceRequirementModel();

    $requirements = $requirementModel
        ->where('service_id', $serviceId)
        ->where('is_active', 1)
        ->orderBy('sort_order', 'ASC')
        ->findAll();

    return $this->response->setJSON([
        'success' => true,
        'data'    => $requirements,
    ]);
}

public function store()
{
    $db = \Config\Database::connect();

    $serviceRequestModel = new ServiceRequestModel();
    $userProfileModel    = new UserProfileModel();

    // ==========================================
    // 1. AMBIL JENIS LAYANAN
    // ==========================================

    $serviceId = $this->request->getPost('jenis_layanan');

    if (empty($serviceId)) {
        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Silakan pilih jenis layanan terlebih dahulu.'
            );
    }

    // ==========================================
    // 2. AMBIL USER PROFILE
    // ==========================================

    $userId = session()->get('user_id');

    if (empty($userId)) {
        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Akun pengguna tidak ditemukan. Silakan login kembali.'
            );
    }

    $userProfile = $userProfileModel
        ->where('user_id', $userId)
        ->where('deleted_at', null)
        ->first();

    if (!$userProfile) {
        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Data profil alumni tidak ditemukan.'
            );
    }

    $userProfileId = (int) $userProfile['id'];

    // ==========================================
    // 3. CEK LAYANAN
    // ==========================================

    $service = $db->table('master_services')
        ->where('id', $serviceId)
        ->where('is_active', 1)
        ->where('deleted_at', null)
        ->get()
        ->getRowArray();

    if (!$service) {
        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Jenis layanan tidak valid.'
            );
    }

    // ==========================================
    // 4. AMBIL PERSYARATAN
    // ==========================================

    $requirements = $db->table(
        'master_service_requirements'
    )
        ->where('service_id', $serviceId)
        ->where('is_active', 1)
        ->where('deleted_at', null)
        ->orderBy('sort_order', 'ASC')
        ->get()
        ->getResultArray();

    // ==========================================
    // 5. AMBIL FILE YANG DIUPLOAD
    // ==========================================

    $files = $this->request->getFiles();

    $documents = $files['dokumen'] ?? [];

    // ==========================================
    // 6. CEK PERSYARATAN WAJIB
    // ==========================================

    foreach ($requirements as $requirement) {

        if ((int) $requirement['is_required'] !== 1) {
            continue;
        }

        $requirementId = $requirement['id'];

        $file = $documents[$requirementId] ?? null;

        if (
            !$file ||
            !$file->isValid() ||
            $file->hasMoved()
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Dokumen "' .
                    $requirement['name'] .
                    '" wajib diupload.'
                );
        }
    }

    // ==========================================
    // 7. GENERATE NOMOR TIKET
    // ==========================================

    $ticketNumber =
        'ULT-ALM-' .
        strtoupper(
            bin2hex(random_bytes(4))
        );

    $now = date('Y-m-d H:i:s');

    // ==========================================
    // 8. SIMPAN SERVICE REQUEST
    // ==========================================

    $data = [
        'ticket_number'   => $ticketNumber,
        'user_profile_id' => $userProfileId,
        'service_id'      => $serviceId,

        'title' =>
            'Pengajuan Layanan',

        'description' =>
            $this->request->getPost('keterangan'),

        'status' =>
            'submitted',

        'priority' =>
            'normal',

        'submitted_at' =>
            $now,

        'created_at' =>
            $now,

        'updated_at' =>
            $now,
    ];

    $serviceRequestModel->insert($data);

    $ticketId = $serviceRequestModel->getInsertID();

    // ==========================================
    // 9. SIMPAN DOKUMEN
    // ==========================================

    foreach ($documents as $requirementId => $file) {

        // ======================================
        // CEK REQUIREMENT
        // ======================================

        $requirement = null;

        foreach ($requirements as $item) {

            if (
                (int) $item['id'] ===
                (int) $requirementId
            ) {
                $requirement = $item;
                break;
            }
        }

        if (!$requirement) {
            continue;
        }

        // ======================================
        // CEK FILE
        // ======================================

        if (
            !$file ||
            !$file->isValid() ||
            $file->hasMoved()
        ) {
            continue;
        }

        // ======================================
        // CEK UKURAN
        // max_file_size = KB
        // ======================================

        $maxSize =
            ((int) (
                $requirement['max_file_size']
                ?? 2048
            )) * 1024;

        if ($file->getSize() > $maxSize) {

            $serviceRequestModel->delete(
                $ticketId
            );

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Ukuran file "' .
                    $requirement['name'] .
                    '" terlalu besar.'
                );
        }

        // ======================================
        // CEK EXTENSION
        // ======================================

        $extension = strtolower(
            $file->getClientExtension()
        );

        $allowed =
            $requirement['allowed_extensions']
            ??
            'pdf,jpg,jpeg,png,doc,docx,xls,xlsx';

        $allowedExtensions = array_map(
            'trim',
            explode(
                ',',
                strtolower($allowed)
            )
        );

        if (
            !in_array(
                $extension,
                $allowedExtensions,
                true
            )
        ) {

            $serviceRequestModel->delete(
                $ticketId
            );

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Format file "' .
                    $requirement['name'] .
                    '" tidak diperbolehkan.'
                );
        }

        // ======================================
        // FOLDER UPLOAD
        // ======================================

        $uploadPath =
            FCPATH .
            'uploads/service_requests/' .
            $ticketId .
            '/';

        if (!is_dir($uploadPath)) {
            mkdir(
                $uploadPath,
                0777,
                true
            );
        }

        // ======================================
        // NAMA FILE
        // ======================================

        $newName =
            $file->getRandomName();

        // ======================================
        // PINDAHKAN FILE
        // ======================================

        $file->move(
            $uploadPath,
            $newName
        );

        // ======================================
        // SIMPAN DATABASE
        // ======================================

        $db->table(
            'service_request_files'
        )->insert([

            'service_request_id'
                => $ticketId,

            'requirement_id'
                => $requirementId,

            'original_name'
                => $file->getClientName(),

            'file_name'
                => $newName,

            'file_path'
                => 'uploads/service_requests/' .
                    $ticketId .
                    '/' .
                    $newName,

            'file_extension'
                => $extension,

            'mime_type'
                => $file->getClientMimeType(),

            'file_size'
                => $file->getSize(),

            'is_verified'
                => 0,

            'created_at'
                => $now,

            'updated_at'
                => $now,
        ]);
    }

    // ==========================================
    // 10. AMBIL TIKET TERBARU
    // ==========================================

    $ticket = $serviceRequestModel
        ->find($ticketId);

    $ticket['service_name'] =
        $service['name'] ?? '-';

    // ==========================================
    // 11. MASUK KE SUCCESS
    // ==========================================

    session()->set(
        'last_ticket',
        $ticket
    );

    return redirect()->to(
        base_url(
            'alumni/ticket/success'
        )
    );
}

public function success()
{
    $ticket = session()->get('last_ticket');

    if (!$ticket) {
        return redirect()->to(
            base_url('alumni/ticket/create')
        );
    }

    return view(
        'alumni/ticket/success',
        [
            'title'  => 'Pengajuan Berhasil',
            'ticket' => $ticket
        ]
    );
}

public function history()
{
    $db = \Config\Database::connect();

    // ==========================================
    // CEK USER LOGIN
    // ==========================================

    $userId = session()->get('user_id');

    if (empty($userId)) {
        return redirect()
            ->to(base_url('login'))
            ->with(
                'error',
                'Silakan login terlebih dahulu.'
            );
    }

    // ==========================================
    // AMBIL PROFILE ALUMNI
    // ==========================================

    $userProfile = $db->table('user_profiles')
        ->where('user_id', $userId)
        ->where('deleted_at', null)
        ->get()
        ->getRowArray();

    if (!$userProfile) {
        return redirect()
            ->to(base_url('dashboard-alumni'))
            ->with(
                'error',
                'Data profil alumni tidak ditemukan.'
            );
    }

    // ==========================================
    // AMBIL TIKET MILIK ALUMNI
    // ==========================================

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

        ->where(
            'sr.deleted_at',
            null
        )

        ->orderBy(
            'sr.created_at',
            'DESC'
        )

        ->get()
        ->getResultArray();

    // ==========================================
    // UBAH FORMAT DATA UNTUK HISTORY.PHP
    // ==========================================

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

        // ======================================
        // TANGGAL
        // ======================================

        $createdAt =
            $ticket['submitted_at']
            ?? $ticket['created_at']
            ?? null;

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

    // ==========================================
    // VIEW
    // ==========================================

    return view(
        'alumni/ticket/history',
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
 * DETAIL TIKET
 * =========================================================
 */
public function detail($id)
{
    $db = \Config\Database::connect();

    // ==========================================
    // USER PROFILE
    // ==========================================

    $userProfileId =
        session()->get('user_profile_id');

    if (empty($userProfileId)) {
        return redirect()
            ->to(
                base_url('alumni/ticket/history')
            )
            ->with(
                'error',
                'Data profil alumni tidak ditemukan.'
            );
    }

    // ==========================================
    // AMBIL DATA TIKET
    // ==========================================

    $ticket = $db->table(
        'service_requests sr'
    )

        ->select('
            sr.*,
            ms.name AS service_name,
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
            'sr.deleted_at',
            null
        )

        ->get()
        ->getRowArray();

    // ==========================================
    // TIKET TIDAK DITEMUKAN
    // ==========================================

    if (!$ticket) {
        return redirect()
            ->to(
                base_url('alumni/ticket/history')
            )
            ->with(
                'error',
                'Tiket tidak ditemukan.'
            );
    }

    // ==========================================
    // AMBIL DOKUMEN
    // ==========================================

    $documents = $db->table(
        'service_request_files srf'
    )

        ->select('
            srf.*,
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

        ->get()
        ->getResultArray();

    // ==========================================
    // DATA VIEW
    // ==========================================

    $data = [

        'title' =>
            'Detail Tiket',

        'ticket' =>
            $ticket,

        'documents' =>
            $documents,

    ];

    return view(
        'alumni/ticket/detail',
        $data
    );
}

public function draft()
{
    $db = \Config\Database::connect();

    // =====================================================
    // AMBIL USER YANG SEDANG LOGIN
    // =====================================================

    $user = session()->get('user') ?? [];

    $userProfileId =
        $user['user_profile_id']
        ?? $user['profile_id']
        ?? session()->get('user_profile_id')
        ?? null;

    // =====================================================
    // CEK USER PROFILE
    // =====================================================

    if (empty($userProfileId)) {
        return redirect()
            ->to(base_url('login'))
            ->with(
                'error',
                'Data profil pengguna tidak ditemukan.'
            );
    }

    // =====================================================
    // QUERY DRAFT + JENIS LAYANAN + UNIT LAYANAN
    // =====================================================

    $builder = $db->table(
        'service_requests sr'
    );

    $builder->select([
        'sr.id',
        'sr.ticket_number',
        'sr.user_profile_id',
        'sr.service_id',
        'sr.title',
        'sr.description',
        'sr.status',
        'sr.created_at',

        // Nama jenis layanan
        'ms.name AS service_name',

        // Nama unit layanan
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

    // =====================================================
    // HANYA STATUS DRAFT
    // =====================================================

// Hanya draft yang belum dihapus
$builder->where('sr.status', 'draft');
$builder->where('sr.deleted_at', null);

    // =====================================================
    // HANYA MILIK ALUMNI YANG LOGIN
    // =====================================================

    $builder->where(
        'sr.user_profile_id',
        $userProfileId
    );

    // =====================================================
    // HANYA DATA YANG BELUM DIHAPUS
    // =====================================================

    $builder->where(
        'sr.deleted_at',
        null
    );

    // =====================================================
    // TERBARU DI ATAS
    // =====================================================

    $builder->orderBy(
        'sr.created_at',
        'DESC'
    );

    $drafts = $builder
        ->get()
        ->getResultArray();


    // =====================================================
    // CEK KELENGKAPAN DOKUMEN
    // =====================================================

    foreach ($drafts as &$draft) {

        // =================================================
        // SEMUA PERSYARATAN WAJIB
        // =================================================

        $requirements = $db
            ->table(
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
            ->where(
                'deleted_at',
                null
            )
            ->get()
            ->getResultArray();


        $totalRequired =
            count($requirements);


        // =================================================
        // TIDAK ADA DOKUMEN WAJIB
        // =================================================

        if ($totalRequired === 0) {

            $draft['document_complete'] =
                true;

            continue;
        }


        // =================================================
        // AMBIL FILE YANG SUDAH DIUPLOAD
        // =================================================

        $uploaded = $db
            ->table(
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
                'msr.deleted_at',
                null
            )
            ->where(
                'srf.deleted_at',
                null
            )
            ->get()
            ->getResultArray();


        // =================================================
        // MAP REQUIREMENT YANG SUDAH ADA FILE
        // =================================================

        $uploadedRequirementIds = [];

        foreach (
            $uploaded as $file
        ) {

            $uploadedRequirementIds[
                $file['requirement_id']
            ] = true;
        }


        // =================================================
        // CEK SEMUA REQUIREMENT WAJIB
        // =================================================

        $complete = true;

        foreach (
            $requirements as $requirement
        ) {

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


        $draft['document_complete'] =
            $complete;
    }

    unset($draft);


    // =====================================================
    // DATA UNTUK VIEW
    // =====================================================

    $data = [
        'title'  => 'Draft Pengajuan',
        'drafts' => $drafts
    ];


    // =====================================================
    // TAMPILKAN VIEW ALUMNI
    // =====================================================

    return view(
        'alumni/ticket/draft',
        $data
    );
}

public function saveDraft()
{
    $db = \Config\Database::connect();

    $serviceRequestModel = new ServiceRequestModel();

    // ==========================================
    // 1. AMBIL SERVICE
    // ==========================================

    $serviceId = $this->request->getPost('jenis_layanan');

    if (empty($serviceId)) {
        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Silakan pilih jenis layanan terlebih dahulu.'
            );
    }

    // ==========================================
    // 2. USER PROFILE
    // ==========================================

    $userProfileId = session()->get('user_profile_id');

    if (empty($userProfileId)) {
        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Data profil alumni tidak ditemukan.'
            );
    }

    // ==========================================
    // 3. PASTIKAN SERVICE AKTIF
    // ==========================================

    $service = $db->table('master_services')
        ->where('id', $serviceId)
        ->where('is_active', 1)
        ->where('deleted_at', null)
        ->get()
        ->getRowArray();

    if (!$service) {
        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Jenis layanan tidak valid.'
            );
    }

    // ==========================================
    // 4. DATA DRAFT
    // ==========================================

    $now = date('Y-m-d H:i:s');

    $ticketNumber =
        'ULT-ALM-' .
        strtoupper(
            bin2hex(random_bytes(5))
        );

    $data = [
        'ticket_number'   => $ticketNumber,
        'user_profile_id' => $userProfileId,
        'service_id'      => $serviceId,
        'title'           => 'Pengajuan Layanan Alumni',
        'description'     => $this->request->getPost('keterangan'),
        'status'          => 'draft',
        'priority'        => 'normal',
        'submitted_at'    => null,
        'created_at'      => $now,
        'updated_at'      => $now,
    ];

    // ==========================================
    // 5. SIMPAN SERVICE REQUEST
    // ==========================================

    $serviceRequestModel->insert($data);

    $serviceRequestId =
        $serviceRequestModel->getInsertID();

    // ==========================================
    // 6. SIMPAN DOKUMEN YANG DIUPLOAD
    // ==========================================

    $files = $this->request->getFiles();

    $documents = $files['dokumen'] ?? [];

    if (!empty($documents)) {

        $requirements = $db
            ->table('master_service_requirements')
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
            ->get()
            ->getResultArray();

        // ======================================
        // MAP REQUIREMENT
        // ======================================

        $requirementMap = [];

        foreach ($requirements as $requirement) {

            $requirementMap[
                $requirement['id']
            ] = $requirement;
        }

        // ======================================
        // LOOP DOKUMEN
        // ======================================

        foreach (
            $documents as $requirementId => $file
        ) {

            // Requirement harus milik service
            if (
                !isset(
                    $requirementMap[$requirementId]
                )
            ) {
                continue;
            }

            // File kosong / tidak valid
            if (
                !$file ||
                !$file->isValid() ||
                $file->hasMoved()
            ) {
                continue;
            }

            $requirement =
                $requirementMap[$requirementId];

            // ==================================
            // CEK UKURAN
            // max_file_size = KB
            // ==================================

            $maxSize =
                ((int) (
                    $requirement['max_file_size']
                    ?? 2048
                )) * 1024;

            if (
                $file->getSize() > $maxSize
            ) {
                continue;
            }

            // ==================================
            // CEK EXTENSION
            // ==================================

            $extension = strtolower(
                $file->getClientExtension()
            );

            $allowed =
                $requirement['allowed_extensions']
                ??
                'pdf,jpg,jpeg,png,doc,docx,xls,xlsx';

            $allowedExtensions = array_map(
                'trim',
                explode(
                    ',',
                    strtolower($allowed)
                )
            );

            if (
                !in_array(
                    $extension,
                    $allowedExtensions,
                    true
                )
            ) {
                continue;
            }

            // ==================================
            // FOLDER UPLOAD
            // ==================================

            $uploadPath =
                FCPATH .
                'uploads/service_requests/' .
                $serviceRequestId .
                '/';

            if (!is_dir($uploadPath)) {

                mkdir(
                    $uploadPath,
                    0777,
                    true
                );
            }

            // ==================================
            // NAMA FILE
            // ==================================

            $newName =
                $file->getRandomName();

            // ==================================
            // PINDAHKAN FILE
            // ==================================

            $file->move(
                $uploadPath,
                $newName
            );

            // ==================================
            // SIMPAN DATABASE
            // ==================================

            $db->table(
                'service_request_files'
            )->insert([

                'service_request_id'
                    => $serviceRequestId,

                'requirement_id'
                    => $requirementId,

                'original_name'
                    => $file->getClientName(),

                'file_name'
                    => $newName,

                'file_path'
                    => 'uploads/service_requests/' .
                        $serviceRequestId .
                        '/' .
                        $newName,

                'file_extension'
                    => $extension,

                'mime_type'
                    => $file->getClientMimeType(),

                'file_size'
                    => $file->getSize(),

                'is_verified'
                    => 0,

                'created_at'
                    => $now,

                'updated_at'
                    => $now,
            ]);
        }
    }

    // ==========================================
    // 7. KEMBALI KE DAFTAR DRAFT
    // ==========================================

    return redirect()
        ->to(
            base_url(
                'alumni/ticket/draft'
            )
        )
        ->with(
            'success',
            'Pengajuan berhasil disimpan sebagai draft.'
        );
}

public function editDraft($id)
{
    $db = \Config\Database::connect();

    $userProfileId =
        session()->get('user_profile_id');


    // ==========================================
    // AMBIL DRAFT
    // ==========================================

    $draft = $db->table(
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
            'sr.status',
            'draft'
        )
        ->where(
            'sr.user_profile_id',
            $userProfileId
        )
        ->where(
            'sr.deleted_at',
            null
        )
        ->get()
        ->getRowArray();


    if (!$draft) {

        return redirect()
            ->to(
                base_url(
                    'alumni/ticket/draft'
                )
            )
            ->with(
                'error',
                'Draft tidak ditemukan atau bukan milik Anda.'
            );
    }


    // ==========================================
    // SEMUA UNIT
    // ==========================================

    $units = $db->table(
        'master_service_units'
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
        ->get()
        ->getResultArray();


    // ==========================================
    // SEMUA SERVICE
    // ==========================================

    $services = $db->table(
        'master_services'
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
        ->get()
        ->getResultArray();


    // ==========================================
    // PERSYARATAN SESUAI SERVICE SAAT INI
    // ==========================================

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
            'deleted_at',
            null
        )
        ->orderBy(
            'sort_order',
            'ASC'
        )
        ->get()
        ->getResultArray();


    // ==========================================
    // FILE YANG SUDAH DIUPLOAD
    // ==========================================

    $files = $db->table(
        'service_request_files'
    )
        ->where(
            'service_request_id',
            $draft['id']
        )
        ->where(
            'deleted_at',
            null
        )
        ->get()
        ->getResultArray();


    // ==========================================
    // MAP FILE BERDASARKAN REQUIREMENT
    // ==========================================

    $uploadedFiles = [];

    foreach ($files as $file) {

        $uploadedFiles[
            $file['requirement_id']
        ] = $file;
    }


    // ==========================================
    // TAMPILKAN VIEW
    // ==========================================

    return view(
        'alumni/ticket/edit_draft',
        [
            'title' =>
                'Edit Draft Pengajuan',

            'draft' =>
                $draft,

            'units' =>
                $units,

            'services' =>
                $services,

            'requirements' =>
                $requirements,

            'uploadedFiles' =>
                $uploadedFiles,
        ]
    );
}

public function updateDraft($id)
{
    $db = \Config\Database::connect();

    $userProfileId =
        session()->get('user_profile_id');

    $action =
        $this->request->getPost('action');

    // ==========================================
    // AMBIL DRAFT
    // ==========================================

    $draft = $db->table(
        'service_requests'
    )
        ->where(
            'id',
            $id
        )
        ->where(
            'status',
            'draft'
        )
        ->where(
            'user_profile_id',
            $userProfileId
        )
        ->where(
            'deleted_at',
            null
        )
        ->get()
        ->getRowArray();

    if (!$draft) {

        return redirect()
            ->to(
                base_url(
                    'alumni/ticket/draft'
                )
            )
            ->with(
                'error',
                'Draft tidak ditemukan.'
            );
    }


    // ==========================================
    // SERVICE BARU
    // ==========================================

    $serviceId =
        $this->request->getPost(
            'jenis_layanan'
        );

    if (empty($serviceId)) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Silakan pilih jenis layanan.'
            );
    }


    // ==========================================
    // CEK SERVICE
    // ==========================================

    $service = $db->table(
        'master_services'
    )
        ->where(
            'id',
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
        ->get()
        ->getRowArray();

    if (!$service) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Jenis layanan tidak valid.'
            );
    }


    // ==========================================
    // CEK APAKAH SERVICE BERUBAH
    // ==========================================

    $serviceChanged =
        (int) $draft['service_id']
        !==
        (int) $serviceId;


    // ==========================================
    // UPDATE DRAFT
    // ==========================================

    $db->table(
        'service_requests'
    )
        ->where(
            'id',
            $id
        )
        ->where(
            'user_profile_id',
            $userProfileId
        )
        ->update([

            'service_id'
                => $serviceId,

            'description'
                => $this->request->getPost(
                    'description'
                ),

            'updated_at'
                => date(
                    'Y-m-d H:i:s'
                ),

        ]);


    // ==========================================
    // KALAU SERVICE BERUBAH
    // HAPUS FILE LAMA
    // ==========================================

    if ($serviceChanged) {

        $oldFiles = $db->table(
            'service_request_files'
        )
            ->where(
                'service_request_id',
                $id
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
                $oldFile['file_path'];

            if (
                is_file($oldPath)
            ) {
                @unlink($oldPath);
            }
        }


        $db->table(
            'service_request_files'
        )
            ->where(
                'service_request_id',
                $id
            )
            ->where(
                'deleted_at',
                null
            )
            ->update([

                'deleted_at'
                    => date(
                        'Y-m-d H:i:s'
                    ),

            ]);
    }


    // ==========================================
    // AMBIL PERSYARATAN SERVICE BARU
    // ==========================================

    $requirements =
        $db->table(
            'master_service_requirements'
        )
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
        ->get()
        ->getResultArray();


    // ==========================================
    // MAP REQUIREMENT
    // ==========================================

    $requirementMap = [];

    foreach (
        $requirements as $requirement
    ) {

        $requirementMap[
            $requirement['id']
        ] = $requirement;
    }


    // ==========================================
    // FILE BARU
    // ==========================================

    $files =
        $this->request->getFiles();

    $documents =
        $files['dokumen'] ?? [];


    foreach (
        $documents as $requirementId => $file
    ) {

        // Requirement harus milik service ini
        if (
            !isset(
                $requirementMap[
                    $requirementId
                ]
            )
        ) {
            continue;
        }


        // File kosong / tidak valid
        if (
            !$file ||
            !$file->isValid() ||
            $file->hasMoved()
        ) {
            continue;
        }


        $requirement =
            $requirementMap[
                $requirementId
            ];


        // ======================================
        // CEK UKURAN
        // max_file_size = KB
        // ======================================

        $maxSize =
            ((int) (
                $requirement[
                    'max_file_size'
                ] ?? 2048
            )) * 1024;


        if (
            $file->getSize() >
            $maxSize
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Ukuran file untuk "' .
                    $requirement['name'] .
                    '" terlalu besar.'
                );
        }


        // ======================================
        // CEK EXTENSION
        // ======================================

        $extension =
            strtolower(
                $file->getClientExtension()
            );


        $allowed =
            $requirement[
                'allowed_extensions'
            ]
            ??
            'pdf,jpg,jpeg,png,doc,docx,xls,xlsx';


        $allowedExtensions =
            array_map(
                'trim',
                explode(
                    ',',
                    strtolower($allowed)
                )
            );


        if (
            !in_array(
                $extension,
                $allowedExtensions,
                true
            )
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Format file untuk "' .
                    $requirement['name'] .
                    '" tidak diperbolehkan.'
                );
        }


        // ======================================
        // FILE LAMA UNTUK REQUIREMENT INI
        // ======================================

        $oldFile =
            $db->table(
                'service_request_files'
            )
            ->where(
                'service_request_id',
                $id
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
                $oldFile['file_path'];


            if (
                is_file($oldPath)
            ) {
                @unlink($oldPath);
            }


            $db->table(
                'service_request_files'
            )
                ->where(
                    'id',
                    $oldFile['id']
                )
                ->update([

                    'deleted_at'
                        => date(
                            'Y-m-d H:i:s'
                        ),

                ]);
        }


        // ======================================
        // FOLDER
        // ======================================

        $uploadPath =
            FCPATH .
            'uploads/service_requests/' .
            $id .
            '/';


        if (
            !is_dir($uploadPath)
        ) {

            mkdir(
                $uploadPath,
                0777,
                true
            );
        }


        // ======================================
        // NAMA FILE
        // ======================================

        $newName =
            $file->getRandomName();


        // ======================================
        // PINDAHKAN FILE
        // ======================================

        $file->move(
            $uploadPath,
            $newName
        );


        // ======================================
        // SIMPAN DATABASE
        // ======================================

        $now =
            date(
                'Y-m-d H:i:s'
            );


        $db->table(
            'service_request_files'
        )->insert([

            'service_request_id'
                => $id,

            'requirement_id'
                => $requirementId,

            'original_name'
                => $file->getClientName(),

            'file_name'
                => $newName,

            'file_path'
                => 'uploads/service_requests/' .
                    $id .
                    '/' .
                    $newName,

            'file_extension'
                => $extension,

            'mime_type'
                => $file->getClientMimeType(),

            'file_size'
                => $file->getSize(),

            'is_verified'
                => 0,

            'created_at'
                => $now,

            'updated_at'
                => $now,

        ]);
    }


    // ==========================================
    // JIKA USER MEMILIH AJUKAN
    // ==========================================

    if ($action === 'submit') {

        $now =
            date(
                'Y-m-d H:i:s'
            );


        // ======================================
        // GENERATE / PAKAI NOMOR TIKET
        // ======================================

        $ticketNumber =
            $draft['ticket_number'];


        if (empty($ticketNumber)) {

            $ticketNumber =
                'ULT-ALM-' .
                strtoupper(
                    bin2hex(
                        random_bytes(4)
                    )
                );
        }


        // ======================================
        // UBAH DRAFT MENJADI SUBMITTED
        // ======================================

        $db->table(
            'service_requests'
        )
            ->where(
                'id',
                $id
            )
            ->where(
                'user_profile_id',
                $userProfileId
            )
            ->update([

                'ticket_number'
                    => $ticketNumber,

                'status'
                    => 'submitted',

                'submitted_at'
                    => $now,

                'updated_at'
                    => $now,

            ]);


        // ======================================
        // AMBIL TIKET TERBARU
        // ======================================

        $ticket =
            $db->table(
                'service_requests'
            )
            ->where(
                'id',
                $id
            )
            ->get()
            ->getRowArray();


        // ======================================
        // AMBIL NAMA JENIS LAYANAN
        // ======================================

        $service =
            $db->table(
                'master_services'
            )
            ->where(
                'id',
                $ticket['service_id']
            )
            ->get()
            ->getRowArray();


        $ticket['service_name'] =
            $service['name']
            ?? '-';


        // ======================================
        // LANGSUNG KE SUCCESS
        // ======================================

        return view(
            'alumni/ticket/success',
            [
                'title' =>
                    'Pengajuan Berhasil',

                'ticket' =>
                    $ticket
            ]
        );
    }


    // ==========================================
    // JIKA HANYA SIMPAN DRAFT
    // ==========================================

    return redirect()
        ->to(
            base_url(
                'alumni/ticket/draft'
            )
        )
        ->with(
            'success',
            'Draft berhasil diperbarui.'
        );
}

public function deleteDraft($id)
{
    $serviceRequestModel =
        new \App\Models\ServiceRequestModel();

    // ==========================================
    // AMBIL USER PROFILE ID DARI SESSION
    // ==========================================

    $userProfileId =
        session()->get('user_profile_id');


    // ==========================================
    // CARI DRAFT
    // ==========================================

    $draft = $serviceRequestModel
        ->where('id', $id)
        ->where(
            'user_profile_id',
            $userProfileId
        )
        ->where(
            'status',
            'draft'
        )
        ->first();


    // ==========================================
    // DRAFT TIDAK DITEMUKAN
    // ==========================================

    if (!$draft) {

        session()->setFlashdata(
            'error',
            'Draft tidak ditemukan atau bukan milik Anda.'
        );

        return redirect()->to(
            base_url(
                'alumni/ticket/draft'
            )
        );
    }


    // ==========================================
    // HAPUS DRAFT
    // ==========================================

    $serviceRequestModel->delete($id);


    // ==========================================
    // SUCCESS
    // ==========================================

    session()->setFlashdata(
        'success',
        'Draft berhasil dihapus.'
    );


    return redirect()->to(
        base_url(
            'alumni/ticket/draft'
        )
    );
}
}