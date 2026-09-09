<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServiceRequestModel;
use App\Models\ServiceRequestFileModel;
use App\Models\MasterServiceUnitModel;
use App\Models\MasterServiceModel;
use App\Models\MasterServiceRequirementModel;
use App\Models\UserProfileModel;

class OrangTuaTicketController extends BaseController
{
   public function create()
{
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
    // AMBIL PROFILE ORANGTUA
    // =====================================================

    $profile = $profileModel
        ->where('user_id', $userId)
        ->where('deleted_at', null)
        ->first();

    if (!$profile) {
        return redirect()
            ->to(base_url('dashboard-orangtua'))
            ->with(
                'error',
                'Data profil Orangtua tidak ditemukan.'
            );
    }


    // =====================================================
    // PASTIKAN PROFILE ADALAH WALI
    // =====================================================

    $db = \Config\Database::connect();

    $applicantType = $db->table('master_applicant_types')
        ->where('id', $profile['applicant_type_id'] ?? 0)
        ->get()
        ->getRowArray();

    $applicantTypeCode = strtoupper(
        trim(
            (string) (
                $applicantType['code'] ?? ''
            )
        )
    );

    if ($applicantTypeCode !== 'WALI') {
        return redirect()
            ->to(base_url('login'))
            ->with(
                'error',
                'Akun ini bukan akun Orangtua/Wali.'
            );
    }


    // =====================================================
    // SIMPAN PROFILE ID KE SESSION
    // =====================================================

    $userProfileId = (int) $profile['id'];

    session()->set([
        'user_profile_id' => $userProfileId,
        'orangtua_profile' => $profile,
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
            ?? 'Orangtua',

        'nik' =>
            $profile['nik']
            ?? $user['nik']
            ?? $user['identity_number']
            ?? '',

        'email' =>
            $profile['email']
            ?? $user['email']
            ?? '',

        'telepon' =>
            $profile['phone']
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


    return view(
        'orangtua/ticket/create',
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
    // =====================================================
    // 1. CEK LOGIN
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
    // 2. MODEL
    // =====================================================

    $requestModel = new ServiceRequestModel();
    $fileModel = new ServiceRequestFileModel();
    $profileModel = new UserProfileModel();
    $serviceModel = new MasterServiceModel();
    $requirementModel = new MasterServiceRequirementModel();


    // =====================================================
    // 3. AMBIL PROFILE ORANGTUA / WALI
    // =====================================================

    $profile = $profileModel
        ->where('user_id', $userId)
        ->where('deleted_at', null)
        ->first();

    if (!$profile) {
        return redirect()
            ->to(base_url('orangtua/ticket/create'))
            ->with(
                'error',
                'Data profil Orangtua/Wali tidak ditemukan.'
            );
    }


    // =====================================================
    // 4. PASTIKAN AKUN WALI
    // =====================================================

    $db = \Config\Database::connect();

    $applicantType = $db->table('master_applicant_types')
        ->where(
            'id',
            (int) ($profile['applicant_type_id'] ?? 0)
        )
        ->get()
        ->getRowArray();

    $applicantTypeCode = strtoupper(
        trim(
            (string) (
                $applicantType['code'] ?? ''
            )
        )
    );

    if ($applicantTypeCode !== 'WALI') {
        return redirect()
            ->to(base_url('login'))
            ->with(
                'error',
                'Akun ini bukan akun Orangtua/Wali.'
            );
    }


    // =====================================================
    // 5. AMBIL INPUT FORM
    // =====================================================

    $serviceId = (int) $this->request->getPost(
        'jenis_layanan'
    );

    $keterangan = trim(
        (string) $this->request->getPost(
            'keterangan'
        )
    );

    $action = strtolower(
        trim(
            (string) $this->request->getPost(
                'action'
            )
        )
    );


    // =====================================================
    // 6. VALIDASI JENIS LAYANAN
    // =====================================================

    if ($serviceId <= 0) {
        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Silakan pilih jenis layanan terlebih dahulu.'
            );
    }


    // =====================================================
    // 7. AMBIL SERVICE
    // =====================================================

    $service = $serviceModel
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
                'Jenis layanan yang dipilih tidak tersedia.'
            );
    }


    // =====================================================
    // 8. AMBIL PERSYARATAN AKTIF
    // =====================================================

    $requirements = $requirementModel
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


    // =====================================================
    // 9. AMBIL FILE DARI FORM
    // =====================================================

    $files = $this->request->getFiles();

    $documents = $files['dokumen'] ?? [];


    // =====================================================
    // 10. VALIDASI FILE WAJIB
    // =====================================================

    foreach ($requirements as $requirement) {

        $requirementId = (int) $requirement['id'];

        $isRequired = (
            (int) ($requirement['is_required'] ?? 0)
        ) === 1;

        if (!$isRequired) {
            continue;
        }


        $uploadedFile =
            $documents[$requirementId]
            ?? null;


        if (
            !$uploadedFile ||
            !$uploadedFile->isValid()
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Dokumen wajib "' .
                    ($requirement['name'] ?? 'Persyaratan') .
                    '" harus diunggah.'
                );

        }

    }


