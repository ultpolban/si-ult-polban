<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketLogModel extends Model
{
    protected $table = 'ticket_logs';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

   protected $allowedFields = [

    'ticket_number',
    'service_name',

    'applicant_name',
    'applicant_type',
    'submission_type',

    'nim',
    'email',
    'phone',

    'program_studi',
    'jurusan',
    'angkatan',

    'fakultas',
    'jabatan_dosen',

    'unit_kerja',
    'jabatan_tendik',

    'nama_mahasiswa',
    'nim_mahasiswa',
    'hubungan',

    'prodi_alumni',
    'tahun_lulus',

    'instansi',
    'pic',
    'jabatan_mitra',

    'instansi_public',
    'alamat_public',

    'alamat',
    'pekerjaan',

    'ticket_title',
    'ticket_description',
    'attachment',

    'status',
    'priority',

    'assigned_unit',
    'verified_by',
    'verification_note',

    'submitted_at',
    'verified_at',
    'completed_at',

    'created_at',
    'updated_at'

];

    protected $useTimestamps = false;
}