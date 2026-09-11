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

    $ticketNumber = session()->get('last_ticket');

    // last_ticket bisa berupa array
    if (is_array($ticketNumber)) {
        $ticketNumber = $ticketNumber['ticket_number'] ?? null;
    }

    // jaga-jaga kalau berupa object
    if (is_object($ticketNumber)) {
        $ticketNumber = $ticketNumber->ticket_number ?? null;
    }

    // pastikan akhirnya string
    if ($ticketNumber !== null) {
        $ticketNumber = trim((string) $ticketNumber);
    }

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
        'title'   => 'Pengajuan Berhasil',
        'ticket'  => $ticket,
        'profile' => $profile,
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
    $db = \Config\Database::connect();

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
                'Silakan login terlebih dahulu.'
            );
    }


    // =====================================================
    // PROFILE WALI
    // =====================================================

    $profile = $profileModel
        ->where(
            'user_id',
            $userId
        )
        ->where(
            'deleted_at',
            null
        )
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
    // PASTIKAN WALI
    // =====================================================

    $applicantType = $db
        ->table('master_applicant_types')
        ->where(
            'id',
            (int) (
                $profile['applicant_type_id']
                ?? 0
            )
        )
        ->get()
        ->getRowArray();


    $applicantTypeCode = strtoupper(
        trim(
            (string) (
                $applicantType['code']
                ?? ''
            )
        )
    );


    if (
        $applicantTypeCode !== 'WALI'
    ) {

        return redirect()
            ->to(base_url('login'))
            ->with(
                'error',
                'Akun ini bukan akun Orangtua/Wali.'
            );
    }


    $userProfileId =
        (int) $profile['id'];


    // =====================================================
    // QUERY DRAFT
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

        'ms.name AS service_name',

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


    $builder->where(
        'sr.status',
        'draft'
    );


    $builder->where(
        'sr.user_profile_id',
        $userProfileId
    );


// Hanya draft yang belum dihapus
$builder->where('sr.status', 'draft');
$builder->where('sr.deleted_at', null);


    $builder->orderBy(
        'sr.created_at',
        'DESC'
    );


    $drafts =
        $builder
            ->get()
            ->getResultArray();


    // =====================================================
    // CEK KELENGKAPAN DOKUMEN
    // =====================================================

    foreach (
        $drafts
        as &$draft
    ) {

        // ================================================
        // REQUIREMENT WAJIB
        // ================================================

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
            ->where(
                'deleted_at',
                null
            )
            ->get()
            ->getResultArray();


        $totalRequired =
            count($requirements);


        if (
            $totalRequired === 0
        ) {

            $draft[
                'document_complete'
            ] = true;

            continue;
        }


        // ================================================
        // FILE SUDAH UPLOAD
        // ================================================

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


        // ================================================
        // CEK
        // ================================================

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


    // =====================================================
    // VIEW
    // =====================================================

    return view(
        'orangtua/ticket/draft',
        [
            'title' =>
                'Draft Pengajuan',

            'drafts' =>
                $drafts,

        ]
    );
}

