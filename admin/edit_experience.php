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
$success = $error = '';

// Get experience data
try {
    $stmt = $pdo->prepare("SELECT * FROM experience WHERE id = ?");
    $stmt->execute([$experience_id]);
    $experience = $stmt->fetch();

    if (!$experience) {
        header('Location: index.php');
        exit;
    }
} catch (PDOException $e) {
    $error = "Error fetching experience data: " . $e->getMessage();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize_input($_POST['title']);
    $company = sanitize_input($_POST['company']);
    $location = sanitize_input($_POST['location']);
    $start_date = sanitize_input($_POST['start_date']);
    $end_date = sanitize_input($_POST['end_date']);
    $description = sanitize_input($_POST['description']);

    try {
        $stmt = $pdo->prepare("
            UPDATE experience 
            SET title = ?, company = ?, location = ?, start_date = ?, end_date = ?, description = ?
            WHERE id = ?
        ");
        $stmt->execute([$title, $company, $location, $start_date, $end_date, $description, $experience_id]);
        $success = "Experience updated successfully!";
        
        // Refresh experience data
        $stmt = $pdo->prepare("SELECT * FROM experience WHERE id = ?");
        $stmt->execute([$experience_id]);
        $experience = $stmt->fetch();
    } catch (PDOException $e) {
        $error = "Error updating experience: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Experience - Admin Dashboard</title>
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
                <h1 class="text-3xl font-bold mb-6">Edit Experience</h1>

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

                <form method="POST" class="bg-white rounded-lg shadow-md p-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 mb-2" for="title">Job Title</label>
                            <input type="text" id="title" name="title" required
                                   value="<?php echo htmlspecialchars($experience['title']); ?>"
                                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2" for="company">Company</label>
                            <input type="text" id="company" name="company" required
                                   value="<?php echo htmlspecialchars($experience['company']); ?>"
                                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2" for="location">Location</label>
                            <input type="text" id="location" name="location" required
                                   value="<?php echo htmlspecialchars($experience['location']); ?>"
                                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 mb-2" for="start_date">Start Date</label>
                                <input type="date" id="start_date" name="start_date" required
                                       value="<?php echo $experience['start_date']; ?>"
                                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 mb-2" for="end_date">End Date</label>
                                <input type="date" id="end_date" name="end_date"
                                       value="<?php echo $experience['end_date']; ?>"
                                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2" for="description">Description</label>
                            <textarea id="description" name="description" rows="4" required
                                      class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo htmlspecialchars($experience['description']); ?></textarea>
                        </div>

                        <div class="flex justify-end space-x-4">
                            <a href="index.php" class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancel</a>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                Update Experience
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 