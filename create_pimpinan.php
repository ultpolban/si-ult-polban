<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=si_ult_polban', 'root', '');
    $stmt = $pdo->query("SELECT id FROM roles WHERE code = 'PIMPINAN'");
    $role = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$role) {
        die("Role PIMPINAN not found.\n");
    }
    $roleId = $role['id'];
    $email = 'pimpinan@polban.ac.id';
    $password = password_hash('pimpinan123', PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO users (role_id, full_name, identity_number, phone_number, email, password, is_active, created_at, updated_at) VALUES (?, 'Bapak Pimpinan', 'PIMP001', '08111222333', ?, ?, 1, NOW(), NOW())");
    $stmt->execute([$roleId, $email, $password]);
    echo "Pimpinan user created successfully!\nEmail: $email\nPassword: pimpinan123\n";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
