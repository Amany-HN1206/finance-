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
        /* Mobile-specific utilities */
        @media (max-width: 768px) {
            .text-display { font-size: 44px !important; letter-spacing: -0.66px !important; }
            .text-headline-lg { font-size: 36px !important; letter-spacing: -0.5px !important; }
            .text-headline { font-size: 28px !important; letter-spacing: -0.3px !important; }
            .text-heading-sm { font-size: 20px !important; }
            .text-subheading { font-size: 18px !important; }
        }
        
        @media (max-width: 480px) {
            .text-display { font-size: 36px !important; }
            .text-headline-lg { font-size: 28px !important; }
        }

        /* Smooth scroll */
        html { scroll-behavior: smooth; }
        
        /* Prevent horizontal overflow */
        body { overflow-x: hidden; }
    </style>
</head>
<body class="bg-[#ffffff] antialiased">
    @yield('content')

    @stack('scripts')
</body>
</html>