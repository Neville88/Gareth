<?php include 'links.php'; ?>
<nav class="bg-gradient-to-r from-purple-600 to-blue-500 shadow-lg">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="text-2xl font-bold text-white">Gareth</div>
            <div>
                <a href="<?php echo $home; ?>" class="px-4 py-2 text-white hover:text-blue-100 transition-colors">Home</a>
                <a href="<?php echo $about; ?>" class="px-4 py-2 text-white hover:text-blue-100 transition-colors">About</a>
                <a href="<?php echo $projects; ?>" class="px-4 py-2 text-white hover:text-blue-100 transition-colors">Projects</a>
                <a href="<?php echo $contact; ?>" class="px-4 py-2 text-white hover:text-blue-100 transition-colors">Contact</a>
                <a href="<?php echo $login; ?>" class="px-4 py-2 text-white hover:text-blue-100 transition-colors">Login</a>
            </div>
        </div>
    </div>
</nav>

<!-- Scroll Progress Bar -->
<div id="scroll-progress" class="h-1 bg-gradient-to-r from-purple-600 to-blue-500"></div>