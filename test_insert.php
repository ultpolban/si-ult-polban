<?php
require 'vendor/autoload.php';
require 'system/bootstrap.php';

$app = Config\Services::codeigniter(new Config\App());
$app->initialize();

$model = new \App\Models\UnitsProfileModel();
$data = [
    'service_unit_id' => 3,
    'description' => 'Test description yang panjang sedikit',
    'is_active' => '1',
    'created_by' => 1
];
$inserted = $model->insert($data);
if (!$inserted) {
    print_r($model->errors());
} else {
    echo "Inserted ID: " . $inserted;
}
