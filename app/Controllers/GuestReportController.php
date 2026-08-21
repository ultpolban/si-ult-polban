<?php

namespace App\Controllers;

use App\Models\TicketModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class GuestReportController extends BaseController
{
    protected $ticketModel;
    protected $db;

    public function __construct()
    {
        $this->ticketModel = new TicketModel();
        $this->db = \Config\Database::connect();
    }

    // =========================================================
    // LIST DATA
    // =========================================================

  public function index()
{
    $keyword = $this->request->getGet('keyword');
    $status  = $this->request->getGet('status');

    $builder = $this->ticketModel
        ->select('
            tickets.*,
            COALESCE(user_profiles.name, user_profiles.student_name) AS applicant_name,
            master_services.name AS service_name
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
        );

    // Halaman ini khusus Walk In.
    if (in_array('submission_type', $this->db->getFieldNames('tickets'), true)) {
        $builder->where('tickets.submission_type', 'Walk In');
    }

    if (!empty($keyword)) {
        $builder
            ->groupStart()
                ->like('tickets.ticket_number', $keyword)
                ->orLike('user_profiles.name', $keyword)
                ->orLike('user_profiles.student_name', $keyword)
                ->orLike('master_services.name', $keyword)
                ->orLike('tickets.title', $keyword)
            ->groupEnd();
    }

    if (!empty($status)) {
        $builder->where('tickets.status', $status);
    }

    $tickets = $builder
        ->orderBy('tickets.submitted_at', 'DESC')
        ->paginate(10);

    return view('guest_report/index', [
        'tickets' => $tickets,
        'pager'   => $this->ticketModel->pager,
        'keyword' => $keyword,
        'status'  => $status,
    ]);
}
    // =========================================================
    // FORM CREATE / WALK IN
    // =========================================================

    public function create()
    {
        $units = [];

        if ($this->db->tableExists('master_service_units')) {

            $builder = $this->db->table('master_service_units');

            $columns = $this->db->getFieldNames(
                'master_service_units'
            );

            if (in_array('is_active', $columns)) {
                $builder->where('is_active', 1);
            }

            if (in_array('name', $columns)) {
                $builder->orderBy('name', 'ASC');
            }

            $units = $builder
                ->get()
                ->getResultArray();
        }

        return view('guest_report/create', [
            'units' => $units
        ]);
    }


    // =========================================================
    // AJAX
    // JENIS LAYANAN BERDASARKAN UNIT
    // =========================================================

    public function servicesByUnit($unitId)
    {
        $unitId = (int) $unitId;

        if ($unitId <= 0) {

            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Unit layanan tidak valid.',
                    'data'    => []
                ]);
        }

        // Cari tabel service
        $serviceTable = null;

        foreach ([
            'master_services',
            'services',
            'master_service'
        ] as $table) {

            if ($this->db->tableExists($table)) {
                $serviceTable = $table;
                break;
            }
        }

        if (!$serviceTable) {

            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Tabel layanan tidak ditemukan.',
                    'data'    => []
                ]);
        }

        $columns = $this->db->getFieldNames(
            $serviceTable
        );

        // Cari kolom relasi unit
        $unitColumn = null;

        foreach ([
            'unit_id',
            'service_unit_id',
            'master_service_unit_id'
        ] as $column) {

            if (in_array($column, $columns)) {
                $unitColumn = $column;
                break;
            }
        }

        if (!$unitColumn) {

            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => false,
                    'message' =>
                        'Kolom unit layanan pada tabel layanan tidak ditemukan.',
                    'data'    => []
                ]);
        }

        // Cari kolom nama service
        $nameColumn = null;

        foreach ([
            'name',
            'service_name',
            'nama',
            'title'
        ] as $column) {

            if (in_array($column, $columns)) {
                $nameColumn = $column;
                break;
            }
        }

        if (!$nameColumn) {

            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => false,
                    'message' =>
                        'Kolom nama layanan tidak ditemukan.',
                    'data'    => []
                ]);
        }

        // Query
        $builder = $this->db
            ->table($serviceTable)
            ->select(
                'id, ' . $nameColumn . ' AS name'
            )
            ->where(
                $unitColumn,
                $unitId
            );

        if (in_array('is_active', $columns)) {
            $builder->where('is_active', 1);
        }

        $builder->orderBy(
            $nameColumn,
            'ASC'
        );

        $services = $builder
            ->get()
            ->getResultArray();

        return $this->response
            ->setStatusCode(200)
            ->setJSON($services);
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
                ->setJSON([]);
        }

        // Cari tabel requirement
        $requirementTable = null;

        foreach ([
            'service_requirements',
            'master_service_requirements',
            'requirements'
        ] as $table) {

            if ($this->db->tableExists($table)) {
                $requirementTable = $table;
                break;
            }
        }

        if (!$requirementTable) {

            return $this->response
                ->setStatusCode(200)
                ->setJSON([]);
        }

        $columns = $this->db->getFieldNames(
            $requirementTable
        );

        // Cari kolom service
        $serviceColumn = null;

        foreach ([
            'service_id',
            'master_service_id'
        ] as $column) {

            if (in_array($column, $columns)) {
                $serviceColumn = $column;
                break;
            }
        }

        if (!$serviceColumn) {

            return $this->response
                ->setStatusCode(200)
                ->setJSON([]);
        }

        // Cari nama requirement
        $nameColumn = null;

        foreach ([
            'name',
            'requirement_name',
            'nama',
            'title'
        ] as $column) {

            if (in_array($column, $columns)) {
                $nameColumn = $column;
                break;
            }
        }

        if (!$nameColumn) {

            return $this->response
                ->setStatusCode(200)
                ->setJSON([]);
        }

        // SELECT
        $select = [
            'id',
            $nameColumn . ' AS name'
        ];

        if (in_array('description', $columns)) {
            $select[] = 'description';
        } else {
            $select[] = "'' AS description";
        }

        if (in_array('is_required', $columns)) {
            $select[] = 'is_required';
        } else {
            $select[] = '1 AS is_required';
        }

        if (in_array('allowed_extensions', $columns)) {
            $select[] = 'allowed_extensions';
        } else {
            $select[] = "'' AS allowed_extensions";
        }

        $builder = $this->db
            ->table($requirementTable)
            ->select(
                implode(', ', $select)
            )
            ->where(
                $serviceColumn,
                $serviceId
            );

        if (in_array('is_active', $columns)) {
            $builder->where('is_active', 1);
        }

        if (in_array('sort_order', $columns)) {

            $builder->orderBy(
                'sort_order',
                'ASC'
            );

        } elseif (in_array('display_order', $columns)) {

            $builder->orderBy(
                'display_order',
                'ASC'
            );

        } else {

            $builder->orderBy(
                'id',
                'ASC'
            );
        }

        $requirements = $builder
            ->get()
            ->getResultArray();

        return $this->response
            ->setStatusCode(200)
            ->setJSON($requirements);
    }


    // =========================================================
    // HELPER
    // HANYA SIMPAN KOLOM YANG ADA DI DATABASE
    // =========================================================

    // =========================================================
    // PEMOHON / USER PROFILE
    // =========================================================

    /**
     * Ambil user_profile_id yang sudah ada atau buat profile baru.
     * Dibutuhkan karena tickets.user_profile_id memiliki foreign key
     * ke user_profiles.id.
     */
    private function identityConfig(string $applicantType): array
    {
        $map = [
            'Mahasiswa' => ['type' => 'NIM', 'column' => 'nim'],
            'Dosen' => ['type' => 'NIP', 'column' => 'nim'],
            'Tendik' => ['type' => 'NIP', 'column' => 'nim'],
            'Orang Tua' => ['type' => 'NIK', 'column' => 'nik'],
            'Orang Tua / Wali' => ['type' => 'NIK', 'column' => 'nik'],
            'Alumni' => ['type' => 'NIM', 'column' => 'nim'],
            'Mitra' => ['type' => 'NIK / Identitas', 'column' => 'nik'],
            'Public' => ['type' => 'NIK', 'column' => 'nik'],
            'Masyarakat' => ['type' => 'NIK', 'column' => 'nik'],
            'Masyarakat Umum' => ['type' => 'NIK', 'column' => 'nik'],
        ];

        return $map[$applicantType] ?? ['type' => 'NIM / NIP / NIK', 'column' => 'nim'];
    }

    private function resolveApplicantTypeId(string $applicantType): ?int
    {
        if (! $this->db->tableExists('master_applicant_types')) {
            return null;
        }

        $aliases = [
            $applicantType,
            $applicantType === 'Orang Tua' ? 'Orang Tua / Wali' : null,
            $applicantType === 'Masyarakat' ? 'Masyarakat Umum' : null,
        ];

        foreach (array_filter($aliases) as $name) {
            $row = $this->db->table('master_applicant_types')
                ->select('id')
                ->where('name', $name)
                ->where('deleted_at IS NULL', null, false)
                ->get()
                ->getRowArray();

            if ($row) {
                return (int) $row['id'];
            }
        }

        return null;
    }

    private function getOrCreateUserProfileId(string $applicantType, array $formData): int
    {
        $table = 'user_profiles';
        $columns = $this->db->getFieldNames($table);
        $identityConfig = $this->identityConfig($applicantType);
        $identityNumber = trim((string) ($formData['identity_number'] ?? ''));
        $name = trim((string) ($formData['applicant_name'] ?? ''));
        $email = trim((string) ($formData['email'] ?? ''));
        $phone = trim((string) ($formData['phone'] ?? ''));

        $existing = null;

        if ($email !== '' && in_array('email', $columns, true)) {
            $existing = $this->db->table($table)
                ->where('email', $email)
                ->where('deleted_at IS NULL', null, false)
                ->get()
                ->getRowArray();
        }

        if (! $existing && $identityNumber !== '' && in_array($identityConfig['column'], $columns, true)) {
            $existing = $this->db->table($table)
                ->where($identityConfig['column'], $identityNumber)
                ->where('deleted_at IS NULL', null, false)
                ->get()
                ->getRowArray();
        }

        if ($existing && isset($existing['id'])) {
            $updates = [];
            $typeId = $this->resolveApplicantTypeId($applicantType);
            if ($typeId && in_array('applicant_type_id', $columns, true)) {
                $updates['applicant_type_id'] = $typeId;
            }
            if ($identityNumber !== '' && in_array($identityConfig['column'], $columns, true)) {
                $updates[$identityConfig['column']] = $identityNumber;
            }
            if ($name !== '' && in_array('name', $columns, true)) {
                $updates['name'] = $name;
            }
            if ($email !== '' && in_array('email', $columns, true)) {
                $updates['email'] = $email;
            }
            if ($phone !== '' && in_array('phone', $columns, true)) {
                $updates['phone'] = $phone;
            }
            if (in_array('updated_at', $columns, true)) {
                $updates['updated_at'] = date('Y-m-d H:i:s');
            }
            if (! empty($updates)) {
                $this->db->table($table)->where('id', $existing['id'])->update($updates);
            }
            return (int) $existing['id'];
        }

        $profile = [];
        $sessionUserId = session()->get('user_id');
        if ($sessionUserId === null) {
            $sessionUserId = session()->get('id');
        }
        if ($sessionUserId !== null && $sessionUserId !== '' && in_array('user_id', $columns, true)) {
            $profile['user_id'] = (int) $sessionUserId;
        }
        if (! isset($profile['user_id']) && in_array('user_id', $columns, true)) {
            throw new \RuntimeException('User login tidak ditemukan. Silakan login kembali sebelum menambahkan Walk In.');
        }

        if (in_array('name', $columns, true)) {
            $profile['name'] = $name;
        }
        if (in_array('student_name', $columns, true) && $applicantType === 'Mahasiswa') {
            $profile['student_name'] = $name;
        }
        if (in_array('nim', $columns, true)) {
            $profile['nim'] = $identityConfig['column'] === 'nim' && $identityNumber !== '' ? $identityNumber : null;
        }
        if (in_array('nik', $columns, true)) {
            $profile['nik'] = $identityConfig['column'] === 'nik' && $identityNumber !== '' ? $identityNumber : null;
        }
        if (in_array('email', $columns, true)) {
            $profile['email'] = $email !== '' ? $email : null;
        }
        if (in_array('phone', $columns, true)) {
            $profile['phone'] = $phone !== '' ? $phone : null;
        }
        if (in_array('address', $columns, true)) {
            $profile['address'] = trim((string) ($formData['address'] ?? '')) ?: null;
        }
        if (in_array('institution_name', $columns, true)) {
            $profile['institution_name'] = trim((string) ($formData['institution_name'] ?? '')) ?: null;
        }
        if (in_array('position', $columns, true)) {
            $profile['position'] = trim((string) ($formData['position'] ?? '')) ?: null;
        }

        $typeId = $this->resolveApplicantTypeId($applicantType);
        if ($typeId && in_array('applicant_type_id', $columns, true)) {
            $profile['applicant_type_id'] = $typeId;
        }
        if (! empty($formData['study_program_id']) && ctype_digit((string) $formData['study_program_id']) && in_array('study_program_id', $columns, true)) {
            $profile['study_program_id'] = (int) $formData['study_program_id'];
        }
        if (! empty($formData['class_id']) && ctype_digit((string) $formData['class_id']) && in_array('class_id', $columns, true)) {
            $profile['class_id'] = (int) $formData['class_id'];
        }
        if (in_array('created_at', $columns, true)) {
            $profile['created_at'] = date('Y-m-d H:i:s');
        }
        if (in_array('updated_at', $columns, true)) {
            $profile['updated_at'] = date('Y-m-d H:i:s');
        }

        if (! $this->db->table($table)->insert($profile)) {
            $error = $this->db->error();
            throw new \RuntimeException('Profil pemohon gagal disimpan: ' . ($error['message'] ?? 'Unknown database error'));
        }

        return (int) $this->db->insertID();
    }

    private function collectFormData(string $applicantType, string $identityType, string $identityNumber, string $serviceName, int $unitId, int $serviceId, ?string $attachment): array
    {
        $data = [
            'applicant_type'   => $applicantType,
            'identity_type'    => $identityType,
            'identity_number'  => $identityNumber,
            'email'            => trim((string) $this->request->getPost('email')),
            'phone'            => trim((string) $this->request->getPost('phone')),
            'service_id'       => $serviceId,
            'service_name'     => $serviceName,
            'unit_id'          => $unitId,
            'description'      => trim((string) $this->request->getPost('ticket_description')),
            'attachment'       => $attachment,
        ];

        $fieldMap = [
            'Mahasiswa' => ['program_studi', 'jurusan', 'angkatan', 'class_id', 'study_program_id'],
            'Dosen' => ['prodi_dosen', 'fakultas', 'jabatan_dosen'],
            'Tendik' => ['unit_kerja', 'jabatan_tendik'],
            'Orang Tua' => ['nama_mahasiswa', 'nim_mahasiswa', 'hubungan'],
            'Alumni' => ['prodi_alumni', 'tahun_lulus'],
            'Mitra' => ['instansi', 'pic', 'jabatan_mitra'],
            'Public' => ['instansi_public', 'alamat_public'],
            'Masyarakat' => ['alamat', 'pekerjaan'],
        ];

        foreach ($fieldMap[$applicantType] ?? [] as $field) {
            $value = $this->request->getPost($field);
            if ($value !== null && trim((string) $value) !== '') {
                $data[$field] = is_string($value) ? trim($value) : $value;
            }
        }

        $data['address'] = $data['alamat'] ?? $data['alamat_public'] ?? '';
        $data['institution_name'] = $data['instansi'] ?? $data['instansi_public'] ?? '';
        $data['position'] = $data['pekerjaan'] ?? $data['jabatan_dosen'] ?? $data['jabatan_tendik'] ?? $data['jabatan_mitra'] ?? '';
        $data['applicant_name'] = trim((string) $this->request->getPost('applicant_name'));

        return $data;
    }

    private function filterTicketColumns(array $data)
    {
        $columns = $this->db->getFieldNames($this->ticketModel->getTable());
        $filtered = [];
        foreach ($data as $key => $value) {
            if (in_array($key, $columns, true)) {
                $filtered[$key] = $value;
            }
        }
        return $filtered;
    }

    // =========================================================
    // SIMPAN WALK IN
    // =========================================================

    public function store()
    {
        helper(['form']);

        $rules = [
            'applicant_name' => 'required',
            'applicant_type' => 'required',
            'unit_id'        => 'required|integer',
            'service_id'     => 'required|integer',
            'ticket_description' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $unitId = (int) $this->request->getPost('unit_id');
        $serviceId = (int) $this->request->getPost('service_id');
        $applicantType = trim((string) $this->request->getPost('applicant_type'));
        $identityConfig = $this->identityConfig($applicantType);
        $identityNumber = trim((string) $this->request->getPost('nim'));

        $service = $this->db->table('master_services')
            ->where('id', $serviceId)
            ->where('service_unit_id', $unitId)
            ->where('is_active', 1)
            ->get()
            ->getRowArray();

        if (! $service) {
            return redirect()->back()->withInput()->with('errors', [
                'service_id' => 'Jenis layanan tidak sesuai dengan unit layanan yang dipilih.'
            ]);
        }

        $serviceName = (string) $service['name'];
        $ticketNumber = 'ULT-' . date('YmdHis') . random_int(100, 999);

        $attachment = null;
        $file = $this->request->getFile('attachment');
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $allowed = ['pdf', 'jpg', 'jpeg', 'png'];
            $ext = strtolower($file->getExtension());
            if (! in_array($ext, $allowed, true)) {
                return redirect()->back()->withInput()->with('errors', ['attachment' => 'Format file harus PDF, JPG, JPEG atau PNG.']);
            }
            if ($file->getSize() > 5 * 1024 * 1024) {
                return redirect()->back()->withInput()->with('errors', ['attachment' => 'Ukuran file maksimal 5 MB.']);
            }
            $uploadPath = FCPATH . 'uploads';
            if (! is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            $attachment = $file->getRandomName();
            $file->move($uploadPath, $attachment);
        }

        $formData = $this->collectFormData(
            $applicantType,
            $identityConfig['type'],
            $identityNumber,
            $serviceName,
            $unitId,
            $serviceId,
            $attachment
        );

        $transactionStarted = false;
        try {
            $this->db->transBegin();
            $transactionStarted = true;

            $userProfileId = $this->getOrCreateUserProfileId($applicantType, $formData);

            $ticketData = [
                'ticket_number'   => $ticketNumber,
                'user_profile_id' => $userProfileId,
                'service_id'      => $serviceId,
                'title'           => $serviceName,
                'description'     => trim((string) $this->request->getPost('ticket_description')),
                'status'          => 'submitted',
                'priority'        => 'normal',
                'submitted_at'    => date('Y-m-d H:i:s'),
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
                'submission_type' => 'Walk In',
                'form_data'       => json_encode($formData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            ];

            $ticketData = $this->filterTicketColumns($ticketData);

            if (! $this->ticketModel->insert($ticketData)) {
                throw new \RuntimeException(implode(', ', $this->ticketModel->errors()) ?: 'Data tiket gagal disimpan.');
            }

            if ($this->db->transStatus() === false) {
                throw new \RuntimeException('Transaksi database gagal.');
            }

            $this->db->transCommit();
        } catch (\Throwable $e) {
            if ($transactionStarted) {
                $this->db->transRollback();
            }
            log_message('error', 'GuestReport store error: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('errors', ['database' => 'Data gagal disimpan: ' . $e->getMessage()]);
        }

        return redirect()->to('/guest-report')->with('success', 'Laporan Walk In berhasil ditambahkan.');
    }

    // =========================================================
    // DETAIL
    // =========================================================

    public function detail($id)
    {
        $ticket =
            $this->ticketModel->find($id);

        if (!$ticket) {
            throw PageNotFoundException
                ::forPageNotFound();
        }

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
            $this->ticketModel->find($id);

        if (!$ticket) {
            throw PageNotFoundException
                ::forPageNotFound();
        }

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
            $this->ticketModel->find($id);

        if (!$ticket) {
            throw PageNotFoundException
                ::forPageNotFound();
        }


        $attachment =
            $ticket['attachment'] ?? null;


        // -----------------------------------------------------
        // UPLOAD
        // -----------------------------------------------------

        $uploadPath =
            FCPATH . 'uploads';

        if (!is_dir($uploadPath)) {

            mkdir(
                $uploadPath,
                0777,
                true
            );
        }


        $file =
            $this->request->getFile(
                'attachment'
            );


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


            $extension =
                strtolower(
                    $file->getExtension()
                );


            if (
                !in_array(
                    $extension,
                    $allowed
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


            if (
                !empty($attachment) &&
                file_exists(
                    $uploadPath .
                    '/' .
                    $attachment
                )
            ) {

                unlink(
                    $uploadPath .
                    '/' .
                    $attachment
                );
            }


            $attachment =
                $file->getRandomName();


            $file->move(
                $uploadPath,
                $attachment
            );
        }


        // -----------------------------------------------------
        // DATA UPDATE
        // -----------------------------------------------------

        $data = [

            'service_name' =>
                $this->request->getPost(
                    'service_name'
                ),

            'ticket_title' =>
                $this->request->getPost(
                    'ticket_title'
                ),

            'ticket_description' =>
                $this->request->getPost(
                    'ticket_description'
                ),

            'applicant_name' =>
                $this->request->getPost(
                    'applicant_name'
                ),

            'applicant_type' =>
                $this->request->getPost(
                    'applicant_type'
                ),

            'nim' =>
                $this->request->getPost(
                    'nim'
                ),

            'email' =>
                $this->request->getPost(
                    'email'
                ),

            'phone' =>
                $this->request->getPost(
                    'phone'
                ),


            // MAHASISWA

            'program_studi' =>
                $this->request->getPost(
                    'program_studi'
                ),

            'jurusan' =>
                $this->request->getPost(
                    'jurusan'
                ),

            'angkatan' =>
                $this->request->getPost(
                    'angkatan'
                ),


            // DOSEN

            'prodi_dosen' =>
                $this->request->getPost(
                    'prodi_dosen'
                ),

            'fakultas' =>
                $this->request->getPost(
                    'fakultas'
                ),

            'jabatan_dosen' =>
                $this->request->getPost(
                    'jabatan_dosen'
                ),


            // TENDIK

            'unit_kerja' =>
                $this->request->getPost(
                    'unit_kerja'
                ),

            'jabatan_tendik' =>
                $this->request->getPost(
                    'jabatan_tendik'
                ),


            // ORANG TUA

            'nama_mahasiswa' =>
                $this->request->getPost(
                    'nama_mahasiswa'
                ),

            'nim_mahasiswa' =>
                $this->request->getPost(
                    'nim_mahasiswa'
                ),

            'hubungan' =>
                $this->request->getPost(
                    'hubungan'
                ),


            // ALUMNI

            'prodi_alumni' =>
                $this->request->getPost(
                    'prodi_alumni'
                ),

            'tahun_lulus' =>
                $this->request->getPost(
                    'tahun_lulus'
                ),


            // MITRA

            'instansi' =>
                $this->request->getPost(
                    'instansi'
                ),

            'pic' =>
                $this->request->getPost(
                    'pic'
                ),

            'jabatan_mitra' =>
                $this->request->getPost(
                    'jabatan_mitra'
                ),


            // PUBLIC

            'instansi_public' =>
                $this->request->getPost(
                    'instansi_public'
                ),

            'alamat_public' =>
                $this->request->getPost(
                    'alamat_public'
                ),


            // MASYARAKAT

            'alamat' =>
                $this->request->getPost(
                    'alamat'
                ),

            'pekerjaan' =>
                $this->request->getPost(
                    'pekerjaan'
                ),

            'attachment' =>
                $attachment
        ];


        // Filter kolom
        $data =
            $this->filterTicketColumns(
                $data
            );


        // Update
        try {

            $updated =
                $this->ticketModel->update(
                    $id,
                    $data
                );

            if (!$updated) {

                $errors =
                    $this->ticketModel->errors();

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'errors',
                        [
                            'database' =>
                                !empty($errors)
                                ? implode(
                                    ', ',
                                    $errors
                                )
                                : 'Data gagal diubah.'
                        ]
                    );
            }

        } catch (\Throwable $e) {

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
            ->to('/guest-report')
            ->with(
                'success',
                'Data berhasil diubah.'
            );
    }


   public function delete($id = null)
{
    if (!$id) {
        return redirect()->to(base_url('guest-report'))
            ->with('error', 'ID tiket tidak ditemukan.');
    }

    $ticket = $this->ticketModel->find($id);

    if (!$ticket) {
        return redirect()->to(base_url('guest-report'))
            ->with('error', 'Data tiket dengan ID ' . $id . ' tidak ditemukan.');
    }

    // Hapus attachment jika ada
    if (!empty($ticket['attachment'])) {
        $filePath = WRITEPATH . 'uploads/' . $ticket['attachment'];

        if (is_file($filePath)) {
            unlink($filePath);
        }
    }

    // Hapus tiket
    if ($this->ticketModel->delete($id)) {
        return redirect()->to(base_url('guest-report'))
            ->with('success', 'Laporan tamu berhasil dihapus.');
    }

    return redirect()->to(base_url('guest-report'))
        ->with('error', 'Gagal menghapus laporan tamu.');
}
}