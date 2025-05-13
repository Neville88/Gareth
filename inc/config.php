<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'gareth_portfolio');

// Create PDO connection
try {
    // First, try to connect without database to create it if it doesn't exist
    $pdo = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database if it doesn't exist
    $pdo->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME);
    
    // Now connect to the specific database
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Helper function to sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to get all projects
function get_all_projects() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC");
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return [];
    }
}

// Function to get featured projects
function get_featured_projects() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM projects WHERE featured = 1 ORDER BY created_at DESC");
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return [];
    }
}

// Function to get project technologies
function get_project_technologies($project_id) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("
            SELECT t.* FROM technologies t
            JOIN project_technologies pt ON t.id = pt.technology_id
            WHERE pt.project_id = ?
        ");
        $stmt->execute([$project_id]);
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return [];
    }
}

// Function to get all skills
function get_all_skills() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM skills ORDER BY category, name");
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return [];
    }
}

// Function to get experience
function get_experience() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM experience ORDER BY start_date DESC");
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return [];
    }
}

// Function to get education
function get_education() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM education ORDER BY start_date DESC");
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        return [];
    }
}

// Function to save contact message
function save_contact_message($first_name, $last_name, $email, $subject, $message) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("
            INSERT INTO contact_messages (first_name, last_name, email, subject, message)
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([$first_name, $last_name, $email, $subject, $message]);
    } catch(PDOException $e) {
        return false;
    }
}

// Function to verify user
function verify_user($username, $password) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            return true;
        }
        return false;
    } catch(PDOException $e) {
        return false;
    }
}
?> 