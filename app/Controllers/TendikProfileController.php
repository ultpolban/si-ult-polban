<?php

namespace App\Controllers;

class TendikProfileController extends BaseController
{
    /**
     * ==========================================
     * HALAMAN PROFIL TENDIK
     * ==========================================
     */
    public function index()
    {
        // Ambil data user dari session
       $profile = session()->get('user') ?? [];

$data = [
    'title'   => 'Profil Tendik',
    'profile' => $profile,
];
return view(
    'tendik/profile/index',
    $data
);
    }


    /**
     * ==========================================
     * HALAMAN EDIT PROFIL TENDIK
     * ==========================================
     */
    public function edit()
    {
        // Ambil data user dari session
        $profile = session()->get('user') ?? [];

$data = [
    'title'   => 'Edit Profil Tendik',
    'profile' => $profile,
];
return view(
    'tendik/profile/edit',
    $data
);
    }


    /**
     * ==========================================
     * UPDATE PROFIL TENDIK
     * ==========================================
     */
    public function update()
{
    $profile = session()->get('user') ?? [];

    // ============================
    // DATA PRIBADI
    // ============================

    $profile['nama']            = trim($this->request->getPost('nama'));

    $profile['nik']             = trim($this->request->getPost('nik'));

    $profile['nip']             = trim($this->request->getPost('nip'));

    $profile['email']           = trim($this->request->getPost('email'));

    $profile['no_hp']           = trim($this->request->getPost('no_hp'));

    $profile['jenis_kelamin']   = trim($this->request->getPost('jenis_kelamin'));

    $profile['alamat']          = trim($this->request->getPost('alamat'));

    // ============================
    // KEPEGAWAIAN
    // ============================

    $profile['unit_kerja']      = trim($this->request->getPost('unit_kerja'));

    $profile['bagian']          = trim($this->request->getPost('bagian'));

    $profile['jabatan']         = trim($this->request->getPost('jabatan'));

    $profile['status']          = trim($this->request->getPost('status'));

    // ============================
    // VALIDASI
    // ============================

    if (
        empty($profile['nama']) ||
        empty($profile['nik']) ||
        empty($profile['nip']) ||
        empty($profile['email'])
    ) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Nama, NIK, NIP dan Email wajib diisi.'
            );
    }

    // ============================
    // UPLOAD FOTO
    // ============================

    $foto = $this->request->getFile('foto');

    if ($foto && $foto->isValid() && !$foto->hasMoved()) {

        $folder = FCPATH . 'uploads/profile';

        if (!is_dir($folder)) {

            mkdir($folder, 0777, true);

        }

        if (!empty($profile['foto'])) {

            $old = $folder . '/' . $profile['foto'];

            if (file_exists($old)) {

                unlink($old);

            }

        }

        $namaFoto = $foto->getRandomName();

        $foto->move($folder, $namaFoto);

        $profile['foto'] = $namaFoto;

    }

    // ============================
    // SIMPAN SESSION
    // ============================

    session()->set('user', $profile);

    return redirect()
        ->to(base_url('tendik/profile'))
        ->with(
            'success',
            'Profil berhasil diperbarui.'
        );
}
}