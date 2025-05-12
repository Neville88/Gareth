<?php
include 'inc/links.php';
?>
<head>
    <?php include 'inc/head.php'; ?>
</head>
<?php include 'inc/nav.php'; ?>

<!-- Hero Section -->
<div class="relative bg-gradient-to-r from-purple-600 to-blue-500 text-white py-20">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <h1 class="text-5xl font-bold mb-4 border-none">Welcome to My Portfolio</h1>
                <p class="text-xl mb-8">Crafting beautiful and functional web experiences</p>
                <div class="flex space-x-4">
                    <a href="<?php echo $projects; ?>" class="bg-white text-purple-600 px-6 py-3 rounded-lg font-semibold hover:bg-purple-100 transition-colors">
                        View Projects
                    </a>
                    <a href="<?php echo $contact; ?>" class="bg-transparent border-2 border-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-purple-600 transition-colors">
                        Contact Me
                    </a>
                </div>
            </div>
            <div class="md:w-1/2">
                <div class="bg-white bg-opacity-10 p-8 rounded-lg backdrop-blur-sm">
                    <h2 class="text-2xl font-bold mb-4 border-none">Quick Stats</h2>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center">
                            <p class="text-4xl font-bold mb-2">10+</p>
                            <p class="text-sm">Completed Projects</p>
                        </div>
                        <div class="text-center">
                            <p class="text-4xl font-bold mb-2">5+</p>
                            <p class="text-sm">Years Experience</p>
                        </div>
                        <div class="text-center">
                            <p class="text-4xl font-bold mb-2">20+</p>
                            <p class="text-sm">Happy Clients</p>
                        </div>
                        <div class="text-center">
                            <p class="text-4xl font-bold mb-2">15+</p>
                            <p class="text-sm">Technologies</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Featured Projects Section -->
<div class="max-w-6xl mx-auto px-4 py-16">
    <h2 class="text-3xl font-bold mb-8">Featured Projects</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
            <div class="h-48 bg-gradient-to-r from-purple-500 to-blue-500"></div>
            <div class="p-6">
                <h3 class="text-xl font-bold mb-2">E-commerce Platform</h3>
                <p class="text-gray-600 mb-4">A full-stack e-commerce solution with React and Node.js</p>
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">React</span>
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">Node.js</span>
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">MongoDB</span>
                </div>
                <a href="<?php echo $projects; ?>" class="text-purple-600 font-semibold hover:text-purple-800 transition-colors">
                    View Project →
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
            <div class="h-48 bg-gradient-to-r from-blue-500 to-green-500"></div>
            <div class="p-6">
                <h3 class="text-xl font-bold mb-2">Task Management App</h3>
                <p class="text-gray-600 mb-4">Real-time task management application with Vue.js</p>
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">Vue.js</span>
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">Firebase</span>
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">Tailwind CSS</span>
                </div>
                <a href="<?php echo $projects; ?>" class="text-purple-600 font-semibold hover:text-purple-800 transition-colors">
                    View Project →
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
            <div class="h-48 bg-gradient-to-r from-green-500 to-purple-500"></div>
            <div class="p-6">
                <h3 class="text-xl font-bold mb-2">Portfolio Website</h3>
                <p class="text-gray-600 mb-4">A responsive portfolio website showcasing my work</p>
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">HTML5</span>
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">Tailwind CSS</span>
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">JavaScript</span>
                </div>
                <a href="<?php echo $projects; ?>" class="text-purple-600 font-semibold hover:text-purple-800 transition-colors">
                    View Project →
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Skills Section -->
<div class="bg-gradient-to-r from-purple-50 to-blue-50 py-16">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8">Skills & Expertise</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md text-center transform hover:scale-105 transition-transform duration-300">
                <div class="text-4xl mb-4">💻</div>
                <h3 class="font-bold mb-2">Frontend</h3>
                <p class="text-gray-600">React, Vue.js, HTML5, CSS3</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center transform hover:scale-105 transition-transform duration-300">
                <div class="text-4xl mb-4">⚙️</div>
                <h3 class="font-bold mb-2">Backend</h3>
                <p class="text-gray-600">Node.js, Express, MongoDB</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center transform hover:scale-105 transition-transform duration-300">
                <div class="text-4xl mb-4">🎨</div>
                <h3 class="font-bold mb-2">Design</h3>
                <p class="text-gray-600">UI/UX, Tailwind CSS, Figma</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center transform hover:scale-105 transition-transform duration-300">
                <div class="text-4xl mb-4">🚀</div>
                <h3 class="font-bold mb-2">Tools</h3>
                <p class="text-gray-600">Git, Docker, AWS</p>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="max-w-6xl mx-auto px-4 py-16">
    <div class="bg-gradient-to-r from-purple-600 to-blue-500 rounded-2xl p-12 text-center text-white">
        <h2 class="text-3xl font-bold mb-4 border-none">Ready to Start Your Project?</h2>
        <p class="text-xl mb-8">Let's create something amazing together</p>
        <a href="<?php echo $contact; ?>" class="bg-white text-purple-600 px-8 py-4 rounded-lg font-semibold hover:bg-purple-100 transition-colors inline-block">
            Get in Touch
        </a>
    </div>
</div>

<?php include 'inc/footer.php'; ?> 