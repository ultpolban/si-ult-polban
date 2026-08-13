<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenangananTiketModel;
use App\Models\DokumenHasilModel;

class Kemahasiswaan extends BaseController
{
    protected $penangananTiketModel;
    protected $dokumenHasilModel;

    public function __construct()
    {
        $this->penangananTiketModel = new PenangananTiketModel();
        $this->dokumenHasilModel = new DokumenHasilModel();
    }


    // =========================================================
    // DASHBOARD KEMAHASISWAAN
    // =========================================================
    public function index()
    {
        $unitName = 'Kemahasiswaan';

        $query = $this->penangananTiketModel
            ->select('
                penanganan_tiket.id,
                penanganan_tiket.status,
                penanganan_tiket.created_at,
                pengajuan_tiket.no_tiket,
                pengajuan_tiket.nama_pemohon,
                pengajuan_tiket.nim,
                pengajuan_tiket.judul,
                layanan.nama_layanan,
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
            ->where('unit_layanan.nama_unit', $unitName)
            ->orderBy('penanganan_tiket.id', 'DESC');

        $tiket = $query->findAll();

        $data = [
            'title'    => 'Dashboard Kemahasiswaan',
            'total'    => count($tiket),
            'menunggu' => 0,
            'diproses' => 0,
            'selesai'  => 0,
            'tiket'    => $tiket,
        ];

        foreach ($tiket as $item) {

            if (($item['status'] ?? '') === 'Menunggu') {
                $data['menunggu']++;
            } elseif (($item['status'] ?? '') === 'Diproses') {
                $data['diproses']++;
            } elseif (($item['status'] ?? '') === 'Selesai') {
                $data['selesai']++;
            }
        }

        return view('kemahasiswaan/dashboard', $data);
    }


    // =========================================================
    // PROFIL KEMAHASISWAAN
    // =========================================================
    public function profile()
    {
        return view('kemahasiswaan/profile', [
            'title' => 'Profil Petugas Kemahasiswaan'
        ]);
    }


    // =========================================================
    // DETAIL TIKET
    // =========================================================
    public function detail($id)
    {
        $tiket = $this->penangananTiketModel
            ->select('
                penanganan_tiket.*,
                pengajuan_tiket.no_tiket,
                pengajuan_tiket.nama_pemohon,
                pengajuan_tiket.nim,
                pengajuan_tiket.email,
                pengajuan_tiket.no_hp,
                pengajuan_tiket.judul,
                pengajuan_tiket.deskripsi,
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
            ->where('penanganan_tiket.id', $id)
            ->first();

        if (!$tiket) {
            return redirect()
                ->to('/kemahasiswaan')
                ->with('error', 'Data tiket tidak ditemukan');
        }

        // Ambil dokumen hasil
        // KOLOM DATABASE = penanganan_id
        $dokumenHasil = $this->dokumenHasilModel
            ->where('penanganan_id', $id)
            ->findAll();

        $tiket['dokumen_hasil'] = $dokumenHasil;

        return view(
            'kemahasiswaan/detail',
            [
                'title' => 'Detail Tiket Kemahasiswaan',
                'tiket' => $tiket
            ]
        );
    }


    // =========================================================
    // HALAMAN PROSES
    // =========================================================
    public function proses($id)
    {
        $tiket = $this->penangananTiketModel
            ->select('
                penanganan_tiket.*,
                pengajuan_tiket.no_tiket,
                pengajuan_tiket.nama_pemohon,
                pengajuan_tiket.nim,
                pengajuan_tiket.email,
                pengajuan_tiket.no_hp,
                pengajuan_tiket.judul,
                pengajuan_tiket.deskripsi,
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
            ->where('penanganan_tiket.id', $id)
            ->first();

        if (!$tiket) {
            return redirect()
                ->to('/kemahasiswaan')
                ->with('error', 'Data tiket tidak ditemukan');
        }

        // Ambil dokumen sebelumnya
        $dokumenHasil = $this->dokumenHasilModel
            ->where('penanganan_id', $id)
            ->findAll();

        $tiket['dokumen_hasil'] = $dokumenHasil;

        return view(
            'kemahasiswaan/proses',
            [
                'title' => 'Proses Tiket Kemahasiswaan',
                'tiket' => $tiket
            ]
        );
    }


    // =========================================================
    // UPDATE PROSES + UPLOAD DOKUMEN
    // =========================================================
    public function updateProses($id)
    {
        $tiket = $this->penangananTiketModel->find($id);

        if (!$tiket) {
            return redirect()
                ->back()
                ->with('error', 'Data tiket tidak ditemukan');
        }

        $status = $this->request->getPost('status');
        $catatan = $this->request->getPost('catatan');

        // Validasi status
        $statusDiizinkan = [
            'Menunggu',
            'Diproses',
            'Selesai'
        ];

        if (!in_array($status, $statusDiizinkan, true)) {
            return redirect()
                ->back()
                ->with('error', 'Status tiket tidak valid.');
        }

        // Update data penanganan
        $updateData = [
            'status'  => $status,
            'catatan' => $catatan
        ];

        $this->penangananTiketModel->update($id, $updateData);


        // =====================================================
        // UPLOAD DOKUMEN
        // =====================================================

        $files = $this->request->getFileMultiple('file_hasil');

        if (!empty($files)) {

            $uploadPath = FCPATH . 'uploads/hasil/';

            // Buat folder jika belum ada
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            foreach ($files as $file) {

                // Skip jika tidak ada file
                if (!$file || !$file->isValid()) {
                    continue;
                }

                // Validasi ukuran maksimal 5 MB
                if ($file->getSize() > 5 * 1024 * 1024) {

                    return redirect()
                        ->back()
                        ->with(
                            'error',
                            'File "' .
                            $file->getName() .
                            '" melebihi ukuran maksimal 5 MB.'
                        );
                }

                // Validasi ekstensi
                $extension = strtolower(
                    $file->getClientExtension()
                );

                $allowedExtensions = [
                    'pdf',
                    'jpg',
                    'jpeg',
                    'png'
                ];

                if (!in_array($extension, $allowedExtensions, true)) {

                    return redirect()
                        ->back()
                        ->with(
                            'error',
                            'Format file "' .
                            $file->getName() .
                            '" tidak diperbolehkan.'
                        );
                }

                // Nama file baru
                $newName = $file->getRandomName();

                // Pindahkan file
                if ($file->move($uploadPath, $newName)) {

                    // Simpan ke tabel dokumen_hasil
                    //
                    // KOLOM DATABASE:
                    // penanganan_id
                    // nama_file

                    $this->dokumenHasilModel->insert([
                        'penanganan_id' => $id,
                        'nama_file'     => $newName
                    ]);
                }
            }
        }

        return redirect()
            ->to('/kemahasiswaan/detail/' . $id)
            ->with(
                'success',
                'Proses tiket berhasil disimpan.'
            );
    }


    // =========================================================
    // HAPUS DOKUMEN HASIL
    // =========================================================
    public function hapusDokumen($id)
    {
        $dokumen = $this->dokumenHasilModel->find($id);

        if (!$dokumen) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Dokumen tidak ditemukan.'
                );
        }

        // Hapus file fisik
        $filePath = FCPATH .
            'uploads/hasil/' .
            $dokumen['nama_file'];

        if (is_file($filePath)) {
            unlink($filePath);
        }

        // Simpan ID penanganan sebelum data dihapus
        $penangananId = $dokumen['penanganan_id'];

        // Hapus record database
        $this->dokumenHasilModel->delete($id);

        return redirect()
            ->to('/kemahasiswaan/proses/' . $penangananId)
            ->with(
                'success',
                'Dokumen berhasil dihapus.'
            );
    }


    // =========================================================
    // KIRIM KE PETUGAS ULT
    // =========================================================
    public function kirim($id)
    {
        $tiket = $this->penangananTiketModel->find($id);

        if (!$tiket) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data tiket tidak ditemukan'
                );
        }

