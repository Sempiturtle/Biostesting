<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AISAT Portal') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/css/school-theme.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <div id="app">
        <!-- Sidebar -->
        <x-school-sidebar />

        <!-- Main Content Wrapper -->
        <div class="content-wrapper">
            <!-- Top Navigation -->
            <x-school-nav />

            <!-- Page Content -->
            <main class="school-main">
                <!-- Page Heading -->
                @isset($header)
                    <div class="mb-8">
                        {{ $header }}
                    </div>
                @endisset

                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Mobile Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black/50 z-40 hidden" onclick="toggleSidebar()"></div>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.school-sidebar');
            const overlay = document.getElementById('mobile-overlay');
            sidebar.classList.toggle('active-mobile');
            overlay.classList.toggle('hidden');
        }
    </script>
</body>
</html>
