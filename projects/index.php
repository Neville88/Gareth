<!DOCTYPE html>
<html lang="en">

<?php 
include '../inc/links.php';
require_once '../inc/config.php';
?>

<head>
    <?php include '../inc/head.php'; ?>
</head>

<body class="bg-gray-100">
    <?php include '../inc/nav.php'; ?>

    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-purple-600 to-blue-500 text-white py-16">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h1 class="text-5xl font-bold mb-4 border-none">My Projects</h1>
                    <p class="text-xl">Showcasing my best work and achievements</p>
                </div>
                <div class="md:w-1/2">
                    <div class="bg-white bg-opacity-10 p-8 rounded-lg backdrop-blur-sm">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="text-center">
                                <?php
                                $total_projects = count(get_all_projects());
                                ?>
                                <p class="text-4xl font-bold mb-2"><?php echo $total_projects; ?>+</p>
                                <p class="text-sm">Total Projects</p>
                            </div>
                            <div class="text-center">
                                <?php
                                $total_techs = count($pdo->query("SELECT * FROM technologies")->fetchAll());
                                ?>
                                <p class="text-4xl font-bold mb-2"><?php echo $total_techs; ?>+</p>
                                <p class="text-sm">Technologies</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects Grid -->
    <div class="max-w-6xl mx-auto px-4 py-12">
        <!-- Featured Projects -->
        <div class="mb-16">
            <h2 class="text-3xl font-bold mb-8">Featured Projects</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <?php
                $featured_projects = get_featured_projects();
                foreach ($featured_projects as $project):
                    $technologies = get_project_technologies($project['id']);
                ?>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                    <div class="h-64 bg-gradient-to-r from-purple-500 to-blue-500 relative group">
                        <?php if ($project['image_url']): ?>
                            <img src="<?php echo htmlspecialchars($project['image_url']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>" class="w-full h-full object-cover">
                        <?php endif; ?>
                        <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <?php if ($project['live_url']): ?>
                            <a href="<?php echo htmlspecialchars($project['live_url']); ?>" target="_blank" class="bg-white text-purple-600 px-6 py-3 rounded-lg font-semibold hover:bg-purple-100 transition-colors">
                                View Live Demo
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-2"><?php echo htmlspecialchars($project['title']); ?></h3>
                        <p class="text-gray-600 mb-4"><?php echo htmlspecialchars($project['description']); ?></p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <?php foreach ($technologies as $tech): ?>
                            <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">
                                <?php echo htmlspecialchars($tech['name']); ?>
                            </span>
                            <?php endforeach; ?>
                        </div>
                        <?php if ($project['github_url']): ?>
                        <a href="<?php echo htmlspecialchars($project['github_url']); ?>" target="_blank" class="text-purple-600 font-semibold hover:text-purple-800 transition-colors">
                            View on GitHub →
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Other Projects -->
        <div>
            <h2 class="text-3xl font-bold mb-8">Other Projects</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php
                $all_projects = get_all_projects();
                foreach ($all_projects as $project):
                    if (!$project['featured']):
                        $technologies = get_project_technologies($project['id']);
                ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition-transform duration-300">
                    <div class="h-40 bg-gradient-to-r from-green-500 to-purple-500">
                        <?php if ($project['image_url']): ?>
                            <img src="<?php echo htmlspecialchars($project['image_url']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>" class="w-full h-full object-cover">
                        <?php endif; ?>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2"><?php echo htmlspecialchars($project['title']); ?></h3>
                        <p class="text-gray-600 mb-4"><?php echo htmlspecialchars($project['description']); ?></p>
                        <div class="flex flex-wrap gap-2">
                            <?php foreach ($technologies as $tech): ?>
                            <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">
                                <?php echo htmlspecialchars($tech['name']); ?>
                            </span>
                            <?php endforeach; ?>
                        </div>
                        <?php if ($project['live_url'] || $project['github_url']): ?>
                        <div class="mt-4 flex space-x-4">
                            <?php if ($project['live_url']): ?>
                            <a href="<?php echo htmlspecialchars($project['live_url']); ?>" target="_blank" class="text-purple-600 hover:text-purple-800">
                                Live Demo →
                            </a>
                            <?php endif; ?>
                            <?php if ($project['github_url']): ?>
                            <a href="<?php echo htmlspecialchars($project['github_url']); ?>" target="_blank" class="text-purple-600 hover:text-purple-800">
                                GitHub →
                            </a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php 
                    endif;
                endforeach; 
                ?>
            </div>
        </div>
    </div>

    <script src="../script.js"></script>
    <?php include '../inc/footer.php'; ?>
</body>

</html>