<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'DragonMorphs') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Montserrat', sans-serif;
            }
        </style>
    </head>
    <body class="text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0" style="background-color: #f5f5f0;">
            <div class="w-full sm:max-w-md overflow-hidden sm:rounded-lg shadow-md">
                <div style="background: linear-gradient(135deg, #407200 0%, #5ea700 100%); padding: 1.25rem 1.5rem; text-align: center;">
                    <a href="/">
                        <x-application-logo />
                    </a>
                    <div style="color: rgba(255,255,255,0.7); font-size: 0.75rem; letter-spacing: 2px; text-transform: uppercase; margin-top: 0.25rem;">Admin Access Panel</div>
                </div>
                <div class="px-6 py-4 bg-white">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
