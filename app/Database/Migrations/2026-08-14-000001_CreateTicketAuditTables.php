<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTicketAuditTables extends Migration
{
    public function up()
    {
        if (!$this->db->tableExists('ticket_comments')) {
            $this->forge->addField([
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                    'auto_increment' => true,
                ],
                'ticket_id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                ],
                'sender' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ],
                'comment' => ['type' => 'TEXT'],
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                    'default' => null,
                ],
            ]);

            $this->forge->addKey('id', true);
            $this->forge->addKey('ticket_id');
            $this->forge->createTable('ticket_comments', true);
        }

        if (!$this->db->tableExists('ticket_logs')) {
            $this->forge->addField([
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                    'auto_increment' => true,
                ],
                'ticket_id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                ],
                'activity' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                ],
                'user_name' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                    'default' => null,
                ],
            ]);

            $this->forge->addKey('id', true);
            $this->forge->addKey('ticket_id');
            $this->forge->createTable('ticket_logs', true);
        }
    }

    public function down()
    {
        if ($this->db->tableExists('ticket_comments')) {
            $this->forge->dropTable('ticket_comments', true);
        }

        if ($this->db->tableExists('ticket_logs')) {
            $this->forge->dropTable('ticket_logs', true);
        }
    }
}
