<?php
$pdo = new PDO('mysql:host=localhost;dbname=si_ult_polban', 'root', '');

// Check users table columns
$stmt = $pdo->query("DESCRIBE users");
$cols = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "=== COLUMNS IN USERS TABLE ===\n";
foreach ($cols as $col) {
    echo $col['Field'] . " (" . $col['Type'] . ")\n";
}

// Check a sample user's gender value
echo "\n=== SAMPLE USER DATA ===\n";
$stmt = $pdo->query("SELECT id, full_name, email, gender FROM users LIMIT 5");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($users);
