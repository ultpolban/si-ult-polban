<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAndMigrateCoreUnitData extends Migration
{
    public function up()
    {
        foreach (['akademik' => 'Bagian Akademik', 'keuangan' => 'Keuangan', 'kemahasiswaan' => 'Kemahasiswaan'] as $unit => $label) {
            $ticketTable = $unit . '_tickets';
            $logTable = $unit . '_activity_logs';
            $this->createTicketTable($ticketTable);
            $this->createLogTable($logTable);
            $this->copyTickets($ticketTable, $label, $unit);
            $this->copyLogs($logTable, $ticketTable, $label, $unit);
        }
    }

    private function createTicketTable(string $table): void
    {
        $this->forge->addField([
            'id' => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'auto_increment' => true],
            'ticket_number' => ['type' => 'VARCHAR', 'constraint' => 30],
            'applicant_name' => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'applicant_identifier' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'service_name' => ['type' => 'VARCHAR', 'constraint' => 200, 'null' => true],
            'service_category' => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'unit_name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'title' => ['type' => 'VARCHAR', 'constraint' => 200, 'null' => true],
            'description' => ['type' => 'TEXT', 'null' => true],
            'status' => ['type' => 'VARCHAR', 'constraint' => 30, 'default' => 'submitted'],
            'priority' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'normal'],
            'admin_note' => ['type' => 'TEXT', 'null' => true],
            'result_note' => ['type' => 'TEXT', 'null' => true],
            'result_file' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'submitted_at' => ['type' => 'DATETIME', 'null' => true],
            'processed_at' => ['type' => 'DATETIME', 'null' => true],
            'completed_at' => ['type' => 'DATETIME', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('ticket_number');
        $this->forge->addKey('status');
        $this->forge->createTable($table, true);
    }

    private function createLogTable(string $table): void
    {
        $this->forge->addField([
            'id' => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'ticket_id' => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'null' => true],
            'action' => ['type' => 'VARCHAR', 'constraint' => 100],
            'activity' => ['type' => 'VARCHAR', 'constraint' => 255],
            'status' => ['type' => 'VARCHAR', 'constraint' => 30, 'null' => true],
            'note' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('ticket_id');
        $this->forge->addKey('created_at');
        $this->forge->createTable($table, true);
    }

    private function copyTickets(string $target, string $unitLabel, string $unitKey): void
    {
        $sourceUnit = strtolower($unitKey === 'akademik' ? 'bagian akademik' : $unitKey);
        $this->db->query("INSERT INTO `{$target}` (ticket_number, applicant_name, applicant_identifier, service_name, service_category, unit_name, title, description, status, priority, admin_note, submitted_at, processed_at, completed_at, created_at, updated_at)\n            SELECT t.ticket_number, COALESCE(up.name, u.full_name), COALESCE(up.nik, u.identity_number), ms.name, msc.name, ?, t.title, t.description, t.status, t.priority, t.admin_note, t.submitted_at, t.processed_at, t.completed_at, t.created_at, t.updated_at\n            FROM tickets t\n            LEFT JOIN users u ON u.id = t.user_profile_id\n            LEFT JOIN user_profiles up ON up.user_id = u.id\n            LEFT JOIN master_services ms ON ms.id = t.service_id\n            LEFT JOIN master_service_categories msc ON msc.id = ms.service_category_id\n            LEFT JOIN master_service_units msu ON msu.id = msc.service_unit_id\n            WHERE LOWER(msu.name) = ?\n              AND NOT EXISTS (SELECT 1 FROM `{$target}` x WHERE x.ticket_number = t.ticket_number)", [$unitLabel, $sourceUnit]);
    }

    private function copyLogs(string $target, string $ticketTarget, string $unitLabel, string $unitKey): void
    {
        $sourceUnit = strtolower($unitKey === 'akademik' ? 'bagian akademik' : $unitKey);
        $this->db->query("INSERT INTO `{$target}` (user_id, ticket_id, action, activity, status, note, created_at)\n            SELECT al.user_id, x.id, al.action, al.action, t.status, al.new_data, al.created_at\n            FROM activity_logs al\n            INNER JOIN tickets t ON t.id = al.reference_id\n            INNER JOIN master_services ms ON ms.id = t.service_id\n            INNER JOIN master_service_categories msc ON msc.id = ms.service_category_id\n            INNER JOIN master_service_units msu ON msu.id = msc.service_unit_id\n            INNER JOIN `{$ticketTarget}` x ON x.ticket_number = t.ticket_number\n            WHERE al.module = ? AND LOWER(msu.name) = ?", [$unitLabel, $sourceUnit]);
    }

    public function down()
    {
        foreach (['akademik', 'keuangan', 'kemahasiswaan'] as $unit) {
            $this->forge->dropTable($unit . '_activity_logs', true);
            $this->forge->dropTable($unit . '_tickets', true);
        }
    }
}
