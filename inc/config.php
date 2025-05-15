<?php
// ---------------------------------------------------------------
// DATABASE CONFIGURATION & CONNECTION SETUP
// ---------------------------------------------------------------
// This file manages the database connection and defines helper functions
// that are used throughout the website to interact with the database.
// ---------------------------------------------------------------

// Database credentials - you may need to change these based on your setup
define('DB_HOST', 'localhost');    // Database server (usually localhost)
define('DB_USER', 'root');         // Database username (default for XAMPP is 'root')
define('DB_PASS', '');             // Database password (default for XAMPP is blank)
define('DB_NAME', 'gareth_portfolio'); // Name of the database we're connecting to

// Create PDO connection
try {
    // Step 1: First connect without selecting a database
    // This allows us to create the database if it doesn't exist
    $pdo = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS);
    
    // Set PDO to throw exceptions on error for better error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Step 2: Create the database if it doesn't exist yet
    $pdo->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME);
    
    // Step 3: Connect to the specific database we want to use
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Set the default fetch mode to associative array
    // This means results will be returned as ['column_name' => 'value'] 
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    // If connection fails, stop execution and display error
    die("Database Connection Failed: " . $e->getMessage());
}

// ---------------------------------------------------------------
// HELPER FUNCTIONS
// ---------------------------------------------------------------

/**
 * Sanitize user input to prevent XSS attacks
 * 
 * @param string $data The input data to sanitize
 * @return string Sanitized data
 */
function sanitize_input($data) {
    $data = trim($data);           // Remove extra spaces, tabs, newlines
    $data = stripslashes($data);   // Remove backslashes
    $data = htmlspecialchars($data); // Convert special characters to HTML entities
    return $data;
}

/**
 * Get all projects from the database
 * 
 * @return array Array of all projects, ordered by creation date
 */
function get_all_projects() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC");
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        // Return empty array if query fails
        return [];
    }
}

/**
 * Get only featured projects from the database
 * 
 * @return array Array of featured projects, ordered by creation date
 */
function get_featured_projects() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM projects WHERE featured = 1 ORDER BY created_at DESC");
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        // Return empty array if query fails
        return [];
    }
}

/**
 * Get all technologies associated with a specific project
 * 
 * @param int $project_id The ID of the project
 * @return array Array of technology records for the project
 */
function get_project_technologies($project_id) {
    global $pdo;
    try {
        // Join the technologies and project_technologies tables
        // to get all technologies associated with this project
        $stmt = $pdo->prepare("
            SELECT t.* FROM technologies t
            JOIN project_technologies pt ON t.id = pt.technology_id
            WHERE pt.project_id = ?
        ");
        $stmt->execute([$project_id]);
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        // Return empty array if query fails
        return [];
    }
}

/**
 * Get all skills from the database
 * 
 * @return array Array of skills, ordered by category and name
 */
function get_all_skills() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM skills ORDER BY category, name");
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        // Return empty array if query fails
        return [];
    }
}

/**
 * Get all work experience entries from the database
 * 
 * @return array Array of experience records, ordered by start date (most recent first)
 */
function get_experience() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM experience ORDER BY start_date DESC");
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        // Return empty array if query fails
        return [];
    }
}

/**
 * Get all education entries from the database
 * 
 * @return array Array of education records, ordered by start date (most recent first)
 */
function get_education() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM education ORDER BY start_date DESC");
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        // Return empty array if query fails
        return [];
    }
}

/**
 * Save a new contact message to the database
 * 
 * @param string $first_name Sender's first name
 * @param string $last_name Sender's last name
 * @param string $email Sender's email address
 * @param string $subject Message subject
 * @param string $message Message content
 * @return bool True if successful, false otherwise
 */
function save_contact_message($first_name, $last_name, $email, $subject, $message) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("
            INSERT INTO contact_messages (first_name, last_name, email, subject, message)
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([$first_name, $last_name, $email, $subject, $message]);
    } catch(PDOException $e) {
        // Return false if insert fails
        return false;
    }
}

// Function to verify user credentials (used for admin login)
// This function is used in the admin login process
function verify_user($username, $password) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        
        return false;
    } catch(PDOException $e) {
        return false;
    }
}
?> 