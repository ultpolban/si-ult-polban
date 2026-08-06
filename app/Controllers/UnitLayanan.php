<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenangananTiketModel;
use App\Models\DokumenHasilModel;

class UnitLayanan extends BaseController
{
    protected $penangananTiketModel;
    protected $dokumenHasilModel;

    public function __construct()
    {
        $this->penangananTiketModel = new PenangananTiketModel();
        $this->dokumenHasilModel = new DokumenHasilModel();
    }

    private function mappingLayanan($judul)
    {
        $data = [
            'Permohonan Legalisir Ijazah' => [
                'unit' => 'Akademik',
                'kategori' => 'Legalisasi Dokumen',
                'layanan' => 'Legalisir Ijazah',
            ],
            'Pembuatan Surat Aktif Kuliah' => [
                'unit' => 'Akademik',
                'kategori' => 'Surat Akademik',
                'layanan' => 'Surat Aktif Kuliah',
            ],
            'Pengajuan Beasiswa Mahasiswa' => [
                'unit' => 'Kemahasiswaan',
                'kategori' => 'Beasiswa',
                'layanan' => 'Pengajuan Beasiswa',
            ],
            'Permohonan Informasi Pembayaran UKT' => [
                'unit' => 'Keuangan',
                'kategori' => 'Pembayaran',
                'layanan' => 'Pembayaran UKT',
            ],
            'Pengajuan Cicilan UKT' => [
                'unit' => 'Keuangan',
                'kategori' => 'Pembayaran',
                'layanan' => 'Cicilan UKT',
            ],
            'Permohonan Surat Bebas Pustaka' => [
                'unit' => 'Perpustakaan',
                'kategori' => 'Layanan Perpustakaan',
                'layanan' => 'Bebas Pustaka',
            ],
            'Pengajuan Perpanjangan Peminjaman Buku' => [
                'unit' => 'Perpustakaan',
                'kategori' => 'Layanan Perpustakaan',
                'layanan' => 'Perpanjangan Peminjaman Buku',
            ],
            'Pengaduan Pelayanan ULT' => [
                'unit' => 'Umum',
                'kategori' => 'Pengaduan',
                'layanan' => 'Pengaduan Pelayanan',
            ],
        ];

        return $data[$judul] ?? [
            'unit' => 'Akademik',
            'kategori' => 'Surat Akademik',
            'layanan' => 'Surat Aktif Kuliah',
        ];
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard Unit Layanan',
            'tiket' => $this->penangananTiketModel->findAll(),
        ];

        return view('unit_layanan/index', $data);
    }

