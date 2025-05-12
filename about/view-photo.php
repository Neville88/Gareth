<!DOCTYPE html>
<html lang="en">

<?php include '../inc/links.php'; ?>
<head>
    <?php include '../inc/head.php'; ?>
</head>
<body class="bg-gray-100">
    <?php include '../inc/nav.php'; ?>
    <div class="fixed top-4 left-4 z-50">
        <button onclick="window.history.back()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded transition-colors shadow">&larr; Back</button>
    </div>
    <div class="max-w-2xl mx-auto px-4 py-12 flex flex-col items-center">
        <img src="IMG_7115.JPG" alt="Profile Photo" class="w-full max-w-md rounded-lg shadow-lg mb-6 border-4 border-white" />
        <a href="index.php" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded transition-colors">Back to About</a>
    </div>
    <script src="../script.js"></script>
    <?php include '../inc/footer.php'; ?>
</body>
</html> 