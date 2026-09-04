<?php

namespace App\Controllers;

use App\Models\ServiceRequestModel;
use App\Models\ServiceRequestFileModel;
use App\Models\MasterServiceUnitModel;
use App\Models\MasterServiceModel;
use App\Models\MasterServiceRequirementModel;
use App\Models\UserProfileModel;

class DosenTicketController extends BaseController
{
    /**
     * =========================================================
     * CEK ROLE DOSEN
     * =========================================================
     */
    private function checkDosenRole()
    {
        $applicantTypeCode = session()->get('applicant_type_code');

        if ($applicantTypeCode !== 'DOSEN') {
            return redirect()
                ->to(base_url('dashboard-mahasiswa'))
                ->with('error', 'Akses hanya untuk dosen.');
        }

        return null;
    }

    /**
 * =========================================================
 * CREATE / AJUKAN LAYANAN
 * =========================================================
 */
public function create()
{
    $check = $this->checkDosenRole();

    if ($check) {
        return $check;
    }

    // =====================================================
    // MODEL
    // =====================================================

    $unitModel = new MasterServiceUnitModel();
    $profileModel = new UserProfileModel();

    // =====================================================
    // USER LOGIN
    // =====================================================

    $user = session()->get('user') ?? [];

    $userId = (int) (
        session()->get('user_id')
        ?? ($user['id'] ?? 0)
    );

    if ($userId <= 0) {

        return redirect()
            ->to(base_url('login'))
            ->with(
                'error',
                'Sesi login tidak ditemukan. Silakan login kembali.'
            );
    }

    // =====================================================
    // PROFILE DOSEN
    // =====================================================

    $profile = $profileModel
        ->where('user_id', $userId)
        ->where('deleted_at', null)
        ->first();

    if (!$profile) {

        return redirect()
            ->to(base_url('dosen/dashboard'))
            ->with(
                'error',
                'Data profil dosen tidak ditemukan.'
            );
    }

    // =====================================================
    // SIMPAN PROFILE ID KE SESSION
    // =====================================================

    $userProfileId = (int) $profile['id'];

    session()->set([
        'user_profile_id' => $userProfileId,
        'dosen_profile'   => $profile,
    ]);

    // =====================================================
    // UNIT LAYANAN
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
            $user['nama']
            ?? $user['full_name']
            ?? $profile['name']
            ?? 'Dosen',

        'nik' =>
            $profile['nik']
            ?? $user['nik']
            ?? '',

        'email' =>
            $user['email']
            ?? $profile['email']
            ?? '',

        'telepon' =>
            $user['no_hp']
            ?? $user['phone_number']
            ?? $profile['phone']
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
    // VIEW
    // =====================================================

    return view(
        'dosen/ticket/create',
        $data
    );
}

   /**
 * =========================================================
 * JENIS LAYANAN
 * =========================================================
 */
public function jenisLayanan()
{
    $check = $this->checkDosenRole();

    if ($check) {
        return $check;
    }

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

/**
 * =========================================================
 * PERSYARATAN LAYANAN
 * =========================================================
 */
public function persyaratan()
{
    $check = $this->checkDosenRole();

    if ($check) {
        return $check;
    }

    $serviceId =
        $this->request->getGet('service_id');

    if (!$serviceId) {

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Jenis layanan tidak ditemukan.',
            'data'    => [],
        ]);
    }

    $requirementModel =
        new MasterServiceRequirementModel();

    $requirements = $requirementModel
        ->where(
            'service_id',
            $serviceId
        )
        ->where(
            'is_active',
            1
        )
        ->orderBy(
            'sort_order',
            'ASC'
        )
        ->findAll();

