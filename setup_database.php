<?php
// Include the configuration file
require_once 'inc/config.php';

// SQL to create tables and insert data
$sql = file_get_contents('database.sql');

// Split the SQL into separate statements
$statements = explode(';', $sql);

// Execute each statement
$success = true;
$errors = [];

try {
    foreach ($statements as $statement) {
        // Skip empty statements
        $statement = trim($statement);
        if (!empty($statement)) {
            try {
                $conn->exec($statement);
            } catch (PDOException $e) {
                $success = false;
                $errors[] = $e->getMessage() . " in statement: " . substr($statement, 0, 100) . "...";
            }
        }
    }
} catch (Exception $e) {
    $success = false;
    $errors[] = $e->getMessage();
}

// Output results
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-2xl w-full bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4"><?php echo $success ? 'Database Setup Complete!' : 'Database Setup Failed'; ?></h1>
        
        <?php if ($success): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <p>The database has been set up successfully with all required tables and sample data.</p>
            </div>
            <h2 class="text-xl font-semibold mb-2">Created Tables:</h2>
            <ul class="list-disc pl-5 mb-4">
                <li>users</li>
                <li>projects</li>
                <li>technologies</li>
                <li>project_technologies</li>
                <li>contact_messages</li>
                <li>skills</li>
                <li>experience</li>
                <li>education</li>
            </ul>
        <?php else: ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <p>There was an error setting up the database:</p>
                <ul class="list-disc pl-5">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
                <p class="font-bold">Troubleshooting:</p>
                <ol class="list-decimal pl-5">
                    <li>Make sure your MySQL server is running</li>
                    <li>Check that the username and password in inc/config.php are correct</li>
                    <li>Verify that the user has privileges to create databases and tables</li>
                    <li>Look at the specific error message for more details</li>
                </ol>
            </div>
        <?php endif; ?>
        
        <div class="mt-6">
            <a href="index.php" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Return to Homepage
            </a>
        </div>
    </div>
</body>
</html> 