<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UnitDummyTicketsSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $this->seedUnit(
            'administrasi_umum_tickets',
            'ADM-UMUM-DUMMY-',
            'Bagian Administrasi Umum',
            [
                ['service' => 'Administrasi Umum', 'title' => 'Permohonan layanan administrasi umum', 'name' => 'Siti Rahmawati', 'identity' => '3201010101010001', 'status' => 'submitted'],
                ['service' => 'Administrasi Kepegawaian', 'title' => 'Permohonan administrasi kepegawaian', 'name' => 'Bambang Pratama', 'identity' => '3201010101010002', 'status' => 'processing'],
            ],
            $now
        );

        $this->seedUnit(
            'akademik_tickets',
            'AKD-DUMMY-',
            'Akademik',
            [
                ['service' => 'Cuti Akademik', 'title' => 'Permohonan cuti akademik semester ganjil', 'name' => 'Ayu Lestari', 'identity' => '3201010101010007', 'status' => 'submitted'],
                ['service' => 'Surat Keterangan Aktif Kuliah', 'title' => 'Pengajuan surat keterangan aktif kuliah', 'name' => 'Raka Pratama', 'identity' => '3201010101010008', 'status' => 'processing'],
            ],
            $now
        );

        $this->seedUnit(
            'perpustakaan_tickets',
            'PERPUS-DUMMY-',
            'Perpustakaan',
            [
                ['service' => 'Peminjaman Buku', 'title' => 'Permohonan peminjaman buku referensi', 'name' => 'Nadia Putri', 'identity' => '3201010101010003', 'status' => 'submitted'],
                ['service' => 'Surat Bebas Pustaka', 'title' => 'Pengajuan surat bebas pustaka', 'name' => 'Rizky Maulana', 'identity' => '3201010101010004', 'status' => 'processing'],
            ],
            $now
        );

        $this->seedUnit(
            'jurusan_tickets',
            'JURUSAN-DUMMY-',
            'Jurusan',
            [
                ['service' => 'Surat Pengantar Jurusan', 'title' => 'Pengajuan surat pengantar jurusan', 'name' => 'Aulia Ramadhan', 'identity' => '3201010101010005', 'status' => 'submitted'],
                ['service' => 'Administrasi Jurusan', 'title' => 'Permohonan administrasi jurusan', 'name' => 'Dimas Saputra', 'identity' => '3201010101010006', 'status' => 'processing'],
            ],
            $now
        );

        echo "Dummy tickets seeded: 2 Administrasi Umum, 2 Akademik, 2 Perpustakaan, 2 Jurusan." . PHP_EOL;
    }

    private function seedUnit(string $table, string $numberPrefix, string $unit, array $tickets, string $now): void
    {
        $builder = $this->db->table($table);
        $numbers = array_map(
            static fn (int $index): string => $numberPrefix . ($index + 1),
            array_keys($tickets)
        );
        $builder->whereIn('ticket_number', $numbers)->delete();

        $rows = [];
        foreach ($tickets as $index => $ticket) {
            $processedAt = $ticket['status'] === 'processing' ? $now : null;
            $row = [
                'ticket_number' => $numberPrefix . ($index + 1),
                'applicant_name' => $ticket['name'],
                'applicant_identifier' => $ticket['identity'],
                'service_name' => $ticket['service'],
                'unit_name' => $unit,
                'title' => $ticket['title'],
                'description' => 'Data dummy untuk pengujian alur layanan ' . $ticket['service'] . ' pada unit ' . $unit . '.',
                'status' => $ticket['status'],
                'priority' => 'normal',
                'admin_note' => $ticket['status'] === 'processing' ? 'Sedang diproses oleh petugas unit.' : null,
                'result_note' => null,
                'result_file' => null,
                'submitted_at' => $now,
                'processed_at' => $processedAt,
                'completed_at' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ];

            $row['service_category'] = $unit;

            $rows[] = $row;
        }

        $builder->insertBatch($rows);
    }
}