    // =====================================================
    // 11. GENERATE NOMOR TIKET
    // =====================================================

    $ticketNumber =
        'ULT-ORT-' .
        strtoupper(
            bin2hex(
                random_bytes(5)
            )
        );


    // =====================================================
    // 12. INSERT SERVICE REQUEST
    // =====================================================

    $requestData = [

        'ticket_number' =>
            $ticketNumber,

        'user_profile_id' =>
            (int) $profile['id'],

        'service_id' =>
            $serviceId,

        'title' =>
            'Pengajuan Layanan Orangtua',

        'description' =>
            $keterangan,

        'status' =>
            'submitted',

        'priority' =>
            'normal',

        'submitted_at' =>
            date('Y-m-d H:i:s'),

        'created_at' =>
            date('Y-m-d H:i:s'),

        'updated_at' =>
            date('Y-m-d H:i:s'),

    ];


    $requestModel->insert(
        $requestData
    );


    $ticketId =
        $requestModel->getInsertID();


    if (!$ticketId) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Pengajuan gagal disimpan.'
            );

    }


    // =====================================================
    // 13. FOLDER UPLOAD
    // =====================================================

    $uploadPath =
        FCPATH .
        'uploads/service_requests/' .
        $ticketId;


    if (!is_dir($uploadPath)) {

        mkdir(
            $uploadPath,
            0755,
            true
        );

    }


    // =====================================================
    // 14. SIMPAN DOKUMEN
    // =====================================================

    foreach ($documents as $requirementId => $uploadedFile) {

        if (
            !$uploadedFile ||
            !$uploadedFile->isValid() ||
            $uploadedFile->getError() === UPLOAD_ERR_NO_FILE
        ) {
            continue;
        }


        $requirementId =
            (int) $requirementId;


        // =============================================
        // PASTIKAN REQUIREMENT MILIK SERVICE
        // =============================================

        $requirement = null;

        foreach ($requirements as $item) {

            if (
                (int) $item['id'] ===
                $requirementId
            ) {

                $requirement = $item;

                break;

            }

        }


        if (!$requirement) {

            continue;

        }


        // =============================================
        // CEK FILE VALID
        // =============================================

        if (!$uploadedFile->isValid()) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Terdapat dokumen yang gagal diunggah.'
                );

        }

// =============================================
// CEK UKURAN FILE
// =============================================

// Ukuran file hasil upload dari PHP = BYTE
$fileSize = (int) $uploadedFile->getSize();

// Ambil batas ukuran dari database
$maxFileSize = (int) (
    $requirement['max_file_size'] ?? 2
);

// Jika database menyimpan ukuran dalam MB,
// konversi ke BYTE.
$maxSize = $maxFileSize * 1024 * 1024;


