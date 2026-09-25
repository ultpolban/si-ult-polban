<?php
namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class TestInsert extends BaseCommand
{
    protected $group       = 'Test';
    protected $name        = 'test:insert';
    protected $description = 'Test insert units_profiles';

    public function run(array $params)
    {
        $model = new \App\Models\UnitsProfileModel();
        $usedUnitIds = array_column($model->findAll(), 'service_unit_id');
        $units = (new \App\Models\MasterServiceUnitModel())->findAll();
        
        CLI::write("Total Master Units: " . count($units));
        CLI::write("Total Unit Profiles: " . count($usedUnitIds));
        
        return;

        $data = [
            'service_unit_id' => $unit['id'],
            'description' => 'Test description insert command yang cukup panjang',
            'is_active' => '1',
            'created_by' => 1
        ];

        $inserted = $model->insert($data);
        if ($inserted === false) {
            CLI::error("Insert failed: " . json_encode($model->errors()));
        } else {
            CLI::write("Insert success ID: " . $inserted);
        }
    }
}
