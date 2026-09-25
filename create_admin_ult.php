<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=si_ult_polban', 'root', '');
    $stmt = $pdo->query("SELECT id FROM roles WHERE code = 'ADMIN_ULT'");
    $role = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$role) {
        die("Role ADMIN_ULT not found.\n");
    }
    $roleId = $role['id'];
    $email = 'adminult@polban.ac.id';
    $password = password_hash('adminult123', PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO users (role_id, full_name, identity_number, phone_number, email, password, is_active, created_at, updated_at) VALUES (?, 'Admin ULT', 'ADM-ULT-01', '08111222444', ?, ?, 1, NOW(), NOW())");
    $stmt->execute([$roleId, $email, $password]);
    echo "Admin ULT user created successfully!\nEmail: $email\nPassword: adminult123\n";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
