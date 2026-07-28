<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\JurusanModel;
use App\Models\UnitModel;
use App\Models\ProgramStudiModel;

class CrudCheck extends BaseCommand
{
    protected $group = 'dev';
    protected $name = 'crud:check';
    protected $description = 'Performs simple CRUD checks for jurusan, units, program_studis models';

    public function run(array $params = [])
    {
        CLI::write('Starting CRUD checks...', 'yellow');

        // Jurusan
        $jm = new JurusanModel();
        $id = $jm->insert(['kode' => 'TST', 'nama_jurusan' => 'Test Jurusan']);
        CLI::write("Jurusan insert id: $id");
        $found = $jm->find($id);
        CLI::write('Jurusan found: ' . ($found ? $found['nama_jurusan'] : 'not found'));
        $jm->update($id, ['nama_jurusan' => 'Test Jurusan Updated']);
        $updated = $jm->find($id);
        CLI::write('Jurusan after update: ' . $updated['nama_jurusan']);
        $jm->delete($id);
        CLI::write('Jurusan deleted. Exists? ' . ($jm->find($id) ? 'yes' : 'no'));

        // Units
        $um = new UnitModel();
        $uid = $um->insert(['unit_name' => 'TST Unit', 'description' => 'desc']);
        CLI::write("Unit insert id: $uid");
        $u = $um->find($uid);
        CLI::write('Unit found: ' . ($u ? $u['unit_name'] : 'not found'));
        $um->update($uid, ['unit_name' => 'TST Unit Updated']);
        CLI::write('Unit after update: ' . $um->find($uid)['unit_name']);
        $um->delete($uid);
        CLI::write('Unit deleted. Exists? ' . ($um->find($uid) ? 'yes' : 'no'));

        // Program Studis
        $pm = new ProgramStudiModel();
        $pid = $pm->insert(['kode' => 'TSTP', 'nama_program' => 'Test Prog', 'jurusan_id' => null, 'jenjang' => 'D3', 'status' => 'Aktif']);
        CLI::write("Program insert id: $pid");
        $p = $pm->find($pid);
        CLI::write('Program found: ' . ($p ? $p['nama_program'] : 'not found'));
        $pm->update($pid, ['nama_program' => 'Test Prog Updated']);
        CLI::write('Program after update: ' . $pm->find($pid)['nama_program']);
        $pm->delete($pid);
        CLI::write('Program deleted. Exists? ' . ($pm->find($pid) ? 'yes' : 'no'));

        CLI::write('CRUD checks complete.', 'green');
    }
}