public function deleteDraft($id)
{
    $db = \Config\Database::connect();

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
                'Silakan login terlebih dahulu.'
            );
    }


    // =====================================================
    // 2. AMBIL PROFILE WALI
    // =====================================================

    $profileModel = new UserProfileModel();

    $profile = $profileModel
        ->where(
            'user_id',
            $userId
        )
        ->where(
            'deleted_at',
            null
        )
        ->first();

    if (!$profile) {

        return redirect()
            ->to(
                base_url(
                    'orangtua/ticket/draft'
                )
            )
            ->with(
                'error',
                'Data profil Orangtua/Wali tidak ditemukan.'
            );
    }


    // =====================================================
    // 3. PASTIKAN WALI
    // =====================================================

    $applicantType = $db
        ->table('master_applicant_types')
        ->where(
            'id',
            (int) (
                $profile['applicant_type_id']
                ?? 0
            )
        )
        ->get()
        ->getRowArray();

    $applicantTypeCode = strtoupper(
        trim(
            (string) (
                $applicantType['code']
                ?? ''
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
    // 4. PROFILE ID
    // =====================================================

    $userProfileId = (int) $profile['id'];


    // =====================================================
    // 5. VALIDASI ID DRAFT
    // =====================================================

    $draftId = (int) $id;

    if ($draftId <= 0) {

        return redirect()
            ->to(
                base_url(
                    'orangtua/ticket/draft'
                )
            )
            ->with(
                'error',
                'ID draft tidak valid.'
            );
    }


    // =====================================================
    // 6. CEK DRAFT
    // =====================================================

    $draft = $db
        ->table('service_requests')
        ->where(
            'id',
            $draftId
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
                    'orangtua/ticket/draft'
                )
            )
            ->with(
                'error',
                'Draft tidak ditemukan atau bukan milik Anda.'
            );
    }


    // =====================================================
    // 7. HAPUS DRAFT
    // =====================================================

    $db
        ->table('service_requests')
        ->where(
            'id',
            $draftId
        )
        ->where(
            'user_profile_id',
            $userProfileId
        )
        ->where(
            'status',
            'draft'
        )
        ->update([
            'deleted_at' => date(
                'Y-m-d H:i:s'
            )
        ]);


    // =====================================================
    // 8. REDIRECT
    // =====================================================

    return redirect()
        ->to(
            base_url(
                'orangtua/ticket/draft'
            )
        )
        ->with(
            'success',
            'Draft berhasil dihapus.'
        );
}

