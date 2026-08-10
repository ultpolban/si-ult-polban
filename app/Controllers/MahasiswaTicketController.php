<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MahasiswaTicketController extends BaseController
{
    /**
     * =========================================================
     * DATA DUMMY LAYANAN
     * =========================================================
     *
     * Sementara menggunakan data dummy karena database layanan
     * belum selesai.
     *
     * Struktur:
     * Unit Layanan
     *   -> Jenis Layanan
     *       -> Persyaratan
     */
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
    $data = [

        'title' => 'Ajukan Layanan',

        // Data pemohon dummy sementara
        'user' => [

            'nama' => 'Muhamad Rafi Putra Zakaria',
            'nik' => '3273010101040001',
            'nim' => '45678',
            'email' => 'mochrafiputrazakaria@gmail.com',
            'telepon' => '083123456788',

        ],

        // Data layanan dummy
        'layanan' => $this->getDataLayanan(),

    ];

    return view('mahasiswa/ticket/create', $data);
}


    /**
     * =========================================================
     * STORE / PROSES PENGAJUAN
     * =========================================================
     *
     * Untuk sementara belum menyimpan ke database.
     *
     * Nanti setelah database selesai, bagian ini tinggal
     * diganti dengan proses insert ke tabel ticket/pengajuan.
     */
    public function store()
{
    $action = $this->request->getPost('action');

    $namaPemohon = $this->request->getPost('nama_pemohon');
    $nik         = $this->request->getPost('nik');
    $unit        = $this->request->getPost('unit_layanan');
    $jenis       = $this->request->getPost('jenis_layanan');
    $keterangan  = $this->request->getPost('keterangan');

    // ==========================================
    // VALIDASI
    // ==========================================

    if (empty($namaPemohon)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Nama pemohon tidak boleh kosong.');
    }

    if (empty($nik)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'NIK tidak boleh kosong.');
    }

    if (empty($unit)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Silakan pilih Unit Layanan.');
    }

    if (empty($jenis)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Silakan pilih Jenis Layanan.');
    }

    // ==========================================
    // DOKUMEN
    // ==========================================

    $files = $this->request->getFileMultiple('dokumen');

    $jumlahDokumen = 0;

    if ($files) {
        foreach ($files as $file) {
            if ($file && $file->isValid()) {
                $jumlahDokumen++;
            }
        }
    }

    // ==========================================
    // SIMPAN SEBAGAI DRAFT
    // ==========================================

    if ($action === 'draft') {

        $draftNumber = 'DRF-' . date('Ymd') . '-' . strtoupper(
            substr(bin2hex(random_bytes(3)), 0, 5)
        );

        $draft = [
            'nomor_draft'     => $draftNumber,
            'nama_pemohon'    => $namaPemohon,
            'nik'             => $nik,
            'unit_layanan'    => $unit,
            'jenis_layanan'   => $jenis,
            'keterangan'      => $keterangan,
            'jumlah_dokumen'  => $jumlahDokumen,
            'created_at'      => date('Y-m-d H:i:s'),
        ];

        // Ambil draft yang sudah ada
        $drafts = session()->get('mahasiswa_drafts') ?? [];

        // Tambahkan draft baru
        $drafts[] = $draft;

        // Simpan ke session
        session()->set('mahasiswa_drafts', $drafts);

        // Simpan draft sementara untuk halaman sukses
        session()->set('draft_success', $draft);

        return redirect()->to(
            base_url('mahasiswa/ticket/draft-success')
        );
    }

    // ==========================================
    // BUAT NOMOR TIKET
    // ==========================================

    $ticketNumber = 'ULT-' . date('Ymd') . '-' . strtoupper(
        substr(bin2hex(random_bytes(3)), 0, 5)
    );

    // ==========================================
    // DATA TIKET DUMMY
    // ==========================================

    $ticket = [
        'nomor_tiket'    => $ticketNumber,
        'nama_pemohon'   => $namaPemohon,
        'nik'            => $nik,
        'unit_layanan'   => $unit,
        'jenis_layanan'  => $jenis,
        'keterangan'     => $keterangan,
        'jumlah_dokumen' => $jumlahDokumen,
        'status'         => 'Menunggu Verifikasi',
        'created_at'     => date('Y-m-d H:i:s'),
    ];

    // ==========================================
    // SIMPAN TIKET KE SESSION
    // ==========================================

    $tickets = session()->get('mahasiswa_tickets') ?? [];

    $tickets[] = $ticket;

    session()->set('mahasiswa_tickets', $tickets);

    // Tiket terakhir
    session()->set('last_ticket', $ticket);

    // ==========================================
    // REDIRECT SUCCESS
    // ==========================================

    return redirect()->to(
        base_url('mahasiswa/ticket/success')
    );
}


    /**
     * =========================================================
     * DATA LAYANAN UNTUK TEST / DEBUG
     * =========================================================
     */
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

public function tracking($nomorTiket = null)
{
    // Ambil semua tiket dummy dari session
    $tickets = session()->get('mahasiswa_tickets') ?? [];

    // Kalau nomor tiket dikirim lewat URL
    if ($nomorTiket) {

        foreach ($tickets as $ticket) {

            if ($ticket['nomor_tiket'] === $nomorTiket) {

                return view('mahasiswa/ticket/tracking', [
                    'title'  => 'Tracking Tiket',
                    'ticket' => $ticket
                ]);
            }
        }

        // Tiket tidak ditemukan
        return redirect()
            ->to(base_url('mahasiswa/ticket/tracking'))
            ->with('error', 'Nomor tiket tidak ditemukan.');
    }

    // Kalau belum memilih nomor tiket,
    // tampilkan semua tiket mahasiswa
    return view('mahasiswa/ticket/tracking', [
        'title'   => 'Tracking Tiket',
        'tickets' => $tickets
    ]);
}


/**
 * =========================================================
 * HISTORY / TRACKING TIKET
 * =========================================================
 */
public function history()
{
    $data = [
        'title' => 'Tracking Tiket',

        // Dummy sementara
        'tickets' => []
    ];

    return view('mahasiswa/ticket/history', $data);
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