if ($fileSize > $maxSize) {

    return redirect()
        ->back()
        ->withInput()
        ->with(
            'error',
            'Ukuran dokumen "' .
            ($requirement['name'] ?? 'dokumen') .
            '" melebihi batas maksimal ' .
            $maxFileSize .
            ' MB.'
        );

}

        // =============================================
        // CEK EXTENSION
        // =============================================

        $extension =
            strtolower(
                $uploadedFile->getClientExtension()
            );


        $allowedExtensions =
            $requirement['allowed_extensions']
            ?? 'pdf,jpg,jpeg,png,doc,docx';


        if (is_string($allowedExtensions)) {

            $decoded =
                json_decode(
                    $allowedExtensions,
                    true
                );


            if (is_array($decoded)) {

                $allowedExtensions =
                    $decoded;

            } else {

                $allowedExtensions =
                    preg_split(
                        '/[,|]+/',
                        $allowedExtensions
                    );

            }

        }


        $allowedExtensions =
            array_map(
                function ($ext) {

                    return ltrim(
                        strtolower(
                            trim($ext)
                        ),
                        '.'
                    );

                },
                $allowedExtensions
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
                    'Format dokumen "' .
                    ($requirement['name'] ?? 'dokumen') .
                    '" tidak diperbolehkan.'
                );

        }


        // =============================================
        // GENERATE NAMA FILE
        // =============================================

        $newName =
            $uploadedFile->getRandomName();


        // =============================================
        // PINDAHKAN FILE
        // =============================================

        $uploadedFile->move(
            $uploadPath,
            $newName
        );


// =============================================
// SIMPAN METADATA
// =============================================

$fileModel->insert([

    'service_request_id' =>
        $ticketId,

    'requirement_id' =>
        $requirementId,

    'original_name' =>
        $uploadedFile->getClientName(),

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
        $uploadedFile->getClientMimeType(),

    'file_size' =>
        $fileSize,

    'is_verified' =>
        0,

    'created_at' =>
        date('Y-m-d H:i:s'),

    'updated_at' =>
        date('Y-m-d H:i:s'),

]);

    }


    // =====================================================
    // 15. SIMPAN TIKET TERAKHIR
    // =====================================================

    session()->set(
        'last_ticket',
        $ticketNumber
    );


    // =====================================================
    // 16. REDIRECT SUCCESS
    // =====================================================

    return redirect()
        ->to(
            base_url(
                'orangtua/ticket/success'
            )
        )
        ->with(
            'success',
            'Pengajuan layanan berhasil dikirim.'
        );
}

public function tracking()
{
    $data['tickets'] = [

        [
            'nomor' => 'ULT-ORT-202608070001',
            'layanan' => 'Surat Aktif Kuliah',
            'unit' => 'Akademik',
            'tanggal' => '07 Agustus 2026',
            'status' => 'Diproses'
        ],

        [
            'nomor' => 'ULT-ORT-202608060002',
            'layanan' => 'Informasi UKT/SPP',
            'unit' => 'Keuangan',
            'tanggal' => '06 Agustus 2026',
            'status' => 'Selesai'
        ]

    ];

    return view('orangtua/tracking', $data);
}

public function detail($id)
{
    // =====================================================
    // 1. CEK LOGIN
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
                'Sesi login tidak ditemukan.'
            );
    }


    // =====================================================
    // 2. PROFILE WALI
    // =====================================================

    $profileModel = new UserProfileModel();

    $profile = $profileModel
        ->where('user_id', $userId)
        ->where('deleted_at', null)
        ->first();

    if (!$profile) {
        return redirect()
            ->to(base_url('orangtua/ticket/history'))
            ->with(
                'error',
                'Data profil Orangtua/Wali tidak ditemukan.'
            );
    }


    // =====================================================
    // 3. PASTIKAN ID VALID
    // =====================================================

    $ticketId = (int) $id;

    if ($ticketId <= 0) {
        return redirect()
            ->to(base_url('orangtua/ticket/history'))
            ->with(
                'error',
                'ID tiket tidak valid.'
            );
    }


    // =====================================================
    // 4. AMBIL TIKET
    // =====================================================

    $db = \Config\Database::connect();

    $ticket = $db
        ->table('service_requests sr')
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

            up.name AS applicant_name,
            up.nim AS student_nim,
            up.student_name,

            ms.name AS service_name,

            msu.name AS unit_name
        ')
        ->join(
            'user_profiles up',
            'up.id = sr.user_profile_id',
            'left'
        )
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
            $ticketId
        )
        ->where(
            'sr.user_profile_id',
            (int) $profile['id']
        )
        ->where(
            'sr.deleted_at',
            null
        )
        ->get()
        ->getRowArray();


    // =====================================================
    // 5. TIKET TIDAK DITEMUKAN
    // =====================================================

    if (!$ticket) {
        return redirect()
            ->to(base_url('orangtua/ticket/history'))
            ->with(
                'error',
                'Tiket tidak ditemukan atau bukan milik akun Anda.'
            );
    }


    // =====================================================
    // 6. AMBIL DOKUMEN
    // =====================================================

    $files = $db
        ->table('service_request_files srf')
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
            $ticketId
        )
        ->orderBy(
            'srf.id',
            'ASC'
        )
        ->get()
        ->getResultArray();


    // =====================================================
    // 7. TAMBAHKAN ALIAS UNTUK VIEW
    // =====================================================

    $ticket['nama_ortu'] =
        $ticket['applicant_name']
        ?? $profile['name']
        ?? '-';

    $ticket['nim'] =
        $ticket['student_nim']
        ?? $profile['nim']
        ?? '-';


    // =====================================================
    // 8. DATA VIEW
    // =====================================================

    $data = [

        'title' =>
            'Detail Tiket',

        'ticket' =>
            $ticket,

        'files' =>
            $files,

        'profile' =>
            $profile,

    ];


    // =====================================================
    // 9. VIEW
    // =====================================================

    return view(
        'orangtua/ticket/detail',
        $data
    );
}

