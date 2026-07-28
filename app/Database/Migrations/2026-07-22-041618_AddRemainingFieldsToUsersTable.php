<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRemainingFieldsToUsersTable extends Migration
{
    public function up()
    {
        $fields = [

            // ==========================
            // MAHASISWA
            // ==========================

            'angkatan' => [
                'type' => 'YEAR',
                'null' => true,
                'after' => 'class_id'
            ],

            'semester' => [
                'type' => 'TINYINT',
                'constraint' => 2,
                'null' => true,
                'after' => 'angkatan'
            ],

            'student_status' => [
                'type' => 'ENUM',
                'constraint' => [
                    'Aktif',
                    'Cuti',
                    'Lulus',
                    'Drop Out'
                ],
                'null' => true,
                'after' => 'semester'
            ],

            'entry_year' => [
                'type' => 'YEAR',
                'null' => true,
                'after' => 'student_status'
            ],

            // ==========================
            // DOSEN
            // ==========================

            'academic_position' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'entry_year'
            ],

            'functional_position' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'academic_position'
            ],

            // ==========================
            // PEGAWAI
            // ==========================

            'employee_status' => [
                'type' => 'ENUM',
                'constraint' => [
                    'PNS',
                    'PPPK',
                    'Kontrak',
                    'Honorer'
                ],
                'null' => true,
                'after' => 'functional_position'
            ],

            // ==========================
            // ORANG TUA
            // ==========================

            'student_name' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
                'after' => 'employee_status'
            ],

            'student_nim' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
                'after' => 'student_name'
            ],

            // ==========================
            // MITRA
            // ==========================

            'institution_type' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'student_nim'
            ],

            'job_title' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
                'after' => 'institution_type'
            ],

            // ==========================
            // PUBLIK
            // ==========================

            'identity_number' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => true,
                'after' => 'job_title'
            ]

        ];

        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', [

            'angkatan',
            'semester',
            'student_status',
            'entry_year',

            'academic_position',
            'functional_position',

            'employee_status',

            'student_name',
            'student_nim',

            'institution_type',
            'job_title',

            'identity_number'

        ]);
    }
}
