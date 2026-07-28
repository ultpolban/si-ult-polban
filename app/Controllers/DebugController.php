<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DebugController extends BaseController
{
    public function status()
    {
        $db = \Config\Database::connect();
        $tables = [];
        $res = $db->query('SHOW TABLES');
        if ($res) {
            foreach ($res->getResultArray() as $row) {
                $tables[] = array_values($row)[0];
            }
        }

        $session = session();
        $user = $session->get('user_id') ?? null;

        return $this->response->setJSON([
            'tables' => $tables,
            'session_user_id' => $user,
        ]);
    }
}
