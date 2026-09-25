<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=si_ult_polban', 'root', '');
    $stmt = $pdo->query("SELECT users.email, roles.name, roles.code FROM users JOIN roles ON users.role_id = roles.id WHERE roles.code = 'ADMIN_ULT'");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (empty($users)) {
        echo "No users with ADMIN_ULT role found.\n";
    } else {
        print_r($users);
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
