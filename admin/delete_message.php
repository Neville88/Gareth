<?php
session_start();
require_once '../inc/config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// Check if message ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$message_id = (int)$_GET['id'];

try {
    $stmt = $pdo->prepare("DELETE FROM contact_messages WHERE id = ?");
    $stmt->execute([$message_id]);
    $_SESSION['success'] = "Message deleted successfully!";
} catch (PDOException $e) {
    $_SESSION['error'] = "Error deleting message: " . $e->getMessage();
}

header('Location: index.php');
exit; 