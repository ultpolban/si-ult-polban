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

    // =====================================================
    // AMBIL PROFILE MAHASISWA DARI SESSION
    // =====================================================

    $user = session()->get('user') ?? [];

    $profile = session()->get('mahasiswa_profile') ?? [];

    $userProfileId = session()->get('user_profile_id');


    // =====================================================
    // CEK PROFILE MAHASISWA
    // =====================================================

    if (!$userProfileId || empty($profile)) {

        session()->setFlashdata(
            'error',
            'Data profil mahasiswa tidak ditemukan.'
        );

        return redirect()->to(
            base_url('dashboard-mahasiswa')
        );
    }


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

        'nama' => $user['nama']
            ?? '',

        'nik' => $profile['nik']
            ?? $user['nik']
            ?? '',

        'nim' => $profile['nim']
            ?? $user['nim']
            ?? '',

        'email' => $user['email']
            ?? '',

        'telepon' => $user['no_hp']
            ?? '',

    ];


    // =====================================================
    // DATA VIEW
    // =====================================================

    $data = [

        'title' => 'Ajukan Layanan',

        'user' => $pemohon,

        'profile' => $profile,

        'userProfileId' => $userProfileId,

        'units' => $units,

    ];


    return view(
        'mahasiswa/ticket/create',
        $data
    );
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
    $db = \Config\Database::connect();

    $serviceRequestModel = new ServiceRequestModel();
    $userProfileModel = new UserProfileModel();

    // ==========================================
    // 1. AMBIL JENIS LAYANAN
    // ==========================================

    $serviceId = $this->request->getPost('jenis_layanan');

    if (empty($serviceId)) {
        return redirect()->back()
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
        return redirect()->back()
            ->withInput()
            ->with(
                'error',
                'Akun pengguna tidak ditemukan. Silakan login kembali.'
            );
    }

    $userProfile = $userProfileModel
        ->where('user_id', $userId)
        ->first();

    if (!$userProfile) {
        return redirect()->back()
            ->withInput()
            ->with(
                'error',
                'Data profil mahasiswa tidak ditemukan.'
            );
    }

    $userProfileId = $userProfile['id'];

    // ==========================================
    // 3. CEK LAYANAN
    // ==========================================

    $service = $db->table('master_services')
        ->where('id', $serviceId)
        ->where('is_active', 1)
        ->get()
        ->getRowArray();

    if (!$service) {
        return redirect()->back()
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

    $ticketNumber = 'ULT-MHS-' . strtoupper(
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

        'title' => 'Pengajuan Layanan',

        // PENTING:
        // create.php menggunakan name="keterangan"
        'description' => $this->request->getPost('keterangan'),

        'status'       => 'submitted',
        'priority'     => 'normal',
        'submitted_at' => $now,
        'created_at'   => $now,
        'updated_at'   => $now,
    ];

    $serviceRequestModel->insert($data);

    $ticketId = $serviceRequestModel->getInsertID();

    // ==========================================
    // 9. SIMPAN DOKUMEN
    // ==========================================

    foreach ($documents as $requirementId => $file) {

        // Pastikan requirement memang milik service ini
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

        // File tidak ada / tidak valid
        if (
            !$file ||
            !$file->isValid() ||
            $file->hasMoved()
        ) {
            continue;
        }

        // ======================================
        // CEK UKURAN
        // ======================================

        $maxSize =
            ((int) (
                $requirement['max_file_size']
                ?? 2048
            )) * 1024;

        if ($file->getSize() > $maxSize) {

            // Hapus tiket yang sudah dibuat
            $serviceRequestModel->delete($ticketId);

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
                $allowedExtensions
            )
        ) {

            $serviceRequestModel->delete($ticketId);

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

        // Ambil nama jenis layanan
$service = $db->table('master_services')
    ->where('id', $serviceId)
    ->get()
    ->getRowArray();

$ticket['service_name'] = $service['name'] ?? '-';

    // ==========================================
    // 11. MASUK KE SUCCESS
    // ==========================================

    session()->set(
        'last_ticket',
        $ticket
    );

    return redirect()->to(
        base_url(
            'mahasiswa/ticket/success'
        )
    );
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


// ==========================================
// CEK KELENGKAPAN DOKUMEN
// ==========================================

foreach ($drafts as &$draft) {

    // Semua persyaratan wajib
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


    $totalRequired =
        count($requirements);


    if ($totalRequired === 0) {

        $draft['document_complete'] = true;

        continue;
    }


    // Ambil file yang sudah diupload
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


    $draft['document_complete'] =
        $complete;
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
        ->get()
        ->getRowArray();


    if (!$draft) {

        return redirect()
            ->to(
                base_url(
                    'mahasiswa/ticket/draft'
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


    $uploadedFiles = [];

    foreach ($files as $file) {

        $uploadedFiles[
            $file['requirement_id']
        ] = $file;
    }


    return view(
        'mahasiswa/ticket/edit_draft',
        [
            'title'         => 'Edit Draft Pengajuan',
            'draft'         => $draft,
            'units'         => $units,
            'services'      => $services,
            'requirements'  => $requirements,
            'uploadedFiles' => $uploadedFiles,
        ]
    );
}

public function updateDraft($id)
{
    $db = \Config\Database::connect();

    $userProfileId =
        session()->get('user_profile_id');

        $action = $this->request->getPost('action');

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
        ->get()
        ->getRowArray();


    if (!$draft) {

        return redirect()
            ->to(
                base_url(
                    'mahasiswa/ticket/draft'
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
        ->get()
        ->getResultArray();


    $requirementMap = [];

    foreach ($requirements as $requirement) {

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


    foreach ($documents as $requirementId => $file) {

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


        // ======================================
        // UKURAN
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
        // EXTENSION
        // ======================================

        $extension =
            strtolower(
                $file->getClientExtension()
            );


        $allowed =
            $requirement[
                'allowed_extensions'
            ] ??
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
        // SIMPAN FILE
        // ======================================

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

    $now = date('Y-m-d H:i:s');

    // Generate nomor tiket
    $ticketNumber = $draft['ticket_number'];

    if (empty($ticketNumber)) {

        $ticketNumber = 'ULT-MHS-' . strtoupper(
            bin2hex(random_bytes(4))
        );
    }

    // ======================================
    // UBAH DRAFT MENJADI SUBMITTED
    // ======================================

    $db->table('service_requests')
        ->where('id', $id)
        ->update([

            'ticket_number' => $ticketNumber,

            'status' => 'submitted',

            'submitted_at' => $now,

            'updated_at' => $now,

        ]);


    // ======================================
    // AMBIL TIKET TERBARU
    // ======================================

    $ticket = $db->table('service_requests')
        ->where('id', $id)
        ->get()
        ->getRowArray();


    // ======================================
    // AMBIL NAMA JENIS LAYANAN
    // ======================================

    $service = $db->table('master_services')
        ->where('id', $ticket['service_id'])
        ->get()
        ->getRowArray();


    $ticket['service_name'] =
        $service['name'] ?? '-';


    // ======================================
    // LANGSUNG KE SUCCESS
    // ======================================

    return view(
        'mahasiswa/ticket/success',
        [
            'title' => 'Pengajuan Berhasil',

            'ticket' => $ticket
        ]
    );
}


// ==========================================
// JIKA HANYA SIMPAN DRAFT
// ==========================================

return redirect()
    ->to(
        base_url(
            'mahasiswa/ticket/draft'
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
    $db = \Config\Database::connect();

    // ==========================================
    // CEK USER LOGIN
    // ==========================================

    $userId = session()->get('user_id');

    if (empty($userId)) {
        return redirect()
            ->to(base_url('login'))
            ->with('error', 'Silakan login terlebih dahulu.');
    }


    // ==========================================
    // AMBIL PROFILE MAHASISWA
    // ==========================================

    $userProfile = $db->table('user_profiles')
        ->where('user_id', $userId)
        ->get()
        ->getRowArray();

    if (!$userProfile) {
        return redirect()
            ->to(base_url('dashboard-mahasiswa'))
            ->with('error', 'Data profil mahasiswa tidak ditemukan.');
    }


    // ==========================================
    // AMBIL TIKET MILIK MAHASISWA
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

        $createdAt = $ticket['submitted_at']
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

            'id' => $ticket['id'],

            'nomor' =>
                $ticket['ticket_number'] ?? '-',

            'unit_layanan' =>
                $ticket['unit_name'] ?? '-',

            'layanan' =>
                $ticket['service_name'] ?? '-',

            'keterangan' =>
                $ticket['description'] ?? '-',

            'dokumen' => null,

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
        'mahasiswa/ticket/history',
        [
            'title' => 'Tracking Tiket',
            'tickets' => $formattedTickets
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

    $userProfileId = session()->get('user_profile_id');

    if (empty($userProfileId)) {
        return redirect()
            ->to(base_url('mahasiswa/ticket/history'))
            ->with('error', 'Data profil mahasiswa tidak ditemukan.');
    }


    // ==========================================
    // AMBIL DATA TIKET
    // ==========================================

    $ticket = $db->table('service_requests sr')

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

        ->where('sr.id', $id)

        ->where(
            'sr.user_profile_id',
            $userProfileId
        )

        ->get()
        ->getRowArray();


    // ==========================================
    // TIKET TIDAK DITEMUKAN
    // ==========================================

    if (!$ticket) {
        return redirect()
            ->to(base_url('mahasiswa/ticket/history'))
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

        'title' => 'Detail Tiket',

        'ticket' => $ticket,

        'documents' => $documents,

    ];


    return view(
        'mahasiswa/ticket/detail',
        $data
    );
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