        if (
            (string) ($tiket['status'] ?? '') !== 'Selesai'
        ) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tiket hanya bisa dikirim ke Petugas ULT setelah status Selesai.'
                );
        }

        $this->penangananTiketModel->update(
            $id,
            [
                'status' => 'Diproses'
            ]
        );

        return redirect()
            ->to('/kemahasiswaan/detail/' . $id)
            ->with(
                'success',
                'Tiket berhasil dikirim ke Petugas ULT.'
            );
    }


    // =========================================================
    // KIRIM KE PEMOHON
    // =========================================================
    public function kirimKePemohon($id)
    {
        $tiket = $this->penangananTiketModel->find($id);

        if (!$tiket) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data tiket tidak ditemukan'
                );
        }

        $status = strtolower(
            (string) ($tiket['status'] ?? '')
        );

        if (
            !in_array(
                $status,
                ['selesai', 'diproses'],
                true
            )
        ) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tiket hanya bisa dikirim ke pemohon setelah status Selesai atau Diproses.'
                );
        }

        $this->penangananTiketModel->update(
            $id,
            [
                'status' => 'Selesai'
            ]
        );

        return redirect()
            ->to('/kemahasiswaan/detail/' . $id)
            ->with(
                'success',
                'Tiket berhasil dikirim ke pemohon.'
            );
    }
}