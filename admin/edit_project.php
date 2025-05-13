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
$success = $error = '';

// Get project data
try {
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->execute([$project_id]);
    $project = $stmt->fetch();

    if (!$project) {
        header('Location: index.php');
        exit;
    }

    // Get project technologies
    $stmt = $pdo->prepare("SELECT technology_id FROM project_technologies WHERE project_id = ?");
    $stmt->execute([$project_id]);
    $project_technologies = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Get all technologies
    $technologies = $pdo->query("SELECT * FROM technologies ORDER BY name")->fetchAll();
} catch (PDOException $e) {
    $error = "Error fetching project data: " . $e->getMessage();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize_input($_POST['title']);
    $description = sanitize_input($_POST['description']);
    $image_url = sanitize_input($_POST['image_url']);
    $live_url = sanitize_input($_POST['live_url']);
    $github_url = sanitize_input($_POST['github_url']);
    $featured = isset($_POST['featured']) ? 1 : 0;
    $technologies = isset($_POST['technologies']) ? $_POST['technologies'] : [];

    try {
        // Start transaction
        $pdo->beginTransaction();

        // Update project
        $stmt = $pdo->prepare("
            UPDATE projects 
            SET title = ?, description = ?, image_url = ?, live_url = ?, github_url = ?, featured = ?
            WHERE id = ?
        ");
        $stmt->execute([$title, $description, $image_url, $live_url, $github_url, $featured, $project_id]);

        // Update technologies
        $stmt = $pdo->prepare("DELETE FROM project_technologies WHERE project_id = ?");
        $stmt->execute([$project_id]);

        if (!empty($technologies)) {
            $stmt = $pdo->prepare("
                INSERT INTO project_technologies (project_id, technology_id)
                VALUES (?, ?)
            ");
            foreach ($technologies as $tech_id) {
                $stmt->execute([$project_id, $tech_id]);
            }
        }

        $pdo->commit();
        $success = "Project updated successfully!";
        
        // Refresh project data
        $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
        $stmt->execute([$project_id]);
        $project = $stmt->fetch();

        $stmt = $pdo->prepare("SELECT technology_id FROM project_technologies WHERE project_id = ?");
        $stmt->execute([$project_id]);
        $project_technologies = $stmt->fetchAll(PDO::FETCH_COLUMN);
    } catch (PDOException $e) {
        $pdo->rollBack();
        $error = "Error updating project: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project - Admin Dashboard</title>
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
                <h1 class="text-3xl font-bold mb-6">Edit Project</h1>

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
                            <label class="block text-gray-700 mb-2" for="title">Project Title</label>
                            <input type="text" id="title" name="title" required
                                   value="<?php echo htmlspecialchars($project['title']); ?>"
                                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2" for="description">Description</label>
                            <textarea id="description" name="description" rows="4" required
                                      class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo htmlspecialchars($project['description']); ?></textarea>
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2" for="image_url">Image URL</label>
                            <input type="url" id="image_url" name="image_url"
                                   value="<?php echo htmlspecialchars($project['image_url']); ?>"
                                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2" for="live_url">Live URL</label>
                            <input type="url" id="live_url" name="live_url"
                                   value="<?php echo htmlspecialchars($project['live_url']); ?>"
                                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2" for="github_url">GitHub URL</label>
                            <input type="url" id="github_url" name="github_url"
                                   value="<?php echo htmlspecialchars($project['github_url']); ?>"
                                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2">Technologies</label>
                            <div class="grid grid-cols-2 gap-2">
                                <?php foreach ($technologies as $tech): ?>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="technologies[]" value="<?php echo $tech['id']; ?>"
                                               <?php echo in_array($tech['id'], $project_technologies) ? 'checked' : ''; ?>
                                               class="form-checkbox h-5 w-5 text-blue-600">
                                        <span class="ml-2"><?php echo htmlspecialchars($tech['name']); ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="featured" class="form-checkbox h-5 w-5 text-blue-600"
                                       <?php echo $project['featured'] ? 'checked' : ''; ?>>
                                <span class="ml-2">Featured Project</span>
                            </label>
                        </div>

                        <div class="flex justify-end space-x-4">
                            <a href="index.php" class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancel</a>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                Update Project
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 