public function saveDraft()
{
    $db = \Config\Database::connect();

    $serviceRequestModel = new ServiceRequestModel();
    $profileModel = new UserProfileModel();

    // =====================================================
    // 1. USER LOGIN
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
    // 2. PROFILE ORANGTUA / WALI
    // =====================================================

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
                'Data profil Orangtua/Wali tidak ditemukan.'
            );
    }


    // =====================================================
    // 3. PASTIKAN AKUN WALI
    // =====================================================

    $applicantType = $db
        ->table('master_applicant_types')
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
    // 4. SIMPAN PROFILE ID KE SESSION
    // =====================================================

    $userProfileId = (int) $profile['id'];

    session()->set([
        'user_profile_id' => $userProfileId,
        'orangtua_profile' => $profile,
    ]);


    // =====================================================
    // 5. AMBIL SERVICE
    // =====================================================

    $serviceId = (int) $this->request->getPost(
        'jenis_layanan'
    );

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
    // 6. PASTIKAN SERVICE AKTIF
    // =====================================================

    $service = $db
        ->table('master_services')
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


    // =====================================================
    // 7. DATA DRAFT
    // =====================================================

    $now = date('Y-m-d H:i:s');

    $ticketNumber =
        'ULT-ORT-' .
        strtoupper(
            bin2hex(
                random_bytes(5)
            )
        );


    $data = [

        'ticket_number' =>
            $ticketNumber,

        'user_profile_id' =>
            $userProfileId,

        'service_id' =>
            $serviceId,

        'title' =>
            'Pengajuan Layanan Orangtua',

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


    // =====================================================
    // 8. SIMPAN SERVICE REQUEST
    // =====================================================

    $serviceRequestModel->insert(
        $data
    );

    $serviceRequestId =
        $serviceRequestModel->getInsertID();


    if (!$serviceRequestId) {
        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Draft gagal disimpan.'
            );
    }


    // =====================================================
    // 9. FILE UPLOAD
    // =====================================================

    $files =
        $this->request->getFiles();

    $documents =
        $files['dokumen']
        ?? [];


    if (!empty($documents)) {

        // ================================================
        // AMBIL REQUIREMENT
        // ================================================

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


        $requirementMap = [];


        foreach (
            $requirements
            as $requirement
        ) {

            $requirementMap[
                $requirement['id']
            ] = $requirement;

        }


        // ================================================
        // LOOP FILE
        // ================================================

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


            // ==========================================
            // CEK UKURAN
            // Sama seperti Mahasiswa:
            // max_file_size disimpan dalam KB
            // ==========================================

            $maxSize =
                (
                    (int) (
                        $requirement[
                            'max_file_size'
                        ]
                        ?? 2048
                    )
                ) * 1024;


            if (
                $file->getSize()
                > $maxSize
            ) {
                continue;
            }


            // ==========================================
            // CEK EXTENSION
            // ==========================================

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
                        strtolower(
                            $allowed
                        )
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


            // ==========================================
            // FOLDER
            // ==========================================

            $uploadPath =
                FCPATH .
                'uploads/service_requests/' .
                $serviceRequestId .
                '/';


            if (
                !is_dir(
                    $uploadPath
                )
            ) {

                mkdir(
                    $uploadPath,
                    0777,
                    true
                );

            }


            // ==========================================
            // NAMA FILE
            // ==========================================

            $newName =
                $file->getRandomName();


            // ==========================================
            // PINDAHKAN
            // ==========================================

            $file->move(
                $uploadPath,
                $newName
            );


            // ==========================================
            // SIMPAN DATABASE
            // ==========================================

            $db->table(
                'service_request_files'
            )
            ->insert([

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


    // =====================================================
    // 10. REDIRECT DRAFT
    // =====================================================

    return redirect()
        ->to(
            base_url(
                'orangtua/ticket/draft'
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

    $profileModel = new UserProfileModel();


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
                'Silakan login terlebih dahulu.'
            );

    }


    // =====================================================
    // 2. AMBIL PROFILE WALI
    // =====================================================

    $profile = $profileModel
        ->where(
            'user_id',
            $userId
        )
        ->where(
            'deleted_at',
            null
        )
        ->first();


    if (!$profile) {

        return redirect()
            ->to(
                base_url(
                    'orangtua/ticket/draft'
                )
            )
            ->with(
                'error',
                'Data profil Orangtua/Wali tidak ditemukan.'
            );

    }


    // =====================================================
    // 3. PASTIKAN WALI
    // =====================================================

    $applicantType = $db
        ->table('master_applicant_types')
        ->where(
            'id',
            (int) (
                $profile['applicant_type_id']
                ?? 0
            )
        )
        ->get()
        ->getRowArray();


    $applicantTypeCode = strtoupper(
        trim(
            (string) (
                $applicantType['code']
                ?? ''
            )
        )
    );


    if (
        $applicantTypeCode !== 'WALI'
    ) {

        return redirect()
            ->to(base_url('login'))
            ->with(
                'error',
                'Akun ini bukan akun Orangtua/Wali.'
            );

    }


    // =====================================================
    // 4. PROFILE ID
    // =====================================================

    $userProfileId =
        (int) $profile['id'];


    // =====================================================
    // 5. VALIDASI ID DRAFT
    // =====================================================

    $draftId =
        (int) $id;


    if ($draftId <= 0) {

        return redirect()
            ->to(
                base_url(
                    'orangtua/ticket/draft'
                )
            )
            ->with(
                'error',
                'ID draft tidak valid.'
            );

    }


    // =====================================================
    // 6. AMBIL DRAFT
    // =====================================================

    $draft = $db
        ->table(
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
            $draftId
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
                    'orangtua/ticket/draft'
                )
            )
            ->with(
                'error',
                'Draft tidak ditemukan atau bukan milik Anda.'
            );

    }


    // =====================================================
    // 7. SEMUA UNIT LAYANAN
    // =====================================================

    $units = $db
        ->table(
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


    // =====================================================
    // 8. SEMUA JENIS LAYANAN
    // =====================================================

    $services = $db
        ->table(
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


    // =====================================================
    // 9. PERSYARATAN SESUAI SERVICE DRAFT
    // =====================================================

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
            'deleted_at',
            null
        )
        ->orderBy(
            'sort_order',
            'ASC'
        )
        ->get()
        ->getResultArray();


    // =====================================================
    // 10. FILE YANG SUDAH DIUPLOAD
    // =====================================================

    $files = $db
        ->table(
            'service_request_files'
        )
        ->where(
            'service_request_id',
            $draftId
        )
        ->where(
            'deleted_at',
            null
        )
        ->get()
        ->getResultArray();


    // =====================================================
    // 11. MAP FILE BERDASARKAN REQUIREMENT
    // =====================================================

    $uploadedFiles = [];


    foreach (
        $files
        as $file
    ) {

        $uploadedFiles[
            $file['requirement_id']
        ] = $file;

    }


    // =====================================================
    // 12. DATA VIEW
    // =====================================================

    return view(
        'orangtua/ticket/edit_draft',
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

            'profile' =>
                $profile,
        ]
    );
}

