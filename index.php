<?php
include 'inc/links.php';
?>
<head>
    <?php include 'inc/head.php'; ?>
</head>
<?php include 'inc/nav.php'; ?>

<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-indigo-900 via-purple-900 to-indigo-900 text-white py-24">
    <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:60px_60px]"></div>
    <div class="max-w-6xl mx-auto px-4 relative">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <h1 class="text-5xl font-bold mb-6 leading-tight">Crafting Digital <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">Experiences</span></h1>
                <p class="text-xl mb-8 text-gray-300">Full-stack developer passionate about creating elegant solutions</p>
                <div class="flex space-x-4">
                    <a href="<?php echo $projects; ?>" class="bg-white text-indigo-900 px-8 py-3 rounded-lg font-semibold hover:bg-opacity-90 transition-all duration-300 shadow-lg hover:shadow-xl">
                        View Projects
                    </a>
                    <a href="<?php echo $contact; ?>" class="bg-transparent border-2 border-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-indigo-900 transition-all duration-300">
                        Contact Me
                    </a>
                </div>
            </div>
            <div class="md:w-1/2">
                <div class="bg-white/10 p-8 rounded-2xl backdrop-blur-lg border border-white/20 shadow-2xl">
                    <h2 class="text-2xl font-bold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">Quick Stats</h2>
                    <div class="grid grid-cols-2 gap-8">
                        <div class="text-center">
                            <p class="text-4xl font-bold mb-2 bg-gradient-to-r from-purple-400 to-pink-400 text-transparent bg-clip-text">10+</p>
                            <p class="text-sm text-gray-300">Completed Projects</p>
                        </div>
                        <div class="text-center">
                            <p class="text-4xl font-bold mb-2 bg-gradient-to-r from-purple-400 to-pink-400 text-transparent bg-clip-text">5+</p>
                            <p class="text-sm text-gray-300">Years Experience</p>
                        </div>
                        <div class="text-center">
                            <p class="text-4xl font-bold mb-2 bg-gradient-to-r from-purple-400 to-pink-400 text-transparent bg-clip-text">20+</p>
                            <p class="text-sm text-gray-300">Happy Clients</p>
                        </div>
                        <div class="text-center">
                            <p class="text-4xl font-bold mb-2 bg-gradient-to-r from-purple-400 to-pink-400 text-transparent bg-clip-text">15+</p>
                            <p class="text-sm text-gray-300">Technologies</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Featured Projects Section -->
<div class="max-w-6xl mx-auto px-4 py-20">
    <h2 class="text-3xl font-bold mb-12 text-center">Featured <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">Projects</span></h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300 hover:shadow-2xl">
            <div class="h-48 bg-gradient-to-br from-purple-600 to-pink-600 relative overflow-hidden">
                <div class="absolute inset-0 bg-grid-white/[0.1] bg-[size:30px_30px]"></div>
            </div>
            <div class="p-8">
                <h3 class="text-xl font-bold mb-3">E-commerce Platform</h3>
                <p class="text-gray-600 mb-4">A full-stack e-commerce solution with React and Node.js</p>
                <div class="flex flex-wrap gap-2 mb-6">
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">React</span>
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">Node.js</span>
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">MongoDB</span>
                </div>
                <a href="<?php echo $projects; ?>" class="text-purple-600 font-semibold hover:text-purple-800 transition-colors inline-flex items-center">
                    View Project <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300 hover:shadow-2xl">
            <div class="h-48 bg-gradient-to-br from-blue-600 to-purple-600 relative overflow-hidden">
                <div class="absolute inset-0 bg-grid-white/[0.1] bg-[size:30px_30px]"></div>
            </div>
            <div class="p-8">
                <h3 class="text-xl font-bold mb-3">Task Management App</h3>
                <p class="text-gray-600 mb-4">Real-time task management application with Vue.js</p>
                <div class="flex flex-wrap gap-2 mb-6">
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">Vue.js</span>
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">Firebase</span>
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">Tailwind CSS</span>
                </div>
                <a href="<?php echo $projects; ?>" class="text-purple-600 font-semibold hover:text-purple-800 transition-colors inline-flex items-center">
                    View Project <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300 hover:shadow-2xl">
            <div class="h-48 bg-gradient-to-br from-pink-600 to-purple-600 relative overflow-hidden">
                <div class="absolute inset-0 bg-grid-white/[0.1] bg-[size:30px_30px]"></div>
            </div>
            <div class="p-8">
                <h3 class="text-xl font-bold mb-3">Portfolio Website</h3>
                <p class="text-gray-600 mb-4">A responsive portfolio website showcasing my work</p>
                <div class="flex flex-wrap gap-2 mb-6">
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">HTML5</span>
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">Tailwind CSS</span>
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">JavaScript</span>
                </div>
                <a href="<?php echo $projects; ?>" class="text-purple-600 font-semibold hover:text-purple-800 transition-colors inline-flex items-center">
                    View Project <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Skills Section -->
<div class="bg-gradient-to-br from-gray-50 to-gray-100 py-20">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-3xl font-bold mb-12 text-center">Skills & <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">Expertise</span></h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-lg text-center transform hover:scale-105 transition-all duration-300 hover:shadow-xl">
                <div class="text-4xl mb-4">💻</div>
                <h3 class="font-bold mb-3 text-lg">Frontend</h3>
                <p class="text-gray-600">React, Vue.js, HTML5, CSS3</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-lg text-center transform hover:scale-105 transition-all duration-300 hover:shadow-xl">
                <div class="text-4xl mb-4">⚙️</div>
                <h3 class="font-bold mb-3 text-lg">Backend</h3>
                <p class="text-gray-600">Node.js, Express, MongoDB</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-lg text-center transform hover:scale-105 transition-all duration-300 hover:shadow-xl">
                <div class="text-4xl mb-4">🎨</div>
                <h3 class="font-bold mb-3 text-lg">Design</h3>
                <p class="text-gray-600">UI/UX, Tailwind CSS, Figma</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-lg text-center transform hover:scale-105 transition-all duration-300 hover:shadow-xl">
                <div class="text-4xl mb-4">🚀</div>
                <h3 class="font-bold mb-3 text-lg">Tools</h3>
                <p class="text-gray-600">Git, Docker, AWS</p>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="max-w-6xl mx-auto px-4 py-20">
    <div class="bg-gradient-to-br from-indigo-900 via-purple-900 to-indigo-900 rounded-3xl p-12 text-center text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:60px_60px]"></div>
        <div class="relative">
            <h2 class="text-3xl font-bold mb-4">Ready to Start Your Project?</h2>
            <p class="text-xl mb-8 text-gray-300">Let's create something amazing together</p>
            <a href="<?php echo $contact; ?>" class="bg-white text-indigo-900 px-8 py-4 rounded-xl font-semibold hover:bg-opacity-90 transition-all duration-300 shadow-lg hover:shadow-xl inline-block">
                Get in Touch
            </a>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?> 