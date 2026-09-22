<?php

namespace App\Controllers;

use App\Models\TicketModel;
use App\Models\NotificationModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class GuestReportController extends BaseController
{
    protected $ticketModel;
    protected $notificationModel;
    protected $db;

   public function __construct()
{
    $this->ticketModel = new TicketModel();
    $this->notificationModel = new NotificationModel();
    $this->db = \Config\Database::connect();
}

    // =========================================================
    // LIST DATA
    // =========================================================

    public function index()
    {
        $keyword = trim((string) $this->request->getGet('keyword'));
        $status  = trim((string) $this->request->getGet('status'));

        $builder = $this->ticketModel
            ->select('
                tickets.*,
                COALESCE(
                    user_profiles.name,
                    user_profiles.student_name
                ) AS applicant_name,
                user_profiles.student_name,
                user_profiles.nim,
                user_profiles.nik,
                user_profiles.email AS applicant_email,
                user_profiles.phone AS applicant_phone,
                user_profiles.applicant_type_id,
                user_profiles.institution_name,
                master_services.name AS service_name,
                master_services.service_unit_id,
                master_service_units.name AS unit_name
            ')
            ->join(
                'user_profiles',
                'user_profiles.id = tickets.user_profile_id',
                'left'
            )
            ->join(
                'master_services',
                'master_services.id = tickets.service_id',
                'left'
            )
            ->join(
                'master_service_units',
                'master_service_units.id = master_services.service_unit_id',
                'left'
            );

        // =====================================================
        // SEARCH
        // =====================================================

        if ($keyword !== '') {
            $builder
                ->groupStart()
                    ->like('tickets.ticket_number', $keyword)
                    ->orLike('user_profiles.name', $keyword)
                    ->orLike('user_profiles.student_name', $keyword)
                    ->orLike('master_services.name', $keyword)
                    ->orLike('tickets.title', $keyword)
                ->groupEnd();
        }

        // =====================================================
        // FILTER STATUS
        // =====================================================

        if ($status !== '') {
            $builder->where('tickets.status', $status);
        }

        // =====================================================
        // STATISTIK DATABASE
        // =====================================================

        $countTickets = function (?array $statuses = null) {
            $countBuilder = $this->db->table('tickets');

            $columns = $this->db->getFieldNames('tickets');

            if (in_array('deleted_at', $columns, true)) {
                $countBuilder->where(
                    'deleted_at IS NULL',
                    null,
                    false
                );
            }

            if ($statuses !== null) {
                $countBuilder->whereIn(
                    'status',
                    $statuses
                );
            }

            return $countBuilder->countAllResults();
        };

        $totalTiket = $countTickets();

        $submittedTiket = $countTickets([
            'submitted'
        ]);

        $assignedTiket = $countTickets([
            'assigned',
            'processing'
        ]);

        $verifiedTiket = $countTickets([
            'verified',
            'completed'
        ]);

        // =====================================================
        // DATA TABEL
        // =====================================================

        $tickets = $builder
            ->orderBy(
                'tickets.submitted_at',
                'DESC'
            )
            ->paginate(10);

        // =====================================================
        // DATA UNIT UNTUK MODAL DISPOSISI
        // =====================================================

        $units = [];

        if ($this->db->tableExists('master_service_units')) {

            $unitBuilder = $this->db
                ->table('master_service_units');

            $unitColumns = $this->db->getFieldNames(
                'master_service_units'
            );

            if (in_array('is_active', $unitColumns, true)) {
                $unitBuilder->where(
                    'is_active',
                    1
                );
            }

            if (in_array('deleted_at', $unitColumns, true)) {
                $unitBuilder->where(
                    'deleted_at IS NULL',
                    null,
                    false
                );
            }

            if (in_array('name', $unitColumns, true)) {
                $unitBuilder->orderBy(
                    'name',
                    'ASC'
                );
            }

            $units = $unitBuilder
                ->get()
                ->getResultArray();
        }

        // =====================================================
        // VIEW FRONTEND3
        // =====================================================

        return view(
            'petugas/laporan_tamu',
            [
                'tickets' => $tickets,
                'pager'   => $this->ticketModel->pager,
                'keyword' => $keyword,
                'status'  => $status,

                'totalTiket'     => $totalTiket,
                'submittedTiket' => $submittedTiket,
                'assignedTiket'  => $assignedTiket,
                'verifiedTiket'  => $verifiedTiket,

                'units' => $units,
            ]
        );
    }

    // =========================================================
    // FORM CREATE / WALK IN
    // =========================================================

    public function create()
    {
        $units = [];

        if ($this->db->tableExists('master_service_units')) {

            $builder = $this->db
                ->table('master_service_units');

            $columns = $this->db->getFieldNames(
                'master_service_units'
            );

            if (in_array('is_active', $columns, true)) {
                $builder->where(
                    'is_active',
                    1
                );
            }

            if (in_array('deleted_at', $columns, true)) {
                $builder->where(
                    'deleted_at IS NULL',
                    null,
                    false
                );
            }

            if (in_array('name', $columns, true)) {
                $builder->orderBy(
                    'name',
                    'ASC'
                );
            }

            $units = $builder
                ->get()
                ->getResultArray();
        }

        return view(
            'guest_report/create',
            [
                'units' => $units
            ]
        );
    }

    // =========================================================
    // AJAX
    // JENIS LAYANAN BERDASARKAN UNIT
    // =========================================================

    public function servicesByUnit($unitId)
    {
        $unitId = trim((string) $unitId);

        if ($unitId === '') {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Unit layanan tidak valid.',
                    'data'    => []
                ]);
        }

        /*
         * Database project menggunakan:
         * master_services
         * master_services.service_unit_id
         * master_services.name
         */

        if (!$this->db->tableExists('master_services')) {
            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Tabel layanan tidak ditemukan.',
                    'data'    => []
                ]);
        }

        if (!$this->db->tableExists('master_service_units')) {
            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Tabel unit layanan tidak ditemukan.',
                    'data'    => []
                ]);
        }

        // =====================================================
        // RESOLVE UNIT
        // =====================================================

        $resolvedUnitId = null;

        if (ctype_digit($unitId)) {

            $resolvedUnitId = (int) $unitId;

        } else {

            $unitColumns = $this->db->getFieldNames(
                'master_service_units'
            );

            $unitNameColumn = null;

            foreach ([
                'name',
                'unit_name',
                'nama',
                'service_unit_name'
            ] as $column) {

                if (in_array(
                    $column,
                    $unitColumns,
                    true
                )) {
                    $unitNameColumn = $column;
                    break;
                }
            }

            if (!$unitNameColumn) {
                return $this->response
                    ->setStatusCode(500)
                    ->setJSON([
                        'status'  => 'error',
                        'message' => 'Kolom nama unit layanan tidak ditemukan.',
                        'data'    => []
                    ]);
            }

            $unit = $this->db
                ->table('master_service_units')
                ->select('id')
                ->where(
                    $unitNameColumn,
                    $unitId
                )
                ->get()
                ->getRowArray();

            if (!$unit) {
                return $this->response
                    ->setStatusCode(404)
                    ->setJSON([
                        'status'  => 'error',
                        'message' => 'Unit layanan tidak ditemukan.',
                        'data'    => []
                    ]);
            }

            $resolvedUnitId = (int) $unit['id'];
        }

        if ($resolvedUnitId <= 0) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Unit layanan tidak valid.',
                    'data'    => []
                ]);
        }

        // =====================================================
        // AMBIL LAYANAN
        // =====================================================

        $columns = $this->db->getFieldNames(
            'master_services'
        );

        if (!in_array('service_unit_id', $columns, true)) {
            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Kolom service_unit_id tidak ditemukan.',
                    'data'    => []
                ]);
        }

        if (!in_array('name', $columns, true)) {
            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Kolom nama layanan tidak ditemukan.',
                    'data'    => []
                ]);
        }

        $builder = $this->db
            ->table('master_services')
            ->select('id, name')
            ->where(
                'service_unit_id',
                $resolvedUnitId
            );

        if (in_array('is_active', $columns, true)) {
            $builder->where(
                'is_active',
                1
            );
        }

        if (in_array('deleted_at', $columns, true)) {
            $builder->where(
                'deleted_at IS NULL',
                null,
                false
            );
        }

        $builder->orderBy(
            'name',
            'ASC'
        );

        $services = $builder
            ->get()
            ->getResultArray();

        return $this->response
            ->setStatusCode(200)
            ->setJSON([
                'status'  => 'success',
                'message' => 'Layanan berhasil dimuat.',
                'data'    => $services
            ]);
    }

    // =========================================================
    // AJAX
    // PERSYARATAN BERDASARKAN LAYANAN
    // =========================================================

    public function requirements($serviceId)
    {
        $serviceId = (int) $serviceId;

        if ($serviceId <= 0) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'ID layanan tidak valid.',
                    'data'    => []
                ]);
        }

        if (!$this->db->tableExists(
            'master_service_requirements'
        )) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Tabel persyaratan tidak ditemukan.',
                    'data'    => []
                ]);
        }

        $columns = $this->db->getFieldNames(
            'master_service_requirements'
        );

        $builder = $this->db
            ->table('master_service_requirements')
            ->select([
                'id',
                'service_id',
                'name',
                'description',
                'file_type',
                'max_file_size',
                'is_required',
                'allowed_extensions',
                'sort_order'
            ])
            ->where(
                'service_id',
                $serviceId
            );

        if (in_array('is_active', $columns, true)) {
            $builder->where(
                'is_active',
                1
            );
        }

        if (in_array('deleted_at', $columns, true)) {
            $builder->where(
                'deleted_at IS NULL',
                null,
                false
            );
        }

        $builder
            ->orderBy(
                'sort_order',
                'ASC'
            )
            ->orderBy(
                'id',
                'ASC'
            );

        $requirements = $builder
            ->get()
            ->getResultArray();

        return $this->response
            ->setStatusCode(200)
            ->setJSON([
                'status'  => 'success',
                'message' => 'Persyaratan berhasil dimuat.',
                'data'    => $requirements
            ]);
    }

    // =========================================================
    // KONFIGURASI IDENTITAS
    // =========================================================

    private function identityConfig(
        string $applicantType
    ): array {

        $map = [

            'Mahasiswa' => [
                'type'   => 'NIM',
                'column' => 'nim'
            ],

            'Dosen' => [
                'type'   => 'NIP',
                'column' => 'nim'
            ],

            'Tendik' => [
                'type'   => 'NIP',
                'column' => 'nim'
            ],

            'Orang Tua' => [
                'type'   => 'NIK',
                'column' => 'nik'
            ],

            'Orang Tua / Wali' => [
                'type'   => 'NIK',
                'column' => 'nik'
            ],

            'Alumni' => [
                'type'   => 'NIM',
                'column' => 'nim'
            ],

            'Mitra' => [
                'type'   => 'NIK / Identitas',
                'column' => 'nik'
            ],

            'Public' => [
                'type'   => 'NIK',
                'column' => 'nik'
            ],

            'Masyarakat' => [
                'type'   => 'NIK',
                'column' => 'nik'
            ],

            'Masyarakat Umum' => [
                'type'   => 'NIK',
                'column' => 'nik'
            ],
        ];

        return $map[$applicantType]
            ?? [
                'type'   => 'NIM / NIP / NIK',
                'column' => 'nim'
            ];
    }

    // =========================================================
    // RESOLVE APPLICANT TYPE
    // =========================================================

    private function resolveApplicantTypeId(
        string $applicantType
    ): ?int {

        if (!$this->db->tableExists(
            'master_applicant_types'
        )) {
            return null;
        }

        $columns = $this->db->getFieldNames(
            'master_applicant_types'
        );

        if (!in_array('name', $columns, true)) {
            return null;
        }

        $aliases = [
            $applicantType
        ];

        if ($applicantType === 'Orang Tua') {
            $aliases[] = 'Orang Tua / Wali';
        }

        if ($applicantType === 'Masyarakat') {
            $aliases[] = 'Masyarakat Umum';
        }

        foreach ($aliases as $name) {

            if (!$name) {
                continue;
            }

            $builder = $this->db
                ->table('master_applicant_types')
                ->select('id')
                ->where(
                    'name',
                    $name
                );

            if (in_array('deleted_at', $columns, true)) {
                $builder->where(
                    'deleted_at IS NULL',
                    null,
                    false
                );
            }

            $row = $builder
                ->get()
                ->getRowArray();

            if ($row) {
                return (int) $row['id'];
            }
        }

        return null;
    }

    // =========================================================
    // USER PROFILE
    // =========================================================

    private function getOrCreateUserProfileId(
        string $applicantType,
        array $formData
    ): int {

        $table = 'user_profiles';

        $columns = $this->db->getFieldNames(
            $table
        );

        $identityConfig = $this->identityConfig(
            $applicantType
        );

        $identityNumber = trim(
            (string) (
                $formData['identity_number'] ?? ''
            )
        );

        $name = trim(
            (string) (
                $formData['applicant_name'] ?? ''
            )
        );

        $email = trim(
            (string) (
                $formData['email'] ?? ''
            )
        );

        $phone = trim(
            (string) (
                $formData['phone'] ?? ''
            )
        );

        // =====================================================
        // CARI PROFILE BERDASARKAN EMAIL
        // =====================================================

        $existing = null;

        if (
            $email !== '' &&
            in_array(
                'email',
                $columns,
                true
            )
        ) {

            $builder = $this->db
                ->table($table)
                ->where(
                    'email',
                    $email
                );

            if (in_array('deleted_at', $columns, true)) {
                $builder->where(
                    'deleted_at IS NULL',
                    null,
                    false
                );
            }

            $existing = $builder
                ->get()
                ->getRowArray();
        }

        // =====================================================
        // CARI PROFILE BERDASARKAN IDENTITAS
        // =====================================================

        if (
            !$existing &&
            $identityNumber !== '' &&
            in_array(
                $identityConfig['column'],
                $columns,
                true
            )
        ) {

            $builder = $this->db
                ->table($table)
                ->where(
                    $identityConfig['column'],
                    $identityNumber
                );

            if (in_array('deleted_at', $columns, true)) {
                $builder->where(
                    'deleted_at IS NULL',
                    null,
                    false
                );
            }

            $existing = $builder
                ->get()
                ->getRowArray();
        }

        // =====================================================
        // UPDATE PROFILE YANG SUDAH ADA
        // =====================================================

        if (
            $existing &&
            isset($existing['id'])
        ) {

            $updates = [];

            $typeId = $this->resolveApplicantTypeId(
                $applicantType
            );

            if (
                $typeId &&
                in_array(
                    'applicant_type_id',
                    $columns,
                    true
                )
            ) {
                $updates['applicant_type_id'] = $typeId;
            }

            if (
                $identityNumber !== '' &&
                in_array(
                    $identityConfig['column'],
                    $columns,
                    true
                )
            ) {
                $updates[
                    $identityConfig['column']
                ] = $identityNumber;
            }

            if (
                $name !== '' &&
                in_array(
                    'name',
                    $columns,
                    true
                )
            ) {
                $updates['name'] = $name;
            }

            if (
                $name !== '' &&
                in_array(
                    'student_name',
                    $columns,
                    true
                )
            ) {
                $updates['student_name'] = $name;
            }

            if (
                $email !== '' &&
                in_array(
                    'email',
                    $columns,
                    true
                )
            ) {
                $updates['email'] = $email;
            }

            if (
                $phone !== '' &&
                in_array(
                    'phone',
                    $columns,
                    true
                )
            ) {
                $updates['phone'] = $phone;
            }

            if (
                in_array(
                    'institution_name',
                    $columns,
                    true
                ) &&
                !empty($formData['institution_name'])
            ) {
                $updates['institution_name'] =
                    trim(
                        (string)
                        $formData['institution_name']
                    );
            }

            if (
                in_array(
                    'position',
                    $columns,
                    true
                ) &&
                !empty($formData['position'])
            ) {
                $updates['position'] =
                    trim(
                        (string)
                        $formData['position']
                    );
            }

            if (
                in_array(
                    'updated_at',
                    $columns,
                    true
                )
            ) {
                $updates['updated_at'] =
                    date('Y-m-d H:i:s');
            }

            if (!empty($updates)) {

                $this->db
                    ->table($table)
                    ->where(
                        'id',
                        $existing['id']
                    )
                    ->update($updates);
            }

            return (int) $existing['id'];
        }

        // =====================================================
        // PROFILE BARU
        // =====================================================

        $profile = [];

        $sessionUserId =
            session()->get('user_id');

        if (
            $sessionUserId === null ||
            $sessionUserId === ''
        ) {
            $sessionUserId =
                session()->get('id');
        }

        if (
            $sessionUserId !== null &&
            $sessionUserId !== '' &&
            in_array(
                'user_id',
                $columns,
                true
            )
        ) {

            $profile['user_id'] =
                (int) $sessionUserId;
        }

        if (
            !isset($profile['user_id']) &&
            in_array(
                'user_id',
                $columns,
                true
            )
        ) {

            throw new \RuntimeException(
                'User login tidak ditemukan. Silakan login kembali sebelum menambahkan Walk In.'
            );
        }

        if (
            in_array(
                'name',
                $columns,
                true
            )
        ) {
            $profile['name'] = $name;
        }

        if (
            in_array(
                'student_name',
                $columns,
                true
            )
        ) {
            $profile['student_name'] =
                $name !== ''
                    ? $name
                    : null;
        }

        if (
            in_array(
                'nim',
                $columns,
                true
            )
        ) {
            $profile['nim'] =
                $identityConfig['column'] === 'nim' &&
                $identityNumber !== ''
                    ? $identityNumber
                    : null;
        }

        if (
            in_array(
                'nik',
                $columns,
                true
            )
        ) {
            $profile['nik'] =
                $identityConfig['column'] === 'nik' &&
                $identityNumber !== ''
                    ? $identityNumber
                    : null;
        }

        if (
            in_array(
                'email',
                $columns,
                true
            )
        ) {
            $profile['email'] =
                $email !== ''
                    ? $email
                    : null;
        }

        if (
            in_array(
                'phone',
                $columns,
                true
            )
        ) {
            $profile['phone'] =
                $phone !== ''
                    ? $phone
                    : null;
        }

        if (
            in_array(
                'address',
                $columns,
                true
            )
        ) {
            $profile['address'] =
                trim(
                    (string) (
                        $formData['address'] ?? ''
                    )
                ) ?: null;
        }

        if (
            in_array(
                'institution_name',
                $columns,
                true
            )
        ) {
            $profile['institution_name'] =
                trim(
                    (string) (
                        $formData['institution_name'] ?? ''
                    )
                ) ?: null;
        }

        if (
            in_array(
                'position',
                $columns,
                true
            )
        ) {
            $profile['position'] =
                trim(
                    (string) (
                        $formData['position'] ?? ''
                    )
                ) ?: null;
        }

        $typeId =
            $this->resolveApplicantTypeId(
                $applicantType
            );

        if (
            $typeId &&
            in_array(
                'applicant_type_id',
                $columns,
                true
            )
        ) {
            $profile['applicant_type_id'] =
                $typeId;
        }

        if (
            !empty(
                $formData['study_program_id']
            ) &&
            ctype_digit(
                (string)
                $formData['study_program_id']
            ) &&
            in_array(
                'study_program_id',
                $columns,
                true
            )
        ) {
            $profile['study_program_id'] =
                (int)
                $formData['study_program_id'];
        }

        if (
            !empty(
                $formData['class_id']
            ) &&
            ctype_digit(
                (string)
                $formData['class_id']
            ) &&
            in_array(
                'class_id',
                $columns,
                true
            )
        ) {
            $profile['class_id'] =
                (int)
                $formData['class_id'];
        }

        if (
            in_array(
                'created_at',
                $columns,
                true
            )
        ) {
            $profile['created_at'] =
                date('Y-m-d H:i:s');
        }

        if (
            in_array(
                'updated_at',
                $columns,
                true
            )
        ) {
            $profile['updated_at'] =
                date('Y-m-d H:i:s');
        }

        // =====================================================
        // INSERT PROFILE
        // =====================================================

        if (
            !$this->db
                ->table($table)
                ->insert($profile)
        ) {

            $error = $this->db->error();

            throw new \RuntimeException(
                'Profil pemohon gagal disimpan: ' .
                ($error['message'] ?? 'Unknown database error')
            );
        }

        return (int) $this->db->insertID();
    }

    // =========================================================
    // COLLECT FORM DATA
    // =========================================================

    private function collectFormData(
        string $applicantType,
        string $identityType,
        string $identityNumber,
        string $serviceName,
        int $unitId,
        int $serviceId,
        ?string $attachment
    ): array {

        /*
         * Form frontend3 menggunakan:
         * nama
         * email
         * hp
         * unit_layanan
         * jenis_layanan
         *
         * Bukan:
         * applicant_name
         * phone
         */

        $email = trim(
            (string)
            $this->request->getPost('email')
        );

        $phone = trim(
            (string)
            (
                $this->request->getPost('hp')
                ?: $this->request->getPost('phone')
            )
        );

        $applicantName = trim(
            (string)
            (
                $this->request->getPost('nama')
                ?: $this->request->getPost('applicant_name')
            )
        );

        $data = [

            'applicant_type' =>
                $applicantType,

            'identity_type' =>
                $identityType,

            'identity_number' =>
                $identityNumber,

            'applicant_name' =>
                $applicantName,

            'email' =>
                $email,

            'phone' =>
                $phone,

            'service_id' =>
                $serviceId,

            'service_name' =>
                $serviceName,

            'unit_id' =>
                $unitId,

            'description' =>
                trim(
                    (string)
                    $this->request
                        ->getPost(
                            'ticket_description'
                        )
                ),

            /*
             * attachment hanya disimpan di formData
             * untuk kebutuhan kode lama.
             * Tidak dimasukkan ke tabel tickets.
             */
            'attachment' =>
                $attachment,
        ];

        // =====================================================
        // FIELD TAMBAHAN FRONTEND3
        // =====================================================

        $fieldMap = [

            'Mahasiswa' => [
                'program_studi',
                'jurusan',
                'angkatan',
                'class_id',
                'study_program_id'
            ],

            'Dosen' => [
                'prodi_dosen',
                'fakultas',
                'jabatan_dosen'
            ],

            'Tendik' => [
                'unit_kerja',
                'jabatan_tendik'
            ],

            'Orang Tua' => [
                'nama_mahasiswa',
                'nim_mahasiswa',
                'hubungan'
            ],

            'Orang Tua / Wali' => [
                'nama_mahasiswa',
                'nim_mahasiswa',
                'hubungan'
            ],

            'Alumni' => [
                'prodi_alumni',
                'tahun_lulus'
            ],

            'Mitra' => [
                'instansi',
                'pic',
                'jabatan_mitra'
            ],

            'Public' => [
                'instansi_public',
                'alamat_public'
            ],

            'Masyarakat' => [
                'alamat',
                'pekerjaan'
            ],

            'Masyarakat Umum' => [
                'alamat',
                'pekerjaan'
            ],
        ];

        foreach (
            $fieldMap[$applicantType] ?? []
            as $field
        ) {

            $value =
                $this->request->getPost($field);

            if (
                $value !== null &&
                trim((string) $value) !== ''
            ) {

                $data[$field] =
                    is_string($value)
                        ? trim($value)
                        : $value;
            }
        }

        // =====================================================
        // ALIAS TAMBAHAN
        // =====================================================

        $data['address'] =
            $data['alamat']
            ?? $data['alamat_public']
            ?? '';

        $data['institution_name'] =
            $data['instansi']
            ?? $data['instansi_public']
            ?? trim(
                (string)
                $this->request->getPost('instansi')
            );

        $data['position'] =
            $data['pekerjaan']
            ?? $data['jabatan_dosen']
            ?? $data['jabatan_tendik']
            ?? $data['jabatan_mitra']
            ?? '';

        return $data;
    }

    // =========================================================
    // SIAPKAN DATA TIKET UNTUK VIEW
    // =========================================================

    private function prepareTicketForView(
        array $ticket
    ): array {

        /*
         * form_data hanya dipakai kalau memang ada
         * dari data lama. Database tickets sekarang
         * tidak mempunyai kolom form_data.
         */

        $formData = [];

        if (
            !empty($ticket['form_data']) &&
            is_string($ticket['form_data'])
        ) {

            $decoded = json_decode(
                $ticket['form_data'],
                true
            );

            if (is_array($decoded)) {
                $formData = $decoded;
            }
        }

        /*
         * Data query database menjadi prioritas.
         */
        $ticket = array_merge(
            $formData,
            $ticket
        );

        // =====================================================
        // ALIAS FRONTEND3
        // =====================================================

        $ticket['applicant_name'] =
            $ticket['applicant_name']
            ?? $ticket['name']
            ?? $ticket['student_name']
            ?? '';

        $ticket['email'] =
            $ticket['email']
            ?? $ticket['applicant_email']
            ?? '';

        $ticket['phone'] =
            $ticket['phone']
            ?? $ticket['applicant_phone']
            ?? '';

        $ticket['service_name'] =
            $ticket['service_name']
            ?? $ticket['service_display_name']
            ?? '';

        $ticket['ticket_title'] =
            $ticket['ticket_title']
            ?? $ticket['title']
            ?? '';

        $ticket['ticket_description'] =
            $ticket['ticket_description']
            ?? $ticket['description']
            ?? '';

        $ticket['applicant_type'] =
            $ticket['applicant_type']
            ?? '';

        $ticket['attachment'] =
            $ticket['attachment']
            ?? null;

        // =====================================================
        // NORMALISASI JENIS PEMOHON
        // =====================================================

        if (
            $ticket['applicant_type'] ===
            'Orang Tua / Wali'
        ) {
            $ticket['applicant_type'] =
                'Orang Tua';
        }

        if (
            $ticket['applicant_type'] ===
            'Masyarakat Umum'
        ) {
            $ticket['applicant_type'] =
                'Masyarakat';
        }

        return $ticket;
    }

    // =========================================================
    // DETAIL TIKET
    // =========================================================

    private function getPreparedTicket(
        $id
    ): array {

        $ticket =
            $this->ticketModel
                ->getTicketDetail($id);

        if (!$ticket) {
            throw PageNotFoundException
                ::forPageNotFound();
        }

        return $this->prepareTicketForView(
            $ticket
        );
    }

    // =========================================================
    // SIMPAN WALK IN
    // =========================================================

    public function store()
    {
        helper(['form']);

        // =====================================================
        // AMBIL DATA DARI FORM FRONTEND3
        // =====================================================

        $applicantName = trim(
            (string) (
                $this->request->getPost('nama')
                ?: $this->request->getPost('applicant_name')
            )
        );

        $applicantType = trim(
            (string)
            $this->request->getPost('applicant_type')
        );

        $unitId = (int)
            $this->request->getPost(
                'unit_layanan'
            );

        $serviceId = (int)
            $this->request->getPost(
                'jenis_layanan'
            );

        $ticketDescription = trim(
            (string)
            $this->request->getPost(
                'ticket_description'
            )
        );

        // =====================================================
        // VALIDASI
        // =====================================================

        $errors = [];

        if ($applicantName === '') {
            $errors['nama'] =
                'Nama wajib diisi.';
        }

        if ($applicantType === '') {
            $errors['applicant_type'] =
                'Jenis pemohon wajib dipilih.';
        }

        if ($unitId <= 0) {
            $errors['unit_layanan'] =
                'Unit layanan wajib dipilih.';
        }

        if ($serviceId <= 0) {
            $errors['jenis_layanan'] =
                'Jenis layanan wajib dipilih.';
        }

        if ($ticketDescription === '') {
            $errors['ticket_description'] =
                'Deskripsi laporan wajib diisi.';
        }

        if (!empty($errors)) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'errors',
                    $errors
                );
        }

        // =====================================================
        // IDENTITAS
        // =====================================================

        $identityConfig =
            $this->identityConfig(
                $applicantType
            );

        /*
         * Mahasiswa / Dosen / Tendik / Alumni
         * menggunakan NIM/NIP.
         *
         * Orang Tua / Mitra / Public / Masyarakat
         * menggunakan NIK.
         */

        if (
            $identityConfig['column'] === 'nik'
        ) {

            $identityNumber = trim(
                (string) (
                    $this->request->getPost('nik')
                    ?: $this->request->getPost('nim')
                )
            );

        } else {

            $identityNumber = trim(
                (string) (
                    $this->request->getPost('nim')
                    ?: $this->request->getPost('nik')
                )
            );
        }

        // =====================================================
        // SERVICE
        // =====================================================

        if (!$this->db->tableExists(
            'master_services'
        )) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'errors',
                    [
                        'jenis_layanan' =>
                            'Tabel layanan tidak ditemukan.'
                    ]
                );
        }

        $serviceBuilder = $this->db
            ->table('master_services')
            ->where(
                'id',
                $serviceId
            )
            ->where(
                'service_unit_id',
                $unitId
            );

        $serviceColumns =
            $this->db->getFieldNames(
                'master_services'
            );

        if (
            in_array(
                'is_active',
                $serviceColumns,
                true
            )
        ) {
            $serviceBuilder->where(
                'is_active',
                1
            );
        }

        if (
            in_array(
                'deleted_at',
                $serviceColumns,
                true
            )
        ) {
            $serviceBuilder->where(
                'deleted_at IS NULL',
                null,
                false
            );
        }

        $service = $serviceBuilder
            ->get()
            ->getRowArray();

        if (!$service) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'errors',
                    [
                        'jenis_layanan' =>
                            'Jenis layanan tidak sesuai dengan unit layanan yang dipilih.'
                    ]
                );
        }

        $serviceName =
            (string) (
                $service['name'] ?? ''
            );

        if ($serviceName === '') {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'errors',
                    [
                        'jenis_layanan' =>
                            'Nama layanan tidak ditemukan.'
                    ]
                );
        }

        // =====================================================
        // NOMOR TIKET
        // =====================================================

        $ticketNumber =
            'ULT-' .
            date('YmdHis') .
            random_int(100, 999);

        // =====================================================
        // ATTACHMENT
        // =====================================================

        $attachment = null;

        $file =
            $this->request
                ->getFile('attachment');

        if (
            $file &&
            $file->isValid() &&
            !$file->hasMoved()
        ) {

            $allowed = [
                'pdf',
                'jpg',
                'jpeg',
                'png'
            ];

            $ext = strtolower(
                $file->getExtension()
            );

            if (
                !in_array(
                    $ext,
                    $allowed,
                    true
                )
            ) {

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'errors',
                        [
                            'attachment' =>
                                'Format file harus PDF, JPG, JPEG atau PNG.'
                        ]
                    );
            }

            if (
                $file->getSize() >
                5 * 1024 * 1024
            ) {

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'errors',
                        [
                            'attachment' =>
                                'Ukuran file maksimal 5 MB.'
                        ]
                    );
            }

            $uploadPath =
                FCPATH . 'uploads';

            if (!is_dir($uploadPath)) {
                mkdir(
                    $uploadPath,
                    0777,
                    true
                );
            }

            $attachment =
                $file->getRandomName();

            $file->move(
                $uploadPath,
                $attachment
            );
        }

        // =====================================================
        // FORM DATA
        // =====================================================

        $formData =
            $this->collectFormData(
                $applicantType,
                $identityConfig['type'],
                $identityNumber,
                $serviceName,
                $unitId,
                $serviceId,
                $attachment
            );

        /*
         * Pastikan nama yang berasal dari input frontend3
         * benar-benar masuk ke formData.
         */

        $formData['applicant_name'] =
            $applicantName;

        // =====================================================
        // TRANSACTION
        // =====================================================

        try {

            $this->db->transBegin();

            // =================================================
            // USER PROFILE
            // =================================================

            $userProfileId =
                $this->getOrCreateUserProfileId(
                    $applicantType,
                    $formData
                );

            if (!$userProfileId) {

                throw new \RuntimeException(
                    'User profile gagal dibuat.'
                );
            }

            // =================================================
            // DATA TIKET
            // HANYA KOLOM YANG ADA DI tickets
            // =================================================

            $now =
                date('Y-m-d H:i:s');

            $ticketData = [

                'ticket_number' =>
                    $ticketNumber,

                'user_profile_id' =>
                    $userProfileId,

                'service_id' =>
                    $serviceId,

                'title' =>
                    $serviceName,

                'description' =>
                    $ticketDescription,

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

            // =================================================
            // INSERT TICKET
            // =================================================

            $inserted =
                $this->ticketModel
                    ->insert(
                        $ticketData
                    );

            if (!$inserted) {

                $modelErrors =
                    $this->ticketModel->errors();

                throw new \RuntimeException(
                    !empty($modelErrors)
                        ? implode(
                            ', ',
                            $modelErrors
                        )
                        : 'Data tiket gagal disimpan.'
                );
            }

            // =================================================
            // CEK TRANSAKSI
            // =================================================

            if (
                $this->db->transStatus() === false
            ) {

                throw new \RuntimeException(
                    'Transaksi database gagal.'
                );
            }

            $this->db->transCommit();

            $staffUsers = $this->db->table('users')
    ->select('users.id')
    ->join('roles', 'roles.id = users.role_id')
    ->where('users.is_active', 1)
    ->whereIn('roles.code', [
        'SUPER_ADMIN',
        'ADMIN_ULT',
        'PETUGAS_AKADEMIK',
        'PETUGAS_KEUANGAN',
        'PETUGAS_UMUM'
    ])
    ->get()
    ->getResultArray();

foreach ($staffUsers as $staff) {
    $this->notificationModel->insert([
        'user_id'            => (int) $staff['id'],
        'service_request_id' => null,
        'title'              => 'Tiket Walk In Baru',
        'message'            => 'Tiket ' . $ticketNumber . ' dari ' . $applicantName . ' telah masuk melalui Laporan Tamu.',
        'type'               => 'info',
        'is_read'            => 0,
        'read_at'            => null,
        'url'                => base_url('datatiket'),
        'created_at'         => $now,
        'updated_at'         => $now,
        'deleted_at'         => null
    ]);
}

        } catch (\Throwable $e) {

            $this->db->transRollback();

            log_message(
                'error',
                'GuestReport store error: ' .
                $e->getMessage()
            );

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'errors',
                    [
                        'database' =>
                            'Data gagal disimpan: ' .
                            $e->getMessage()
                    ]
                );
        }

        // =====================================================
        // BERHASIL
        // =====================================================

        return redirect()
            ->to(
                base_url('guest-report')
            )
            ->with(
                'success',
                'Laporan Walk In berhasil ditambahkan.'
            );
    }

    // =========================================================
    // DETAIL
    // =========================================================

    public function detail($id)
    {
        $ticket =
            $this->getPreparedTicket($id);

        return view(
            'guest_report/detail',
            [
                'ticket' => $ticket
            ]
        );
    }

    // =========================================================
    // EDIT
    // =========================================================

    public function edit($id)
    {
        $ticket =
            $this->getPreparedTicket($id);

        return view(
            'guest_report/edit',
            [
                'ticket' => $ticket
            ]
        );
    }

    // =========================================================
    // UPDATE
    // =========================================================

    public function update($id)
    {
        $ticket =
            $this->getPreparedTicket($id);

        $profileId =
            (int) (
                $ticket['user_profile_id'] ?? 0
            );

        if ($profileId <= 0) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'errors',
                    [
                        'database' =>
                            'Profil pemohon tidak ditemukan.'
                    ]
                );
        }

        // =====================================================
        // DATA POST
        // =====================================================

        $applicantName =
            trim(
                (string)
                (
                    $this->request
                        ->getPost(
                            'applicant_name'
                        )
                    ?: $this->request
                        ->getPost('nama')
                )
            );

        $email =
            trim(
                (string)
                $this->request
                    ->getPost('email')
            );

        $phone =
            trim(
                (string)
                (
                    $this->request
                        ->getPost('phone')
                    ?: $this->request
                        ->getPost('hp')
                )
            );

        $nim =
            trim(
                (string)
                $this->request
                    ->getPost('nim')
            );

        $nik =
            trim(
                (string)
                $this->request
                    ->getPost('nik')
            );

        $ticketTitle =
            trim(
                (string)
                $this->request
                    ->getPost(
                        'ticket_title'
                    )
            );

        $ticketDescription =
            trim(
                (string)
                $this->request
                    ->getPost(
                        'ticket_description'
                    )
            );

        // =====================================================
        // SERVICE
        // =====================================================

        $serviceId =
            (int) (
                $this->request
                    ->getPost(
                        'service_id'
                    )
                ?: (
                    $ticket['service_id'] ?? 0
                )
            );

        $service = null;

        if ($serviceId > 0) {

            $serviceBuilder =
                $this->db
                    ->table('master_services')
                    ->where(
                        'id',
                        $serviceId
                    );

            $serviceColumns =
                $this->db->getFieldNames(
                    'master_services'
                );

            if (
                in_array(
                    'is_active',
                    $serviceColumns,
                    true
                )
            ) {
                $serviceBuilder->where(
                    'is_active',
                    1
                );
            }

            if (
                in_array(
                    'deleted_at',
                    $serviceColumns,
                    true
                )
            ) {
                $serviceBuilder->where(
                    'deleted_at IS NULL',
                    null,
                    false
                );
            }

            $service =
                $serviceBuilder
                    ->get()
                    ->getRowArray();
        }

        // =====================================================
        // TRANSACTION
        // =====================================================

        $this->db->transBegin();

        try {

            // =================================================
            // UPDATE USER PROFILE
            // =================================================

            $profileData = [];

            $profileColumns =
                $this->db->getFieldNames(
                    'user_profiles'
                );

            if (
                $applicantName !== '' &&
                in_array(
                    'name',
                    $profileColumns,
                    true
                )
            ) {

                $profileData['name'] =
                    $applicantName;
            }

            if (
                $applicantName !== '' &&
                in_array(
                    'student_name',
                    $profileColumns,
                    true
                )
            ) {

                $profileData['student_name'] =
                    $applicantName;
            }

            if (
                $email !== '' &&
                in_array(
                    'email',
                    $profileColumns,
                    true
                )
            ) {

                $profileData['email'] =
                    $email;
            }

            if (
                $phone !== '' &&
                in_array(
                    'phone',
                    $profileColumns,
                    true
                )
            ) {

                $profileData['phone'] =
                    $phone;
            }

            if (
                $nim !== '' &&
                in_array(
                    'nim',
                    $profileColumns,
                    true
                )
            ) {

                $profileData['nim'] =
                    $nim;
            }

            if (
                $nik !== '' &&
                in_array(
                    'nik',
                    $profileColumns,
                    true
                )
            ) {

                $profileData['nik'] =
                    $nik;
            }

            if (
                in_array(
                    'updated_at',
                    $profileColumns,
                    true
                )
            ) {

                $profileData['updated_at'] =
                    date('Y-m-d H:i:s');
            }

            if (!empty($profileData)) {

                $this->db
                    ->table('user_profiles')
                    ->where(
                        'id',
                        $profileId
                    )
                    ->update(
                        $profileData
                    );
            }

            // =================================================
            // UPDATE TICKET
            // =================================================

            $ticketUpdate = [];

            $ticketColumns =
                $this->db->getFieldNames(
                    'tickets'
                );

            if (
                $serviceId > 0 &&
                $service &&
                in_array(
                    'service_id',
                    $ticketColumns,
                    true
                )
            ) {

                $ticketUpdate['service_id'] =
                    $serviceId;
            }

            if (
                $ticketTitle !== '' &&
                in_array(
                    'title',
                    $ticketColumns,
                    true
                )
            ) {

                $ticketUpdate['title'] =
                    $ticketTitle;
            }

            if (
                $ticketDescription !== '' &&
                in_array(
                    'description',
                    $ticketColumns,
                    true
                )
            ) {

                $ticketUpdate['description'] =
                    $ticketDescription;
            }

            if (
                in_array(
                    'updated_at',
                    $ticketColumns,
                    true
                )
            ) {

                $ticketUpdate['updated_at'] =
                    date('Y-m-d H:i:s');
            }

            /*
             * PENTING:
             *
             * Jangan update:
             * attachment
             * form_data
             *
             * karena kolom tersebut tidak ada
             * di tabel tickets saat ini.
             */

            if (!empty($ticketUpdate)) {

                if (
                    !$this->ticketModel
                        ->update(
                            $id,
                            $ticketUpdate
                        )
                ) {

                    $errors =
                        $this->ticketModel->errors();

                    throw new \RuntimeException(
                        !empty($errors)
                            ? implode(
                                ', ',
                                $errors
                            )
                            : 'Data tiket gagal diperbarui.'
                    );
                }
            }

            // =================================================
            // CEK TRANSAKSI
            // =================================================

            if (
                $this->db->transStatus() === false
            ) {

                throw new \RuntimeException(
                    'Gagal memperbarui data.'
                );
            }

            $this->db->transCommit();

        } catch (\Throwable $e) {

            $this->db->transRollback();

            log_message(
                'error',
                'GuestReport update error: ' .
                $e->getMessage()
            );

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'errors',
                    [
                        'database' =>
                            'Data gagal diubah: ' .
                            $e->getMessage()
                    ]
                );
        }

        return redirect()
            ->to(
                base_url('guest-report')
            )
            ->with(
                'success',
                'Data berhasil diubah.'
            );
    }

    // =========================================================
    // DELETE
    // =========================================================

    public function delete($id = null)
    {
        if (!$id) {

            return redirect()
                ->to(
                    base_url('guest-report')
                )
                ->with(
                    'error',
                    'ID tiket tidak ditemukan.'
                );
        }

        // =====================================================
        // CARI TIKET
        // =====================================================

        $ticket =
            $this->ticketModel
                ->find($id);

        if (!$ticket) {

            return redirect()
                ->to(
                    base_url('guest-report')
                )
                ->with(
                    'error',
                    'Data tiket dengan ID ' .
                    $id .
                    ' tidak ditemukan.'
                );
        }

        // =====================================================
        // HAPUS TIKET
        // =====================================================

        /*
         * TicketModel menggunakan soft delete.
         *
         * Karena tabel tickets mempunyai deleted_at,
         * delete() akan menggunakan soft delete.
         */

        if (
            $this->ticketModel
                ->delete($id)
        ) {

            return redirect()
                ->to(
                    base_url('guest-report')
                )
                ->with(
                    'success',
                    'Laporan tamu berhasil dihapus.'
                );
        }

        return redirect()
            ->to(
                base_url('guest-report')
            )
            ->with(
                'error',
                'Gagal menghapus laporan tamu.'
            );
    }
}