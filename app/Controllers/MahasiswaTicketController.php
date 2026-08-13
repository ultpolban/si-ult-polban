<?php

namespace App\Controllers;

use App\Models\ServiceRequestModel;
use App\Models\ServiceRequestFileModel;
use App\Models\MasterServiceUnitModel;
use App\Models\MasterServiceModel;
use App\Models\MasterServiceRequirementModel;
use App\Models\UserProfileModel;

class MahasiswaTicketController extends BaseController
{
    private function getDataLayanan()
    {
        return [

            // =================================================
            // AKADEMIK
            // =================================================
            'Akademik' => [

                [
                    'nama' => 'Surat Keterangan Aktif Kuliah',

                    'persyaratan' => [
                        'Mengisi formulir permohonan.',
                        'Fotokopi KTM yang masih berlaku.',
                        'Fotokopi KTP / Kartu Identitas.',
                        'Bukti registrasi semester berjalan.',
                        'Tidak memiliki tunggakan administrasi akademik.',
                        'Mencantumkan tujuan penggunaan surat.'
                    ]
                ],

                [
                    'nama' => 'Surat Keterangan Mahasiswa',

                    'persyaratan' => [
                        'Mengisi formulir permohonan.',
                        'Fotokopi KTM.',
                        'Fotokopi KTP.',
                        'Mencantumkan NIM.',
                        'Bukti registrasi mahasiswa aktif.',
                        'Menjelaskan keperluan surat.'
                    ]
                ],

                [
                    'nama' => 'Legalisasi Dokumen Akademik',

                    'persyaratan' => [
                        'Mengisi formulir legalisasi.',
                        'Membawa dokumen asli yang akan dilegalisasi.',
                        'Menyerahkan fotokopi dokumen.',
                        'Fotokopi KTM.',
                        'Bukti pembayaran legalisasi (jika ada).'
                    ]
                ],

                [
                    'nama' => 'Permohonan Transkrip Nilai',

                    'persyaratan' => [
                        'Mengisi formulir permohonan.',
                        'Fotokopi KTM.',
                        'Fotokopi KTP.',
                        'Mencantumkan NIM.',
                        'Tidak memiliki tunggakan akademik.',
                        'Bukti pembayaran administrasi (jika ada).'
                    ]
                ],

                [
                    'nama' => 'Cetak Kartu Hasil Studi (KHS)',

                    'persyaratan' => [
                        'Mengisi formulir permohonan.',
                        'Fotokopi KTM.',
                        'Mencantumkan NIM.',
                        'Menentukan semester yang akan dicetak.',
                        'Mahasiswa masih aktif.'
                    ]
                ],

                [
                    'nama' => 'Perubahan Kartu Rencana Studi (KRS)',

                    'persyaratan' => [
                        'Mengisi formulir perubahan KRS.',
                        'Melampirkan KRS sebelumnya.',
                        'Persetujuan Dosen Wali.',
                        'Fotokopi KTM.',
                        'Dilakukan sesuai jadwal perubahan KRS.'
                    ]
                ],

                [
                    'nama' => 'Pengajuan Cuti Akademik',

                    'persyaratan' => [
                        'Surat permohonan cuti.',
                        'Fotokopi KTM.',
                        'Fotokopi KTP.',
                        'Persetujuan Dosen Wali.',
                        'Persetujuan Ketua Program Studi.',
                        'Bukti pembayaran semester sebelumnya.',
                        'Alasan pengajuan cuti.'
                    ]
                ],

                [
                    'nama' => 'Aktif Kembali Setelah Cuti',

                    'persyaratan' => [
                        'Surat permohonan aktif kembali.',
                        'Fotokopi KTM.',
                        'Fotokopi KTP.',
                        'Surat keputusan cuti akademik sebelumnya.',
                        'Bukti pembayaran UKT semester berjalan.',
                        'Persetujuan Ketua Program Studi.'
                    ]
                ],

                [
                    'nama' => 'Pengajuan Yudisium',

                    'persyaratan' => [
                        'Mengisi formulir pendaftaran yudisium.',
                        'Transkrip nilai lengkap.',
                        'Bukti lulus Tugas Akhir / Skripsi.',
                        'Surat bebas perpustakaan.',
                        'Surat bebas laboratorium.',
                        'Surat bebas administrasi keuangan.',
                        'Pas foto sesuai ketentuan.'
                    ]
                ],

                [
                    'nama' => 'Pengajuan Wisuda',

                    'persyaratan' => [
                        'Mengisi formulir pendaftaran wisuda.',
                        'Bukti lulus yudisium.',
                        'Bukti pembayaran biaya wisuda.',
                        'Pas foto sesuai ketentuan.',
                        'Surat bebas perpustakaan.',
                        'Surat bebas laboratorium.',
                        'Surat bebas administrasi keuangan.'
                    ]
                ],

            ],


            // =================================================
            // KEMAHASISWAAN
            // =================================================
            'Kemahasiswaan' => [

                [
                    'nama' => 'Pengajuan Beasiswa',

                    'persyaratan' => [
                        'Mengisi formulir pengajuan beasiswa.',
                        'Fotokopi KTM yang masih berlaku.',
                        'Fotokopi KTP mahasiswa.',
                        'Fotokopi Kartu Keluarga.',
                        'Melampirkan transkrip nilai terbaru.',
                        'Melampirkan dokumen pendukung sesuai persyaratan beasiswa.'
                    ]
                ],

                [
                    'nama' => 'Informasi Beasiswa',

                    'persyaratan' => [
                        'Fotokopi KTM.',
                        'Mencantumkan NIM mahasiswa.',
                        'Menjelaskan informasi beasiswa yang dibutuhkan.',
                        'Data mahasiswa aktif sesuai sistem akademik.'
                    ]
                ],

                [
                    'nama' => 'Pengajuan Kegiatan Mahasiswa',

                    'persyaratan' => [
                        'Mengisi formulir pengajuan kegiatan.',
                        'Melampirkan proposal kegiatan.',
                        'Surat pengajuan kegiatan mahasiswa.',
                        'Rencana Anggaran Biaya (RAB) kegiatan.',
                        'Susunan kepanitiaan kegiatan.',
                        'Jadwal pelaksanaan kegiatan.'
                    ]
                ],

                [
                    'nama' => 'Surat Izin Kegiatan Mahasiswa',

                    'persyaratan' => [
                        'Surat permohonan izin kegiatan.',
                        'Proposal kegiatan mahasiswa.',
                        'Struktur kepanitiaan kegiatan.',
                        'Jadwal pelaksanaan kegiatan.',
                        'Persetujuan pihak terkait.'
                    ]
                ],

                [
                    'nama' => 'Peminjaman Fasilitas Kampus',

                    'persyaratan' => [
                        'Surat permohonan peminjaman fasilitas.',
                        'Proposal kegiatan.',
                        'Jadwal penggunaan fasilitas.',
                        'Penanggung jawab kegiatan.',
                        'Persetujuan pihak terkait.'
                    ]
                ],

                [
                    'nama' => 'Pengajuan Organisasi Mahasiswa',

                    'persyaratan' => [
                        'Proposal pembentukan organisasi.',
                        'Struktur kepengurusan organisasi.',
                        'Surat pengajuan organisasi mahasiswa.',
                        'Program kerja organisasi.',
                        'Data anggota organisasi.'
                    ]
                ],

            ],


            // =================================================
            // KEUANGAN
            // =================================================
            'Keuangan' => [

                [
                    'nama' => 'Informasi Tagihan Kuliah',

                    'persyaratan' => [
                        'Fotokopi KTM yang masih berlaku.',
                        'Mencantumkan NIM mahasiswa.',
                        'Data mahasiswa aktif sesuai sistem akademik.',
                        'Menjelaskan informasi tagihan yang dibutuhkan.'
                    ]
                ],

                [
                    'nama' => 'Konfirmasi Pembayaran Kuliah',

                    'persyaratan' => [
                        'Fotokopi KTM yang masih berlaku.',
                        'Mencantumkan NIM mahasiswa.',
                        'Melampirkan bukti pembayaran kuliah.',
                        'Bukti transaksi pembayaran.',
                        'Menjelaskan periode pembayaran yang dikonfirmasi.'
                    ]
                ],

                [
                    'nama' => 'Permohonan Cicilan Pembayaran',

                    'persyaratan' => [
                        'Mengisi formulir permohonan cicilan pembayaran.',
                        'Fotokopi KTM yang masih berlaku.',
                        'Fotokopi KTP mahasiswa.',
                        'Mencantumkan NIM mahasiswa.',
                        'Melampirkan surat permohonan cicilan pembayaran.',
                        'Melampirkan dokumen pendukung.'
                    ]
                ],

                [
                    'nama' => 'Surat Keterangan Bebas Keuangan',

                    'persyaratan' => [
                        'Mengisi formulir permohonan surat.',
                        'Fotokopi KTM yang masih berlaku.',
                        'Mencantumkan NIM mahasiswa.',
                        'Data pembayaran mahasiswa.',
                        'Status pembayaran telah lunas sesuai sistem keuangan.'
                    ]
                ],

                [
                    'nama' => 'Koreksi Kesalahan Pembayaran',

                    'persyaratan' => [
                        'Mengisi formulir pengajuan koreksi pembayaran.',
                        'Fotokopi KTM yang masih berlaku.',
                        'Mencantumkan NIM mahasiswa.',
                        'Melampirkan bukti pembayaran.',
                        'Menjelaskan kesalahan pembayaran.',
                        'Melampirkan bukti transaksi pembayaran.'
                    ]
                ],

                [
                    'nama' => 'Pengajuan Pengembalian Dana',

                    'persyaratan' => [
                        'Mengisi formulir pengajuan pengembalian dana.',
                        'Fotokopi KTM yang masih berlaku.',
                        'Fotokopi KTP mahasiswa.',
                        'Mencantumkan NIM mahasiswa.',
                        'Melampirkan surat permohonan pengembalian dana.',
                        'Melampirkan bukti pembayaran.',
                        'Melampirkan nomor rekening penerima dana.'
                    ]
                ],

                [
                    'nama' => 'Permintaan Bukti Pembayaran',

                    'persyaratan' => [
                        'Fotokopi KTM yang masih berlaku.',
                        'Mencantumkan NIM mahasiswa.',
                        'Menjelaskan periode pembayaran yang diminta.',
                        'Data transaksi pembayaran sesuai sistem keuangan.',
                        'Menjelaskan tujuan penggunaan bukti pembayaran.'
                    ]
                ],

            ],
        ];
    }


