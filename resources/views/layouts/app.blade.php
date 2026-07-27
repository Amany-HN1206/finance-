<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'IPJ Finance')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Outlined" rel="stylesheet">
    
    <style>
        /* Mobile-specific layout utilities ONLY - NO font changes */
        @media (max-width: 768px) {
            /* Hanya padding dan spacing yang disesuaikan */
            .px-10 { padding-left: 1rem; padding-right: 1rem; }
            .px-12 { padding-left: 1rem; padding-right: 1rem; }
            .py-20 { padding-top: 3rem; padding-bottom: 3rem; }
            .py-16 { padding-top: 2rem; padding-bottom: 2rem; }
        }

        /* Smooth scroll */
        html { scroll-behavior: smooth; }
        
        /* Prevent horizontal overflow */
        body { overflow-x: hidden; }
    </style>
</head>
<body class="bg-paper-white antialiased">
    @yield('content')

    @stack('scripts')
</body>
</html>