<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    @vite('resources/css/app.css')
</head>

<body class="antialiased bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-300">
    <div class="flex justify-center min-h-screen">
        <div class="flex flex-col justify-center items-center">
            <div>
                <h1 class="text-4xl font-bold rounded-lg">
                    Bohužel se nám nepodařilo najít stránku,
                    kterou jste hledali.
                </h1>
            </div>
            <div class="mt-8">
                <a href="{{ route('home') }}"
                    class="px-4 py-2 text-2xl font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2">
                    Zpět na hlavní stránku
                </a>
            </div>
        </div>
    </div>
</body>

</html>