 public function create()
{
    $unitModel = new MasterServiceUnitModel();

    // Ambil unit layanan yang aktif dari database
    $units = $unitModel
        ->where('is_active', 1)
        ->orderBy('sort_order', 'ASC')
        ->findAll();

    // Data pemohon sementara
    // Nanti bisa kita sambungkan ke akun mahasiswa
    $user = [
        'nama'    => 'Muhamad Rafi Putra Zakaria',
        'nik'     => '3273010101040001',
        'nim'     => '45678',
        'email'   => 'mochrafiputrazakaria@gmail.com',
        'telepon' => '083123456788',
    ];

    $data = [
        'title' => 'Ajukan Layanan',
        'user'  => $user,
        'units' => $units,
    ];

    return view('mahasiswa/ticket/create', $data);
}

public function saveDraft()
{
    $db = \Config\Database::connect();

    $serviceRequestModel = new ServiceRequestModel();

    // ==========================================
    // AMBIL SERVICE
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
    // USER PROFILE
    // ==========================================

    $userProfileId = session()->get('user_profile_id');

    if (empty($userProfileId)) {
        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Data profil mahasiswa tidak ditemukan.'
            );
    }


    // ==========================================
    // PASTIKAN SERVICE AKTIF
    // ==========================================

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


    // ==========================================
    // DATA DRAFT
    // ==========================================

