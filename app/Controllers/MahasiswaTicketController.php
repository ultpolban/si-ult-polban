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
    $serviceRequestModel = new ServiceRequestModel();

    // ==========================================
    // AMBIL SERVICE / JENIS LAYANAN
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

    $ticketNumber = 'ULT-MHS-DRAFT-' . strtoupper(
        bin2hex(random_bytes(4))
    );


    // ==========================================
    // WAKTU
    // ==========================================

    $now = date('Y-m-d H:i:s');


    // ==========================================
    // DATA DRAFT
    // ==========================================

$data = [
    'ticket_number'   => null,
    'user_profile_id' => $userProfileId,
    'service_id'      => $serviceId,
    'title'           => 'Pengajuan Layanan',
    'description'     => $this->request->getPost('keterangan'),
    'status'          => 'draft',
    'priority'        => 'normal',
    'submitted_at'    => null,
    'created_at'      => $now,
    'updated_at'      => $now,
];


    // ==========================================
    // SIMPAN
    // ==========================================

    $serviceRequestModel->insert($data);


    // ==========================================
    // REDIRECT
    // ==========================================

    return redirect()
        ->to(base_url('mahasiswa/ticket/draft'))
        ->with('success', 'Pengajuan berhasil disimpan sebagai draft.');
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
    $data = [
        'title' => 'Draft Pengajuan',

        // Dummy sementara
        'drafts' => []
    ];

    return view('mahasiswa/ticket/draft', $data);
}


/**
 * =========================================================
 * HAPUS DRAFT
 * =========================================================
 */
public function deleteDraft($id)
{
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
 * EDIT DRAFT
 * =========================================================
 */
public function editDraft($id)
{
    $data = [
        'title' => 'Edit Draft Pengajuan',

        'draft' => [
            'id' => $id,
            'nama_pemohon' => 'Muhamad Rafi Putra Zakaria',
            'nik' => '3273010101040001',
            'unit_layanan' => '',
            'jenis_layanan' => '',
            'keterangan' => '',
        ],

        'layanan' => $this->getDataLayanan(),
    ];

    return view(
        'mahasiswa/ticket/edit_draft',
        $data
    );
}


/**
 * =========================================================
 * UPDATE DRAFT
 * =========================================================
 */
public function updateDraft($id)
{
    session()->setFlashdata(
        'success',
        'Draft berhasil diperbarui.'
    );

    return redirect()->to(
        base_url('mahasiswa/ticket/draft')
    );
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