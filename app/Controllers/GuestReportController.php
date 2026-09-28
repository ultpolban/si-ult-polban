<?php

namespace App\Controllers;

use App\Models\TicketModel;
use App\Models\NotificationModel;
use App\Models\TicketAttachmentModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class GuestReportController extends BaseController
{
    protected $ticketModel;
    protected $notificationModel;
    protected $ticketAttachmentModel;
    protected $db;

    public function __construct()
    {
        $this->ticketModel = new TicketModel();
        $this->notificationModel = new NotificationModel();
        $this->ticketAttachmentModel = new TicketAttachmentModel();
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
                tickets.created_at AS ticket_created_at,
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

        if ($status !== '') {
            $builder->where('tickets.status', $status);
        }

        // =====================================================
        // STATISTIK
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
                $countBuilder->whereIn('status', $statuses);
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
            ->orderBy('tickets.submitted_at', 'DESC')
            ->paginate(10);

        // =====================================================
        // DATA UNIT
        // =====================================================

        $units = [];

        if ($this->db->tableExists('master_service_units')) {

            $unitBuilder = $this->db
                ->table('master_service_units');

            $unitColumns = $this->db->getFieldNames(
                'master_service_units'
            );

            if (in_array('is_active', $unitColumns, true)) {
                $unitBuilder->where('is_active', 1);
            }

            if (in_array('deleted_at', $unitColumns, true)) {
                $unitBuilder->where(
                    'deleted_at IS NULL',
                    null,
                    false
                );
            }

            if (in_array('name', $unitColumns, true)) {
                $unitBuilder->orderBy('name', 'ASC');
            }

            $units = $unitBuilder
                ->get()
                ->getResultArray();
        }

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
                $builder->where('is_active', 1);
            }

            if (in_array('deleted_at', $columns, true)) {
                $builder->where(
                    'deleted_at IS NULL',
                    null,
                    false
                );
            }

            if (in_array('name', $columns, true)) {
                $builder->orderBy('name', 'ASC');
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
    // AJAX - JENIS LAYANAN BERDASARKAN UNIT
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

                if (in_array($column, $unitColumns, true)) {
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
                ->where($unitNameColumn, $unitId)
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

        $columns = $this->db->getFieldNames(
            'master_services'
        );

        $builder = $this->db
            ->table('master_services')
            ->select('id, name')
            ->where(
                'service_unit_id',
                $resolvedUnitId
            );

        if (in_array('is_active', $columns, true)) {
            $builder->where('is_active', 1);
        }

        if (in_array('deleted_at', $columns, true)) {
            $builder->where(
                'deleted_at IS NULL',
                null,
                false
            );
        }

        $services = $builder
            ->orderBy('name', 'ASC')
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
    // AJAX - PERSYARATAN BERDASARKAN LAYANAN
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

        $select = [
            'id',
            'service_id',
            'name'
        ];

        foreach ([
            'description',
            'file_type',
            'max_file_size',
            'is_required',
            'allowed_extensions',
            'sort_order'
        ] as $column) {

            if (in_array($column, $columns, true)) {
                $select[] = $column;
            }
        }

        $builder = $this->db
            ->table('master_service_requirements')
            ->select(implode(', ', $select))
            ->where('service_id', $serviceId);

        if (in_array('is_active', $columns, true)) {
            $builder->where('is_active', 1);
        }

        if (in_array('deleted_at', $columns, true)) {
            $builder->where(
                'deleted_at IS NULL',
                null,
                false
            );
        }

        if (in_array('sort_order', $columns, true)) {
            $builder->orderBy('sort_order', 'ASC');
        }

        $builder->orderBy('id', 'ASC');

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
    // AMBIL REQUIREMENT
    // =========================================================

    private function getServiceRequirements(
        int $serviceId
    ): array {

        if (
            $serviceId <= 0 ||
            !$this->db->tableExists(
                'master_service_requirements'
            )
        ) {
            return [];
        }

        $columns = $this->db->getFieldNames(
            'master_service_requirements'
        );

        $select = ['id'];

        foreach ([
            'service_id',
            'name',
            'description',
            'file_type',
            'max_file_size',
            'is_required',
            'allowed_extensions',
            'sort_order',
            'is_active',
            'deleted_at'
        ] as $column) {

            if (in_array($column, $columns, true)) {
                $select[] = $column;
            }
        }

        $builder = $this->db
            ->table('master_service_requirements')
            ->select(implode(', ', $select))
            ->where('service_id', $serviceId);

        if (in_array('is_active', $columns, true)) {
            $builder->where('is_active', 1);
        }

        if (in_array('deleted_at', $columns, true)) {
            $builder->where(
                'deleted_at IS NULL',
                null,
                false
            );
        }

        if (in_array('sort_order', $columns, true)) {
            $builder->orderBy('sort_order', 'ASC');
        }

        $builder->orderBy('id', 'ASC');

        return $builder
            ->get()
            ->getResultArray();
    }

    // =========================================================
    // NORMALISASI EXTENSION
    // =========================================================

    private function normalizeAllowedExtensions($value): array
    {
        if (is_array($value)) {

            $items = $value;

        } elseif (
            is_string($value) &&
            trim($value) !== ''
        ) {

            $decoded = json_decode(
                $value,
                true
            );

            if (is_array($decoded)) {
                $items = $decoded;
            } else {
                $items = preg_split(
                    '/[,;|\s]+/',
                    trim($value)
                );
            }

        } else {

            $items = [];
        }

        $extensions = [];

        foreach ($items as $item) {

            $item = strtolower(
                trim((string) $item)
            );

            $item = ltrim(
                $item,
                '.'
            );

            if ($item !== '') {
                $extensions[] = $item;
            }
        }

        return array_values(
            array_unique($extensions)
        );
    }

    // =========================================================
    // UPLOAD FILE
    // =========================================================

    private function uploadAttachmentFile(
        $file,
        array $requirement = []
    ): array {

        if (
            !$file ||
            !$file->isValid() ||
            $file->hasMoved()
        ) {
            throw new \RuntimeException(
                'File tidak valid atau sudah dipindahkan.'
            );
        }

        $allowed =
            $this->normalizeAllowedExtensions(
                $requirement['allowed_extensions'] ?? null
            );

        if (empty($allowed)) {
            $allowed = [
                'pdf',
                'jpg',
                'jpeg',
                'png'
            ];
        }

        $extension = strtolower(
            $file->getExtension()
        );

        if (!in_array(
            $extension,
            $allowed,
            true
        )) {

            throw new \RuntimeException(
                'Format file untuk "' .
                ($requirement['name'] ?? 'lampiran') .
                '" tidak diperbolehkan. Format: ' .
                strtoupper(
                    implode(', ', $allowed)
                ) . '.'
            );
        }

        $maxMb = (float) (
            $requirement['max_file_size'] ?? 5
        );

        if ($maxMb <= 0) {
            $maxMb = 5;
        }

        $maxBytes =
            (int) round(
                $maxMb * 1024 * 1024
            );

        if (
            $file->getSize() >
            $maxBytes
        ) {

            throw new \RuntimeException(
                'Ukuran file untuk "' .
                ($requirement['name'] ?? 'lampiran') .
                '" maksimal ' .
                rtrim(
                    rtrim(
                        number_format(
                            $maxMb,
                            2,
                            '.',
                            ''
                        ),
                        '0'
                    ),
                    '.'
                ) .
                ' MB.'
            );
        }

        $uploadPath =
            FCPATH . 'uploads';

        if (
            !is_dir($uploadPath) &&
            !mkdir(
                $uploadPath,
                0777,
                true
            ) &&
            !is_dir($uploadPath)
        ) {

            throw new \RuntimeException(
                'Folder uploads tidak dapat dibuat.'
            );
        }

        $storedName =
            $file->getRandomName();

        $originalName =
            $file->getClientName();

        $mimeType =
            $file->getClientMimeType();

        $fileSize =
            (int) $file->getSize();

        $file->move(
            $uploadPath,
            $storedName
        );

        return [
            'original_name' =>
                $originalName,

            'file_name' =>
                $storedName,

            'file_path' =>
                'uploads/' . $storedName,

            'file_extension' =>
                $extension,

            'mime_type' =>
                $mimeType,

            'file_size' =>
                $fileSize,

            'stored_name' =>
                $storedName,
        ];
    }

    // =========================================================
    // BERSIHKAN FILE FISIK JIKA TRANSAKSI GAGAL
    // =========================================================

    private function cleanupUploadedFiles(
        array $storedFiles
    ): void {

        foreach ($storedFiles as $stored) {

            $filePath =
                (string) (
                    $stored['file_path'] ?? ''
                );

            if ($filePath === '') {
                continue;
            }

            $physicalPath =
                FCPATH .
                ltrim(
                    $filePath,
                    '/\\'
                );

            if (is_file($physicalPath)) {
                @unlink($physicalPath);
            }
        }
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
                'type'   => 'NIK',
                'column' => 'nik'
            ],

            'Tendik' => [
                'type'   => 'NIK',
                'column' => 'nik'
            ],

            'Orang Tua' => [
                'type'   => 'NIK',
                'column' => 'nik'
            ],

            'Alumni' => [
                'type'   => 'NIM',
                'column' => 'nim'
            ],

            'Mitra' => [
                'type'   => null,
                'column' => null
            ],

            'Umum' => [
                'type'   => 'NIK',
                'column' => 'nik'
            ],
        ];

        return $map[$applicantType]
            ?? [
                'type'   => null,
                'column' => null
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

        if (!in_array(
            'name',
            $columns,
            true
        )) {
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
                ->where('name', $name);

            if (in_array(
                'deleted_at',
                $columns,
                true
            )) {
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

        $columns =
            $this->db->getFieldNames($table);

        $identityConfig =
            $this->identityConfig(
                $applicantType
            );

        $identityNumber =
            trim((string) (
                $formData['identity_number'] ?? ''
            ));

        $name =
            trim((string) (
                $formData['applicant_name'] ?? ''
            ));

        $email =
            trim((string) (
                $formData['email'] ?? ''
            ));

        $phone =
            trim((string) (
                $formData['phone'] ?? ''
            ));

        $existing = null;

        // Cari berdasarkan email
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

            if (in_array(
                'deleted_at',
                $columns,
                true
            )) {
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

        // Cari berdasarkan identitas
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

            if (in_array(
                'deleted_at',
                $columns,
                true
            )) {
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

        // Update profile lama
        if (
            $existing &&
            isset($existing['id'])
        ) {

            $updates = [];

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
                $updates[
                    'applicant_type_id'
                ] = $typeId;
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
                $updates[
                    'student_name'
                ] = $name;
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
                !empty(
                    $formData['institution_name']
                )
            ) {
                $updates[
                    'institution_name'
                ] = trim(
                    (string)
                    $formData[
                        'institution_name'
                    ]
                );
            }

            if (
                in_array(
                    'position',
                    $columns,
                    true
                ) &&
                !empty(
                    $formData['position']
                )
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

        // Profile baru
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

        if (in_array(
            'name',
            $columns,
            true
        )) {
            $profile['name'] = $name;
        }

        if (in_array(
            'student_name',
            $columns,
            true
        )) {
            $profile['student_name'] =
                $name !== ''
                    ? $name
                    : null;
        }

        if (in_array(
            'nim',
            $columns,
            true
        )) {
            $profile['nim'] =
                $identityConfig['column'] === 'nim' &&
                $identityNumber !== ''
                    ? $identityNumber
                    : null;
        }

        if (in_array(
            'nim_anak',
            $columns,
            true
        )) {
            $profile['nim_anak'] =
                trim(
                    (string) (
                        $formData['nim_anak'] ?? ''
                    )
                ) ?: null;
        }

        if (in_array(
            'nik',
            $columns,
            true
        )) {
            $profile['nik'] =
                $identityConfig['column'] === 'nik' &&
                $identityNumber !== ''
                    ? $identityNumber
                    : null;
        }

        if (in_array(
            'email',
            $columns,
            true
        )) {
            $profile['email'] =
                $email !== ''
                    ? $email
                    : null;
        }

        if (in_array(
            'phone',
            $columns,
            true
        )) {
            $profile['phone'] =
                $phone !== ''
                    ? $phone
                    : null;
        }

        if (in_array(
            'address',
            $columns,
            true
        )) {
            $profile['address'] =
                trim(
                    (string) (
                        $formData['address'] ?? ''
                    )
                ) ?: null;
        }

        if (in_array(
            'institution_name',
            $columns,
            true
        )) {
            $profile['institution_name'] =
                trim(
                    (string) (
                        $formData[
                            'institution_name'
                        ] ?? ''
                    )
                ) ?: null;
        }

        if (in_array(
            'position',
            $columns,
            true
        )) {
            $profile['position'] =
                trim(
                    (string) (
                        $formData[
                            'position'
                        ] ?? ''
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
            $profile[
                'applicant_type_id'
            ] = $typeId;
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
            $profile[
                'study_program_id'
            ] = (int)
                $formData[
                    'study_program_id'
                ];
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
            $profile[
                'class_id'
            ] = (int)
                $formData[
                    'class_id'
                ];
        }

        if (in_array(
            'created_at',
            $columns,
            true
        )) {
            $profile['created_at'] =
                date('Y-m-d H:i:s');
        }

        if (in_array(
            'updated_at',
            $columns,
            true
        )) {
            $profile['updated_at'] =
                date('Y-m-d H:i:s');
        }

        if (!$this->db
            ->table($table)
            ->insert($profile)
        ) {

            $error =
                $this->db->error();

            throw new \RuntimeException(
                'Profil pemohon gagal disimpan: ' .
                ($error['message'] ?? 'Unknown database error')
            );
        }

        return (int)
            $this->db->insertID();
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
        ?int $serviceId,
        ?string $attachment
    ): array {

        $email = trim(
            (string)
            $this->request->getPost('email')
        );

        $phone = trim(
            (string) (
                $this->request->getPost('hp')
                ?: $this->request->getPost('phone')
            )
        );

        $applicantName = trim(
            (string) (
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
                    $this->request->getPost(
                        'ticket_description'
                    )
                ),

            'attachment' =>
                $attachment,
        ];

        $fieldMap = [

            'Mahasiswa' => [
                'program_studi',
                'jurusan',
                'angkatan',
                'class_id',
                'study_program_id'
            ],

            'Dosen' => [
                'instansi',
                'jabatan'
            ],

            'Tendik' => [
                'instansi',
                'jabatan'
            ],

            'Orang Tua' => [
                'nim_anak'
            ],

            'Alumni' => [
                'prodi_alumni',
                'tahun_lulus'
            ],

            'Mitra' => [
                'instansi',
                'jabatan'
            ],

            'Umum' => [],

        ];

        foreach (
            $fieldMap[$applicantType] ?? []
            as $field
        ) {

            $value =
                $this->request->getPost(
                    $field
                );

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

        $data['address'] =
            $data['alamat']
            ?? $data['alamat_public']
            ?? '';

        $data['institution_name'] =
            $data['instansi']
            ?? $data['instansi_public']
            ?? trim(
                (string)
                $this->request->getPost(
                    'instansi'
                )
            );

        $data['position'] =
            $data['jabatan']
            ?? $data['pekerjaan']
            ?? $data['jabatan_dosen']
            ?? $data['jabatan_tendik']
            ?? $data['jabatan_mitra']
            ?? '';

        return $data;
    }

    // =========================================================
    // SIAPKAN DATA TIKET
    // =========================================================

    private function prepareTicketForView(
        array $ticket
    ): array {

        $formData = [];

        if (
            !empty($ticket['form_data']) &&
            is_string($ticket['form_data'])
        ) {

            $decoded =
                json_decode(
                    $ticket['form_data'],
                    true
                );

            if (is_array($decoded)) {
                $formData = $decoded;
            }
        }

        $ticket = array_merge(
            $formData,
            $ticket
        );

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
    // AMBIL DETAIL TIKET
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

        if (
            !empty(
                $ticket['user_profile_id']
            ) &&
            $this->db->tableExists(
                'user_profiles'
            )
        ) {

            $profile = $this->db
                ->table('user_profiles')
                ->where(
                    'id',
                    (int)
                    $ticket['user_profile_id']
                )
                ->get()
                ->getRowArray();

            if ($profile) {
                $ticket = array_merge(
                    $profile,
                    $ticket
                );
            }
        }

        if (
            empty(
                $ticket['applicant_type']
            ) &&
            !empty(
                $ticket['applicant_type_id']
            ) &&
            $this->db->tableExists(
                'master_applicant_types'
            )
        ) {

            $typeBuilder =
                $this->db
                    ->table(
                        'master_applicant_types'
                    )
                    ->where(
                        'id',
                        (int)
                        $ticket[
                            'applicant_type_id'
                        ]
                    );

            $typeColumns =
                $this->db->getFieldNames(
                    'master_applicant_types'
                );

            if (
                in_array(
                    'deleted_at',
                    $typeColumns,
                    true
                )
            ) {
                $typeBuilder->where(
                    'deleted_at IS NULL',
                    null,
                    false
                );
            }

            $type =
                $typeBuilder
                    ->get()
                    ->getRowArray();

            if (
                $type &&
                isset($type['name'])
            ) {
                $ticket['applicant_type'] =
                    $type['name'];
            }
        }

        if (
            empty($ticket['unit_name']) &&
            !empty($ticket['service_id']) &&
            $this->db->tableExists(
                'master_services'
            ) &&
            $this->db->tableExists(
                'master_service_units'
            )
        ) {

            $unit =
                $this->db
                    ->table(
                        'master_services ms'
                    )
                    ->select(
                        'su.id AS unit_id, su.name AS unit_name'
                    )
                    ->join(
                        'master_service_units su',
                        'su.id = ms.service_unit_id',
                        'left'
                    )
                    ->where(
                        'ms.id',
                        (int)
                        $ticket['service_id']
                    )
                    ->get()
                    ->getRowArray();

            if ($unit) {
                $ticket['unit_id'] =
                    $unit['unit_id'] ?? null;

                $ticket['unit_name'] =
                    $unit['unit_name'] ?? '';
            }
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
        // DATA FORM
        // =====================================================

        $applicantName = trim(
            (string) (
                $this->request->getPost('nama')
                ?: $this->request->getPost(
                    'applicant_name'
                )
            )
        );

        $applicantType = trim(
            (string)
            $this->request->getPost(
                'applicant_type'
            )
        );

        $unitId = (int)
            $this->request->getPost(
                'unit_layanan'
            );

        $serviceId = (int)
            $this->request->getPost(
                'jenis_layanan'
            );

        if ($unitId === 1) {
            $serviceId = null;
        }

        $ticketDescription = trim(
            (string)
            $this->request->getPost(
                'ticket_description'
            )
        );

        // =====================================================
        // VALIDASI DASAR
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

        if ($unitId !== 1 && $serviceId <= 0) {
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

        if (
            $identityConfig['column'] ===
            'nik'
        ) {

            $identityNumber = trim(
                (string) $this->request->getPost('nik')
            );

        } elseif (
            $identityConfig['column'] ===
            'nim'
        ) {

            $identityNumber = trim(
                (string) $this->request->getPost('nim')
            );

        } else {

            $identityNumber = '';
        }

        // =====================================================
        // VALIDASI IDENTITAS PEMOHON
        // =====================================================

        if (
            in_array(
                $applicantType,
                [
                    'Mahasiswa',
                    'Alumni'
                ],
                true
            ) &&
            $identityNumber === ''
        ) {
            $errors['nim'] =
                'NIM wajib diisi.';
        }

        if (
            in_array(
                $applicantType,
                [
                    'Dosen',
                    'Tendik',
                    'Orang Tua',
                    'Umum'
                ],
                true
            ) &&
            $identityNumber === ''
        ) {
            $errors['nik'] =
                'NIK wajib diisi.';
        }

        if (
            $applicantType === 'Orang Tua' &&
            trim(
                (string) (
                    $this->request->getPost(
                        'nim_anak'
                    ) ?? ''
                )
            ) === ''
        ) {
            $errors['nim_anak'] =
                'NIM anak wajib diisi.';
        }

        if (
            $applicantType === 'Mitra'
        ) {
            $instansi = trim(
                (string) (
                    $this->request->getPost(
                        'instansi'
                    ) ?? ''
                )
            );

            $jabatan = trim(
                (string) (
                    $this->request->getPost(
                        'jabatan'
                    ) ?? ''
                )
            );

            if ($instansi === '') {
                $errors['instansi'] =
                    'Instansi wajib diisi.';
            }

            if ($jabatan === '') {
                $errors['jabatan'] =
                    'Jabatan wajib diisi.';
            }
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
        // CEK SERVICE
        // =====================================================

        $service = null;
        $serviceName = '';

        /*
         * Unit Layanan Terpadu (ID 1) tidak mempunyai
         * jenis layanan. Karena itu service boleh kosong
         * khusus untuk unit ini.
         *
         * Unit lainnya tetap menggunakan validasi service
         * seperti sebelumnya.
         */
        if ($unitId !== 1) {

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

            $serviceColumns =
                $this->db->getFieldNames(
                    'master_services'
                );

            $serviceBuilder =
                $this->db
                    ->table('master_services')
                    ->where(
                        'id',
                        $serviceId
                    );

            if (in_array(
                'service_unit_id',
                $serviceColumns,
                true
            )) {

                $serviceBuilder->where(
                    'service_unit_id',
                    $unitId
                );
            }

            if (in_array(
                'is_active',
                $serviceColumns,
                true
            )) {

                $serviceBuilder->where(
                    'is_active',
                    1
                );
            }

            if (in_array(
                'deleted_at',
                $serviceColumns,
                true
            )) {

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
                trim(
                    (string)
                    ($service['name'] ?? '')
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
                null
            );

        $formData['applicant_name'] =
            $applicantName;

        // =====================================================
        // PERSYARATAN
        // =====================================================

        $requirements =
            $serviceId === null
                ? []
                : $this->getServiceRequirements(
                    $serviceId
                );

        $storedFiles = [];
        $requirementFiles = [];

        /*
         * Setiap requirement dibaca menggunakan:
         *
         * syarat_ID
         *
         * Contoh:
         *
         * syarat_1
         * syarat_2
         *
         * Ini mendukung 2, 3, 4, dst. lampiran.
         */

        try {

           foreach ($requirements as $requirement) {

    $requirementId = (int) ($requirement['id'] ?? 0);

    if ($requirementId <= 0) {
        continue;
    }

    $fieldName = 'syarat_' . $requirementId;

    /*
     * Ambil multiple file.
     * Frontend baru:
     * name="syarat_ID[]"
     *
     * Backend tetap fallback ke file tunggal
     * supaya form lama tidak rusak.
     */
    $files = $this->request->getFileMultiple($fieldName);

    if (empty($files)) {
        $singleFile = $this->request->getFile($fieldName);

        if ($singleFile) {
            $files = [$singleFile];
        }
    }

    /*
     * Fallback untuk form lama:
     * requirement_ID
     */
    if (empty($files)) {

        $oldFieldName = 'requirement_' . $requirementId;

        $files = $this->request->getFileMultiple($oldFieldName);

        if (empty($files)) {
            $singleFile = $this->request->getFile($oldFieldName);

            if ($singleFile) {
                $files = [$singleFile];
            }
        }
    }

    $validFiles = [];

    foreach ($files as $file) {

        if (
            $file &&
            $file->isValid() &&
            !$file->hasMoved()
        ) {
            $validFiles[] = $file;
        }
    }

    $isRequired =
        (int) ($requirement['is_required'] ?? 0) === 1;

    /*
     * Kalau requirement wajib tetapi tidak ada
     * file sama sekali.
     */
    if (empty($validFiles)) {

        if ($isRequired) {

            throw new \RuntimeException(
                'Dokumen wajib "' .
                (
                    $requirement['name']
                    ?? 'Persyaratan'
                ) .
                '" belum diunggah.'
            );
        }

        continue;
    }

    /*
     * Simpan SEMUA file yang diupload.
     */
    foreach ($validFiles as $file) {

        $uploaded =
            $this->uploadAttachmentFile(
                $file,
                $requirement
            );

        $storedFiles[] = $uploaded;

        $requirementFiles[] = [

            'requirement_id' =>
                $requirementId,

            'requirement_name' =>
                $requirement['name']
                ??
                'Persyaratan',

            'original_name' =>
                $uploaded['original_name'],

            'file_name' =>
                $uploaded['file_name'],

            'file_path' =>
                $uploaded['file_path'],

            'file_extension' =>
                $uploaded['file_extension'],

            'mime_type' =>
                $uploaded['mime_type'],

            'file_size' =>
                $uploaded['file_size'],
        ];
    }
}

            // =================================================
            // LAMPIRAN TAMBAHAN
            // =================================================

            $genericFile =
                $this->request
                    ->getFile(
                        'attachment'
                    );

            if (
                $genericFile &&
                $genericFile->isValid() &&
                !$genericFile->hasMoved()
            ) {

                $uploaded =
                    $this->uploadAttachmentFile(
                        $genericFile,
                        [
                            'name' =>
                                'Lampiran Tambahan',

                            'allowed_extensions' =>
                                null,

                            'max_file_size' =>
                                5,
                        ]
                    );

                $storedFiles[] =
                    $uploaded;

                $requirementFiles[] = [

                    'requirement_id' =>
                        null,

                    'requirement_name' =>
                        'Lampiran Tambahan',

                    'original_name' =>
                        $uploaded[
                            'original_name'
                        ],

                    'file_name' =>
                        $uploaded[
                            'file_name'
                        ],

                    'file_path' =>
                        $uploaded[
                            'file_path'
                        ],

                    'file_extension' =>
                        $uploaded[
                            'file_extension'
                        ],

                    'mime_type' =>
                        $uploaded[
                            'mime_type'
                        ],

                    'file_size' =>
                        $uploaded[
                            'file_size'
                        ],
                ];
            }

            // =====================================================
            // NOMOR TIKET
            // =====================================================

            $ticketNumber =
                'ULT-' .
                date('YmdHis') .
                random_int(100, 999);

            $now =
                date('Y-m-d H:i:s');

            // =====================================================
            // TRANSACTION
            // =====================================================

            $this->db->transBegin();

            // =====================================================
            // USER PROFILE
            // =====================================================

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

            // =====================================================
            // SERVICE REQUEST
            //
            // PENTING:
            // service_request_files membutuhkan
            // service_request_id.
            // =====================================================

            $serviceRequestId = null;

            if (
                $this->db->tableExists(
                    'service_requests'
                )
            ) {

                $serviceRequestColumns =
                    $this->db->getFieldNames(
                        'service_requests'
                    );

                $serviceRequestData = [];

                if (in_array(
                    'ticket_number',
                    $serviceRequestColumns,
                    true
                )) {
                    $serviceRequestData[
                        'ticket_number'
                    ] = $ticketNumber;
                }

                if (in_array(
                    'user_profile_id',
                    $serviceRequestColumns,
                    true
                )) {
                    $serviceRequestData[
                        'user_profile_id'
                    ] = $userProfileId;
                }

                if (in_array(
                    'service_id',
                    $serviceRequestColumns,
                    true
                )) {
                    $serviceRequestData[
                        'service_id'
                    ] = $serviceId;
                }

                if (in_array(
                    'unit_id',
                    $serviceRequestColumns,
                    true
                )) {
                    $serviceRequestData[
                        'unit_id'
                    ] = $unitId;
                }

                if (in_array(
                    'title',
                    $serviceRequestColumns,
                    true
                )) {
                    $serviceRequestData[
                        'title'
                    ] = $serviceName;
                }

                if (in_array(
                    'description',
                    $serviceRequestColumns,
                    true
                )) {
                    $serviceRequestData[
                        'description'
                    ] = $ticketDescription;
                }

                if (in_array(
                    'status',
                    $serviceRequestColumns,
                    true
                )) {
                    $serviceRequestData[
                        'status'
                    ] = 'submitted';
                }

                if (in_array(
                    'priority',
                    $serviceRequestColumns,
                    true
                )) {
                    $serviceRequestData[
                        'priority'
                    ] = 'normal';
                }

                if (in_array(
                    'submitted_at',
                    $serviceRequestColumns,
                    true
                )) {
                    $serviceRequestData[
                        'submitted_at'
                    ] = $now;
                }

                if (in_array(
                    'created_at',
                    $serviceRequestColumns,
                    true
                )) {
                    $serviceRequestData[
                        'created_at'
                    ] = $now;
                }

                if (in_array(
                    'updated_at',
                    $serviceRequestColumns,
                    true
                )) {
                    $serviceRequestData[
                        'updated_at'
                    ] = $now;
                }

                if (
                    !$this->db
                        ->table(
                            'service_requests'
                        )
                        ->insert(
                            $serviceRequestData
                        )
                ) {

                    $error =
                        $this->db->error();

                    throw new \RuntimeException(
                        'Service request gagal disimpan: ' .
                        (
                            $error['message']
                            ??
                            'Unknown database error'
                        )
                    );
                }

                $serviceRequestId =
                    (int)
                    $this->db->insertID();

                if (
                    $serviceRequestId <= 0
                ) {

                    throw new \RuntimeException(
                        'ID service request gagal diperoleh.'
                    );
                }
            }

            /*
             * Kalau ada lampiran tetapi tabel
             * service_requests tidak tersedia,
             * jangan lanjut karena file tidak akan
             * mempunyai parent.
             */
            if (
                !empty($requirementFiles) &&
                $serviceRequestId <= 0
            ) {

                throw new \RuntimeException(
                    'Lampiran tidak dapat disimpan karena service_requests tidak tersedia.'
                );
            }

            // =====================================================
            // TICKET
            // =====================================================

            $ticketData = [

                'ticket_number' =>
                    $ticketNumber,

                'user_profile_id' =>
                    $userProfileId,

                'service_id' =>
                    $serviceId,

                'unit_id' =>
                    $unitId,

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

            $inserted =
                $this->ticketModel
                    ->insert(
                        $ticketData
                    );

            if (!$inserted) {

                $modelErrors =
                    $this->ticketModel
                        ->errors();

                throw new \RuntimeException(
                    !empty($modelErrors)
                        ? implode(
                            ', ',
                            $modelErrors
                        )
                        : 'Data tiket gagal disimpan.'
                );
            }

            $ticketId =
                (int)
                $this->ticketModel
                    ->getInsertID();

            if ($ticketId <= 0) {

                throw new \RuntimeException(
                    'ID tiket gagal diperoleh setelah penyimpanan.'
                );
            }

            // =====================================================
            // SIMPAN SEMUA ATTACHMENT
            // =====================================================

            foreach (
                $requirementFiles
                as $attachment
            ) {

                $attachmentData = [

                    'service_request_id' =>
                        $serviceRequestId,

                    'requirement_id' =>
                        $attachment[
                            'requirement_id'
                        ],

                    'original_name' =>
                        $attachment[
                            'original_name'
                        ],

                    'file_name' =>
                        $attachment[
                            'file_name'
                        ],

                    'file_path' =>
                        $attachment[
                            'file_path'
                        ],

                    'file_extension' =>
                        $attachment[
                            'file_extension'
                        ],

                    'mime_type' =>
                        $attachment[
                            'mime_type'
                        ],

                    'file_size' =>
                        $attachment[
                            'file_size'
                        ],

                    'is_verified' =>
                        0,

                    'verified_by' =>
                        null,

                    'verified_at' =>
                        null,

                    'notes' =>
                        null,

                    'created_at' =>
                        $now,

                    'updated_at' =>
                        $now,
                ];

                /*
                 * Jangan menggunakan:
                 *
                 * ticket_id
                 *
                 * karena kolom tersebut memang
                 * tidak ada di service_request_files.
                 */

                if (
                    !$this->ticketAttachmentModel
                        ->insert(
                            $attachmentData
                        )
                ) {

                    $attachmentErrors =
                        $this->ticketAttachmentModel
                            ->errors();

                    throw new \RuntimeException(
                        !empty($attachmentErrors)
                            ? implode(
                                ', ',
                                $attachmentErrors
                            )
                            : 'Data lampiran gagal disimpan.'
                    );
                }
            }

            // =====================================================
            // CEK TRANSAKSI
            // =====================================================

            if (
                $this->db->transStatus() === false
            ) {

                throw new \RuntimeException(
                    'Transaksi database gagal.'
                );
            }

            $this->db->transCommit();

            // =====================================================
            // NOTIFIKASI PETUGAS
            // =====================================================

            $staffUsers =
                $this->db
                    ->table('users')
                    ->select('users.id')
                    ->join(
                        'roles',
                        'roles.id = users.role_id'
                    )
                    ->where(
                        'users.is_active',
                        1
                    )
                    ->whereIn(
                        'roles.code',
                        [
                            'SUPER_ADMIN',
                            'ADMIN_ULT',
                            'PETUGAS_AKADEMIK',
                            'PETUGAS_KEUANGAN',
                            'PETUGAS_UMUM'
                        ]
                    )
                    ->get()
                    ->getResultArray();

            foreach (
                $staffUsers
                as $staff
            ) {

                $notificationData = [

                    'user_id' =>
                        (int)
                        $staff['id'],

                    'service_request_id' =>
                        $serviceRequestId > 0
                            ? $serviceRequestId
                            : null,

                    'title' =>
                        'Tiket Walk In Baru',

                    'message' =>
                        'Tiket ' .
                        $ticketNumber .
                        ' dari ' .
                        $applicantName .
                        ' telah masuk melalui Laporan Tamu.',

                    'type' =>
                        'info',

                    'is_read' =>
                        0,

                    'read_at' =>
                        null,

                    'url' =>
                        base_url(
                            'datatiket'
                        ),

                    'created_at' =>
                        $now,

                    'updated_at' =>
                        $now,

                    'deleted_at' =>
                        null
                ];

                $this->notificationModel
                    ->insert(
                        $notificationData
                    );
            }

        } catch (\Throwable $e) {

            $this->db->transRollback();

            $this->cleanupUploadedFiles(
                $storedFiles
            );

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

        return redirect()
            ->to(
                base_url(
                    'guest-report'
                )
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

        $attachments = [];

        /*
         * Cari service_request berdasarkan
         * ticket_number, bukan tickets.id.
         */
        if (
            $this->db->tableExists(
                'service_requests'
            ) &&
            $this->db->tableExists(
                'service_request_files'
            )
        ) {

            $serviceRequest =
                $this->db
                    ->table(
                        'service_requests'
                    )
                    ->select('id')
                    ->where(
                        'ticket_number',
                        $ticket[
                            'ticket_number'
                        ] ?? ''
                    )
                    ->get()
                    ->getRowArray();

            if ($serviceRequest) {

                $attachments =
                    $this->ticketAttachmentModel
                        ->where(
                            'service_request_id',
                            (int)
                            $serviceRequest['id']
                        )
                        ->orderBy(
                            'id',
                            'ASC'
                        )
                        ->findAll();
            }
        }

        return view(
            'guest_report/detail',
            [
                'ticket' =>
                    $ticket,

                'attachments' =>
                    $attachments,
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
                $ticket[
                    'user_profile_id'
                ] ?? 0
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

        $applicantName =
            trim(
                (string) (
                    $this->request
                        ->getPost(
                            'applicant_name'
                        )
                    ?: $this->request
                        ->getPost(
                            'nama'
                        )
                )
            );

        $email =
            trim(
                (string)
                $this->request
                    ->getPost(
                        'email'
                    )
            );

        $phone =
            trim(
                (string) (
                    $this->request
                        ->getPost(
                            'phone'
                        )
                    ?: $this->request
                        ->getPost(
                            'hp'
                        )
                )
            );

        $nim =
            trim(
                (string)
                $this->request
                    ->getPost(
                        'nim'
                    )
            );

        $nik =
            trim(
                (string)
                $this->request
                    ->getPost(
                        'nik'
                    )
            );

        $institutionName =
            trim(
                (string) (
                    $this->request
                        ->getPost(
                            'instansi'
                        )
                    ?: $this->request
                        ->getPost(
                            'institution_name'
                        )
                )
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

        $unitId =
            (int) (
                $this->request
                    ->getPost(
                        'unit_id'
                    )
                ?: (
                    $ticket[
                        'unit_id'
                    ] ?? 0
                )
            );

        $currentServiceId =
            (int) (
                $ticket[
                    'service_id'
                ] ?? 0
            );

        $serviceId = null;
        $service = null;

        /*
         * UNIT LAYANAN TERPADU
         * Tidak memiliki master_services.
         */
        if ($unitId === 1) {

            $serviceId = null;

        } elseif ($unitId > 1) {

            /*
             * Jika unit yang dipilih sama dengan unit layanan
             * dari service lama, pertahankan service lama.
             */
            if ($currentServiceId > 0) {

                $currentServiceBuilder =
                    $this->db
                        ->table(
                            'master_services'
                        )
                        ->where(
                            'id',
                            $currentServiceId
                        )
                        ->where(
                            'service_unit_id',
                            $unitId
                        );

                $currentServiceColumns =
                    $this->db
                        ->getFieldNames(
                            'master_services'
                        );

                if (
                    in_array(
                        'is_active',
                        $currentServiceColumns,
                        true
                    )
                ) {

                    $currentServiceBuilder->where(
                        'is_active',
                        1
                    );
                }

                if (
                    in_array(
                        'deleted_at',
                        $currentServiceColumns,
                        true
                    )
                ) {

                    $currentServiceBuilder->where(
                        'deleted_at IS NULL',
                        null,
                        false
                    );
                }

                $service =
                    $currentServiceBuilder
                        ->get()
                        ->getRowArray();

                if (!empty($service)) {

                    $serviceId =
                        $currentServiceId;
                }
            }

            /*
             * Jika service lama tidak sesuai dengan unit baru,
             * ambil service aktif pertama dari unit tersebut.
             */
            if ($serviceId === null) {

                $serviceBuilder =
                    $this->db
                        ->table(
                            'master_services'
                        )
                        ->where(
                            'service_unit_id',
                            $unitId
                        );

                $serviceColumns =
                    $this->db
                        ->getFieldNames(
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
                        ->orderBy(
                            'sort_order',
                            'ASC'
                        )
                        ->orderBy(
                            'id',
                            'ASC'
                        )
                        ->get()
                        ->getRowArray();

                if (!empty($service)) {

                    $serviceId =
                        (int) $service['id'];
                }
            }
        }

        $this->db->transBegin();

        try {

            // =================================================
            // UPDATE PROFILE
            // =================================================

            $profileData = [];

            $profileColumns =
                $this->db
                    ->getFieldNames(
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

                $profileData[
                    'student_name'
                ] = $applicantName;
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
                $institutionName !== '' &&
                in_array(
                    'institution_name',
                    $profileColumns,
                    true
                )
            ) {

                $profileData[
                    'institution_name'
                ] = $institutionName;
            }

            if (
                in_array(
                    'updated_at',
                    $profileColumns,
                    true
                )
            ) {

                $profileData[
                    'updated_at'
                ] =
                    date(
                        'Y-m-d H:i:s'
                    );
            }

            if (!empty($profileData)) {

                $this->db
                    ->table(
                        'user_profiles'
                    )
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
                $this->db
                    ->getFieldNames(
                        'tickets'
                    );

            if (
                in_array(
                    'service_id',
                    $ticketColumns,
                    true
                )
            ) {

                $ticketUpdate[
                    'service_id'
                ] = $serviceId;
            }

            if (
                $unitId > 0 &&
                in_array(
                    'unit_id',
                    $ticketColumns,
                    true
                )
            ) {

                $ticketUpdate[
                    'unit_id'
                ] = $unitId;
            }

            if (
                $ticketTitle !== '' &&
                in_array(
                    'title',
                    $ticketColumns,
                    true
                )
            ) {

                $ticketUpdate[
                    'title'
                ] = $ticketTitle;
            }

            if (
                $ticketDescription !== '' &&
                in_array(
                    'description',
                    $ticketColumns,
                    true
                )
            ) {

                $ticketUpdate[
                    'description'
                ] = $ticketDescription;
            }

            if (
                in_array(
                    'updated_at',
                    $ticketColumns,
                    true
                )
            ) {

                $ticketUpdate[
                    'updated_at'
                ] =
                    date(
                        'Y-m-d H:i:s'
                    );
            }

            if (!empty($ticketUpdate)) {

                if (
                    !$this->ticketModel
                        ->update(
                            $id,
                            $ticketUpdate
                        )
                ) {

                    $errors =
                        $this->ticketModel
                            ->errors();

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
                base_url(
                    'guest-report'
                )
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
                    base_url(
                        'guest-report'
                    )
                )
                ->with(
                    'error',
                    'ID tiket tidak ditemukan.'
                );
        }

        $ticket =
            $this->ticketModel
                ->find($id);

        if (!$ticket) {

            return redirect()
                ->to(
                    base_url(
                        'guest-report'
                    )
                )
                ->with(
                    'error',
                    'Data tiket dengan ID ' .
                    $id .
                    ' tidak ditemukan.'
                );
        }

        /*
         * Cari service_request berdasarkan
         * ticket_number.
         */
        $serviceRequest = null;

        if (
            $this->db->tableExists(
                'service_requests'
            )
        ) {

            $serviceRequest =
                $this->db
                    ->table(
                        'service_requests'
                    )
                    ->select('id')
                    ->where(
                        'ticket_number',
                        $ticket[
                            'ticket_number'
                        ] ?? ''
                    )
                    ->get()
                    ->getRowArray();
        }

        $attachments = [];

        if (
            $serviceRequest &&
            $this->db->tableExists(
                'service_request_files'
            )
        ) {

            $attachments =
                $this->ticketAttachmentModel
                    ->where(
                        'service_request_id',
                        (int)
                        $serviceRequest['id']
                    )
                    ->findAll();
        }

        $this->db->transBegin();

        try {

            // =================================================
            // HAPUS FILE DATABASE
            // =================================================

            if (
                $serviceRequest &&
                !empty($attachments)
            ) {

                $deleted =
                    $this->ticketAttachmentModel
                        ->where(
                            'service_request_id',
                            (int)
                            $serviceRequest['id']
                        )
                        ->delete();

                if (!$deleted) {

                    throw new \RuntimeException(
                        'Data lampiran gagal dihapus.'
                    );
                }
            }

            // =================================================
            // HAPUS SERVICE REQUEST
            // =================================================

            if (
                $serviceRequest &&
                $this->db->tableExists(
                    'service_requests'
                )
            ) {

                $this->db
                    ->table(
                        'service_requests'
                    )
                    ->where(
                        'id',
                        (int)
                        $serviceRequest['id']
                    )
                    ->delete();
            }

            // =================================================
            // HAPUS TICKET
            // =================================================

            if (
                !$this->ticketModel
                    ->delete($id, true)
            ) {

                throw new \RuntimeException(
                    'Data tiket gagal dihapus.'
                );
            }

            if (
                $this->db->transStatus() === false
            ) {

                throw new \RuntimeException(
                    'Transaksi penghapusan gagal.'
                );
            }

            $this->db->transCommit();

            // =================================================
            // HAPUS FILE FISIK
            // =================================================

            foreach (
                $attachments as $attachment
            ) {

                $filePath =
                    (string) (
                        $attachment[
                            'file_path'
                        ] ?? ''
                    );

                if ($filePath === '') {
                    continue;
                }

                $physicalPath =
                    FCPATH .
                    ltrim(
                        $filePath,
                        '/\\'
                    );

                if (
                    is_file(
                        $physicalPath
                    )
                ) {

                    @unlink(
                        $physicalPath
                    );
                }
            }

            return redirect()
                ->to(
                    base_url(
                        'guest-report'
                    )
                )
                ->with(
                    'success',
                    'Laporan tamu berhasil dihapus.'
                );

        } catch (\Throwable $e) {

            $this->db->transRollback();

            log_message(
                'error',
                'GuestReport delete error: ' .
                $e->getMessage()
            );

            return redirect()
                ->to(
                    base_url(
                        'guest-report'
                    )
                )
                ->with(
                    'error',
                    'Gagal menghapus laporan tamu: ' .
                    $e->getMessage()
                );
        }
    }
}