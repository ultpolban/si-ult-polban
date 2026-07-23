<?php

namespace App\Controllers;

class MahasiswaHelpController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Pusat Bantuan Mahasiswa',

            'faqs' => [
                [
                    'pertanyaan' => 'Bagaimana cara mengajukan layanan?',
                    'jawaban' => 'Pilih menu Ajukan Layanan pada sidebar, kemudian pilih jenis layanan yang dibutuhkan, isi keterangan, upload dokumen jika diperlukan, lalu klik Kirim Pengajuan.'
                ],

                [
                    'pertanyaan' => 'Bagaimana cara melihat status pengajuan?',
                    'jawaban' => 'Kamu dapat melihat status pengajuan melalui menu Tracking Tiket. Status tiket akan diperbarui sesuai proses layanan.'
                ],

                [
                    'pertanyaan' => 'Apa arti status Submitted?',
                    'jawaban' => 'Status Submitted berarti pengajuan sudah berhasil dikirim dan sedang menunggu proses verifikasi.'
                ],

                [
                    'pertanyaan' => 'Apa arti status In Progress?',
                    'jawaban' => 'Status In Progress berarti pengajuan sedang diproses oleh unit yang menangani layanan tersebut.'
                ],

                [
                    'pertanyaan' => 'Bagaimana jika pengajuan perlu diperbaiki?',
                    'jawaban' => 'Jika pengajuan membutuhkan perbaikan, kamu akan mendapatkan notifikasi dan dapat melihat catatan perbaikan pada detail tiket.'
                ],

                [
                    'pertanyaan' => 'Bagaimana cara mengubah data profil?',
                    'jawaban' => 'Buka menu Profil, kemudian pilih Edit Profil. Data yang dapat diperbarui adalah nama, email, nomor telepon, dan alamat.'
                ]
            ]
        ];

        return view('mahasiswa/help/index', $data);
    }
}