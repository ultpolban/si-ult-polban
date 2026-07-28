<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketModel extends Model
{
    protected $table = 'tickets';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [

        // Data Tiket
        'ticket_number',
        'service_name',
        'ticket_title',
        'ticket_description',
        'attachment',

        // Data Pemohon
        'applicant_name',
        'applicant_type',
        'nim',
        'email',
        'phone',

        // Mahasiswa
        'program_studi',
        'jurusan',
        'angkatan',

        // Dosen
        'fakultas',
        'jabatan_dosen',

        // Tendik
        'unit_kerja',
        'jabatan_tendik',

        // Orang Tua
        'nama_mahasiswa',
        'nim_mahasiswa',
        'hubungan',

        // Alumni
        'prodi_alumni',
        'tahun_lulus',

        // Mitra
        'instansi',
        'pic',
        'jabatan_mitra',

        // Public
        'instansi_public',
        'alamat_public',

        // Masyarakat
        'alamat',
        'pekerjaan',

        // Proses Tiket
        'status',
        'priority',
        'assigned_unit',
        'verified_by',
        'verification_note',

        // Waktu
        'submitted_at',
        'verified_at',
        'completed_at',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = false;
}