public function history()
{
    // =====================================================
    // 1. CEK LOGIN
    // =====================================================

    $userId = (int) session()->get('user_id');

    if ($userId <= 0) {
        return redirect()
            ->to(base_url('login'))
            ->with(
                'error',
                'Sesi login tidak ditemukan. Silakan login kembali.'
            );
    }

    // =====================================================
    // 2. AMBIL PROFILE ORANGTUA
    // =====================================================

    $profileModel = new UserProfileModel();

    $profile = $profileModel
        ->where('user_id', $userId)
        ->where('deleted_at', null)
        ->first();

    if (!$profile) {
        return redirect()
            ->to(base_url('dashboard-orangtua'))
            ->with(
                'error',
                'Data profil Orangtua tidak ditemukan.'
            );
    }

    // =====================================================
    // 3. VALIDASI WALI
    // =====================================================

    $db = \Config\Database::connect();

    $applicantType = $db
        ->table('master_applicant_types')
        ->where(
            'id',
            $profile['applicant_type_id'] ?? 0
        )
        ->where('is_active', 1)
        ->get()
        ->getRowArray();

    $applicantTypeCode = strtoupper(
        trim(
            (string) (
                $applicantType['code'] ?? ''
            )
        )
    );

    if ($applicantTypeCode !== 'WALI') {
        return redirect()
            ->to(base_url('login'))
            ->with(
                'error',
                'Akun ini bukan akun Orangtua/Wali.'
            );
    }

    // =====================================================
    // 4. AMBIL RIWAYAT TIKET
    // =====================================================

    $userProfileId = (int) $profile['id'];

    $tickets = $db
        ->table('service_requests sr')
        ->select('
            sr.id,
            sr.ticket_number,
            sr.service_id,
            sr.title,
            sr.description,
            sr.status,
            sr.priority,
            sr.submitted_at,
            sr.created_at,
            sr.updated_at,
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
            'sr.user_profile_id',
            $userProfileId
        )
        ->where(
            'sr.deleted_at IS NULL',
            null,
            false
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
    // 5. FORMAT DATA UNTUK VIEW
    // =====================================================

    $riwayat = [];

    foreach ($tickets as $ticket) {

        $status = strtolower(
            trim(
                (string) (
                    $ticket['status'] ?? ''
                )
            )
        );

        $statusLabel = 'Diajukan';
        $statusClass = 'status-submitted';

        if (
            in_array(
                $status,
                [
                    'verification',
                    'verified',
                    'assigned',
                    'processing',
                    'processed',
                    'in_progress',
                    'diproses',
                ],
                true
            )
        ) {
            $statusLabel = 'Diproses';
            $statusClass = 'status-processing';

        } elseif (
            in_array(
                $status,
                [
                    'revision',
                    'revisi',
                ],
                true
            )
        ) {
            $statusLabel = 'Perlu Revisi';
            $statusClass = 'status-revision';

        } elseif (
            in_array(
                $status,
                [
                    'completed',
                    'selesai',
                ],
                true
            )
        ) {
            $statusLabel = 'Selesai';
            $statusClass = 'status-completed';

        } elseif (
            in_array(
                $status,
                [
                    'rejected',
                    'ditolak',
                ],
                true
            )
        ) {
            $statusLabel = 'Ditolak';
            $statusClass = 'status-rejected';

        } elseif (
            in_array(
                $status,
                [
                    'cancelled',
                    'dibatalkan',
                ],
                true
            )
        ) {
            $statusLabel = 'Dibatalkan';
            $statusClass = 'status-rejected';
        }

        $riwayat[] = [
            'id' => $ticket['id'],

            'nomor' =>
                $ticket['ticket_number'] ?? '-',

            'layanan' =>
                $ticket['service_name'] ?? '-',

            'unit_layanan' =>
                $ticket['unit_name'] ?? '-',

            'keterangan' =>
                $ticket['description'] ?? '',

            'created_at' =>
                $ticket['created_at'] ?? null,

            'status' =>
                $ticket['status'] ?? '',

            'status_label' =>
                $statusLabel,

            'status_class' =>
                $statusClass,
        ];
    }

    // =====================================================
    // 6. DATA VIEW
    // =====================================================

    $data = [
        'title' => 'Riwayat Pengajuan',
        'riwayat' => $riwayat,
        'tickets' => $riwayat,
    ];

    return view(
        'orangtua/ticket/history',
        $data
    );
}

public function success()
{
    // =====================================================
    // 1. CEK LOGIN
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
    // 2. AMBIL PROFILE ORANGTUA / WALI
    // =====================================================

    $profileModel = new UserProfileModel();

    $profile = $profileModel
        ->where('user_id', $userId)
        ->where('deleted_at', null)
        ->first();

    if (!$profile) {
        return redirect()
            ->to(base_url('dashboard-orangtua'))
            ->with(
                'error',
                'Data profil Orangtua/Wali tidak ditemukan.'
            );
    }


    // =====================================================
    // 3. AMBIL NOMOR TIKET TERAKHIR
    // =====================================================

    $ticketNumber =
        session()->get('last_ticket');

    if (empty($ticketNumber)) {

        return redirect()
            ->to(base_url('orangtua/ticket/history'))
            ->with(
                'error',
                'Nomor tiket terakhir tidak ditemukan.'
            );

    }


    // =====================================================
    // 4. AMBIL DATA TIKET DARI DATABASE
    // =====================================================

    $db = \Config\Database::connect();

    $ticket = $db
        ->table('service_requests sr')
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

            msu.name AS service_unit_name
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
            'sr.ticket_number',
            $ticketNumber
        )
        ->where(
            'sr.user_profile_id',
            (int) $profile['id']
        )
        ->where(
            'sr.deleted_at',
            null
        )
        ->get()
        ->getRowArray();


    // =====================================================
    // 5. TIKET TIDAK DITEMUKAN
    // =====================================================

    if (!$ticket) {

        return redirect()
            ->to(base_url('orangtua/ticket/history'))
            ->with(
                'error',
                'Data tiket tidak ditemukan.'
            );

    }


    // =====================================================
    // 6. DATA VIEW
    // =====================================================

    $data = [

        'title' =>
            'Pengajuan Berhasil',

        'ticket' =>
            $ticket,

        'profile' =>
            $profile,

    ];


    // =====================================================
    // 7. TAMPILKAN SUCCESS
    // =====================================================

    return view(
        'orangtua/ticket/success',
        $data
    );
}

public function draft()
{
    $data['draft'] = [

        [
            'id' => 1,
            'unit' => 'Akademik',
            'layanan' => 'Surat Aktif Kuliah',
            'keterangan' => 'Mohon dibuatkan surat aktif kuliah.',
            'dokumen' => 'Tidak ada',
            'status' => 'Draft',
            'tanggal' => '2026-08-07 10:30:00'
        ],

        [
            'id' => 2,
            'unit' => 'Kemahasiswaan',
            'layanan' => 'Beasiswa',
            'keterangan' => 'Pengajuan beasiswa mahasiswa.',
            'dokumen' => 'kip.pdf',
            'status' => 'Draft',
            'tanggal' => '2026-08-07 11:00:00'
        ]

    ];

    return view('orangtua/ticket/draft', $data);
}
}