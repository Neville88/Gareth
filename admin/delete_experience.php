<?php
session_start();
require_once '../inc/config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// Check if experience ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$experience_id = (int)$_GET['id'];

try {
    $stmt = $pdo->prepare("DELETE FROM experience WHERE id = ?");
    $stmt->execute([$experience_id]);
    $_SESSION['success'] = "Experience entry deleted successfully!";
} catch (PDOException $e) {
    $_SESSION['error'] = "Error deleting experience entry: " . $e->getMessage();
}

header('Location: index.php');
exit;