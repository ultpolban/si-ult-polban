<?php

namespace App\Controllers;

use App\Models\ServiceRequestModel;
use App\Models\UserProfileModel;
use App\Models\MasterServiceModel;
use App\Models\MasterServiceUnitModel;

class TendikTicketController extends BaseController
{
    protected ServiceRequestModel $serviceRequestModel;
    protected UserProfileModel $userProfileModel;
    protected MasterServiceModel $serviceModel;
    protected MasterServiceUnitModel $serviceUnitModel;

    public function __construct()
    {
        helper(['form', 'url']);

        $this->serviceRequestModel = new ServiceRequestModel();
        $this->userProfileModel    = new UserProfileModel();
        $this->serviceModel        = new MasterServiceModel();
        $this->serviceUnitModel    = new MasterServiceUnitModel();
    }

    // =========================================================
    // FORM AJUKAN LAYANAN
    // =========================================================
    public function create()
    {
        $user = session()->get('user') ?? [];

        $userId = (int) session()->get('user_id');

        if ($userId <= 0) {
            return redirect()
                ->to('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // -----------------------------------------------------
        // PROFILE USER
        // -----------------------------------------------------
        $profile = $this->userProfileModel
            ->findByUser($userId);

        if (!$profile) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Profil pengguna belum tersedia.'
                );
        }

        // -----------------------------------------------------
        // UNIT LAYANAN AKTIF
        // -----------------------------------------------------
        $units = $this->serviceUnitModel
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->orderBy('name', 'ASC')
            ->findAll();

        // -----------------------------------------------------
        // SEMUA LAYANAN AKTIF
        // -----------------------------------------------------
        $services = $this->serviceModel
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->orderBy('name', 'ASC')
            ->findAll();

        $data = [
            'title'    => 'Ajukan Layanan',
            'user'     => $user,
            'profile'  => $profile,
            'units'    => $units,
            'services' => $services,
        ];

        return view(
            'tendik/ticket/create',
            $data
        );
    }


    // =========================================================
    // PROSES SIMPAN / AJUKAN LAYANAN
    // =========================================================
    public function store()
    {
        // -----------------------------------------------------
        // CEK LOGIN
        // -----------------------------------------------------
        $userId = (int) session()->get('user_id');

        if ($userId <= 0) {
            return redirect()
                ->to('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // -----------------------------------------------------
        // AMBIL PROFILE
        // -----------------------------------------------------
        $profile = $this->userProfileModel
            ->findByUser($userId);

        if (!$profile) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Profil pengguna belum tersedia.'
                );
        }

        // -----------------------------------------------------
        // DATA FORM
        // -----------------------------------------------------
        $unitTujuan = trim(
            (string) $this->request->getPost('unit_tujuan')
        );

        $jenisLayanan = trim(
            (string) $this->request->getPost('jenis_layanan')
        );

        $judul = trim(
            (string) $this->request->getPost('judul')
        );

        $keterangan = trim(
            (string) $this->request->getPost('keterangan')
        );

        $priority = trim(
            (string) $this->request->getPost('priority')
        );

        $action = trim(
            (string) $this->request->getPost('action')
        );

        // requirement_id opsional dari form
        $requirementId = $this->request->getPost('requirement_id');

        $requirementId = !empty($requirementId)
            ? (int) $requirementId
            : null;


        // -----------------------------------------------------
        // VALIDASI
        // -----------------------------------------------------
        if (
            $unitTujuan === '' ||
            $jenisLayanan === '' ||
            $judul === '' ||
            $keterangan === ''
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Mohon lengkapi semua data yang wajib diisi.'
                );
        }


        // -----------------------------------------------------
        // PRIORITY
        // -----------------------------------------------------
        if (
            !in_array(
                $priority,
                ['low', 'normal', 'high', 'urgent'],
                true
            )
        ) {
            $priority = 'normal';
        }


