<?php

namespace App\Controllers;

use App\Models\TicketModel;

class DispositionController extends BaseController
{
    protected $ticketModel;

    public function __construct()
    {
        $this->ticketModel = new TicketModel();
    }

    // Daftar tiket yang sudah diverifikasi
    public function index()
    {
        $data['tickets'] = $this->ticketModel
            ->where('status', 'Verified')
            ->findAll();

        return view('disposition/index', $data);
    }

    // Detail disposisi
    public function detail($id)
    {
        $ticketModel = new TicketModel();

        $ticket = $ticketModel->find($id);

        if (!$ticket) {
            return redirect()->to('/disposition')
                ->with('error', 'Tiket tidak ditemukan.');
        }

        // Field tambahan yang tampil mengikuti JENIS PEMOHON pada form pengajuan.
        // Field yang kosong tidak akan ditampilkan.
        $fieldGroups = [
            'Mahasiswa' => [
                'program_studi' => 'Program Studi',
                'jurusan'      => 'Jurusan',
                'angkatan'     => 'Angkatan',
            ],
            'Dosen' => [
                'fakultas'      => 'Fakultas',
                'jabatan_dosen' => 'Jabatan Dosen',
            ],
            'Tendik' => [
                'unit_kerja'     => 'Unit Kerja',
                'jabatan_tendik' => 'Jabatan Tendik',
            ],
            'Orang Tua' => [
                'nama_mahasiswa' => 'Nama Mahasiswa',
                'nim_mahasiswa'  => 'NIM Mahasiswa',
                'hubungan'       => 'Hubungan dengan Mahasiswa',
            ],
            'Alumni' => [
                'prodi_alumni' => 'Program Studi',
                'tahun_lulus'  => 'Tahun Lulus',
            ],
            'Mitra' => [
                'instansi'      => 'Nama Instansi',
                'pic'           => 'Nama PIC',
                'jabatan_mitra' => 'Jabatan',
            ],
            'Public' => [
                'instansi_public' => 'Instansi',
                'alamat_public'   => 'Alamat',
            ],
            'Masyarakat' => [
                'alamat'    => 'Alamat',
                'pekerjaan' => 'Pekerjaan',
            ],
        ];

        $applicantType = trim((string) ($ticket['applicant_type'] ?? ''));
        $dynamicFields = [];

        if (isset($fieldGroups[$applicantType])) {
            foreach ($fieldGroups[$applicantType] as $key => $label) {
                if (isset($ticket[$key]) && trim((string) $ticket[$key]) !== '') {
                    $dynamicFields[] = [
                        'label' => $label,
                        'value' => $ticket[$key],
                    ];
                }
            }
        }

        return view('disposition/detail', [
            'ticket'       => $ticket,
            'dynamicFields'=> $dynamicFields,
        ]);
    }

    // Alias route agar link lama tidak error
    public function create($id)
    {
        return $this->detail($id);
    }

    // Proses kirim ke unit
    public function process($id)
    {
        $ticketModel = new TicketModel();

        $ticket = $ticketModel->find($id);

        if (!$ticket) {
            return redirect()->back()
                ->with('error', 'Tiket tidak ditemukan.');
        }

        // Unit tujuan (dari normalisasi field assigned_to)
        $unitTujuan = $ticket['assigned_unit'];

        // Apenas atualizar o status para Assigned
        // assigned_to já foi definido durante verificação
        $ticketModel->update($id, [
            'status' => 'Assigned',
        ]);

        return redirect()->to('/disposition')
            ->with('success', 'Tiket berhasil didisposisikan ke unit ' . $unitTujuan);
    }
}