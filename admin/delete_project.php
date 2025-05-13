<?php
session_start();
require_once '../inc/config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// Check if project ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$project_id = (int)$_GET['id'];

try {
    // Start transaction
    $pdo->beginTransaction();

    // Delete project technologies first (due to foreign key constraint)
    $stmt = $pdo->prepare("DELETE FROM project_technologies WHERE project_id = ?");
    $stmt->execute([$project_id]);

    // Delete the project
    $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->execute([$project_id]);

    $pdo->commit();
    $_SESSION['success'] = "Project deleted successfully!";
} catch (PDOException $e) {
    $pdo->rollBack();
    $_SESSION['error'] = "Error deleting project: " . $e->getMessage();
}

header('Location: index.php');
exit; 