public function updateDraft($id)
{
    $db = \Config\Database::connect();

    // ==========================================
    // USER PROFILE LOGIN
    // ==========================================
    $userProfileId = session()->get('user_profile_id');

    $action = $this->request->getPost('action');

    // ==========================================
    // CEK USER PROFILE
    // ==========================================
    if (empty($userProfileId)) {
        return redirect()
            ->to(base_url('login'))
            ->with(
                'error',
                'Data profil pengguna tidak ditemukan. Silakan login kembali.'
            );
    }

    // ==========================================
    // AMBIL DRAFT
    // ==========================================
    $draft = $db->table('service_requests')
        ->where('id', $id)
        ->where('status', 'draft')
        ->where('user_profile_id', $userProfileId)
        ->where('deleted_at', null)
        ->get()
        ->getRowArray();

    if (!$draft) {
        return redirect()
            ->to(base_url('orangtua/ticket/draft'))
            ->with(
                'error',
                'Draft tidak ditemukan atau bukan milik Anda.'
            );
    }

    // ==========================================
    // SERVICE BARU
    // ==========================================
    $serviceId = $this->request->getPost('jenis_layanan');

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
    // CEK APAKAH SERVICE BERUBAH
    // ==========================================
    $serviceChanged =
        (int) $draft['service_id'] !== (int) $serviceId;

    // ==========================================
    // UPDATE DATA DRAFT
    // ==========================================
    $db->table('service_requests')
        ->where('id', $id)
        ->where('user_profile_id', $userProfileId)
        ->update([
            'service_id'  => $serviceId,
            'description' => $this->request->getPost('description'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

    // ==========================================
    // KALAU SERVICE BERUBAH
    // HAPUS / SOFT DELETE FILE LAMA
    // ==========================================
    if ($serviceChanged) {

        $oldFiles = $db->table('service_request_files')
            ->where('service_request_id', $id)
            ->where('deleted_at', null)
            ->get()
            ->getResultArray();

        foreach ($oldFiles as $oldFile) {

            $oldPath = FCPATH . $oldFile['file_path'];

            if (is_file($oldPath)) {
                @unlink($oldPath);
            }
        }

        $db->table('service_request_files')
            ->where('service_request_id', $id)
            ->where('deleted_at', null)
            ->update([
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);
    }

    // ==========================================
    // AMBIL PERSYARATAN SERVICE BARU
    // ==========================================
    $requirements = $db->table('master_service_requirements')
        ->where('service_id', $serviceId)
        ->where('is_active', 1)
        ->where('deleted_at', null)
        ->orderBy('sort_order', 'ASC')
        ->get()
        ->getResultArray();

    // ==========================================
    // BUAT MAP REQUIREMENT
    // ==========================================
    $requirementMap = [];

    foreach ($requirements as $requirement) {
        $requirementMap[$requirement['id']] = $requirement;
    }

    // ==========================================
    // FILE BARU
    // ==========================================
    $files = $this->request->getFiles();

    $documents = $files['dokumen'] ?? [];

    foreach ($documents as $requirementId => $file) {

        // Requirement harus milik service ini
        if (!isset($requirementMap[$requirementId])) {
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

        $requirement = $requirementMap[$requirementId];

        // ======================================
        // CEK UKURAN FILE
        // max_file_size = KB
        // ======================================
        $maxSize =
            ((int) ($requirement['max_file_size'] ?? 2048))
            * 1024;

        if ($file->getSize() > $maxSize) {

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
        $extension = strtolower(
            $file->getClientExtension()
        );

        $allowed =
            $requirement['allowed_extensions']
            ?? 'pdf,jpg,jpeg,png,doc,docx,xls,xlsx';

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

        // ======================================
        // FILE LAMA UNTUK REQUIREMENT INI
        // ======================================
        $oldFile = $db->table('service_request_files')
            ->where('service_request_id', $id)
            ->where('requirement_id', $requirementId)
            ->where('deleted_at', null)
            ->get()
            ->getRowArray();

        if ($oldFile) {

            $oldPath = FCPATH . $oldFile['file_path'];

            if (is_file($oldPath)) {
                @unlink($oldPath);
            }

            // Soft delete file lama
            $db->table('service_request_files')
                ->where('id', $oldFile['id'])
                ->update([
                    'deleted_at' => date('Y-m-d H:i:s'),
                ]);
        }

        // ======================================
        // FOLDER UPLOAD
        // ======================================
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

        // ======================================
        // NAMA FILE
        // ======================================
        $newName = $file->getRandomName();

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
        $now = date('Y-m-d H:i:s');

        $db->table('service_request_files')
            ->insert([
                'service_request_id' => $id,
                'requirement_id'     => $requirementId,
                'original_name'      => $file->getClientName(),
                'file_name'          => $newName,
                'file_path'          =>
                    'uploads/service_requests/' .
                    $id .
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

// ==========================================
// JIKA USER MEMILIH AJUKAN
// ==========================================
if ($action === 'submit') {

    $now = date('Y-m-d H:i:s');

    // ======================================
    // PAKAI NOMOR TIKET YANG SUDAH ADA
    // ======================================
    $ticketNumber = $draft['ticket_number'];

    if (empty($ticketNumber)) {
        $ticketNumber =
            'ULT-ORT-' .
            strtoupper(
                bin2hex(random_bytes(4))
            );
    }

    // ======================================
    // UBAH DRAFT MENJADI SUBMITTED
    // ======================================
    $db->table('service_requests')
        ->where('id', $id)
        ->where('user_profile_id', $userProfileId)
        ->update([
            'ticket_number' => $ticketNumber,
            'status'        => 'submitted',
            'submitted_at'  => $now,
            'updated_at'    => $now,
        ]);

    // ======================================
    // AMBIL DATA TERBARU
    // ======================================
    $draftSuccess = $db->table('service_requests sr')
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

    // ======================================
    // CEK DATA
    // ======================================
    if (!$draftSuccess) {
        return redirect()
            ->to(
                base_url(
                    'orangtua/ticket/draft'
                )
            )
            ->with(
                'error',
                'Data pengajuan tidak ditemukan.'
            );
    }

// ==========================================
// JIKA USER MEMILIH AJUKAN
// ==========================================
if ($action === 'submit') {

    $now = date('Y-m-d H:i:s');

    // ======================================
    // PAKAI NOMOR TIKET YANG SUDAH ADA
    // ======================================
    $ticketNumber = $draft['ticket_number'];

    if (empty($ticketNumber)) {
        $ticketNumber =
            'ULT-ORT-' .
            strtoupper(
                bin2hex(random_bytes(4))
            );
    }

    // ======================================
    // UBAH DRAFT MENJADI SUBMITTED
    // ======================================
    $db->table('service_requests')
        ->where('id', $id)
        ->where('user_profile_id', $userProfileId)
        ->update([
            'ticket_number' => $ticketNumber,
            'status'        => 'submitted',
            'submitted_at'  => $now,
            'updated_at'    => $now,
        ]);

    // ======================================
    // SIMPAN NOMOR TIKET KE SESSION
    // UNTUK success()
    // ======================================
    session()->set(
        'last_ticket',
        $ticketNumber
    );

    // ======================================
    // MASUK KE HALAMAN SUCCESS
    // ======================================
    return redirect()->to(
        base_url('orangtua/ticket/success')
    );
}
}

// ==========================================
// JIKA HANYA SIMPAN DRAFT
// ==========================================
return redirect()
    ->to(
        base_url(
            'orangtua/ticket/draft'
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
    $draft = session()->get('draft_success');

    if (!$draft) {
        return redirect()->to(
            base_url('orangtua/ticket/draft')
        );
    }

    return view('orangtua/ticket/draft_success', [
        'title' => 'Draft Berhasil Disimpan',
        'draft' => $draft
    ]);
}
}