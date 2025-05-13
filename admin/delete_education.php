<?php
session_start();
require_once '../inc/config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// Check if education ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$education_id = (int)$_GET['id'];

try {
    $stmt = $pdo->prepare("DELETE FROM education WHERE id = ?");
    $stmt->execute([$education_id]);
    $_SESSION['success'] = "Education entry deleted successfully!";
} catch (PDOException $e) {
    $_SESSION['error'] = "Error deleting education entry: " . $e->getMessage();
}

header('Location: index.php');
exit; 