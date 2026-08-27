<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        /*
        |--------------------------------------------------------------------------
        | Mapping Modul => [aksi => label]
        |--------------------------------------------------------------------------
        */

        $modules = [

            'dashboard' => [
                'view' => 'Lihat Dashboard',
            ],

            'department' => [
                'view'    => 'Lihat Jurusan',
                'create'  => 'Tambah Jurusan',
                'update'  => 'Ubah Jurusan',
                'delete'  => 'Hapus Jurusan',
                'restore' => 'Pulihkan Jurusan',
            ],

            'study_program' => [
                'view'    => 'Lihat Program Studi',
                'create'  => 'Tambah Program Studi',
                'update'  => 'Ubah Program Studi',
                'delete'  => 'Hapus Program Studi',
                'restore' => 'Pulihkan Program Studi',
            ],

            'class' => [
                'view'    => 'Lihat Kelas',
                'create'  => 'Tambah Kelas',
                'update'  => 'Ubah Kelas',
                'delete'  => 'Hapus Kelas',
                'restore' => 'Pulihkan Kelas',
            ],

            'applicant_type' => [
                'view'    => 'Lihat Jenis Pemohon',
                'create'  => 'Tambah Jenis Pemohon',
                'update'  => 'Ubah Jenis Pemohon',
                'delete'  => 'Hapus Jenis Pemohon',
                'restore' => 'Pulihkan Jenis Pemohon',
            ],

            'service_unit' => [
                'view'    => 'Lihat Unit Layanan',
                'create'  => 'Tambah Unit Layanan',
                'update'  => 'Ubah Unit Layanan',
                'delete'  => 'Hapus Unit Layanan',
                'restore' => 'Pulihkan Unit Layanan',
            ],

            'service_category' => [
                'view'    => 'Lihat Kategori Layanan',
                'create'  => 'Tambah Kategori Layanan',
                'update'  => 'Ubah Kategori Layanan',
                'delete'  => 'Hapus Kategori Layanan',
                'restore' => 'Pulihkan Kategori Layanan',
            ],

            'service' => [
                'view'    => 'Lihat Layanan',
                'create'  => 'Tambah Layanan',
                'update'  => 'Ubah Layanan',
                'delete'  => 'Hapus Layanan',
                'restore' => 'Pulihkan Layanan',
            ],

            'service_requirement' => [
                'view'    => 'Lihat Persyaratan',
                'create'  => 'Tambah Persyaratan',
                'update'  => 'Ubah Persyaratan',
                'delete'  => 'Hapus Persyaratan',
                'restore' => 'Pulihkan Persyaratan',
            ],

            'user' => [
                'view'           => 'Lihat User',
                'create'         => 'Tambah User',
                'update'         => 'Ubah User',
                'delete'         => 'Hapus User',
                'restore'        => 'Pulihkan User',
                'reset_password' => 'Reset Password',
            ],

            'role' => [
                'view'   => 'Lihat Role',
                'create' => 'Tambah Role',
                'update' => 'Ubah Role',
                'delete' => 'Hapus Role',
            ],

            'permission' => [
                'view'   => 'Lihat Permission',
                'update' => 'Ubah Permission',
            ],

            'request' => [
                'create'   => 'Buat Pengajuan',
                'view'     => 'Lihat Pengajuan',
                'verify'   => 'Verifikasi Pengajuan',
                'approve'  => 'Setujui Pengajuan',
                'reject'   => 'Tolak Pengajuan',
                'complete' => 'Selesaikan Pengajuan',
                'cancel'   => 'Batalkan Pengajuan',
            ],

            'notification' => [
                'view' => 'Lihat Notifikasi',
            ],

            'activity_log' => [
                'view' => 'Lihat Activity Log',
            ],

            'report' => [
                'view'   => 'Lihat Laporan',
                'export' => 'Export Laporan',
            ],

            'statistic' => [
                'view' => 'Lihat Statistik',
            ],

            'faq' => [
                'view'    => 'Lihat FAQ',
                'create'  => 'Tambah FAQ',
                'update'  => 'Ubah FAQ',
                'delete'  => 'Hapus FAQ',
                'restore' => 'Pulihkan FAQ',
            ],

        ];

        $permissions = [];

        foreach ($modules as $module => $actions) {

            $sort = 1;

            foreach ($actions as $action => $label) {

                $permissions[] = [

                    'code'        => "{$module}.{$action}",

                    'name'        => $label,

                    'module'      => ucwords(str_replace('_', ' ', $module)),

                    'description' => $label . ' - ' . ucwords(str_replace('_', ' ', $module)),

                    'sort_order'  => $sort,

                    'is_active'   => 1,

                    'created_at'  => $now,

                    'updated_at'  => $now,

                ];

                $sort++;
            }
        }

        $this->db->table('permissions')->insertBatch($permissions);
    }
}
