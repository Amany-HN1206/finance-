<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'IPJ Finance')</title>

    {{-- ✅ WAJIB: Google Fonts langsung di head --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;430;450;480;500&family=Source+Serif+4:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Outlined" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ✅ Font fallback yang pasti bekerja */
        :root {
            --font-signifier: 'Source Serif 4', 'Georgia', 'Times New Roman', serif;
            --font-sohne: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        html, body {
            font-family: var(--font-sohne);
            background-color: #ffffff;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* ✅ Class yang PASTI ter-apply untuk heading serif */
        .font-serif-display,
        .font-display {
            font-family: var(--font-signifier) !important;
            font-weight: 400 !important;
        }

        /* ✅ Scale typography sesuai DESIGN */
        .text-display {
            font-family: var(--font-signifier) !important;
            font-size: 90px;
            line-height: 1.3;
            letter-spacing: -2.25px;
            font-weight: 400 !important;
        }

        .text-headline-lg {
            font-family: var(--font-signifier) !important;
            font-size: 64px;
            line-height: 1.3;
            letter-spacing: -0.96px;
            font-weight: 400 !important;
        }

        .text-headline {
            font-family: var(--font-signifier) !important;
            font-size: 44px;
            line-height: 1.3;
            letter-spacing: -0.66px;
            font-weight: 400 !important;
        }

        /* ✅ Mobile responsive untuk display font */
        @media (max-width: 768px) {
            .text-display {
                font-size: 44px !important;
                letter-spacing: -0.66px !important;
            }
            .text-headline-lg {
                font-size: 36px !important;
                letter-spacing: -0.5px !important;
            }
            .text-headline {
                font-size: 32px !important;
                letter-spacing: -0.3px !important;
            }
            
            /* ✅ Hanya padding dan spacing yang disesuaikan */
            .px-10 { padding-left: 1rem; padding-right: 1rem; }
            .px-12 { padding-left: 1rem; padding-right: 1rem; }
            .py-20 { padding-top: 3rem; padding-bottom: 3rem; }
            .py-16 { padding-top: 2rem; padding-bottom: 2rem; }
        }

        @media (max-width: 480px) {
            .text-display {
                font-size: 36px !important;
            }
            .text-headline-lg {
                font-size: 28px !important;
            }
            .text-headline {
                font-size: 26px !important;
            }
        }

        /* ✅ Material Symbols - Pastikan tidak terimpa */
        .material-symbols-outlined {
            font-family: 'Material Symbols Outlined' !important;
            font-weight: normal !important;
            font-style: normal !important;
            font-size: 24px;
            line-height: 1;
            letter-spacing: normal;
            text-transform: none;
            display: inline-block;
            white-space: nowrap;
            word-wrap: normal;
            direction: ltr;
            -webkit-font-feature-settings: 'liga';
            -webkit-font-smoothing: antialiased;
        }

        /* ✅ Smooth scroll */
        html { scroll-behavior: smooth; }
        
        /* ✅ Prevent horizontal overflow */
        body { overflow-x: hidden; }
    </style>
</head>
<body class="bg-[#ffffff] antialiased">
    @yield('content')

    @stack('scripts')
</body>
</html>