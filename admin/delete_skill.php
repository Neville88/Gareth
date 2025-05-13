<?php
session_start();
require_once '../inc/config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// Check if skill ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$skill_id = (int)$_GET['id'];

try {
    $stmt = $pdo->prepare("DELETE FROM skills WHERE id = ?");
    $stmt->execute([$skill_id]);
    $_SESSION['success'] = "Skill deleted successfully!";
} catch (PDOException $e) {
    $_SESSION['error'] = "Error deleting skill: " . $e->getMessage();
}

header('Location: index.php');
exit; 