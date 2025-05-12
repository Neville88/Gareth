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
                    <h1 class="text-5xl font-bold mb-4 border-none">About Me</h1>
                    <p class="text-xl">Passionate web developer crafting digital experiences</p>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <a href="view-photo.php" target="_blank" class="group">
                        <div class="relative">
                            <img src="IMG_7115.JPG" alt="Profile Photo" class="w-48 h-48 object-cover rounded-full shadow-lg border-4 border-white transform transition-transform duration-300 group-hover:scale-105" />
                            <div class="absolute inset-0 rounded-full bg-purple-600 opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 py-12">
        <!-- Bio Section -->
        <div class="bg-white rounded-lg shadow-lg p-8 mb-12">
            <h2 class="text-3xl font-bold mb-6">My Journey</h2>
            <div class="prose max-w-none">
                <p class="text-lg text-gray-700 mb-6">
                    Hello! I'm Gareth, a passionate web developer with expertise in creating beautiful and functional
                    websites. With a strong foundation in modern web technologies, I strive to build engaging digital
                    experiences that make a difference.
                </p>
                <p class="text-lg text-gray-700">
                    My journey in web development started 5 years ago, and since then, I've been constantly learning
                    and adapting to new technologies and best practices. I believe in writing clean, maintainable code
                    and creating intuitive user interfaces.
                </p>
            </div>
        </div>

        <!-- Skills Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
            <!-- Technical Skills -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-3xl font-bold mb-6">Technical Skills</h2>
                <div class="space-y-6">
                    <div>
                        <h3 class="text-xl font-semibold mb-3">Frontend Development</h3>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full">HTML5</span>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full">CSS3</span>
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full">JavaScript</span>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full">React.js</span>
                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full">Tailwind CSS</span>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-3">Backend Development</h3>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full">Node.js</span>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full">Express.js</span>
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full">MongoDB</span>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full">RESTful APIs</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Professional Experience -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-3xl font-bold mb-6">Professional Experience</h2>
                <div class="space-y-6">
                    <div class="border-l-4 border-purple-500 pl-4">
                        <h3 class="text-xl font-semibold">Senior Web Developer</h3>
                        <p class="text-gray-600">Tech Solutions Inc. | 2020 - Present</p>
                        <p class="text-gray-700 mt-2">Leading development of enterprise web applications and mentoring junior developers.</p>
                    </div>
                    <div class="border-l-4 border-blue-500 pl-4">
                        <h3 class="text-xl font-semibold">Web Developer</h3>
                        <p class="text-gray-600">Digital Creations | 2018 - 2020</p>
                        <p class="text-gray-700 mt-2">Developed and maintained multiple client websites using modern web technologies.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Education & Certifications -->
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-3xl font-bold mb-6">Education & Certifications</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-xl font-semibold mb-3">Education</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="text-2xl mr-3">🎓</div>
                            <div>
                                <h4 class="font-semibold">Bachelor of Computer Science</h4>
                                <p class="text-gray-600">University of Technology | 2014 - 2018</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-3">Certifications</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="text-2xl mr-3">🏆</div>
                            <div>
                                <h4 class="font-semibold">AWS Certified Developer</h4>
                                <p class="text-gray-600">Amazon Web Services | 2021</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="text-2xl mr-3">🎯</div>
                            <div>
                                <h4 class="font-semibold">MongoDB Professional</h4>
                                <p class="text-gray-600">MongoDB University | 2020</p>
                            </div>
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