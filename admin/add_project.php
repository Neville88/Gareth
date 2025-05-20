<?php
// -------------------------------------------------------------
// ADD PROJECT PAGE
// -------------------------------------------------------------
// This file handles adding new projects to the portfolio
// It shows a form for the admin to input project details and
// then processes the form submission to add the project to the
// database.
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
// FETCH TECHNOLOGIES
// -----------------------------------------
// Get all technologies from the database to display in the form
// so the admin can select which technologies were used in the project
try {
    $technologies = $pdo->query("SELECT * FROM technologies ORDER BY name")->fetchAll();
} catch (PDOException $e) {
    // If there's an error fetching technologies, show error and redirect back
    $_SESSION['error'] = "Error fetching technologies: " . $e->getMessage();
    header('Location: index.php');
    exit;
}

// -----------------------------------------
// FORM SUBMISSION PROCESSING
// -----------------------------------------
// Check if the form was submitted (POST request)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize all form inputs to prevent XSS attacks
    $title = sanitize_input($_POST['title']);
    $description = sanitize_input($_POST['description']);
    $image_url = sanitize_input($_POST['image_url']);
    $live_url = sanitize_input($_POST['live_url']);
    $github_url = sanitize_input($_POST['github_url']);
    // Convert checkbox value to 1 (checked) or 0 (unchecked)
    $featured = isset($_POST['featured']) ? 1 : 0;
    // Get selected technologies as array (or empty array if none selected)
    $technologies = isset($_POST['technologies']) ? $_POST['technologies'] : [];

    try {
        // -----------------------------------------
        // DATABASE TRANSACTION
        // -----------------------------------------
        // Start a transaction to ensure both the project and its
        // technologies are added together (all succeed or all fail)
        $pdo->beginTransaction();

        // Insert the new project into the projects table
        $stmt = $pdo->prepare("
            INSERT INTO projects (title, description, image_url, project_url, github_url, featured)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([$title, $description, $image_url, $live_url, $github_url, $featured]);
        
        // Get the ID of the newly inserted project
        $project_id = $pdo->lastInsertId();

        // Insert project technologies relationships
        // This connects the project to its technologies in the junction table
        if (!empty($technologies)) {
            $stmt = $pdo->prepare("
                INSERT INTO project_technologies (project_id, technology_id)
                VALUES (?, ?)
            ");
            // Loop through each selected technology and create the relationship
            foreach ($technologies as $tech_id) {
                $stmt->execute([$project_id, $tech_id]);
            }
        }

        // If we got here without errors, commit the transaction
        $pdo->commit();
        
        // Set success message and redirect back to admin dashboard
        $_SESSION['success'] = "Project added successfully!";
        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        // If any error occurs, roll back the transaction
        // This ensures no partial data is saved
        $pdo->rollBack();
        
        // Set error message and redirect back to admin dashboard
        $_SESSION['error'] = "Error adding project: " . $e->getMessage();
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar Navigation -->
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

        <!-- Main Content Area -->
        <div class="flex-1 p-8">
            <div class="max-w-2xl mx-auto">
                <h1 class="text-3xl font-bold mb-6">Add New Project</h1>

                <!-- Project Form -->
                <form method="POST" class="bg-white rounded-lg shadow-md p-6">
                    <div class="space-y-4">
                        <!-- Project Title Field -->
                        <div>
                            <label class="block text-gray-700 mb-2" for="title">Project Title</label>
                            <input type="text" id="title" name="title" required
                                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Project Description Field -->
                        <div>
                            <label class="block text-gray-700 mb-2" for="description">Description</label>
                            <textarea id="description" name="description" rows="4" required
                                      class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>

                        <!-- Project Image URL Field -->
                        <div>
                            <label class="block text-gray-700 mb-2" for="image_url">Image URL</label>
                            <input type="url" id="image_url" name="image_url"
                                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="https://example.com/image.jpg">
                            <p class="text-sm text-gray-500 mt-1">URL to an image of your project. Use a full URL including http:// or https://</p>
                        </div>

                        <!-- Project Live URL Field -->
                        <div>
                            <label class="block text-gray-700 mb-2" for="live_url">Live URL</label>
                            <input type="url" id="live_url" name="live_url"
                                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="https://example.com">
                            <p class="text-sm text-gray-500 mt-1">URL to the live version of your project.</p>
                        </div>

                        <!-- GitHub URL Field -->
                        <div>
                            <label class="block text-gray-700 mb-2" for="github_url">GitHub URL</label>
                            <input type="url" id="github_url" name="github_url"
                                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="https://github.com/yourusername/repository">
                            <p class="text-sm text-gray-500 mt-1">URL to the GitHub repository for this project.</p>
                        </div>

                        <!-- Technologies Selection -->
                        <div>
                            <label class="block text-gray-700 mb-2">Technologies</label>
                            <div class="grid grid-cols-2 gap-2">
                                <?php foreach ($technologies as $tech): ?>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="technologies[]" value="<?php echo $tech['id']; ?>"
                                               class="form-checkbox h-5 w-5 text-blue-600">
                                        <span class="ml-2"><?php echo htmlspecialchars($tech['name']); ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Featured Checkbox -->
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="featured" class="form-checkbox h-5 w-5 text-blue-600">
                                <span class="ml-2">Featured Project</span>
                            </label>
                            <p class="text-sm text-gray-500 mt-1">Featured projects appear in the Featured section on the homepage.</p>
                        </div>

                        <!-- Form Buttons -->
                        <div class="flex justify-end space-x-4">
                            <a href="index.php" class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancel</a>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                Add Project
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 