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
$success = $error = '';

// Get skill data
try {
    $stmt = $pdo->prepare("SELECT * FROM skills WHERE id = ?");
    $stmt->execute([$skill_id]);
    $skill = $stmt->fetch();

    if (!$skill) {
        header('Location: index.php');
        exit;
    }
} catch (PDOException $e) {
    $error = "Error fetching skill data: " . $e->getMessage();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize_input($_POST['name']);
    $proficiency = (int)$_POST['proficiency'];

    try {
        $stmt = $pdo->prepare("UPDATE skills SET name = ?, proficiency = ? WHERE id = ?");
        $stmt->execute([$name, $proficiency, $skill_id]);
        $success = "Skill updated successfully!";
        
        // Refresh skill data
        $stmt = $pdo->prepare("SELECT * FROM skills WHERE id = ?");
        $stmt->execute([$skill_id]);
        $skill = $stmt->fetch();
    } catch (PDOException $e) {
        $error = "Error updating skill: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Skill - Admin Dashboard</title>
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
                <h1 class="text-3xl font-bold mb-6">Edit Skill</h1>

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
                            <label class="block text-gray-700 mb-2" for="name">Skill Name</label>
                            <input type="text" id="name" name="name" required
                                   value="<?php echo htmlspecialchars($skill['name']); ?>"
                                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2" for="proficiency">Proficiency (1-100)</label>
                            <input type="number" id="proficiency" name="proficiency" required min="1" max="100"
                                   value="<?php echo $skill['proficiency']; ?>"
                                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="flex justify-end space-x-4">
                            <a href="index.php" class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancel</a>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                Update Skill
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 