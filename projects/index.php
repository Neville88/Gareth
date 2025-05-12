<!DOCTYPE html>
<html lang="en">

<?php include '../inc/links.php'; ?>

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
                                <p class="text-4xl font-bold mb-2">15+</p>
                                <p class="text-sm">Total Projects</p>
                            </div>
                            <div class="text-center">
                                <p class="text-4xl font-bold mb-2">8+</p>
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
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                    <div class="h-64 bg-gradient-to-r from-purple-500 to-blue-500 relative group">
                        <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <a href="#" class="bg-white text-purple-600 px-6 py-3 rounded-lg font-semibold hover:bg-purple-100 transition-colors">
                                View Live Demo
                            </a>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-2">E-commerce Platform</h3>
                        <p class="text-gray-600 mb-4">A full-stack e-commerce solution with React and Node.js, featuring real-time inventory management and secure payment processing.</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">React</span>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">Node.js</span>
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">MongoDB</span>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">Stripe</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <a href="#" class="text-purple-600 font-semibold hover:text-purple-800 transition-colors">
                                View Details →
                            </a>
                            <a href="#" class="text-gray-600 hover:text-gray-800">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                    <div class="h-64 bg-gradient-to-r from-blue-500 to-green-500 relative group">
                        <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <a href="#" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-blue-100 transition-colors">
                                View Live Demo
                            </a>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-2">Task Management App</h3>
                        <p class="text-gray-600 mb-4">A collaborative task management application with real-time updates, team collaboration features, and progress tracking.</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">Vue.js</span>
                            <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">Firebase</span>
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">Tailwind CSS</span>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">WebSocket</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <a href="#" class="text-blue-600 font-semibold hover:text-blue-800 transition-colors">
                                View Details →
                            </a>
                            <a href="#" class="text-gray-600 hover:text-gray-800">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Other Projects -->
        <div>
            <h2 class="text-3xl font-bold mb-8">Other Projects</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition-transform duration-300">
                    <div class="h-40 bg-gradient-to-r from-green-500 to-purple-500"></div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Portfolio Website</h3>
                        <p class="text-gray-600 mb-4">A responsive portfolio website showcasing my work and skills</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">HTML5</span>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">Tailwind CSS</span>
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">JavaScript</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition-transform duration-300">
                    <div class="h-40 bg-gradient-to-r from-yellow-500 to-red-500"></div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Weather App</h3>
                        <p class="text-gray-600 mb-4">Real-time weather application with location tracking</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">React</span>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">OpenWeather API</span>
                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm">Geolocation</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition-transform duration-300">
                    <div class="h-40 bg-gradient-to-r from-pink-500 to-purple-500"></div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Chat Application</h3>
                        <p class="text-gray-600 mb-4">Real-time chat application with user authentication</p>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-pink-100 text-pink-800 rounded-full text-sm">Socket.io</span>
                            <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">Express</span>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">MongoDB</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../script.js"></script>
    <?php include '../inc/footer.php'; ?>
</body>

</html>