    $now = date('Y-m-d H:i:s');

    $ticketNumber = 'ULT-MHS-' . strtoupper(
        bin2hex(random_bytes(5))
    );


    $data = [
        'ticket_number'   => $ticketNumber,
        'user_profile_id' => $userProfileId,
        'service_id'      => $serviceId,
        'title'           => 'Pengajuan Layanan Mahasiswa',
        'description'     => $this->request->getPost('keterangan'),
        'status'          => 'draft',
        'priority'        => 'normal',
        'submitted_at'    => null,
        'created_at'      => $now,
        'updated_at'      => $now,
    ];


    // ==========================================
    // SIMPAN SERVICE REQUEST
    // ==========================================

    $serviceRequestModel->insert($data);

    $serviceRequestId =
        $serviceRequestModel->getInsertID();


    // ==========================================
    // SIMPAN DOKUMEN YANG DIUPLOAD
    // ==========================================

    $files = $this->request->getFiles();

    $documents = $files['dokumen'] ?? [];


    if (!empty($documents)) {

        $requirements = $db->table(
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


        foreach ($documents as $requirementId => $file) {

            if (
                !isset(
                    $requirementMap[$requirementId]
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
                $requirementMap[$requirementId];


            // ======================================
            // CEK UKURAN
            // ======================================

            $maxSize =
                ((int) ($requirement['max_file_size'] ?? 2048))
                * 1024;

            if (
                $file->getSize() > $maxSize
            ) {
                continue;
            }


            // ======================================
            // CEK EXTENSION
            // ======================================

            $extension =
                strtolower(
                    $file->getClientExtension()
                );


            $allowed =
                $requirement['allowed_extensions']
                ?? 'pdf,jpg,jpeg,png,doc,docx,xls,xlsx';


            $allowedExtensions =
                array_map(
                    'trim',
                    explode(',', strtolower($allowed))
                );


            if (
                !in_array(
                    $extension,
                    $allowedExtensions
                )
            ) {
                continue;
            }


            // ======================================
            // FOLDER
            // ======================================

            $uploadPath =
                FCPATH .
                'uploads/service_requests/' .
                $serviceRequestId .
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


    return redirect()
        ->to(
            base_url(
                'mahasiswa/ticket/draft'
            )
        )
        ->with(
            'success',
            'Pengajuan berhasil disimpan sebagai draft.'
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

    $serviceModel = new \App\Models\MasterServiceModel();

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

    $requirementModel = new \App\Models\MasterServiceRequirementModel();

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
    $serviceRequestModel = new ServiceRequestModel();


    // ==========================================
    // AMBIL JENIS LAYANAN
    // ==========================================

    $serviceId = $this->request->getPost('jenis_layanan');

    if (empty($serviceId)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Silakan pilih jenis layanan terlebih dahulu.');
    }


// ==========================================
// AMBIL USER PROFILE
// ==========================================

$userId = session()->get('user_id');

if (empty($userId)) {
    return redirect()->back()
        ->withInput()
        ->with('error', 'Akun pengguna tidak ditemukan. Silakan login kembali.');
}

$userProfileModel = new UserProfileModel();

$userProfile = $userProfileModel
    ->where('user_id', $userId)
    ->first();

if (!$userProfile) {
    return redirect()->back()
        ->withInput()
        ->with('error', 'Data profil mahasiswa tidak ditemukan.');
}

$userProfileId = $userProfile['id'];


    // ==========================================
    // GENERATE NOMOR TIKET
    // ==========================================

    $ticketNumber = 'ULT-MHS-' . strtoupper(
        bin2hex(random_bytes(4))
    );


    // ==========================================
    // WAKTU
    // ==========================================

    $now = date('Y-m-d H:i:s');


    // ==========================================
    // DATA PENGAJUAN
    // ==========================================

$data = [
    'ticket_number'   => $ticketNumber,
    'user_profile_id' => $userProfileId,
    'service_id'      => $serviceId,
    'title'           => 'Pengajuan Layanan',
    'description'     => $this->request->getPost('keterangan'),
    'status'          => 'submitted',
    'priority'        => 'normal',
    'submitted_at'    => $now,
    'created_at'      => $now,
    'updated_at'      => $now,
];


    // ==========================================
    // SIMPAN PENGAJUAN
    // ==========================================

    $serviceRequestModel->insert($data);


    // ==========================================
    // AMBIL ID TIKET
    // ==========================================

    $ticketId = $serviceRequestModel->getInsertID();


    // ==========================================
    // AMBIL DATA TIKET
    // ==========================================

    $ticket = $serviceRequestModel->find($ticketId);


    // ==========================================
    // SUCCESS
    // ==========================================

    return view('mahasiswa/ticket/success', [
        'ticket' => $ticket
    ]);
}


    public function layanan()
    {
        return $this->response->setJSON(
            $this->getDataLayanan()
        );
    }

/**
 * =========================================================
 * HALAMAN DRAFT PENGAJUAN
 * =========================================================
 */
public function draft()
{
    $db = \Config\Database::connect();

    // Ambil user yang sedang login
    $user = session()->get('user') ?? [];

    // Ambil user_profile_id
    $userProfileId = $user['user_profile_id']
        ?? $user['profile_id']
        ?? null;

    // Query draft + jenis layanan + unit layanan
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

    // Hanya draft
    $builder->where('sr.status', 'draft');

    // Hanya draft milik mahasiswa yang sedang login
    if ($userProfileId !== null) {
        $builder->where(
            'sr.user_profile_id',
            $userProfileId
        );
    }

    // Terbaru di atas
    $builder->orderBy(
        'sr.created_at',
        'DESC'
    );

$drafts = $builder->get()->getResultArray();


// =========================================================
// CEK KELENGKAPAN DOKUMEN SETIAP DRAFT
// =========================================================

foreach ($drafts as &$draft) {

    // -----------------------------------------
    // Ambil semua persyaratan WAJIB
    // berdasarkan service_id
    // -----------------------------------------

    $requirements = $db
        ->table('master_service_requirements')
        ->where(
            'service_id',
            $draft['service_id']
        )
        ->where(
            'is_required',
            1
        )
        ->where(
            'is_active',
            1
        )
        ->get()
        ->getResultArray();


    // -----------------------------------------
    // Kalau layanan tidak punya persyaratan
    // -----------------------------------------

    if (empty($requirements)) {

        $draft['document_complete'] = true;

        continue;
    }


    // -----------------------------------------
    // Ambil dokumen yang sudah diupload
    // -----------------------------------------

    $uploadedFiles = $db
        ->table('service_request_files')
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


    // -----------------------------------------
    // Simpan ID requirement yang sudah ada
    // -----------------------------------------

    $uploadedRequirementIds = [];

    foreach ($uploadedFiles as $file) {

        $uploadedRequirementIds[] =
            (int) $file['requirement_id'];
    }


    // -----------------------------------------
    // Anggap lengkap terlebih dahulu
    // -----------------------------------------

    $complete = true;


    // -----------------------------------------
    // Cek satu per satu persyaratan wajib
    // -----------------------------------------

    foreach ($requirements as $requirement) {

        if (
            !in_array(
                (int) $requirement['id'],
                $uploadedRequirementIds
            )
        ) {

            $complete = false;

            break;
        }
    }


    // -----------------------------------------
    // Simpan hasil pengecekan
    // -----------------------------------------

    $draft['document_complete'] = $complete;
}

unset($draft);


// =========================================================
// DATA UNTUK VIEW
// =========================================================

$data = [
    'title'  => 'Draft Pengajuan',
    'drafts' => $drafts
];

    return view(
        'mahasiswa/ticket/draft',
        $data
    );
}


/**
 * =========================================================
 * HAPUS DRAFT
 * =========================================================
 */
public function deleteDraft($id)
{
    $serviceRequestModel = new \App\Models\ServiceRequestModel();

    // Ambil user_profile_id dari session
    $userProfileId = session()->get('user_profile_id');

    // Cari draft berdasarkan ID
    $draft = $serviceRequestModel
        ->where('id', $id)
        ->where('user_profile_id', $userProfileId)
        ->where('status', 'draft')
        ->first();

    // Kalau draft tidak ditemukan
    if (!$draft) {

        session()->setFlashdata(
            'error',
            'Draft tidak ditemukan atau bukan milik Anda.'
        );

        return redirect()->to(
            base_url('mahasiswa/ticket/draft')
        );
    }

    // Hapus draft
    $serviceRequestModel->delete($id);

    session()->setFlashdata(
        'success',
        'Draft berhasil dihapus.'
    );

    return redirect()->to(
        base_url('mahasiswa/ticket/draft')
    );
}
/**
 * =========================================================
 * EDIT / LANJUTKAN DRAFT
 * =========================================================
 */
public function editDraft($id)
{
    $db = \Config\Database::connect();

    // ==========================================
    // USER PROFILE
    // ==========================================

    $userProfileId = session()->get('user_profile_id');

    if (!$userProfileId) {
        return redirect()->to(base_url('login'));
    }


    // ==========================================
    // AMBIL DATA DRAFT
    // ==========================================

    $builder = $db->table('service_requests sr');

    $draft = $builder
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
            ms.description AS service_description,
            ms.service_unit_id,

            msu.name AS unit_name,
            msu.code AS unit_code
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
        ->where('sr.id', $id)
        ->where('sr.status', 'draft')
        ->where('sr.user_profile_id', $userProfileId)
        ->get()
        ->getRowArray();


    // ==========================================
    // DRAFT TIDAK DITEMUKAN
    // ==========================================

    if (!$draft) {

        session()->setFlashdata(
            'error',
            'Draft tidak ditemukan atau bukan milik Anda.'
        );

        return redirect()->to(
            base_url('mahasiswa/ticket/draft')
        );
    }


    // ==========================================
    // SEMUA UNIT LAYANAN
    // ==========================================

    $units = $db->table('master_service_units')
        ->where('is_active', 1)
        ->orderBy('sort_order', 'ASC')
        ->get()
        ->getResultArray();


    // ==========================================
    // SEMUA LAYANAN
    // ==========================================

    $services = $db->table('master_services ms')
        ->select('
            ms.id,
            ms.service_unit_id,
            ms.code,
            ms.name,
            ms.description
        ')
        ->where('ms.is_active', 1)
        ->orderBy('ms.sort_order', 'ASC')
        ->get()
        ->getResultArray();


    // ==========================================
    // PERSYARATAN DOKUMEN
    // SESUAI JENIS LAYANAN
    // ==========================================

    $requirements = $db->table('master_service_requirements')
        ->where('service_id', $draft['service_id'])
        ->where('is_active', 1)
        ->orderBy('sort_order', 'ASC')
        ->get()
        ->getResultArray();


    // ==========================================
    // FILE YANG SUDAH DIUPLOAD
    // ==========================================

    $uploadedFiles = $db->table('service_request_files')
        ->where('service_request_id', $draft['id'])
        ->where('deleted_at', null)
        ->get()
        ->getResultArray();


    // ==========================================
    // BENTUKKAN BERDASARKAN REQUIREMENT ID
    // ==========================================

    $uploadedByRequirement = [];

    foreach ($uploadedFiles as $file) {

        $uploadedByRequirement[
            $file['requirement_id']
        ] = $file;
    }


    // ==========================================
    // RETURN VIEW
    // ==========================================

    return view(
        'mahasiswa/ticket/edit_draft',
        [
            'title' => 'Edit Draft Pengajuan',

            'draft' => $draft,

            'units' => $units,

            'services' => $services,

            'requirements' => $requirements,

            'uploadedFiles' => $uploadedByRequirement
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
    $db = \Config\Database::connect();

    $userProfileId = session()->get('user_profile_id');


    // ==========================================
    // CEK DRAFT
    // ==========================================

    $draft = $db->table('service_requests')
        ->where('id', $id)
        ->where('user_profile_id', $userProfileId)
        ->where('status', 'draft')
        ->get()
        ->getRowArray();


    if (!$draft) {

        session()->setFlashdata(
            'error',
            'Draft tidak ditemukan atau bukan milik Anda.'
        );

        return redirect()->to(
            base_url('mahasiswa/ticket/draft')
        );
    }


    // ==========================================
    // DATA FORM
    // ==========================================

    $unitId = $this->request->getPost('unit_layanan');

    $serviceId = $this->request->getPost('service_id');

    $description = $this->request->getPost('description');


    // ==========================================
    // VALIDASI SERVICE
    // ==========================================

    $service = $db->table('master_services')
        ->where('id', $serviceId)
        ->where('service_unit_id', $unitId)
        ->where('is_active', 1)
        ->get()
        ->getRowArray();


    if (!$service) {

        session()->setFlashdata(
            'error',
            'Jenis layanan tidak sesuai dengan unit layanan.'
        );

        return redirect()->back()
            ->withInput();
    }


    // ==========================================
    // UPDATE DRAFT
    // ==========================================

    $db->table('service_requests')
        ->where('id', $id)
        ->update([
            'service_id' => $serviceId,
            'title' => $service['name'],
            'description' => $description,
            'updated_at' => date('Y-m-d H:i:s')
        ]);


    // ==========================================
    // FILE UPLOAD
    // ==========================================

    $documents = $this->request->getFiles();


    if (
        isset($documents['documents']) &&
        is_array($documents['documents'])
    ) {


        $uploadPath = FCPATH . 'uploads/service_requests/';


        // Buat folder kalau belum ada

        if (!is_dir($uploadPath)) {

            mkdir(
                $uploadPath,
                0777,
                true
            );
        }


        foreach (
            $documents['documents']
            as $requirementId => $file
        ) {


            // Tidak ada file baru

            if (
                !$file ||
                !$file->isValid() ||
                $file->getError() === UPLOAD_ERR_NO_FILE
            ) {

                continue;
            }


            // ==========================================
            // AMBIL REQUIREMENT
            // ==========================================

            $requirement = $db
                ->table('master_service_requirements')
                ->where('id', $requirementId)
                ->where('service_id', $serviceId)
                ->where('is_active', 1)
                ->get()
                ->getRowArray();


            if (!$requirement) {

                continue;
            }


            // ==========================================
            // VALIDASI UKURAN
            // ==========================================

            $maxSize =
                ((int) $requirement['max_file_size']) * 1024;


            if (
                $maxSize > 0 &&
                $file->getSize() > $maxSize
            ) {

                session()->setFlashdata(
                    'error',
                    'Ukuran file "' .
                    $file->getClientName() .
                    '" terlalu besar.'
                );

                return redirect()->back()
                    ->withInput();
            }


            // ==========================================
            // VALIDASI EXTENSION
            // ==========================================

            $extension =
                strtolower(
                    $file->getClientExtension()
                );


            $allowedExtensions =
                $requirement['allowed_extensions']
                ?? 'pdf,jpg,jpeg,png,doc,docx';


            $allowedExtensions =
                array_map(
                    'trim',
                    explode(
                        ',',
                        strtolower(
                            $allowedExtensions
                        )
                    )
                );


            if (
                !in_array(
                    $extension,
                    $allowedExtensions
                )
            ) {

                session()->setFlashdata(
                    'error',
                    'Format file "' .
                    $file->getClientName() .
                    '" tidak diperbolehkan.'
                );

                return redirect()->back()
                    ->withInput();
            }


            // ==========================================
            // NAMA FILE BARU
            // ==========================================

            $newName =
                $file->getRandomName();


            $file->move(
                $uploadPath,
                $newName
            );


            // ==========================================
            // CEK FILE LAMA
            // ==========================================

            $oldFile = $db
                ->table('service_request_files')
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


            // ==========================================
            // FILE LAMA DIHAPUS
            // ==========================================

            if ($oldFile) {

                $db->table('service_request_files')
                    ->where(
                        'id',
                        $oldFile['id']
                    )
                    ->update([
                        'deleted_at' =>
                            date('Y-m-d H:i:s'),

                        'updated_at' =>
                            date('Y-m-d H:i:s')
                    ]);
            }


            // ==========================================
            // SIMPAN FILE BARU
            // ==========================================

            $db->table('service_request_files')
                ->insert([

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
                        $newName,

                    'file_extension' =>
                        $extension,

                    'mime_type' =>
                        $file->getMimeType(),

                    'file_size' =>
                        $file->getSize(),

                    'is_verified' =>
                        0,

                    'verified_by' =>
                        null,

                    'verified_at' =>
                        null,

                    'notes' =>
                        null,

                    'created_at' =>
                        date('Y-m-d H:i:s'),

                    'updated_at' =>
                        date('Y-m-d H:i:s'),

                    'deleted_at' =>
                        null
                ]);
        }
    }


    // ==========================================
    // SELESAI
    // ==========================================

    session()->setFlashdata(
        'success',
        'Draft berhasil diperbarui.'
    );


    return redirect()->to(
        base_url('mahasiswa/ticket/draft')
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
            base_url('mahasiswa/ticket/draft')
        );
    }

    return view('mahasiswa/ticket/draft_success', [
        'title' => 'Draft Berhasil Disimpan',
        'draft' => $draft
    ]);
}

public function success()
{
    $ticket = session()->get('last_ticket');

    if (!$ticket) {
        return redirect()->to(
            base_url('mahasiswa/ticket/create')
        );
    }

    return view('mahasiswa/ticket/success', [
        'title'  => 'Pengajuan Berhasil',
        'ticket' => $ticket
    ]);
}


public function history()
{
    // ==========================================
    // DATA DUMMY TRACKING TIKET
    // ==========================================

    $tickets = [

        [
            'id' => 1,
            'nomor' => 'ULT-20260807-A7K92',
            'unit_layanan' => 'Akademik',
            'layanan' => 'Surat Keterangan Aktif Kuliah',
            'keterangan' => 'Untuk keperluan pengajuan beasiswa.',
            'dokumen' => null,
            'status' => 'Submitted',
            'created_at' => '07 Agustus 2026 09:15'
        ],

        [
            'id' => 2,
            'nomor' => 'ULT-20260806-B4M21',
            'unit_layanan' => 'Kemahasiswaan',
            'layanan' => 'Pengajuan Beasiswa',
            'keterangan' => 'Pengajuan beasiswa pendidikan.',
            'dokumen' => null,
            'status' => 'Diproses',
            'created_at' => '06 Agustus 2026 13:40'
        ],

        [
            'id' => 3,
            'nomor' => 'ULT-20260804-K8P34',
            'unit_layanan' => 'Keuangan',
            'layanan' => 'Konfirmasi Pembayaran Kuliah',
            'keterangan' => 'Konfirmasi pembayaran UKT semester berjalan.',
            'dokumen' => null,
            'status' => 'Selesai',
            'created_at' => '04 Agustus 2026 10:20'
        ],

        [
            'id' => 4,
            'nomor' => 'ULT-20260802-R5N17',
            'unit_layanan' => 'Akademik',
            'layanan' => 'Legalisasi Dokumen Akademik',
            'keterangan' => 'Legalisasi dokumen untuk keperluan administrasi.',
            'dokumen' => null,
            'status' => 'Ditolak',
            'created_at' => '02 Agustus 2026 14:05'
        ],

    ];

    return view('mahasiswa/ticket/history', [
        'title' => 'Tracking Tiket',
        'tickets' => $tickets
    ]);
}


/**
 * =========================================================
 * DETAIL TIKET
 * =========================================================
 */
public function detail($id)
{
    $data = [
        'title' => 'Detail Tiket',
        'ticket' => [
            'id' => $id
        ]
    ];

    return view('mahasiswa/ticket/detail', $data);
}


/**
 * =========================================================
 * REPLY TIKET
 * =========================================================
 */
public function reply($id)
{
    session()->setFlashdata(
        'success',
        'Balasan berhasil dikirim.'
    );

    return redirect()->to(
        base_url('mahasiswa/ticket/detail/' . $id)
    );
}
}