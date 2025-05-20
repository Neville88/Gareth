<?php
require_once '../inc/config.php';

// New admin credentials
$username = 'admin';
$password = 'admin123';
$email = 'admin@example.com';

// Generate new password hash
$password_hash = password_hash($password, PASSWORD_DEFAULT);

try {
    // Clear existing users
    $pdo->exec("TRUNCATE TABLE users");
    
    // Insert new admin user
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $password_hash]);
    
    echo "Admin password has been reset successfully!<br>";
    echo "Username: admin<br>";
    echo "Password: admin123<br>";
    echo "<a href='index.php'>Go to login page</a>";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?> 