private function getTiketDetail($id)
{
$query = $this->penangananTiketModel
    ->select('
        penanganan_tiket.id,
        penanganan_tiket.status,

        pengajuan_tiket.no_tiket,
        pengajuan_tiket.nama_pemohon,
        pengajuan_tiket.nim,
        pengajuan_tiket.created_at,
        pengajuan_tiket.judul,

        layanan.nama_layanan,
        kategori_layanan.nama_kategori,
        unit_layanan.nama_unit
    ')
    ->join(
        'pengajuan_tiket',
        'pengajuan_tiket.id = penanganan_tiket.tiket_id',
        'left'
    )
    ->join(
        'layanan',
        'layanan.id = pengajuan_tiket.layanan_id',
        'left'
    )
    ->join(
        'kategori_layanan',
        'kategori_layanan.id = layanan.kategori_id',
        'left'
    )
    ->join(
        'unit_layanan',
        'unit_layanan.id = kategori_layanan.unit_id',
        'left'
    );
    $tiket = $query
        ->where('penanganan_tiket.id', $id)
        ->first();

    if (!$tiket) {
        $tiket = $query
            ->where('penanganan_tiket.tiket_id', $id)
            ->first();
    }

    if (!$tiket) {
        $tiket = $query
            ->where('pengajuan_tiket.id', $id)
            ->first();
    }

    return $tiket;
}

    private function canSendToUlt($status): bool
    {
        return strtolower((string) $status) === 'selesai';
    }

    private function resolvePenangananTiket($id)
    {
        $tiket = $this->penangananTiketModel->find($id);

        if (!$tiket) {
            $tiket = $this->penangananTiketModel->where('tiket_id', $id)->first();
        }

        return $tiket;
    }

    private function simpanDokumenHasil($penangananId, $files): array
    {
        if (empty($files)) {
            return ['success' => true, 'uploaded' => []];
        }

        $uploaded = [];

        foreach ($files as $file) {
            if (empty($file) || !$file->isValid() || $file->hasMoved()) {
                continue;
            }

            if ($file->getSize() > 5242880) {
                return ['success' => false, 'error' => 'Ukuran file maksimal 5 MB'];
            }

            $ext = strtolower($file->getClientExtension());
            if (!in_array($ext, ['pdf', 'jpg', 'jpeg', 'png'], true)) {
                return ['success' => false, 'error' => 'Format file tidak diperbolehkan'];
            }

            $namaFile = $file->getRandomName();
            $targetPath = FCPATH . 'uploads/hasil/' . $namaFile;

            while (file_exists($targetPath)) {
                $namaFile = $file->getRandomName();
                $targetPath = FCPATH . 'uploads/hasil/' . $namaFile;
            }

            $file->move(FCPATH . 'uploads/hasil', $namaFile);
            $this->dokumenHasilModel->insert([
                'penanganan_id' => $penangananId,
                'nama_file' => $namaFile,
            ]);

            $uploaded[] = $namaFile;
        }

        return ['success' => true, 'uploaded' => $uploaded];
    }

    public function detail($id)
    {
        $tiket = $this->getTiketDetail($id);

        if (!$tiket) {
            return redirect()
                ->to(base_url('unit-layanan/dashboard'))
                ->with('error', 'Data tiket tidak ditemukan');
        }

        $tiket['judul'] = $tiket['judul'] ?? $tiket['nama_layanan'] ?? 'Permohonan Legalisir Ijazah';
        $tiket['deskripsi'] = $tiket['deskripsi'] ?? 'Tidak ada deskripsi tambahan.';
        $tiket['nama_layanan'] = $tiket['nama_layanan'] ?? 'Legalisir Ijazah';
        $tiket['nama_kategori'] = $tiket['nama_kategori'] ?? 'Legalisasi Dokumen';
        $tiket['nama_unit'] = $tiket['nama_unit'] ?? 'Akademik';
        $tiket['status'] = $tiket['status_tiket'] ?? $tiket['status_pengajuan'] ?? $tiket['status'] ?? 'Menunggu';

        $dokumen = $this->dokumenHasilModel
            ->where('penanganan_id', $tiket['id'])
            ->findAll();

        $tiket['dokumen_hasil'] = $dokumen;

        return view('unit_layanan/detail', [
            'title' => 'Detail Tiket',
            'tiket' => $tiket,
        ]);
    }

    public function updateProses($id)
    {
        $status = $this->request->getPost('status');
        $catatan = $this->request->getPost('catatan');

        $data = [
            'status' => $status,
            'catatan' => $catatan,
        ];

        $tiket = $this->resolvePenangananTiket($id);

        if (!$tiket) {
            return redirect()
                ->back()
                ->with('error', 'Data tiket tidak ditemukan');
        }

        $files = $this->request->getFileMultiple('file_hasil');
        if ($files === null) {
            $files = [];
        } elseif (!is_array($files)) {
            $files = [$files];
        }

        $uploadResult = $this->simpanDokumenHasil($tiket['id'], $files);

        if (!$uploadResult['success']) {
            return redirect()->back()->with('error', $uploadResult['error']);
        }

        $redirectId = $tiket['id'] ?? $id;
        $this->penangananTiketModel->update($redirectId, $data);

        return redirect()
            ->to('/unit-layanan/detail/' . $redirectId)
            ->with('success', 'Tiket berhasil diproses.');
    }

    public function proses($id)
    {
        $tiket = $this->getTiketDetail($id);

        if (!$tiket) {
            return redirect()
                ->to('/unit-layanan/dashboard')
                ->with('error', 'Data tiket tidak ditemukan');
        }

        $tiket['judul'] = $tiket['judul'] ?? $tiket['nama_layanan'] ?? 'Permohonan Legalisir Ijazah';
        $tiket['deskripsi'] = $tiket['deskripsi'] ?? 'Tidak ada deskripsi tambahan.';
        $tiket['nama_layanan'] = $tiket['nama_layanan'] ?? 'Legalisir Ijazah';
        $tiket['nama_kategori'] = $tiket['nama_kategori'] ?? 'Legalisasi Dokumen';
        $tiket['nama_unit'] = $tiket['nama_unit'] ?? 'Akademik';
        $tiket['status'] = $tiket['status_tiket'] ?? $tiket['status_pengajuan'] ?? $tiket['status'] ?? 'Menunggu';

        $tiket['dokumen_hasil'] = $this->dokumenHasilModel
            ->where('penanganan_id', $tiket['id'])
            ->findAll();

        return view('unit_layanan/proses', [
            'title' => 'Proses Tiket',
            'tiket' => $tiket,
        ]);
    }

public function dashboard()
{
    $data = [

        'title' => 'Dashboard Unit Layanan',


        'menunggu' => $this->penangananTiketModel
            ->where('status', 'Menunggu')
            ->countAllResults(),


        'diproses' => $this->penangananTiketModel
            ->where('status', 'Diproses')
            ->countAllResults(),


        'selesai' => $this->penangananTiketModel
            ->where('status', 'Selesai')
            ->countAllResults(),


        'total' => $this->penangananTiketModel
            ->countAll(),



        'tiket' => $this->penangananTiketModel
            ->select('
                penanganan_tiket.id,
                penanganan_tiket.status,

                pengajuan_tiket.no_tiket,
                pengajuan_tiket.nama_pemohon,
                pengajuan_tiket.nim,
                pengajuan_tiket.created_at,
                pengajuan_tiket.judul,

                layanan.nama_layanan,

                kategori_layanan.nama_kategori,

                unit_layanan.nama_unit
            ')
            ->join(
                'pengajuan_tiket',
                'pengajuan_tiket.id = penanganan_tiket.tiket_id',
                'left'
            )
            ->join(
                'layanan',
                'layanan.id = pengajuan_tiket.layanan_id',
                'left'
            )
            ->join(
                'kategori_layanan',
                'kategori_layanan.id = layanan.kategori_id',
                'left'
            )
            ->join(
                'unit_layanan',
                'unit_layanan.id = kategori_layanan.unit_id',
                'left'
            )
            ->orderBy('penanganan_tiket.id', 'DESC')
            ->findAll()

    ];


    return view('unit_layanan/dashboard', $data);
}

    public function upload($id)
    {
        $tiket = $this->penangananTiketModel
            ->select('
                penanganan_tiket.*,
                pengajuan_tiket.no_tiket,
                pengajuan_tiket.judul,
                layanan.nama_layanan
            ')
            ->join('pengajuan_tiket', 'pengajuan_tiket.id = penanganan_tiket.tiket_id')
            ->join('layanan', 'layanan.id = pengajuan_tiket.layanan_id', 'left')
            ->where('pengajuan_tiket.id', $id)
            ->first();

        if (!$tiket) {
            return redirect()
                ->to('/unit-layanan/dashboard')
                ->with('error', 'Data tiket tidak ditemukan');
        }

        $dokumen = $this->dokumenHasilModel
            ->where('penanganan_id', $tiket['id'])
            ->findAll();

        return view('unit_layanan/upload', [
            'title' => 'Upload Dokumen Hasil',
            'tiket' => $tiket,
            'dokumen_hasil' => $dokumen,
        ]);
    }

    public function simpanUpload($id)
    {
        $tiket = $this->resolvePenangananTiket($id);

        if (!$tiket) {
            return redirect()->back()->with('error', 'Data tiket tidak ditemukan');
        }

        $files = $this->request->getFileMultiple('file_hasil');
        if ($files === null) {
            $files = [];
        } elseif (!is_array($files)) {
            $files = [$files];
        }

        if (empty($files)) {
            return redirect()->back()->with('error', 'Silahkan pilih dokumen terlebih dahulu');
        }

        $uploadResult = $this->simpanDokumenHasil($tiket['id'], $files);
        if (!$uploadResult['success']) {
            return redirect()->back()->with('error', $uploadResult['error']);
        }

        return redirect()
            ->to(base_url('unit-layanan/detail/' . ($tiket['id'] ?? $id)))
            ->with('success', 'Dokumen hasil berhasil diupload');
    }

    public function kirim($id)
    {
        $tiket = $this->resolvePenangananTiket($id);

        if (!$tiket) {
            return redirect()
                ->back()
                ->with('error', 'Data tiket tidak ditemukan');
        }

        if (!$this->canSendToUlt($tiket['status'] ?? '')) {
            return redirect()
                ->back()
                ->with('error', 'Tiket hanya bisa dikirim ke Petugas ULT setelah status Selesai.');
        }

        $this->penangananTiketModel->update($tiket['id'] ?? $id, ['status' => 'Diproses']);

        return redirect()
            ->to('/unit-layanan/detail/' . ($tiket['id'] ?? $id))
            ->with('success', 'Tiket berhasil dikirim ke Petugas ULT.');
    }

    public function riwayat()
    {
        return redirect()->to('/unit-layanan/dashboard');
    }

    public function hapusDokumen($id)
    {
        $dokumen = $this->dokumenHasilModel->find($id);

        if (!$dokumen) {
            return redirect()
                ->back()
                ->with('error', 'Dokumen tidak ditemukan');
        }

        $path = FCPATH . 'uploads/hasil/' . $dokumen['nama_file'];

        if (file_exists($path)) {
            unlink($path);
        }

        $this->dokumenHasilModel->delete($id);

        return redirect()
            ->back()
            ->with('success', 'Dokumen berhasil dihapus');
    }
}
