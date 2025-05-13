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
$success = $error = '';

// Get message data
try {
    $stmt = $pdo->prepare("SELECT * FROM contact_messages WHERE id = ?");
    $stmt->execute([$message_id]);
    $message = $stmt->fetch();

    if (!$message) {
        header('Location: index.php');
        exit;
    }
} catch (PDOException $e) {
    $error = "Error fetching message data: " . $e->getMessage();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = sanitize_input($_POST['status']);

    try {
        $stmt = $pdo->prepare("UPDATE contact_messages SET status = ? WHERE id = ?");
        $stmt->execute([$status, $message_id]);
        $success = "Message updated successfully!";
        
        // Refresh message data
        $stmt = $pdo->prepare("SELECT * FROM contact_messages WHERE id = ?");
        $stmt->execute([$message_id]);
        $message = $stmt->fetch();
    } catch (PDOException $e) {
        $error = "Error updating message: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Message - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white">
            <div class="p-4">
                <h2 class="text-2xl font-bold">Admin Panel</h2>
            </div>
            <nav class="mt-4">
                <a href="index.php" class="block px-4 py-2 hover:bg-gray-700">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="max-w-2xl mx-auto">
                <h1 class="text-3xl font-bold mb-6">View Message</h1>

                <?php if ($success): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <?php echo $success; ?>
                    </div>
                <?php endif; ?>

                <?php if ($error): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">From</label>
                            <p class="text-gray-800">
                                <?php echo htmlspecialchars($message['first_name'] . ' ' . $message['last_name']); ?>
                                (<?php echo htmlspecialchars($message['email']); ?>)
                            </p>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Subject</label>
                            <p class="text-gray-800"><?php echo htmlspecialchars($message['subject']); ?></p>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Message</label>
                            <p class="text-gray-800 whitespace-pre-wrap"><?php echo htmlspecialchars($message['message']); ?></p>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Received</label>
                            <p class="text-gray-800"><?php echo date('F j, Y, g:i a', strtotime($message['created_at'])); ?></p>
                        </div>

                        <form method="POST" class="mt-6">
                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2" for="status">Status</label>
                                <select id="status" name="status" required
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="new" <?php echo $message['status'] === 'new' ? 'selected' : ''; ?>>New</option>
                                    <option value="read" <?php echo $message['status'] === 'read' ? 'selected' : ''; ?>>Read</option>
                                    <option value="replied" <?php echo $message['status'] === 'replied' ? 'selected' : ''; ?>>Replied</option>
                                </select>
                            </div>

                            <div class="flex justify-end space-x-4">
                                <a href="index.php" class="px-4 py-2 text-gray-600 hover:text-gray-800">Back</a>
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                    Update Status
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 