        // -----------------------------------------------------
        // VALIDASI SERVICE
        //
        // jenis_layanan dianggap ID master_services
        // -----------------------------------------------------
        $serviceId = (int) $jenisLayanan;

        if ($serviceId <= 0) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Jenis layanan tidak valid.'
                );
        }

        $service = $this->serviceModel
            ->where('id', $serviceId)
            ->where('is_active', 1)
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


        // -----------------------------------------------------
        // VALIDASI UNIT
        //
        // unit_tujuan dianggap ID master_service_units
        // -----------------------------------------------------
        $serviceUnitId = (int) $unitTujuan;

        if ($serviceUnitId <= 0) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Unit tujuan tidak valid.'
                );
        }

        $serviceUnit = $this->serviceUnitModel
            ->where('id', $serviceUnitId)
            ->where('is_active', 1)
            ->first();

        if (!$serviceUnit) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Unit layanan tidak ditemukan.'
                );
        }


        // -----------------------------------------------------
        // PASTIKAN SERVICE MEMANG MILIK UNIT TERSEBUT
        // -----------------------------------------------------
        if (
            (int) ($service['service_unit_id'] ?? 0)
            !==
            $serviceUnitId
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Layanan tidak tersedia pada unit tujuan yang dipilih.'
                );
        }


        // -----------------------------------------------------
        // STATUS
        // -----------------------------------------------------
        $status = $action === 'draft'
            ? 'draft'
            : 'submitted';


        // -----------------------------------------------------
        // NOMOR TIKET
        // -----------------------------------------------------
        $ticketNumber = $this->generateTicketNumber();


        // -----------------------------------------------------
        // DATA SERVICE REQUEST
        // -----------------------------------------------------
        $ticketData = [

            'ticket_number' =>
                $ticketNumber,

            'user_profile_id' =>
                (int) $profile['id'],

            'service_id' =>
                $serviceId,

            'title' =>
                $judul,

            'description' =>
                $keterangan,

            'status' =>
                $status,

            'priority' =>
                $priority,

            'assigned_to' =>
                null,

            'submitted_at' =>
                $status === 'submitted'
                    ? date('Y-m-d H:i:s')
                    : null,

            'created_at' =>
                date('Y-m-d H:i:s'),

            'updated_at' =>
                date('Y-m-d H:i:s'),
        ];


        // =====================================================
        // TRANSACTION
        // =====================================================
        $db = db_connect();

        $db->transStart();

        // -----------------------------------------------------
        // INSERT SERVICE REQUEST
        // -----------------------------------------------------
        $requestId =
            $this->serviceRequestModel
                ->insert(
                    $ticketData,
                    true
                );

        if (!$requestId) {

            $db->transRollback();

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Pengajuan gagal disimpan.'
                );
        }


        // -----------------------------------------------------
        // FILE DOKUMEN
        // -----------------------------------------------------
        $dokumen =
            $this->request
                ->getFile('dokumen');


        if (
            $dokumen &&
            $dokumen->getError()
            !==
            UPLOAD_ERR_NO_FILE
        ) {

            $documentData =
                $this->processDocument(
                    $dokumen
                );

            if ($documentData === false) {

                $db->transRollback();

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Dokumen gagal diupload. Pastikan format dan ukuran file sesuai.'
                    );
            }


            // -------------------------------------------------
            // requirement_id WAJIB
            // -------------------------------------------------
            if (!$requirementId) {

                $db->transRollback();

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Requirement dokumen belum dipilih.'
                    );
            }


            // -------------------------------------------------
            // SIMPAN FILE
            // -------------------------------------------------
            $fileModel =
                db_connect()
                    ->table('service_request_files');

            $fileModel->insert([

                'service_requests_id' =>
                    $requestId,

                'requirement_id' =>
                    $requirementId,

                'original_name' =>
                    $documentData['nama_asli'],

                'file_name' =>
                    $documentData['nama_file'],

                'file_path' =>
                    $documentData['path'],

                'file_extension' =>
                    $documentData['extension'],

                'mime_type' =>
                    $documentData['mime_type'],

                'file_size' =>
                    $documentData['ukuran'],

                'is_verified' =>
                    0,

                'created_at' =>
                    date('Y-m-d H:i:s'),

                'updated_at' =>
                    date('Y-m-d H:i:s'),
            ]);
        }


        // -----------------------------------------------------
        // LOG
        // -----------------------------------------------------
        $this->createLog(
            $requestId,
            $userId,
            null,
            $status,
            $status === 'draft'
                ? 'CREATE_DRAFT'
                : 'SUBMIT',
            $status === 'draft'
                ? 'Pengajuan disimpan sebagai draft.'
                : 'Pengajuan layanan berhasil dikirim.'
        );


        $db->transComplete();


        // -----------------------------------------------------
        // CEK TRANSACTION
        // -----------------------------------------------------
        if ($db->transStatus() === false) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Terjadi kesalahan saat menyimpan pengajuan.'
                );
        }


        // =====================================================
        // DRAFT
        // =====================================================
        if ($status === 'draft') {

            return redirect()
                ->to(
                    base_url(
                        'tendik/ticket/draft'
                    )
                )
                ->with(
                    'success',
                    'Pengajuan berhasil disimpan sebagai draft.'
                );
        }


        // =====================================================
        // SUBMIT
        // =====================================================
        return redirect()
            ->to(
                base_url(
                    'tendik/ticket/success'
                )
            )
            ->with(
                'ticket_number',
                $ticketNumber
            );
    }


    // =========================================================
    // GENERATE NOMOR TIKET
    // =========================================================
    private function generateTicketNumber(): string
    {
        do {

            $number =
                'TEN-' .
                date('YmdHis') .
                '-' .
                random_int(100, 999);

            $exists =
                $this->serviceRequestModel
                    ->where(
                        'ticket_number',
                        $number
                    )
                    ->first();

        } while ($exists);

        return $number;
    }


    // =========================================================
    // PROSES UPLOAD DOKUMEN
    // =========================================================
    private function processDocument($dokumen)
    {
        // -----------------------------------------------------
        // TIDAK ADA FILE
        // -----------------------------------------------------
        if (
            !$dokumen ||
            $dokumen->getError()
            === UPLOAD_ERR_NO_FILE
        ) {
            return null;
        }


        // -----------------------------------------------------
        // VALIDASI FILE
        // -----------------------------------------------------
        if (!$dokumen->isValid()) {
            return false;
        }


        // -----------------------------------------------------
        // MAX 2 MB
        // -----------------------------------------------------
        if (
            $dokumen->getSize()
            >
            2 * 1024 * 1024
        ) {
            return false;
        }


        // -----------------------------------------------------
        // EXTENSION
        // -----------------------------------------------------
        $allowedExtensions = [

            'pdf',
            'doc',
            'docx',
            'jpg',
            'jpeg',
            'png',

        ];


        $extension =
            strtolower(
                $dokumen->getClientExtension()
            );


        if (
            !in_array(
                $extension,
                $allowedExtensions,
                true
            )
        ) {
            return false;
        }


        // -----------------------------------------------------
        // MIME TYPE
        // -----------------------------------------------------
        $mimeType =
            $dokumen->getMimeType();


        // -----------------------------------------------------
        // FOLDER
        // -----------------------------------------------------
        $uploadPath =
            WRITEPATH .
            'uploads/service_requests/';


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


        // -----------------------------------------------------
        // RANDOM NAME
        // -----------------------------------------------------
        $newName =
            $dokumen->getRandomName();


        // -----------------------------------------------------
        // MOVE
        // -----------------------------------------------------
        if (
            !$dokumen->move(
                $uploadPath,
                $newName
            )
        ) {
            return false;
        }


        return [

            'nama_asli' =>
                $dokumen
                    ->getClientName(),

            'nama_file' =>
                $newName,

            'path' =>
                'uploads/service_requests/' .
                $newName,

            'ukuran' =>
                $dokumen
                    ->getSize(),

            'extension' =>
                $extension,

            'mime_type' =>
                $mimeType,
        ];
    }


    // =========================================================
    // SUCCESS
    // =========================================================
    public function success()
    {
        $ticketNumber =
            session()->getFlashdata(
                'ticket_number'
            );

        $ticket = null;

        if ($ticketNumber) {

            $ticket =
                $this->serviceRequestModel
                    ->where(
                        'ticket_number',
                        $ticketNumber
                    )
                    ->first();
        }


        $data = [

            'title' =>
                'Pengajuan Berhasil',

            'ticket' =>
                $ticket,

        ];


        return view(
            'tendik/ticket/success',
            $data
        );
    }


    // =========================================================
    // HISTORY / TRACKING
    // =========================================================
    public function history()
    {
        $userId =
            (int) session()->get(
                'user_id'
            );

        if ($userId <= 0) {
            return redirect()
                ->to('/login');
        }


        // -----------------------------------------------------
        // AMBIL PROFILE
        // -----------------------------------------------------
        $profile =
            $this->userProfileModel
                ->findByUser($userId);


        if (!$profile) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Profil pengguna tidak ditemukan.'
                );
        }


        // -----------------------------------------------------
        // TIKET USER
        // -----------------------------------------------------
        $tickets =
            $this->serviceRequestModel

                ->select('
                    service_requests.*,

                    master_services.name AS service_name,
                    master_services.code AS service_code,

                    master_service_units.name AS unit_name

                ')

                ->join(
                    'master_services',
                    'master_services.id = service_requests.service_id'
                )

                ->join(
                    'master_service_units',
                    'master_service_units.id = master_services.service_unit_id'
                )

                ->where(
                    'service_requests.user_profile_id',
                    $profile['id']
                )

                ->orderBy(
                    'service_requests.created_at',
                    'DESC'
                )

                ->findAll();


        $data = [

            'title' =>
                'Tracking Tiket Tendik',

            'tickets' =>
                $tickets,

        ];


        return view(
            'tendik/ticket/history',
            $data
        );
    }


    // =========================================================
    // DETAIL TIKET
    // =========================================================
    public function detail($id)
    {
        $userId =
            (int) session()->get(
                'user_id'
            );


        if ($userId <= 0) {
            return redirect()
                ->to('/login');
        }


        // -----------------------------------------------------
        // PROFILE
        // -----------------------------------------------------
        $profile =
            $this->userProfileModel
                ->findByUser($userId);


        if (!$profile) {
            return redirect()
                ->to(
                    base_url(
                        'tendik/ticket/history'
                    )
                )
                ->with(
                    'error',
                    'Profil tidak ditemukan.'
                );
        }


        // -----------------------------------------------------
        // TIKET
        // -----------------------------------------------------
        $ticket =
            $this->serviceRequestModel

                ->select('
                    service_requests.*,

                    master_services.name AS service_name,
                    master_services.code AS service_code,

                    master_service_units.name AS unit_name,
                    master_service_units.email AS unit_email,
                    master_service_units.phone AS unit_phone

                ')

                ->join(
                    'master_services',
                    'master_services.id = service_requests.service_id'
                )

                ->join(
                    'master_service_units',
                    'master_service_units.id = master_services.service_unit_id'
                )

                ->where(
                    'service_requests.id',
                    $id
                )

                ->where(
                    'service_requests.user_profile_id',
                    $profile['id']
                )

                ->first();


        if (!$ticket) {

            return redirect()
                ->to(
                    base_url(
                        'tendik/ticket/history'
                    )
                )
                ->with(
                    'error',
                    'Tiket tidak ditemukan.'
                );
        }


        // -----------------------------------------------------
        // FILE
        // -----------------------------------------------------
        $files =
            db_connect()
                ->table(
                    'service_request_files'
                )
                ->where(
                    'service_requests_id',
                    $ticket['id']
                )
                ->where(
                    'deleted_at',
                    null
                )
                ->get()
                ->getResultArray();


        // -----------------------------------------------------
        // LOG
        // -----------------------------------------------------
        $logs =
            db_connect()
                ->table(
                    'service_request_logs'
                )
                ->where(
                    'service_request_id',
                    $ticket['id']
                )
                ->orderBy(
                    'created_at',
                    'ASC'
                )
                ->get()
                ->getResultArray();


        $ticket['files'] =
            $files;

        $ticket['logs'] =
            $logs;


        $data = [

            'title' =>
                'Detail Tiket Tendik',

            'ticket' =>
                $ticket,

        ];


        return view(
            'tendik/ticket/detail',
            $data
        );
    }


    // =========================================================
    // DRAFT
    // =========================================================
    public function draft()
    {
        $userId =
            (int) session()->get(
                'user_id'
            );


        if ($userId <= 0) {
            return redirect()
                ->to('/login');
        }


        $profile =
            $this->userProfileModel
                ->findByUser($userId);


        if (!$profile) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Profil pengguna tidak ditemukan.'
                );
        }


        $drafts =
            $this->serviceRequestModel

                ->select('
                    service_requests.*,

                    master_services.name AS service_name,
                    master_services.code AS service_code,

                    master_service_units.name AS unit_name

                ')

                ->join(
                    'master_services',
                    'master_services.id = service_requests.service_id'
                )

                ->join(
                    'master_service_units',
                    'master_service_units.id = master_services.service_unit_id'
                )

                ->where(
                    'service_requests.user_profile_id',
                    $profile['id']
                )

                ->where(
                    'service_requests.status',
                    'draft'
                )

                ->orderBy(
                    'service_requests.updated_at',
                    'DESC'
                )

                ->findAll();


        $data = [

            'title' =>
                'Draft Pengajuan',

            'drafts' =>
                $drafts,

        ];


        return view(
            'tendik/ticket/draft',
            $data
        );
    }


    // =========================================================
    // EDIT DRAFT
    // =========================================================
    public function editDraft($id)
    {
        $userId =
            (int) session()->get(
                'user_id'
            );


        $profile =
            $this->userProfileModel
                ->findByUser($userId);


        if (!$profile) {
            return redirect()
                ->to('/login');
        }


        $draft =
            $this->serviceRequestModel

                ->where(
                    'id',
                    $id
                )

                ->where(
                    'user_profile_id',
                    $profile['id']
                )

                ->where(
                    'status',
                    'draft'
                )

                ->first();


        if (!$draft) {

            return redirect()
                ->to(
                    base_url(
                        'tendik/ticket/draft'
                    )
                )
                ->with(
                    'error',
                    'Draft tidak ditemukan.'
                );
        }


        $services =
            $this->serviceModel
                ->where(
                    'is_active',
                    1
                )
                ->orderBy(
                    'sort_order',
                    'ASC'
                )
                ->findAll();


        $units =
            $this->serviceUnitModel
                ->where(
                    'is_active',
                    1
                )
                ->orderBy(
                    'sort_order',
                    'ASC'
                )
                ->findAll();


        $data = [

            'title' =>
                'Lanjutkan Draft Pengajuan',

            'user' =>
                session()->get('user') ?? [],

            'profile' =>
                $profile,

            'draft' =>
                $draft,

            'services' =>
                $services,

            'units' =>
                $units,

        ];


        return view(
            'tendik/ticket/edit_draft',
            $data
        );
    }


    // =========================================================
    // UPDATE DRAFT
    // =========================================================
    public function updateDraft($id)
    {
        $userId =
            (int) session()->get(
                'user_id'
            );


        $profile =
            $this->userProfileModel
                ->findByUser($userId);


        if (!$profile) {
            return redirect()
                ->to('/login');
        }


        // -----------------------------------------------------
        // AMBIL DRAFT
        // -----------------------------------------------------
        $draft =
            $this->serviceRequestModel

                ->where(
                    'id',
                    $id
                )

                ->where(
                    'user_profile_id',
                    $profile['id']
                )

                ->where(
                    'status',
                    'draft'
                )

                ->first();


        if (!$draft) {

            return redirect()
                ->to(
                    base_url(
                        'tendik/ticket/draft'
                    )
                )
                ->with(
                    'error',
                    'Draft tidak ditemukan.'
                );
        }


        // -----------------------------------------------------
        // FORM
        // -----------------------------------------------------
        $serviceId =
            (int) $this->request
                ->getPost(
                    'jenis_layanan'
                );

        $unitId =
            (int) $this->request
                ->getPost(
                    'unit_tujuan'
                );

        $judul =
            trim(
                (string) $this->request
                    ->getPost('judul')
            );

        $keterangan =
            trim(
                (string) $this->request
                    ->getPost('keterangan')
            );

        $priority =
            trim(
                (string) $this->request
                    ->getPost('priority')
            );

        $action =
            trim(
                (string) $this->request
                    ->getPost('action')
            );


        // -----------------------------------------------------
        // VALIDASI
        // -----------------------------------------------------
        if (
            $serviceId <= 0 ||
            $unitId <= 0 ||
            $judul === '' ||
            $keterangan === ''
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Semua field wajib harus diisi.'
                );
        }


        if (
            !in_array(
                $priority,
                ['low', 'normal', 'high', 'urgent'],
                true
            )
        ) {
            $priority = 'normal';
        }


        // -----------------------------------------------------
        // SERVICE
        // -----------------------------------------------------
        $service =
            $this->serviceModel
                ->where(
                    'id',
                    $serviceId
                )
                ->where(
                    'is_active',
                    1
                )
                ->first();


        if (
            !$service ||
            (int) $service['service_unit_id']
            !==
            $unitId
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Layanan dan unit tujuan tidak sesuai.'
                );
        }


        // -----------------------------------------------------
        // UPDATE
        // -----------------------------------------------------
        $updateData = [

            'service_id' =>
                $serviceId,

            'title' =>
                $judul,

            'description' =>
                $keterangan,

            'priority' =>
                $priority,

            'updated_at' =>
                date('Y-m-d H:i:s'),
        ];


        // =====================================================
        // MASIH DRAFT
        // =====================================================
        if ($action === 'draft') {

            $this->serviceRequestModel
                ->update(
                    $id,
                    $updateData
                );


            return redirect()
                ->to(
                    base_url(
                        'tendik/ticket/draft'
                    )
                )
                ->with(
                    'success',
                    'Draft berhasil diperbarui.'
                );
        }


        // =====================================================
        // SUBMIT DRAFT
        // =====================================================
        if ($action === 'submit') {

            $updateData['status'] =
                'submitted';

            $updateData['submitted_at'] =
                date('Y-m-d H:i:s');


            $this->serviceRequestModel
                ->update(
                    $id,
                    $updateData
                );


            $this->createLog(

                $id,

                $userId,

                'draft',

                'submitted',

                'SUBMIT_DRAFT',

                'Draft diajukan menjadi tiket.'

            );


            return redirect()
                ->to(
                    base_url(
                        'tendik/ticket/success'
                    )
                )
                ->with(
                    'ticket_number',
                    $draft['ticket_number']
                );
        }


        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Aksi pengajuan tidak valid.'
            );
    }


    // =========================================================
    // DELETE DRAFT
    // =========================================================
    public function deleteDraft($id)
    {
        $userId =
            (int) session()->get(
                'user_id'
            );


        $profile =
            $this->userProfileModel
                ->findByUser($userId);


        if (!$profile) {
            return redirect()
                ->to('/login');
        }


        $draft =
            $this->serviceRequestModel

                ->where(
                    'id',
                    $id
                )

                ->where(
                    'user_profile_id',
                    $profile['id']
                )

                ->where(
                    'status',
                    'draft'
                )

                ->first();


        if (!$draft) {

            return redirect()
                ->to(
                    base_url(
                        'tendik/ticket/draft'
                    )
                )
                ->with(
                    'error',
                    'Draft tidak ditemukan.'
                );
        }


        // -----------------------------------------------------
        // SOFT DELETE
        // -----------------------------------------------------
        $this->serviceRequestModel
            ->update(
                $id,
                [
                    'deleted_at' =>
                        date('Y-m-d H:i:s')
                ]
            );


        return redirect()
            ->to(
                base_url(
                    'tendik/ticket/draft'
                )
            )
            ->with(
                'success',
                'Draft berhasil dihapus.'
            );
    }


    // =========================================================
    // NOTIFICATION
    // =========================================================
    public function notification()
    {
        $userId =
            (int) session()->get(
                'user_id'
            );


        if ($userId <= 0) {
            return redirect()
                ->to('/login');
        }


        $notifications =
            db_connect()
                ->table('notifications')
                ->where(
                    'user_id',
                    $userId
                )
                ->orderBy(
                    'created_at',
                    'DESC'
                )
                ->get()
                ->getResultArray();


        $data = [

            'title' =>
                'Notifikasi',

            'notifications' =>
                $notifications,

        ];


        return view(
            'tendik/notification',
            $data
        );
    }


    // =========================================================
    // BALASAN / RESPONSE USER
    // =========================================================
    public function reply($id)
    {
        $userId =
            (int) session()->get(
                'user_id'
            );


        if ($userId <= 0) {
            return redirect()
                ->to('/login');
        }


        $balasan =
            trim(
                (string) $this->request
                    ->getPost('balasan')
            );


        if ($balasan === '') {

            return redirect()
                ->to(
                    base_url(
                        'tendik/ticket/detail/' .
                        $id
                    )
                )
                ->with(
                    'error',
                    'Balasan tidak boleh kosong.'
                );
        }


        // -----------------------------------------------------
        // CEK TIKET MILIK USER
        // -----------------------------------------------------
        $profile =
            $this->userProfileModel
                ->findByUser($userId);


        if (!$profile) {
            return redirect()
                ->to('/login');
        }


        $ticket =
            $this->serviceRequestModel

                ->where(
                    'id',
                    $id
                )

                ->where(
                    'user_profile_id',
                    $profile['id']
                )

                ->first();


        if (!$ticket) {

            return redirect()
                ->to(
                    base_url(
                        'tendik/ticket/history'
                    )
                )
                ->with(
                    'error',
                    'Tiket tidak ditemukan.'
                );
        }


        // -----------------------------------------------------
        // SIMPAN RESPONSE SEBAGAI LOG
        // -----------------------------------------------------
        $this->createLog(

            $id,

            $userId,

            $ticket['status'],

            $ticket['status'],

            'USER_REPLY',

            $balasan

        );


        return redirect()
            ->to(
                base_url(
                    'tendik/ticket/detail/' .
                    $id
                )
            )
            ->with(
                'success',
                'Balasan berhasil dikirim.'
            );
    }


    // =========================================================
    // CREATE SERVICE REQUEST LOG
    // =========================================================
    private function createLog(
        int $requestId,
        int $userId,
        ?string $oldStatus,
        string $newStatus,
        string $action,
        ?string $description = null
    ): bool
    {
        return db_connect()
            ->table(
                'service_request_logs'
            )
            ->insert([

                'service_request_id' =>
                    $requestId,

                'user_id' =>
                    $userId,

                'old_status' =>
                    $oldStatus,

                'new_status' =>
                    $newStatus,

                'action' =>
                    $action,

                'description' =>
                    $description,

                'ip_address' =>
                    $this->request
                        ->getIPAddress(),

                'user_agent' =>
                    $this->request
                        ->getUserAgent()
                        ->getAgentString(),

                'created_at' =>
                    date('Y-m-d H:i:s'),
            ]);
    }
}