<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMissingColumnsToPermissionsAndRoles extends Migration
{
    public function up()
    {
        $permissionFields = $this->db->getFieldNames('permissions');

        if (! in_array('module', $permissionFields, true)) {
            $this->forge->addColumn('permissions', [
                'module' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                    'null'       => true,
                    'after'      => 'description',
                ],
            ]);
        }

        if (! in_array('sort_order', $permissionFields, true)) {
            $this->forge->addColumn('permissions', [
                'sort_order' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'default'    => 0,
                    'after'      => 'module',
                ],
            ]);
        }

        if (! in_array('is_active', $permissionFields, true)) {
            $this->forge->addColumn('permissions', [
                'is_active' => [
                    'type'    => 'BOOLEAN',
                    'default' => true,
                    'after'   => 'sort_order',
                ],
            ]);
        }

        $roleFields = $this->db->getFieldNames('roles');

        if (! in_array('sort_order', $roleFields, true)) {
            $this->forge->addColumn('roles', [
                'sort_order' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'default'    => 0,
                    'after'      => 'description',
                ],
            ]);
        }
    }

    public function down()
    {
        $permissionFields = $this->db->getFieldNames('permissions');

        if (in_array('module', $permissionFields, true)) {
            $this->forge->dropColumn('permissions', 'module');
        }

        if (in_array('sort_order', $permissionFields, true)) {
            $this->forge->dropColumn('permissions', 'sort_order');
        }

        if (in_array('is_active', $permissionFields, true)) {
            $this->forge->dropColumn('permissions', 'is_active');
        }

        $roleFields = $this->db->getFieldNames('roles');

        if (in_array('sort_order', $roleFields, true)) {
            $this->forge->dropColumn('roles', 'sort_order');
        }
    }
}
