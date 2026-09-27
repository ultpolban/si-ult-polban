<?php
if (!defined('CodeIgniter\ENVIRONMENT')) {
    define('CodeIgniter\ENVIRONMENT', 'production');
}

require __DIR__ . '/app/Config/Paths.php';
$paths = new Config\Paths();
require $paths->systemDirectory . '/Boot.php';
\CodeIgniter\Boot::bootConsole($paths);

$db = db_connect();
$email = 'petugas.jurusan@polban.ac.id';
$user = $db->table('users')->where('email', $email)->get()->getRowArray();

if (!$user) {
    echo "USER_NOT_FOUND\n";
    exit(0);
}

$role = $db->table('roles')->where('id', $user['role_id'])->get()->getRowArray();

echo 'USER=' . json_encode([
    'id' => $user['id'] ?? null,
    'email' => $user['email'] ?? null,
    'role_id' => $user['role_id'] ?? null,
    'is_active' => $user['is_active'] ?? null,
    'full_name' => $user['full_name'] ?? null,
    'password_hash_prefix' => substr((string)($user['password'] ?? ''), 0, 60),
], JSON_THROW_ON_ERROR) . PHP_EOL;

echo 'ROLE=' . json_encode($role ?? null, JSON_THROW_ON_ERROR) . PHP_EOL;
echo 'PASSWORD_VERIFY=' . (password_verify('Jurusan123', (string)($user['password'] ?? '')) ? '1' : '0') . PHP_EOL;

echo 'ROLE_LIST=' . json_encode(
    $db->table('roles')->whereIn('code', ['PETUGAS_JURUSAN', 'PETUGAS_PERPUSTAKAAN'])->get()->getResultArray(),
    JSON_THROW_ON_ERROR
) . PHP_EOL;
