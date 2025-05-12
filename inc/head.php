<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gareth's Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'light-blue': '#93c5fd',
                        'light-green': '#86efac',
                        'light-purple': '#c4b5fd',
                    }
                }
            }
        }
    </script>
    <style>
        /* Dark mode styles */
        :root {
            color-scheme: light;
        }

        .dark {
            color-scheme: dark;
        }
        
        .dark body {
            background-color: #1a1a1a;
            color: #e5e5e5;
        }

        .dark .bg-white {
            background-color: #2d2d2d !important;
        }

        .dark .text-gray-600 {
            color: #a3a3a3 !important;
        }

        .dark .text-gray-700 {
            color: #d4d4d4 !important;
        }

        .dark .border-gray-300 {
            border-color: #404040 !important;
        }

        .dark .bg-gray-100 {
            background-color: #262626 !important;
        }

        .dark .hover\:bg-gray-50:hover {
            background-color: #333333 !important;
        }

        .dark .bg-gradient-to-r {
            background-image: linear-gradient(to right, #4c1d95, #1e40af) !important;
        }

        /* Heading styles */
        h1, h2, h3, h4, h5, h6 {
            font-weight: bold;
            font-style: italic;
            transition: all 0.3s ease;
        }

        h1:hover, h2:hover, h3:hover, h4:hover, h5:hover, h6:hover {
            font-weight: 900;
            color: #22c55e;
        }

        /* Body background */
        body {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #f0fdf4 100%);
            min-height: 100vh;
        }

        .dark body {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 50%, #1e293b 100%);
        }

        /* Smooth transitions */
        * {
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }
    </style>
</head>