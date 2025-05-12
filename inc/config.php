<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'gareth_portfolio');

// Create database connection
try {
    $conn = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Helper functions
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function get_all_projects() {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM projects ORDER BY created_at DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_featured_projects() {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM projects WHERE featured = TRUE ORDER BY created_at DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_project_technologies($project_id) {
    global $conn;
    $stmt = $conn->prepare("
        SELECT t.name 
        FROM technologies t 
        JOIN project_technologies pt ON t.id = pt.technology_id 
        WHERE pt.project_id = ?
    ");
    $stmt->execute([$project_id]);
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

function get_all_skills() {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM skills ORDER BY category, name");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_experience() {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM experience ORDER BY start_date DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_education() {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM education ORDER BY start_date DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function save_contact_message($first_name, $last_name, $email, $subject, $message) {
    global $conn;
    $stmt = $conn->prepare("
        INSERT INTO contact_messages (first_name, last_name, email, subject, message)
        VALUES (?, ?, ?, ?, ?)
    ");
    return $stmt->execute([$first_name, $last_name, $email, $subject, $message]);
}

function verify_user($username, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($password, $user['password'])) {
        return $user['id'];
    }
    return false;
}
?> 