    return $this->response->setJSON([
        'success' => true,
        'data'    => $requirements,
    ]);
}

    /**
     * =========================================================
     * SIMPAN DRAFT
     * =========================================================
     */
    public function saveDraft()
    {
        $check = $this->checkDosenRole();

        if ($check) {
            return $check;
        }

        $db = \Config\Database::connect();

        $serviceRequestModel =
            new ServiceRequestModel();

        // =====================================================
        // SERVICE
        // =====================================================

        $serviceId =
            $this->request->getPost('jenis_layanan');

        if (empty($serviceId)) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Silakan pilih jenis layanan terlebih dahulu.'
                );
        }

        // =====================================================
        // PROFILE
        // =====================================================

        $userProfileId =
            session()->get('user_profile_id');

        if (empty($userProfileId)) {

            $userId = session()->get('user_id');

            if (empty($userId)) {
                return redirect()
                    ->to(base_url('login'))
                    ->with(
                        'error',
                        'Sesi login tidak ditemukan.'
                    );
            }

            $profileModel =
                new UserProfileModel();

            $profile = $profileModel
                ->where('user_id', $userId)
                ->where('deleted_at', null)
                ->first();

            if (!$profile) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Data profil dosen tidak ditemukan.'
                    );
            }

            $userProfileId =
                $profile['id'];

            session()->set([
                'user_profile_id' => $userProfileId,
                'dosen_profile'   => $profile,
            ]);
        }

        // =====================================================
        // CEK SERVICE
        // =====================================================

        $service = $db->table('master_services')
            ->where('id', $serviceId)
            ->where('is_active', 1)
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

        // =====================================================
        // DATA DRAFT
        // =====================================================

        $now = date('Y-m-d H:i:s');

        $ticketNumber =
            'ULT-DOSEN-' .
            strtoupper(
                bin2hex(random_bytes(5))
            );

        $data = [

            'ticket_number' =>
                $ticketNumber,

            'user_profile_id' =>
                $userProfileId,

            'service_id' =>
                $serviceId,

            'title' =>
                'Pengajuan Layanan Dosen',

            'description' =>
                $this->request->getPost(
                    'keterangan'
                ),

            'status' =>
                'draft',

            'priority' =>
                'normal',

            'submitted_at' =>
                null,

            'created_at' =>
                $now,

            'updated_at' =>
                $now,

        ];

        $serviceRequestModel->insert($data);

        $serviceRequestId =
            $serviceRequestModel->getInsertID();

        // =====================================================
        // FILE
        // =====================================================

        $this->saveUploadedDocuments(
            $serviceRequestId,
            $serviceId
        );

        return redirect()
            ->to(
                base_url(
                    'dosen/ticket/draft'
                )
            )
            ->with(
                'success',
                'Pengajuan berhasil disimpan sebagai draft.'
            );
    }

    /**
     * =========================================================
     * SIMPAN FILE
     * =========================================================
     */
    private function saveUploadedDocuments(
        $serviceRequestId,
        $serviceId
    ) {
        $db = \Config\Database::connect();

        $files =
            $this->request->getFiles();

        $documents =
            $files['dokumen'] ?? [];

        if (empty($documents)) {
            return;
        }

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
            ->get()
            ->getResultArray();

        $requirementMap = [];

        foreach ($requirements as $requirement) {

            $requirementMap[
                $requirement['id']
            ] = $requirement;
        }

        $now =
            date('Y-m-d H:i:s');

        foreach (
            $documents
            as $requirementId => $file
        ) {

            if (
                !isset(
                    $requirementMap[
                        $requirementId
                    ]
                )
            ) {
                continue;
            }

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

            // =================================================
            // UKURAN
            // =================================================

            $maxSize =
                (
                    (int) (
                        $requirement[
                            'max_file_size'
                        ] ?? 2048
                    )
                ) * 1024;

            if (
                $file->getSize() >
                $maxSize
            ) {
                continue;
            }

            // =================================================
            // EXTENSION
            // =================================================

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
                    $allowedExtensions
                )
            ) {
                continue;
            }

            // =================================================
            // FOLDER
            // =================================================

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

            // =================================================
            // FILE NAME
            // =================================================

            $newName =
                $file->getRandomName();

            $file->move(
                $uploadPath,
                $newName
            );

            // =================================================
            // DATABASE
            // =================================================

            $db->table(
                'service_request_files'
            )->insert([

                'service_request_id' =>
                    $serviceRequestId,

                'requirement_id' =>
                    $requirementId,

                'original_name' =>
                    $file->getClientName(),

                'file_name' =>
                    $newName,

                'file_path' =>
                    'uploads/service_requests/' .
                    $serviceRequestId .
                    '/' .
                    $newName,

                'file_extension' =>
                    $extension,

                'mime_type' =>
                    $file->getClientMimeType(),

                'file_size' =>
                    $file->getSize(),

                'is_verified' =>
                    0,

                'created_at' =>
                    $now,

                'updated_at' =>
                    $now,

            ]);
        }
    }

    /**
     * =========================================================
     * STORE / SUBMIT TIKET
     * =========================================================
     */
    public function store()
    {
        $check = $this->checkDosenRole();

        if ($check) {
            return $check;
        }

        $db = \Config\Database::connect();

        $serviceRequestModel =
            new ServiceRequestModel();

        $userProfileModel =
            new UserProfileModel();

        // =====================================================
        // SERVICE
        // =====================================================

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
                    'Silakan pilih jenis layanan terlebih dahulu.'
                );
        }

        // =====================================================
        // USER
        // =====================================================

        $userId =
            session()->get('user_id');

        if (empty($userId)) {
            return redirect()
                ->to(base_url('login'))
                ->with(
                    'error',
                    'Akun pengguna tidak ditemukan. Silakan login kembali.'
                );
        }

        $userProfile =
            $userProfileModel
                ->where(
                    'user_id',
                    $userId
                )
                ->where(
                    'deleted_at',
                    null
                )
                ->first();

        if (!$userProfile) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Data profil dosen tidak ditemukan.'
                );
        }

        $userProfileId =
            $userProfile['id'];

        session()->set([
            'user_profile_id' =>
                $userProfileId,

            'dosen_profile' =>
                $userProfile,
        ]);

        // =====================================================
        // SERVICE
        // =====================================================

        $service =
            $db->table(
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

        // =====================================================
        // REQUIREMENTS
        // =====================================================

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
            ->get()
            ->getResultArray();

        $files =
            $this->request->getFiles();

        $documents =
            $files['dokumen'] ?? [];

        // =====================================================
        // CEK REQUIREMENT WAJIB
        // =====================================================

        foreach ($requirements as $requirement) {

            if (
                (int)
                $requirement['is_required']
                !== 1
            ) {
                continue;
            }

            $requirementId =
                $requirement['id'];

            $file =
                $documents[
                    $requirementId
                ] ?? null;

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

        // =====================================================
        // TICKET NUMBER
        // =====================================================

        $ticketNumber =
            'ULT-DOSEN-' .
            strtoupper(
                bin2hex(random_bytes(4))
            );

        $now =
            date('Y-m-d H:i:s');

        // =====================================================
        // INSERT TICKET
        // =====================================================

        $data = [

            'ticket_number' =>
                $ticketNumber,

            'user_profile_id' =>
                $userProfileId,

            'service_id' =>
                $serviceId,

            'title' =>
                'Pengajuan Layanan Dosen',

            'description' =>
                $this->request->getPost(
                    'keterangan'
                ),

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

        $serviceRequestModel->insert(
            $data
        );

        $ticketId =
            $serviceRequestModel->getInsertID();

        // =====================================================
        // SIMPAN FILE
        // =====================================================

        foreach (
            $documents
            as $requirementId => $file
        ) {

            $requirement = null;

            foreach (
                $requirements
                as $item
            ) {

                if (
                    (int)
                    $item['id']
                    ===
                    (int)
                    $requirementId
                ) {

                    $requirement =
                        $item;

                    break;
                }
            }

            if (!$requirement) {
                continue;
            }

            if (
                !$file ||
                !$file->isValid() ||
                $file->hasMoved()
            ) {
                continue;
            }

            // =================================================
            // UKURAN
            // =================================================

            $maxSize =
                (
                    (int) (
                        $requirement[
                            'max_file_size'
                        ] ?? 2048
                    )
                ) * 1024;

            if (
                $file->getSize() >
                $maxSize
            ) {

                $serviceRequestModel
                    ->delete($ticketId);

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

            // =================================================
            // EXTENSION
            // =================================================

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
                    $allowedExtensions
                )
            ) {

                $serviceRequestModel
                    ->delete($ticketId);

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

            // =================================================
            // FOLDER
            // =================================================

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

            // =================================================
            // NAMA FILE
            // =================================================

            $newName =
                $file->getRandomName();

            $file->move(
                $uploadPath,
                $newName
            );

            // =================================================
            // DATABASE
            // =================================================

            $db->table(
                'service_request_files'
            )->insert([

                'service_request_id' =>
                    $ticketId,

                'requirement_id' =>
                    $requirementId,

                'original_name' =>
                    $file->getClientName(),

                'file_name' =>
                    $newName,

                'file_path' =>
                    'uploads/service_requests/' .
                    $ticketId .
                    '/' .
                    $newName,

                'file_extension' =>
                    $extension,

                'mime_type' =>
                    $file->getClientMimeType(),

                'file_size' =>
                    $file->getSize(),

                'is_verified' =>
                    0,

                'created_at' =>
                    $now,

                'updated_at' =>
                    $now,

            ]);
        }

        // =====================================================
        // TICKET TERBARU
        // =====================================================

        $ticket =
            $serviceRequestModel
                ->find($ticketId);

        $ticket['service_name'] =
            $service['name'] ?? '-';

        session()->set(
            'last_ticket',
            $ticket
        );

        // =====================================================
        // SUCCESS
        // =====================================================

        return redirect()->to(
            base_url(
                'dosen/ticket/success'
            )
        );
    }

    /**
     * =========================================================
     * DATA LAYANAN
     * =========================================================
     */
    public function layanan()
    {
        $check = $this->checkDosenRole();

        if ($check) {
            return $check;
        }

        return $this->response->setJSON([]);
    }

    /**
     * =========================================================
     * DRAFT
     * =========================================================
     */
    public function draft()
    {
        $check = $this->checkDosenRole();

        if ($check) {
            return $check;
        }

        $db = \Config\Database::connect();

        $userProfileId =
            session()->get(
                'user_profile_id'
            );

        if (empty($userProfileId)) {
            return redirect()
                ->to(
                    base_url(
                        'dosen/ticket/create'
                    )
                )
                ->with(
                    'error',
                    'Data profil dosen tidak ditemukan.'
                );
        }

        // =====================================================
        // DRAFT
        // =====================================================

        $builder =
            $db->table(
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

        $builder->where(
            'sr.status',
            'draft'
        );

        $builder->where(
            'sr.user_profile_id',
            $userProfileId
        );

        $builder->orderBy(
            'sr.created_at',
            'DESC'
        );

        $drafts =
            $builder
                ->get()
                ->getResultArray();

        // =====================================================
        // CEK DOKUMEN
        // =====================================================

        foreach (
            $drafts
            as &$draft
        ) {

            $requirements =
                $db->table(
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

            $totalRequired =
                count($requirements);

            if ($totalRequired === 0) {

                $draft[
                    'document_complete'
                ] = true;

                continue;
            }

            $uploaded =
                $db->table(
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

            $uploadedRequirementIds =
                [];

            foreach (
                $uploaded
                as $file
            ) {

                $uploadedRequirementIds[
                    $file['requirement_id']
                ] = true;
            }

            $complete = true;

            foreach (
                $requirements
                as $requirement
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

            $draft[
                'document_complete'
            ] = $complete;
        }

        unset($draft);

        return view(
            'dosen/ticket/draft',
            [
                'title' =>
                    'Draft Pengajuan',

                'drafts' =>
                    $drafts
            ]
        );
    }

   /**
 * =========================================================
 * DELETE DRAFT
 * =========================================================
 */
public function deleteDraft($id)
{
    $check = $this->checkDosenRole();

    if ($check) {
        return $check;
    }

    $db = \Config\Database::connect();

    $userProfileId =
        session()->get('user_profile_id');

    // =====================================================
    // CEK DRAFT
    // =====================================================

    $draft =
        $db->table('service_requests')
        ->where('id', $id)
        ->where('status', 'draft')
        ->where('user_profile_id', $userProfileId)
        ->get()
        ->getRowArray();

    if (!$draft) {

        return redirect()
            ->to(
                base_url(
                    'dosen/ticket/draft'
                )
            )
            ->with(
                'error',
                'Draft tidak ditemukan atau bukan milik Anda.'
            );
    }

    // =====================================================
    // FILE DOKUMEN
    // =====================================================

    $files =
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
        ->get()
        ->getResultArray();

    foreach ($files as $file) {

        $filePath =
            FCPATH .
            $file['file_path'];

        if (is_file($filePath)) {
            @unlink($filePath);
        }
    }

    // =====================================================
    // HAPUS DATA FILE
    // =====================================================

    $db->table(
        'service_request_files'
    )
    ->where(
        'service_request_id',
        $id
    )
    ->delete();

    // =====================================================
    // HAPUS DRAFT
    // =====================================================

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
    ->delete();

    // =====================================================
    // REDIRECT
    // =====================================================

    return redirect()
        ->to(
            base_url(
                'dosen/ticket/draft'
            )
        )
        ->with(
            'success',
            'Draft berhasil dihapus.'
        );
}

    /**
     * =========================================================
     * EDIT DRAFT
     * =========================================================
     */
    public function editDraft($id)
    {
        $check = $this->checkDosenRole();

        if ($check) {
            return $check;
        }

        $db = \Config\Database::connect();

        $userProfileId =
            session()->get(
                'user_profile_id'
            );

        if (empty($userProfileId)) {
            return redirect()
                ->to(
                    base_url(
                        'dosen/ticket/draft'
                    )
                )
                ->with(
                    'error',
                    'Data profil dosen tidak ditemukan.'
                );
        }

        // =====================================================
        // DRAFT
        // =====================================================

        $draft =
            $db->table(
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
            ->get()
            ->getRowArray();

        if (!$draft) {

            return redirect()
                ->to(
                    base_url(
                        'dosen/ticket/draft'
                    )
                )
                ->with(
                    'error',
                    'Draft tidak ditemukan atau bukan milik Anda.'
                );
        }

        // =====================================================
        // UNITS
        // =====================================================

        $units =
            $db->table(
                'master_service_units'
            )
            ->where(
                'is_active',
                1
            )
            ->orderBy(
                'sort_order',
                'ASC'
            )
            ->get()
            ->getResultArray();

        // =====================================================
        // SERVICES
        // =====================================================

        $services =
            $db->table(
                'master_services'
            )
            ->where(
                'is_active',
                1
            )
            ->orderBy(
                'sort_order',
                'ASC'
            )
            ->get()
            ->getResultArray();

        // =====================================================
        // REQUIREMENTS
        // =====================================================

        $requirements =
            $db->table(
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
            ->orderBy(
                'sort_order',
                'ASC'
            )
            ->get()
            ->getResultArray();

        // =====================================================
        // UPLOADED FILES
        // =====================================================

        $files =
            $db->table(
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

        $uploadedFiles = [];

        foreach (
            $files
            as $file
        ) {

            $uploadedFiles[
                $file['requirement_id']
            ] = $file;
        }

        return view(
            'dosen/ticket/edit_draft',
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

    /**
     * =========================================================
     * UPDATE DRAFT
     * =========================================================
     */
    public function updateDraft($id)
    {
        $check = $this->checkDosenRole();

        if ($check) {
            return $check;
        }

        $db = \Config\Database::connect();

        $userProfileId =
            session()->get(
                'user_profile_id'
            );

        $action =
            $this->request->getPost(
                'action'
            );

        // =====================================================
        // DRAFT
        // =====================================================

        $draft =
            $db->table(
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
            ->get()
            ->getRowArray();

        if (!$draft) {

            return redirect()
                ->to(
                    base_url(
                        'dosen/ticket/draft'
                    )
                )
                ->with(
                    'error',
                    'Draft tidak ditemukan.'
                );
        }

        // =====================================================
        // SERVICE BARU
        // =====================================================

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

        // =====================================================
        // CEK SERVICE
        // =====================================================

        $service =
            $db->table(
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

        // =====================================================
        // SERVICE BERUBAH?
        // =====================================================

        $serviceChanged =
            (int) $draft['service_id']
            !==
            (int) $serviceId;

        // =====================================================
        // UPDATE DRAFT
        // =====================================================

        $description =
            $this->request->getPost(
                'description'
            );

        if ($description === null) {
            $description =
                $this->request->getPost(
                    'keterangan'
                );
        }

        $db->table(
            'service_requests'
        )
        ->where(
            'id',
            $id
        )
        ->update([

            'service_id' =>
                $serviceId,

            'description' =>
                $description,

            'updated_at' =>
                date(
                    'Y-m-d H:i:s'
                ),

        ]);

        // =====================================================
        // KALAU SERVICE BERUBAH
        // HAPUS FILE LAMA
        // =====================================================

        if ($serviceChanged) {

            $oldFiles =
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
                ->get()
                ->getResultArray();

            foreach (
                $oldFiles
                as $oldFile
            ) {

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

                'deleted_at' =>
                    date(
                        'Y-m-d H:i:s'
                    ),

            ]);
        }

        // =====================================================
        // REQUIREMENTS BARU
        // =====================================================

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
            ->get()
            ->getResultArray();

        $requirementMap = [];

        foreach (
            $requirements
            as $requirement
        ) {

            $requirementMap[
                $requirement['id']
            ] = $requirement;
        }

        // =====================================================
        // FILE BARU
        // =====================================================

        $files =
            $this->request->getFiles();

        $documents =
            $files['dokumen'] ?? [];

        foreach (
            $documents
            as $requirementId => $file
        ) {

            if (
                !isset(
                    $requirementMap[
                        $requirementId
                    ]
                )
            ) {
                continue;
            }

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

            // =================================================
            // UKURAN
            // =================================================

            $maxSize =
                (
                    (int) (
                        $requirement[
                            'max_file_size'
                        ] ?? 2048
                    )
                ) * 1024;

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

            // =================================================
            // EXTENSION
            // =================================================

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
                    $allowedExtensions
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

            // =================================================
            // FILE LAMA
            // =================================================

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

                    'deleted_at' =>
                        date(
                            'Y-m-d H:i:s'
                        ),

                ]);
            }

            // =================================================
            // FOLDER
            // =================================================

            $uploadPath =
                FCPATH .
                'uploads/service_requests/' .
                $id .
                '/';

            if (!is_dir($uploadPath)) {

                mkdir(
                    $uploadPath,
                    0777,
                    true
                );
            }

            // =================================================
            // FILE
            // =================================================

            $newName =
                $file->getRandomName();

            $file->move(
                $uploadPath,
                $newName
            );

            $now =
                date(
                    'Y-m-d H:i:s'
                );

            // =================================================
            // DATABASE
            // =================================================

            $db->table(
                'service_request_files'
            )->insert([

                'service_request_id' =>
                    $id,

                'requirement_id' =>
                    $requirementId,

                'original_name' =>
                    $file->getClientName(),

                'file_name' =>
                    $newName,

                'file_path' =>
                    'uploads/service_requests/' .
                    $id .
                    '/' .
                    $newName,

                'file_extension' =>
                    $extension,

                'mime_type' =>
                    $file->getClientMimeType(),

                'file_size' =>
                    $file->getSize(),

                'is_verified' =>
                    0,

                'created_at' =>
                    $now,

                'updated_at' =>
                    $now,

            ]);
        }

        // =====================================================
        // SUBMIT
        // =====================================================

        if ($action === 'submit') {

            $now =
                date(
                    'Y-m-d H:i:s'
                );

            $ticketNumber =
                $draft['ticket_number'];

            if (empty($ticketNumber)) {

                $ticketNumber =
                    'ULT-DOSEN-' .
                    strtoupper(
                        bin2hex(
                            random_bytes(4)
                        )
                    );
            }

            // =================================================
            // VALIDASI REQUIREMENT WAJIB
            // =================================================

            foreach (
                $requirements
                as $requirement
            ) {

                if (
                    (int)
                    $requirement['is_required']
                    !== 1
                ) {
                    continue;
                }

                $uploaded =
                    $db->table(
                        'service_request_files'
                    )
                    ->where(
                        'service_request_id',
                        $id
                    )
                    ->where(
                        'requirement_id',
                        $requirement['id']
                    )
                    ->where(
                        'deleted_at',
                        null
                    )
                    ->countAllResults();

                if ($uploaded <= 0) {

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

            // =================================================
            // SUBMITTED
            // =================================================

            $db->table(
                'service_requests'
            )
            ->where(
                'id',
                $id
            )
            ->update([

                'ticket_number' =>
                    $ticketNumber,

                'status' =>
                    'submitted',

                'submitted_at' =>
                    $now,

                'updated_at' =>
                    $now,

            ]);

            // =================================================
            // TICKET
            // =================================================

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
                $service['name'] ?? '-';

            return view(
                'dosen/ticket/success',
                [
                    'title' =>
                        'Pengajuan Berhasil',

                    'ticket' =>
                        $ticket
                ]
            );
        }

        return redirect()
            ->to(
                base_url(
                    'dosen/ticket/draft'
                )
            )
            ->with(
                'success',
                'Draft berhasil diperbarui.'
            );
    }

    /**
     * =========================================================
     * DRAFT SUCCESS
     * =========================================================
     */
    public function draftSuccess()
    {
        $check = $this->checkDosenRole();

        if ($check) {
            return $check;
        }

        $draft =
            session()->get(
                'draft_success'
            );

        if (!$draft) {
            return redirect()
                ->to(
                    base_url(
                        'dosen/ticket/draft'
                    )
                );
        }

        return view(
            'dosen/ticket/draft_success',
            [
                'title' =>
                    'Draft Berhasil Disimpan',

                'draft' =>
                    $draft
            ]
        );
    }

/**
 * =========================================================
 * SUCCESS TIKET
 * =========================================================
 */
public function success()
{
    $check = $this->checkDosenRole();

    if ($check) {
        return $check;
    }

    $ticket = session()->get('last_ticket');

    if (!$ticket) {
        return redirect()
            ->to(base_url('dosen/ticket/create'))
            ->with(
                'error',
                'Data pengajuan tidak ditemukan.'
            );
    }

    return view(
        'dosen/ticket/success',
        [
            'title'  => 'Pengajuan Berhasil Dikirim',
            'ticket' => $ticket
        ]
    );
}

    /**
     * =========================================================
     * HISTORY
     * =========================================================
     */
    public function history()
    {
        $check = $this->checkDosenRole();

        if ($check) {
            return $check;
        }

        $db = \Config\Database::connect();

        $userId =
            session()->get(
                'user_id'
            );

        if (empty($userId)) {

            return redirect()
                ->to(
                    base_url('login')
                )
                ->with(
                    'error',
                    'Silakan login terlebih dahulu.'
                );
        }

        // =====================================================
        // PROFILE
        // =====================================================

        $userProfile =
            $db->table(
                'user_profiles'
            )
            ->where(
                'user_id',
                $userId
            )
            ->where(
                'deleted_at',
                null
            )
            ->get()
            ->getRowArray();

        if (!$userProfile) {

            return redirect()
                ->to(
                    base_url(
                        'dashboard-dosen'
                    )
                )
                ->with(
                    'error',
                    'Data profil dosen tidak ditemukan.'
                );
        }

        // =====================================================
        // TICKETS
        // =====================================================

        $tickets =
            $db->table(
                'service_requests sr'
            )
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

        foreach (
            $tickets
            as $ticket
        ) {

            $status =
                strtolower(
                    $ticket['status'] ?? ''
                );

            switch ($status) {

                case 'submitted':
                    $statusLabel =
                        'Submitted';
                    break;

                case 'processed':
                case 'diproses':
                    $statusLabel =
                        'Diproses';
                    break;

                case 'completed':
                case 'selesai':
                    $statusLabel =
                        'Selesai';
                    break;

                case 'rejected':
                case 'ditolak':
                    $statusLabel =
                        'Ditolak';
                    break;

                default:
                    $statusLabel =
                        ucfirst(
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

                $formattedDate =
                    date(
                        'd F Y H:i',
                        strtotime(
                            $createdAt
                        )
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
            'dosen/ticket/history',
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
    $check = $this->checkDosenRole();

    if ($check) {
        return $check;
    }

    $db = \Config\Database::connect();

    $userProfileId = session()->get('user_profile_id');

    if (empty($userProfileId)) {
        return redirect()
            ->to(base_url('dosen/ticket/history'))
            ->with(
                'error',
                'Data profil dosen tidak ditemukan.'
            );
    }

    // =====================================================
    // TIKET
    // =====================================================

    $ticket = $db->table('service_requests sr')
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
                    'dosen/ticket/history'
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

    $ticket['status_label'] = $statusLabel;

    // =====================================================
    // VIEW
    // =====================================================

    return view(
        'dosen/ticket/detail',
        [
            'title' => 'Detail Tiket',

            'ticket' =>
                $ticket,

            'files' =>
                $files
        ]
    );
}
    /**
     * =========================================================
     * REPLY
     * =========================================================
     */
    public function reply($id)
    {
        $check = $this->checkDosenRole();

        if ($check) {
            return $check;
        }

        // Untuk sementara mengikuti behavior
        // reply mahasiswa.

        session()->setFlashdata(
            'success',
            'Balasan berhasil dikirim.'
        );

        return redirect()->to(
            base_url(
                'dosen/ticket/detail/' .
                $id
            )
        );
    }
}