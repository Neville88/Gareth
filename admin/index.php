<?php
session_start();
require_once '../inc/config.php';
require_once '../inc/links.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Handle login attempt
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = sanitize_input($_POST['username']);
        $password = $_POST['password'];
        
        if (verify_user($username, $password)) {
            $_SESSION['user_id'] = 1; // For now, we'll just use 1 as the user ID
            header('Location: index.php');
            exit;
        } else {
            $error = "Invalid username or password";
        }
    }
    
    // Create default admin user if no users exist
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    if ($stmt->fetchColumn() == 0) {
        $username = "admin";
        $password = password_hash("admin123", PASSWORD_DEFAULT);
        $email = "admin@example.com";
        
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Gareth's Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <?php if (!isset($_SESSION['user_id'])): ?>
        <!-- Login Form -->
        <div class="min-h-screen flex items-center justify-center">
            <div class="bg-white p-8 rounded-lg shadow-md w-96">
                <h2 class="text-2xl font-bold mb-6 text-center">Admin Login</h2>
                <?php if (isset($error)): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <form method="POST" class="space-y-4">
                    <div>
                        <label class="block text-gray-700 mb-2" for="username">Username</label>
                        <input type="text" id="username" name="username" required
                               class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2" for="password">Password</label>
                        <input type="password" id="password" name="password" required
                               class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <button type="submit" 
                            class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                        Login
                    </button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <!-- Admin Dashboard -->
        <div class="min-h-screen flex">
            <!-- Sidebar -->
            <div class="w-64 bg-gray-800 text-white">
                <div class="p-4">
                    <h2 class="text-2xl font-bold">Admin Panel</h2>
                </div>
                <nav class="mt-4">
                    <a href="#projects" class="block px-4 py-2 hover:bg-gray-700" onclick="showTab('projects')">
                        <i class="fas fa-project-diagram mr-2"></i> Projects
                    </a>
                    <a href="#messages" class="block px-4 py-2 hover:bg-gray-700" onclick="showTab('messages')">
                        <i class="fas fa-envelope mr-2"></i> Messages
                    </a>
                    <a href="#skills" class="block px-4 py-2 hover:bg-gray-700" onclick="showTab('skills')">
                        <i class="fas fa-code mr-2"></i> Skills
                    </a>
                    <a href="#experience" class="block px-4 py-2 hover:bg-gray-700" onclick="showTab('experience')">
                        <i class="fas fa-briefcase mr-2"></i> Experience
                    </a>
                    <a href="#education" class="block px-4 py-2 hover:bg-gray-700" onclick="showTab('education')">
                        <i class="fas fa-graduation-cap mr-2"></i> Education
                    </a>
                    <a href="logout.php" class="block px-4 py-2 hover:bg-gray-700 text-red-400">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="flex-1 p-8">
                <!-- Projects Section -->
                <div id="projects" class="tab-content">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold">Projects</h2>
                        <a href="add_project.php" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                            <i class="fas fa-plus mr-2"></i> Add Project
                        </a>
                    </div>

                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            <?php 
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                            ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <?php 
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                            ?>
                        </div>
                    <?php endif; ?>

                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Featured</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php
                                $projects = get_all_projects();
                                foreach ($projects as $project): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($project['title']); ?></td>
                                    <td class="px-6 py-4"><?php echo htmlspecialchars($project['description']); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php echo $project['featured'] ? 'Yes' : 'No'; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="edit_project.php?id=<?php echo $project['id']; ?>" class="text-blue-600 hover:text-blue-900 mr-3">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="delete_project.php?id=<?php echo $project['id']; ?>" 
                                           class="text-red-600 hover:text-red-900"
                                           onclick="return confirm('Are you sure you want to delete this project?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Messages Section -->
                <div id="messages" class="tab-content hidden">
                    <h2 class="text-2xl font-bold mb-4">Contact Messages</h2>
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php
                                $stmt = $pdo->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
                                while ($message = $stmt->fetch()): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php echo htmlspecialchars($message['first_name'] . ' ' . $message['last_name']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($message['email']); ?></td>
                                    <td class="px-6 py-4"><?php echo htmlspecialchars($message['subject']); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            <?php echo $message['status'] === 'new' ? 'bg-green-100 text-green-800' : 
                                                ($message['status'] === 'read' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800'); ?>">
                                            <?php echo ucfirst($message['status']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="edit_message.php?id=<?php echo $message['id']; ?>" class="text-blue-600 hover:text-blue-900 mr-3">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="delete_message.php?id=<?php echo $message['id']; ?>" 
                                           class="text-red-600 hover:text-red-900"
                                           onclick="return confirm('Are you sure you want to delete this message?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Skills Section -->
                <div id="skills" class="tab-content hidden">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold">Skills</h2>
                        <a href="add_skill.php" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                            <i class="fas fa-plus mr-2"></i> Add Skill
                        </a>
                    </div>
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Proficiency</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php
                                $stmt = $pdo->query("SELECT * FROM skills ORDER BY name");
                                while ($skill = $stmt->fetch()): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($skill['name']); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $skill['proficiency']; ?>%</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="edit_skill.php?id=<?php echo $skill['id']; ?>" class="text-blue-600 hover:text-blue-900 mr-3">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="delete_skill.php?id=<?php echo $skill['id']; ?>" 
                                           class="text-red-600 hover:text-red-900"
                                           onclick="return confirm('Are you sure you want to delete this skill?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Experience Section -->
                <div id="experience" class="tab-content hidden">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold">Experience</h2>
                        <a href="add_experience.php" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                            <i class="fas fa-plus mr-2"></i> Add Experience
                        </a>
                    </div>
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Period</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php
                                $stmt = $pdo->query("SELECT * FROM experience ORDER BY start_date DESC");
                                while ($exp = $stmt->fetch()): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($exp['title']); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($exp['company']); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($exp['location']); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php 
                                        echo date('M Y', strtotime($exp['start_date']));
                                        echo ' - ';
                                        echo $exp['end_date'] ? date('M Y', strtotime($exp['end_date'])) : 'Present';
                                        ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="edit_experience.php?id=<?php echo $exp['id']; ?>" class="text-blue-600 hover:text-blue-900 mr-3">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="delete_experience.php?id=<?php echo $exp['id']; ?>" 
                                           class="text-red-600 hover:text-red-900"
                                           onclick="return confirm('Are you sure you want to delete this experience entry?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Education Section -->
                <div id="education" class="tab-content hidden">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold">Education</h2>
                        <a href="add_education.php" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                            <i class="fas fa-plus mr-2"></i> Add Education
                        </a>
                    </div>
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Degree</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Institution</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Period</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php
                                $stmt = $pdo->query("SELECT * FROM education ORDER BY start_date DESC");
                                while ($edu = $stmt->fetch()): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($edu['degree']); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($edu['institution']); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($edu['location']); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php 
                                        echo date('M Y', strtotime($edu['start_date']));
                                        echo ' - ';
                                        echo $edu['end_date'] ? date('M Y', strtotime($edu['end_date'])) : 'Present';
                                        ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="edit_education.php?id=<?php echo $edu['id']; ?>" class="text-blue-600 hover:text-blue-900 mr-3">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="delete_education.php?id=<?php echo $edu['id']; ?>" 
                                           class="text-red-600 hover:text-red-900"
                                           onclick="return confirm('Are you sure you want to delete this education entry?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function showTab(tabId) {
                // Hide all tab contents
                document.querySelectorAll('.tab-content').forEach(tab => {
                    tab.classList.add('hidden');
                });
                
                // Show selected tab
                document.getElementById(tabId).classList.remove('hidden');
            }
        </script>
    <?php endif; ?>
</body>
</html> 