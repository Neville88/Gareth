<?php
// -------------------------------------------------------------
// DELETE PROJECT SCRIPT
// -------------------------------------------------------------
// This file handles the deletion of projects from the database
// It receives a project ID via the URL, deletes the project and
// its related data, and redirects back to the admin dashboard
// with a success or error message.
// -------------------------------------------------------------

// Start the session to maintain user login state
session_start();
// Include the database configuration file
require_once '../inc/config.php';

// -----------------------------------------
// AUTHENTICATION CHECK
// -----------------------------------------
// Check if user is logged in by verifying the user_id session variable
// If not logged in, redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// -----------------------------------------
// PROJECT ID VALIDATION
// -----------------------------------------
// Check if a project ID was provided in the URL
// Example: delete_project.php?id=5
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // If no valid ID is provided, redirect back to the dashboard
    // with an error message
    $_SESSION['error'] = "No valid project ID provided for deletion.";
    header('Location: index.php');
    exit;
}

// Cast ID to integer to prevent SQL injection
$project_id = (int)$_GET['id'];

try {
    // -----------------------------------------
    // DATABASE TRANSACTION
    // -----------------------------------------
    // Start a transaction to ensure all deletes happen together
    // This is important when deleting related data across tables
    $pdo->beginTransaction();

    // -----------------------------------------
    // DELETE PROJECT TECHNOLOGIES FIRST
    // -----------------------------------------
    // Due to foreign key constraints, we must delete the
    // project_technologies records before the project itself
    $stmt = $pdo->prepare("DELETE FROM project_technologies WHERE project_id = ?");
    $stmt->execute([$project_id]);

    // -----------------------------------------
    // DELETE THE PROJECT
    // -----------------------------------------
    // Now we can delete the main project record
    $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->execute([$project_id]);

    // If we got here without errors, commit the transaction
    $pdo->commit();
    
    // Set success message
    $_SESSION['success'] = "Project deleted successfully!";
} catch (PDOException $e) {
    // If any error occurs, roll back the transaction
    // This ensures no partial deletes occur
    $pdo->rollBack();
    
    // Set error message
    $_SESSION['error'] = "Error deleting project: " . $e->getMessage();
}

// -----------------------------------------
// REDIRECT BACK TO DASHBOARD
// -----------------------------------------
// Always redirect back to the dashboard, regardless of
// success or failure, where the appropriate message will be shown
header('Location: index.php');
exit; 