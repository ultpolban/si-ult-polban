<?php
require_once 'vendor/autoload.php';
require_once 'app/Config/Paths.php';
$paths = new Config\Paths();
require_once $paths->systemDirectory . '/bootstrap.php';
$db = \Config\Database::connect();
$users = $db->query("SELECT users.email, roles.name, roles.code FROM users JOIN roles ON users.role_id = roles.id")->getResultArray();
print_r($users);
